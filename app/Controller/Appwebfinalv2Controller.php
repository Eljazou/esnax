<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'listes');

class Appwebfinalv2Controller extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = 'appmobilepro';
        header("Access-Control-Allow-Origin: *");
        $this->Auth->allow();

        // // All actions will look in View/Appwebfinal/ instead of View/Appwebfinalv2/
        // $this->viewPath = 'Appwebfinal';
    }

    function index($code)
    {
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (!isset($user["User"]["id"])) {
            echo "[]";
            exit;
        }
        $user_id = $user["User"]["id"];
        $user_name = $user["User"]["name"];
        $user_role = $user["User"]["role"];

        $visiteencour = $this->get_last_visite($user["User"]["id"]);
        if (count($visiteencour) != 0) {
            $visiteencour["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visiteencour['Visite']['date']);
        }
        $this->set(compact("code", "visiteencour", "user_id", 'user_name', 'user_role'));
    }
    //supprimer une visite en cours
    function delete_visite($id, $user_id)
    {
        if (!$this->request->is('post')) {
            $this->redirect($this->referer());
            return; // stop here, don't run the delete logic
        }

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
            $this->Session->setFlash('Visite supprimé avec succés');
        } else {
            $this->Session->setFlash('Impossible de supprimer la visite!');
        }

        $this->redirect($this->referer());
    }

    function view_client($code, $id = null)
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

        $vv = $this->Visite->find('all', array(
            'conditions' => array(
                "Visite.client_id =$id",
                " Visite.date between 
                   DATE_ADD(CURRENT_DATE(), INTERVAL -90 DAY) and DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY)",
                'Visite.archive' => 1
            ),
            'order' => array('Visite.date desc')
        ));

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

        //Systeme de double visite avec indication de la personne qui a fait la visite (Module ACM) a envoyé double_id
        $this->loadModel("Apartient");
        $apartients = $this->Apartient->find("all", array("conditions" => array("Apartient.user1_id" => $user["User"]["id"])));
        $doubles = array();
        foreach ($apartients as $key => $apartient) {
            $doubles[$apartient["Apartient"]["user_id"]] = $apartient["User"]["name"];
        }
        $doubles["777777"] = "Chef de produit";
        $doubles["888888"] = "Commercial";

        // Load categories for replacement client form
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $categories = $this->Category->find('list', array('fields' => array('Category.id', 'Category.name')));

        // Load hopital clients if current client has a hopital
        $hopital_id = !empty($client['Client']['hopital_id']) ? $client['Client']['hopital_id'] : null;
        $hopital_clients = array();
        if ($hopital_id) {
            $hopital_clients_raw = $this->Client->find('all', array(
                'conditions' => array('Client.hopital_id' => $hopital_id, 'Client.id !=' => $id),
                'fields' => array('Client.id', 'Client.nom', 'Client.prenom')
            ));
            foreach ($hopital_clients_raw as $hc) {
                $hopital_clients[] = array(
                    'id' => $hc['Client']['id'],
                    'nom' => $hc['Client']['nom'],
                    'prenom' => $hc['Client']['prenom']
                );
            }
        }

        // Load all hospitals for the replacement form (when client has no hospital)
        $this->loadModel('Hopital');
        $this->Hopital->recursive = -1;
        $all_hopitals = $this->Hopital->find('list', array('fields' => array('Hopital.id', 'Hopital.name')));

        $this->set(compact("code", 'client', "lignespecialiteinfo", "visiteencour", "doubles", "hopital_id", "hopital_clients", "categories", "all_hopitals"));
    }



    public function set_chez_client()
    {
        $this->autoRender = false;
        header('Content-Type: application/json');  // <-- add this
        ob_start();

        if (!$this->request->is('post')) {
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $latitude = isset($data['latitude']) ? $data['latitude'] : null;
        $longitude = isset($data['longitude']) ? $data['longitude'] : null;
        $client_id = isset($data['clientId']) ? $data['clientId'] : null;
        $code = isset($data['code']) ? $data['code'] : null;
        $typeVisite = isset($data['typeVisite']) ? $data['typeVisite'] : 'solo';
        $supId = isset($data['supId']) ? $data['supId'] : null;
        $replacedClientId = isset($data['replacedClientId']) ? $data['replacedClientId'] : null;

        if (!$latitude || !$longitude || !$client_id || !$code) {
            echo json_encode(['success' => false, 'message' => 'Données manquantes']);
            return;
        }

        // Resolve double_id label for special codes
        $double_id = null;
        if ($typeVisite === 'double' && $supId !== null) {
            if ($supId == '777777')
                $double_id = 'Chef de produit';
            elseif ($supId == '888888')
                $double_id = 'Commercial';
            else
                $double_id = $supId;
        }

        // Find user by code
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', [
            'conditions' => ['User.archive' => 1, 'User.iemi' => $code]
        ]);

        if (empty($user)) {
            echo json_encode(['success' => false, 'message' => 'Utilisateur introuvable']);
            return;
        }

        $user_id = $user['User']['id'];
        $aujourdhui = date('Y-m-d');

        // Weekend check (6 = Saturday, 7 = Sunday)
        $jour = date('N');
        if ($jour >= 6) {
            echo json_encode([
                'success' => false,
                'message' => 'Le service est indisponible le week-end.'
            ]);
            return;
        }

        // Absence check
        $this->loadModel('Absence');
        $countAbsence = $this->Absence->find('count', [
            'conditions' => [
                'Absence.user_id' => $user_id,
                'Absence.archive' => 1,
                'Absence.date_debut <=' => $aujourdhui,
                'Absence.date_fin >' => $aujourdhui,
            ]
        ]);

        if ($countAbsence > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Le service est indisponible : vous avez une absence enregistrée aujourd\'hui.'
            ]);
            return;
        }

        // Public holiday check
        $this->loadModel('Jourferier');
        $countJourFerie = $this->Jourferier->find('count', [
            'conditions' => [
                'Jourferier.date_debut <=' => $aujourdhui,
                'Jourferier.date_fin >=' => $aujourdhui,
            ]
        ]);

        if ($countJourFerie > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Le service est indisponible : aujourd\'hui est un jour férié.'
            ]);
            return;
        }

        // Save the visite
        $this->loadModel('Visite');
        $d['Visite']['user_id'] = $user_id;
        $d['Visite']['client_id'] = $client_id;
        $d['Visite']['latitude'] = $latitude;
        $d['Visite']['longitude'] = $longitude;
        $d['Visite']['type_visite'] = $typeVisite;
        $d['Visite']['date'] = date('Y-m-d H:i:s');
        $d['Visite']['timer'] = 0;

        if ($double_id !== null) {
            $d['Visite']['double_id'] = $double_id;
            // Auto-validate for non-user supervisors (product chief / commercial)
            if ($double_id === 'Chef de produit' || $double_id === 'Commercial') {
                $d['Visite']['double_gps'] = $latitude . ',' . $longitude;
                $d['Visite']['double_date_validation'] = date('Y-m-d H:i:s');
            }
        }

        $this->Visite->create();
        if ($this->Visite->save($d)) {
            // Notify admins if this visit was started as a replacement for an existing client
            if ($replacedClientId) {
                $this->loadModel('Client');
                $this->Client->recursive = -1;
                $old_client = $this->Client->findById($replacedClientId);
                $new_client = $this->Client->findById($client_id);

                if (!empty($old_client) && !empty($new_client)) {
                    $admins = $this->User->find('all', array(
                        'conditions' => array('User.role' => 'Admin', 'User.archive' => 1)
                    ));

                    $replaced_name = trim($old_client['Client']['nom'] . ' ' . $old_client['Client']['prenom']);
                    $new_name = trim($new_client['Client']['nom'] . ' ' . $new_client['Client']['prenom']);

                    $wr = $this->webroot;
                    $lk_delegue = "<a href='" . $wr . "users/view/" . $user_id . "'>" . htmlspecialchars($user['User']['name'], ENT_QUOTES, 'UTF-8') . "</a>";
                    $lk_replaced = "<a href='" . $wr . "clients/view/" . (int) $replacedClientId . "'>" . htmlspecialchars($replaced_name, ENT_QUOTES, 'UTF-8') . "</a>";
                    $lk_new = "<a href='" . $wr . "clients/view/" . (int) $client_id . "'>" . htmlspecialchars($new_name, ENT_QUOTES, 'UTF-8') . "</a>";

                    $hopital_name = '';
                    if (!empty($new_client['Client']['hopital_id'])) {
                        $this->loadModel('Hopital');
                        $hopital = $this->Hopital->findById($new_client['Client']['hopital_id']);
                        if (!empty($hopital)) {
                            $hopital_name = " à l'hôpital <a href='" . $wr . "hopitals/index'>" . htmlspecialchars($hopital['Hopital']['name'], ENT_QUOTES, 'UTF-8') . "</a>";
                        }
                    }

                    $message = $lk_delegue . " a remplacé le client " . $lk_replaced . " par " . $lk_new . $hopital_name . ".";

                    $this->loadModel('Notification');
                    foreach ($admins as $admin) {
                        $notif = array();
                        $notif['Notification']['user_id'] = $admin['User']['id'];
                        $notif['Notification']['user1_id'] = $user_id;
                        $notif['Notification']['vue'] = 0;
                        $notif['Notification']['titre'] = 'Remplacement client';
                        $notif['Notification']['message'] = $message;
                        $notif['Notification']['lien'] = '/notifications';
                        $this->Notification->create();
                        $this->Notification->save($notif);
                    }
                }
            }

            ob_clean(); // clear any warnings/notices before JSON
            echo json_encode([
                'success' => true,
                'message' => 'La visite a démarré',
                'visite_id' => $this->Visite->getLastInsertID(),
                'redirect' => $this->webroot . 'appwebfinalv2/index/' . $code
            ]);
        } else {
            ob_clean();
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement',
                'errors' => $this->Visite->validationErrors,
            ]);
        }
    }



    public function create_replacement_client()
    {
        $this->autoRender = false;
        header('Content-Type: application/json');
        ob_start();

        if (!$this->request->is('post')) {
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);
        $nom = isset($data['nom']) ? trim($data['nom']) : null;
        $prenom = isset($data['prenom']) ? trim($data['prenom']) : '';
        $category_id = isset($data['category_id']) ? $data['category_id'] : null;
        $cur_id = isset($data['current_client_id']) ? $data['current_client_id'] : null;
        $hopital_id = isset($data['hopital_id']) ? $data['hopital_id'] : null;
        $code = isset($data['code']) ? $data['code'] : null;
        $latitude = isset($data['latitude']) ? $data['latitude'] : null;
        $longitude = isset($data['longitude']) ? $data['longitude'] : null;

        if (!$nom || !$cur_id || !$hopital_id) {
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Données manquantes']);
            return;
        }

        $this->loadModel('Client');
        $this->Client->recursive = -1;
        $current = $this->Client->findById($cur_id);

        if (empty($current)) {
            ob_clean();
            echo json_encode(['success' => false, 'message' => 'Client introuvable']);
            return;
        }

        // Build new client based on current client data
        $new_data = $current['Client'];
        unset($new_data['id'], $new_data['created'], $new_data['modified']);
        $new_data['nom'] = $nom;
        $new_data['prenom'] = $prenom;
        if ($category_id)
            $new_data['category_id'] = $category_id;
        if ($latitude !== null)
            $new_data['latitude'] = $latitude;
        if ($longitude !== null)
            $new_data['longitude'] = $longitude;
        if ($hopital_id)
            $new_data['hopital_id'] = $hopital_id;

        $this->Client->create();
        if ($this->Client->save(array('Client' => $new_data))) {
            $new_client_id = $this->Client->getLastInsertID();

            // Notify all Admin users about the new replacement client
            $this->loadModel('User');
            $this->User->recursive = -1;

            // Get real delegué from iemi
            $delegue_id = 0;
            $delegue_name = 'Un délégué';
            if ($code) {
                $delegue = $this->User->findByIemi($code);
                if (!empty($delegue)) {
                    $delegue_id = $delegue['User']['id'];
                    $delegue_name = $delegue['User']['name'];
                }
            }

            $admins = $this->User->find('all', array(
                'conditions' => array('User.role' => 'Admin', 'User.archive' => 1)
            ));

            // Get hospital name
            $hopital_name = '';
            $this->loadModel('Hopital');
            $hopital = $this->Hopital->findById($hopital_id);
            if (!empty($hopital)) {
                $hopital_name = $hopital['Hopital']['name'];
            }

            // Original client being replaced
            $replaced_name = trim($current['Client']['nom'] . ' ' . $current['Client']['prenom']);
            $new_name = trim($nom . ' ' . $prenom);

            // Build a readable message with clickable links baked in
            $wr = $this->webroot;
            $lk_delegue = "<a href='" . $wr . "users/view/" . $delegue_id . "'>" . htmlspecialchars($delegue_name, ENT_QUOTES, 'UTF-8') . "</a>";
            $lk_replaced = "<a href='" . $wr . "clients/view/" . (int) $cur_id . "'>" . htmlspecialchars($replaced_name, ENT_QUOTES, 'UTF-8') . "</a>";
            $lk_new = "<a href='" . $wr . "clients/view/" . (int) $new_client_id . "'>" . htmlspecialchars($new_name, ENT_QUOTES, 'UTF-8') . "</a>";
            $lk_hopital = "<a href='" . $wr . "hopitals/index'>" . htmlspecialchars($hopital_name, ENT_QUOTES, 'UTF-8') . "</a>";

            $message = $lk_delegue . " a remplacé le client " . $lk_replaced . " par " . $lk_new . " à l'hôpital " . $lk_hopital . ".";

            $this->loadModel('Notification');
            foreach ($admins as $admin) {
                $notif = array();
                $notif['Notification']['user_id'] = $admin['User']['id'];
                $notif['Notification']['user1_id'] = $delegue_id;
                $notif['Notification']['vue'] = 0;
                $notif['Notification']['titre'] = 'Nouveau client remplaçant ajouté';
                $notif['Notification']['message'] = $message;
                $notif['Notification']['lien'] = '/notifications';
                $this->Notification->create();
                $this->Notification->save($notif);
            }

            ob_clean();
            echo json_encode(['success' => true, 'client_id' => $new_client_id]);
        } else {
            ob_clean();
            echo json_encode([
                'success' => false,
                'message' => 'Erreur lors de la création du client',
                'errors' => $this->Client->validationErrors
            ]);
        }
    }


    function login()
    {
        $this->loadModel("User");

        // React Native sends JSON, not form data
        $data = $this->request->data;
        if (empty($data)) {
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $username = isset($data["User"]["username"]) ? $data["User"]["username"] : null;
        $password = isset($data["User"]["password"]) ? $data["User"]["password"] : null;
        if (!$username || !$password) {
            echo json_encode(array('error' => 'missing_fields'));
            exit();
        }

        // Check if user exists
        $user = $this->User->find('first', array(
            'conditions' => array('User.username' => $username),
            'recursive' => -1
        ));

        if (!$user) {
            echo json_encode(array('error' => 'invalid_username'));
            exit();
        }

        // Inject data back so CakePHP Auth can read it
        $this->request->data = $data;

        if ($this->Auth->login()) {
            if (AuthComponent::user('archive') == 1) {
                $this->User->id = AuthComponent::user('id');
                $token = AuthComponent::user('id') . rand(111111, 99999999);
                $this->User->saveField("iemi", $token);
                if (isset($data["User"]["version"]))
                    $this->User->saveField("version", $data["User"]["version"]);
                $this->Auth->logout();
                echo json_encode(array('token' => $token));
            } else {
                $this->Auth->logout();
                echo json_encode(array('error' => 'archived'));
            }
        } else {
            echo json_encode(array('error' => 'invalid_password'));
        }
        exit();
    }

    function logout($code)
    {
        $this->loadModel("User");
        $this->User->recursive = -1;

        $user = $this->User->find('first', array(
            'conditions' => array('User.archive' => 1, 'User.iemi' => $code)
        ));

        if ($user) {
            $this->User->id = $user['User']['id'];
            $this->User->saveField("iemi", "");
        }

        // Always return a clean JSON logout signal
        header('Content-Type: application/json');
        echo json_encode(array('logout' => true, 'status' => 'ok'));
        exit();
    }




    //function qui envoie feulle de route si il existe
    function clients($token = null)
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
        $this->set(compact("data", "code"));
    }





    function statistique($code = null, $date_debut = null, $date_fin = null)
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
        $this->loadModel('Objectif');
        $objectifs = $this->Objectif->find("all", array("conditions" => array("Objectif.user_id" => $user["User"]["id"])));

        $data = array();
        $data["objectif"] = array();
        foreach ($objectifs as $obj) {
            $type = $obj["Type"]["name"];
            $data[$type]["nb_visiter"] = 0;
            $data[$type]["objectif"] = 0;
            $data[$type]["objectifjour"] = 0;
            $data[$type]["jour"] = 0;
            $data[$type]["globaljour"] = 0;
        }

        // Compte les visites par type directement (user + type + date), independamment
        // de la liste planifiee cette semaine. Chaque type d'objectif est donc traite,
        // y compris ceux qui ne sont pas affectes a la tournee active.
        $this->Visite->recursive = 0;
        foreach ($objectifs as $obj) {
            $typeId = $obj["Type"]["id"];
            $typeName = $obj["Type"]["name"];
            $objectif = $obj["Objectif"]["objectif"];

            // Visites de la semaine (entre date_debut et date_fin)
            $nb_visiter = $this->Visite->find("count", array(
                "conditions" => array(
                    'Visite.archive' => '1',
                    "Visite.user_id" => $user['User']['id'],
                    "DATE(Visite.date) >= '$date_debut' and DATE(Visite.date) <= '$date_fin'",
                    "Client.type_id" => $typeId
                )
            ));

            // Visites du jour
            $jour = $this->Visite->find("count", array(
                "conditions" => array(
                    'Visite.archive' => '1',
                    "Visite.user_id" => $user['User']['id'],
                    "DATE(Visite.date)" => date("Y-m-d"),
                    "Client.type_id" => $typeId
                )
            ));

            $data[$typeName]["nb_visiter"] = $nb_visiter;
            $data[$typeName]["objectif"] = $objectif;
            $data[$typeName]["objectifjour"] = ($objectif == 0) ? 0 : round(($nb_visiter / $objectif), 2);
            $data[$typeName]["jour"] = $jour;
            $data[$typeName]["globaljour"] = ($objectif == 0) ? 0 : round(($jour * 5 / $objectif), 2);
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
        $this->set(compact("data", "code"));
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

    function brochure($code = null)
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
                    $d["Brochure"]["file2"] = $b["Brochure"]["file2"];
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
        $this->set(compact("data", "code"));
    }

    function formations($code)
    {
        $this->loadModel('Formation');
        $formations = $this->Formation->find('all', array('conditions' => array('Formation.archive' => 1)));
        $this->set(compact("formations", "code"));
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
        // if ($user["User"]["id"] == 241) {
        //     debug($clients);
        //     exit();
        // }



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

    function boite($code)
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
                $this->redirect(array('action' => 'index', $code));
            } else {
                $this->Session->setFlash("Échec de l'enregistrement de votre idée.");
            }
        }
        $this->set(compact("code", ));
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






    function rapport_medcin($code, $client_id, $visite_id, $timer = 0)
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
        //     $this->redirect(array('action' => 'index', $code));
        // }
        $produits = "";
        $gammes = "";
        if ($this->request->is('post')) {
            //debug($this->request->data);exit();
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array(
                            'conditions' => array(
                                'Stockgadjet.user_id' => $user_id,
                                'Stockgadjet.echantillon_id' => $value['echantillon_id']
                            )
                        ));
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

            $heure = explode(" ", $visite['Visite']['created']);
            $this->request->data["Visite"]['date'] = $this->request->data["Visite"]['date'] . " " . $heure[1];
            ;

            $this->request->data["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visite['Visite']['date']);

            $this->Visite->id = $visite_id;
            if ($this->Visite->save($this->request->data)) {
                $visite_id = $this->Visite->id;
                $this->stock_ordre($this->request->data["Visite"]["order"], $visite_id);

                $this->Session->setFlash('Rapport envoyé');
            } else {
                $this->Session->setFlash('Erreur dans le rapport, merci de réessayer');
            }
            $this->redirect(array('action' => 'index', $code));
        }

        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array(
            'conditions' => array(
                'Stockgadjet.user_id' => $user_id,
                'Stockgadjet.quantite>0'
            )
        ));
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
        $this->set(compact('code', "user_id", 'stock', "client_id", "infosclient", "produits", "games", "produits_stock", "ordres", "visite_id"));
    }

    function rapport_pharmacie($code, $client_id, $visite_id)
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
        //     $this->redirect(array('action' => 'index', $code));
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
                    $this->redirect(array('action' => 'index', $code));
                    //$this->Session->setFlash(__('Rapport ajouté'));
                    //return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
                } else {
                    $this->Session->setFlash('Erreur dans le rapport, merci de réessayer');
                    $this->redirect(array('action' => 'index', $code));
                    //$this->Session->setFlash("Erreur dans le rapport, merci de réessayer");
                    //return $this->redirect();
                }
            }
        }

        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array(
            'conditions' => array(
                'Stockgadjet.user_id' => $user_id,
                'Stockgadjet.quantite>0'
            )
        ));

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
        //hadi a supprimer
        $timer = "";
        $this->set(compact('code', "user_id", 'stock', 'timer', "client_id", "infosclient", "produits", "games", 'clients', "produits_stock", "visite_id", "user"));
    }

    //hada dial ordre de produit a afficher
    function system_get_ordre($ligne_id, $category_id)
    {

        $this->loadModel("Brochure");
        $data = $this->Brochure->Brochureorganise->find("all", array("conditions" => array("Brochureorganise.ligne_id" => $ligne_id, "Brochureorganise.category_id" => $category_id), "order" => array("Brochureorganise.ordre" => "ASC")));
        return $data;
    }

    //hada dial gammes li kaynin f ligne dyal user
    function system_get_games_by_ligne($ligne_id)
    {
        $this->loadModel('Brochureorganise');
        $this->loadModel('Game');

        $this->Brochureorganise->recursive = 0;
        $organises = $this->Brochureorganise->find('all', array(
            'conditions' => array(
                'Brochureorganise.ligne_id' => $ligne_id,
                'Brochureorganise.brochure_id is not null',
                'Brochureorganise.ordre is not null'
            ),
            'order' => array('Brochureorganise.category_id' => 'ASC', 'Brochureorganise.ordre' => 'ASC')
        ));

        $game_ids = array();
        foreach ($organises as $organise) {
            if (!empty($organise['Brochure']['game_id'])) {
                $game_ids[$organise['Brochure']['game_id']] = $organise['Brochure']['game_id'];
            }
        }

        if (empty($game_ids)) {
            return array();
        }

        return $this->Game->find('list', array(
            'conditions' => array(
                'Game.archive' => 1,
                'Game.id' => array_values($game_ids)
            ),
            'order' => array('Game.name' => 'ASC')
        ));
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



    function valider_visite_double($code, $id = null, $lan = 0, $lon = 0)
    {
        $this->loadModel('Apartient');
        $this->loadModel('Visite');
        $this->loadModel('Client');
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }


        $visites = $this->Visite->find('all', array(
            'conditions' => array('Visite.type_visite ' => "double", 'Visite.double_id' => $user['User']['id'], "Visite.double_date_validation is null")
        ));

        // if ($user['User']['id'] == 202) {
        //     debug($visites, 0, 0);
        //     exit();
        // }
        $this->set(compact("code", "visites", "lan", "lon"));
    }


    /**
     * Rapport Médecin V2 — Nouveau formulaire unifié
     * Sections : Objectif visite, Feedback produits, Concurrents, EMG, Commentaire, ODP, Requête CRM
     */
    function add_rapport_v2($code, $client_id, $visite_id)
    {
        $this->layout = "mobile";
        $this->loadModel("User");
        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));

        if (empty($user)) {
            echo "[]";
            exit;
        }

        $user_id = $user["User"]["id"];

        if ($this->request->is('post')) {
            // --- 1. Objectif de visite (checkboxes → CSV) ---
            if (!empty($this->request->data['Visite']['objectif_visite']) && is_array($this->request->data['Visite']['objectif_visite'])) {
                $this->request->data['Visite']['objectif_visite'] = implode(',', $this->request->data['Visite']['objectif_visite']);
            } else {
                $this->request->data['Visite']['objectif_visite'] = '';
            }

            // --- 2. Feedback Produits (répétable → JSON dans produit_adoption) ---
            if (!empty($this->request->data['FeedbackProduit'])) {
                $feedbacks = array();
                foreach ($this->request->data['FeedbackProduit'] as $fb) {
                    if (!empty($fb['produit_id'])) {
                        $pid = $fb['produit_id'];
                        $objections = array();
                        if (!empty($fb['objection_retour']) && is_array($fb['objection_retour'])) {
                            foreach ($fb['objection_retour'] as $obj_key => $obj_data) {
                                $objections[$obj_key] = array(
                                    'retour' => isset($obj_data['retour']) ? $obj_data['retour'] : '',
                                    'preciser' => isset($obj_data['preciser']) ? $obj_data['preciser'] : ''
                                );
                            }
                        }
                        $feedbacks[$pid] = array(
                            'objections' => $objections,
                            'adoption' => isset($fb['adoption']) ? $fb['adoption'] : ''
                        );
                    }
                }
                $this->request->data['Visite']['produit_adoption'] = json_encode($feedbacks, JSON_UNESCAPED_UNICODE);
            } else {
                $this->request->data['Visite']['produit_adoption'] = null;
            }

            // --- 3. Prescription concurrents (répétable → JSON dans concurrence_p) ---
            if (!empty($this->request->data['Concurrent'])) {
                $concurrents = array();
                foreach ($this->request->data['Concurrent'] as $cc) {
                    if (!empty($cc['produit_id']) || !empty($cc['concurrent'])) {
                        $concurrents[] = array(
                            'produit_id' => isset($cc['produit_id']) ? $cc['produit_id'] : '',
                            'concurrent' => isset($cc['concurrent']) ? $cc['concurrent'] : '',
                            'frequence' => isset($cc['frequence']) ? $cc['frequence'] : ''
                        );
                    }
                }
                $this->request->data['Visite']['concurrence_p'] = json_encode($concurrents, JSON_UNESCAPED_UNICODE);
            } else {
                $this->request->data['Visite']['concurrence_p'] = null;
            }

            // --- 4. Distribution EMG (Oui/Non + produits → JSON) ---
            $emg = array('distribue' => false, 'produits' => array());
            if (isset($this->request->data['Emg']['distribue']) && $this->request->data['Emg']['distribue'] == '1') {
                $emg['distribue'] = true;
                if (!empty($this->request->data['EmgProduit'])) {
                    foreach ($this->request->data['EmgProduit'] as $ep) {
                        if (!empty($ep['produit_id']) && $ep['quantite'] !== '' && $ep['quantite'] !== null) {
                            $emg['produits'][] = array(
                                'produit_id' => $ep['produit_id'],
                                'quantite' => (int) $ep['quantite']
                            );
                        }
                    }
                }
            }
            $this->request->data['Visite']['distribution_emg'] = json_encode($emg, JSON_UNESCAPED_UNICODE);

            // --- 5. Commentaire → déjà dans data[Visite][commentaire] ---

            // --- 6. ODP (Ordre de présentation) → déjà dans data[Visite][order] ---

            // --- 7. Requête CRM → déjà dans data[Visite][requete_crm] ---

            // --- Calcul du timer ---
            $visite = $this->Visite->findById($visite_id);
            $this->request->data["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visite['Visite']['date']);

            // --- Sauvegarde ---
            $this->Visite->id = $visite_id;
            if ($this->Visite->save($this->request->data)) {
                // Sauvegarder ODP dans visiteordres
                if (!empty($this->request->data["Visite"]["order"])) {
                    $this->stock_ordre($this->request->data["Visite"]["order"], $visite_id);
                }

                // --- Notification Requête CRM ---
                if (!empty($this->request->data['Visite']['requete_crm'])) {
                    $this->loadModel('Client');
                    $this->Client->recursive = -1;
                    $client_crm = $this->Client->findById($client_id);
                    $this->loadModel('User');
                    $admins = $this->User->find('all', array('conditions' => array('User.role' => 'Admin', 'User.archive' => 1)));
                    $this->loadModel('Notification');

                    $client_name = trim($client_crm['Client']['nom'] . ' ' . $client_crm['Client']['prenom']);
                    $requete = $this->request->data['Visite']['requete_crm'];

                    // Build a readable message with clickable links baked in
                    $wr = $this->webroot;
                    $lk_delegue = "<a href='" . $wr . "users/view/" . $user_id . "'>" . htmlspecialchars($user['User']['name'], ENT_QUOTES, 'UTF-8') . "</a>";
                    $lk_client = "<a href='" . $wr . "clients/view/" . $client_id . "'>" . htmlspecialchars($client_name, ENT_QUOTES, 'UTF-8') . "</a>";
                    $message = $lk_delegue . " a soumis une requête pour " . $lk_client . " : " . htmlspecialchars($requete, ENT_QUOTES, 'UTF-8');

                    foreach ($admins as $admin) {
                        $this->Notification->create();
                        $notifData = array();
                        $notifData['Notification']['user_id'] = $admin['User']['id'];
                        $notifData['Notification']['user1_id'] = $user_id;
                        $notifData['Notification']['titre'] = "Requête CRM";
                        $notifData['Notification']['message'] = $message;
                        $notifData['Notification']['vue'] = 0;
                        $notifData['Notification']['lien'] = '/notifications';
                        $this->Notification->save($notifData);
                    }
                }

                $this->Session->setFlash('Rapport envoyé');
            } else {
                $this->Session->setFlash('Erreur dans le rapport, merci de réessayer');
            }
            $this->redirect(array('action' => 'index', $code));
        }

        // --- GET : Charger les données pour le formulaire ---
        $this->loadModel('Client');

        $this->Visite->Client->recursive = -1;
        $client = $this->Visite->Client->findById($client_id);
        $ordres = $this->system_get_ordre($user["User"]["ligne_id"], $client["Client"]["category_id"]);
        $games = $this->system_get_games_by_ligne($user["User"]["ligne_id"]);

        $this->set(compact('code', 'user_id', 'client_id', 'games', 'ordres', 'visite_id'));
    }

    /**
     * Rapport Pharmacie V2 — Nouveau formulaire unifié
     */
    function add_rapport_pharmacie_v2($code, $client_id, $visite_id)
    {
        $this->layout = "mobile";
        $this->loadModel("User");
        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));

        if (empty($user)) {
            echo "[]";
            exit;
        }

        $user_id = $user["User"]["id"];

        if ($this->request->is('post')) {
            // --- 1. Objectif de visite (checkboxes → CSV) ---
            if (!empty($this->request->data['Visite']['objectif_visite']) && is_array($this->request->data['Visite']['objectif_visite'])) {
                $this->request->data['Visite']['objectif_visite'] = implode(',', $this->request->data['Visite']['objectif_visite']);
            } else {
                $this->request->data['Visite']['objectif_visite'] = '';
            }

            // --- 2. Analyse Produits (répétable → JSON dans produit_adoption) ---
            if (!empty($this->request->data['AnalyseProduit'])) {
                $analyses = array();
                foreach ($this->request->data['AnalyseProduit'] as $ap) {
                    if (!empty($ap['produit_id'])) {
                        $pid = $ap['produit_id'];
                        $analyses[$pid] = array(
                            'disponibilite' => isset($ap['disponibilite']) ? $ap['disponibilite'] : '',
                            'grossiste' => isset($ap['grossiste']) ? $ap['grossiste'] : '',
                            'dispo_boites' => isset($ap['dispo_boites']) ? $ap['dispo_boites'] : '',
                            'rotation_boites' => isset($ap['rotation_boites']) ? $ap['rotation_boites'] : '',
                            'prescripteurs' => isset($ap['prescripteurs']) ? $ap['prescripteurs'] : '',
                            'produit_conseille' => isset($ap['produit_conseille']) ? $ap['produit_conseille'] : '',
                            'promesse' => isset($ap['promesse']) ? $ap['promesse'] : '',
                            'nombre_boites' => isset($ap['nombre_boites']) ? $ap['nombre_boites'] : ''
                        );
                    }
                }
                $this->request->data['Visite']['produit_adoption'] = json_encode($analyses, JSON_UNESCAPED_UNICODE);
            } else {
                $this->request->data['Visite']['produit_adoption'] = null;
            }

            // --- 3. Prescription concurrents (répétable → JSON dans concurrence_p) ---
            if (!empty($this->request->data['Concurrent'])) {
                $concurrents = array();
                foreach ($this->request->data['Concurrent'] as $cc) {
                    if (!empty($cc['produit_id']) || !empty($cc['produit_concurrent'])) {
                        $concurrents[] = array(
                            'produit_id' => isset($cc['produit_id']) ? $cc['produit_id'] : '',
                            'produit_concurrent' => isset($cc['produit_concurrent']) ? $cc['produit_concurrent'] : '',
                            'type_offre' => isset($cc['type_offre']) ? $cc['type_offre'] : '',
                            'remise_bons' => isset($cc['remise_bons']) ? $cc['remise_bons'] : '',
                            'remise_financiere' => isset($cc['remise_financiere']) ? $cc['remise_financiere'] : '',
                            'remise_unites' => isset($cc['remise_unites']) ? $cc['remise_unites'] : '',
                            'emplacement' => isset($cc['emplacement']) ? $cc['emplacement'] : ''
                        );
                    }
                }
                $this->request->data['Visite']['concurrence_p'] = json_encode($concurrents, JSON_UNESCAPED_UNICODE);
            } else {
                $this->request->data['Visite']['concurrence_p'] = null;
            }

            // --- 4. Distribution EMG (Oui/Non + produits → JSON) ---
            $emg = array('distribue' => false, 'produits' => array());
            if (isset($this->request->data['Emg']['distribue']) && $this->request->data['Emg']['distribue'] == '1') {
                $emg['distribue'] = true;
                if (!empty($this->request->data['EmgProduit'])) {
                    foreach ($this->request->data['EmgProduit'] as $ep) {
                        if (!empty($ep['produit_id']) && $ep['quantite'] !== '' && $ep['quantite'] !== null) {
                            $emg['produits'][] = array(
                                'produit_id' => $ep['produit_id'],
                                'quantite' => (int) $ep['quantite']
                            );
                        }
                    }
                }
            }
            $this->request->data['Visite']['distribution_emg'] = json_encode($emg, JSON_UNESCAPED_UNICODE);

            // --- 5. Commentaire → déjà dans data[Visite][commentaire] ---

            // --- 6. ODP (Ordre de présentation) → déjà dans data[Visite][order] ---

            // --- 7. Requête CRM → déjà dans data[Visite][requete_crm] ---

            // --- Calcul du timer ---
            $visite = $this->Visite->findById($visite_id);
            $this->request->data["Visite"]['timer'] = $this->calcul_timer(date("Y-m-d H:i:s"), $visite['Visite']['date']);

            // --- Sauvegarde ---
            $this->Visite->id = $visite_id;
            if ($this->Visite->save($this->request->data)) {
                // Sauvegarder ODP dans visiteordres
                if (!empty($this->request->data["Visite"]["order"])) {
                    $this->stock_ordre($this->request->data["Visite"]["order"], $visite_id);
                }

                // --- Notification Requête CRM ---
                if (!empty($this->request->data['Visite']['requete_crm'])) {
                    $this->loadModel('Client');
                    $this->Client->recursive = -1;
                    $client_crm = $this->Client->findById($client_id);
                    $this->loadModel('User');
                    $admins = $this->User->find('all', array(
                        'conditions' => array('User.role' => 'Admin', 'User.archive' => 1),
                        'recursive' => -1,
                        'fields' => array('User.id')
                    ));
                    $this->loadModel('Notification');

                    $client_name = trim($client_crm['Client']['nom'] . ' ' . $client_crm['Client']['prenom']);
                    $requete = $this->request->data['Visite']['requete_crm'];

                    // Build a readable message with clickable links baked in
                    $wr = $this->webroot;
                    $lk_delegue = "<a href='" . $wr . "users/view/" . $user_id . "'>" . htmlspecialchars($user['User']['name'], ENT_QUOTES, 'UTF-8') . "</a>";
                    $lk_client = "<a href='" . $wr . "clients/view/" . $client_id . "'>" . htmlspecialchars($client_name, ENT_QUOTES, 'UTF-8') . "</a>";
                    $message = $lk_delegue . " a soumis une requête (Pharmacie) pour " . $lk_client . " : " . htmlspecialchars($requete, ENT_QUOTES, 'UTF-8');

                    foreach ($admins as $admin) {
                        $this->Notification->create();
                        $notifData = array();
                        $notifData['Notification']['user_id'] = $admin['User']['id'];
                        $notifData['Notification']['user1_id'] = $user_id;
                        $notifData['Notification']['titre'] = "Requête CRM";
                        $notifData['Notification']['message'] = $message;
                        $notifData['Notification']['vue'] = 0;
                        $notifData['Notification']['lien'] = '/notifications';
                        $this->Notification->save($notifData);
                    }
                }

                $this->Session->setFlash('Rapport envoyé');
            } else {
                $this->Session->setFlash('Erreur dans le rapport, merci de réessayer');
            }
            $this->redirect(array('action' => 'index', $code));
        }

        // --- GET : Charger les données pour le formulaire ---
        $this->loadModel('Client');

        $this->Visite->Client->recursive = -1;
        $client = $this->Visite->Client->findById($client_id);
        $ordres = $this->system_get_ordre($user["User"]["ligne_id"], $client["Client"]["category_id"]);
        $games = $this->system_get_games_by_ligne($user["User"]["ligne_id"]);

        $this->set(compact('code', 'user_id', 'client_id', 'games', 'ordres', 'visite_id'));
    }

    public function notifications($code)
    {
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (!isset($user["User"]["id"])) {
            echo "[]";
            exit;
        }
        $user_id = $user["User"]["id"];
        $user_name = $user["User"]["name"];

        $this->loadModel("Notification");
        $this->Notification->recursive = -1;
        $notifications = $this->Notification->find('all', array(
            'conditions' => array('Notification.user_id' => $user_id),
            'order' => array('Notification.created' => 'DESC'),
            'limit' => 50
        ));

        // Mark all as read when they view notifications page
        $this->Notification->updateAll(
            array('Notification.vue' => 1),
            array('Notification.user_id' => $user_id, 'Notification.vue' => 0)
        );

        $this->set(compact("code", "notifications", "user_id", "user_name"));
    }

    public function unread_notifications_count($code)
    {
        $this->autoRender = false;
        $this->response->type('json');
        
        $this->loadModel("User");
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        
        if (!isset($user["User"]["id"])) {
            $this->response->body(json_encode(array('success' => false, 'message' => 'User not found')));
            return;
        }

        $this->loadModel("Notification");
        $count = $this->Notification->find('count', array(
            'conditions' => array(
                'Notification.user_id' => $user["User"]["id"],
                'Notification.vue' => 0
            ),
            'recursive' => -1
        ));

        $this->response->body(json_encode(array('success' => true, 'count' => $count)));
    }

    /**
     * Save or update the FCM push notification token for a mobile user.
     * Called by the React Native app on each launch.
     * URL: /appwebfinalv2/system_save_fcm_token/{iemi}/{token}
     * Note: 'system' prefix bypasses CakePHP Auth (see AppController::isAuthorized)
     */
    public function system_save_fcm_token($code = null)
    {
        $this->autoRender = false;
        $this->response->type('json');

        // FCM token is passed as query string to avoid CakePHP routing issues with special chars
        $token = isset($_GET['fcm']) ? trim($_GET['fcm']) : null;

        if (empty($code) || empty($token)) {
            $this->response->body(json_encode(array('success' => false, 'message' => 'Missing parameters')));
            return;
        }

        try {
            App::uses('ConnectionManager', 'Model');
            $db = ConnectionManager::getDataSource('default');
            $pdo = $db->getConnection();

            // Clear this token from any other users to prevent duplicates (one device token = one active user)
            $stmtClear = $pdo->prepare("UPDATE users SET fcm_token = NULL WHERE fcm_token = ?");
            $stmtClear->execute([$token]);

            // Save the token for the current user
            $stmt = $pdo->prepare("UPDATE users SET fcm_token = ? WHERE iemi = ? AND archive = 1");
            $stmt->execute([$token, $code]);

            $this->response->body(json_encode(array('success' => true, 'rows' => $stmt->rowCount())));
        } catch (Exception $e) {
            $this->response->body(json_encode(array('success' => false, 'message' => $e->getMessage())));
        }
    }

    /**
     * Clear the FCM token for a user when they log out.
     * URL: /appwebfinalv2/system_clear_fcm_token/{iemi}
     */
    public function system_clear_fcm_token($code = null)
    {
        $this->autoRender = false;
        $this->response->type('json');

        if (empty($code)) {
            $this->response->body(json_encode(array('success' => false, 'message' => 'Missing parameter')));
            return;
        }

        try {
            App::uses('ConnectionManager', 'Model');
            $db = ConnectionManager::getDataSource('default');
            $pdo = $db->getConnection();

            $stmt = $pdo->prepare("UPDATE users SET fcm_token = NULL WHERE iemi = ? AND archive = 1");
            $stmt->execute([$code]);

            $this->response->body(json_encode(array('success' => true, 'rows' => $stmt->rowCount())));
        } catch (Exception $e) {
            $this->response->body(json_encode(array('success' => false, 'message' => $e->getMessage())));
        }
    }
}
