<?php

App::uses('AppController', 'Controller');

class VisitesController extends AppController
{

    public $components = array('Paginator');

    function beforeFilter()
    {
        $this->Auth->allow('sendmail', 'system_cron_delete_visite_double_non_valider');
        parent::beforeFilter();

    }

    public function edit($id = null)
    {
        if (!$this->Visite->exists($id)) {
            throw new NotFoundException(__('Visite invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Visite->save($this->request->data)) {
                $this->Session->setFlash(__('Visite modifiée'));
                $v = $this->Visite->findById($this->request->data['Visite']['id']);
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $v['Visite']['client_id']));
            } else {
                $this->Session->setFlash(__('La visite n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Visite.' . $this->Visite->primaryKey => $id));
            $this->request->data = $this->Visite->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function system_addd($client_id = null)
    {
        /* if(AuthComponent::user('id')==210)
          {
          $this->Session->setFlash(__("Rapport bloquer , Merci d'utiliser la tablet"));
          return $this->redirect(array('controller' => 'clients', 'action' => 'view',$client_id));
          } */
        $produits = "";
        $gammes = "";
        $objections = "";
        $obection = "";
        $words = "";
        $this->loadModel('Brochure');
        if ($this->request->is('post')) {
            $this->Visite->create();
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array(
                            'conditions' => array(
                                'Stockgadjet.user_id' => AuthComponent::user('id'),
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
            $this->request->data['Visite']['user_id'] = AuthComponent::user('id');
            //******
            if (!empty($this->request->data['Client']['sexe'])) {
                $this->loadModel('Client');
                $this->Client->id = $client_id;
                $this->Client->saveField('sexe', $this->request->data['Client']['sexe']);
            }
            if (!empty($this->request->data['Visite']['produits'])) {
                foreach ($this->request->data['Visite']['produits'] as $value) {
                    $gammes = $gammes . "," . $value;
                }
                $gammes = ltrim($gammes, ',');
                $this->request->data['Visite']['produits'] = '*' . $gammes . "|" . $this->request->data['Produit']['nbr_boites'];
            }
            if (isset($this->request->data['Visite']['produitsNP'])) {
                foreach ($this->request->data['Visite']['produitsNP'] as $value) {
                    $produits = $produits . "|" . $value;
                }
            }
            $produits = ltrim($produits, '|');
            $this->request->data['Visite']['produitsNP'] = $produits;
            //debug($this->request->data['Visite']);

            if (isset($this->request->data['Visite']['objection'])) {
                foreach ($this->request->data['Visite']['objection'] as $value) {

                    if ($value == 'prix') {

                        for ($i = 0; $i < 3; $i++) {
                            if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                            }
                        }
                        $words = ltrim($words, "|");
                        $objection = $value . "|" . $words . ",";
                        $objections = $objections . $objection;
                        $objections = ltrim($objections, "|");
                    } elseif ($value == 'indication') {
                        $objection = "";
                        $words = "";
                        for ($i = 3; $i < 6; $i++) {
                            if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                            }
                        }
                        $words = ltrim($words, "|");
                        $objection = $value . "|" . $words . ",";
                        $objections = $objections . $objection;
                    } elseif ($value == 'pathologie') {
                        $objection = "";
                        $words = "";
                        for ($i = 6; $i < 9; $i++) {
                            if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                            }
                        }
                        $words = ltrim($words, "|");
                        $objection = $value . "|" . $words . ",";
                        $objections = $objections . $objection;
                    } elseif ($value == 'posologie') {
                        $objection = "";
                        $words = "";
                        for ($i = 9; $i < 12; $i++) {
                            if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                            }
                        }
                        $words = ltrim($words, "|");
                        $objection = $value . "|" . $words . ",";
                        $objections = $objections . $objection;
                    } elseif ($value == 'presentation') {
                        $objection = "";
                        $words = "";
                        for ($i = 12; $i < 15; $i++) {
                            if (!empty($this->request->data['objections']['mot_cles'][$i])) {
                                $words = $words . "|" . $this->request->data['objections']['mot_cles'][$i];
                            }
                        }
                        $words = ltrim($words, "|");
                        $objection = $value . "|" . $words . ",";
                        $objections = $objections . $objection;
                    }
                }
            }
            //debug($this->request->data['objections']['mot_cles'][0]);
            if (!empty($objections)) {
                $this->request->data['Visite']['objection'] = "*" . $objections;
            } else {
                $this->request->data['Visite']['objection'] = $objections;
            }
            //debug($objections);
            //debug($this->request->data['Visite']['produits']);
            //******
            if ($this->Visite->save($this->request->data)) {
                if (isset($this->request->data['Brochure'])) {
                    foreach ($this->request->data['Brochure'] as $value) {
                        if (isset($value['brochure_id'])) {
                            $d = array();
                            $d['Temp']['client_id'] = $value['client_id'];
                            $d['Temp']['brochure_id'] = $value['brochure_id'];
                            $d['Temp']['durree'] = 0;
                            $d['Temp']['date'] = $this->request->data['Visite']['date'];
                            $this->loadModel('Temp');
                            $this->Temp->create();
                            $this->Temp->save($d);
                        }
                    }
                }
                $this->Session->setFlash(__('Rapport ajouté'));
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            } else {
                $this->Session->setFlash(__('Le rapport n\'a pas pu étre enregistré. Merci de réessayer.'));
            }
        }
        $this->Brochure->recursive = -1;
        $cat = $this->Brochure->query("select Category.id from clients as Client , categories as Category "
            . "where Client.category_id =Category.id and Client.id=$client_id");
        if (empty($cat))
            $brochures = array();
        else
            $brochures = $this->Brochure->find('all', array('conditions' => array('Brochure.archive' => 1, 'Brochure.category_id' => $cat[0]['Category']['id'])));
        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array(
            'conditions' => array(
                'Stockgadjet.user_id' => AuthComponent::user('id'),
                'Stockgadjet.quantite>0'
            )
        ));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list');
        $this->loadModel('Game');
        $games = $this->Game->find('list');
        $this->set(compact('stock', 'brochures', "client_id", "infosclient", "produits", "games"));
    }

    public function system_adddd($client_id = null)
    {
        /* if(AuthComponent::user('id')==210)
          {
          $this->Session->setFlash(__("Rapport bloquer , Merci d'utiliser la tablet"));
          return $this->redirect(array('controller' => 'clients', 'action' => 'view',$client_id));
          } */
        $produits = "";

        $this->loadModel('Brochure');
        if ($this->request->is('post')) {
            $d = date('Y-m-d');
            //ce petit code me permet de savoir si l'envoie du formulaire est envoyer deux fois probléme de con 
            $deja = $this->Visite->find('count', array('conditions' => array('Visite.user_id' => AuthComponent::user('id'), 'Visite.client_id' => $this->request->data["Visite"]['client_id'], "DATE(Visite.created)='$d'")));
            if ($deja != 0) {
                $this->Session->setFlash("Rapport ajouté plusieurs fois, seul le premier qui est pris en considération ");
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            }

            $this->Visite->create();
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array(
                            'conditions' => array(
                                'Stockgadjet.user_id' => AuthComponent::user('id'),
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
            $this->request->data['Visite']['user_id'] = AuthComponent::user('id');
            //******
            if (!empty($this->request->data['Client']['sexe'])) {
                $this->loadModel('Client');
                $this->Client->id = $client_id;
                $this->Client->saveField('sexe', $this->request->data['Client']['sexe']);
            }
            if (!empty($this->request->data['Visite']['produits'])) {
                $this->request->data['Visite']['produits'] = $this->request->data['Visite']['produits'] . "|" . $this->request->data['Produit']['nbr_boites'];
            }
            if (isset($this->request->data['Visite']['produitsNP'])) {
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
            //echo $object;
            //***********************
            //debug($this->request->data['objections']['mot_cles'][0]);
            if (!empty($objections)) {
                $this->request->data['Visite']['objection'] = "#" . ltrim($object, "||");
            } else {
                $this->request->data['Visite']['objection'] = $objections;
            }
            //debug($objections);
            //debug($this->request->data['Visite']['produits']);
            //******
            if ($this->Visite->save($this->request->data)) {
                if (isset($this->request->data['Brochure'])) {
                    foreach ($this->request->data['Brochure'] as $value) {
                        if (isset($value['brochure_id'])) {
                            $d = array();
                            $d['Temp']['client_id'] = $value['client_id'];
                            $d['Temp']['brochure_id'] = $value['brochure_id'];
                            $d['Temp']['durree'] = 0;
                            $d['Temp']['date'] = $this->request->data['Visite']['date'];
                            $this->loadModel('Temp');
                            $this->Temp->create();
                            $this->Temp->save($d);
                        }
                    }
                }
                $this->Session->setFlash(__('Rapport ajouté'));
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            } else {
                $this->Session->setFlash(__('Le rapport n\'a pas pu étre enregistré. Merci de réessayer.'));
            }
        }
        $this->Brochure->recursive = -1;
        $cat = $this->Brochure->query("select Category.id from clients as Client , categories as Category "
            . "where Client.category_id =Category.id and Client.id=$client_id");
        if (empty($cat))
            $brochures = array();
        else
            $brochures = $this->Brochure->find('all', array('conditions' => array('Brochure.archive' => 1, 'Brochure.category_id' => $cat[0]['Category']['id'])));
        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array(
            'conditions' => array(
                'Stockgadjet.user_id' => AuthComponent::user('id'),
                'Stockgadjet.quantite>0'
            )
        ));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list');
        $this->loadModel('Game');
        $games = $this->Game->find('list');
        $this->set(compact('stock', 'brochures', "client_id", "infosclient", "produits", "games"));
    }

    // derniere version men visite add 
    public function add($client_id = null)
    {

        $produits = "";
        $gammes = "";
        $this->loadModel('Brochure');
        if ($this->request->is('post')) {
            $d = date('Y-m-d');
            // debug($this->request->data);exit;
            if (strlen($this->request->data["Visite"]['date']) < 3)
                $this->request->data["Visite"]['date'] = date('Y-m-d H:i:s');
            //ce petit code me permet de savoir si l'envoie du formulaire est envoyer deux fois probléme de con 
            $deja = $this->Visite->find('count', array('conditions' => array('Visite.user_id' => AuthComponent::user('id'), 'Visite.client_id' => $this->request->data["Visite"]['client_id'], "DATE(Visite.date)" => $d)));
            if ($deja != 0) {
                $this->Session->setFlash("Rapport ajouté plusieurs fois, seul le premier qui est pris en considération ");
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            }
            //---------------Fin de code de visite multiple
            $this->Visite->create();
            $this->request->data['Visite']['user_id'] = AuthComponent::user('id');
            //code pour pharmacie
            $this->Visite->Client->recursive = -1;
            $client_info = $this->Visite->Client->findById($this->request->data["Visite"]["client_id"]);
            if ($client_info["Client"]["type_id"] == 2) {
                //----------------liste des produits partenaire de CONSEIL------------
                if (
                    !empty($this->request->data["Visite"]["produits"]) && !isset($this->request->data["Visite"]["produitschoix"])
                    && $this->request->data["Visite"]["produitschoix"] != ""
                ) {
                    $produits = "*";
                    foreach ($this->request->data["Visite"]["produits"] as $k => $v)
                        $produits = $produits . $v . ",";
                    $produits = rtrim($produits, ", ");
                    $this->request->data["Visite"]["produits"] = $produits . "|" . $this->request->data["Visite"]["produitschoix"];
                } else
                    $this->request->data["Visite"]["produits"] = null;
                //-------------liste des produits partenairede CONSEIL----------------//
                if (
                    !empty($this->request->data["Visite"]["produitsNP"]) && !isset($this->request->data["Visite"]["produitsNPchoix"])
                    && $this->request->data["Visite"]["produitsNPchoix"] != ""
                ) {
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
                        if (
                            $value["produit"] != "" && $value["produitconcurant"] && $value["plv"] != "" && $value["emplacement"] != ""
                            && $value["offre"] && $value["agressivite"] && $value["stock"] != ""
                        )
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
                            $stock["client_id"] = $this->request->data["Visite"]["client_id"];
                            $stock["user_id"] = $this->request->data["Visite"]["user_id"];
                            $stockvisite = array();
                            $stockvisite["Stockvisite"] = $stock;
                            $this->Stockvisite->create();
                            //debug($stockvisite);
                            $this->Stockvisite->save($stockvisite);
                        }
                    }


                    //-----------------------------Fin Systeme de stock produits-------------------//
                    $this->Session->setFlash(__('Rapport ajouté'));
                    return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
                } else {
                    $this->Session->setFlash("Erreur dans le rapport, merci de réessayer");
                    return $this->redirect();
                }
            }
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array(
                            'conditions' => array(
                                'Stockgadjet.user_id' => AuthComponent::user('id'),
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
            //******
            if (!empty($this->request->data['Client']['sexe'])) {
                $this->loadModel('Client');
                $this->Client->id = $client_id;
                $this->Client->saveField('sexe', $this->request->data['Client']['sexe']);
            }
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
                ;
            } else {
                $this->request->data['Visite']['objection'] = $objections;
            }
            if (!isset($this->request->data['Visite']['concurrence_p']) || is_array($this->request->data['Visite']['concurrence_p']))
                $this->request->data['Visite']['concurrence_p'] = "";

            //debug($objections);
            //debug($this->request->data['Visite']['produits']);
            //******
            if ($this->Visite->save($this->request->data)) {
                $visite_id = $this->Visite->id;
                $this->stock_ordre($this->request->data["Visite"]["order"], $visite_id);
                // if (isset($this->request->data['Brochure'])) {
                //     foreach ($this->request->data['Brochure'] as $value) {
                //         if (isset($value['brochure_id'])) {
                //             $d = array();
                //             $d['Temp']['client_id'] = $value['client_id'];
                //             $d['Temp']['brochure_id'] = $value['brochure_id'];
                //             $d['Temp']['durree'] = 0;
                //             $d['Temp']['date'] = $this->request->data['Visite']['date'];
                //             $this->loadModel('Temp');
                //             $this->Temp->create();
                //             $this->Temp->save($d);
                //         }
                //     }
                // }
                $this->Session->setFlash(__('Rapport ajouté'));
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            } else {
                $this->Session->setFlash(__('Le rapport n\'a pas pu étre enregistré. Merci de réessayer.'));
            }
        }
        $this->Brochure->recursive = -1;
        $cat = $this->Brochure->query("select Category.id from clients as Client , categories as Category "
            . "where Client.category_id =Category.id and Client.id=$client_id");
        if (empty($cat))
            $brochures = array();
        else
            $brochures = $this->Brochure->find('all', array('conditions' => array('Brochure.archive' => 1, 'Brochure.category_id' => $cat[0]['Category']['id'])));
        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array(
            'conditions' => array(
                'Stockgadjet.user_id' => AuthComponent::user('id'),
                'Stockgadjet.quantite>0'
            )
        ));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id,category_id from clients where id=" . $client_id);

        $ordres = $this->system_get_ordre(AuthComponent::user('ligne_id'), $infosclient[0]['clients']['category_id']);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
        //-----------------------Fin---------------------
        $this->set(compact('stock', 'brochures', "client_id", "infosclient", "produits", "games", "produits_stock", "ordres"));

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
            $this->set("clients", $clients);
        }
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

    // derniere version men visite add 
    public function add_cp($client_id = null)
    {

        $produits = "";
        $gammes = "";
        $this->loadModel('Brochure');
        if ($this->request->is('post')) {
            // debug($this->request->data);exit;
            $d = date('Y-m-d');
            if (strlen($this->request->data["Visite"]['date']) < 3)
                $this->request->data["Visite"]['date'] = date('Y-m-d H:i:s');
            //ce petit code me permet de savoir si l'envoie du formulaire est envoyer deux fois probléme de con 
            $deja = $this->Visite->find('count', array('conditions' => array('Visite.user_id' => AuthComponent::user('id'), 'Visite.client_id' => $this->request->data["Visite"]['client_id'], "DATE(Visite.date)" => $d, 'Visite.archive' => 1)));
            if ($deja != 0) {
                $this->Session->setFlash("Rapport ajouté plusieurs fois, seul le premier qui est pris en considération ");
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            }
            //---------------Fin de code de visite multiple
            $this->Visite->create();
            $this->request->data['Visite']['user_id'] = AuthComponent::user('id');
            //code pour pharmacie
            $this->Visite->Client->recursive = -1;
            $client_info = $this->Visite->Client->findById($this->request->data["Visite"]["client_id"]);
            if ($client_info["Client"]["type_id"] == 2) {
                //----------------liste des produits partenaire de CONSEIL------------
                if (
                    !empty($this->request->data["Visite"]["produits"]) && !isset($this->request->data["Visite"]["produitschoix"])
                    && $this->request->data["Visite"]["produitschoix"] != ""
                ) {
                    $produits = "*";
                    foreach ($this->request->data["Visite"]["produits"] as $k => $v)
                        $produits = $produits . $v . ",";
                    $produits = rtrim($produits, ", ");
                    $this->request->data["Visite"]["produits"] = $produits . "|" . $this->request->data["Visite"]["produitschoix"];
                } else
                    $this->request->data["Visite"]["produits"] = null;
                //-------------liste des produits partenairede CONSEIL----------------//
                if (
                    !empty($this->request->data["Visite"]["produitsNP"]) && !isset($this->request->data["Visite"]["produitsNPchoix"])
                    && $this->request->data["Visite"]["produitsNPchoix"] != ""
                ) {
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
                        if (
                            $value["produit"] != "" && $value["produitconcurant"] && $value["plv"] != "" && $value["emplacement"] != ""
                            && $value["offre"] && $value["agressivite"] && $value["stock"] != ""
                        )
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
                            $stock["client_id"] = $this->request->data["Visite"]["client_id"];
                            $stock["user_id"] = $this->request->data["Visite"]["user_id"];
                            $stockvisite = array();
                            $stockvisite["Stockvisite"] = $stock;
                            $this->Stockvisite->create();
                            //debug($stockvisite);
                            $this->Stockvisite->save($stockvisite);
                        }
                    }


                    //-----------------------------Fin Systeme de stock produits-------------------//
                    $this->Session->setFlash(__('Rapport ajouté'));
                    return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
                } else {
                    $this->Session->setFlash("Erreur dans le rapport, merci de réessayer");
                    return $this->redirect();
                }
            }
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array(
                            'conditions' => array(
                                'Stockgadjet.user_id' => AuthComponent::user('id'),
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
            //******
            if (!empty($this->request->data['Client']['sexe'])) {
                $this->loadModel('Client');
                $this->Client->id = $client_id;
                $this->Client->saveField('sexe', $this->request->data['Client']['sexe']);
            }
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
                ;
            } else {
                $this->request->data['Visite']['objection'] = $objections;
            }
            if (!isset($this->request->data['Visite']['concurrence_p']) || is_array($this->request->data['Visite']['concurrence_p']))
                $this->request->data['Visite']['concurrence_p'] = "";

            //debug($objections);
            //debug($this->request->data['Visite']['produits']);
            //******
            if ($this->Visite->save($this->request->data)) {
                if (isset($this->request->data['Brochure'])) {
                    foreach ($this->request->data['Brochure'] as $value) {
                        if (isset($value['brochure_id'])) {
                            $d = array();
                            $d['Temp']['client_id'] = $value['client_id'];
                            $d['Temp']['brochure_id'] = $value['brochure_id'];
                            $d['Temp']['durree'] = 0;
                            $d['Temp']['date'] = $this->request->data['Visite']['date'];
                            $this->loadModel('Temp');
                            $this->Temp->create();
                            $this->Temp->save($d);
                        }
                    }
                }
                $this->Session->setFlash(__('Rapport ajouté'));
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            } else {
                $this->Session->setFlash(__('Le rapport n\'a pas pu étre enregistré. Merci de réessayer.'));
            }
        }
        $this->Brochure->recursive = -1;
        $cat = $this->Brochure->query("select Category.id from clients as Client , categories as Category "
            . "where Client.category_id =Category.id and Client.id=$client_id");
        if (empty($cat))
            $brochures = array();
        else
            $brochures = $this->Brochure->find('all', array('conditions' => array('Brochure.archive' => 1, 'Brochure.category_id' => $cat[0]['Category']['id'])));
        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array(
            'conditions' => array(
                'Stockgadjet.user_id' => AuthComponent::user('id'),
                'Stockgadjet.quantite>0'
            )
        ));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id,category_id from clients where id=" . $client_id);

        $ordres = $this->system_get_ordre(AuthComponent::user('ligne_id'), $infosclient[0]['clients']['category_id']);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
        //-----------------------Fin---------------------
        $this->set(compact('stock', 'brochures', "client_id", "infosclient", "produits", "games", "produits_stock", "ordres"));

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
            $this->set("clients", $clients);
        }
    }

    //hada dial ordre de produit a afficher
    function system_get_ordre($ligne_id, $category_id)
    {

        $this->loadModel("Brochure");
        $data = $this->Brochure->Brochureorganise->find("all", array("conditions" => array("Brochureorganise.ligne_id" => $ligne_id, "Brochureorganise.category_id" => $category_id), "order" => array("Brochureorganise.ordre" => "ASC")));
        return $data;
    }

    public function archive($id = null, $valide = null)
    {
        if ($id != null) {
            $this->Visite->id = $id;
            $this->Visite->saveField('archive', $valide);
            if ($valide == 1) {
                $this->Session->setFlash(__('Visite activée'));
                return $this->redirect(array('action' => 'archive'));
            } else {
                $this->Session->setFlash(__('Visite archivée'));
                $v = $this->Visite->findById($id);
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $v['Visite']['client_id']));
            }
            return $this->redirect(array('action' => 'archive'));
        }
        $actions = $this->Visite->find('all', array('conditions' => array('Visite.archive' => 0)));
        $this->set('visites', $actions);
    }

    function system_get_nombre_visite_for_note_defrais($user_id, $date_debut, $date_fin)
    {
        $visite = $this->Visite->find('count', array(
            'conditions' => array(
                'Visite.user_id' => $user_id,
                'Visite.archive' => 1,
                "DATE(Visite.date) >= '$date_debut' and DATE(Visite.date) <= '$date_fin'"
            )
        ));
        $this->loadModel('Objectif');
        $this->Objectif->recursive = 0;
        $objectifs = $this->Objectif->find('all', array(
            'conditions' => array(
                'Objectif.user_id' => $user_id,
                "DATE(Objectif.created) >= '$date_debut'"
            ),
            'order' => array("Objectif.created asc limit 1")
        ));
        $total = 0;
        foreach ($objectifs as $value)
            $total = $total + $value['Objectif']['objectif'];
        return $visite . '||' . $total;
    }


    function system_get_statistique_4_user($user_id, $date_debut, $date_fin)
    {
        $date_fin = $date_fin . ' 23:59';
        $visites = $this->Visite->find(
            'count',
            array(
                'fields' => array('Visite.id'),
                'conditions' => array(
                    'Visite.archive' => 1,
                    "Visite.user_id" => $user_id,
                    "Visite.date between '$date_debut' and '$date_fin'"
                )
            )
        );
        return $visites;
    }

    function sendmail($token = null)
    {
        if ($token != 21012017) {
            echo "Merci";
            exit();
        } else {
            App::uses('CakeEmail', 'Network/Email');
            $Email = new CakeEmail();
            $Email->template('default', 'a');
            //$this->Visite->recursive = -1;
            $visites = $this->Visite->find('all', array(
                'conditions' => array(
                    'Visite.date >= DATE(NOW()) - INTERVAL 7 DAY'
                ),
                'order' => array('Visite.date asc')
            ));
            $Email->viewVars(array("visites" => $visites));
            $Email->emailFormat('html');
            $Email->to(array("z.ouzine@esnapharm.com", "m.ouichou@esnapharm.com", "godsneek@hotmail.com")); //AuthComponent::user('prenom')
            $Email->from('crmvmp@icoz.ma');
            $Email->subject('CRMVMP Rapport de la semaine précédente ‏');
            try {
                $Email->send();
            } catch (Exception $e) {
                echo 'walo';
            }
            echo "Mail envoyé";
            exit();
        }
    }

    public function get_objections_forspecialite_byword($id, $mot)
    {
        $visites = $this->Visite->query("select * from visites v 
	inner join clients c on v.client_id=c.id 
	inner join users u on v.user_id=u.id
	where c.category_id=" . $id . " and objection like '%" . $mot . "%'");
        //debug($visites);
        $this->set('visites', $visites);
        $this->set('mot', $mot);
    }

    public function get_commentaires_forspecialite_byword($id, $mot)
    {
        $visites = $this->Visite->query("select * from visites v 
	inner join clients c on v.client_id=c.id 
	inner join users u on v.user_id=u.id
	where c.category_id=" . $id . " and commentaire like '%" . $mot . "%'");
        //debug($visites);
        $this->set('visites', $visites);
        $this->set('mot', $mot);
    }

    public function get_veilles_forspecialite_byword($id, $mot)
    {
        $visites = $this->Visite->query("select * from visites v 
	inner join clients c on v.client_id=c.id 
	inner join users u on v.user_id=u.id
	where c.category_id=" . $id . " and veille like '%" . $mot . "%'");
        //debug($visites);
        $this->set('visites', $visites);
        $this->set('mot', $mot);
    }

    //
    public function suiviglobal()
    {
        $this->loadModel('User');
        if (AuthComponent::user('role') == 'Responsable promotion' || AuthComponent::user('role') == 'Admin') {
            $users = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.role" => 'Super viseur')));
        } elseif (AuthComponent::user('role') == 'Super viseur') {
            $users = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.id" => AuthComponent::user('id'))));
        }
        $this->set('users', $users);
    }

    public function statistique($id = null, $date_debut = null, $date_fin = null)
    {
        if (empty($date_debut) || empty($date_fin)) {
            $date_debut = date('Y-m-01', strtotime('-2 month'));
            $date_fin = date('Y-m-t', strtotime('0 month'));
        } else {
            $date_debut = date('Y-m-01', strtotime($date_debut));
            $date_fin = date('Y-m-t', strtotime($date_fin));
        }
        if ($id == null || AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
            $id = AuthComponent::user('id');
            $visites = $this->Visite->find('all', array(
                'conditions' => array(
                    'User.archive' => 1,
                    'Visite.user_id' => $id,
                    "Visite.date between '$date_debut' and '$date_fin'"
                )
            ));
        } else if ($id != null) {
            $this->loadModel('Apartient');
            if (AuthComponent::user('role') == 'Responsable promotion' || AuthComponent::user('role') == 'Admin') {
                $users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $id), 'fields' => array('Apartient.user1_id')));
            } elseif (AuthComponent::user('role') == 'Super viseur') {
                $users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id')), 'fields' => array('Apartient.user1_id')));
            }
            $ids = array();
            $ids[] = $id;
            foreach ($users as $u) {
                $ids[] = $u['Apartient']['user1_id'];
            }
            $visites = $this->Visite->find('all', array('conditions' => array('User.archive' => 1, 'Visite.user_id' => $ids, "Visite.date between '$date_debut' and '$date_fin'")));
        } else {
            $visites = $this->Visite->find('all', array(
                'conditions' => array(
                    'User.archive' => 1,
                    'Visite.user_id' => $id,
                    "Visite.date between '$date_debut' and '$date_fin'"
                )
            ));
        }

        $this->set(compact('visites', 'date_debut', 'date_fin', 'id'));
    }

    function system_statvisitbyparams($param = null, $user_id = null, $date_debut = null, $date_fin = null)
    {
        if (empty($date_debut) || empty($date_fin)) {
            $date_debut = date('Y-m-01', strtotime('-2 month'));
            $date_fin = date('Y-m-t', strtotime('0 month'));
        } else {
            $date_debut = date('Y-m-01', strtotime($date_debut));
            $date_fin = date('Y-m-t', strtotime($date_fin));
        }
        if ($param == "A1") {
            $param = "`Client`.`potentialite` like 'A1'";
        } else if ($param == "A2") {
            $param = "`Client`.`potentialite` like 'A2'";
        } else if ($param == "A3") {
            $param = "`Client`.`potentialite` like 'A3'";
        } else if ($param == "A4") {
            $param = "`Client`.`potentialite` like 'A4'";
        } else if ($param == "B1") {
            $param = "`Client`.`potentialite` like 'B1'";
        } else if ($param == "B2") {
            $param = "`Client`.`potentialite` like 'B2'";
        } else if ($param == "B3") {
            $param = "`Client`.`potentialite` like 'B3'";
        } else if ($param == "B4") {
            $param = "`Client`.`potentialite` like 'B4'";
        } else if ($param == "C1") {
            $param = "`Client`.`potentialite` like 'C1'";
        } else if ($param == "C2") {
            $param = "`Client`.`potentialite` like 'C2'";
        } else if ($param == "C3") {
            $param = "`Client`.`potentialite` like 'C3'";
        } else if ($param == "C4") {
            $param = "`Client`.`potentialite` like 'C4'";
        } else if ($param == "NR") {
            $param = "`Client`.`potentialite` like 'NR'";
        } else if ($param == "bien") {
            $param = "`Visite`.`partenaires` like 'bien'";
        } else if ($param == "moyen") {
            $param = "`Visite`.`partenaires` like 'moyen'";
        } else if ($param == "faible") {
            $param = "`Visite`.`partenaires` like 'faible'";
        } else if ($param == 100) {
            $param = "`Visite`.`veille` = 100";
        } else if ($param == 50) {
            $param = "`Visite`.`veille` = 50";
        } else if ($param == "-+") {
            $param = "`Visite`.`veille` like '-+'";
        }
        $this->loadModel('Apartient');
        if (AuthComponent::user('role') == 'Super viseur') {
            $users = $this->Apartient->find('all', array(
                'conditions' => array('Apartient.user_id' => AuthComponent::user('id')),
                'fields' => array('Apartient.user1_id')
            ));
        } else
            $users = $this->Apartient->find('all', array(
                'conditions' => array('Apartient.user_id' => $user_id),
                'fields' => array('Apartient.user1_id')
            ));
        $ids = array();
        foreach ($users as $u) {
            $ids[] = $u['Apartient']['user1_id'];
        }
        $visites = $this->Visite->find('all', array('conditions' => array('User.archive' => 1, 'Visite.user_id' => $ids, "DATE(Visite.date) between '$date_debut' and '$date_fin'", $param)));
        $this->loadModel('Category');
        $categories = $this->Category->find('list');
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list');
        $this->set(compact('visites', 'categories', 'produits'));
    }

    //une fonction a haut resque change les commantaires d'un client a autre 
    //demander /clients/trouvedoublon.ctp
    function migration($from, $to)
    {
        $this->Visite->query("UPDATE visites  SET client_id='$to' WHERE  client_id=$from;");
        $this->Visite->query("UPDATE rapportprocpects SET client_id=$to WHERE  client_id=$from;");
        $this->Visite->query("UPDATE prospectfeuilles SET client_id=$to WHERE  client_id=$from;");
        $this->Visite->query("UPDATE stockvisites SET client_id=$to WHERE  client_id=$from;");
        $this->Session->setFlash(__('migration effectué '));
        return $this->redirect(array('controller' => 'clients', 'action' => 'trouverdoublons'));
    }

    //function de pointage afiche permier et dernier visite pour chaque VM par jour

    function pointage()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $date_debut = date("Y-m-01 00:00");
        $date_fin = date("Y-m-02 23:59");
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        }
        $this->Visite->recursive = -1;
        $visites = $this->Visite->find("all", array("conditions" => array("Visite.archive" => 1, "Visite.date BETWEEN '$date_debut' AND '$date_fin' order by Visite.id asc")));
        $this->Visite->User->recursive = -1;
        $users = $this->Visite->User->find("all");
        $usersById = [];
        foreach ($users as $user) {
            $userId = $user['User']['id'];
            $usersById[$userId] = $user['User'];
        }
        $this->Visite->Client->recursive = -1;
        $clients = $this->Visite->Client->find("all");
        $clientsById = [];
        foreach ($clients as $client) {
            $clientId = $client['Client']['id'];
            $clientsById[$clientId] = $client['Client'];
        }
        foreach ($visites as $i => $visite) {
            $visites[$i]["User"] = $usersById[$visite["Visite"]["user_id"]];
            $visites[$i]["Client"] = $clientsById[$visite["Visite"]["client_id"]];
        }
        //debug($visites,0,0);exit();
        $this->set(compact("visites", "date_debut", "date_fin"));
    }

    /* test new add */

    public function visite_pharmacie($client_id = null)
    {
        /* if(AuthComponent::user('id')==210)
          {
          $this->Session->setFlash(__("Rapport bloquer , Merci d'utiliser la tablet"));
          return $this->redirect(array('controller' => 'clients', 'action' => 'view',$client_id));
          } */
        $produits = "";
        $gammes = "";
        $gammesC = "";

        if ($this->request->is('post')) {
            $d = date('Y-m-d');
            //ce petit code me permet de savoir si l'envoie du formulaire est envoyer deux fois probléme de con 
            $deja = $this->Visite->find('count', array('conditions' => array('Visite.user_id' => AuthComponent::user('id'), 'Visite.client_id' => $this->request->data["Visite"]['client_id'], "DATE(Visite.created)='$d'")));
            if ($deja != 0) {
                $this->Session->setFlash("Rapport ajouté plusieurs fois, seul le premier qui est pris en considération ");
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            }

            $this->Visite->create();
            $this->request->data['Visite']['user_id'] = AuthComponent::user('id');
            //******
            if (!empty($this->request->data['Client']['sexe'])) {
                $this->loadModel('Client');
                $this->Client->id = $client_id;
                $this->Client->saveField('sexe', $this->request->data['Client']['sexe']);
            }
            if (!empty($this->request->data['Visite']['produits'])) {
                //debug($this->request->data['Visite']['produits']);
                foreach ($this->request->data['Visite']['produits'] as $value) {
                    $gammes = $gammes . "," . $value;
                }
                $gammes = ltrim($gammes, ',');
                $this->request->data['Visite']['produits'] = '*' . $gammes . "|" . $this->request->data['Produit']['nbr_boites'];
            }
            //produits conseil pharmacie
            if (!empty($this->request->data['Visite']['produitsNP'])) {
                //debug($this->request->data['Visite']['produits']);
                foreach ($this->request->data['Visite']['produitsNP'] as $value) {
                    $gammesC = $gammesC . "," . $value;
                }
                $gammesC = ltrim($gammesC, ',');
                $this->request->data['Visite']['produitsNP'] = '*' . $gammesC . "|" . $this->request->data['Produit']['nbr_boitesC'];
            }
            //nom des prescripteurs

            if (isset($this->request->data['Visite']['prescripteurs'])) {
                foreach ($this->request->data['Visite']['prescripteurs'] as $value) {
                    $produits = $produits . "|" . $value;
                }
            }
            $produits = ltrim($produits, '|');
            $this->request->data['Visite']['prescripteurs'] = $produits;
            //****** 
            $veille = "";
            foreach ($this->request->data['veillep'] as $c) {
                if (!empty($c["produit_id"])) {
                    $veille = $veille . "" . $c["produit_id"];
                }
                if (!empty($c["emplacement"])) {
                    $veille = $veille . "|" . $c["emplacement"];
                }
                if (!empty($c["plv"])) {
                    $veille = $veille . "|" . $c["plv"];
                }
                if (!empty($c["stock"])) {
                    $veille = $veille . "|" . $c["stock"];
                }
                $veille = $veille . ',';
            }
            $veille = ltrim($veille, '|');
            $veille = substr($veille, 0, -1);
            $this->request->data['Visite']['objection'] = $veille;
            //*******
            //****** 
            $concurent = "";
            foreach ($this->request->data['RapportConcurance'] as $c) {
                if (!empty($c["produit_id"])) {
                    $concurent = $concurent . "" . $c["produit_id"];
                }
                if (!empty($c["produit_concurant"])) {
                    $concurent = $concurent . "|" . $c["produit_concurant"];
                }
                if (!empty($c["emplacement"])) {
                    $concurent = $concurent . "|" . $c["emplacement"];
                }
                if (!empty($c["plv"])) {
                    $concurent = $concurent . "|" . $c["plv"];
                }
                if (!empty($c["type_offre"])) {
                    $info = "";
                    foreach ($c["type_offre"] as $k => $va) {
                        $info = $info . "-" . $va;
                    }
                    $c["type_offre"] = substr($info, 1);
                    $concurent = $concurent . "|" . $c["type_offre"];
                }
                if (!empty($c["agressivite"])) {
                    $info = "";
                    foreach ($c["agressivite"] as $k => $va) {
                        $info = $va;
                    }
                    $c["agressivite"] = $info;
                    $concurent = $concurent . "|" . $c["agressivite"];
                }
                if (!empty($c["stock"])) {
                    $concurent = $concurent . "|" . $c["stock"];
                }
                $concurent = $concurent . ',';
            }
            $concurent = ltrim($concurent, '|');
            $concurent = substr($concurent, 0, -1);
            $this->request->data['Visite']['concurrence_p'] = $concurent;
            //*******
            if ($this->Visite->save($this->request->data)) {

                $this->Session->setFlash(__('Rapport ajouté'));
                return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
            } else {
                $this->Session->setFlash(__('Le rapport n\'a pas pu étre enregistré. Merci de réessayer.'));
            }
        }
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe from clients where id=" . $client_id);
        $secteurclient = $this->Client->query("select secteur_id from clients where id=" . $client_id);
        //debug($secteurclient);
        $clientsSecteurs = $this->Client->find('list', array('conditions' => array('Client.secteur_id' => $secteurclient[0]['clients']['secteur_id']), 'fields' => array('Client.id', 'Client.nom')));

        //debug($clientsSecteurs,0);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));
        $this->loadModel('Game');

        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        $this->set(compact('stock', 'brochures', "client_id", "infosclient", "produits", "games", "clientsSecteurs"));
    }




    function couvertures()
    {
        $date_debut = date('Y-m-01');
        $date_fin = date('Y-m-t');
        $visites = $this->Visite->find("all", array("conditions" => array("Visite.archive=1", "DATE(Visite.date) between '$date_debut' and '$date_fin'")));
        $this->loadModel("Category");
        $this->loadModel("Type");
        $categories = $this->Category->find("list");
        $types = $this->Type->find("list");
        $this->set(compact("visites", 'categories', 'types'));
    }

    // Fonction pour calculer la distance entre deux points
    function system_distance($lon1, $lat1, $lon2, $lat2)
    {
        if (empty($lon1) || empty($lon2))
            return -1;

        $theta = deg2rad($lon2 - $lon1);
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos($theta);
        $dist = acos($dist);
        return round(rad2deg($dist) * 111.19, 1); // Conversion directe en km
    }

    function system_filter_gps($gpsData, $distanceThreshold = 10)
    {
        if (empty($gpsData) || !is_array($gpsData)) {
            return array(); // Retourner un tableau vide si les données sont invalides
        }

        $filteredGps = array();

        foreach ($gpsData as $gpsPoints) {
            foreach ($gpsPoints as $id => $gpsPoint) {
                // Vérifier si le point est une chaîne et non vide
                if (!is_string($gpsPoint) || empty($gpsPoint)) {
                    continue; // Ignorer les données invalides
                }

                // Vérifier le format du point GPS
                $coordinates = explode(',', $gpsPoint);
                if (count($coordinates) !== 2) {
                    continue; // Ignorer les données mal écrites
                }

                $lat = (float) $coordinates[0];
                $lon = (float) $coordinates[1];

                if ($lat === 0.0 || $lon === 0.0) {
                    continue; // Ignorer les coordonnées invalides
                }

                $isFarEnough = true;

                // Vérifier la distance avec les points déjà filtrés
                foreach ($filteredGps as $filteredPoint) {
                    list($filteredLat, $filteredLon) = explode(',', $filteredPoint);

                    $distance = $this->system_distance($lon, $lat, (float) $filteredLon, (float) $filteredLat);

                    if ($distance < $distanceThreshold) {
                        $isFarEnough = false;
                        break;
                    }
                }

                // Ajouter le point uniquement s'il est loin des autres
                if ($isFarEnough) {
                    $filteredGps[] = $gpsPoint;
                }
            }
        }

        return $filteredGps;
    }

    function system_moyenne_heure($heures)
    {
        $total_secondes = 0;
        $nb_heures = count($heures);

        foreach ($heures as $heure) {
            list($h, $m) = explode(':', $heure);
            $total_secondes += ($h * 3600) + ($m * 60);
        }

        $moyenne_secondes = $total_secondes / $nb_heures;

        $moyenne_heures = floor($moyenne_secondes / 3600);
        if ($moyenne_heures < 10)
            $moyenne_heures = "0$moyenne_heures";
        $moyenne_secondes %= 3600;
        $moyenne_minutes = floor($moyenne_secondes / 60);
        if ($moyenne_minutes < 10)
            $moyenne_minutes = "0$moyenne_minutes";

        return "$moyenne_heures:$moyenne_minutes";
    }


    function system_top()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);

        $date_debut = date("Y-m-05 00:00");
        $date_fin = date("Y-m-07 23:59");

        $this->Visite->recursive = -1;
        $visites = $this->Visite->find("all", [
            "conditions" => ["Visite.archive" => 1, "Visite.date BETWEEN ? AND ?" => [$date_debut, $date_fin]],
            "fields" => [
                "Visite.id",
                "Visite.date",
                "Visite.created",
                "Visite.timer",
                "Visite.latitude",
                "Visite.longitude",
                "Client.longitude",
                "Client.latitude",
                "Client.activite",
                "Client.potentialite",
                "User.id"
            ],
            "joins" => [
                ["table" => "clients", "alias" => "Client", "type" => "LEFT", "conditions" => "Client.id = Visite.client_id"],
                ["table" => "users", "alias" => "User", "type" => "LEFT", "conditions" => "User.id = Visite.user_id"]
            ]
        ]);
        $this->loadModel("Apartient");
        $this->loadModel("User");
        $users = $this->User->find("list");
        $chefs = $this->Apartient->find("list", array("fields" => array("Apartient.user1_id", "Apartient.user_id")));

        $data = [];
        foreach ($visites as $value) {
            $visit = $value['Visite'];
            $client = $value['Client'];
            $user = $value['User']['id'];
            $pot = $value['Client']["potentialite"];
            if (in_array($pot, array("A1", "B1")))
                $pot = "A1,B1";
            else if (in_array($pot, array("A2", "B2", "C1", "C2")))
                $pot = "A2,B2,C1,C2";
            else
                $pot = "A3,B3,C3";


            $distance = isset($client['longitude']) && isset($client['latitude'])
                ? $this->system_distance($visit['longitude'], $visit['latitude'], $client['longitude'], $client['latitude'])
                : -1;
            $datetime_visite = $visit['date'];
            if (explode(" ", $visit['date'])[1] == "00:00:00")
                $datetime_visite = $visit['created'];
            $date = explode(" ", $datetime_visite)[0];
            $heure = explode(" ", $datetime_visite)[1];

            if (!isset($data[$user][$date])) {
                $data[$user][$date] = [
                    'temp_passer' => 0,
                    'timer_nombre' => 0,
                    'total_visite' => 0,
                    'heure_debut' => $heure,
                    'heure_fin' => $heure,
                    'A1,B1' => 0,
                    'A2,B2,C1,C2' => 0,
                    'A3,B3,C3' => 0,
                    'gps' => [],
                    'data' => []
                ];
            }


            //timer
            $datatimer = explode(" ", $visit["timer"]);
            if ($client["activite"] == "Prive" && count($datatimer) == 2) {
                $timer = $datatimer[0];
                if ($datatimer[1] == "min") {
                    $timer = $timer * 60;
                } else if ($datatimer[1] == "heure") {
                    //max une heure pour ne pas faussé la data
                    $timer = 3600;
                }
                $data[$user][$date]["temp_passer"] += $timer;
                $data[$user][$date]["timer_nombre"]++;
            }

            $data[$user][$date]["gps"][] = $client['latitude'] . "," . $client['longitude'];
            $data[$user][$date]["heure_fin"] = $heure;
            $data[$user][$date][$pot]++;
            $visit["distance"] = $distance;
            $data[$user][$date]["total_visite"]++;
            $data[$user][$date]['data'][] = $visit;
        }
        //debug($data);exit();
        $result = [];
        foreach ($data as $user => $dates) {
            $stats = [
                'client_localiser' => 0,
                'visite_reel' => 0,
                'voloiseau' => 0,
                'total_visite' => 0,
                'moyenne_time' => 0,
                'A1,B1' => 0,
                'A2,B2,C1,C2' => 0,
                'A3,B3,C3' => 0,
                'nombre_jour_for_time' => 0,
                'heures_debut' => [],
                'heures_fin' => [],
                'gps' => []
            ];

            foreach ($dates as $date => $info) {
                // Calcul de `moyenne_time`
                if ($info['timer_nombre'] > 0) {
                    $timer = round($info['temp_passer'] / 60 / $info['timer_nombre'], 0);
                    $stats['moyenne_time'] += $timer;
                    $stats['nombre_jour_for_time']++;
                }
                $stats["heures_debut"][] = $info['heure_debut'];
                $stats["heures_fin"][] = $info['heure_fin'];
                $stats["gps"][] = $info['gps'];
                $stats["total_visite"] += $info['total_visite'];
                $stats["A1,B1"] += $info['A1,B1'];
                $stats["A2,B2,C1,C2"] += $info['A2,B2,C1,C2'];
                $stats["A3,B3,C3"] += $info['A3,B3,C3'];


                // Calcul des statistiques de localisation et visites réelles
                foreach ($info['data'] as $visit) {
                    if ($visit['distance'] > -1) {
                        $stats['client_localiser']++;
                        if ($visit['distance'] <= 0.8)
                            $stats['visite_reel']++;
                    }
                }
            }
            $chef = $users[$user];
            if (isset($users[$chefs[$user]]))
                $chef = $users[$chefs[$user]];
            // Calcul des résultats finaux
            $result[$user] = [
                'super' => $chef,
                'user' => $users[$user],
                'moyenne_time' => $stats['nombre_jour_for_time'] > 0 ? round($stats['moyenne_time'] / $stats['nombre_jour_for_time'], 0) : '0',
                'heure_debut' => $this->system_moyenne_heure($stats['heures_debut']),
                'heure_fin' => $this->system_moyenne_heure($stats['heures_fin']),
                'gps' => $this->system_filter_gps($stats['gps'], 10),
                'client_localiser' => $stats['client_localiser'],
                'total_visite' => $stats['total_visite'],
                'visite_reel' => $stats['visite_reel'],
                'A1,B1' => $stats['visite_reel'],
                'A2,B2,C1,C2' => $stats['A2,B2,C1,C2'],
                'A3,B3,C3' => $stats['A3,B3,C3'],
                'pourcentage' => $stats['client_localiser'] > 0 ? round(($stats['visite_reel'] / $stats['client_localiser']) * 100, 1) : 0
            ];
        }

        // Initialisation des données groupées par 'super'
        $grouped = [];
        foreach ($result as $id => $entry) {
            $super = $entry['super'];
            if (!isset($grouped[$super])) {
                $grouped[$super] = [
                    'moyenne_time' => [],
                    'client_localiser' => 0,
                    'total_visite' => 0,
                    'heures_debut' => [],
                    'heures_fin' => [],
                    'visite_reel' => 0,
                    'A1,B1' => 0,
                    'A2,B2,C1,C2' => 0,
                    'A3,B3,C3' => 0,
                    'gps' => []
                ];
            }

            $grouped[$super]['moyenne_time'][] = $entry['moyenne_time'];
            $grouped[$super]['client_localiser'] += $entry['client_localiser'];
            $grouped[$super]['total_visite'] += $entry['total_visite'];
            $grouped[$super]['heures_debut'][] = $entry['heure_debut'];
            $grouped[$super]['heures_fin'][] = $entry['heure_fin'];
            $grouped[$super]['visite_reel'] += $entry['visite_reel'];
            $grouped[$super]['gps'][] = $entry['gps'];
            $grouped[$super]["A1,B1"] += $entry['A1,B1'];
            $grouped[$super]["A2,B2,C1,C2"] += $entry['A2,B2,C1,C2'];
            $grouped[$super]["A3,B3,C3"] += $entry['A3,B3,C3'];
        }
        //debug($grouped);exit();
        // Calcul des moyennes
        $supers = [];
        foreach ($grouped as $super => $values) {
            $supers[$super] = [
                'moyenne_time' => round(array_sum($values['moyenne_time']) / count($values['moyenne_time']), 0),
                'client_localiser' => $values['client_localiser'],
                'total_visite' => $values['total_visite'],
                'A1,B1' => $entry['A1,B1'],
                'A2,B2,C1,C2' => $entry['A2,B2,C1,C2'],
                'A3,B3,C3' => $entry['A3,B3,C3'],
                'heures_debut' => $this->system_moyenne_heure($values['heures_debut']),
                'heures_fin' => $this->system_moyenne_heure($values['heures_fin']),
                'gps' => $this->system_filter_gps($values['gps']),
                'visite_reel' => $values['visite_reel'],
                'pourcentage' => $values['client_localiser'] > 0 ? round(($values['visite_reel'] / $values['client_localiser']) * 100, 1) : 0,
            ];
        }


        $this->set(compact("supers", "result"));
        $this->layout = '';
        //exit();
    }



    function system_cron_delete_visite_double_non_valider()
    {
        $this->loadModel('Apartient');

        $visites = $this->Visite->find('all', array(
            'conditions' => array(
                'Visite.type_visite' => 'double',
                'Visite.double_date_validation is null',
                'Visite.archive' => 1,
            )
        ));
       // debug($visites, 0, 0);exit();
        if (empty($visites))
            exit();

        // Construire le corps du mail
        $lignes = array();
        foreach ($visites as $visite) {

            $this->Visite->id=$visite['Visite']['id'];
            $this->Visite->saveField("type_visite","solo");
            $this->Visite->saveField("double_id",null);

            $apartient = $this->Apartient->find('first', array(
                'conditions' => array('Apartient.user1_id' => $visite['Visite']['user_id'])
            ));
            

            $chef = !empty($apartient['User']['name']) ? $apartient['User']['name'] : 'N/A';

            $lignes[] = sprintf(
                "- ID : %s | VMP : %s | Client [%s] : %s %s | Chef [%s] : %s | Date : %s | Commentaire : %s",
                $visite['Visite']['id'],
                $visite['User']['name'],
                $visite['Client']['id'],
                $visite['Client']['nom'],
                $visite['Client']['prenom'],
                $apartient['User']['id'],
                $chef,
                $visite['Visite']['date'],
                !empty($visite['Visite']['commentaire']) ? $visite['Visite']['commentaire'] : '(aucun)'
            );

        }

        $corps = "Bonjour,\n\nLes visites double suivantes n'ont pas été validées et seront annulées :\n\n";
        $corps .= implode("\n", $lignes);
        $corps .= "\n\nCordialement,\nASAF MK";

        // Envoi CakeEmail
        App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail('default'); // ou ton transport configuré dans email.php
        $email->to(array('godsneek@hotmail.com', 'a.daljamouni@esnapharm.com', 'admin@esnapharm.com', 'i.rami@valpharma.ma'
        , 'm.elfidaoui@esnaprom.ma', 'm.hraoui@esnaprom.ma'))
            ->from('admin@connectlabo.com')
            ->subject('Visites double non validées - ' . date('d/m/Y'))
            ->send($corps);

        exit();
        /*echo "Nombre de visites doubles non validées : " . count($visites) . "\n";
        //debug($visites,0,0);exit();
        foreach ($visites as $visite) {
            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $apartient = $this->Apartient->find('first', array(
                'conditions' => array(
                    'Apartient.user1_id' => $visite['Visite']['user_id']
                )
            ));
            //echo $visite['Visite']['user_id'] . "\n";
            //debug($apartient);
            $double_gps=$visite['Visite']['latitude'].",".$visite['Visite']['longitude'];
            $double_date=$visite['Visite']['created'];
            $double_id=$visite['Visite']['user_id'];
            if(count($apartient)>0)
            {
                $double_id=$apartient['Apartient']['user_id'];
            }
            $this->Visite->id=$visite['Visite']['id'];
            $this->Visite->saveField("longitude",$double_gps);
            $this->Visite->saveField("double_gps",$double_gps);
            $this->Visite->saveField("double_date_validation",$double_date);
            $this->Visite->saveField("double_id",$double_id);
        }*/
        exit();
    }




}
