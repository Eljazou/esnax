<?php

App::uses('AppController', 'Controller');

/**
 * Prospects Controller
 *
 * @property Prospect $Prospect
 * @property PaginatorComponent $Paginator
 */
class ProspectsController extends AppController {

    function tableau_bord_conseiller() {
        if (isset($_GET['date'])) {
            $date = explode('/', $_GET['date']);
            $date = $date[1] . "-" . $date[0] . "-" . $date[2];
        } else
            $date = date('Y-m-d');
        $nbDay = date('N', strtotime($date));
        $monday = new DateTime($date);
        $date = $monday->modify('-' . ($nbDay - 1) . ' days')->format('Y-m-d');
        $this->set("date", $date);
        $date_fin = date('Y-m-d', strtotime($date . ' +6 day'));

        //ini_set('memory_limit', '-1');
        //set_time_limit(-1);
        $this->loadModel("User");
        $this->User->recursive = -1;
        if (AuthComponent::user('role') == 'Super viseur')
            $supers = $this->User->find('all', array('conditions' => array('User.archive' => 1,
                    'User.id' => AuthComponent::user('id'), "User.role" => 'Super viseur')));
        else
            $supers = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));
        $users = array();
        $this->loadModel("Prospectaffectation");
        $this->Prospectaffectation->recursive = -1;
        $this->loadModel("Rapportprocpect");
        foreach ($supers as $super) 
        {
            $vmp = $this->Prospectaffectation->find('all', array('conditions' => array('Prospectaffectation.user_id' => $super["User"]['id'])));
            $ids = "0";
            foreach ($vmp as $value)
                $ids = $ids . ',' . $value["Prospectaffectation"]['user1_id'];
            $u = array();
            $u = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));
            $i = 0;
            foreach ($u as $vm) {
                $appels = $this->Rapportprocpect->find("all", array('conditions' => array("Rapportprocpect.user_id " => $vm["User"]["id"], "DATE(Rapportprocpect.created) BETWEEN '$date' AND '$date_fin'")));
                $u[$i]["appels"] = $appels;
                $i++;
            }
            $appels = $this->Rapportprocpect->find("all", array('conditions' => array("Rapportprocpect.user_id " => $super["User"]["id"], "DATE(Rapportprocpect.created) BETWEEN '$date' AND '$date_fin'")));
            $super["appels"] = $appels;
            $u["super"] = $super;
            $users[$super["User"]['id']] = $u;
        }

        $this->loadModel("Prospectcompagne");
        $this->Prospectcompagne->recursive = -1;
        $campagnes = $this->Prospectcompagne->find("all");
        $this->set(compact('users', "campagnes"));
    }

    function teleconseiller() {
        $this->loadModel("User");
        $this->loadModel("Prospectaffectation");
        $this->User->recursive = -1;
        $this->loadModel("Prospect");
        $this->Prospect->recursive = -1;
        $vmp = $this->Prospectaffectation->find('all', array('conditions' => array('Prospectaffectation.user_id' => AuthComponent::user('id'))));
        $ids = "0";
        foreach ($vmp as $value)
            $ids = $ids . ',' . $value["Prospectaffectation"]['user1_id'];
        $users = $this->User->find('all', array('conditions' => array("User.id in($ids)", 'User.archive' => 1)));


        //$users = $this->User->find("all", array("conditions" => array("User.archive" => 1, "User.role" => "Teleconseiller")));
        $this->set('users', $users);
    }

    function import() {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        if ($this->request->is('post')) {
            $this->loadModel("Client");
            $this->Client->recursive = -1;
            $this->Client->Category->recursive = -1;
            $cat = $this->Client->Category->find("list");
            $file = $this->request->data['Prospect']['file']['tmp_name'];
            $ext = explode(".", $this->request->data['Prospect']['file']['name']);
            $ext = $ext[count($ext) - 1];
            if (!empty($file)) {
                $this->request->data['Prospect']['file'] = "client.$ext";
                move_uploaded_file($file, 'img/' . $this->request->data['Prospect']['file']);
            } else {
                $this->Session->setFlash(__('Merci de joindre un fichier'));
                return $this->redirect(array('action' => 'import'));
            }

            require_once 'Component/simplexlsx.php';

            if ($xlsx = SimpleXLSX::parse(WWW_ROOT . 'img/client.xlsx')) {
                $skip_first_line = $new = $update = $stop = 0;

                foreach ($xlsx->rows() as $r) {
                    $skip_first_line++;
                    if ($skip_first_line == 1)
                        continue;

                    $d = array();
                    $comma_separated = implode("||", $r);
                    $rr = str_replace("'", "\'", $comma_separated);
                    $r = explode("||", $rr);
                    
					$existe = $this->Client->findByCodeWavsoft($r[0]);
					if (!empty($existe)) {
						$update++;
						$this->Client->id = $existe["Client"]["id"];
					} else {
						$this->Client->create();
						$new++;
					}
					
                    $d["Client"]["category_id"] = $r[1];
                    $d["Client"]["type_pharmacie"] = "Client";
                    $d["Client"]["type_id"] = 2;
                    $d["Client"]["code_wavsoft"] = $r[0];
                    $d["Client"]["nom"] = $r[2];
                    $d["Client"]["date_recrutement"] = date("Y-m-d");
                    //$d["Client"]["longitude"] = $r[4];
                    //$d["Client"]["latitude"] = $r[5];
                    //$d["Client"]["potentialite"] = $r[6];

                    $d["Client"]["dirigent"] = $r[3];
                    $d["Client"]["adress"] = $r[6];

                    //$d["Client"]["fax"] = $r[15];
					$tel=str_replace(" ","",$r[4]);
					if(strlen($tel)==9)
						$tel="0$tel";
					$fixe=str_replace(" ","",$r[5]);
					if(strlen($fixe)==9)
						$fixe="0$fixe";
                    $d["Client"]["tel"] =$tel;
                    $d["Client"]["fixe"] = $fixe;
                    //$d["Client"]["mail"] = $r[16];

                    //Recherche Category si il trouve il assigne id si non on créé une nouvel et on l'ajout dans cat
                    /*$cateexist = 0;
                    foreach ($cat as $k => $v) {
                        if ($r[17] == $v) {
                            $d["Client"]["category_id"] = $k;
                            $cateexist++;
                            break;
                        }
                    }
                    if ($cateexist == 0) {
                        $this->Client->Category->create();
                        $c = array();
                        $c["Category"]["name"] = $r[17];
                        $this->Client->Category->save($c);
                        $d["Client"]["category_id"] = $this->Client->Category->id;
                        $cat = $this->Client->Category->find("list");
                    }*/


                    //system des secteur soit il r'envoi id secteur si il trouve
                    //ou trouve la ville la il créé une secteur appeler indifini et r'envoie id 
                    //ou il créé la ville dans un region donnée et créé un secteur appeler indifini et r'envoi id
                    $d["Client"]["secteur_id"] = $this->system_get_or_add_secteur_id($r[9], $r[8], $r[7]);
                    //$d["Client"]["secteur"] = $r[7];
                    //$d["Client"]["ville"] = $r[12];
                    //$d["Client"]["region"] = $r[18];
                    /* debug($d);
                      if($stop==10)
                      {
                      echo "Importation terminer  avec $new nouveau et $update  mises à jour  ";
                      exit();
                      }
                      $stop++; */

                    $this->Client->save($d);
					//debug($d);exit();
                }
            } else {
                echo SimpleXLSX::parseError();
                echo "erreur";
                exit();
            }

            $this->Session->setFlash("Importation terminer  avec $new nouveau et $update  mises à jour  ");
        }
    }

    function system_gettable() {
        $limit = $ville = $type = $categorie = "";
        if ($this->request->data["limit"] != '')
            $limit = " limit " . ltrim(rtrim($this->request->data["limit"]));
        if ($this->request->data["ville"] != '')
            $ville = " and Prospect.ville like '" . ltrim(rtrim($this->request->data["ville"])) . "'";
        if ($this->request->data["type"] != '')
            $type = " and Prospect.type like '" . ltrim(rtrim($this->request->data["type"])) . "'";
        if ($this->request->data["categorie"] != '')
            $categorie = " and Prospect.categorie like '" . ltrim(rtrim($this->request->data["categorie"])) . "'";

        $prospects = $this->Prospect->find('all', array("conditions" => array("1=1 $ville $type $categorie $limit")));
        echo json_encode($prospects, 0);
        exit();
    }

    function system_get_or_add_secteur_id($secteur, $ville, $region) {
        $this->loadModel("Secteur");
        $this->Secteur->recursive = -1;
        $secteurs = $this->Secteur->find("all");

        $secteur = strtolower($secteur);
        $ville = strtolower($ville);
        $region = strtolower($region);

        //recherche par secteur dans secteur
        foreach ($secteurs as $sec) {
            if (strtolower($sec["Secteur"]["region"]) == strtolower($region)) {
                if (strtolower($sec["Secteur"]["secteur"]) == $secteur || strtolower($sec["Secteur"]["secteur"]) == $ville) {
                    return $sec["Secteur"]["id"];
                    exit();
                }
            }
        }
        foreach ($secteurs as $sec) {
            if (strtolower($sec["Secteur"]["region"]) == strtolower($region)) {
                if (strtolower($sec["Secteur"]["ville"]) == $ville && $sec["Secteur"]["secteur"] == "Indefini") {
                    return $sec["Secteur"]["id"];
                    exit();
                }
            }
        }

        //recherche par ville
        foreach ($secteurs as $sec) {
            if (strtolower($sec["Secteur"]["ville"]) == $ville) {
                $this->Secteur->create();
                $d = array();
                $d["Secteur"]["secteur"] = "Indefini";
                $d["Secteur"]["ville"] = $ville;
                $d["Secteur"]["region"] = $sec["Secteur"]["region"];
                $d["Secteur"]["code_region"] = $sec["Secteur"]["code_region"];
                $d["Secteur"]["code_ville"] = $sec["Secteur"]["code_ville"];
                $d["Secteur"]["code_secteur"] = "";
                $this->Secteur->save($d);
                return $this->Secteur->id;
                exit();
            }
        }
        foreach ($secteurs as $sec) {
            if (strtolower($sec["Secteur"]["region"]) == $region) {
                $this->Secteur->create();
                $d = array();
                $d["Secteur"]["secteur"] = "Indefini";
                $d["Secteur"]["ville"] = $ville;
                $d["Secteur"]["region"] = $sec["Secteur"]["region"];
                $d["Secteur"]["code_region"] = $sec["Secteur"]["code_region"];
                $d["Secteur"]["code_ville"] = "";
                $d["Secteur"]["code_secteur"] = "";
                $this->Secteur->save($d);
                return $this->Secteur->id;
                exit();
            }
        }
        //debug($secteurs);
        exit();
    }

    public function affectation() {
        $this->loadModel("Prospectaffectation");
        $this->loadModel("User");
        if ($this->request->is('post')) {
            $ap = $this->Prospectaffectation->findByUser1Id($this->request->data['Prospectaffectation']['user1_id']);
            if (!empty($ap)) {
                $this->Prospectaffectation->id = $ap['Prospectaffectation']['id'];
                $this->Prospectaffectation->saveField('user_id', $this->request->data['Prospectaffectation']['superviseurs']);
            } else {
                $this->Prospectaffectation->create();
                $this->request->data['Prospectaffectation']['user_id'] = $this->request->data['Prospectaffectation']['superviseurs'];
                $this->Prospectaffectation->save($this->request->data);
            }
            $this->Session->setFlash(__('Affectation réussie'));
            $this->redirect(array('action' => 'affectation'));
        }
        $this->User->recursive = -1;
        $users = $this->User->find('all', array('conditions' => array('User.role in ("VMP","Coordinateur")', 'User.archive' => 1)));
        $superviseurs = $this->User->find('list', array('conditions' => array('User.role' => 'Super viseur', 'User.archive' => 1)));
        $i = 0;
        foreach ($users as $user) {
            $super = $this->Prospectaffectation->find('all', array('conditions' => array('Prospectaffectation.user1_id' => $user['User']['id'])));
            foreach ($super as $value) {
                foreach ($superviseurs as $k => $v) {
                    if ($k == $value['Prospectaffectation']['user_id']) {
                        $users[$i]['User']['super_id'] = $k;
                        $users[$i]['User']['name_id'] = $v;
                        break;
                    }
                }
            }
            $i++;
        }
        $this->set('users', $users);
        $this->set('superviseurs', $superviseurs);
    }

}
