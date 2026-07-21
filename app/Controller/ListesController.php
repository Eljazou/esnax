<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'Objectifs');

class ListesController extends AppController
{

    public $components = array('Paginator');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('listeretard', "system_get_progress_info_affectedandnoaffected", "system_get_liste_for_user");
    }




    function getlisteforallclients()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(250);

        $listes = $this->Liste->find("all", array('conditions' => array('Liste.archive=1')));
        //debug($listes,0,0);exit();
        $data = array();
        foreach ($listes as $liste) {
            if ($liste["User"]["id"] == 1 || $liste["User"]["id"] == 4 || $liste["User"]["id"] == 2)
                continue;
            if ($liste["User"]["archive"] == 1) {
                $liste["User"]["name"] = $liste["User"]["name"] . "--" . $liste["Liste"]["name"];
                if (empty($data[$liste["User"]["name"]]["client"])) {
                    $data[$liste["User"]["name"]]["client"] = "0";
                }
                foreach ($liste["Affectation"] as $value) {
                    $data[$liste["User"]["name"]]["client"] = $value["client_id"] . "," . $data[$liste["User"]["name"]]["client"];
                }
            }
        }


        $this->loadModel("Client");
        $this->Client->recursive = -1;
        $da = array();
        foreach ($data as $key => $v) {
            $clients = $this->Client->find("all", array('conditions' => array("Client.id in(" . $v["client"] . ")")));
            $da[$key]["client"] = $clients;
        }
        $this->set("data", $da);
        $lignes = $this->Liste->query("select users.name ,lignes.name from users,lignes where lignes.id=users.ligne_id");
        $categories = $this->Client->Category->find("list");
        $this->Client->Secteur->recursive = -1;
        $secteurs = $this->Client->Secteur->find("all");
        $types = $this->Client->Type->find("list");
        $this->set(compact("lignes", "categories", "secteurs", "types"));
    }

    public function index()
    {
        $this->Liste->recursive = 0;
        $this->set('listes', $this->Paginator->paginate());
    }

    public function view($id = null, $date_debut = null, $date_fin = null)
    {

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        } else {
            $date = date('Y-m-d', strtotime(date('Y-m-d H:i:s') . ' +35 hour')); //had la date pour ajouter deux jour bach ysibo inta ydiro le FRoute
            //echo  date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +35 hour'));
            //$date = date('Y-m-d'); // La date normal 
            $nbDay = date('N', strtotime($date));
            $monday = new DateTime($date);
            $sunday = new DateTime($date);
            $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
            $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
            // $date_debut = date('Y-m-d', strtotime('2025-06-02'));
            // $date_fin = date('Y-m-d', strtotime('2025-07-07'));
        }
        if ($id != null && (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')) {
            $listes = $this->Liste->find('count', array('conditions' => array(
                'Liste.user_id' => AuthComponent::user('id'),
                'Liste.id' => $id,
                'Liste.archive' => 1
            )));
            if ($listes == 0)
                $id = null;
        }

        if ($id == null) {
            $listes = $this->Liste->find('list', array('conditions' => array('Liste.user_id' => AuthComponent::user('id'))));
            $liste_ids = '0';
            foreach ($listes as $key => $value)
                $liste_ids = $liste_ids . ",$key";

            $plans = $this->Liste->query("select * from plantournes as Plantourne where "
                . "date >='$date_debut' and date <'$date_fin' and  liste_id in($liste_ids)");
            if (empty($plans)) {
                $this->Session->setFlash("vous n'avez pas de liste en cours merci de contacter votre superviseur.");
                return $this->redirect(array('controller' => 'users', 'action' => 'view'));
            }
            $id = $plans[0]['Plantourne']['liste_id'];
        }
        if (!$this->Liste->exists($id)) {
            throw new NotFoundException(__('Liste invalide'));
        }
        $options = array('conditions' => array('Liste.' . $this->Liste->primaryKey => $id));
        $liste = $this->Liste->find('first', $options);
        $objectifs = new ObjectifsController;
        $objectifs = $objectifs->system_get_objectif_by_date($liste['User']["id"], $date_debut);
        $this->loadModel('Type');
        $this->Type->recursive = 0;
        $types = $this->Type->find('list');
        $ids = "0";
        foreach ($liste['Affectation'] as $value) {
            $ids = $ids . ',' . $value['client_id'];
        }
        $clients = $this->Liste->query("select * from clients as Client ,secteurs as Secteur  where Secteur.id=Client.secteur_id and  Client.id in($ids) order by potentialite asc");
        $this->loadModel('Action');
        $this->Action->recursive = -1;

        $date = date('Y-m-d');
        $actions = $this->Action->find('all', array('conditions' => array("Action.client_id in($ids)", "Action.date_debut<='$date'", "Action.date_fin>='$date'", 'Action.archive' => 2)));


        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $cats = $this->Category->find('list');
        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        $visites = $this->Visite->find('all', array('conditions' => array(
            "Visite.client_id in($ids)",
            "Visite.user_id" => $liste['Liste']['user_id'],
            'Visite.archive' => 1,
            "Visite.date between '$date_debut' and '$date_fin  23:59'"
        )));

        for ($i = 0; $i < count($clients); $i++) {

            $clients[$i]["Category"]["name"] = "---";
            if (isset($cats[$clients[$i]["Client"]["category_id"]]))
                $clients[$i]["Category"]["name"] = $cats[$clients[$i]["Client"]["category_id"]];
            $clients[$i]["Category1"]["name"] = "---";
            if (isset($cats[$clients[$i]["Client"]["category1_id"]]))
                $clients[$i]["Category1"]["name"] = $cats[$clients[$i]["Client"]["category1_id"]];

            $action = 0;
            foreach ($actions as $a) {
                if ($a["Action"]["client_id"] = $clients[$i]['Client']['id'])
                    $action++;
            }
            $clients[$i]['Client']['action'] = $action;
            $nombrevisites = 0;
            foreach ($visites as $v) {
                if ($v["Visite"]["client_id"] == $clients[$i]["Client"]["id"])
                    $nombrevisites++;
            }
            $clients[$i]["Client"]["visite"] = $nombrevisites;
        }

        $visit = array();
        foreach ($visites as $v) {
            $vdate = explode(' ', $v['Visite']['date']);
            $v['Visite']['date'] = $vdate[0];
            if (isset($visit[$v['Visite']['date']]))
                $visit[$v['Visite']['date']] = $visit[$v['Visite']['date']] + 1;
            else
                $visit[$v['Visite']['date']] = 1;
        }
        ksort($visit);


        $this->loadModel('Game');
        $produits = $this->Game->find('list');
        // debug($date_debut);
        $this->set(compact("visit", "id", 'produits', 'objectifs', 'liste', 'types', 'clients', 'date_debut', 'date_fin'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($user_id)
    {
        if ($this->request->is('post')) {
            $this->Liste->create();
            if ($this->Liste->save($this->request->data)) {
                $this->Session->setFlash(__('Liste Ajoutée'));
                return $this->redirect(array('action' => 'remplire', $this->Liste->id));
            } else {
                $this->Session->setFlash(__('La liste n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
        $this->Liste->User->recursive = -1;
        $users = $this->Liste->User->findById($user_id);
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Liste->exists($id)) {
            throw new NotFoundException(__('Liste invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Liste->save($this->request->data)) {
                $this->Session->setFlash(__('Liste modifiée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La liste n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Liste.' . $this->Liste->primaryKey => $id));
            $this->request->data = $this->Liste->find('first', $options);
        }
        $users = $this->Liste->User->find('list');
        $this->set(compact('users'));
    }

    function remplire($liste_id)
    {
        $liste = $this->Liste->findById($liste_id);
        if ($this->request->is('post')) {
            $this->Liste->id = $this->request->data['Affectation']['liste_id'];
            $this->Liste->saveField('name', $this->request->data['Affectation']['name']);
            $this->Liste->query("delete from affectations where liste_id=" . $this->request->data['Affectation']['liste_id']);
            foreach ($this->request->data['client'] as $key => $value) {
                $this->Liste->Affectation->create();
                $d = array();
                $d['Affectation']['liste_id'] = $this->request->data['Affectation']['liste_id'];
                $d['Affectation']['client_id'] = $value;
                if ($this->Liste->Affectation->save($d));
            }
            $this->Session->setFlash(__('Affectation effectuée'));
            return $this->redirect(array('action' => 'view', $this->request->data['Affectation']['liste_id']));
        } else {
            $affectations = $this->Liste->Affectation->find('all', array('conditions' => array('Affectation.valide=1', 'Affectation.liste_id' => $liste_id)));
            $this->loadModel('Secteur');
            $regions = $this->Secteur->find('all', array('group' => 'region'));
            $this->Secteur->recursive = -1;
            $secteurs = $this->Secteur->find('list');
            $this->loadModel('Type');
            $this->Type->recursive = -1;
            $types = $this->Type->find('list');
            $this->loadModel('Category');
            $this->Category->recursive = -1;
            $categories = $this->Category->find('list');
            $name = $liste['Liste']['name'];

            $this->set(compact('name', 'liste_id', 'regions', 'liste', 'types', 'categories', 'secteurs', 'affectations'));
        }
    }

    //demander par /listes/view/ 310
    //demander par /liste/detail_feuille_route 112
    //demander par /liste/feuilleroute 42
    //Demander par /apimobile/feuille_route 280
    function system_get_nombre_visite($client_id, $date_debut = null, $date_fin = null, $user_id = null)
    {
        if ($user_id == null)
            $user_id = AuthComponent::user('id');
        if ($date_debut == null || $date_fin == null) {
            $date = date('Y-m-d'); // you can put any date you want
            $nbDay = date('N', strtotime($date));
            $monday = new DateTime($date);
            $sunday = new DateTime($date);
            $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
            $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
        }
        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        $visites = $this->Visite->find('all', array('conditions' => array(
            'Visite.client_id' => $client_id,
            "Visite.user_id" => $user_id,
            'Visite.archive' => 1,
            "Visite.date between '$date_debut' and '$date_fin  23:59'"
        )));
        return $visites;
    }

    function system_get_liste($id)
    {
        $this->Liste->recursive = 1;
        $liste = $this->Liste->findById($id);
        return $liste;
    }

    //demander dans /users/view 207
    function system_get_liste_for_user($user_id, $date_debut = null, $date_fin = null)
    {
        $this->autoRender = false;
        $listes = $this->Liste->find('list', array('conditions' => array('Liste.user_id' => $user_id)));
        $liste_ids = '0';
        foreach ($listes as $key => $value)
            if ($liste_ids != null)
                $liste_ids = $liste_ids . ",$key";
        if ($date_debut == null) {
            $date = date('Y-m-d'); // you can put any date you want
            $nbDay = date('N', strtotime($date));
            $monday = new DateTime($date);
            $sunday = new DateTime($date);
            $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
            $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
            $plans = $this->Liste->query("select * from plantournes as Plantourne where "
                . "date <'$date_fin' and  liste_id in($liste_ids) order by date desc limit 4");
        } else
            $plans = $this->Liste->query("select * from plantournes as Plantourne where "
                . "date <'$date_fin' and date >='$date_debut' and   liste_id in($liste_ids) order by date desc");

        $listes = array();
        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        for ($i = count($plans) - 1; $i >= 0; $i--) {
            $liste = $this->Liste->find('first', array(
                'conditions' => array("Liste.id" => $plans[$i]['Plantourne']['liste_id']),
                'recursive' => -1
            ));
            $date_debut = $plans[$i]['Plantourne']['date'];
            $date_fin = date('Y-m-d', strtotime($date_debut . " +6 day "));
            $visites = $this->Visite->find('all', array(
                'conditions' => array(
                    "Visite.date between '$date_debut' and '$date_fin 23:59'",
                    "Visite.user_id" => $user_id
                ),
                'recursive' => -1
            ));
            $liste['visites'] = $visites;
            $liste['date']['date_debut'] = $date_debut;
            $liste['date']['date_fin'] = $date_fin;
            $listes[] = $liste;
        }
        return $listes;
    }


    function listeretard($user_id = null, $return = null)
    {
        $date_debut = date("Y-m-d", strtotime('monday this week'));
        $date_debut = date('Y-m-d', strtotime($date_debut . ' - 1 days'));
        $fin_clients = array();
        if ($user_id == null || AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
            $user_id = AuthComponent::user('id');
        } else if (AuthComponent::user('role') == 'Super viseur') {


            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $super = $this->Apartient->find('count', array('conditions' => array(
                'Apartient.user_id' => AuthComponent::user('id'),
                'Apartient.user1_id' => $user_id
            )));
            if ($super == 0)
                $user_id = AuthComponent::user('id');
        }

        //----------------------------- systeme de cache-------------------------//
        $week = date("W");
        $weekdelete = $week - 1;
        $cache_name = $user_id . "_" . $week;
        Cache::delete($user_id . "_" . $weekdelete);
        $cache = Cache::read($cache_name);
        if ($cache !== false) {
            if ($return != null)
                return $cache;
            $this->loadModel("Type");
            $types = $this->Type->find("list");
            $this->loadModel("Category");
            $cats = $this->Category->find("list");
            $this->loadModel("Secteur");
            $secteurs = $this->Secteur->find("list");
            $this->set('clients', $cache);
            $this->set(compact("user_id", "date_debut", 'types', 'cats', 'secteurs'));
        }

        //---------------------Fin systeme de cache mais mazal tht la ligne qui rempli had cache $cache_name=$user_id."_".$week;
        else {

            $listes = $this->Liste->find('all', array('conditions' => array('Liste.archive' => 1, 'Liste.user_id' => $user_id)));
            $clients = array();
            $ids = 0;
            foreach ($listes as $value) {
                foreach ($value['Affectation'] as $v) {
                    if ($v["valide"] == 1) {
                        $retard = $this->requestAction('/clients/system_get_retart_client/' . $v['client_id'] . "/$user_id");
                        if ($retard > 0) {
                            $ids = $ids . "," . $v['client_id'];
                            $clients[$v['client_id']]["retard"] = $retard;
                            $clients[$v['client_id']]["liste_name"] = $value["Liste"]["name"];
                        }
                    }
                }
            }
            arsort($clients);
            $this->loadModel("Client");
            $clientss = $this->Client->find("all", array("recursive" => -1, "conditions" => array("Client.id in($ids)")));
            $fin_clients = array();
            foreach ($clientss as $c) {
                if ($c["Client"]["type_id"] == 1) {
                    $c["Client"]["info"] = $clients[$c["Client"]["id"]];
                    $fin_clients[] = $c;
                }
            }
            // copie dans le cache 
            Cache::write($cache_name, $fin_clients);

            if ($return != null)
                return $fin_clients;
            else {
                $this->loadModel("Type");
                $types = $this->Type->find("list");
                $this->loadModel("Category");
                $cats = $this->Category->find("list");
                $this->loadModel("Secteur");
                $secteurs = $this->Secteur->find("list");
                $this->set('clients', $fin_clients);
                $this->set(compact("user_id", "date_debut", 'types', 'cats', 'secteurs'));
            }
        }
    }

    function feullederoutepharmacie($datefeuile)
    {
        $this->loadModel('Feuilleroute');
        if ($this->request->is('post')) {
            if (isset($this->request->data['client_id'])) {
                foreach ($this->request->data['client_id'] as $key => $value) {
                    $a = array();
                    $this->Feuilleroute->create();
                    $a['Feuilleroute']['client_id'] = $value;
                    $a['Feuilleroute']['date'] = $this->request->data['Feuilleroute']['date'];
                    $a['Feuilleroute']['user_id'] = AuthComponent::user('id');
                    $this->Feuilleroute->save($a);
                }
            }
            $this->Session->setFlash(__('Feuille de route ajoutée'));
            return $this->redirect(array('action' => 'view'));
        }
        $all = $this->Feuilleroute->find("all", array('conditions' => array('Feuilleroute.date' => $datefeuile, 'Feuilleroute.user_id' => AuthComponent::user('id'))));
        $sect = array();
        $secteur_id = 0;
        foreach ($all as $value) {
            if (!isset($sect[$value["Client"]["secteur_id"]]))
                $sect[$value["Client"]["secteur_id"]] = 1;
            else
                $sect[$value["Client"]["secteur_id"]]++;
        }

        $max = 0;
        foreach ($sect as $key => $value) {
            if ($max <= $value) {
                $max = $value;
                $secteur_id = $key;
            }
        }
        $date = date('Y-m-d', strtotime(date('Y-m-d H:i:s') . ' -30 days'));
        $this->loadModel("Secteur");
        $this->Secteur->recursive = -1;
        $secteur = $this->Secteur->findById($secteur_id);
        $this->loadModel("Client");
        $this->Client->recursive = -1;
        $clients = $this->Client->find("all", array(
            "joins" => array(
                array(
                    "table" => "secteurs",
                    "alias" => "Secteur",
                    "type" => "LEFT",
                    "conditions" => array(
                        "Secteur.id = Client.secteur_id"
                    )
                )
            ),
            'fields' => array('Client.id', 'Client.nom', 'Client.adress', 'Secteur.secteur'),
            'conditions' => array('Client.type_id' => 2, 'Secteur.ville' => $secteur["Secteur"]["ville"], "Client.archive=1 limit 300")
        ));
        $all = array();
        $this->loadModel("Visite");
        $this->Visite->recursive = -1;
        $i = 0;
        foreach ($clients as $value) {
            if ($i == 30)
                break;
            $nombre = $this->Visite->find("count", array('conditions' => array("Visite.date >'$date'", 'Visite.client_id' => $value["Client"]["id"], "Visite.archive" => 1)));
            if ($nombre == 0)
                $all[] = $value;
            $i++;
        }


        $this->set('clients', $all);
        $this->set('date', $datefeuile);
    }

    function feuilleroute($id = 0)
    {
        if ($this->request->is('post')) {
            //debug($this->request->data);exit();
            $this->loadModel('Feuilleroute');
            if (isset($this->request->data['client_id'])) {
                foreach ($this->request->data['client_id'] as $key => $value) {
                    $a = array();
                    $this->Feuilleroute->create();
                    $a['Feuilleroute']['client_id'] = $value;
                    $a['Feuilleroute']['date'] = $this->request->data['Feuilleroute']['date'];
                    $a['Feuilleroute']['user_id'] = AuthComponent::user('id');
                    if (AuthComponent::user('role') == 'Super viseur') {
                        $a['Feuilleroute']['valide'] = 1;
                    }
                    $this->Feuilleroute->save($a);
                }
            }
            $this->Session->setFlash(__('Feuille de route ajoutée'));
            if ($this->requestAction('/droits/getrole/listes/feullederoutepharmacie') == 1)
                return $this->redirect(array('action' => 'feullederoutepharmacie', $this->request->data['Feuilleroute']['date']));
            else
                return $this->redirect(array('action' => 'view', $this->request->data['Feuilleroute']['liste_id']));
        }
        //had le code supervisseur howa li taysawb feuille de route l son VMP
        //        if($user_id==null || AuthComponent::user('role')=='VMP' || AuthComponent::user('role')=='Coordinateur')
        //        {
        //            $user_id=AuthComponent::user('id');
        //        }
        //        else if(AuthComponent::user('role')=='Super viseur')
        //        {
        //            $this->loadModel('Apartient');
        //            $this->Apartient->recursive = -1;
        //            $super = $this->Apartient->find('count', array('conditions' =>array('Apartient.user_id' => AuthComponent::user('id'),
        //                'Apartient.user1_id' => $user_id)));
        //            if($super==0)
        //                $user_id=AuthComponent::user('id');
        //        }
        $user_id = AuthComponent::user('id');
        $listes = $this->Liste->find('list', array('conditions' => array('Liste.user_id' => $user_id, 'Liste.archive' => 1)));
        $liste_ids = '0';
        foreach ($listes as $key => $value)
            $liste_ids = $liste_ids . ",$key";
        $this->loadModel('Plantourne');
        $date = date('Y-m-d', strtotime(date('Y-m-d H:i:s') . ' +35 hour')); //had la date pour ajouter deux jour bach ysibo inta ydiro le FRoute
        //$date = date('Y-m-d'); // La date normal 
        $nbDay = date('N', strtotime($date));
        $monday = new DateTime($date);
        $sunday = new DateTime($date);
        $date = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
        $plans = $this->Plantourne->query("select liste_id from plantournes as Plantourne "
            . "where date ='" . $date . "'and  liste_id in($liste_ids)");
        $liste = array();
        if (!empty($plans)) {
            $liste = $this->Liste->Affectation->find('all', array('conditions' => array('Affectation.valide=1', 'Affectation.liste_id' => $plans[0]['Plantourne']['liste_id'])));
            if (!empty($liste)) {

                // Build clean ID array
                $ids = [];
                foreach ($liste as $client) {
                    if (!empty($client["Client"]["id"])) {
                        $ids[] = (int)$client["Client"]["id"];
                    }
                }

                $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
                $date_fin   = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');

                $this->loadModel('Visite');
                $this->Visite->recursive = -1;

                $visites = $this->Visite->find('all', [
                    'conditions' => [
                        'Visite.client_id' => $ids, // <-- pass array directly
                        'Visite.user_id'   => $user_id,
                        'Visite.archive'   => 1,
                        'Visite.date BETWEEN ? AND ?' => [
                            $date_debut,
                            $date_fin . ' 23:59:59'
                        ]
                    ]
                ]);

                // Optimize lookup (faster than nested foreach)
                $visitedClients = [];
                foreach ($visites as $v) {
                    $visitedClients[$v["Visite"]["client_id"]] = true;
                }

                foreach ($liste as $k => $client) {
                    $clientId = $client["Client"]["id"];
                    $liste[$k]["Client"]["visite"] = isset($visitedClients[$clientId]) ? 1 : 0;
                }

                $this->set('liste_id', $plans[0]['Plantourne']['liste_id']);
            }
        }

        $clients = $this->listeretard($user_id, 1);
        $this->loadModel('Type');
        $types = $this->Type->find('list');
        $this->loadModel('Category');
        $categories = $this->Category->find('list');
        $this->loadModel('Secteur');
        $secteurs = $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.secteur')));
        $clientss = array();
        if (AuthComponent::user('role') == 'Super viseur') {
            $clientss = $this->requestAction('/clients/system_get_retart_client_vm/' . AuthComponent::user('id'));
        }

        $this->set(compact("id", "clients", "liste", 'types', 'categories', 'secteurs', "clientss"));
        //exit();
    }

    //had fonction utlisé dans /listes/view 
    function system_get_list_feuille_route($user_id = null, $date_debut = null)
    {
        if ($user_id == null)
            $user_id = AuthComponent::user('id');
        if ($date_debut == null) {
            $date = date('Y-m-d'); // you can put any date you want
            $nbDay = date('N', strtotime($date));
            $monday = new DateTime($date);
            $sunday = new DateTime($date);
            $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
            $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
        } else
            $date_fin = date('Y-m-d', strtotime($date_debut . " +7 day "));
        $feuilles = $this->Liste->query("select *,count(id) as num from feuilleroutes as Feuilleroute where 
            user_id=$user_id and date >='$date_debut' and date <='$date_fin 23:59' group by date");
        if (!empty($feuilles)) {
            $f = $this->Liste->query("select count(*) as num from feuilleroutes as Feuilleroute where 
				user_id=$user_id and date >='$date_debut' and date <='$date_fin 23:59' and valide=0 group by date");
            if (!empty($f))
                if ($f[0][0]["num"] != 0)
                    $feuilles[0]["Feuilleroute"]["valide"] = 0;
        }
        return $feuilles;
    }

    //had fonction utlisé dans /listes/validerFuilleDeRoute line 25 
    function system_get_list_feuille_route_for_validation($user_id = null, $date_debut = null)
    {
        if ($user_id == null)
            $user_id = AuthComponent::user('id');
        if ($date_debut == null) {
            $date = date('Y-m-d'); // you can put any date you want
            $nbDay = date('N', strtotime($date));
            $monday = new DateTime($date);
            $sunday = new DateTime($date);
            $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
            $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
        } else
            $date_fin = date('Y-m-d', strtotime($date_debut . " +7 day "));
        $feuilles = $this->Liste->query("select *,count(id) as num from feuilleroutes as Feuilleroute where 
            user_id=$user_id and date >='$date_debut' and date <='$date_fin 23:59' group by date,valide");
        if (!empty($feuilles)) {
            $f = $this->Liste->query("select count(*) as num from feuilleroutes as Feuilleroute where 
				user_id=$user_id and date >='$date_debut' and date <='$date_fin 23:59' and valide=0 group by date");
            if (!empty($f))
                if ($f[0][0]["num"] != 0)
                    $feuilles[0]["Feuilleroute"]["valide"] = 0;
        }
        return $feuilles;
    }

    function detail_feuille_route($user_id, $date, $feuille_id = null)
    {
        $this->loadModel('Feuilleroute');
        $this->loadModel('Game');
        if ($feuille_id != null) {
            $this->Feuilleroute->id = $feuille_id;
            $this->Feuilleroute->delete();
            $this->Session->setFlash("Client retiré de la feuille de route ");
        }
        $listes = $this->Feuilleroute->find('all', array('conditions' => array('Feuilleroute.user_id' => $user_id, 'Feuilleroute.date' => $date)));
        $ids = 0;
        foreach ($listes as $value) {
            if (isset($value['Client']['id']))
                $ids = $ids . ',' . $value['Client']['id'];
        }
        $clients = $this->Liste->query("select * from clients as Client  where Client.id in($ids) order by potentialite asc");
        $this->loadModel("Client");
        $this->Client->Visite->recursive = -1;
        $visites = $this->Client->Visite->find("all", array("conditions" => array('Visite.user_id' => $user_id, "DATE(Visite.date)='$date' and Visite.client_id in($ids)")));
        $categories = $this->Client->Category->find("list");
        $types = $this->Client->Type->find("list");
        $secteurs = $this->Client->Secteur->find("list");
        $produits = $this->Game->find('list');
        $this->set(compact("produits", "categories", "types", "secteurs", "clients", "listes", "visites"));
    }

    //Validation des fuille de routes pour superviseur
    //créé 10/03/2018
    function validerFuilleDeRoute($user_id = null, $date = null)
    {
        if ($user_id != null) {
            $this->Liste->query("UPDATE feuilleroutes SET `valide`='1' WHERE  user_id='$user_id' and date='$date'");
            $this->Session->setFlash(__('Feuille de route validée'));
            return $this->redirect(array('action' => 'validerFuilleDeRoute'));
        }
        $this->loadModel('User');
        $this->User->recursive = -1;
        if (AuthComponent::user('role') == 'Super viseur') {
            $this->User->Apartient->recursive = -1;
            $users = $this->User->Apartient->find('all', array('conditions' =>
            array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = AuthComponent::user('id');
            foreach ($users as $value)
                $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            $users = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));
        } else
            $users = $this->User->find('all', array('conditions' => array('User.archive' => 1)));
        //debug($users);
        $this->set('users', $users);
    }

    //29/06/2018
    //function recupéré la liste des feuille de route valider pour tout les VM d'un superviseur pour faire une visire en double
    //demander dans view listes/feuilleroute/ kaina f javascript
    function system_get_feuillederoute($date = null)
    {
        if ($date == null)
            $date = date("Y-m-d");
        if (AuthComponent::user('role') == 'Super viseur') {
            $this->loadModel('Feuilleroute');
            $this->loadModel('User');
            $this->User->recursive = -1;
            $this->loadModel('Secteur');
            $this->Secteur->recursive = -1;
            $secs = $this->Secteur->find("list");
            $this->loadModel('Category');
            $this->Category->recursive = -1;
            $cats = $this->Category->find("list");
            $this->loadModel('Type');
            $this->Type->recursive = -1;
            $types = $this->Type->find("list");
            $this->User->Apartient->recursive = -1;
            $users = $this->User->Apartient->find('all', array('conditions' =>
            array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = 0;
            foreach ($users as $value)
                $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            $feuilles = $this->Feuilleroute->find("all", array(
                'fields' => array(
                    'User.name',
                    'Client.nom',
                    'Client.nom',
                    'Client.nom',
                    'Client.prenom',
                    'Client.category_id',
                    'Client.secteur_id',
                    'Client.potentialite',
                    'Client.id',
                    'Client.type_id',
                    'Client.potentialitev2'
                ),
                'conditions' => array('Feuilleroute.valide' => 1, "Feuilleroute.user_id in($ids)", 'Feuilleroute.date' => $date)
            ));
            $i = 0;
            foreach ($feuilles as $value) {
                foreach ($cats as $key => $v) {
                    if ($key == $value["Client"]["category_id"]) {
                        $feuilles[$i]["Client"]["category_id"] = $v;
                        break;
                    }
                }
                foreach ($types as $key => $v) {
                    if ($key == $value["Client"]["type_id"]) {
                        $feuilles[$i]["Client"]["type_id"] = $v;
                        break;
                    }
                }
                foreach ($secs as $key => $v) {
                    if ($key == $value["Client"]["secteur_id"]) {
                        $feuilles[$i]["Client"]["secteur_id"] = $v;
                        break;
                    }
                }
                $i++;
            }
            echo "<div class='box-body' style='height: 443px;overflow-y: scroll;overflow-x: auto;'><table class='display1 table table-bordered'><thead><tr><th>Nom</th><th>Type</th><th>Spécialité</th><th>Pot V1</th><th>Pot V2</th><th>Secteur</th><th>Sélections</th></tr></thead><tbody>";
            foreach ($feuilles as $value) {
                echo "<tr><td>" . $value["User"]["name"] . "</td>"
                    . "<td>" . $value["Client"]["type_id"] . "</td><td>" . $value["Client"]["category_id"] . "</td><td>" . $value["Client"]["potentialite"] . ""
                    . "</td><td>" . $value["Client"]["potentialitev2"] . "</td><td>" . $value["Client"]["secteur_id"] . "</td><td>"
                    . '<input type="checkbox" name="data[client_id][]" value="' . $value["Client"]["id"] . '" class="flat-red"></td></tr>';
            }
            echo "</tbody></table></div>";
            exit();
        }
    }

    //function pour view user elle envoie les info de progress et de potentiallité et type
    //demander /listes/view 168
    //Demander /user/view 190 et 194 pour superviseur et les VMP
    function system_get_progress_info($liste_id = null, $date_debut, $date_fin, $user_id = null, $super = null, $vpot = null)
    {
        $this->autoRender = false;
        // debug($date_debut);
        $this->loadModel('Visite');
        $this->Visite->recursive = 1;
        $this->loadModel('Type');
        $typess = $this->Type->find('list');
        $ids = 0;
        if ($super == null) {
            $aff = $this->Liste->Affectation->find('all', array('conditions' => array('Affectation.valide=1', 'Affectation.liste_id' => $liste_id)));
            foreach ($aff as $value)
                $ids = $ids . "," . $value['Affectation']['client_id'];
        } else {
            // debug($user_id);
            $aff = $this->Liste->query("select client_id from visites where user_id=$user_id and archive=1 and DATE(date) >= '$date_debut' and DATE(date) <= '$date_fin'");
            // debug($aff);
            // debug($liste_id);
            foreach ($aff as $value)
                $ids = $ids . "," . $value['visites']['client_id'];
            if ($liste_id != null) {
                $aff = $this->Liste->Affectation->find('all', array('conditions' => array('Affectation.valide=1', 'Affectation.liste_id' => $liste_id)));
                foreach ($aff as $value)
                    $ids = $ids . "," . $value['Affectation']['client_id'];
            }
        }
        // debug($ids);

        $types = $this->Liste->query("select type_id,count(type_id) as nb_type from clients where id in ($ids) group by type_id;");

        $info = array();
        $i = 0;
        // debug($types);
        foreach ($types as $value) {
            if ($value['clients']['type_id'] == null)
                $value['clients']['type_id'] = 1;
            if ($vpot == 'potv2') {
                $po = $this->Liste->query("select potentialitev2,count(potentialitev2) as nb_type from clients where type_id=" . $value['clients']['type_id'] . " and id in ($ids) group by potentialitev2;");
            } else {
                $po = $this->Liste->query("select potentialite,count(potentialite) as nb_type from clients where type_id=" . $value['clients']['type_id'] . " and id in ($ids) group by potentialite;");
            }
            $info[$i]['type']['type'] = $typess[$value['clients']['type_id']];
            $info[$i]['type']['nb_type'] = $value[0]['nb_type'];
            $visite = $this->Visite->find('count', array('conditions' => array(
                "Visite.client_id in ($ids)",
                "Client.type_id" => $value['clients']['type_id'],
                "Visite.user_id" => $user_id,
                'Visite.archive' => 1,
                "DATE(Visite.date) >= '$date_debut' and DATE(Visite.date) <= '$date_fin'"
            )));
            $info[$i]['type']['nb_visiter'] = $visite;

            $j = 0;
            foreach ($po as $v) {
                if ($vpot == 'potv2') {
                    $visite = $this->Visite->find('count', array('conditions' => array(
                        "Visite.client_id in ($ids)",
                        "Client.type_id" => $value['clients']['type_id'],
                        "Client.potentialitev2" => $v['clients']['potentialitev2'],
                        "Visite.user_id" => $user_id,
                        'Visite.archive' => 1,
                        "DATE(Visite.date) >= '$date_debut' and DATE(Visite.date) <= '$date_fin'"
                    )));
                    $info[$i]['potentialite'][$j]['potentialite'] = $v['clients']['potentialitev2'];
                } else {
                    $visite = $this->Visite->find('count', array('conditions' => array(
                        "Visite.client_id in ($ids)",
                        "Client.type_id" => $value['clients']['type_id'],
                        "Client.potentialite" => $v['clients']['potentialite'],
                        "Visite.user_id" => $user_id,
                        'Visite.archive' => 1,
                        "DATE(Visite.date) >= '$date_debut' and DATE(Visite.date) <= '$date_fin'"
                    )));
                    $info[$i]['potentialite'][$j]['potentialite'] = $v['clients']['potentialite'];
                }
                $info[$i]['potentialite'][$j]['nb_potentialite'] = $v[0]['nb_type'];
                $info[$i]['potentialite'][$j]['nb_visiter'] = $visite;
                $j++;
            }
            $i++;
        }
        //debug($info);
        return $info;
    }

    function system_get_progress_info_affectedandnoaffected($liste_id, $user_id, $date_debut, $date_fin)
    {
        $this->autoRender = false;
        $this->loadModel('Visite');
        $this->Visite->recursive = 1;
        $this->loadModel('Type');
        $typess = $this->Type->find('list');
        $aff = $this->Liste->Affectation->find('all', array(
            'conditions' => array(
                'Affectation.valide' => 1,
                'Affectation.liste_id' => $liste_id
            ),
            'recursive' => -1,
            'fields' => array('Affectation.client_id')
        ));

        $ids = 0;
        foreach ($aff as $value) {
            $ids = $ids . "," . $value['Affectation']['client_id'];
        }

        $types = $this->Liste->query("select type_id,count(type_id) as nb_type from clients where id in ($ids) group by type_id;");

        $info = array();
        $i = 0;
        foreach ($types as $value) {
            if ($value['clients']['type_id'] == null)
                $value['clients']['type_id'] = 1;
            $info[$i]['type']['type'] = $typess[$value['clients']['type_id']];
            $info[$i]['type']['nb_type'] = $value[0]['nb_type'];
            $visite = $this->Visite->find('count', array('conditions' => array(
                "Visite.user_id" => $user_id,
                "Client.type_id" => $value['clients']['type_id'],
                'Visite.archive' => 1,
                "DATE(Visite.date) >= '$date_debut' and DATE(Visite.date) <= '$date_fin'"
            )));


            $info[$i]['type']['nb_visiter'] = $visite;

            $i++;
        }
        //debug($info);
        return $info;
    }

    function system_get_liste_for_user_client_view($user_id)
    {
        $this->Liste->recursive = -1;
        $liste = $this->Liste->find('list', array('conditions' => array("Liste.user_id" => $user_id, "Liste.archive" => 1)));
        echo '<label for="ClientCategoryId">Les listes</label> '
            . '<select class="form-control" id="secteurs" name=data[Affectation][liste_id]> ';
        echo '<option  value="0">Choisissez une liste</option>';
        foreach ($liste as $k => $v)
            echo '<option  value="' . $k . '">' . $v . '</option>';
        echo '</select>';
        exit();
    }

    //fonction donne la listes des listes pour un user données le variable detecterror permet d'envoyer juste si le listing est bien ou pas pour le tableau de bord
    //demander par users/view
    //demander par users/tableau_bord_super
    function getlistforuser($user_id = null, $detecterror = null)
    {
        if ($detecterror != null) {
            $ll = $this->Liste->find('all', array('conditions' => array("Liste.user_id" => $user_id, "Liste.archive" => 1)));
            $info = "";
            foreach ($ll as $l) {
                if (count($l["Affectation"]) > 70 && count($l["Affectation"]) < 80)
                    $info = "warning";
                else if (count($l["Affectation"]) >= 80) {
                    $info = "Error";
                    break;
                }
            }
            return $info;
        } else
            return $this->Liste->find('list', array('conditions' => array("Liste.user_id" => $user_id, "Liste.archive" => 1)));
    }

    //fonction donne le nombre d'affectation pour une liste données
    //demander par users/view
    function system_getcountaffectation($id)
    {
        $this->autoRender = false;
        return $this->Liste->Affectation->find('count', array('conditions' => array("Affectation.liste_id" => $id, "Affectation.valide" => 1)));
    }

    public function archive($id = null, $valide = null, $iduser = null)
    {
        if ($id == null) {
            $this->Liste->recursive = 0;
            $this->set('listes', $this->Liste->find('all', array('conditions' => array('Liste.archive' => 0))));
        } else {
            $this->Liste->id = $id;
            $this->Liste->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Liste Archivée'));
                return $this->redirect(array('controller' => 'users', 'action' => 'view', $iduser));
            } else {
                $this->Session->setFlash(__('Liste activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }

    //demander par view  /listes/feuilleroute
    function system_get_name_list_for_client($client_id)
    {
        $this->autoRender = false;
        $name = $this->Liste->Affectation->find('first', array('conditions' => array("Liste.archive" => 1, "Affectation.client_id" => $client_id, "Affectation.valide" => 1)));
        return $name['Liste']["name"];
    }

    //function créé le 10/03/2018
    //Envoi une notification a superviseur pour visiter un client en retard de son VM envoyer par lui méme ou par Promotion
    //utiliser comme click dans listeretard.ctp kaina fiha bouhdha
    function envoyer_client_retard($user_id, $client_id)
    {
        //$this->loadModel('Client');
        //$client=$this->Client->findById($client_id);
        $super = $this->requestAction('/users/system_get_superviseur/' . $user_id);
        $this->loadModel('Boitemail');
        $this->Boitemail->create();
        $d['Boitemail']['lien'] = "/clients/view/$client_id";
        $d['Boitemail']['user_id'] = $super['User']['id'];
        $d['Boitemail']['user1_id'] = AuthComponent::user('id');
        $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a demandé une visite pour le client ref ' . $client_id;
        $d['Boitemail']['message'] = "Une demande de visite a été envoyée par " . AuthComponent::user('name') . ".";
        $this->Boitemail->save($d);
        $this->Session->setFlash(__('Demande envoyée'));
        return $this->redirect(array('action' => 'listeretard', $user_id));
    }

    //function pour dupliquer une liste pour un autre compte 22/10/2019
    function dupliquer($id = null)
    {
        if ($this->request->is('post')) {
            $liste = $this->Liste->findById($id);
            if (empty($liste["Affectation"]) || $this->request->data['Liste']['user_id'] == 0) {
                $this->Session->setFlash("Erreur liste vide ou vous n'avez pas choisie un collaborateur");
                return $this->redirect(array('action' => 'view', $id));
            }
            $this->Liste->create();
            $d = array();
            $d['Liste']['name'] = $liste['Liste']['name'];
            $d['Liste']['user_id'] = $this->request->data['Liste']['user_id'];
            $this->Liste->save($d);
            $liste_id = $this->Liste->id;
            foreach ($liste["Affectation"] as  $value) {
                $this->Liste->Affectation->create();
                $d = array();
                $d['Affectation']['liste_id'] = $liste_id;
                $d['Affectation']['client_id'] = $value["client_id"];
                $this->Liste->Affectation->save($d);
            }
            $this->Session->setFlash(__('Duplication de la liste effectuée avec succès'));
            return $this->redirect(array('action' => 'view', $liste_id));
        }
    }
}
