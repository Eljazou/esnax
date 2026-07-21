<?php

App::uses('AppController', 'Controller');

class VisitemobileapisController extends AppController {

	function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('rapport_pharmacie',"rapport_medcin","message","system_get_ordre","stock_ordre","visiter","rapport_visite");
    }
    function rapport_pharmacie($client_id = 22350, $code = 358240051111110, $latitude = 30.379672, $longitude = -9.531260,$timer=0) {
		$this->layout="mobile";
        $this->loadModel("User");
        $timer=date("Y-m-d")." ".str_replace("-",":",$timer);
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('fields' => array('User.id'),
        'conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        } 
        $user_id = $user["User"]["id"]; //1;
        $d = date('Y-m-d');
        $this->loadModel('Visite');
        $deja = $this->Visite->find('count', array('conditions' => array('Visite.archive' =>'1', 'Visite.user_id' => $user_id, 'Visite.client_id' => $client_id, "DATE(Visite.date)" => $d)));
        if ($deja != 0) {
            $this->redirect(array('action' => 'message','Rapport déja envoyé','ok'));
            //$this->Session->setFlash("Rapport ajouté plusieurs fois, seul le premier qui est pris en considération ");
            //return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
        }
        $produits = "";
        $gammes = "";
        if ($this->request->is('post')) {
            // debug($this->request->data);exit();
            if (strlen($this->request->data["Visite"]['date']) < 3)
                $this->request->data["Visite"]['date'] = date('Y-m-d H:i:s');
            //ce petit code me permet de savoir si l'envoie du formulaire est envoyer deux fois probléme de con 
            //---------------Fin de code de visite multiple
            $this->Visite->create();

            //code pour pharmacie
            $this->Visite->Client->recursive = -1;
            $client_info = $this->Visite->Client->findById($this->request->data["Visite"]["client_id"]);
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
                    $this->redirect(array('action' => 'message','Rapport envoyé','ok'));
                    //$this->Session->setFlash(__('Rapport ajouté'));
                    //return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Visite']['client_id']));
                } else {
                    $this->redirect(array('action' => 'message','Erreur dans le rapport, merci de réessayer','error'));
                    //$this->Session->setFlash("Erreur dans le rapport, merci de réessayer");
                    //return $this->redirect();
                }
            }
        }
		$this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' =>  $user_id,
                'Stockgadjet.quantite>0')));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
        //-----------------------Fin---------------------
        $this->set(compact('latitude', "longitude", "user_id",'stock', "client_id","timer", "infosclient", "produits", "games", "produits_stock"));

        //ila kant la visite pour un pharmatie je doit envoyé la liste des clients li kainin hdah
        $clients = array();
        if ($infosclient[0]['clients']['type_id'] == "2") {
            $this->Client->recursive = -1;
            $vv = $this->Client->find("all", array('fields' => array('Client.id', 'Client.nom', 'Client.prenom'),
                'conditions' => array('Client.type_id' => 1, 'Client.secteur_id' => $infosclient[0]['clients']['secteur_id'])));
            foreach ($vv as $va) {
                $clients['Client'][$va['Client']['id']] = $va['Client']['nom'] . " " . $va['Client']['prenom'];
            }
            $this->set("clients", $clients);
        }
		
    }
	
    function rapport_medcin($client_id = 1474, $code = 358240051111110, $latitude = 30.379672, $longitude = -9.531260,$timer=0) 
	{
		$this->layout="mobile";
        $this->loadModel("User");
		$this->loadModel('Visite');
        $timer=date("Y-m-d")." ".str_replace("-",":",$timer);
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
        $user_id =$user["User"]["id"];
        $d=date("Y-m-d");
        
        $deja = $this->Visite->find('count', array('conditions' => array('Visite.archive' =>'1', 'Visite.user_id' => $user_id, 'Visite.client_id' => $client_id, "DATE(Visite.date)" => $d)));
        if ($deja != 0) {
            $this->redirect(array('action' => 'message','Rapport déja envoyé','ok'));
        }
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
                        $stock = $this->Stockgadjet->find('first', array('conditions' => array('Stockgadjet.user_id' => $user_id,
                                'Stockgadjet.echantillon_id' => $value['echantillon_id'])));
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
            if ($this->Visite->save($this->request->data)) 
			{
                $visite_id=$this->Visite->id;
                $this->stock_ordre($this->request->data["Visite"]["order"],$visite_id);
                $this->redirect(array('action' => 'message','Rapport envoyé','ok'));
            } else {
                $this->redirect(array('action' => 'message','Erreur dans le rapport, merci de réessayer','error'));
            }
        }
        
        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' => $user_id,
                'Stockgadjet.quantite>0')));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
		
		$this->Visite->Client->recursive=-1;
		$client=$this->Visite->Client->findById($client_id);
		$ordres=$this->system_get_ordre($user["User"]["ligne_id"],$client["Client"]["category_id"]);
        //-----------------------Fin---------------------
        $this->set(compact('latitude', "longitude", "user_id",'stock', "client_id","timer", "infosclient", "produits", "games", "produits_stock","ordres"));

       
    }

    function rapport_visite($client_id = 1474, $code = 358240051111110, $latitude = 30.379672, $longitude = -9.531260,$timer=0){
        $this->layout="mobile";
        $this->loadModel("User");
        $this->loadModel('Visite');
        $timer=date("Y-m-d")." ".str_replace("-",":",$timer);
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo [];
            exit();
        }
        $user_id =$user["User"]["id"];
        $d=date("Y-m-d");
        
        $deja = $this->Visite->find('count', array('conditions' => array('Visite.archive' =>'1', 'Visite.user_id' => $user_id, 'Visite.client_id' => $client_id, "DATE(Visite.date)" => $d)));
        if ($deja != 0) {
            // $this->redirect(array('action' => 'message','Rapport déja envoyé','ok'));
        }
        $produits = "";
        $gammes = "";
        if ($this->request->is('post')) {
            $ids=rtrim($this->request->data["Visite"]["order"],",");
            $ids=explode(",",$ids);
            debug($this->request->data);
            foreach($ids as $k=>$v)
            {
                $d=array();
                $d["Visiteordre"]["brochure_id"]=$v;
                $d["Visiteordre"]["visite_id"]=5;
                debug($d);
            }
            exit();
            $echentient = '';
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            if (isset($this->request->data['Stockgadjet'])) {
                foreach ($this->request->data['Stockgadjet'] as $value) {
                    if ($value['quantite'] != 0 && $value['quantite'] != null && $value['echantillon_id'] != null && $value['echantillon_id'] != "") {
                        $stock = $this->Stockgadjet->find('first', array('conditions' => array('Stockgadjet.user_id' => $user_id,
                                'Stockgadjet.echantillon_id' => $value['echantillon_id'])));
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
            if (is_array($this->request->data['Visite']['concurrence_p']))
                $this->request->data['Visite']['concurrence_p'] = "";

            //debug($objections);
            //debug($this->request->data['Visite']['produits']);
            //******
            if ($this->Visite->save($this->request->data)) 
            {
                $visite_id=$this->Visite->id;
                $this->stock_ordre($this->request->data["Visite"]["order"],$visite_id);
                $this->redirect(array('action' => 'message','Rapport envoyé','ok'));
            } else {
                $this->redirect(array('action' => 'message','Erreur dans le rapport, merci de réessayer','error'));
            }
        }
        
        $this->loadModel('Stockgadjet');
        $stock = $this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' => $user_id,
                'Stockgadjet.quantite>0')));
        $this->loadModel('Client');
        $infosclient = $this->Client->query("select type_id,sexe,secteur_id from clients where id=" . $client_id);
        $this->loadModel('Produit');
        $produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));

        $this->loadModel('Game');
        $games = $this->Game->find('list', array('conditions' => array('Game.archive' => 1)));
        //---------------------had l code pour stockvisite----------------------//30/04/2021
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
        
        $this->Visite->Client->recursive=-1;
        $client=$this->Visite->Client->findById($client_id);
        $ordres=$this->system_get_ordre($user["User"]["ligne_id"],$client["Client"]["category_id"]);
        //-----------------------Fin---------------------
        $this->set(compact('latitude', "longitude", "user_id",'stock', "client_id","timer", "infosclient", "produits", "games", "produits_stock","ordres"));

    }

    //hada dial ordre de produit a afficher
	function system_get_ordre($ligne_id,$category_id)
	{
		
		$this->loadModel("Brochure");
        $data=$this->Brochure->Brochureorganise->find("all",array("conditions"=>array("Brochureorganise.ligne_id"=>$ligne_id,"Brochureorganise.category_id"=>$category_id),"order"=>array("Brochureorganise.ordre"=>"ASC")));
		return $data;
	}
	
	
	function stock_ordre($ids,$visite_id)
	{
		$this->loadModel("Visiteordre");
        if($ids!=""){
            $ids=rtrim($ids,",");
            $ids=explode(",",$ids);
            foreach($ids as $k=>$v)
            {
                $this->Visiteordre->create();
                $d=array();
                $d["Visiteordre"]["brochure_id"]=$v;
                $d["Visiteordre"]["visite_id"]=$visite_id;
                $this->Visiteordre->save($d);
            }
        }
		return "";
		
	}
    function message($ms,$etat) {
        $this->layout="mobile";
        $message=$ms;
        $etat=$etat;
        $this->set(compact("message","etat"));
    }
    function visiter($client_id = 22350, $code = 358240051111110) {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('fields' => array('User.id'),
        'conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        } 
        $user_id = $user["User"]["id"];
        $d = date('Y-m-d');
        $this->loadModel('Visite');
        $deja = $this->Visite->find('count', array('conditions' => array('Visite.archive' =>'1', 'Visite.user_id' => $user_id, 'Visite.client_id' => $client_id, "DATE(Visite.date)" => $d)));
        if ($deja != 0)
            echo 1;
        else
            echo 0;
        exit();
    }
}
