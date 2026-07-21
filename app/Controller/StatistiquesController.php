<?php

App::uses('AppController', 'Controller');

//Créé le 15/10/2018 
class StatistiquesController extends AppController
{

    //Statistiques
    // function beforeFilter() {
    // parent::beforeFilter();
    // header("Access-Control-Allow-Origin: *");
    // $this->Auth->allow();
    // }

    function statistiquesvisite()
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->loadModel("Client");
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->loadModel('Apartient');
        $this->User->Ligne->recursive = -1;

        $dateaafficherdansleview = "";
        $date_debut = date("Y-01-01");
        $date_fin = date("Y-m-d");

        $query = " Visite.archive=1 ";
        $queryclient = " Client.archive=1 ";
        $querynonvister = " Client.archive=1 ";

        $ordredeprentation = array();
        $visites = $p_presanter = $p_presante = array();

        if ($this->request->is('post')) {
            if (!empty($this->request->data["date"])) {
                $dateaafficherdansleview = $this->request->data["date"];
                $date = explode(" -- ", $this->request->data["date"]);
                $date_debut = $date[0];
                $date_fin = $date[1];
                $date = " and (DATE(Visite.date) BETWEEN '$date[0]' AND '$date[1]') ";
                $query = $query . " " . $date;
            }

            //----------------------------activité---------------------------
            if (!empty($this->request->data["activite"])) {
                $queryclient .= " and Client.activite='" . $this->request->data["activite"] . "'";
                $querynonvister .= " and Client.activite='" . $this->request->data["activite"] . "'";
            }
            //----------------------------Type client---------------------------
            if (!empty($this->request->data["type"])) {
                $types = 0;
                foreach ($this->request->data["type"] as $key => $value)
                    $types = $types . "," . $value;
                $queryclient = $queryclient . " and Client.type_id in ($types)";
                $querynonvister .= " and Client.type_id in ($types)";
            }
            //----------------------Seteurs------------------------
            if (!empty($this->request->data["secteur"])) {
                $secteur = 0;
                foreach ($this->request->data["secteur"] as $key => $value) {
                    $region = $this->Secteur->findById($value);
                    $region = $this->Secteur->find('list', array("conditions" => array("Secteur.region" => $region["Secteur"]["region"])));
                    foreach ($region as $k => $v) {
                        $secteur = $secteur . "," . $k;
                    }
                }
                $queryclient = $queryclient . " and Client.secteur_id in ($secteur)";
                $querynonvister .= " and Client.secteur_id in ($secteur)";
            }
            //--------------------------------Les categories---------------------------
            if (!empty($this->request->data["category"])) {
                $spesialite = 0;
                foreach ($this->request->data["category"] as $key => $value)
                    $spesialite = $spesialite . "," . $value;
                $queryclient = $queryclient . " and Client.category_id in ($spesialite)";
                $querynonvister .= " and Client.category_id in ($spesialite)";
            }
            //--------------------------------------------Potentialité
            if (!empty($this->request->data["potentialite"])) {
                $potentialite = "'0'";
                foreach ($this->request->data["potentialite"] as $key => $value)
                    $potentialite = $potentialite . ",'" . $value . "'";
                $queryclient = $queryclient . " and Client.potentialite in ($potentialite)";
                $querynonvister .= " and Client.potentialite in ($potentialite)";
            }
            //----------------------------Lignes ---------------------------
            if (!empty($this->request->data["ligne"])) {
                $ids = 0;
                foreach ($this->request->data["ligne"] as $key => $value)
                    $ids .= "," . $value;
                $user = $this->User->find('list', array('conditions' => array("User.ligne_id in ($ids) and User.archive!=-1")));
                $ids = 0;
                foreach ($user as $k => $name) {
                    $ids .= ",$k";
                }
                $query = $query . " and Visite.user_id in ($ids)";
            }
            //-------------------------------Fin Ligne---------------------------//
            else {
                if (!empty($this->request->data["users"])) {
                    $ids = 0;
                    foreach ($this->request->data["users"] as $key => $value)
                        $ids .= "," . $value;
                    $query = $query . " and Visite.user_id in ($ids)";
                } else if (AuthComponent::user('role') == 'Super viseur') {
                    $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                    $ids = AuthComponent::user('id');
                    foreach ($user as $u) {
                        if ($u['User1']['archive'] != -1)
                            $ids .= "," . $u['Apartient']['user1_id'];
                    }
                    $query = $query . " and Visite.user_id in ($ids)";
                } else {
                    $users = $this->User->find("list", array('conditions' => array(
                        'User.archive' => 1,
                        "User.role in('Coordinateur','Super viseur','VMP')"
                    )));
                    $ids = "";
                    foreach ($users as $key => $value)
                        $ids .= "," . $key;
                    $ids = trim($ids, ",");
                }
            }

            //echo $query;
            //debug($this->request->data);
            $this->Client->recursive = -1;
            $this->Client->Visite->recursive = -1;
            $clients = $this->Client->find("all", array("conditions" => array("$queryclient ")));

            // debug($clients);
            // debug($queryclient);
            // debug($query);
            $clients_id = 0;
            foreach ($clients as $c) {
                $clients_id = $clients_id . "," . $c["Client"]["id"];
            }
            // debug($clients_id);
            $visites = $this->Client->Visite->find("all", array("conditions" => array("$query and Visite.client_id in($clients_id)")));
            // debug($visites);
            $visites_id = 0;
            foreach ($visites as $v) {
                $visites_id = $visites_id . "," . $v["Visite"]["id"];
            }
            // debug($visites_id);
            //------------------------------Les clientss-------------------//
            $clients = Hash::combine($clients, '{n}.Client.id', '{n}');
            // debug($clients);
            for ($i = 0; $i < count($visites); $i++)
                $visites[$i]["Client"] = $clients[$visites[$i]["Visite"]["client_id"]]["Client"];
            //------------------------------------Fin les clients-----------------------------//
            //------------------------------Les Visiteordre-------------------//
            $this->loadModel("Visiteordre");
            $this->Visiteordre->recursive = -1;
            $visiteordres = $this->Visiteordre->find("all", array("conditions" => array("Visiteordre.visite_id in ($visites_id) order by id asc")));
            $groupedVisiteordres = array();

            foreach ($visiteordres as $visiteordre) {
                $visiteId = $visiteordre['Visiteordre']['visite_id'];
                $visiteordreId = $visiteordre['Visiteordre']['id'];

                // Si la clé de visite n'existe pas encore dans le tableau $groupedVisiteordres, créez-la
                if (!isset($groupedVisiteordres[$visiteId])) {
                    $groupedVisiteordres[$visiteId] = array();
                }

                // Ajoutez le visite ordre au tableau correspondant à la visite_id
                $groupedVisiteordres[$visiteId][$visiteordreId] = $visiteordre['Visiteordre'];
            }
            for ($i = 0; $i < count($visites); $i++) {
                if (isset($groupedVisiteordres[$visites[$i]["Visite"]["id"]]))
                    $visites[$i]["Visiteordre"] = $groupedVisiteordres[$visites[$i]["Visite"]["id"]];
            }
            //------------------------------------Fin les Visiteordre-----------------------------//
            //------------------------------Les Users-------------------//
            $this->loadModel("User");
            $users = $this->User->find("all");
            $users = Hash::combine($users, '{n}.User.id', '{n}');
            for ($i = 0; $i < count($visites); $i++)
                $visites[$i]["User"] = $users[$visites[$i]["Visite"]["user_id"]]["User"];
            //------------------------------------Fin les users-----------------------------//





            $clients = $activite = $potentialite = $categorie = $frequences = array();
            $activite["yes"]["Publique"] = 0;
            $activite["yes"]["Prive"] = 0;
            $activite["non"]["Publique"] = 0;
            $activite["non"]["Prive"] = 0;

            //ordre de présentation
            $this->loadModel("Brochure");
            $this->Brochure->recursive = -1;
            $brochures = $this->Brochure->find("all");

            $this->loadModel("Game");
            $gammes = $this->Game->find("list");


            foreach ($visites as $visite) {
                //------------07/09/2022 -----------  Les produits partenaires ------------------//
                //!!!!!!!!!!!!!!!!!!!!!!!!!! Depreced a supprimer apres validation du 02/08/2024 !!!!!!!!!!!!!!!!!!!-----//
                if (!empty($visite["Visite"]['produits'])) {
                    $ec = explode("\|", $visite["Visite"]['produits']);
                    if (strpos($ec[0], '*') === 0) {
                        $pps = explode(",", str_replace("*", "", $ec[0]));
                        foreach ($pps as $e) {
                            if (isset($gammes[$e])) {
                                if (isset($p_presante)) {
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]]["1"] = 0;
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]]["2"] = 0;
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]]["3"] = 0;
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]][$ec[1]] = 0;
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]]["Client"] = $visite["Client"];
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]]["Client"]["user"] = $visite["User"]["name"];
                                    $p_presante[$visite["Client"]['id']][$gammes[$e]]["date"] = $visite["Visite"]["date"];
                                }
                                $p_presante[$visite["Client"]['id']][$gammes[$e]][$ec[1]] = $p_presante[$visite["Client"]['id']][$gammes[$e]][$ec[1]] + 1;
                            }
                        }
                    }
                }
                //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!Fin depreced!!!!!!!!!!!!!!!!!!!!!!!!!!!!//
                //new 02/08/2024--------------------------------------------//
                if (!empty($visite["Visite"]['produit_adoption'])) {

                    $produit_adoptions = json_decode($visite["Visite"]['produit_adoption'], true);
                    $modified = false;
                    foreach ($produit_adoptions as $gamme_id => &$produit_adoption) {
                        if (!isset($produit_adoption["pot"])) {
                            $produit_adoption["pot"] = "1";
                            $modified = true;
                        }
                        if (isset($gammes[$gamme_id])) {
                            if (isset($p_presanter)) {
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["1"] = 0;
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["2"] = 0;
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["3"] = 0;
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["pot"] = $produit_adoption["pot"];
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]][$produit_adoption["pot"]] = 0;
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["Client"] = $visite["Client"];
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["Client"]["user"] = $visite["User"]["name"];
                                $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]]["date"] = $visite["Visite"]["date"];
                            }
                            $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]][$produit_adoption["pot"]] = $p_presanter[$visite["Visite"]['id']][$visite["Client"]['id']][$gammes[$gamme_id]][$produit_adoption["pot"]] + $produit_adoption["nb"];
                        }
                    }
                    //ou cas ou il n'a pas de pot dans json je l'ajoute bug regler le 29/08/2024
                    if ($modified) {
                        $visite["Visite"]['produit_adoption'] = json_encode($produit_adoptions);
                        $this->Client->Visite->id = $visite["Visite"]['id'];
                        $this->Client->Visite->saveField('produit_adoption', $visite["Visite"]['produit_adoption']);
                    }
                }

                //-------------------Finnnn----------------//
                $this->loadModel("Brochureorganises");
                $maxOrder = $this->Brochureorganises->find('first', array(
                    'fields' => array('MAX(Brochureorganises.ordre) AS max_ordre')
                ));
                $maxOrderValue = $maxOrder[0]['max_ordre'];
                //----------------------------Ordre de présentation-----------------------//

                if (!empty($visite["Visiteordre"])) {
                    $ordree = 0;
                    // debug($visite["Visiteordre"]);
                    foreach ($visite["Visiteordre"] as $ordre) {
                        $ordree++; //hada howa classement li kib9a itzad 
                        foreach ($brochures as $brochure) {
                            if ($brochure["Brochure"]["id"] == $ordre["brochure_id"]) {

                                if (!isset($ordredeprentation[$ordree]))
                                    $ordredeprentation[$ordree] = array();


                                // debug($ordre["brochure_id"]);
                                if (!isset($ordredeprentation[$ordree][$ordre["brochure_id"]])) //hna mazal brochure ma tpresentache
                                {

                                    $ordredeprentation[$ordree][$ordre["brochure_id"]] = array();
                                    $ordredeprentation[$ordree][$ordre["brochure_id"]]["nombre"] = 1;
                                    $ordredeprentation[$ordree][$ordre["brochure_id"]]["nom"] = $brochure["Brochure"]["name"];
                                    $ordredeprentation[$ordree][$ordre["brochure_id"]]["logo"] = $brochure["Brochure"]["logo"];
                                    // debug($ordree);
                                    // debug($ordredeprentation[$ordree][$ordre["brochure_id"]]);
                                } else //hna brochure tpresenta
                                    $ordredeprentation[$ordree][$ordre["brochure_id"]]["nombre"] = $ordredeprentation[$ordree][$ordre["brochure_id"]]["nombre"] + 1;
                                break;
                            }
                        }
                    }
                }
                //-------------------------------------------------Frequences-----------------------------------
                if (!isset($frequences[$visite["Client"]["id"]]))
                    $frequences[$visite["Client"]["id"]] = 1;
                else
                    $frequences[$visite["Client"]["id"]] = $frequences[$visite["Client"]["id"]] + 1;

                //on cherche si le client est deja passer on block le calcule si non cava données des données fausse
                if (isset($clients[$visite["Visite"]["client_id"]]))
                    continue;
                //Recupération des clients Visiter 
                $clients[$visite["Visite"]["client_id"]] = $visite["Visite"]["client_id"];
                //-------------------------------------------------Activité-----------------------------------
                $visite["Client"]["activite"] = ucfirst($visite["Client"]["activite"]);
                if (!isset($activite["yes"][$visite["Client"]["activite"]]))
                    $activite["yes"][$visite["Client"]["activite"]] = 1;
                else
                    $activite["yes"][$visite["Client"]["activite"]] = $activite["yes"][$visite["Client"]["activite"]] + 1;
                //-------------------------------------------------Potentialite-----------------------------------
                if (!isset($potentialite["yes"][$visite["Client"]["potentialite"]]))
                    $potentialite["yes"][$visite["Client"]["potentialite"]] = 1;
                else
                    $potentialite["yes"][$visite["Client"]["potentialite"]] = $potentialite["yes"][$visite["Client"]["potentialite"]] + 1;

                //-------------------------------------------------Specialite-----------------------------------
                if (!isset($categorie["yes"][$visite["Client"]["category_id"]]))
                    $categorie["yes"][$visite["Client"]["category_id"]] = 1;
                else
                    $categorie["yes"][$visite["Client"]["category_id"]] = $categorie["yes"][$visite["Client"]["category_id"]] + 1;
            }


            //recuperation des clients qui ne sont pas visiter entre les deux date choisi
            $clients_id = 0;
            foreach ($clients as $key => $value) {
                $clients_id .= ',' . $key;
            }
            $clients_id = trim($clients_id, "0,");
            $nonvisites = $this->Client->query(" SELECT * FROM (
                                select users.name,client_id from affectations,users,listes where affectations.liste_id=listes.id
                                and listes.user_id =users.id and users.id in ($ids) and listes.archive=1 and  valide=1 and client_id not in($clients_id)
                               GROUP BY client_id) temp_table");
            $clientnonvisiters = 0;
            foreach ($nonvisites as $value) {
                $clientnonvisiters .= "," . $value["temp_table"]["client_id"];
            }
            $this->Client->recursive = -1;
            $clientnonvisites = $this->Client->find('all', array("conditions" => array("Client.id in ($clientnonvisiters) and $querynonvister")));

            $i = 0;
            foreach ($clientnonvisites as $visite) {
                /*$j = 0;
                foreach ($nonvisites as $value) {
                    if ($visite["Client"]["id"] = $value["temp_table"]["client_id"]) {
                        $clientnonvisites[$i]["Client"]["user"] = $value["temp_table"]["name"];
                        unset($nonvisites[$j]);
                        break;
                    }
                    $j++;
                }*/
                $i++;
                //-------------------------------------------------Activité-----------------------------------
                $visite["Client"]["activite"] = ucfirst($visite["Client"]["activite"]);
                if (!isset($activite["non"][$visite["Client"]["activite"]]))
                    $activite["non"][$visite["Client"]["activite"]] = 1;
                else
                    $activite["non"][$visite["Client"]["activite"]] = $activite["non"][$visite["Client"]["activite"]] + 1;
                //-------------------------------------------------Potentialite-----------------------------------
                if (!isset($potentialite["non"][$visite["Client"]["potentialite"]]))
                    $potentialite["non"][$visite["Client"]["potentialite"]] = 1;
                else
                    $potentialite["non"][$visite["Client"]["potentialite"]] = $potentialite["non"][$visite["Client"]["potentialite"]] + 1;

                //-------------------------------------------------Specialite-----------------------------------
                if (!isset($categorie["non"][$visite["Client"]["category_id"]]))
                    $categorie["non"][$visite["Client"]["category_id"]] = 1;
                else
                    $categorie["non"][$visite["Client"]["category_id"]] = $categorie["non"][$visite["Client"]["category_id"]] + 1;
            }
            // debug($clients);
            $nombredeclientvisiter = count($clients);
            $this->set(compact("brochures", "activite", "potentialite", "categorie", "frequences", "ordredeprentation", "maxOrderValue", "nombredeclientvisiter", "clientnonvisites"));
        }


        //Donner a envoyé
        $categories = $this->Category->find('list');
        $lignes = $this->User->Ligne->find('list');
        $types = $this->Client->Type->find("list");
        $secteurs = $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), "group" => array("Secteur.region")));
        $allsecteurs = $this->Secteur->find("list");
        //Envoie des VMP 
        $equipes = array();
        if (AuthComponent::user('role') == 'Super viseur') {
            $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            foreach ($user as $u) {
                if ($u['User1']['archive'] != -1)
                    $users[$u["User1"]["id"]] = $u["User1"]["name"];
            }
            $u = $this->User->findById(AuthComponent::user('id'));
            $users[$u["User"]["id"]] = $u["User"]["name"];
        } else {
            $this->User->recursive = -1;
            $supers = $this->User->find("all", array('conditions' => array('User.archive' => 1, "User.role in('Super viseur')")));
            foreach ($supers as $super) {
                $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]["id"])));
                foreach ($user as $u) {
                    if ($u['User1']['archive'] != -1)
                        'id' . $equipes[$super["User"]["id"]][$u["User1"]["id"]] = $u["User1"]["name"];
                    //$equipes["Equipe ".$super["User"]["name"]][] = $u["User1"]["id"];
                }
                //$equipes["Equipe ".$super["User"]["name"]][$super["User"]["id"]] = $super["User"]["name"];
            }


            $users = $this->User->find("list", array('conditions' => array(
                'User.archive' => 1,
                "User.role in('Coordinateur','Super viseur','VMP')"
            )));
        }
        
        // debug($visites,0,0);
        // exit();
        $this->set(compact("allsecteurs", "visites", "query", "categories", "secteurs", "dateaafficherdansleview", "users", "equipes", 'lignes', 'types', "p_presanter"));

        
    }

    function statclient()
    {
        $clients = array();
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->loadModel("Client");
        $this->Client->recursive = -1;
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->loadModel('Apartient');
        $this->User->Ligne->recursive = -1;
        $this->loadModel('Affectation');
        $this->Affectation->recursive = -1;

        $query = " Client.archive=1 ";

        if ($this->request->is('post')) {
            //state pour toutes la base 
            $infos = array();
            $requete = "SELECT tel FROM clients HAVING LENGTH(tel) >9";
            $infos["tel"] = $this->User->query($requete);
            $infos["tel"] = count($infos["tel"]);
            $requete = "SELECT fixe FROM clients HAVING LENGTH( fixe ) >9";
            $infos["fixe"] = $this->User->query($requete);
            $infos["fixe"] = count($infos["fixe"]);
            $requete = "SELECT fax FROM clients HAVING LENGTH( fax ) >10";
            $infos["fax"] = $this->User->query($requete);
            $infos["fax"] = count($infos["fax"]);
            $requete = "SELECT longitude FROM clients HAVING LENGTH( longitude ) >5";
            $infos["gps"] = $this->User->query($requete);
            $infos["gps"] = count($infos["gps"]);
            $requete = "SELECT mail FROM clients HAVING LENGTH( mail ) >6";
            $infos["mail"] = $this->User->query($requete);

            $infos["mail"] = count($infos["mail"]);
            $requete = "SELECT count(id) FROM clients";
            $infos["total"] = $this->User->query($requete);
            $infos["total"] = $infos["total"][0][0]["count(id)"];
            $this->set(compact("infos"));

            //------------------Fin State pour toutes la base
            //----------------------------activité---------------------------
            if (!empty($this->request->data["activite"])) {
                $query = $query . " and Client.activite='" . $this->request->data["activite"] . "'";
            }
            //----------------------------Type client---------------------------
            if (!empty($this->request->data["type"])) {
                $types = 0;
                foreach ($this->request->data["type"] as $key => $value)
                    $types = $types . "," . $value;
                $query = $query . " and Client.type_id in ($types)";
            }
            //----------------------Seteurs------------------------
            if (!empty($this->request->data["secteur"])) {
                $secteur = 0;
                foreach ($this->request->data["secteur"] as $key => $value) {
                    $region = $this->Secteur->findById($value);
                    $region = $this->Secteur->find('list', array("conditions" => array("Secteur.code_region" => $region["Secteur"]["code_region"])));
                    foreach ($region as $k => $v) {
                        $secteur = $secteur . "," . $k;
                    }
                }
                $query = $query . " and Client.secteur_id in ($secteur)";
            }
            //--------------------------------Les categories---------------------------
            if (!empty($this->request->data["category"])) {
                $spesialite = 0;
                foreach ($this->request->data["category"] as $key => $value)
                    $spesialite = $spesialite . "," . $value;
                $query = $query . " and Client.category_id in ($spesialite)";
            }
            //--------------------------------------------Potentialité
            if (!empty($this->request->data["potentialite"])) {
                $potentialite = "'0'";
                foreach ($this->request->data["potentialite"] as $key => $value)
                    $potentialite = $potentialite . ",'" . $value . "'";
                $query = $query . " and Client.potentialite in ($potentialite)";
            }
            //----------------------------Lignes ---------------------------
            if (!empty($this->request->data["ligne"])) {
                $ids = 0;
                foreach ($this->request->data["ligne"] as $key => $value)
                    $ids .= "," . $value;
                $user = $this->User->find('all', array('conditions' => array("User.ligne_id in ($ids)")));
                $ids = 0;
                foreach ($user as $u) {
                    if ($u['User']['archive'] != -1)
                        $ids .= "," . $u['User']['id'];
                }
                $listes = $this->User->Liste->find("list", array("conditions" => array("Liste.user_id in ($ids)")));
                $ids = 0;
                foreach ($listes as $k => $v)
                    $ids .= "," . $k;
                $affectations = $this->Affectation->find("list", array(
                    'fields' => array('id', 'client_id'),
                    "conditions" => array("Affectation.valide" => 1, "Affectation.liste_id in($ids) GROUP BY client_id")
                ));
                $ids = 0;
                foreach ($affectations as $k => $v)
                    $ids .= "," . $v;
                $query = $query . " and Client.id in ($ids)";
            }
            //-------------------------------Fin Ligne---------------------------//
            $ids = 0;
            if (!empty($this->request->data["users"])) {
                foreach ($this->request->data["users"] as $key => $value)
                    $ids .= "," . $value;
            } else if (AuthComponent::user('role') == 'Super viseur') {
                $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                $ids = AuthComponent::user('id');
                foreach ($user as $u) {
                    if ($u['User1']['archive'] != -1)
                        $ids .= "," . $u['Apartient']['user1_id'];
                }
            } else {
                $users = $this->User->find("list", array('conditions' => array(
                    'User.archive' => 1,
                    "User.role in('Coordinateur','Super viseur','VMP')"
                )));
                foreach ($users as $key => $value)
                    $ids .= "," . $key;
            }
            $listes = $this->User->Liste->find("list", array("conditions" => array("Liste.user_id in ($ids)")));
            $ids = 0;
            foreach ($listes as $k => $v)
                $ids .= "," . $k;
            $affectations = $this->Affectation->find("list", array(
                'fields' => array('id', 'client_id'),
                "conditions" => array("Affectation.valide" => 1, "Affectation.liste_id in($ids) GROUP BY client_id")
            ));
            $ids = 0;
            foreach ($affectations as $k => $v)
                $ids .= "," . $v;
            $query = $query . " and Client.id in ($ids) ";


            //echo $query;
            //debug($this->request->data);
            $clients = $this->Client->find("all", array("conditions" => array("$query")));
            $activite = $this->request->data["activite"];


            $this->set(compact("activite",  "clients"));
        }





        //Donner a envoyé
        $categories = $this->Category->find('list', array('condtions' => array('Category.archive' => '1')));
        $lignes = $this->User->Ligne->find('list');
        $secteurs = $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), "group" => array("Secteur.region")));
        //Envoie des VMP 
        $equipes = array();
        if (AuthComponent::user('role') == 'Super viseur') {
            $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            foreach ($user as $u) {
                if ($u['User1']['archive'] != -1)
                    $users[$u["User1"]["id"]] = $u["User1"]["name"];
            }
            $u = $this->User->findById(AuthComponent::user('id'));
            $users[$u["User"]["id"]] = $u["User"]["name"];
        } else {
            $this->User->recursive = -1;
            $supers = $this->User->find("all", array('conditions' => array('User.archive' => 1, "User.role in('Super viseur')")));
            foreach ($supers as $super) {
                $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]["id"])));
                foreach ($user as $u) {
                    if ($u['User1']['archive'] != -1)
                        'id' . $equipes[$super["User"]["id"]][$u["User1"]["id"]] = $u["User1"]["name"];
                    //$equipes["Equipe ".$super["User"]["name"]][] = $u["User1"]["id"];
                }
                //$equipes["Equipe ".$super["User"]["name"]][$super["User"]["id"]] = $super["User"]["name"];
            }


            $users = $this->User->find("list", array('conditions' => array(
                'User.archive' => 1,
                "User.role in('Coordinateur','Super viseur','VMP')"
            )));
        }
        $this->set(compact("query", "categories", "secteurs",  "users", "equipes", 'lignes', 'clients'));
    }





    function system_odp()
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->loadModel("Client");
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->loadModel('Apartient');
        $this->User->Ligne->recursive = -1;

        $dateaafficherdansleview = "";
        $date_debut = date("Y-01-01");
        $date_fin = date("Y-m-d");

        $query = " Visite.archive=1 ";
        $queryclient = " Client.archive=1 ";
        $querynonvister = " Client.archive=1 ";

        $ordredeprentation = array();
        $categories_selectione = array();

        if ($this->request->is('post')) {
            if (!empty($this->request->data["date"])) {
                $dateaafficherdansleview = $this->request->data["date"];
                $date = explode(" -- ", $this->request->data["date"]);
                $date_debut = $date[0];
                $date_fin = $date[1];
                $date = " and (DATE(Visite.date) BETWEEN '$date[0]' AND '$date[1]') ";
                $query = $query . " " . $date;
            }

            //----------------------------activité---------------------------
            if (!empty($this->request->data["activite"])) {
                $queryclient = $queryclient . " and Client.activite='" . $this->request->data["activite"] . "'";
                $querynonvister .= " and Client.activite='" . $this->request->data["activite"] . "'";
            }
            //----------------------------Type client---------------------------
            if (!empty($this->request->data["type"])) {
                $types = 0;
                foreach ($this->request->data["type"] as $key => $value)
                    $types = $types . "," . $value;
                $queryclient = $queryclient . " and Client.type_id in ($types)";
                $querynonvister .= " and Client.type_id in ($types)";
            }
            //----------------------Seteurs------------------------
            if (!empty($this->request->data["secteur"])) {
                $secteur = 0;
                foreach ($this->request->data["secteur"] as $key => $value) {
                    $region = $this->Secteur->findById($value);
                    $region = $this->Secteur->find('list', array("conditions" => array("Secteur.region" => $region["Secteur"]["region"])));
                    foreach ($region as $k => $v) {
                        $secteur = $secteur . "," . $k;
                    }
                }
                $queryclient = $queryclient . " and Client.secteur_id in ($secteur)";
                $querynonvister .= " and Client.secteur_id in ($secteur)";
            }
            //--------------------------------Les categories---------------------------
            if (!empty($this->request->data["category"])) {
                $categories_selectione = $this->request->data["category"];
                $spesialite = 0;
                foreach ($this->request->data["category"] as $key => $value)
                    $spesialite = $spesialite . "," . $value;
                $queryclient = $queryclient . " and Client.category_id in ($spesialite)";
                $querynonvister .= " and Client.category_id in ($spesialite)";
            }
            //--------------------------------------------Potentialité
            if (!empty($this->request->data["potentialite"])) {
                $potentialite = "'0'";
                foreach ($this->request->data["potentialite"] as $key => $value)
                    $potentialite = $potentialite . ",'" . $value . "'";
                $queryclient = $queryclient . " and Client.potentialite in ($potentialite)";
                $querynonvister .= " and Client.potentialite in ($potentialite)";
            }
            //----------------------------Lignes ---------------------------
            if (!empty($this->request->data["ligne"])) {
                $ids = 0;
                foreach ($this->request->data["ligne"] as $key => $value)
                    $ids .= "," . $value;
                $user = $this->User->find('list', array('conditions' => array("User.ligne_id in ($ids) and User.archive!=-1")));
                $ids = 0;
                foreach ($user as $k => $name) {
                    $ids .= ",$k";
                }
                $query = $query . " and Visite.user_id in ($ids)";
            }
            //-------------------------------Fin Ligne---------------------------//
            else {
                if (!empty($this->request->data["users"])) {
                    $ids = 0;
                    foreach ($this->request->data["users"] as $key => $value)
                        $ids .= "," . $value;
                    $query = $query . " and Visite.user_id in ($ids)";
                } else if (AuthComponent::user('role') == 'Super viseur') {
                    $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                    $ids = AuthComponent::user('id');
                    foreach ($user as $u) {
                        if ($u['User1']['archive'] != -1)
                            $ids .= "," . $u['Apartient']['user1_id'];
                    }
                    $query = $query . " and Visite.user_id in ($ids)";
                } else {
                    $users = $this->User->find("list", array('conditions' => array(
                        'User.archive' => 1,
                        "User.role in('Coordinateur','Super viseur','VMP')"
                    )));
                    $ids = 0;
                    foreach ($users as $key => $value)
                        $ids .= "," . $key;
                }
            }

            //echo $query;
            //debug($this->request->data);
            $this->Client->recursive = -1;
            $this->Client->Visite->recursive = -1;
            $clients = $this->Client->find("all", array("conditions" => array("$queryclient ")));
            $clients_id = 0;
            foreach ($clients as $c) {
                $clients_id = $clients_id . "," . $c["Client"]["id"];
            }

            $visites = $this->Client->Visite->find("all", array("conditions" => array("$query and Visite.client_id in($clients_id)")));

            $visites_id = 0;
            foreach ($visites as $v) {
                $visites_id = $visites_id . "," . $v["Visite"]["id"];
            }
            //------------------------------Les clientss-------------------//
            $clients = Hash::combine($clients, '{n}.Client.id', '{n}');
            for ($i = 0; $i < count($visites); $i++)
                $visites[$i]["Client"] = $clients[$visites[$i]["Visite"]["client_id"]]["Client"];
            //------------------------------------Fin les clients-----------------------------//
            //------------------------------Les Visiteordre-------------------//
            $this->loadModel("Visiteordre");
            $this->Visiteordre->recursive = -1;
            $visiteordres = $this->Visiteordre->find("all", array("conditions" => array("Visiteordre.visite_id in ($visites_id) order by id asc")));
            $groupedVisiteordres = array();

            foreach ($visiteordres as $visiteordre) {
                $visiteId = $visiteordre['Visiteordre']['visite_id'];
                $visiteordreId = $visiteordre['Visiteordre']['id'];

                // Si la clé de visite n'existe pas encore dans le tableau $groupedVisiteordres, créez-la
                if (!isset($groupedVisiteordres[$visiteId])) {
                    $groupedVisiteordres[$visiteId] = array();
                }

                // Ajoutez le visite ordre au tableau correspondant à la visite_id
                $groupedVisiteordres[$visiteId][$visiteordreId] = $visiteordre['Visiteordre'];
            }
            for ($i = 0; $i < count($visites); $i++) {
                if (isset($groupedVisiteordres[$visites[$i]["Visite"]["id"]]))
                    $visites[$i]["Visiteordre"] = $groupedVisiteordres[$visites[$i]["Visite"]["id"]];
            }
            //------------------------------------Fin les Visiteordre-----------------------------//
            //------------------------------Les Users-------------------//
            $this->loadModel("User");
            $users = $this->User->find("all");
            $users = Hash::combine($users, '{n}.User.id', '{n}');
            for ($i = 0; $i < count($visites); $i++)
                $visites[$i]["User"] = $users[$visites[$i]["Visite"]["user_id"]]["User"];
            //------------------------------------Fin les users-----------------------------//





            $clients = $activite = $potentialite = $categorie = $frequences = array();
            $activite["yes"]["Publique"] = 0;
            $activite["yes"]["Prive"] = 0;
            $activite["non"]["Publique"] = 0;
            $activite["non"]["Prive"] = 0;

            //ordre de présentation
            $this->loadModel("Brochure");
            $this->Brochure->recursive = -1;
            $brochures = $this->Brochure->find("all");

            $this->loadModel("Game");
            $gammes = $this->Game->find("list");

            $p_presanter = array();
            foreach ($visites as $visite) {
                $regionodp = $visite["User"]["region_odp"];
                //----------------------------Ordre de présentation-----------------------//

                if (!empty($visite["Visiteordre"])) {
                    $ordree = 0;
                    // debug($visite["Visiteordre"]);
                    foreach ($visite["Visiteordre"] as $ordre) {
                        $ordree++; //hada howa classement li kib9a itzad 
                        foreach ($brochures as $brochure) {
                            if ($brochure["Brochure"]["id"] == $ordre["brochure_id"]) {
                                if (!isset($ordredeprentation[$regionodp]))
                                    $ordredeprentation[$regionodp] = array();

                                if (!isset($ordredeprentation[$regionodp][$ordree]))
                                    $ordredeprentation[$regionodp][$ordree] = array();


                                // debug($ordre["brochure_id"]);
                                if (!isset($ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]])) //hna mazal brochure ma tpresentache
                                {

                                    $ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]] = array();
                                    $ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]]["nombre"] = 1;
                                    $ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]]["nom"] = $brochure["Brochure"]["name"];
                                    $ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]]["logo"] = $brochure["Brochure"]["logo"];
                                    // debug($ordree);
                                    // debug($ordredeprentation[$ordree][$ordre["brochure_id"]]);
                                } else //hna brochure tpresenta
                                    $ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]]["nombre"] = $ordredeprentation[$regionodp][$ordree][$ordre["brochure_id"]]["nombre"] + 1;
                                break;
                            }
                        }
                    }
                }

                //Recupération des clients Visiter 
                $clients[$visite["Visite"]["client_id"]] = $visite["Visite"]["client_id"];
            }
            $nombredeclientvisiter = count($visites);
            $this->set(compact("brochures", "categorie",  "ordredeprentation", "nombredeclientvisiter"));
        }



        //Donner a envoyé
        $categories = $this->Category->find('list');
        $lignes = $this->User->Ligne->find('list');
        $types = $this->Client->Type->find("list");
        $secteurs = $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), "group" => array("Secteur.region")));
        $allsecteurs = $this->Secteur->find("list");
        //Envoie des VMP 
        $equipes = array();
        if (AuthComponent::user('role') == 'Super viseur') {
            $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            foreach ($user as $u) {
                if ($u['User1']['archive'] != -1)
                    $users[$u["User1"]["id"]] = $u["User1"]["name"];
            }
            $u = $this->User->findById(AuthComponent::user('id'));
            $users[$u["User"]["id"]] = $u["User"]["name"];
        } else {
            $this->User->recursive = -1;
            $supers = $this->User->find("all", array('conditions' => array('User.archive' => 1, "User.role in('Super viseur')")));
            foreach ($supers as $super) {
                $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]["id"])));
                foreach ($user as $u) {
                    if ($u['User1']['archive'] != -1)
                        'id' . $equipes[$super["User"]["id"]][$u["User1"]["id"]] = $u["User1"]["name"];
                    //$equipes["Equipe ".$super["User"]["name"]][] = $u["User1"]["id"];
                }
                //$equipes["Equipe ".$super["User"]["name"]][$super["User"]["id"]] = $super["User"]["name"];
            }


            $users = $this->User->find("list", array('conditions' => array(
                'User.archive' => 1,
                "User.role in('Coordinateur','Super viseur','VMP')"
            )));
        }

        $odpobjectifs = $this->requestaction("/odpobjectifs/system_odp_objectif/0/$date_debut/$date_fin");

        //la liste des ordres
        $category = "";
        $cat_ordres = array();
        foreach ($categories_selectione as $key => $value)
            $category = $value;
        if ($category != "") {
            $this->loadModel("Brochureorganise");
            $this->Brochureorganise->recursive = -1;
            $data = $this->Brochureorganise->find("all", array("fields" => array("Brochureorganise.brochure_id", "Brochureorganise.ordre"), "conditions" => array("Brochureorganise.category_id" => $category)));
            foreach ($data as $v) {
                $cat_ordres[$v["Brochureorganise"]["brochure_id"]] = $v["Brochureorganise"]["ordre"];
            }
        }


        $ordredeprentation_regions = $ordredeprentation;
        $this->set(compact("brochures", "categorie",  "ordredeprentation_regions", "nombredeclientvisiter", "allsecteurs", "visites", "query", "categories", "secteurs", "dateaafficherdansleview", "users", "equipes", 'lignes', 'types', "p_presanter", 'odpobjectifs', "cat_ordres", "category"));
    }
}
