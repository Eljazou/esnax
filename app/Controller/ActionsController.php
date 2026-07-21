<?php

App::uses('AppController', 'Controller');

class ActionsController extends AppController
{


    public $components = array('Paginator');


    public function add($client_id)
    {
        if ($this->request->is('post')) {
            $this->Action->create();
            $gamme = "";
            foreach ($this->request->data["gamme"] as $k => $g) {
                $gamme .= $g . ",";
            }
            $this->request->data["Action"]["game_id"] = $gamme;
            $this->request->data['Action']['user_id'] = AuthComponent::user('id');
            $super = $this->requestAction('/users/system_get_superviseur/' . AuthComponent::user('id'));
            // debug($super); die;
            if (AuthComponent::user('role') == "Super viseur") {
                $this->request->data['Action']['archive'] = 1;
                $super = $this->requestAction('/users/system_get_promotion/');
            }
            if ($this->Action->save($this->request->data)) {
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                $d['Boitemail']['lien'] = "/actions/valider/";
                $d['Boitemail']['user_id'] = $super['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a demandé une action';
                $d['Boitemail']['message'] = "Une demande d'action a été envoyée par " . AuthComponent::user('name') . ".";
                $this->Boitemail->save($d);
                $this->Session->setFlash(__('Action envoyée'));
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Action']['client_id']));
            } else {
                $this->Session->setFlash(__('L\'action n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
        $games =  $this->Action->Game->find('list', array("fields" => array("Game.name", "Game.name")));
        $this->set(compact('games', 'client_id'));
    }


    public function edit($id = null)
    {
        if (!$this->Action->exists($id)) {
            throw new NotFoundException(__('Action invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            foreach ($this->request->data["gamme"] as $k => $g) {
                $gamme .= $g . ",";
            }
            $this->request->data["Action"]["game_id"] = $gamme;

            if ($this->Action->save($this->request->data)) {
                $this->Session->setFlash(__('Action modifiée'));
                return $this->redirect(array('action' => 'valider'));
            } else {
                $this->Session->setFlash(__('L\'action n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Action.' . $this->Action->primaryKey => $id));
            $this->request->data = $this->Action->find('first', $options);
        }
        if (AuthComponent::user('role') == "Super viseur") {
            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $super =  $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = AuthComponent::user('id');
            foreach ($super as $value) {
                $ids = $ids . ',' . $value['Apartient']['user1_id'];
            }
            $users = $this->Action->User->find('list', array('conditions' => array('User.archive' => 1, "User.id in($ids)")));
        } else
            $users = $this->Action->User->find('list', array('conditions' => array('User.archive' => 1)));
        $games =  $this->Action->Game->find('list', array("fields" => array("Game.name", "Game.name")));
        $this->set(compact('games', 'users'));
    }


    public function archive($id = null, $valide = null)
    {
        if ($id != null) {
            $this->Action->id = $id;
            $this->Action->saveField('archive', $valide);
            if ($valide == -1) {
                $action = $this->Action->findById($id);
                $super = $this->requestAction('/users/system_get_promotion/');
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                //$d['Boitemail']['lien']="/actions/valider/";
                $d['Boitemail']['user_id'] = $super['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a annuler l\'action de' . $action["Action"]["name"];
                $d['Boitemail']['message'] = "Une demande d'action a été annuler par " . AuthComponent::user('name') . ".";
                $this->Boitemail->save($d);

                $this->Boitemail->create();
                //$d['Boitemail']['lien']="/actions/valider/";
                $d['Boitemail']['user_id'] = $action['Action']['user_id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a annuler l\'action de' . $action["Action"]["name"];
                $d['Boitemail']['message'] = "Une demande d'action a été annuler par " . AuthComponent::user('name') . ".";
                $this->Boitemail->save($d);
                $this->Session->setFlash(__('Action archivée'));
                return $this->redirect(array('action' => 'valider'));
            } else {
                $this->Session->setFlash(__('Action activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
        $actions = $this->Action->find('all', array('conditions' => array('Action.archive' => -1)));
        $this->set('actions', $actions);
    }


    function valider($id = null, $valide = null)
    {
        if ($id != null && $valide != null) {
            $this->Action->id = $id;
            $this->Action->saveField('archive', $valide);

            if ($valide == -1) {
                $action = $this->Action->findById($id);
                $super = $this->requestAction('/users/system_get_promotion/');
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                //$d['Boitemail']['lien']="/actions/valider/";
                $d['Boitemail']['user_id'] = $super['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a annuler l\'action de' . $action["Action"]["name"];
                $d['Boitemail']['message'] = "Une demande d'action a été annuler par " . AuthComponent::user('name') . ".";
                $this->Boitemail->save($d);

                $this->Boitemail->create();
                //$d['Boitemail']['lien']="/actions/valider/";
                $d['Boitemail']['user_id'] = $action['Action']['user_id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a annuler l\'action de' . $action["Action"]["name"];
                $d['Boitemail']['message'] = "Une demande d'action a été annuler par " . AuthComponent::user('name') . ".";
                $this->Boitemail->save($d);

                $this->Session->setFlash(__('Action annulée'));
            }
            if ($valide == 1) {
                //$super = $this->requestAction('/users/system_get_promotion/');
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                $super = $this->requestAction('/users/system_get_promotion/');
                $d['Boitemail']['lien'] = "/actions/valider/";
                $d['Boitemail']['user_id'] = $super['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a validé une action';
                $d['Boitemail']['message'] = "Une demande d'action a été validée par " . AuthComponent::user('name') . ".";
                $this->Boitemail->save($d);
                $this->Session->setFlash(__('Action validée'));
                return $this->redirect(array('action' => 'valider'));
            } else {
                $this->Session->setFlash(__('Action validée'));
                return $this->redirect(array('action' => 'valider'));
            }
        }
        if ($valide == 2) {
            $action = $this->Action->findById($id);
            $super = $this->requestAction('/users/system_get_promotion/');
            $this->loadModel('Boitemail');
            $this->Boitemail->create();
            //$d['Boitemail']['lien']="/actions/valider/";
            $d['Boitemail']['user_id'] = $super['User']['id'];
            $d['Boitemail']['user1_id'] = 0;
            $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a valider l\'action de' . $action["Action"]["name"];
            $d['Boitemail']['message'] = "Une demande d'action a été valider par " . AuthComponent::user('name') . ".";
            $this->Boitemail->save($d);

            $this->Boitemail->create();
            //$d['Boitemail']['lien']="/actions/valider/";
            $d['Boitemail']['user_id'] = $action['Action']['user_id'];
            $d['Boitemail']['user1_id'] = 0;
            $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a valider l\'action de' . $action["Action"]["name"];
            $d['Boitemail']['message'] = "Une demande d'action a été valider par " . AuthComponent::user('name') . ".";
            $this->Boitemail->save($d);

            $this->Session->setFlash(__('Action annulée'));
        }

        if (AuthComponent::user('role') == "Super viseur") {
            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $super =  $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = '0';
            foreach ($super as $value) {
                $ids = $ids . ',' . $value['Apartient']['user1_id'];
            }
            $actions = $this->Action->find('all', array('conditions' => array('Action.archive' => 0, "Action.user_id in($ids)")));
        } else if (AuthComponent::user('role') == 'Responsable promotion')
            $actions = $this->Action->find('all', array('conditions' => array('Action.archive' => 1)));
        else
            $actions = $this->Action->find('all', array('conditions' => array('Action.archive' => 1)));

        $this->set('actions', $actions);
    }

    function archivetous()
    {
        $this->Action->query('UPDATE actions SET `archive`=-1');
        $this->Session->setFlash(__('Toutes les demandes d\'actions sont archivées'));
        return $this->redirect(array('action' => 'archive'));
    }


    //function de statistique 
    function statistiqueparregion()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $this->loadModel('User');
        $this->User->Apartient->recursive = -1;
        $this->User->recursive = -1;
        $date_debut = date("Y-01-01");
        $date_fin = date("Y-12-t");
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        }
        if (AuthComponent::user('role') == 'VMP')
            $supers = $this->User->find('all', array('conditions' => array(
                'User.archive' => 1,
                'User.id' => AuthComponent::user('id'),
                "User.role" => 'VMP'
            )));
        else if (AuthComponent::user('role') == 'Super viseur')
            $supers = $this->User->find('all', array('conditions' => array(
                'User.archive' => 1,
                'User.id' => AuthComponent::user('id'),
                "User.role" => 'Super viseur'
            )));
        else
            $supers = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));
        $users = array();

        $info = array();
        foreach ($supers as $super) {
            //if($super["User"]['id']==2)
            //	continue;

            $vmp = $this->User->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $super["User"]['id'])));
            $vmp[100]["Apartient"]['user1_id'] = $super["User"]['id'];
            $vmp[100]["Apartient"]['user_id'] = $super["User"]['id'];
            foreach ($vmp as $value) {
                $ids = "0";
                foreach ($vmp as $vvv)
                    $ids = $ids . ',' . $vvv["Apartient"]['user1_id'];
                if ($date_debut != null)
                    $info[$super["User"]['id']] =  $this->Action->find("all", array('conditions' => array(
                        "Action.user_id in ($ids)",
                        'Action.archive' => 2,
                        'Action.date_debut <=' => $date_fin,
                        'Action.date_fin >=' => $date_debut
                    )));
                else
                    $info[$super["User"]['id']] =  $this->Action->find("all", array('conditions' => array(
                        "Action.user_id in ($ids)",
                        'Action.archive' => 2
                    )));
                $info[$super["User"]['id']]["super"] = $super;
            }
        }
        $this->loadModel("Type");
        $types = $this->Type->find("list");
        $this->set(compact('info', "date_debut", "date_fin", "types"));
    }



    function system_s($code = null, $lan, $lon, $date_debut = null, $date_fin = null)
    {
        $this->render('/appweb/statistique');
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
                        if ($ob["type"]["type"] == $obj["Type"]["name"]) {
                            $jour = $this->Visite->find("count", array("conditions" => array(
                                'Visite.archive' => '1',
                                "Visite.user_id" => $user['User']['id'],
                                "DATE(Visite.date)" => date("Y-m-d"),
                                "Client.type_id" => $obj["Type"]["id"]
                            )));
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
        if ($user['User']['id'] == "388") {
            debug($data);
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
}
