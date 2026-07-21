<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController
{

    function beforeFilter()
    {

        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', "system_rachid", "save_Image", "tableau_bord_super_formail", 'system_get_superviseur', 'system_get_promotion', 'system_view'); //,'system_get_superviseur','system_get_name_user');
        if ($this->action == 'add') {
            $this->Auth->enabledenabled = false;
        }
        if ($this->action == 'login') {
            $this->Auth->autoRedirect = true;
        }
        $this->Auth->authError = __('Vous devez être connecté.');
        $this->Auth->loginError = __('Nom d\'utilisateur ou mot de passe invalide, réessayez');
    }

    function system_view() {}


    function login()
    {

        if (AuthComponent::user('name')) {
            if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')
                $this->redirect(array('action' => 'view'));

            else if (AuthComponent::user('role') == 'Ressource humain')
                $this->redirect(array('controller' => 'absences', 'action' => 'valider'));
            else if (AuthComponent::user('role') == 'Teleconseiller')
                $this->redirect(array('controller' => 'rapportprocpects', 'action' => 'fuille_route_conseiller'));
            else
                $this->redirect(array('action' => 'tableau_bord_super'));
        }

        $titre = __('Se connecter');
        $this->set(compact('titre'));
        if ($this->request->is('post')) {

            if ($this->Auth->login()) {
                // hash the user's password
                //$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                // write the cookie
                //$this->Cookie->write('esna', $this->request->data['User'], true, '2 weeks');


                $this->User->Droit->recursive = -1;
                $droits = $this->User->Droit->find('list', array('conditions' => array('Droit.user_id' => AuthComponent::user('id'))));
                $this->Session->write('droits', $droits);

                if (AuthComponent::user('archive') != 1) {
                    $this->Auth->logout();
                    $this->Session->setFlash('Votre compte est suspendu Merci de nous contacter.');
                    $this->redirect(array('action' => 'login'));
                }
                if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')
                    $this->redirect(array('action' => 'view'));
                else if (AuthComponent::user('role') == 'Ressource humain')
                    $this->redirect(array('controller' => 'absences', 'action' => 'valider'));
                else
                    $this->redirect(array('action' => 'tableau_bord_super'));
            } else
                $this->Session->setFlash(__('E-mail ou mot de passe incorrect. Veuillez réessayer.'));
        }
        $this->layout = 'login';
    }

    function logout()
    {
        $this->Auth->logout();
        $this->Cookie->destroy();
        $this->redirect(array('action' => 'login'));
    }

    public function index($tous = null)
    {
        $this->User->recursive = 0;
        if ($tous == null) {
            if (AuthComponent::user('role') == 'Super viseur') {
                $this->User->Apartient->recursive = -1;
                $users = $this->User->Apartient->find('all', array('conditions' =>
                array('Apartient.user_id' => AuthComponent::user('id'))));
                $ids = '0';
                foreach ($users as $value)
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];
                $users = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));
            } else
                $users = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));
        } else {
            $users = $this->User->find('all', array('conditions' => array('User.archive' => 1)));
            $this->set('tous', $tous);
        }
        $this->set('users', $users);
    }

    public function view($id = null)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $date_debut = date("Y-m-01");
        $date_fin = date("Y-m-t");
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        }
        if ($id == null || AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')
            $id = AuthComponent::user('id');
        else if ($id != null && AuthComponent::user('role') == 'Super viseur') {
            $super = $this->system_get_superviseur($id);
            if (empty($super) || AuthComponent::user('id') != $super['Apartient']['user_id'])
                $id = AuthComponent::user('id');
        }
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        $ligne = $this->User->Ligne->find('first', array('conditions' => array('Ligne.id' => $user["User"]["ligne_id"])));
        $objectifs = $this->User->Objectif->find('all', array('conditions' => array('Objectif.user_id' => $id, 'Objectif.archive' => 1)));
        $visites = $this->User->Visite->find('all', array('conditions' => array('Visite.user_id' => $id, 'Visite.archive' => 1, "Visite.date between '$date_debut' and '$date_fin 23:59:59'")));
        $user["Visite"] = $visites;
        $user["Objectif"] = $objectifs;
        $user["Ligne"] = $ligne["Ligne"];
        //debug($objectifs);exit();
        $this->loadModel('Liste');
        $listess = $this->Liste->find('list', array('conditions' => array('Liste.user_id' => $id, 'Liste.archive' => 1)));
        $listes = [];
        foreach ($listess as $id => $name) {
            $aff = $this->Liste->Affectation->find('count', array(
                'conditions' => array(
                    'Affectation.liste_id' => $id,
                    'Affectation.valide' => 1
                )
            ));
            $listes[] = array(
                'id' => $id,
                'name' => $name,
                'count' => $aff
            );
        }

        $this->loadModel('Type');
        $this->loadModel('Produit');
        $this->loadModel('Game');
        $this->loadModel('Category');
        $produits = $this->Produit->find('list');
        $categories = $this->Category->find('list');
        $gammes = $this->Game->find('list');
        $types = $this->Type->find('list');
        $super = $this->requestAction("/users/system_get_superviseur/$id");
        $this->set(compact("categories", 'gammes', "super", "user", 'id', 'date_debut', 'date_fin', "produits", "types", "listes"));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->User->create();
            $date = date('H-i-s');
            $file = $this->request->data['User']['image']['tmp_name'];
            $ext = substr($this->request->data['User']['image']['name'], -4);
            if (!empty($file)) {
                $this->request->data['User']['image'] = $date . '' . rand() . "$ext";
                move_uploaded_file($file, 'img/users/' . $this->request->data['User']['image']);
            } else
                $this->request->data['User']['image'] = null;

            $ids = 0;
            foreach ($this->request->data["ville"] as $k => $v)
                $ids = $ids . ",$v";
            $this->request->data["User"]["villes"] = $ids;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Utilisateur ajouté'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'utilisateur n\'a pas pu être enregistré. Merci de réessayer.'));
            }
        }

        $regions = $this->User->Secteur->find("list", array("fields" => array("id", "region"), "group" => array("region")));
        $villes = array();
        foreach ($regions as $k => $v)
            $villes[$v] = $this->User->Secteur->find("list", array("fields" => array("id", "ville"), "conditions" => array("Secteur.region" => $v), "group" => array("ville")));
        $lignes = $this->User->Ligne->find('list');
        $this->set(compact('lignes', "villes"));
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Utilisateur invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['User']['image'])) {
                $date = date('H-i-s');
                $file = $this->request->data['User']['image']['tmp_name'];
                $ext = substr($this->request->data['User']['image']['name'], -4);
                if (!empty($file)) {
                    $this->request->data['User']['image'] = $date . '' . rand() . "$ext";
                    move_uploaded_file($file, 'img/users/' . $this->request->data['User']['image']);
                } else {
                    $d = $this->User->find('first', array('conditions' => array('User.id' => $id)));
                    $this->request->data['User']['image'] = $d['User']['image'];
                }
            }

            if (isset($this->request->data["ville"])) {
                $ids = 0;
                foreach ($this->request->data["ville"] as $k => $v)
                    $ids = $ids . ",$v";
                $this->request->data["User"]["villes"] = $ids;
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Utilisateur modifié'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'utilisateur n\'a pas pu être modifié. Merci de réessayer.'));
            }
        } else {
            $this->request->data = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        }

        $regions = $this->User->Secteur->find("list", array("fields" => array("id", "region"), "group" => array("region")));
        $villes = array();
        foreach ($regions as $k => $v)
            $villes[$v] = $this->User->Secteur->find("list", array("fields" => array("id", "ville"), "conditions" => array("Secteur.region" => $v), "group" => array("ville")));
        $selected = $this->User->Secteur->find("list", array("fields" => array("id", "ville"), "conditions" => array("Secteur.id in(0" . $this->request->data["User"]["villes"] . ")")));
        $lignes = $this->User->Ligne->find('list');

        $this->set(compact('lignes', "villes", 'selected'));
    }

    public function affectation()
    {
        if ($this->request->is('post')) {
            /*$ap = $this->User->Apartient->findByUser1Id($this->request->data['Apartient']['user1_id']);
            if (!empty($ap)) {
                $this->User->Apartient->id = $ap['Apartient']['id'];
                $this->User->Apartient->saveField('user_id', $this->request->data['Apartient']['superviseurs']);
            } else {*/
            $this->User->Apartient->create();
            $this->request->data['Apartient']['user_id'] = $this->request->data['Apartient']['superviseurs'];
            $this->User->Apartient->save($this->request->data);
            // }
            $this->Session->setFlash(__('Affectation réussie'));
            $this->redirect(array('action' => 'affectation'));
        }
        $this->User->recursive = -1;
        $this->loadModel('Apartient');
        $this->Apartient->recursive = -1;
        $users = $this->User->find('all', array("fields" => array("User.id", "User.name", "User.username", "User.role"), 'conditions' => array('User.role in ("VMP","Coordinateur","Super viseur")', 'User.archive' => 1)));
        $temp = array();
        foreach ($users as $k => $v)
            $temp[$v['User']['id']] = $v;
        $users = $temp;
        $superviseurs = $this->User->find('list', array('conditions' => array('User.role' => 'Super viseur', 'User.archive' => 1)));
        $affectations = $this->Apartient->find('all');
        foreach ($affectations as $aff) {
            $userId = $aff["Apartient"]["user1_id"]; // VMP ou superviseur
            $superId = $aff["Apartient"]["user_id"];  // son superviseur direct

            if (!isset($users[$userId])) {
                continue; // utilisateur non trouvé ( archivé)
            }
            if (!isset($users[$userId]["User"]["supers"])) {
                $users[$userId]["User"]["supers"] = array();
            }

            // vérifier que le superviseur existe dans la liste
            if (isset($superviseurs[$superId])) {
                $super = array(
                    "super" => $superviseurs[$superId],
                    "apartient_id" => $aff["Apartient"]["id"],
                    "type" => $aff["Apartient"]["type"]
                );
                $users[$userId]["User"]["supers"][] = $super;
            }
        }
        //debug($users);exit();
        $this->set('users', $users);
        $this->set('superviseurs', $superviseurs);
    }

    public function supprimer_affectation($id = null)
    {
        $this->loadModel('Apartient');
        $this->Apartient->id = $id;
        if (!$this->Apartient->exists()) {
            throw new NotFoundException(__('Invalid Affectation'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Apartient->delete()) {
            $this->Session->setFlash(__('L\'affectation a été supprimée avec succès.'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__('Impossible de supprimer cette affectation.'));
        $this->redirect($this->referer());
    }

    function admin_bloquer_user($id, $valide)
    {
        $annonce = $this->User->find('list', array('conditions' => array('User.id' => $id)));
        if (!empty($annonce)) {
            $this->User->id = $id;
            $this->User->saveField('archive', $valide);
            $this->Session->setFlash(__('Opération effectuée'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Erreur de navigation'));
        $this->redirect(array('action' => 'index'));
    }

    function system_get_superviseur($id)
    {
        //$user = $this->User->Apartient->findByUser1Id($id);
        //debug($user);
        //je check si le user est ASM si oui je cherche avec vm et et asm qui connecter wach ils sont aussi lié
        //V2 07/05/2026
        $user = $this->User->Apartient->find('first', array(
            'conditions' => array(
                'Apartient.user1_id' => $id  // find the supervisor of this user
            )
        ));
        return $user;
    }

    //function utilisé pour envoyer les emails
    function system_get_promotion()
    {
        //$user = $this->User->findByRole("Responsable promotion");
        $user = $this->User->findById(216);
        return $user;
    }

    //demander f chi blassa khra je ne sais pas ou 
    //demander in grosisites/index.ctp line 25
    //demender in prospectcompagne/view.ctp line 78
    function system_get_name_user($id)
    {
        $this->User->recursive = -1;
        $user = $this->User->findById($id);
        return $user['User']['name'];
    }

    public function archive($id = null, $valide = null)
    {
        if ($id == null) {
            $this->User->recursive = 0;
            $this->set('users', $this->User->find('all', array('conditions' => array('User.archive' => -1))));
        } else {
            $this->User->id = $id;
            $this->User->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Employé Archivé'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Employé activé'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }

    function system_get_user_for_superviseur($id)
    {
        $this->User->recursive = 0;
        $this->User->Apartient->recursive = -1;
        $users = $this->User->Apartient->find('all', array('conditions' =>
        array('Apartient.user_id' => $id)));
        $ids = '0';
        foreach ($users as $value)
            $ids = $ids . ',' . $value["Apartient"]['user1_id'];
        $users = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));
        if (empty($users))
            $users = array();
        return $users;
    }

    function system_get_all_user_vmp_superviseur_coordinateur()
    {
        $this->User->recursive = -1;
        $users = $this->User->find('list', array('conditions' => array(
            "User.role='Super viseur' OR User.role='Coordinateur' OR User.role='VMP'",
            'User.archive' => 1
        )));
        return $users;
    }

    function admin_statistique()
    {
        $this->User->recursive = -1;
        $this->loadModel('Visite');
        ini_set('memory_limit', '-1');
        set_time_limit(-1);

        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        } else {
            $y = date('Y');
            $m = date('m');
            $test = new DateTime("$y-$m-01");
            $date_debut = $test->modify('first monday')->format('Y-m-d');
            //$date_debut = date("Y-01-01");
            $date_fin = date("Y-m-t");
            $y = date('Y');
            $m = date('m');
            $d = date('d');
            $date_fin = date('Y-m-d', strtotime('last Sunday', strtotime("$y-$m-$d")));
        }
        $this->User->recursive = -1;
        //$this->Visite->recursive=-1;
        if (AuthComponent::user('role') == 'Super viseur') {
            $this->User->Apartient->recursive = -1;
            $users = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = AuthComponent::user('id');
            foreach ($users as $value)
                $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            $users = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));
            $visites = $this->Visite->find('all', array('conditions' => array("Visite.user_id in($ids)", 'Visite.archive' => 1, "Visite.date between '" . $date_debut . "' and '" . $date_fin . "  23:59'")));
        } else {

            $users = $this->User->find('all', array('conditions' => array(
                'User.archive' => 1,
                "NOT" => array("User.role" => array('Admin', 'Responsable promotion'), "User.id" => array(2, 3, 4))
            )));
            $visites = $this->Visite->find('all', array('conditions' => array('Visite.archive' => 1, "Visite.date between '" . $date_debut . "' and '" . $date_fin . "  23:59'")));
        }
        foreach ($users as $user) {
            if ($user["User"]['role'] == 'Super viseur') {
                $supers = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $user["User"]['id'])));
                $ids = array();
                foreach ($supers as $value)
                    $ids[] = $value["Apartient"]['user1_id'];
                foreach ($visites as $visite) {
                    if (in_array($visite["Visite"]["user_id"], $ids) && $visite["Visite"]["type_visite"] == "double") {
                        $visite["User"] = $user["User"];
                        $visite["Visite"]["user_id"] = $user["User"]['id'];
                        $visites[] = $visite;
                    }
                }
            }
        }
        //debug($visites,0,0);
        //exit();
        //debug($users,0,0);exit();
        $this->loadModel('Type');
        $types = $this->Type->find('list');
        $this->loadModel('Category');
        $categories = $this->Category->find('list');
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list');
        $this->set(compact('users', 'date_debut', 'date_fin', 'visites', 'types', 'categories', 'produits'));
    }

    //trover si id est un superviseur ou pas 
    //appeler dans /clients/view 537
    //SUR (ELLE EST APPELER DANS LES VIEW ET LES CONTROLLER MONTIONé EN HAUT SEULEMENT)
    function system_get_if_super($id)
    {
        $this->User->recursive = -1;
        $super = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        if ($super["User"]['role'] != 'Super viseur' && $super["User"]['role'] != 'Responsable promotion')
            return 0;
        else
            return 1;
    }

    function tableau_bord_super()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(300);
        $this->loadModel('Client');

        $this->Client->recursive = -1;
        $this->Client->Type->recursive = -1;
        $this->Client->Category->recursive = -1;
        $this->User->recursive = -1;
        $this->User->Visite->recursive = -1;
        $this->User->Objectif->recursive = -1;
        $this->User->Apartient->recursive = -1;
        $categories = $this->Client->Category->find("list");
        $types = $this->Client->Type->find("list");

        $date = null;
        if (
            $this->request->query('date') &&
            preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->request->query('date'))
        ) {
            $date = $this->request->query('date');
        } else {
            $date = date('Y-m-d');
        }
        $date_debut = date("Y-m-d", strtotime('monday this week', strtotime($date)));
        $date_fin = date("Y-m-d", strtotime('sunday this week', strtotime($date)));

        if (AuthComponent::user('role') == 'VMP') {
            $this->Session->setFlash('Erreur de navigation');
            return $this->redirect(array("controller" => "users", 'action' => 'view'));
        }

        if (AuthComponent::user('role') == 'Super viseur')
            $supers = $this->User->find('all', array('conditions' => array('User.id' => AuthComponent::user('id'))));
        else
            $supers = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));

        $users = array();
        $visites = array();
        $objectifs = array();

        foreach ($supers as $super) {
            $superId = $super["User"]['id'];
            $vmp = $this->User->Apartient->find('all', array(
                'conditions' => array('Apartient.user_id' => $superId)
            ));

            $ids = $superId;
            foreach ($vmp as $value) {
                $ids .= ',' . $value["Apartient"]['user1_id'];
            }

            $u = $this->User->find('all', array(
                'fields' => array("User.id", "User.name", "User.username", "User.role"),
                'conditions' => array("User.id in($ids)", 'User.archive' => 1)
            ));

            usort($u, function ($a, $b) use ($superId) {
                return ($a['User']['id'] == $superId) ? 1 : (($b['User']['id'] == $superId) ? -1 : 0);
            });

            $superVisites = $this->User->Visite->find("all", array(
                "fields" => array(
                    "Visite.user_id",
                    "Visite.client_id",
                    "Visite.timer",
                    "Visite.date",
                    "Visite.created",
                    "Visite.latitude",
                    "Visite.longitude",
                    "Visite.type_visite",
                    "Visite.double_id",
                    "Visite.commentaire"
                ),
                'conditions' => array(
                    "Visite.archive" => 1,
                    "Visite.date BETWEEN '$date_debut 00:00:00' AND '$date_fin 23:59:59'",
                    "Visite.user_id in($ids) order by Visite.date asc"
                )
            ));

            $visites = array_merge($visites, $superVisites);

            $visitesSeen = [];
            $visitesDeduplicated = [];
            foreach ($visites as $v) {
                $key = $v['Visite']['user_id'] . '_' . $v['Visite']['client_id'] . '_' . $v['Visite']['date'];
                if (!isset($visitesSeen[$key])) {
                    $visitesSeen[$key] = true;
                    $visitesDeduplicated[] = $v;
                }
            }
            $visites = $visitesDeduplicated;

            $superObjectifs = $this->User->Objectif->find("all", array('conditions' => array("Objectif.user_id in($ids)")));
            $objectifs = array_merge($objectifs, $superObjectifs);

            $users[$superId] = $u;
        }

        $groupedObjectifs = [];
        foreach ($objectifs as $objectif) {
            $userId = $objectif["Objectif"]["user_id"];
            $objectif["Objectif"]["type"] = $types[$objectif["Objectif"]["type_id"]];
            if (!isset($groupedObjectifs[$userId])) {
                $groupedObjectifs[$userId] = [];
            }
            $groupedObjectifs[$userId][] = $objectif["Objectif"];
        }
        $objectifs = $groupedObjectifs;

        $clients_id = 0;
        $groupedVisites = [];
        foreach ($visites as $v) {
            if (strpos(',' . $clients_id . ',', ',' . $v['Visite']['client_id'] . ',') === false) {
                $clients_id .= ',' . $v['Visite']['client_id'];
            }
            $userId = $v['Visite']['user_id'];
            $fullDate = $v['Visite']['date'];
            $day = date('Y-m-d', strtotime($fullDate));

            if (!isset($groupedVisites[$userId])) {
                $groupedVisites[$userId] = [];
            }
            if (!isset($groupedVisites[$userId][$day])) {
                $groupedVisites[$userId][$day] = [];
            }
            $groupedVisites[$userId][$day][] = $v['Visite'];
        }

        $clients = $this->Client->find("all", array(
            "fields" => array(
                "Client.id",
                "Client.nom",
                "Client.prenom",
                "Client.category_id",
                "Client.latitude",
                "Client.longitude",
                "Client.potentialite",
                "Client.type_id",
                "Client.activite"
            ),
            'conditions' => array("Client.id in($clients_id)")
        ));
        $temps = [];
        foreach ($clients as $c) {
            $c["Client"]["type"] = $types[$c["Client"]["type_id"]];
            $c["Client"]["category"] = $categories[$c["Client"]["category_id"]];
            $temps[$c["Client"]["id"]] = $c;
        }
        $clients = $temps;

        foreach ($groupedVisites as $userId => $dates) {
            foreach ($dates as $day => $visites) {
                $groupedByType = [];
                foreach ($visites as $visite) {
                    $clientId = $visite["client_id"];
                    $client = $clients[$clientId]["Client"];
                    foreach ($client as $key => $value) {
                        $visite["client_$key"] = $value;
                    }
                    $clientType = $client["type"];
                    $groupedByType[$clientType][] = $visite;
                }
                foreach ($groupedByType as $type => $typeVisites) {
                    $seen = [];
                    $groupedByType[$type] = array_filter($typeVisites, function ($visite) use (&$seen) {
                        $key = $visite['user_id'] . '_' . $visite['client_id'] . '_' . $visite['date'];
                        if (isset($seen[$key])) return false;
                        $seen[$key] = true;
                        return true;
                    });
                    $groupedByType[$type] = array_values($groupedByType[$type]);
                }
                $groupedVisites[$userId][$day] = $groupedByType;
            }
        }

        $visitesDoubleParSuperviseur = [];
        $supervisorNames = [];

        foreach ($users as $superviseur_user_id => &$vmps) {
            foreach ($vmps as &$vmp) {
                $id = $vmp["User"]["id"];
                $vmp["Visite"] = isset($groupedVisites[$id]) ? $groupedVisites[$id] : [];
                $vmp["Objectif"] = isset($objectifs[$id]) ? $objectifs[$id] : [];

                if (!empty($groupedVisites[$id])) {
                    foreach ($groupedVisites[$id] as $day => $types) {
                        foreach ($types as $clientType => $visites) {
                            foreach ($visites as $visite) {
                                if ($visite["type_visite"] === "double" && !empty($visite["double_id"])) {
                                    $supervisorOfDouble = $visite["double_id"];
                                    if (!isset($supervisorNames[$supervisorOfDouble])) {
                                        $supUser = $this->User->find('first', array(
                                            'fields' => array('User.id', 'User.name'),
                                            'conditions' => array('User.id' => $supervisorOfDouble)
                                        ));
                                        $supervisorNames[$supervisorOfDouble] = $supUser ? $supUser['User']['name'] : 'Inconnu';
                                    }
                                    $visite["user_double"] = $supervisorNames[$supervisorOfDouble];
                                    $visitesDoubleParSuperviseur[$supervisorOfDouble][$day][$clientType][] = $visite;
                                }
                            }
                        }
                    }
                }
            }

            foreach ($vmps as &$vmp) {
                if ($vmp["User"]["id"] == $superviseur_user_id) {
                    if (!isset($vmp["Visite"])) {
                        $vmp["Visite"] = [];
                    }
                    if (isset($visitesDoubleParSuperviseur[$superviseur_user_id])) {
                        foreach ($visitesDoubleParSuperviseur[$superviseur_user_id] as $day => $types) {
                            if (!isset($vmp["Visite"][$day])) {
                                $vmp["Visite"][$day] = [];
                            }
                            foreach ($types as $clientType => $visites) {
                                if (!isset($vmp["Visite"][$day][$clientType])) {
                                    $vmp["Visite"][$day][$clientType] = [];
                                }
                                $vmp["Visite"][$day][$clientType] = array_merge(
                                    $vmp["Visite"][$day][$clientType],
                                    $visites
                                );
                            }
                        }
                    }
                    break;
                }
            }
        }

        // ── FIXED SECTION ──────────────────────────────────────────────────────────
        if (AuthComponent::user('role') == 'Super viseur') {
            $temp = [];

            // Step 1: Get all user IDs who are supervisors (have Normal type entries as user_id)
            $allSupervisorRecords = $this->User->Apartient->find('all', array(
                'fields' => array('Apartient.user_id'),
                'conditions' => array('Apartient.type' => 'Normal'),
                'group' => 'Apartient.user_id'
            ));
            $allSupervisorIdsFlat = array_unique(
                array_map(function ($r) {
                    return intval($r['Apartient']['user_id']);
                }, $allSupervisorRecords)
            );

            foreach ($users as $superviseur_user_id => $vmpss) {

                // Deduplicate by user_id
                $vmpss_unique = [];
                foreach ($vmpss as $v) {
                    $vmpss_unique[$v['User']['id']] = $v;
                }
                $vmpss = array_values($vmpss_unique);

                foreach ($vmpss as $key => $vmp) {
                    $existe = [];
                    $vmp_id = $vmp["User"]["id"];

                    // Skip the supervisor himself AND any user who is themselves a supervisor
                    if ($vmp_id != $superviseur_user_id && !in_array($vmp_id, $allSupervisorIdsFlat)) {
                        $this->User->Apartient->recursive = -1;
                        $existe = $this->User->Apartient->find('first', array(
                            'conditions' => array(
                                'Apartient.user1_id' => $vmp_id,
                                "Apartient.user_id != $superviseur_user_id",
                                "Apartient.type" => "Normal"
                            ),
                            'joins' => array(
                                array(
                                    'table' => 'users',
                                    'alias' => 'SuperUser',
                                    'type' => 'INNER',
                                    'conditions' => array(
                                        'SuperUser.id = Apartient.user_id',
                                        'SuperUser.archive' => 1
                                    )
                                )
                            )
                        ));
                    }

                    if (!empty($existe)) {
                        $nouveau_superviseur_id = $existe["Apartient"]["user_id"] . "-" . $superviseur_user_id;
                        $temp[$nouveau_superviseur_id][$vmp_id] = $vmp;
                    } else {
                        // If this vmp IS a supervisor himself, put him under his own ASM composite key
                        if (in_array($vmp_id, $allSupervisorIdsFlat) && $vmp_id != $superviseur_user_id) {
                            $composite_key = $vmp_id . "-" . $superviseur_user_id;
                            $temp[$composite_key][$vmp_id] = $vmp;
                        } else {
                            $temp[$superviseur_user_id][$vmp_id] = $vmp;
                        }
                    }
                }
            }

            // Step 2: Now populate each composite group with the supervisor's VMPs
            // Step 2: Now populate each composite group with the supervisor's VMPs
            foreach ($temp as $group_key => $members) {
                $parts = explode("-", $group_key);
                if (count($parts) > 1) {
                    $sub_supervisor_id = intval($parts[0]);

                    // Save the supervisor's own entry and remove it temporarily
                    $supervisorEntry = null;
                    if (isset($temp[$group_key][$sub_supervisor_id])) {
                        $supervisorEntry = $temp[$group_key][$sub_supervisor_id];
                        unset($temp[$group_key][$sub_supervisor_id]);
                    }

                    // Find the VMPs that belong to this sub-supervisor from original $users
                    foreach ($users as $superviseur_user_id => $vmpss) {
                        foreach ($vmpss as $vmp) {
                            if ($vmp['User']['id'] == $sub_supervisor_id) continue;
                            $belongsTo = $this->User->Apartient->find('first', array(
                                'conditions' => array(
                                    'Apartient.user_id' => $sub_supervisor_id,
                                    'Apartient.user1_id' => $vmp['User']['id'],
                                    'Apartient.type' => 'Normal'
                                )
                            ));
                            if (!empty($belongsTo)) {
                                $temp[$group_key][$vmp['User']['id']] = $vmp;
                            }
                        }
                    }

                    // Re-add the supervisor himself at the END
                    if ($supervisorEntry !== null) {
                        $temp[$group_key][$sub_supervisor_id] = $supervisorEntry;
                    }
                }
            }

            $users = $temp;
        }
        // ── END FIXED SECTION ──────────────────────────────────────────────────────

        $allSupersList = $this->User->find('list', array('conditions' => array("User.role" => 'Super viseur')));
        $supers = $allSupersList;
        foreach ($users as $compositeKey => $group) {
            $parts = explode("-", $compositeKey);
            foreach ($parts as $part) {
                if (!isset($supers[$part])) {
                    $found = $this->User->find('first', array(
                        'fields' => array('User.id', 'User.name'),
                        'conditions' => array('User.id' => $part)
                    ));
                    $supers[$part] = $found ? $found['User']['name'] : 'Inconnu';
                }
            }
        }

        $this->set(compact("users", "date", "supers"));
    }


    function tableau_bord_super_formail()
    {
        // Generate a CSRF token and save it in the session
        $csrfToken = bin2hex(openssl_random_pseudo_bytes(16));
        $this->Session->write('csrfToken', $csrfToken);
        if (isset($_GET['date'])) {
            $dateParts = explode('-', $_GET['date']);

            // Check if we have all the required parts of the date

            $day = $dateParts[2];
            $month = $dateParts[1];
            $year = $dateParts[0];
            // Check if the date is valid
            $date = $year . "-" . $month . "-" . $day;
        } else {
            // No date provided, use today's date
            $date = date('Y-m-d');
        }

        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->User->recursive = -1;
        if (AuthComponent::user('role') == 'Super viseur')
            $supers = $this->User->find('all', array('conditions' => array('User.id' => AuthComponent::user('id'))));
        else
            $supers = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));
        $users = array();
        $this->User->Apartient->recursive = -1;
        foreach ($supers as $super) {
            //if($super["User"]['id']==2)
            //	continue;
            $vmp = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]['id'])));
            $ids = "0";
            foreach ($vmp as $value)
                $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            $u = array();
            $u = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));
            $u["super"] = $super;
            $users[$super["User"]['id']] = $u;
        }
        $date_debut = date("Y-m-d", strtotime('monday this week', strtotime($date)));
        $date_fin = date("Y-m-d", strtotime('sunday this week', strtotime($date)));

        $this->User->Visite->recursive = -1;
        $visites = $this->User->Visite->find("all", array('conditions' => array("Visite.archive" => 1, "Visite.date BETWEEN '$date_debut 00:00:00' AND '$date_fin 23:59:59'")));
        $clients_id = 0;
        foreach ($users as $k => $user) {
            foreach ($user as $i => $u) {
                if (!isset($u["User"])) {
                    $u["User"] = $u["super"];
                }
                $visite = array();
                foreach ($visites as $v) {
                    if ($users[$k][$i]["User"]["id"] == $v["Visite"]["user_id"]) {
                        $visite[] = $v;
                        $clients_id = $clients_id . "," . $v["Visite"]["client_id"];
                    }
                }
                $users[$k][$i]["Visite"] = $visite;
            }
        }
        $listusers = $this->User->find("list");

        $double = array();
        $double["global"] = array();
        $pots = array();
        $pots["global"] = array();
        $specailites = array();
        $specailites["global"] = array();
        $types = array();
        $types["global"] = array();
        $visites = array();
        $visites["global"] = array();
        $objectifs = array();
        $objectifs["global"] = array();
        $nbvsitiesbydate = array();


        //debug($users,0,0);
        $this->loadModel("Client");
        $this->loadModel("Category");
        $this->loadModel("Type");
        $this->Client->recursive = -1;
        $clientss = $this->Client->find("all", array("conditions" => array("Client.id in ($clients_id)")));
        $categories = $this->Category->find("list");
        $typess = $this->Type->find("list");
        $clients = array();
        foreach ($clientss as $c) {
            $clients[$c["Client"]["id"]] = $c;
        }
        foreach ($users as $super_id => $user) {
            foreach ($user as $u) {
                //objectifs
                $objs = $this->requestAction('/objectifs/system_get_objectif_by_date/' . $u['User']['id'] . "/$date");
                foreach ($objs as $obj) {
                    $type = $typess[$obj['Type']['id']];
                    if (!isset($objectifs[$super_id]))
                        $objectifs[$super_id] = array();

                    if (!isset($objectifs[$super_id][$type])) {
                        $objectifs[$super_id][$type]["objectif"] = 0;
                        $objectifs[$super_id][$type]["nbvisite"] = 0;
                    }
                    $objectifs[$super_id][$type]["objectif"] += $obj['Objectif']['objectif'];
                    if (!isset($objectifs["global"][$type])) {
                        $objectifs["global"][$type]["objectif"] = 0;
                        $objectifs["global"][$type]["nbvisite"] = 0;
                    }
                    $objectifs["global"][$type]["objectif"] += $obj['Objectif']['objectif'];
                }


                foreach ($u["Visite"] as $v) {
                    $client = $clients[$v["Visite"]["client_id"]]["Client"];

                    //objectif par type
                    $type = $typess[$client["type_id"]];

                    if (!isset($objectifs[$super_id][$type])) {
                        $objectifs[$super_id][$type]["objectif"] = 0;
                        $objectifs[$super_id][$type]["nbvisite"] = 0;
                    }
                    $objectifs[$super_id][$type]["nbvisite"]++;
                    if (!isset($objectifs["global"][$type])) {
                        $objectifs["global"][$type]["objectif"] = 0;
                        $objectifs["global"][$type]["nbvisite"] = 0;
                    }
                    $objectifs["global"][$type]["nbvisite"]++;


                    //double ou solo
                    $type_visite = strtolower($v["Visite"]["type_visite"]);
                    if (!isset($double[$super_id]))
                        $double[$super_id] = array();
                    if (!isset($double[$super_id][$type_visite]))
                        $double[$super_id][$type_visite] = 0;
                    $double[$super_id][$type_visite]++;
                    if (!isset($double["global"][$type_visite]))
                        $double["global"][$type_visite] = 0;
                    $double["global"][$type_visite]++;

                    //potentialite
                    $pot = $client["potentialite"];
                    if (strlen($pot) == 2) {
                        if (in_array($pot, array("A1", "B1")))
                            $pot = "A1,B1";
                        else if (in_array($pot, array("A2", "B2", "C1", "C2")))
                            $pot = "A2,B2,C1,C2";
                        else
                            $pot = "A3,B3,C3";
                        if (!isset($pots[$super_id]))
                            $pots[$super_id] = array();
                        if (!isset($pots[$super_id][$pot]))
                            $pots[$super_id][$pot] = 0;
                        $pots[$super_id][$pot]++;
                        if (!isset($pots["global"][$pot]))
                            $pots["global"][$pot] = 0;
                        $pots["global"][$pot]++;
                    }

                    //spécialité
                    $pot = $categories[$client["category_id"]];
                    if (!isset($specailites[$super_id]))
                        $specailites[$super_id] = array();
                    if (!isset($specailites[$super_id][$pot]))
                        $specailites[$super_id][$pot] = 0;
                    $specailites[$super_id][$pot]++;
                    if (!isset($specailites["global"][$pot]))
                        $specailites["global"][$pot] = 0;
                    $specailites["global"][$pot]++;

                    //Types
                    $pot = $typess[$client["type_id"]];
                    if (!isset($types[$super_id]))
                        $types[$super_id] = array();
                    if (!isset($types[$super_id][$pot]))
                        $types[$super_id][$pot] = 0;
                    $types[$super_id][$pot]++;
                    if (!isset($types["global"][$pot]))
                        $types["global"][$pot] = 0;
                    $types["global"][$pot]++;

                    //triche
                    $distance = $this->system_calcule_km($client["latitude"], $client["longitude"], $v["Visite"]['latitude'], $v["Visite"]['longitude']);
                    if (!isset($visites[$super_id]))
                        $visites[$super_id] = array();
                    if ($distance <= 2) {
                        if (!isset($visites[$super_id]["correct"]))
                            $visites[$super_id]["correct"] = 0;
                        $visites[$super_id]["correct"]++;
                        if (!isset($visites["global"]["correct"]))
                            $visites["global"]["correct"] = 0;
                        $visites["global"]["correct"]++;
                    } else {
                        if (!isset($visites[$super_id]["biaisé"]))
                            $visites[$super_id]["biaisé"] = 0;
                        $visites[$super_id]["biaisé"]++;
                        if (!isset($visites["global"]["biaisé"]))
                            $visites["global"]["biaisé"] = 0;
                        $visites["global"]["biaisé"]++;
                    }
                    //--------------Les visites par date par type_medcin ,spécielté, exercice,potentialite
                    $date = explode(" ", $v["Visite"]["date"]);
                    $date = $date[0];
                    //potentialite
                    $pot = $client["potentialite"];
                    if (strlen($pot) == 2) {
                        if (!isset($nbvsitiesbydate[$date]["pot"][$super_id]))
                            $nbvsitiesbydate[$date]["pot"][$super_id] = array();
                        if (!isset($nbvsitiesbydate[$date]["pot"][$super_id][$pot]))
                            $nbvsitiesbydate[$date]["pot"][$super_id][$pot] = 0;
                        $nbvsitiesbydate[$date]["pot"][$super_id][$pot]++;
                        if (!isset($nbvsitiesbydate[$date]["pot"]["global"][$pot]))
                            $nbvsitiesbydate[$date]["pot"]["global"][$pot] = 0;
                        $nbvsitiesbydate[$date]["pot"]["global"][$pot]++;
                    }
                    //Types
                    $pot = $typess[$client["type_id"]];
                    if (!isset($nbvsitiesbydate[$date]["types"][$super_id]))
                        $nbvsitiesbydate[$date]["types"][$super_id] = array();
                    if (!isset($nbvsitiesbydate[$date]["types"][$super_id][$pot]))
                        $nbvsitiesbydate[$date]["types"][$super_id][$pot] = 0;
                    $nbvsitiesbydate[$date]["types"][$super_id][$pot]++;
                    if (!isset($nbvsitiesbydate[$date]["types"]["global"][$pot]))
                        $nbvsitiesbydate[$date]["types"]["global"][$pot] = 0;
                    $nbvsitiesbydate[$date]["types"]["global"][$pot]++;
                    //spécialité
                    $pot = $categories[$client["category_id"]];
                    if (!isset($nbvsitiesbydate[$date]["categories"][$super_id]))
                        $nbvsitiesbydate[$date]["categories"][$super_id] = array();
                    if (!isset($nbvsitiesbydate[$date]["categories"][$super_id][$pot]))
                        $nbvsitiesbydate[$date]["categories"][$super_id][$pot] = 0;
                    $nbvsitiesbydate[$date]["categories"][$super_id][$pot]++;
                    if (!isset($nbvsitiesbydate[$date]["categories"]["global"][$pot]))
                        $nbvsitiesbydate[$date]["categories"]["global"][$pot] = 0;
                    $nbvsitiesbydate[$date]["categories"]["global"][$pot]++;
                }
            }
        }
        //debug($double);
        //debug($pots);
        //debug($specailites);//exit();
        foreach ($specailites as $k => $v) {
            unset($specailites[$k]["PHARMACIES"]);
        }
        $data = array();
        foreach ($specailites as $k => $v) {
            $temp = $v;
            rsort($v);
            $firstFive = array_slice($v, 0, 5);
            $rest = array_slice($v, 5);
            $autre = 0;
            foreach ($rest as $kk => $vv)
                $autre = $autre + $vv;
            foreach ($firstFive as $kk => $vv) {
                $name = array_search($vv, $temp);
                $data[$k][$name] = $vv;
                unset($temp[$name]);
            }
            if ($autre != 0)
                $data[$k]["Autre"] = $autre;
        }
        $specailites = $data;

        //calcule objectif de la semaine
        $objectifglobals = 0;
        $visiteglobal = 0;
        foreach ($objectifs["global"] as $k => $v) {
            $objectifglobals += $v["objectif"];
            $visiteglobal += $v["nbvisite"];
        }
        $objectifglobal = 0;
        if ($objectifglobals != 0) {
            $objectifglobal = round(($visiteglobal / $objectifglobals), 2) * 100;
        }

        //debug($data);exit();
        //debug($nbvsitiesbydate);
        //debug($visites);
        //debug($types);
        //debug($objectifs["global"]);
        if (!isset($objectifs["global"]["Médecin"]))
            $objectifs["global"]["Médecin"] = 1;
        if (!isset($objectifs["global"]["Pharmacie"]))
            $objectifs["global"]["Pharmacie"] = 1;
        $objectif_medcin_par_jour = intval($objectifs["global"]["Médecin"]["objectif"] / 5);
        $objectif_pharmacie_par_jour = intval($objectifs["global"]["Pharmacie"]["objectif"] / 5);
        $objectif_pharmacie_par_jour = $objectif_pharmacie_par_jour + $objectif_medcin_par_jour;
        $this->set(compact("objectifglobal", 'users', "date", "listusers", "double", "pots", "specailites", "nbvsitiesbydate", "visites", "types", "types", "objectifs", "objectif_medcin_par_jour", "objectif_pharmacie_par_jour", "csrfToken"));
    }


    function system_calcule_km($lat1, $lon1, $lat2, $lon2)
    {
        $distance = 0;
        $lat1 = floatval($lat1);
        $lon1 = floatval($lon1);
        $lat2 = floatval($lat2);
        $lon2 = floatval($lon2);
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = round($miles * 1.609344, 2);
        return $distance;
    }

    function system_rachid()
    {
        $date = date('Y-m-d'); // you can put any date you want
        $nbDay = date('N', strtotime($date));
        $monday = new DateTime($date);
        $sunday = new DateTime($date);
        $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
        $date_fin = $sunday->modify('+' . (7 - $nbDay) . ' days')->format('Y-m-d');
        $supers = $this->User->find('all', array(
            'conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')
        ));
        $users = array();
        $this->User->Apartient->recursive = -1;
        foreach ($supers as $super) {
            if ($super["User"]['id'] == 2)
                continue;
            $vmp = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]['id'])));
            $ids = "0";
            foreach ($vmp as $value)
                $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            $u = array();
            $u = $this->User->find('all', array(
                'conditions' => array("User.id in($ids)", 'User.archive' => 1)
            ));
            $u["super"] = $super;
            $users[$super["User"]['id']] = $u;
        }
        $this->set(compact('users'));

        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        $Email->template('default', 'rapportrachid');
        $Email->viewVars(array("users" => $users));
        $Email->emailFormat('html');
        $Email->to("godsneek@hotmail.com"); //AuthComponent::user('prenom')
        $Email->from('no-repley@icoz.ma');
        $Email->subject('CRM VMP : Rapport de visite');
        $Email->send();

        /*  $Email->template('default', 'rapportrachid');
          $Email->viewVars(array("users"=>$users));
          $Email->emailFormat('html');
          $Email->to("o.elfidaoui@esnapharm.com");//AuthComponent::user('prenom')
          $Email->from('no-repley@icoz.ma');
          $Email->subject('CRM VMP : Rapport de visite');
          $Email->send(); */
    }

    function system_naissance($count = null)
    {

        $this->User->recursive = -1;
        // debug($this->User->find('all'),0);
        if ($count != null) {
            $users = $this->User->find("count", array("conditions" => array("DATE_FORMAT(date_de_naissance,'%d-%m')=DATE_FORMAT(CURRENT_DATE,'%d-%m')")));
            return $users;
        }
        $users = $this->User->find("all", array("conditions" => array("DATE_FORMAT(User.date_de_naissance,'%d-%m') BETWEEN 
        DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 7 DAY),'%d-%m') AND DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY),'%d-%m')
        ORDER BY User.date_de_naissance asc")));
        $this->set(compact('users'));
    }

    public function save_Image()
    {
        $this->autoRender = false;
        $this->response->type('json');

        try {
            // Get the image data
            $data = json_decode(file_get_contents("php://input"), true);

            // Validate CSRF token
            $csrfToken = $this->request->header('X-CSRF-Token');
            $sessionToken = $this->Session->read('csrfToken');
            if ($csrfToken !== $sessionToken) {
                throw new Exception('Invalid CSRF token.');
            }

            if (!empty($data['image'])) {
                // Decode the base64 image data
                $imageData = str_replace('data:image/png;base64,', '', $data['image']);
                $imageData = str_replace(' ', '+', $imageData);
                $decodedImage = base64_decode($imageData);

                // Define the directory and ensure it exists
                $directory = WWW_ROOT . 'img' . DS . 'generatedToDay';
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);  // Create the directory if it doesn't exist
                }

                // Define the filename and path
                $filename = 'generated_' . date('Ymd_His') . '.png';
                $filePath = $directory . DS . $filename;

                // Save the image to the server
                if (file_put_contents($filePath, $decodedImage)) {
                    echo json_encode(['success' => true, 'filename' => $filename]);
                } else {
                    throw new Exception('Could not save the image.');
                }
            } else {
                throw new Exception('No image data received.');
            }
        } catch (Exception $e) {
            // Log the error and send the response
            CakeLog::write('error', 'Error in saveImage action: ' . $e->getMessage());
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
