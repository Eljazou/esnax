<?php

App::uses('AppController', 'Controller');



/**

 * Plantournes Controller

 *

 * @property Plantourne $Plantourne

 * @property PaginatorComponent $Paginator

 */

class PlantournesController extends AppController {



    public $components = array('Paginator');



    function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow("system_existeplanification");

    }



    public function gestion($user_id = null, $date_debut = null, $date_fin = null) {

        if (isset($_GET['date'])) { 

            $date = $_GET['date'];

            $date = explode('--', $date);

            $date_debut = $date[0];

            $date_fin = $date[1];

        } else if ($date_debut == null) {

            $time = strtotime("1 January " . date("Y"), time());

            $day = date('w', $time);

            $time += ((7 * date("W", strtotime(date('Y-m-d')))) + 1 - $day) * 24 * 3600;

            $date_debut = date('Y-n-j', $time);

            $date = date('Y-m-d');

            $nbDay = date('N', strtotime($date));

            $monday = new DateTime($date);

            $sunday = new DateTime($date);

            $date_debut = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');

            $date_debut = date('Y-m-d', strtotime($date_debut . " -70 day "));

            $date_fin = date('Y-m-d', strtotime($date_debut . " +140 day "));

        }

        if ($this->request->is('post')) {
            foreach ($this->request->data as $value) {

                foreach ($value as $v) {

                    $a = array();

                    if ($v['liste_id'] != '0') {

                        if ($v['liste_id'] == -1) {

                            $this->Plantourne->id = $v['id'];

                            $this->Plantourne->delete();

                        } else if ($v['id'] != '0') {

                            $a = array();

                            $a['Plantourne']['id'] = $v['id'];

                            $a['Plantourne']['liste_id'] = $v['liste_id'];

                            $a['Plantourne']['date'] = $v['date'];

                            $this->Plantourne->save($a);

                        } else {

                            $a = array();

                            $this->Plantourne->create();

                            $a['Plantourne']['liste_id'] = $v['liste_id'];

                            $a['Plantourne']['date'] = $v['date'];

                            $this->Plantourne->save($a);

                        }

                    }

                }

            }

            $this->Session->setFlash(__('Plan de tournée ajouté'));

            return $this->redirect(array('action' => 'gestion', $this->request->data['Plantourne'][0]['user_id'], $date_debut, $date_fin));

        }

        $i = 0;

        if (AuthComponent::user('role') == 'Super viseur') {

            $this->loadModel('Apartient');

            $this->Apartient->recursive = -1;

            $users = $this->Apartient->find('all', array('conditions' =>

                array('Apartient.user_id' => AuthComponent::user('id'))));

            $i = 1;

            foreach ($users as $value) {

                if ($value["Apartient"]['user1_id'] == $user_id) {

                    $i = 0;

                    break;

                }

            }

        }

        if ($i != 0) {

            $this->Session->setFlash(__('Erreur de navigation'));

            return $this->redirect(array('controller' => 'users', 'action' => 'view'));

        }

        $listes = $this->Plantourne->Liste->find('list', array('conditions' => array('Liste.user_id' => $user_id, "Liste.archive" => 1)));

        $liste_ids = '0';

        foreach ($listes as $key => $value)

            $liste_ids = $liste_ids . ",$key";

        $plans = $this->Plantourne->query("select * from plantournes as Plantourne where date >='$date_debut' and date <='$date_fin' and  liste_id in($liste_ids)");

        $this->set(compact('listes', 'plans', 'user_id', 'date_debut', 'date_fin'));

    }



    function retarder($id, $semaine, $date_debut = null, $date_fin = null) {

        $plan = $this->Plantourne->findById($id);

        $listes = $this->Plantourne->Liste->find('list', array('conditions' => array('Liste.user_id' => $plan['Liste']['user_id'])));

        $liste_ids = '0';

        foreach ($listes as $key => $value)

            $liste_ids = $liste_ids . ",$key";

        $plans = $this->Plantourne->query("select * from plantournes as Plantourne where date >='" . $plan['Plantourne']['date'] . "' and liste_id in($liste_ids)");

        foreach ($plans as $value) {

            $this->Plantourne->id = $value['Plantourne']['id'];

            $day = $semaine * 7;

            $this->Plantourne->saveField('date', date('Y-m-d', strtotime($value['Plantourne']['date'] . " $day day ")));

        }



        $this->Session->setFlash('Modification effectuée');

        return $this->redirect(array('action' => 'gestion', $plan['Liste']['user_id'], $date_debut, $date_fin));

    }



    //demander dans la fonction /users/system_rachid  lin 46

    //	le view/layout/mail/html/system_rachid line 

    //demander dans  le view/Rapport/add line 259

    //demander dans  le view/Rapport/add line 185

    //demander dans  le view/Users/admin_statistique line 137

    function system_existeplanification($user_id, $date_debut) {

        if(date('D', strtotime($date_debut)) != 'Mon')

            $date_debut= date('Y-m-d', strtotime('previous monday', strtotime($date_debut)));

        $this->Plantourne->Liste->recursive = -1;

        $liste = $this->Plantourne->Liste->find("list", array("conditions" => array("Liste.user_id" => $user_id)));

        $liste_id = "0";

        foreach ($liste as $l => $ll)

            $liste_id = $liste_id . ",$l";

        $c = $this->Plantourne->find('count', array("conditions" => array("Plantourne.liste_id in($liste_id) ", "Plantourne.date" => $date_debut)));

        return $c;

    }



}

