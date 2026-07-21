<?php

App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class ClientsController extends AppController
{

    public $components = array('Paginator', 'RequestHandler');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('system_get_retart_client', 'system_commandes', 'system_import_client', 'system_export_client');
    }

    // Add this to your ClientsController on the receiving server

    public function system_import_client()
    {
        // Disable layout and view rendering for JSON response
        $this->layout = 'ajax';
        $this->autoRender = false;

        // Only allow POST requests
        if (!$this->request->is('post')) {
            $this->response->statusCode(405); // Method Not Allowed
            $response = array('status' => 'error', 'message' => 'Method not allowed');
            return $this->response->body(json_encode($response));
        }

        // Check authorization

        // Get JSON input
        $requestData = null;
        try {
            $requestData = $this->request->input('json_decode', true);
        } catch (Exception $e) {
            $this->response->statusCode(400); // Bad Request
            $response = array('status' => 'error', 'message' => 'Invalid JSON data');
            return $this->response->body(json_encode($response));
        }

        // Validate input data
        if (empty($requestData) || empty($requestData['client'])) {
            $this->response->statusCode(400); // Bad Request
            $response = array('status' => 'error', 'message' => 'Invalid input data');
            return $this->response->body(json_encode($response));
        }

        $clientData = $requestData['client'];

        $typeData = $requestData['type'];
        $secteurData = $requestData['secteur'];
        $categoryData = $requestData['category'];
        $category1Data = $requestData['category1'];


        // Check if typeData exists with the same name
        if (!empty($typeData) && !empty($typeData['id']) && !empty($typeData['name'])) {
            $existingType = $this->Client->Type->find('first', array(
                'conditions' => array(
                    'Type.name' => $typeData['name']
                ),
                'recursive' => -1
            ));

            if (empty($existingType)) {
                $this->response->statusCode(404); // Not Found
                $response = array(
                    'status' => 'error',
                    'message' => 'Type with name "' . $typeData['name'] . '" does not exist on this server'
                );
                return $this->response->body(json_encode($response));
            }
        }

        // Check if secteurData exists with the same code_ville
        if (!empty($secteurData) && !empty($secteurData['code_ville']) && !empty($secteurData['secteur'])) {
            $this->loadModel('Secteur'); // Always load model just in case

            $existingSecteur = $this->Secteur->find('first', array(
                'conditions' => array(
                    'Secteur.code_ville' => $secteurData['code_ville'],
                    'Secteur.secteur' => $secteurData['secteur'],
                ),
                'recursive' => -1
            ));

            if (!empty($existingSecteur)) {
                $clientData['secteur_id'] = $existingSecteur['Secteur']['id'];
            } else {
                $this->Secteur->create();
                if ($this->Secteur->save($secteurData)) {
                    $clientData['secteur_id'] = $this->Secteur->id;
                } else {
                    throw new Exception('Failed to save Secteur data: ' . json_encode($this->Secteur->validationErrors));
                }
            }
        }

        // Check if categoryData exists with the same name
        if (!empty($categoryData) && !empty($categoryData['id']) && !empty($categoryData['name'])) {
            $existingCategory = $this->Client->Category->find('first', array(
                'conditions' => array(
                    'Category.name' => $categoryData['name']
                ),
                'recursive' => -1
            ));

            if (empty($existingCategory)) {
                $this->response->statusCode(404); // Not Found
                $response = array(
                    'status' => 'error',
                    'message' => 'Category with name "' . $categoryData['name'] . '" does not exist on this server'
                );
                return $this->response->body(json_encode($response));
            }
        }

        // Check if category1Data exists with the same name
        if (!empty($category1Data) && !empty($category1Data['id']) && !empty($category1Data['name'])) {
            $existingCategory1 = $this->Client->Category1->find('first', array(
                'conditions' => array(
                    'Category1.name' => $category1Data['name']
                ),
                'recursive' => -1
            ));

            if (empty($existingCategory1)) {
                $this->response->statusCode(404); // Not Found
                $response = array(
                    'status' => 'error',
                    'message' => 'Category1 with name "' . $category1Data['name'] . '" does not exist on this server'
                );
                return $this->response->body(json_encode($response));
            }
        }


        // Store original ID for reference
        $originalId = $clientData['id'];


        unset($clientData['id']); // Remove ID for new record creation

        // Check if client already exists - choose ONE method:
        // Method 1: Check by original ID
        // $existingClientById = $this->Client->find('first', array(
        //     'conditions' => array('Client.id' => $originalId)
        // ));


        // Method 2: Check by name (fuzzy match)
        $clientName = str_replace("'", "''", $clientData['nom']);
        $existingClientByName = $this->Client->find('first', array(
            'conditions' => array(
                'Client.nom' => $clientName,
                'Client.type_id =' => $clientData['type_id'],
                'Client.secteur_id =' => $clientData['secteur_id'],
                'Client.category_id =' => $clientData['category_id'],
                'Client.fixe =' => $clientData['fixe'],
                'Client.archive' => 1
            )
        ));

        // Check if a matching client was found
        if (!empty($existingClientByName)) {
            $this->response->statusCode(409); // Conflict
            $response = array(
                'status' => 'error',
                'message' => 'Client already exists',
                'existing_id' => $existingClientByName['Client']['id']
            );
            return $this->response->body(json_encode($response));
        }

        // Start database transaction
        $dataSource = $this->Client->getDataSource();
        $dataSource->begin();

        try {
            // Add original ID as external_id (if you have this field)

            // Create new client record
            $this->Client->create();
            if (!$this->Client->save($clientData)) {
                throw new Exception('Failed to save client data: ' . json_encode($this->Client->validationErrors));
            }

            $newClientId = $this->Client->id;

            // Transaction successful
            $dataSource->commit();

            $response = array(
                'status' => 'success',
                'message' => 'Client imported successfully',
                'data' => array(
                    'original_id' => $originalId,
                    'new_id' => $newClientId
                )
            );

            return $this->response->body(json_encode($response));
        } catch (Exception $e) {
            // Something went wrong, rollback
            $dataSource->rollback();

            $this->response->statusCode(500); // Internal Server Error
            $response = array(
                'status' => 'error',
                'message' => $e->getMessage()
            );

            return $this->response->body(json_encode($response));
        }
    }

    public function system_export_client($id = null)
    {
        // Check if ID is provided
        if (!$id) {
            throw new NotFoundException(__('Invalid client'));
        }


        // Get client with associated users
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));



        if (!$client) {
            throw new NotFoundException(__('Invalid client'));
        }

        // Set the response format
        $this->RequestHandler->respondAs('json');
        $this->response->type('application/json');

        // Disable the view rendering
        $this->autoRender = false;

        // Prepare export data
        $exportData = array('client' => $client['Client'], 'type' => $client['Type'], 'secteur' => $client['Secteur'], 'category' => $client['Category'], 'category1' => $client['Category1']);



        try {
            // send by post this data to another server by post method
            // Create HttpSocket with SSL options
            $httpSocketOptions = array(
                'ssl_verify_host' => false,
                'ssl_verify_peer' => false,
                'ssl_allow_self_signed' => true
            );

            $http = new HttpSocket($httpSocketOptions);
            $url = 'https://connectlabo.com/clients/system_import_client'; // URL to your import endpoint
            $response = $http->post($url, json_encode($exportData), array(
                'header' => array('Content-Type' => 'application/json'),
            ));

            if ($response->isOk()) {
                // Try to decode the JSON response
                $responseData = json_decode($response->body, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    // Return the decoded response
                    return $this->response->body(json_encode($responseData));
                } else {
                    // Just return the raw response
                    return $this->response->body(json_encode(array(
                        'status' => 'success',
                        'message' => 'Client exported successfully'
                    )));
                }
            } else {
                $this->response->statusCode($response->code);
                $responseData = json_decode($response->body);
                // Customize message based on status code
                if ($response->code == 409) { // Conflict status code
                    return $this->response->body(json_encode(array(
                        'status' => 'error',
                        'message' => 'Le client existe déjà sur l\'autre serveur. Veuillez vérifier le client avec id : <b>' . $responseData->existing_id . "</b>."
                    )));
                } else {
                    return $this->response->body(json_encode(array(
                        'status' => 'error',
                        'message' => 'Failed to send data. Server returned: ' . $response->reasonPhrase
                    )));
                }
            }
        } catch (Exception $e) {
            $this->response->statusCode(500);
            return $this->response->body(json_encode(array(
                'status' => 'error',
                'message' => 'Export failed: ' . $e->getMessage()
            )));
        }
    }


    public function system_commandes($id = null, $montant = null)
    {
        $this->Client->recursive = -1;
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));
        if (!empty($client['Client']['activite'])) {
            $ca = $client['Client']['activite'] + $montant;
        } else {
            $ca = $montant;
        }
        //debug($client);
        $this->Client->id = $id;
        //var_dump($this->Client);
        $this->Client->saveField('activite', $ca);
        echo $ca;
        exit();
    }

    function system_getcount_client($type_id, $in = null)
    {
        $inn = " and Client.id in (select client_id from affectations where valide=1) ";
        if ($in == null)
            $in = '';
        if ($in == "0" || $in == "1")
            $in = " and Client.id in (select client_id from affectations where valide=1) ";
        if ($in == '-1')
            $in = " and Client.id not in (select client_id from affectations where valide=1) ";
        $nb_clients = $this->Client->find("count", array('conditions' => array('Client.archive=1', "Client.type_id=$type_id ")));
        $nb_client_affecter = $this->Client->query("select count(id) as idd from clients as Client where type_id=$type_id and Client.id in (select client_id from affectations where valide=1)");
        $nb_client_affecter = $nb_client_affecter[0][0]['idd'];
        return $nb_clients . '||' . $nb_client_affecter;
    }

    function system_recherche($name = 'aicha', $type = null)
    {
        $tt = '';
        if ($type == 1)
            $tt = "and Client.id in (select client_id from affectations where valide=1)";
        if ($type == '-1')
            $tt = "and Client.id not in (select client_id from affectations where valide=1)";
        $clients = array();
        if (strlen($name) > 2) {
            //probleme de / block la requete je les changer dans le view par || et la je le met a l'eta enitial
            $name = str_replace("||", "/", $name);
            $clients = $this->Client->find("all", array(
                'conditions' => array('(CONCAT_WS("",nom,prenom) like"%' . trim($name) . '%" OR Client.nom like "%' . $name . '%" OR Client.prenom like "%' . $name . '%")', "Client.archive=1 $tt"),
                'fields' => array(
                    'Client.id',
                    'type_id',
                    'Client.category1_id',
                    'Client.nom',
                    'Client.prenom',
                    'Client.activite',
                    'Client.titre',
                    'Client.potentialitev2',
                    'Client.tel',
                    'Client.fixe',
                    'Type.name',
                    'Type.id',
                    'Secteur.id',
                    'Secteur.region',
                    'Secteur.code_region',
                    'Secteur.code_ville',
                    'Secteur.code_secteur',
                    'Secteur.ville',
                    'Secteur.secteur',
                    'Category.name',
                    'Category.id',
                    'Category1.name',
                    'Category1.id'
                )
            ));
        } else
            exit();
        $this->set('clients', $clients);
        $this->layout = 'login';
    }

    public function view($id = null, $date_debut = null, $date_fin = null)
    {
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Client invalide'));
        }
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));
        
        

        // Filter the visits if dates are provided
        if (!empty($date_debut) && !empty($date_fin)) 
        {
            

            $this->loadModel('Visite');
            $visites_filtrees = $this->Visite->find('all', array(
                'conditions' => array(
                    'Visite.client_id' => $id,
                    'DATE(Visite.date) >=' => $date_debut,
                    'DATE(Visite.date) <=' => $date_fin,
                    'Visite.archive' => 1
                ),
                'order' => array('Visite.date DESC')
            ));

            // Reformat the result to match the usual CakePHP relation structure inside $client['Visite']
            $client['Visite'] = array();
            foreach ($visites_filtrees as $vf) {
                $client['Visite'][] = $vf['Visite'];
            }
        }

        if ($client["Client"]["type_id"] == 1) {
            //Pour un utilisateur simple
            if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
                $this->loadModel('Liste');
                $existe = $this->Liste->Affectation->find("count", array('conditions' => array(
                    'Affectation.client_id' => $id,
                    'Liste.user_id' => AuthComponent::user('id')
                )));
                if ($existe == 0)
                    return $this->redirect(array('controller' => 'users', 'action' => 'view'));
            }
            //Pour un superviseur
            if (AuthComponent::user('role') == 'Super viseur') {
                $this->loadModel('Liste');
                $this->loadModel('Apartient');
                $this->Apartient->recursive = -1;
                $super = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                $ids = AuthComponent::user('id');
                foreach ($super as $value) {
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];
                }
                $existe = $this->Liste->Affectation->find("count", array('conditions' => array(
                    'Affectation.client_id' => $id,
                    "Liste.user_id in($ids)"
                )));
                if ($existe == 0)
                    return $this->redirect(array('controller' => 'users', 'action' => 'view'));
            }
        }
        $this->loadModel('Produit');
        $stockreel = $this->requestaction("/stockvisites/system_get_stock_client/$id");
        $this->loadModel('Game');
        $produits = $this->Produit->find('list');
        $this->loadModel('Gadgetclient');
        $gadgetclients = $this->Gadgetclient->find('list', array('fields' => array('Gadgetclient.name', 'Gadgetclient.name'), 'group' => 'Gadgetclient.name'));
        $gadgetclientall = $this->Gadgetclient->find('all', array('conditions' => array('Gadgetclient.client_id' => $id), "order" => array("Gadgetclient.id desc")));
        $gammes = $this->Game->find('list');


        //laisser que les visites de user si ce n'ai pas admin 
        if (AuthComponent::user('role') != 'Admin')
        {
            $ids=[];
            $ids[] = AuthComponent::user('id');
            if (AuthComponent::user('role') == 'Super viseur') {
                $this->loadModel('Apartient');
                $this->Apartient->recursive = -1;
                $super = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                foreach ($super as $value) {
                    $ids[] = $value["Apartient"]['user1_id'];
                }
            }
            foreach ($client['Visite'] as $key => $value) 
            {
                if (!in_array($value['user_id'], $ids)) 
                {
                    unset($client['Visite'][$key]);
                }
            }
        }

        // Pass original $date_debut & $date_fin to the view in case they are needed
        $this->set(compact("gammes", "produits", 'client', "stockreel", "gadgetclients", "gadgetclientall"));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($type = null)
    {
        if ($this->request->is('post')) {
            $this->Client->create();
            // Handle new hospital creation from Select2 tag
            if (!empty($this->request->data['Client']['hopital_id'])) {
                $hopVal = $this->request->data['Client']['hopital_id'];
                if (strpos($hopVal, '__new__:') === 0) {
                    $hopName = trim(substr($hopVal, strlen('__new__:')));
                    if ($hopName) {
                        $this->loadModel('Hopital');
                        $this->Hopital->create();
                        if ($this->Hopital->save(array('Hopital' => array('name' => $hopName)))) {
                            $this->request->data['Client']['hopital_id'] = $this->Hopital->getLastInsertID();
                        }
                    } else {
                        $this->request->data['Client']['hopital_id'] = null;
                    }
                }
            }
            if (isset($this->request->data['Client']['produits']) && !empty($this->request->data['Client']['produits'])) {
                foreach ($this->request->data['Client']['produits'] as $value)
                    $ids = $ids . $value . ',';
                $this->request->data['Client']['produit'] = substr($ids, 0, -1);
            }
            if (!isset($this->request->data['Client']['e']))
                $this->request->data['Client']['e'] = "";
            $this->request->data['Client']['potentialite'] = $this->request->data['Client']['A'] . $this->request->data['Client']['1'] . $this->request->data['Client']['e'];
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash(__('Client ajouté'));
                return $this->redirect(array('action' => 'view', $this->Client->id));
            } else {
                $this->Session->setFlash(__('Le client n\'a pas pu être enregistré. Merci de réessayer.'));
            }
        }
        $this->loadModel('Game');
        $produits = $this->Game->find('list');
        $types = $this->Client->Type->find('list');
        $secteurs = $this->Client->Secteur->find('list');
        $categories = $this->Client->Category->find('list');
        $this->loadModel('Hopital');
        $this->Hopital->recursive = -1;
        $all_hopitals = $this->Hopital->find('list', array('fields' => array('Hopital.id', 'Hopital.name'), 'order' => array('Hopital.name' => 'ASC')));
        $this->set(compact('type', 'types', 'secteurs', 'categories', "produits", "all_hopitals"));
    }

    public function edit($id = null)
    {
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Client invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            // Handle new hospital creation from Select2 tag
            if (!empty($this->request->data['Client']['hopital_id'])) {
                $hopVal = $this->request->data['Client']['hopital_id'];
                if (strpos($hopVal, '__new__:') === 0) {
                    $hopName = trim(substr($hopVal, strlen('__new__:')));
                    if ($hopName) {
                        $this->loadModel('Hopital');
                        $this->Hopital->create();
                        if ($this->Hopital->save(array('Hopital' => array('name' => $hopName)))) {
                            $this->request->data['Client']['hopital_id'] = $this->Hopital->getLastInsertID();
                        }
                    } else {
                        $this->request->data['Client']['hopital_id'] = null;
                    }
                }
            }
            if (isset($this->request->data['Clientspropose']))
                $this->request->data['Client']['secteur_id'] = $this->request->data['Clientspropose']['secteur_id'];
            if (!isset($this->request->data['Client']['e']))
                $this->request->data['Client']['e'] = "";
            $this->request->data['Client']['potentialite'] = $this->request->data['Client']['A'] . $this->request->data['Client']['1'] . $this->request->data['Client']['e'];
            if (isset($this->request->data['Client']['produits'])) {
                $ids = "";
                foreach ($this->request->data['Client']['produits'] as $value)
                    $ids = $ids . $value . ',';
                $this->request->data['Client']['produit'] = substr($ids, 0, -1);
            }
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash(__('Client modifié'));
                return $this->redirect(array('action' => 'view', $this->request->data['Client']['id']));
            } else {
                $this->Session->setFlash(__('Le client n\'a pas pu être modifié. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
            $this->request->data = $this->Client->find('first', $options);
        }
        $this->loadModel('Game');
        $produits = $this->Game->find('list');
        $types = $this->Client->Type->find('list');
        $secteurs = $this->Client->Secteur->find('list');
        $this->Client->Secteur->recursive = -1;
        $secteurs = $this->Client->Secteur->find('all');
        $regions = array();
        $villes = array();
        foreach ($secteurs as $s) {
            if (!isset($regions[$s["Secteur"]["region"]]))
                $regions[$s["Secteur"]["region"]][] = $s["Secteur"]["ville"];
            if (!in_array($s["Secteur"]["ville"], $regions[$s["Secteur"]["region"]]))
                $regions[$s["Secteur"]["region"]][] = $s["Secteur"]["ville"];
            $villes[$s["Secteur"]["ville"]][$s["Secteur"]["id"]] = $s["Secteur"]["secteur"];
            //exit();
        }

        $secteur = $this->Client->Secteur->findById($this->request->data['Client']['secteur_id']);

        $categories = $this->Client->Category->find('list');
        $this->loadModel('Hopital');
        $this->Hopital->recursive = -1;
        $all_hopitals = $this->Hopital->find('list', array('fields' => array('Hopital.id', 'Hopital.name'), 'order' => array('Hopital.name' => 'ASC')));
        $this->set(compact("villes", 'produits', 'types', 'categories', 'regions', "secteur", "all_hopitals"));
    }

    public function archive($id = null, $valide = null)
    {
        if ($id == null) {
            $this->Client->recursive = 0;
            $this->set('clients', $this->Client->find('all', array('conditions' => array('Client.archive' => 0))));
        } else {
            $this->Client->id = $id;
            $this->Client->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Client archivé'));
            } else {
                $this->Session->setFlash(__('Client activé'));
            }
            $this->redirect($this->referer());
        }
    }

    function archivetous()
    {
        $this->Client->query('UPDATE clients SET `archive`=0');
        $this->Session->setFlash(__('Tout les clients sont archivés'));
        return $this->redirect(array('action' => 'archive'));
    }

    //demander dans le controller ListeController/listeretard 268
    function system_get_retart_client($id, $user_id)
    {
        $this->loadModel("Liste");
        $this->Liste->recursive = -1;
        $date_fin = date('Y-m-d', strtotime(date('Y-m-d') . " -7 day "));
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));
        //debug($client);
        $liste = 0;
        if (empty($client))
            return 0;
        foreach ($client['Affectation'] as $value) {
            if ($value['liste_id'] != null && $value['valide'] == 1) {
                $count = $this->Liste->find('count', array('conditions' => array('Liste.id' => $value['liste_id'], 'Liste.user_id' => $user_id)));
                if ($count != 0)
                    $liste = $liste . ',' . $value['liste_id'];
            }
        }
        //echo $liste;
        $this->loadModel('Plantourne');
        $plans = $this->Plantourne->query("select count(id) as nb from plantournes as Plantourne "
            . "where date >='" . $client['Client']['date_recrutement'] . "' and date <='" . $date_fin . "' and  liste_id in($liste)");
        $visite = 0;
        foreach ($client['Visite'] as $value) {
            if ($value['date'] >= $client['Client']['date_recrutement'] && $value['user_id'] == $user_id)
                $visite++;
        }
        return $plans[0][0]['nb'] - $visite;
    }

    //get_retard_clientsfromvmofsuperviseur
    function system_get_retart_client_vm($user_id)
    {
        $ids = array();
        $listess = array();
        $clients = array();
        $cli = array();
        $this->loadModel("Liste");
        $this->loadModel("Apartient");
        $this->loadModel("Affectation");
        $this->loadModel("Plantourne");
        $this->loadModel("Visite");
        $this->Liste->recursive = -1;
        $this->Apartient->recursive = -1;
        $users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $user_id), 'fields' => 'Apartient.user1_id'));
        foreach ($users as $u) {
            $ids[] = $u['Apartient']['user1_id'];
        }
        $listes = $this->Liste->find('all', array('conditions' => array('Liste.archive' => 1, 'Liste.user_id' => $ids), 'fields' => 'Liste.id'));
        foreach ($listes as $l) {
            $listess[] = $l['Liste']['id'];
        }
        //debug($listess);
        $mondaylastweek = date('Y-m-d', strtotime('last monday -7 days'));
        //echo $mondaylastweek;
        $endweek = date('Y-m-d', strtotime('last monday -1 days'));
        //echo $endweek;
        $listees = $this->Plantourne->find('all', array('conditions' => array('Plantourne.liste_id' => $listess, 'Plantourne.date' => $mondaylastweek), 'fields' => 'Plantourne.liste_id'));
        $listeess = array();
        foreach ($listees as $l) {
            $listeess[] = $l['Plantourne']['liste_id'];
        }
        $clientss = $this->Affectation->find('all', array('conditions' => array('Affectation.valide' => 1, 'Affectation.liste_id' => $listeess, 'Client.potentialite' => array('A1', 'B1')), 'fields' => 'Affectation.client_id'));
        foreach ($clientss as $c) {
            //$clients[]=$c['Affectation']['client_id'];
            $lastvisit = $this->Visite->find('first', array('conditions' => array('Visite.client_id' => $c['Affectation']['client_id']), 'order' => array('Visite.date DESC')));
            if (!empty($lastvisit['Visite']['date'])) {
                $datevisite = date('Y-m-d', strtotime($lastvisit['Visite']['date']));
                if ($datevisite < $mondaylastweek || $datevisite > $endweek) {
                    if (!empty($lastvisit['Client']['id']))
                        $cli[$lastvisit['Client']['id']] = $datevisite;
                }
            } else {
                $cli[$c['Affectation']['client_id']] = 'jamais visité';
            }
        }
    }

    //had le function me retourn las date li nsaw madaroch fiha les visites dialhom
    //demander view  /clients/view 67
    function system_get_retard_list_client($id)
    {
        $this->loadModel("Liste");
        $this->Liste->recursive = -1;
        $client = $this->Client->find('first', array('conditions' => array('Client.id' => $id)));
        $liste = 0;
        foreach ($client['Affectation'] as $value) {
            if ($value['liste_id'] != null && $value['valide'] == 1) {
                $count = 1;
                if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')
                    $count = $this->Liste->find('count', array('conditions' => array('Liste.archive' => 1, 'Liste.user_id' => AuthComponent::user('id'))));
                if ($count != 0)
                    $liste = $liste . ',' . $value['liste_id'];
            }
        }
        if ($client['Client']['date_recrutement'] == null)
            $client['Client']['date_recrutement'] = $client['Client']['created'];
        $this->loadModel('Plantourne');
        $plans = $this->Plantourne->query("select * from plantournes as Plantourne "
            . "where date >='" . $client['Client']['date_recrutement'] . "' and date <='" . date('Y-m-d') . "' and  liste_id in($liste)");
        $date = array();
        foreach ($plans as $v) {
            $visite = 0;
            $date_debut = $v['Plantourne']['date'];
            $date_fin = date('Y-m-d', strtotime($date_debut . ' + 7 days'));
            foreach ($client['Visite'] as $value) {
                if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
                    if ($value['date'] >= $date_debut && $date_fin >= $value['date'] && $value['user_id'] == AuthComponent::user('id')) {
                        $visite++;
                        break;
                    }
                } else if ($value['date'] >= $date_debut && $date_fin >= $value['date']) {
                    $visite++;
                    break;
                }
            }
            if ($visite == 0)
                $date[] = $v['Plantourne']['date'];
        }
        $date['nobre'] = count($plans);
        //        debug($date);
        //        debug($plans);
        //        debug($client['Visite']);
        asort($date);
        return $date;
    }

    //semander in /clients/statistique_pot_detail line 46
    // demander dans Prospects/tableau_bord_conseiller. ctp line 122
    function system_get_client($id, $date_debut = null, $date_fin = null)
    {
        //$this->Client->recursive = -1;
        $client = $this->Client->find('first', array(
            'fields' => array('*', 'Type.name', 'Secteur.secteur', 'Category.name'),
            'conditions' => array('Client.id' => $id)
        ));
        return $client;
    }

    //fonction qui suprimer les liste de retard et les visite jsute les chifre
    function remettre0($id = null)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        if ($id == null) {
            $this->Client->query("UPDATE clients SET `date_recrutement`='" . date('Y-m-d') . "'");
            $this->Session->setFlash(__('Tous les retards des clients sont remis à 0'));
            $this->redirect(array('action' => 'allclients'));
        } else {
            $this->Client->id = $id;
            $this->Client->saveField('date_recrutement', date('Y-m-d'));
            $this->Session->setFlash(__('Retard du client remis à 0'));
            $this->redirect(array('action' => 'view', $id));
        }
    }

    function desafecter($id = null, $affectation_id = null)
    {
        $this->loadModel('Affectation');
        if ($this->request->is('post')) {
            $this->Affectation->create();
            $d['Affectation']['client_id'] = $this->request->data['Clients']['client_id'];
            $d['Affectation']['liste_id'] = $this->request->data['Affectation']['liste_id'];
            $this->Affectation->save($d);
            $this->Session->setFlash("Client Affecter.");
            $this->redirect(array('action' => 'view', $this->request->data['Clients']['client_id']));
        }
        if ($affectation_id == null)
            $this->redirect(array('action' => 'view', $id));
        $this->Affectation->id = $affectation_id;
        /* $this->Affectation->recursive=-1;
          $aff=$this->Affectation->find('all',array("conditions"=>array("Affectation.client_id"=>$id,"Affectation.id"=>$affectation_id,"Affectation.valide"=>0)));
          if(!empty($aff))
          $this->Affectation->query("delete from affectations where id=".$aff["Affectation"]["id"]);
          else */

        $this->Affectation->saveField('valide', 0);
        $this->Session->setFlash("Client Désaffecté.");
        $this->redirect(array('action' => 'view', $id));
    }

    function statistique_visites($user_id = 0)
    {
        $type = 0;
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->loadModel("Apartient");
        $this->Apartient->recursive = -1;
        $this->loadModel("User");
        $this->User->recursive = -1;

        $date_debut = date("Y-01-01");
        $date_fin = date("Y-12-31");
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        }
        if (isset($_GET['type'])) {
            $type = $_GET['type'];
        }
        if ($user_id != 0) {
            $userFornie = $this->User->findById($user_id);
            if ($userFornie["User"]['role'] == 'Super viseur') {
                $users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $user_id)));
                if ($type != 0)
                    $ids = '0';
                else
                    $ids = $user_id;
                foreach ($users as $value)
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];

                $visites = $this->Client->query("select nbvisite, count(*) as nbclientvisiter  from (
                                    select count(visites.client_id) as nbvisite from visites,clients 
                                     where visites.client_id=clients.id and clients.type_id=1 and visites.user_id in ($ids) and visites.archive=1 and date BETWEEN '$date_debut' and '$date_fin' group by client_id ) as visite
                              group by visite.nbvisite");
            } else
                $visites = $this->Client->query("select nbvisite, count(*) as nbclientvisiter  from (
					select count(visites.client_id) as nbvisite from visites,clients where visites.client_id=clients.id and clients.type_id=1 and visites.user_id =$user_id and visites.archive=1 and date BETWEEN '$date_debut' and '$date_fin' group by client_id ) as visite
						group by visite.nbvisite");
        } else {
            if (AuthComponent::user('role') == 'Super viseur') {
                $users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                if ($type != 0)
                    $ids = '0';
                else
                    $ids = AuthComponent::user('id');
                foreach ($users as $value)
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];
                $visites = $this->Client->query("select nbvisite, count(*) as nbclientvisiter  from (
                                    select count(visites.client_id) as nbvisite from visites ,clients 
                                     where visites.client_id=clients.id and clients.type_id=1 and visites.user_id in ($ids) and visites.archive=1 and date BETWEEN '$date_debut' and '$date_fin' group by client_id ) as visite
                              group by visite.nbvisite");
            } else {
                $visites = $this->Client->query("select nbvisite, count(*) as nbclientvisiter  from (
                                    select count(visites.client_id) as nbvisite from visites,clients 
                                     where visites.client_id=clients.id and clients.type_id=1 and visites.archive=1 and date BETWEEN '$date_debut' and '$date_fin' group by client_id ) as visite
                              group by visite.nbvisite");
            }
        }
        if (AuthComponent::user('role') != 'Super viseur' && AuthComponent::user('role') != 'VMP') {
            $super = $this->User->find("all", array('conditions' => array('User.role' => "Super viseur", 'User.archive' => 1)));
            $this->set("super", $super);
        }
        $this->set(compact("user_id", 'visites', 'date_debut', 'date_fin', "type", "user_id"));
    }

    function detail_visites($nombre, $date_debut, $date_fin, $type = null)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        if (AuthComponent::user('role') == 'Super viseur') {
            $this->loadModel("Apartient");
            $this->Apartient->recursive = -1;
            $users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            if ($type == null) {
                $ids = AuthComponent::user('id');
                foreach ($users as $value)
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            } else if ($type == 0) {
                $ids = "0";
                foreach ($users as $value)
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            } else
                $ids = $type;


            if ($nombre == 0) {
                $visites = $this->Client->query(" SELECT * FROM (
                                select users.name,client_id from affectations,users,listes where affectations.liste_id=listes.id
                                and listes.user_id =users.id and users.id in ($ids) and listes.archive=1 and  valide=1 and client_id not in(
                               SELECT visites.client_id
                               FROM visites 
                               where  visites.date BETWEEN '$date_debut' and '$date_fin' and archive=1 
                               GROUP BY visites.client_id )
                               GROUP BY client_id) temp_table");
            } else {
                $visites = $this->Client->query("SELECT *
                    FROM (
                                  SELECT users.name,client_id, COUNT(client_id) as cnt
                                  FROM visites ,users
                                  where visites.user_id in ($ids) and visites.archive=1 and visites.user_id=users.id and date BETWEEN '$date_debut' and '$date_fin'
                                  GROUP BY client_id
                                  HAVING cnt = $nombre
                     ) temp_table");
            }
        } else {
            if ($type != null && $type != 0)
                $type = "and users.id=$type ";
            else
                $type = "";
            if ($nombre == 0) {
                $visites = $this->Client->query(" SELECT * FROM (
                                select users.name,client_id from affectations,users,listes where affectations.liste_id=listes.id
                                and listes.user_id =users.id $type and  valide=1 and listes.archive=1 and client_id not in(
                               SELECT visites.client_id
                               FROM visites 
                               where  visites.date BETWEEN '$date_debut' and '$date_fin' and archive=1 
                               GROUP BY visites.client_id )
                               GROUP BY client_id) temp_table");
            } else {
                $visites = $this->Client->query("SELECT *
			  FROM (
					SELECT users.name,client_id, COUNT(client_id) as cnt
					FROM visites ,users
					where visites.archive=1 and visites.user_id=users.id $type and date BETWEEN '$date_debut' and '$date_fin'
					GROUP BY client_id
					HAVING cnt = $nombre
			   ) temp_table");
            }
        }
        $this->Client->recursive = 0;
        $this->Client->Type->recursive = -1;
        $types = $this->Client->Type->find('list');
        $this->set('types', $types);
        $clients = null;
        $ids = 0;
        foreach ($visites as $visite) {
            $ids = $ids . "," . $visite['temp_table']['client_id'];
        }
        $clients = $this->Client->find('all', array('conditions' => array('Client.archive' => 1, "Client.id in ($ids)")));
        $this->set(compact("nombre", 'visites', 'clients', 'date_debut', 'date_fin'));
    }

    //Statistique pour potencialité 
    function statistique_pot()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $date_debut = $date = date('Y-01-01');
        $date_fin = $date = date('Y-m-d');
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        }
        $this->loadModel('User');
        $this->loadModel('Liste');
        $this->loadModel('Plantourne');
        if (AuthComponent::user('role') == 'Super viseur')
            $supers = $this->User->find('all', array('conditions' => array(
                'User.archive' => 1,
                'User.id' => AuthComponent::user('id'),
                "User.role" => 'Super viseur'
            )));
        else
            $supers = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));
        $users = array();
        $this->User->Apartient->recursive = -1;
        $this->User->recursive = -1;
        $info = array();
        foreach ($supers as $super) {
            if ($super["User"]['id'] == 2)
                continue;

            $vmp = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]['id'])));
            $vmp[100]["Apartient"]['user1_id'] = $super["User"]['id'];
            $vmp[100]["Apartient"]['user_id'] = $super["User"]['id'];
            foreach ($vmp as $value) {
                $ids = "0";
                foreach ($vmp as $vvv)
                    $ids = $ids . ',' . $vvv["Apartient"]['user1_id'];
                $u = array();
                $u = $this->User->find('all', array(
                    'conditions' => array("User.id in($ids)", 'User.archive' => 1)
                ));
                $u["super"] = $super;
                $users[$super["User"]['id']] = $u;
                $listes = $this->User->Liste->find('all', array('conditions' => array('Liste.user_id' => $value["Apartient"]['user1_id'], 'Liste.archive' => 1)));

                $ids_client = "0";
                foreach ($listes as $client) {
                    $visite_planifier = 0;
                    foreach ($client["Plantourne"] as $v) {
                        if ($v["date"] >= $date_debut && $v['date'] <= $date_fin)
                            $visite_planifier++;
                    }

                    foreach ($client["Affectation"] as $v) {
                        $ids_client = $ids_client . ',' . $v['client_id'];
                    }

                    //Recupéré les Pot avec le nombre
                    $visites = $this->Client->query("select potentialite,count(clients.id) as client  from clients
                                    where clients.id in($ids_client) group by clients.potentialite;");
                    foreach ($visites as $visite) {
                        if (!isset($info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]])) {
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["pot"] = $visite["clients"]["potentialite"];
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["nombre"] = $visite["0"]["client"];
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["visite_planifier"] = $visite_planifier * $visite["0"]["client"];
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["visite"] = 0;
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["action"] = 0;
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["visite0"] = 0;
                        } else {
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["nombre"] += $visite["0"]["client"];
                            $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["visite_planifier"] += $visite_planifier * $visite["0"]["client"];
                        }
                    }
                }
                //Recupéré  le nombre des visites
                $visites = $this->Client->query("select potentialite,count(visites.id) as visite "
                    . "from clients,visites where clients.id=visites.client_id "
                    . "and visites.user_id in(" . $super["User"]['id'] . ",$ids) and visites.date >='$date_debut' and visites.date <='$date_fin'"
                    . "and visites.archive=1  group by clients.potentialite");

                foreach ($visites as $visite) {
                    if (isset($info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]))
                        $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["visite"] = $visite["0"]["visite"];

                    //Recupéré  le nombre des clients jamais visiter
                    $jamaisvister = $this->Client->query(" select count(client_id)as v from visites "
                        . " where client_id in($ids_client)  and "
                        . " date >='$date_debut' and date <='$date_fin' and archive=1");

                    if (isset($info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]))
                        $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["visite0"] = $jamaisvister[0][0]["v"];
                }




                //Recupéré  le nombre des actions
                $visites = $this->Client->query("select potentialite,count(actions.id) as action 
                        from clients,actions where clients.id=actions.client_id 
                        and actions.user_id in(" . $super["User"]['id'] . ",$ids) and actions.date_debut >='$date_debut'
                        and actions.archive=2  group by clients.potentialite");
                foreach ($visites as $visite) {
                    if (isset($info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]))
                        $info[$value["Apartient"]['user_id']][$visite["clients"]["potentialite"]]["action"] = $visite["0"]["action"];
                }
                //exit();
            }
            //debug($info);
        }
        $this->set(compact('info', 'users', "date_debut", "date_fin"));
    }

    //fonction de detail pour potentialité 
    function statistique_pot_detail($super_id, $pot, $date_debut = null, $date_fin = null)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        if ($date_fin == null) {
            $date_debut = $date = date('Y-01-01');
            $date_fin = $date = date('Y-m-d');
        }
        $this->loadModel('User');
        $this->loadModel('Liste');
        $this->loadModel('Plantourne');
        $super = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.id' => $super_id)));
        $users = array();
        $this->User->Apartient->recursive = -1;
        $this->User->recursive = -1;
        $info = array();
        $vmp = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]['id'])));
        $vmp[100]["Apartient"]['user1_id'] = $super["User"]['id'];
        $vmp[100]["Apartient"]['user_id'] = $super["User"]['id'];
        foreach ($vmp as $value) {
            $ids = "0";
            foreach ($vmp as $vvv)
                $ids = $ids . ',' . $vvv["Apartient"]['user1_id'];
            $u = array();
            $u = $this->User->find('all', array(
                'conditions' => array("User.id in($ids)", 'User.archive' => 1)
            ));
            $u["super"] = $super;
            $users[$super["User"]['id']] = $u;
            $listes = $this->User->Liste->find('all', array('conditions' => array(
                'Liste.user_id' => $value["Apartient"]['user1_id'],
                'Liste.archive' => 1
            )));
            foreach ($listes as $client) {
                $visite_planifier = 0;
                foreach ($client["Plantourne"] as $v) {
                    if ($v["date"] >= $date_debut && $v['date'] <= $date_fin)
                        $visite_planifier++;
                }
                $ids_client = "0";
                foreach ($client["Affectation"] as $v) {
                    $ids_client = $ids_client . ',' . $v['client_id'];
                }

                //Recupéré les Pot avec le nombre
                $visites = $this->Client->query("select categories.name as potentialitev2,count(clients.id) as client  from clients,categories
                                    where clients.id in($ids_client) and potentialitev2='$pot' and categories.id=clients.category_id group by categories.name;");
                foreach ($visites as $visite) {
                    if (!isset($info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]])) {
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["pot"] = $visite["categories"]["potentialitev2"];
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["nombre"] = $visite["0"]["client"];
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["visite_planifier"] = $visite_planifier * $visite["0"]["client"];
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["visite"] = 0;
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["action"] = 0;
                        $clients_idd = $this->Client->query("select clients.id as client  from clients,categories
                                    where clients.id in($ids_client) and potentialitev2='$pot' and categories.name='" . $visite["categories"]["potentialitev2"] . "' and categories.id=clients.category_id");
                        $ids_cl = "0";
                        foreach ($clients_idd as $id_clien) {
                            $ids_cl = $ids_cl . ',' . $id_clien["clients"]["client"];
                        }
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["clients"] = $ids_cl;
                    } else {
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["nombre"] += $visite["0"]["client"];
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["visite_planifier"] += $visite_planifier * $visite["0"]["client"];
                        $clients_idd = $this->Client->query("select clients.id as client  from clients,categories
                                    where clients.id in($ids_client) and potentialitev2='$pot' and categories.name='" . $visite["categories"]["potentialitev2"] . "' and categories.id=clients.category_id");
                        $ids_cl = $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["clients"];
                        foreach ($clients_idd as $id_clien) {
                            $ids_cl = $ids_cl . ',' . $id_clien["clients"]["client"];
                        }
                        $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["clients"] = $ids_cl;
                    }
                }
            }
            //Recupéré  le nombre des visites
            $visites = $this->Client->query("select categories.name as potentialitev2,count(visites.id) as visite "
                . "from clients,visites,categories where clients.id=visites.client_id and categories.id=clients.category_id "
                . "and visites.user_id in(" . $super["User"]['id'] . ",$ids) and potentialitev2='$pot' and  visites.date >='$date_debut' and visites.date <='$date_fin'"
                . "and visites.archive=1  group by categories.name");

            foreach ($visites as $visite) {
                if (isset($info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]))
                    $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["visite"] = $visite["0"]["visite"];
            }

            //Recupéré  le nombre des actions
            $visites = $this->Client->query("select categories.name as potentialitev2,count(actions.id) as action 
                        from clients,actions,categories where clients.id=actions.client_id and categories.id=clients.category_id 
                        and actions.user_id in(" . $super["User"]['id'] . ",$ids) and potentialitev2='$pot' and actions.date_debut >='$date_debut'
                        and actions.archive=2  group by categories.name");
            foreach ($visites as $visite) {
                if (isset($info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]))
                    $info[$value["Apartient"]['user_id']][$visite["categories"]["potentialitev2"]]["action"] = $visite["0"]["action"];
            }
            //recupéré la liste des clients
        }
        $this->set(compact('info', 'users', 'date_debut', "date_fin"));
    }

    //demandes des clients qui son affecter a un VM mais qui sommes jamais visiter ou visiter une seul fois 
    //saprend bcp de temps mais sa marche 
    function system_getclientnonvisiter()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->loadModel('Client');
        $visites = $this->Client->query('select * from clients where archive=1 and id in (
                                                select client_id from affectations where valide=1 and client_id not in(
                                                        SELECT visites.client_id
                                                        FROM visites 
                                                        where  visites.date >"2018-01-01" and archive=1 
                                                        GROUP BY visites.client_id )
                                                GROUP BY client_id);');
        debug($visites);
        exit();
    }

    function trouverdoublons()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '180'); // 3 minutes
        $clients = array();
        if ($this->request->is('post')) {
            $where = "archive=1";
            $group = $having = "";
            $select = "id";
            if (isset($this->request->data["type"])) {
                $where = $where . " and LOWER(type_id)=LOWER(" . $this->request->data["type"] . ')';
            }
            if (isset($this->request->data["champs"])) {
                $i = 0;
                $count = '';
                foreach ($this->request->data["champs"] as $id => $k) {
                    if ($i == 0)
                        $count = 'as c ';

                    $select = $select . " ,$k,count($k) $count ";
                    $group = $group . " $k,";
                    $having = $having . " COUNT($k) > 1  and ";

                    $i++;
                    $count = '';
                }
                $group = rtrim($group, ', ');
                $having = rtrim($having, 'and ');
                $where = $where . " and LOWER(type_id)=LOWER(" . $this->request->data["type"] . ")";
            } else {
                $this->Session->setFlash("Merci de choisir champs");
                return $this->redirect(array('action' => 'trouverdoublons'));
            }
            $req = "SELECT $select FROM clients WHERE $where GROUP BY $group HAVING $having LIMIT 100;";
            $this->Client->recursive = -1;
            $data = $this->Client->query($req);
            foreach ($data as $client) {
                if ($client[0]["c"] == 2) {
                    if (isset($this->request->data["champs"])) {
                        $conditions = " archive =1";
                        foreach ($this->request->data["champs"] as $id => $k) {
                            $client["clients"][$k] = str_replace("'", "", $client["clients"][$k]);
                            $conditions = $conditions . " and $k='" . $client["clients"][$k] . "' ";
                        }
                    }
                    $cc = $this->Client->find("all", array("conditions" => array($conditions)));
                    $clients[] = $cc;
                }
            }
        }
        $this->Client->Secteur->recursive = -1;
        $secteurs = $this->Client->Secteur->find("all");
        $types = $this->Client->Type->find("list");
        $this->set(compact("clients", 'secteurs', "types"));
    }

    //function apppler une seule fois dans users/tableau_bord_super.ctp line 125
    //elle recoie liste des ids clients visiter 
    //elle retourne la liste des clients demander 
    function system_get_clients_ids($ids = 0)
    {
        $clients = $this->Client->query("SELECT id, nom,prenom,activite,potentialitev2,potentialite,type_id FROM clients WHERE id in ($ids) and archive=1");
        return $clients;
    }

    //function qui envoie toutes les VM avec un tableau qui contient ga3 les clients li kainin f ses listes
    function statistiqueListeParVM()
    {
        $this->loadModel("User");
        $this->User->recursive = -1;
        $users = $this->User->find("list", array('conditions' => array('User.archive' => 1)));
        $data = array();
        $i = 0;
        foreach ($users as $key => $value) {
            $ids_client = "0";
            $listes = $this->User->Liste->find('all', array('conditions' => array('Liste.archive' => 1, "Liste.user_id" => $key)));
            foreach ($listes as $liste) {
                if (!empty($liste["Affectation"])) {
                    foreach ($liste["Affectation"] as $af)
                        $ids_client = $ids_client . "," . $af["client_id"];
                }
            }
            if (strlen($ids_client) > 2) {
                $clients = $this->Client->query("select categories.name  , potentialitev2, potentialite,activite,type_id,longitude from clients,categories where clients.id in($ids_client) and categories.id=clients.category_id ");
                $data[$i]["Client"] = $clients;
                $data[$i]["User"]["id"] = $key;
                $data[$i]["User"]["name"] = $value;
                $i++;
            }
        }
        $alltypes = $this->Client->Type->find("list");
        $this->set("data", $data);
        $this->set("alltypes", $alltypes);
    }

    function system_get_name_client($id)
    {
        $this->Client->recursive = -1;
        $user = $this->Client->findById($id);
        return $user['Client']['nom'] . ' ' . $user['Client']['prenom'];
    }

    //100%
    //appeler dans prospectcompagne/view.ctp 109
    function system_get_client_all($id)
    {
        $this->Client->recursive = -1;
        $client = $this->Client->findById($id);
        return $client;
    }

    // version simplifié de index des clients une fois stable nhaydh la fonction index oula nhez l code nhato f index
    function allclients()
    {
        $clients = array();
        if ($this->request->is('post')) {

            if (isset($this->request->data["client_search"])) {
                $search = $this->request->data["client_search"];
                $clients = $this->Client->find('all', array("conditions" => array("(Client.nom like '%$search%' or Client.prenom like '%$search%' or Client.dirigent like '%$search%' "
                    . "or  Client.code_wavsoft like '%$search%') and Client.archive=1")));//limit 1000
            } else {
                $secteurs = $catesgories = "0";
                if (isset($this->request->data["Client"]["secteur"])) {
                    foreach ($this->request->data["Client"]["secteur"] as $k => $v)
                        $secteurs .= ",$v";
                    $secteurs = "Client.secteur_id in($secteurs) ";
                }
                if (isset($this->request->data["Client"]["catesgorie"])) {
                    foreach ($this->request->data["Client"]["catesgorie"] as $k => $v)
                        $catesgories .= ",$v";
                    $catesgories = " Client.category_id in($catesgories) ";
                }
                $limit = $this->request->data["Client"]["limit"];
                $clients = $this->Client->find("all", array("conditions" => array(
                    "Client.archive" => 1,
                    "$secteurs",
                    " $catesgories limit $limit"
                )));
            }
        }

        $nombreclientsaffecter = $this->Client->query("SELECT COUNT(DISTINCT(clients.id)) AS countt FROM clients,affectations 
                WHERE clients.id=affectations.client_id AND affectations.valide=1 ");
        $nb_client_affecter = $nombreclientsaffecter[0][0]["countt"];
        $nb_clients = $this->Client->find("count", array("conditions" => array("Client.archive" => 1)));

        $secteurs = $this->Client->Secteur->find("list");

        //$catesgories = array("35" => "PHARMACIES", "36" => "PARA DIRECT", "37" => "PARA GROSSISTES");
        $catesgories = $this->Client->Category->find("list");
        $limite = 100;
        $this->set(compact("nb_clients", "nb_client_affecter", 'secteurs', 'catesgories', 'limite', 'clients'));
    }



    function infoClientParMois($user_id = null)
    {
        $clients = array();
        if ($this->request->is('post')) {
            $user_id = $this->request->data["Client"]["user_id"];
            $code = $user_id;
            $this->loadModel('Liste');
            $listes = $this->Liste->find('all', array('conditions' => array('Liste.user_id' => $code, 'Liste.archive' => 1)));
            $ids = 0;
            foreach ($listes as $liste) {
                foreach ($liste["Affectation"] as $value) {
                    if ($value["valide"] == 1)
                        $ids = $ids . ',' . $value['client_id'];
                }
            }
            $this->loadModel('Client');
            $this->loadModel("Visite");
            $this->loadModel("Category");
            $this->Client->recursive = -1;
            $this->Visite->recursive = -1;
            $categories = $this->Category->find("list");
            $visites = $this->Visite->find("all", array("conditions" => array(
                "Visite.client_id in($ids)",
                "Visite.user_id" => $code,
                "Visite.archive" => 1,
                "DATE(Visite.date) BETWEEN '" . date('Y-01-01') . "' AND '" . date('Y-12-31') . "'"
            )));
            $clients = $this->Client->find("all", array("conditions" => array("Client.id in($ids)", "Client.archive" => 1)));
            $i = 0;
            foreach ($clients as $client) {
                $vv = array();
                $visitess = array();
                foreach ($visites as $visite) {
                    if ($visite["Visite"]["client_id"] != $client["Client"]["id"])
                        continue;
                    $mois = explode("-", $visite["Visite"]["date"]);
                    $mois = $mois[1];
                    if (!isset($vv[$mois]))
                        $vv[$mois] = 0;
                    $vv[$mois] = $vv[$mois] + 1;
                    $visitess[] = $visite["Visite"];
                }
                $clients[$i]["mois"] = $vv;
                $clients[$i]["Visite"] = $visitess;
                $clients[$i]["category"] = $categories[$client["Client"]["category_id"]];
                $i++;
            }
        }
        /*else
		{
			$clients = $this->Client->find("all",array("conditions"=>array("Client.archive"=>1)));
			$i=0;
			foreach($clients as $client)
			{
				$visites=array();
				foreach($client["Visite"] as $visite)
				{
					$mois=explode("-",$visite["date"]);
					$mois=$mois[1];
					if(!isset($visites[$mois]))
						$visites[$mois]=0;
					$visites[$mois]=$visites[$mois]+1;
				}
				$clients[$i]["mois"]=$visites;
				$i++;
			}
		}*/
        $this->set("clients", $clients);
        $this->loadModel("User");
        $users = $this->User->find("list", array("conditions" => array("User.archive" => 1)));
        $this->loadModel("Secteur");
        $secteurs = $this->Secteur->find("list");
        $cats = $this->Client->Category->find("list");
        $this->set(compact("users", "secteurs", "cats"));
    }
}
