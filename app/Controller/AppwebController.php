<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'listes');

class AppwebController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'appmobile';
        header("Access-Control-Allow-Origin: *");
        $this->Auth->allow();
    }

    function index($code, $lan = "33.561861", $lon = "-7.601256")
    {
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (!isset($user["User"]["id"])) {
            echo "0";
            exit;
        }
        $user_id = $user["User"]["id"];

        $visiteencour = $this->get_last_visite($user["User"]["id"]);
        if (count($visiteencour) != 0) {
            $visiteencour["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visiteencour['Visite']['date']);
        }
        $this->set(compact("code", "lan", "lon", "visiteencour", "user_id"));
    }
    //supprimer une visite en cours
    function delete_visite($id, $user_id)
    {
        $this->loadModel("Visite");
        $visite = $this->Visite->find("count", array(
            "conditions" => array(
                "Visite.user_id" => $user_id,
                "Visite.id" => $id,
                "Visite.timer" => 0
            )
        ));
        if ($visite != 0) {
            $this->Visite->id = $id;
            $this->Visite->delete();
            $this->Session->setFlash('Visite supprimer');
        } else
            $this->Session->setFlash('Impossible de supprimer la visite!');
        $this->redirect($this->referer());
    }

    function view_client($code, $id = null, $lan = 0, $lon = 0)
    {
        $this->loadModel("Client");
        $this->Client->recursive = -1;
        $this->loadModel("Visite");
        $this->Visite->recursive = -1;
        $this->loadModel("Action");
        $this->Action->recursive = -1;
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));

        $client = $this->Client->findById($id);
        $secteur = $this->Client->Secteur->findById($client["Client"]["secteur_id"]);
        $category = $this->Client->Category->findById($client["Client"]["category_id"]);
        $client["Client"]["secteur"] = $secteur["Secteur"]["ville"] . " " . $secteur["Secteur"]["secteur"];
        $client["Client"]["category"] = $category["Category"]["name"];
        $users = $this->User->find("list");
        //$visite=$this->get_visite_encour($id);
        $visite = array();

        $date = date('Y-m-d'); // you can put any date you want
        $nbDay = date('N', strtotime($date));
        $monday = new DateTime($date);
        $sunday = new DateTime($date);

        $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
        $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');

        $vv = $this->Visite->find('all', array('conditions' => array("Visite.client_id =$id", " Visite.date between 
                   DATE_ADD(CURRENT_DATE(), INTERVAL -90 DAY) and DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY)", 'Visite.archive' => 1), 'order' => array('Visite.date desc')));

        $j = 0;
        foreach ($vv as $va) {
            $client["Client"]['Visite'][$j]['date'] = $va['Visite']['date'];
            $client["Client"]['Visite'][$j]['commentaire'] = $va['Visite']['commentaire'];
            $client["Client"]['Visite'][$j]['responsable'] = $users[$va['Visite']['user_id']];
            $j++;
        }


        $action = $this->Action->find('first', array('conditions' => array('Action.archive' => 2, "Action.client_id =$id", "Action.date_debut<='$date_debut'", "Action.date_fin>='$date_fin'")));

        $client["Client"]["Action"] = $action;
        //debug($client,0,0);
        $this->loadModel("Ligne");
        $lignespecialiteinfo = $this->Ligne->Lignespecialiteinfo->find("all", array("conditions" => array("Lignespecialiteinfo.ligne_id" => $user["User"]["ligne_id"], "Lignespecialiteinfo.category_id" => $client["Client"]["category_id"])));
        $visiteencour = $this->get_last_visite($user["User"]["id"]);

        $this->set(compact("code", 'client', "lignespecialiteinfo", "lan", "lon", "visiteencour"));
    }

    function set_chez_client($code, $id = null, $lan = 0, $lon = 0)
    {
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        $this->loadModel("Visite");
        $d["Visite"]["user_id"] = $user["User"]["id"];
        $d["Visite"]["client_id"] = $id;
        $d["Visite"]["latitude"] = $lan;
        $d["Visite"]["longitude"] = $lon;
        $d["Visite"]["date"] = date("Y-m-d H:i:s");
        $d["Visite"]["timer"] = 0;
        $this->Visite->create();
        $this->Visite->save($d);
        $this->Session->setFlash("La visite à démaré");
        $this->redirect(array('action' => 'index', $code, $lan, $lon));
    }



    function login()
    {
        if ($this->Auth->login()) {
            if (AuthComponent::user('archive') == 1) {
                $this->loadModel("User");
                $this->User->id = AuthComponent::user('id');
                $token = AuthComponent::user('id') . rand(111111, 99999999);
                $this->User->saveField("iemi", $token);
                if (isset($this->request->data["User"]["version"]))
                    $this->User->saveField("version", $this->request->data["User"]["version"]);
                echo $token;
                $this->Auth->logout();
            } else {
                $this->Auth->logout();
                echo '[]';
            }
        } else
            echo '[]';
        exit();
    }

    function logout($code)
    {
        $this->loadModel("User");
        $this->User->recursive = -1;

        // Find the user with specific conditions
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if ($user) {
            // Update the "iemi" field to null
            $this->User->id = $user['User']['id'];
            $this->User->saveField("iemi", "");
            echo '[]';
        } else {
            // Handle the case when user is not found
            echo '[]';
        }

        exit();
    }




    //function qui envoie feulle de route si il existe
    function clients($token = null, $lan, $lon)
    {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $token)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
        $code = $user["User"]["id"];
        $date = date('Y-m-d'); // you can put any date you want
        $nbDay = date('N', strtotime($date));
        $monday = new DateTime($date);
        $sunday = new DateTime($date);
        $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
        $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
        $this->loadModel('Feuilleroute');
        $this->Feuilleroute->recursive = -1;
        $date_debut_semaine = date("Y-m-d", strtotime('this week', time()));
        $listes = $this->Feuilleroute->find('all', array('conditions' => array('Feuilleroute.user_id' => $code, "Feuilleroute.date between '$date_debut_semaine' and '$date' ", 'Feuilleroute.valide' => 1)));

        //hadi permet de supprimer les clients qui sont déja visiter
        $this->loadModel('Visite');
        $visites = $this->Visite->find("list", array("fields" => array("Visite.client_id", "Visite.client_id"), "conditions" => array("Visite.user_id" => $code, "Visite.archive" => 1, "DATE(Visite.date) between '$date_debut_semaine' and '$date' ")));

        $ids = 0;
        foreach ($listes as $value) {
            $clientId = $value['Feuilleroute']['client_id'];
            if (!empty($clientId) && !isset($visites[$clientId])) {
                $ids = $ids . ',' . $clientId;
            }
        }

        /*$stockkamils=$this->stock_kamil($user["User"]["iemi"]);
		foreach($stockkamils as $idclient =>$stock)
			$ids = "$ids,$idclient";*/
        $clients = $this->Feuilleroute->query("select * from clients as Client where Client.id in($ids)");
        $this->loadModel('Action');
        $this->loadModel('Visite');
        $this->loadModel('Liste');
        $this->loadModel('Plantourne');
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $secteurss = $this->Secteur->find("all");
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $types = $this->Type->find('list');
        $categories = $this->Category->find('list');
        $data = array();
        $action = array();
        $visites = array();
        $listess = new ListesController;
        $this->Visite->recursive = -1;

        $actionss = $this->Action->find('all', array('conditions' => array('Action.archive' => 2, "Action.client_id in($ids)", "Action.date_debut<='$date_debut'", "Action.date_fin>='$date_fin'")));
        $actions = array();
        foreach ($actionss as $ac) {
            $actions[$ac["Action"]["client_id"]] = $ac;
        }
        for ($i = 0; $i < count($clients); $i++) {
            //if($i==4){debug($clients[$i]);exit();}

            $clients[$i]['Client']['visite'] = 0;
            $clients[$i]['Client']['categoryy_id'] = $clients[$i]['Client']['categoryy1_id'] = null;
            if ($clients[$i]['Client']['category1_id'] == null)
                $clients[$i]['Client']['category1_id'] = $clients[$i]['Client']['category_id'];
            $clients[$i]['Client']['categoryy_id'] = $categories[$clients[$i]['Client']['category_id']];
            $clients[$i]['Client']['categoryy1_id'] = $categories[$clients[$i]['Client']['category1_id']];

            //probléme dans app mobile ila kan medcin c bon si non ndiroh pharmacie 
            if ($clients[$i]['Client']['type_id'] == 2)
                $clients[$i]['Client']['typee_id'] = "Pharmacie";
            else
                $clients[$i]['Client']['typee_id'] = "Médecin";


            foreach ($secteurss as $s) {
                if ($clients[$i]['Client']['secteur_id'] == $s["Secteur"]["id"]) {
                    $secteur = $s;
                    break;
                }
            }

            $data[$i]['id'] = $clients[$i]['Client']['id'];
            $data[$i]['name'] = $clients[$i]['Client']['nom'] . ' ' . $clients[$i]['Client']['prenom'];
            $data[$i]['type'] = $clients[$i]['Client']['typee_id'];
            $data[$i]['category'] = $clients[$i]['Client']['categoryy_id'];
            $data[$i]['tandance'] = $clients[$i]['Client']['categoryy1_id'];
            $data[$i]['category_id'] = $clients[$i]['Client']['category_id'];
            $data[$i]['category1_id'] = $clients[$i]['Client']['category1_id'];
            $data[$i]['potentialite'] = $clients[$i]['Client']['potentialite'];
            $data[$i]['potentialitev2'] = $clients[$i]['Client']['potentialitev2'];
            $data[$i]['titre'] = $clients[$i]['Client']['titre'];
            $data[$i]['activite'] = $clients[$i]['Client']['activite'];
            $data[$i]['exercice'] = $clients[$i]['Client']['exercice'];
            $data[$i]['mail'] = $clients[$i]['Client']['mail'];
            $data[$i]['tel'] = $clients[$i]['Client']['tel'];
            $data[$i]['fixe'] = $clients[$i]['Client']['fixe'];
            $data[$i]['fax'] = $clients[$i]['Client']['fax'];
            $data[$i]['adress'] = $clients[$i]['Client']['adress'];
            $data[$i]['secteur'] = $secteur['Secteur']['region'] . ' ' . $secteur['Secteur']['ville'] . ' ' . $secteur['Secteur']['secteur'];
            $data[$i]['ville'] = $secteur['Secteur']['ville'];
            $data[$i]['longitude'] = $clients[$i]['Client']['longitude'];
            $data[$i]['latitude'] = $clients[$i]['Client']['latitude'];
            $data[$i]['action'] = 0;


            //----------------------------KAMIL-----------------//
            /*if(isset($stockkamils[$clients[$i]['Client']['id']]))
				{
					$data[$i]['kamil'] = $stockkamils[$clients[$i]['Client']['id']];
				}*/
            //------------------------------Fin KAMIL--------------//

            if (isset($actions[$clients[$i]['Client']['id']])) {
                $data[$i]['action'] = 1;
            }
        }

        $data = array_values($data);
        $data = $this->utf8ize($data);
        $code = $token;
        $this->set(compact("data", "code", "lan", "lon"));
    }


    


    function statistique($code = null, $lan, $lon, $date_debut = null, $date_fin = null)
    {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        //debug($user);
        if (empty($user)) {
            echo "[]";
            exit();
        }
        $date = date('Y-m-d'); // you can put any date you want
        $nbDay = date('N', strtotime($date));
        $monday = new DateTime($date);
        $sunday = new DateTime($date);
        $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
        $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');

        $this->loadModel('Visite');

        $listes = $this->requestAction('/listes/system_get_liste_for_user/' . $user['User']['id'] . "/$date_debut/$date_fin");
        $data = array();
        $data["objectif"] = array();
        $data["Médecin"]["nb_visiter"] = 0;
        $data["Médecin"]["objectif"] = 0;
        $data["Médecin"]["objectifjour"] = 0;
        $data["Médecin"]["jour"] = 0;
        $data["Médecin"]["globaljour"] = 0;
        $data["Pharmacie"]["nb_visiter"] = 0;
        $data["Pharmacie"]["objectif"] = 0;
        $data["Pharmacie"]["objectifjour"] = 0;
        $data["Pharmacie"]["jour"] = 0;
        $data["Pharmacie"]["globaljour"] = 0;
        foreach ($listes as $listee) {
            if ($listee['date']['date_fin'] > date('Y-m-d') && $listee['date']['date_debut'] <= date('Y-m-d')) {
                $progressinfo1 = $this->requestAction('/listes/system_get_progress_info_affectedandnoaffected/' . $listee['Liste']['id'] . "/" . $user['User']['id'] . "/" . $date_debut . "/" . $date_fin);
                $objectifs = $this->requestAction('/objectifs/system_get_objectif_by_date/' . $user['User']['id'] . "/" . $listee['date']['date_debut']);

                foreach ($progressinfo1 as $ob) {
                    foreach ($objectifs as $obj) {
                        if ($ob["type"]["type"] == $obj["Type"]["name"]) 
						{
                            $jour = $this->Visite->find("count", array("conditions" => array(
                                'Visite.archive' => '1', "Visite.user_id" => $user['User']['id'],
                                "DATE(Visite.date)" => date("Y-m-d"), "Client.type_id" => $obj["Type"]["id"])));
                            $data[$obj["Type"]["name"]]["nb_visiter"] = $ob["type"]["nb_visiter"];
                            $data[$obj["Type"]["name"]]["objectif"] = $obj["Objectif"]["objectif"];
                            if ($obj["Objectif"]["objectif"] == 0)
                                $data[$obj["Type"]["name"]]["objectifjour"] = 0;
                            else
                                $data[$obj["Type"]["name"]]["objectifjour"] = round(($ob["type"]["nb_visiter"] / $obj["Objectif"]["objectif"]), 2);
                            $data[$obj["Type"]["name"]]["jour"] = $jour;
                            if ($obj["Objectif"]["objectif"] == 0)
                                $data[$obj["Type"]["name"]]["globaljour"] = 0;
                            else
                                $data[$obj["Type"]["name"]]["globaljour"] = round(($jour * 5 / $obj["Objectif"]["objectif"]), 2);

                            break;
                        }
                    }
                }

                break;
            }
        }
        $dd = array();
        $gob = $gv = $gjour = $vj = 0;
        foreach ($data as $k => $d) {
            if ($k == "objectif")
                continue;
            $gob += $d["objectif"];
            $gv += $d["nb_visiter"];
            $gjour += $d["objectifjour"];
            $vj += $d["jour"];
        }
        $data["objectif"]["nb_visiter"] = $gv;
        $data["objectif"]["jour"] = $vj;
        if ($gob == 0)
            $data["objectif"]["global"] = 0;
        else
            $data["objectif"]["global"] = round(($gv / $gob), 2);
        if ($gjour == 0)
            $data["objectif"]["globaljour"] = 0;
        else
            $data["objectif"]["globaljour"] = round(($vj / $gjour) / 100, 2);

        // debug($data);
        // exit;
        $this->set(compact("data", "code", "lan", "lon"));
    }

    public function utf8ize($mixed)
    {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }

    function brochure($code = null, $lan, $lon)
    {
        $data = array();
        if ($code != null) {
            preg_match_all('!\d+!', $code, $cod);
            $user_id = $cod[0][0]; ///20121204;
            $this->loadModel('User');
            $this->User->recursive = -1;
            $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
            if (!empty($user)) {
                $this->loadModel("Brochureorganise");
                $this->loadModel("Game");
                $this->Brochureorganise->recursive = 1;
                $this->Game->recursive = -1;
                $gammes = $this->Game->find("list");
                $brochures = $this->Brochureorganise->find('all', array("conditions" => array("Brochureorganise.ligne_id" => $user["User"]["ligne_id"], 'Brochureorganise.ordre is not null', "Brochureorganise.brochure_id is not null"), "order" => "Brochureorganise.category_id,Brochureorganise.ordre"));
                $ids = array();

                foreach ($brochures as $b) {
                    if (in_array($b["Brochure"]["id"], $ids))
                        continue;
                    $ids[] = $b["Brochure"]["id"];
                    $d = array();
                    $d["Brochure"] = array();
                    $d["Brochure"]["id"] = $b["Brochure"]["id"];
                    $d["Brochure"]["name"] = $b["Brochure"]["name"];
                    $d["Brochure"]["category"] = $b["Category"]["name"];
                    $d["Brochure"]["file"] = $b["Brochure"]["file"];
                    $d["Brochure"]["gamme"] = "";
                    foreach ($gammes as $k => $v) {
                        if ($k == $b["Brochure"]["game_id"]) {
                            $d["Brochure"]["gamme"] = $v;
                            break;
                        }
                    }
                    $data[] = $d;
                }
            }
        }
        $this->set(compact("data", "code", "lan", "lon"));
    }

    function formations($code, $lan, $lon)
    {
        $this->loadModel('Formation');
        $formations = $this->Formation->find('all', array('conditions' => array('Formation.archive' => 1)));
        $this->set(compact("formations", "code", "lan", "lon"));
    }



    function maps($code = null, $latitude = null, $longitude = null)
    {
        $this->loadModel('User');
        $this->User->recursive = -1;
        if ($latitude == null) {
            echo "[]";
            exit();
        }
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }

        $this->loadModel('Action');
        $this->loadModel('Visite');
        $this->loadModel('Category');
        $this->loadModel('Secteur');
        $this->loadModel('Feuilleroute');
        $this->Secteur->recursive = -1;
        $this->loadModel('Stockvisite');
        $categories = $this->Category->find('list');
        $datnow = date("Y-m-d");
        $visites = array();


        //la liste des clients qui se trouve dans la fuille de route
        $date = date('Y-m-d');
        $date_debut_semaine = date("Y-m-d", strtotime('this week', time()));

        $visitez = $this->Visite->find("list", array("fields" => array("Visite.client_id", "Visite.client_id"), "conditions" => array("Visite.user_id" => $user["User"]["id"], "Visite.archive" => 1, "DATE(Visite.date) between '$date_debut_semaine' and '$date' ")));
        $clients_visiter = "0";
        foreach ($visitez as $k => $v)
            $clients_visiter = "$clients_visiter,$v";
        $clients_feuille_de_route = $this->Feuilleroute->find('all', array('conditions' => array('Feuilleroute.user_id' => $user["User"]["id"], "Feuilleroute.date between '$date_debut_semaine' and '$date' and Feuilleroute.client_id not in($clients_visiter)", 'Feuilleroute.valide' => 1)));

        $clients = $this->Action->query("SELECT *
					  , ( 6371  * acos( cos( radians($latitude) ) * cos( radians( Client.latitude ) ) * cos( radians( Client.longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(Client.latitude)) ) ) AS distance 
					FROM 
					  clients as Client
					  where Client.type_id=2 and Client.archive=1 and Client.id not in($clients_visiter)
					HAVING 
					  distance < 1
					  order by distance asc limit 30");
        for ($i = 0; $i < count($clients); $i++)
            $clients[$i]["Client"]["proche"] = 1;
        //debug($clients);exit();


        $stockkamils = $this->stock_kamil($user["User"]["iemi"]);
        $clientskamil = array();

        if (!empty($stockkamils)) {
            $idk = 0;
            foreach ($stockkamils as $idclient => $stock)
                $idk = "$idk,$idclient";
            $clientskamil = $this->Action->query("SELECT *
					  , ( 6371  * acos( cos( radians($latitude) ) * cos( radians( Client.latitude ) ) * cos( radians( Client.longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(Client.latitude)) ) ) AS distance 
					FROM 
					  clients as Client
					  where Client.type_id=2 and Client.archive=1 
					  AND Client.id NOT IN ($idk)
					HAVING 
					  distance < 10
					  order by distance asc limit 10");
            foreach ($clientskamil as $c) {
                $clients[] = $c;
            }
        }
        foreach ($clients_feuille_de_route as $value) {
            if (!empty($value['Feuilleroute']['client_id'])) {
                $clients[]["Client"] = $value['Client'];
            }
        }

        $data = array();
        $action = array();
        $visites = array();
        for ($i = 0; $i < count($clients); $i++) {
            //---------------------------------Stock Kamil------------------//
            $stock = $this->Stockvisite->find("first", array("conditions" => array("Stockvisite.client_id" => $clients[$i]['Client']['id']), "order" => array("Stockvisite.created desc")));
            $stockkamil = array();
            if (!empty($stock)) {
                $stockkamil["user"] = $stock["User"]["name"];
                $stockkamil["produit"] = $stock["Produit"]["name"];
                $stockkamil["stock"] = $stock["Stockvisite"]["quantite"];
                $stockkamil["date"] = explode(" ", $stock["Stockvisite"]["created"]);
                $stockkamil["date"] = $stockkamil["date"][0];
                $stockkamil["type"] = $stock["Stockvisite"]["type"];
            }
            //---------------------------------Fin stock Kamil------------------//
            $secteur = $this->Secteur->findById($clients[$i]['Client']['secteur_id']);

            $clients[$i]['Client']['visite'] = 0;
            $clients[$i]['Client']['categoryy_id'] = $clients[$i]['Client']['categoryy1_id'] = null;
            if ($clients[$i]['Client']['category1_id'] == null)
                $clients[$i]['Client']['category1_id'] = $clients[$i]['Client']['category_id'];
            $clients[$i]['Client']['categoryy_id'] = $categories[$clients[$i]['Client']['category_id']];
            $clients[$i]['Client']['categoryy1_id'] = $categories[$clients[$i]['Client']['category1_id']];
            $data[$i]['id'] = $clients[$i]['Client']['id'];
            $data[$i]['name'] = $clients[$i]['Client']['nom'] . ' ' . $clients[$i]['Client']['prenom'];
            $data[$i]['type'] = $clients[$i]['Client']['type_id'];
            $data[$i]['category'] = $clients[$i]['Client']['categoryy_id'];
            $data[$i]['tandance'] = $clients[$i]['Client']['categoryy1_id'];
            $data[$i]['type_id'] = $clients[$i]['Client']['type_id'];
            $data[$i]['category_id'] = $clients[$i]['Client']['category_id'];
            $data[$i]['category1_id'] = $clients[$i]['Client']['category1_id'];
            $data[$i]['potentialite'] = $clients[$i]['Client']['potentialite'];
            $data[$i]['potentialitev2'] = $clients[$i]['Client']['potentialitev2'];
            $data[$i]['date_recrutement'] = $clients[$i]['Client']['date_recrutement'];
            $data[$i]['titre'] = $clients[$i]['Client']['titre'];
            $data[$i]['activite'] = $clients[$i]['Client']['activite'];
            $data[$i]['exercice'] = $clients[$i]['Client']['exercice'];
            $data[$i]['mail'] = $clients[$i]['Client']['mail'];
            $data[$i]['tel'] = $clients[$i]['Client']['tel'];
            $data[$i]['fixe'] = $clients[$i]['Client']['fixe'];
            $data[$i]['fax'] = $clients[$i]['Client']['fax'];
            $data[$i]['adress'] = $clients[$i]['Client']['adress'];
            $data[$i]['secteur_id'] = $secteur['Secteur']['id'];
            $data[$i]['secteur'] = $secteur['Secteur']['region'] . ' ' . $secteur['Secteur']['ville'] . ' ' . $secteur['Secteur']['secteur'];
            $data[$i]['ville'] = $secteur['Secteur']['ville'];
            $data[$i]['longitude'] = $clients[$i]['Client']['longitude'];
            $data[$i]['latitude'] = $clients[$i]['Client']['latitude'];
            if (!isset($clients[$i]['Client']['proche']))
                $clients[$i]['Client']['proche'] = 0;
            $data[$i]['proche'] = $clients[$i]['Client']['proche'];

            //$data[$i]['username'] = $username;
            $nb_visite = $this->Visite->find('count', array('conditions' => array('Visite.archive' => 1, 'Visite.client_id' => $clients[$i]['Client']['id'], 'Visite.date >="' . $clients[$i]['Client']['date_recrutement'] . '"')));
            $data[$i]['visite'] = $nb_visite;
            $date = date("Y-m-d");
            $action = $this->Action->find('first', array('conditions' => array('Action.archive' => 2, 'Action.client_id' => $clients[$i]['Client']['id'], "Action.date_debut<='$date'", "Action.date_fin>='$date'")));
            $data[$i]['action'] = 0;
            if (count($action) != 0)
                $data[$i]['action'] = 1;


            //----------------------------KAMIL-----------------//
            if (isset($stockkamils[$clients[$i]['Client']['id']])) {
                $data[$i]['kamil'] = $stockkamils[$clients[$i]['Client']['id']];
            }
            //------------------------------Fin KAMIL--------------//

        }

        $data = array_values($data);

        $data = $this->utf8ize($data);

        $this->set(compact("data", "code", "latitude", "longitude"));
    }

    function boite($code, $lan, $lon)
    {
        $this->loadModel('User');
        $this->loadModel('Boiteidee');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
        if ($this->request->is('post')) {
            // Handle image upload
            debug($this->request->data);

            $this->Boiteidee->create();
            $this->request->data["Boiteidee"]["user_id"] = $user["User"]["id"];
            // $date = date('H-i-s');
            // $file = $this->request->data['Boiteidee']['image']['tmp_name'];
            // $ext = substr($this->request->data['Boiteidee']['image']['name'], -4);
            // if (!empty($file)) {
            //     $this->request->data['Boiteidee']['image'] = $date . '' . rand() . "$ext";
            //     move_uploaded_file($file, 'img/idee/' . $this->request->data['Boiteidee']['image']);
            // } else {
            //     $this->Session->setFlash(__('Merci de joindre un fichier'));
            //     return $this->redirect(array('action' => 'add'));
            // }


            if ($this->Boiteidee->save($this->request->data)) {
                $this->Session->setFlash("Votre idée a été soumise avec succès.");
                $this->redirect(array('action' => 'index', $code, $lan, $lon));
            } else {
                $this->Session->setFlash("Échec de l'enregistrement de votre idée.");
            }
        }
        $this->set(compact("code", "lan", "lon"));
    }

    private function uploadFile($file, $uploadPath)
    {
        if (move_uploaded_file($file['tmp_name'], $uploadPath . $file['name'])) {
            return true;
        } else {
            return false;
        }
    }

    function stock_kamil($code)
    {
        $this->loadModel('User');
        $this->loadModel('Stockvisite');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code, "ligne_id" => 5)));

        if (empty($user)) {
            return array();
        }
        $this->loadModel('Stockvisite');
        $stocks = $this->Stockvisite->find("all", array("conditions" => array("Stockvisite.produit_id in(120,121,122)"), "order" => array("Stockvisite.created desc")));

        $stockkamils = array();
        $stockkamil = array();
        foreach ($stocks as $stock) {
            $stockkamil = array();
            $stockkamil["user"] = $stock["User"]["name"];
            $stockkamil["produit"] = $stock["Produit"]["name"];
            $stockkamil["stock"] = $stock["Stockvisite"]["quantite"];
            $stockkamil["date"] = explode(" ", $stock["Stockvisite"]["created"]);
            $stockkamil["date"] = $stockkamil["date"][0];
            $stockkamil["type"] = $stock["Stockvisite"]["type"];
            $stockkamils[$stock["Client"]["id"]][] = $stockkamil;
        }
        return $stockkamils;
    }


    function get_last_visite($user_id, $client_id = null)
    {
        $this->loadModel("Visite");
        $this->Visite->recursive = 1;
        if ($client_id != null)
            $visite = $this->Visite->find("first", array("conditions" => array("Visite.user_id" => $user_id, "Visite.client_id" => $client_id, "Visite.timer='0' order by Visite.id desc")));
        else
            $visite = $this->Visite->find("first", array("conditions" => array("Visite.user_id" => $user_id, "Visite.timer='0' order by Visite.id desc")));
        return $visite;
    }

    function calcul_timer($timer, $date)
    {
        $seconds = strtotime($timer) - strtotime($date);
        $months = floor($seconds / (3600 * 24 * 30));
        $day = floor($seconds / (3600 * 24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);
        if ($seconds < 60)
            $time = $secs . " sec";
        else if ($seconds < 60 * 60)
            $time = $mins . " min";
        else //if($seconds < 24*60*60)            
            $time = $hours . " heure";
        return $time;
    }






    function rapport_medcin($code, $client_id, $latitude, $longitude, $visite_id, $timer = 0)
    {
        $this->layout = "mobile";
        $this->loadModel("User");
        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        $user_id = $user["User"]["id"];
        $d = date("Y-m-d");


        //$timer = date("Y-m-d") . " " . str_replace("-", ":", $timer);
        // $deja = $this->Visite->find('count', array('conditions' => array('Visite.archive' => '1', 'Visite.user_id' => $user_id, 'Visite.client_id' => $client_id, 'Visite.timer!="0"', "DATE(Visite.date)" => $d)));
        // if ($deja != 0) {
        //     $this->setFlash('Rapport envoyé');
        //     $this->redirect(array('action' => 'index', $code, $latitude, $longitude));
        // }
        $produits = "";
        $gammes = "";
        if ($this->request->is('post')) {
            // debug($this->request->data);exit();
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array('conditions' => array(
                            'Stockgadjet.user_id' => $user_id,
                            'Stockgadjet.echantillon_id' => $value['echantillon_id']
                        )));
                        $this->Stockgadjet->id = $stock['Stockgadjet']['id'];
                        $this->Stockgadjet->saveField('quantite', $stock['Stockgadjet']['quantite'] - $value['quantite']);
                        $echentient .= $value['echantillon_id'] . '-' . $value['quantite'] . "||";
                    }
                }
            }
            $this->request->data['Visite']['echantillons'] = rtrim($echentient, "||");

            if (!empty($this->request->data['Visite']['produits'])) {
                //debug($this->request->data['Visite']['produits']);
                foreach ($this->request->data['Visite']['produits'] as $value) {
                    $gammes = $gammes . "," . $value;
                }
                $gammes = ltrim($gammes, ',');
                $this->request->data['Visite']['produits'] = '*' . $gammes . "|" . $this->request->data['Produit']['nbr_boites'];
            }
            if (!empty($this->request->data['Visite']['produitsNP'])) {
                foreach ($this->request->data['Visite']['produitsNP'] as $value) {
                    $produits = $produits . "|" . $value;
                }
            }
            $produits = ltrim($produits, '|');
            $this->request->data['Visite']['produitsNP'] = $produits;
            //debug($this->request->data['Visite']);
            //***********************
            $object = "";
            $l = 0;
            $s = 0;
            $objections = "";
            if (isset($this->request->data['Visite']['produitO'])) {
                foreach ($this->request->data['Visite']['produitO'] as $v) {
                    $objections = "";
                    $obection = "";
                    $words = "";
                    for ($j = $s; $j < $s + 5; $j++) {
                        if (isset($this->request->data['Visite']['objection'][$j]))
                            if ($this->request->data['Visite']['objection'][$j] == 'prix') {
                                for ($i = $l; $i < $l + 3; $i++) {
                                    if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                        $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                                    }
                                }
                                $words = ltrim($words, "|");
                                $objection = $this->request->data['Visite']['objection'][$j] . "|" . $words . ",";
                                $objections = $objections . $objection;
                                $objections = ltrim($objections, "|");
                            } elseif (isset($this->request->data['Visite']['objection'][$j]) && $this->request->data['Visite']['objection'][$j] == 'indication') {
                                $objection = "";
                                $words = "";
                                for ($i = $l + 3; $i < $l + 6; $i++) {
                                    if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                        $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                                    }
                                }
                                $words = ltrim($words, "|");
                                $objection = $this->request->data['Visite']['objection'][$j] . "|" . $words . ",";
                                $objections = $objections . $objection;
                            } elseif (isset($this->request->data['Visite']['objection'][$j]) && $this->request->data['Visite']['objection'][$j] == 'pathologie') {
                                $objection = "";
                                $words = "";
                                for ($i = $l + 6; $i < $l + 9; $i++) {
                                    if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                        $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                                    }
                                }
                                $words = ltrim($words, "|");
                                $objection = $this->request->data['Visite']['objection'][$j] . "|" . $words . ",";
                                $objections = $objections . $objection;
                            } elseif (isset($this->request->data['Visite']['objection'][$j]) && $this->request->data['Visite']['objection'][$j] == 'posologie') {
                                $objection = "";
                                $words = "";
                                for ($i = $l + 9; $i < $l + 12; $i++) {
                                    if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                        $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                                    }
                                }
                                $words = ltrim($words, "|");
                                $objection = $this->request->data['Visite']['objection'][$j] . "|" . $words . ",";
                                $objections = $objections . $objection;
                            } elseif (isset($this->request->data['Visite']['objection'][$j]) && $this->request->data['Visite']['objection'][$j] == 'presentation') {
                                $objection = "";
                                $words = "";
                                for ($i = $l + 12; $i < $l + 15; $i++) {
                                    if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                        $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                                    }
                                }
                                $words = ltrim($words, "|");
                                $objection = $this->request->data['Visite']['objection'][$j] . "|" . $words . ",";
                                $objections = $objections . $objection;
                            }
                    }
                    $object = $object . '||' . $v . ';' . $objections;
                    $l = $l + 15;
                    $s = $s + 5;
                }
            }
            //echo $object;
            //***********************
            //debug($this->request->data['objections']['mot_cles'][0]);
            if (!empty($objections)) {
                $this->request->data['Visite']['objection'] = "#" . ltrim($object, "||");
            } else {
                $this->request->data['Visite']['objection'] = $objections;
            }
            if (!isset($this->request->data['Visite']['concurrence_p']) || is_array($this->request->data['Visite']['concurrence_p']))
                $this->request->data['Visite']['concurrence_p'] = "";

            //debug($objections);
            //debug($this->request->data['Visite']['produits']);
            //******
            $visite = $this->Visite->findById($visite_id);
            $this->request->data["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visite['Visite']['date']);

            $this->Visite->id = $visite_id;
            if ($this->Visite->save($this->request->data)) {
                $visite_id = $this->Visite->id;
                $this->stock_ordre($this->request->data["Visite"]["order"], $visite_id);

                $this->Session->setFlash('Rapport envoyé');
            } else {
                $this->Session->setFlash('Erreur dans le rapport, merci de réessayer');
            }
            $this->redirect(array('action' => 'index', $code, $latitude, $longitude));
        }

        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array('conditions' => array(
            'Stockgadjet.user_id' => $user_id,
            'Stockgadjet.quantite>0'
        )));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));

        $this->Visite->Client->recursive = -1;
        $client = $this->Visite->Client->findById($client_id);
        $ordres = $this->system_get_ordre($user["User"]["ligne_id"], $client["Client"]["category_id"]);
        //-----------------------Fin---------------------
        $this->set(compact('code', 'latitude', "longitude", "user_id", 'stock', "client_id", "infosclient", "produits", "games", "produits_stock", "ordres", "visite_id"));
    }

    function rapport_pharmacie($code, $client_id, $latitude, $longitude, $visite_id)
    {
        $this->layout = "mobile";
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));


        if (empty($user)) {
            echo "[]";
            exit();
        }

        $user_id = $user["User"]["id"]; //1;
        $d = date('Y-m-d');

        $this->loadModel('Visite');
        $deja = $this->Visite->find('count', array('conditions' => array('Visite.archive' => '1', 'Visite.user_id' => $user_id, 'Visite.client_id' => $client_id, "DATE(Visite.date)" => $d)));

        // if ($deja != 0) {
        //     $this->setFlash('Rapport envoyé');
        //     $this->redirect(array('action' => 'index', $code, $latitude, $longitude));
        //     //$this->Session->setFlash("Rapport ajouté plusieurs fois, seul le premier qui est pris en considération ");
        //     //return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
        // }

        $produits = "";
        $gammes = "";

        if ($this->request->is('post')) {

            // debug($this->request->data);exit();
            // if (strlen($this->request->data["Visite"]['date']) < 3)
            //     $this->request->data["Visite"]['date'] = date('Y-m-d H:i:s');
            //ce petit code me permet de savoir si l'envoie du formulaire est envoyer deux fois probléme de con 
            //---------------Fin de code de visite multiple
            //$this->Visite->create();
            $this->Visite->id = $visite_id;
            $visite = $this->Visite->findById($visite_id);
            $this->request->data["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visite['Visite']['date']);

            //code pour pharmacie
            $this->Visite->Client->recursive = -1;
            $client_info = $this->Visite->Client->findById($client_id);
            if ($client_info["Client"]["type_id"] == 2) {
                //----------------liste des produits partenaire de CONSEIL------------
                if (!empty($this->request->data["Visite"]["produits"]) && isset($this->request->data["Visite"]["produitschoix"]) && $this->request->data["Visite"]["produitschoix"] != "") {
                    $produits = "*";
                    foreach ($this->request->data["Visite"]["produits"] as $k => $v)
                        $produits = $produits . $v . ",";
                    $produits = rtrim($produits, ", ");
                    $this->request->data["Visite"]["produits"] = $produits . "|" . $this->request->data["Visite"]["produitschoix"];
                } else
                    $this->request->data["Visite"]["produits"] = null;
                //-------------liste des produits partenairede CONSEIL----------------//
                if (!empty($this->request->data["Visite"]["produitsNP"]) && isset($this->request->data["Visite"]["produitsNPchoix"]) && $this->request->data["Visite"]["produitsNPchoix"] != "") {
                    $produits = "*";
                    foreach ($this->request->data["Visite"]["produitsNP"] as $k => $v)
                        $produits = $produits . $v . ",";
                    $produits = rtrim($produits, ", ");
                    $this->request->data["Visite"]["produitsNP"] = $produits . "|" . $this->request->data["Visite"]["produitsNPchoix"];
                } else
                    $this->request->data["Visite"]["produitsNP"] = null;
                //-------------------Noms des principauxprescripteurs
                if (!empty($this->request->data["Visite"]["prescripteurs"])) {
                    $produits = "";
                    foreach ($this->request->data["Visite"]["prescripteurs"] as $k => $v)
                        $produits = $produits . $v . "|";
                    $this->request->data["Visite"]["prescripteurs"] = rtrim($produits, "|");
                } else
                    $this->request->data["Visite"]["prescripteurs"] = null;
                //----------------------------Veille---------------------//
                if (!empty($this->request->data["Visite"]["objection"])) {
                    $info = "";
                    foreach ($this->request->data["Visite"]["objection"] as $value) {
                        if ($value["produit"] != "" && $value["plv"] != "" && $value["emplacement"] != "" && $value["stock"] != "")
                            $info = $info . ',' . $value["produit"] . '|' . $value["plv"] . '|' . $value["emplacement"] . '|' . $value["stock"];
                    }
                    $this->request->data["Visite"]["objection"] = ltrim($info, ",");
                } else
                    $this->request->data["Visite"]["objection"] = null;
                //--------------------------concurrence_p---------------------------------
                if (!empty($this->request->data["Visite"]["concurrence_p"])) {
                    $info = "";
                    foreach ($this->request->data["Visite"]["concurrence_p"] as $value) {
                        if ($value["produit"] != "" && $value["produitconcurant"] && $value["plv"] != "" && $value["emplacement"] != "" && $value["offre"] && $value["agressivite"] && $value["stock"] != "")
                            $info = $info . ',' . $value["produit"] . '|' . $value["produitconcurant"] . '|' . $value["plv"]
                                . '|' . $value["emplacement"] . '|' . $value["offre"] . '|' . $value["agressivite"] . '|' . $value["stock"];
                    }
                    $this->request->data["Visite"]["concurrence_p"] = ltrim($info, ",");
                } else
                    $this->request->data["Visite"]["concurrence_p"] = null;
                if ($this->Visite->save($this->request->data)) {
                    //--------------------Systeme dial stock produit 3and les pharmacies-----------//
                    if (isset($this->request->data["Stockvisite"])) {
                        $this->loadModel("Stockvisite");
                        foreach ($this->request->data["Stockvisite"] as $stock) {
                            if ($stock["quantite"] == "")
                                continue;
                            $stock["visite_id"] = $this->Visite->id;
                            $stock["client_id"] = $client_id;
                            $stock["user_id"] = $user_id;
                            $stockvisite = array();
                            $stockvisite["Stockvisite"] = $stock;
                            $this->Stockvisite->create();
                            //debug($stockvisite);
                            $this->Stockvisite->save($stockvisite);
                        }
                    }

                    //-----------------------------Fin Systeme de stock produits-------------------//
                    $this->Session->setFlash('Rapport envoyé');
                    $this->redirect(array('action' => 'index', $code, $latitude, $longitude));
                    //$this->Session->setFlash(__('Rapport ajouté'));
                    //return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
                } else {
                    $this->Session->setFlash('Erreur dans le rapport, merci de réessayer');
                    $this->redirect(array('action' => 'index', $code, $latitude, $longitude));
                    //$this->Session->setFlash("Erreur dans le rapport, merci de réessayer");
                    //return $this->redirect();
                }
            }
        }

        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array('conditions' => array(
            'Stockgadjet.user_id' =>  $user_id,
            'Stockgadjet.quantite>0'
        )));

        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
        //-----------------------Fin---------------------

        //ila kant la visite pour un pharmatie je doit envoyé la liste des clients li kainin hdah
        $clients = array();
        if ($infosclient[0]['clients']['type_id'] == "2") {
            $this->Client->recursive = -1;
            $vv = $this->Client->find("all", array(
                'fields' => array('Client.id', 'Client.nom', 'Client.prenom'),
                'conditions' => array('Client.type_id' => 1, 'Client.secteur_id' => $infosclient[0]['clients']['secteur_id'])
            ));
            foreach ($vv as $va) {
                $clients['Client'][$va['Client']['id']] = $va['Client']['nom'] . " " . $va['Client']['prenom'];
            }
        }
        $this->set(compact('code', 'latitude', "longitude", "user_id", 'stock', 'timer', "client_id", "infosclient", "produits", "games", 'clients', "produits_stock", "visite_id","user"));
    }

    //hada dial ordre de produit a afficher
    function system_get_ordre($ligne_id, $category_id)
    {

        $this->loadModel("Brochure");
        $data = $this->Brochure->Brochureorganise->find("all", array("conditions" => array("Brochureorganise.ligne_id" => $ligne_id, "Brochureorganise.category_id" => $category_id), "order" => array("Brochureorganise.ordre" => "ASC")));
        return $data;
    }


    function stock_ordre($ids, $visite_id)
    {
        $this->loadModel("Visiteordre");
        if ($ids != "") {
            $ids = rtrim($ids, ",");
            $ids = explode(",", $ids);
            foreach ($ids as $k => $v) {
                $this->Visiteordre->create();
                $d = array();
                $d["Visiteordre"]["brochure_id"] = $v;
                $d["Visiteordre"]["visite_id"] = $visite_id;
                $this->Visiteordre->save($d);
            }
        }
        return "";
    }
}
