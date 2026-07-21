<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'listes');

class Apimobilev1Controller extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        header("Access-Control-Allow-Origin: *");
        $this->Auth->allow();
    }

    function logout($token) {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->findByIemi($token);
        if (!empty($user)) {
            $this->User->id = $user["User"]["id"];
            $this->User->saveField("iemi", "");
            echo true;
        }
        $this->Auth->logout();
        exit();
    }

    function login_android() {
        ///echo "[0]";exit();
        if ($this->Auth->login()) {
            if (AuthComponent::user('archive') == 1) {
                $this->loadModel("User");
                $this->User->id = AuthComponent::user('id');
                $token = AuthComponent::user('id') . rand(111111, 99999999);
                $this->User->saveField("iemi", $token);
                if(isset($this->request->data["User"]["version"]))
                    $this->User->saveField("version",$this->request->data["User"]["version"]);
                echo $token . "||||" . AuthComponent::user('name');
                $this->Auth->logout();
            } else {
                $this->Auth->logout();
                echo '0';
            }
        } else
            echo '0';
        exit();
    }

    //r'envoie le nom du perssone c'est elle qui fais le controle du compte si il est blocker ou pas 
    function getuser($code = null,$v=null) {
        if ($code != null) {
            preg_match_all('!\d+!', $code, $cod);
            $user_id = $cod[0][0]; ///20121204;
            $this->loadModel('User');
            $this->User->recursive = -1;
            $user = $this->User->find('first', array(
                'conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
            if (!empty($user)) {
                $this->User->id=$user["User"]["id"];
                $this->User->saveField("version",$v);
                echo $user["User"]["name"];
                exit();
            }
        }
        echo '0';
        exit();
    }

    
   
    
    //function qui envoie feulle de route si il existe
    function feuille_route($code = null) 
	{
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
        $code = $user["User"]["id"];
        $username = $user["User"]["username"];
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

        if (empty($listes)) {
            echo json_encode(array());
            exit();
        }
        $ids = 0;
        foreach ($listes as $value) {
            if(!empty($value['Feuilleroute']['client_id']))
                $ids = $ids . ',' . $value['Feuilleroute']['client_id'];
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
		$secteurss=$this->Secteur->find("all");
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $types = $this->Type->find('list');
        $categories = $this->Category->find('list');
        $data = array();
        $action = array();
        $visites = array();
        $listess = new ListesController;
		$this->Visite->recursive = -1;
		$vv = $this->Visite->find('all', array('conditions' => array("Visite.client_id in($ids)"," Visite.date between 
                   DATE_ADD(CURRENT_DATE(), INTERVAL -90 DAY) and DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY)",'Visite.archive' => 1), 'order' => array('Visite.date desc')));
		$visitekaina=array();
		foreach($vv as $vs)
		{
			$date_visite = date('Y-m-d', strtotime($vs["Visite"]["date"]));
			if(($date_visite>=$date_debut) && ($date_visite<=$date_fin) && $vs["Visite"]["user_id"]==$code)
			{
				$visitekaina[$vs["Visite"]["client_id"]]=1;
			}
		}
				
		$debutdat=date("Y-01-01");
		$nb_visites = $this->Visite->query("SELECT client_id, COUNT(client_id) as count
											FROM visites WHERE client_id in($ids) and archive=1 and date >='$debutdat'
											GROUP BY client_id");
		$nb_visite=array();
		foreach($nb_visites as $v)
		{
			$nb_visite[$v["visites"]["client_id"]]=$v[0]["count"];
		}
		$actionss = $this->Action->find('all', array('conditions' => array('Action.archive' => 2, "Action.client_id in($ids)" , "Action.date_debut<='$date_debut'", "Action.date_fin>='$date_fin'")));
		$actions=array();
		foreach($actionss as $ac)
		{
			$actions[$ac["Action"]["client_id"]]=$ac;
		}
		$users=$this->User->find("list");
		//echo date("m:s")."<br>";
        for ($i = 0; $i < count($clients); $i++) {
            //if($i==4){debug($clients[$i]);exit();}
			
            if (!isset($visitekaina[$clients[$i]['Client']['id']])) {
                
                $clients[$i]['Client']['visite'] = 0;
                $clients[$i]['Client']['categoryy_id'] = $clients[$i]['Client']['categoryy1_id'] = null;
                if ($clients[$i]['Client']['category1_id'] == null)
                    $clients[$i]['Client']['category1_id'] = $clients[$i]['Client']['category_id'];
				$clients[$i]['Client']['categoryy_id'] = $categories[$clients[$i]['Client']['category_id']];
				$clients[$i]['Client']['categoryy1_id'] = $categories[$clients[$i]['Client']['category1_id']];
				
				//probléme dans app mobile ila kan medcin c bon si non ndiroh pharmacie 
                if($clients[$i]['Client']['type_id']==2)
					$clients[$i]['Client']['typee_id'] ="Pharmacie";
				else
					$clients[$i]['Client']['typee_id'] ="Médecin";
                        
                
				foreach($secteurss as $s)
				{
					if($clients[$i]['Client']['secteur_id']==$s["Secteur"]["id"])
					{
						$secteur=$s;
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
                $data[$i]['username'] = $username;
                
                if(isset($nb_visite[$clients[$i]['Client']['id']]))
					$data[$i]['visite'] = $nb_visite[$clients[$i]['Client']['id']];
				else
					$data[$i]['visite']=0;
				//----------------------------KAMIL-----------------//
				/*if(isset($stockkamils[$clients[$i]['Client']['id']]))
				{
					$data[$i]['kamil'] = $stockkamils[$clients[$i]['Client']['id']];
				}*/
				//------------------------------Fin KAMIL--------------//
				
                if(isset($actions[$clients[$i]['Client']['id']]))
				{
					$action=$actions[$clients[$i]['Client']['id']];
					$clients[$i]['Client']['action'] = $action;
					$now = time();
                    $your_date = strtotime($action['Action']['date_fin']);
                    $datediff = $your_date - $now;
                    $j = floor($datediff / (60 * 60 * 24));
                    $data[$i]['Action']['reste'] = $j;
                    $now = strtotime($action['Action']['date_debut']);
                    $your_date = strtotime($action['Action']['date_fin']);
                    $datediff = $your_date - $now;
                    $j = floor($datediff / (60 * 60 * 24));
                    $data[$i]['Action']['client_id'] = $clients[$i]['Client']['id'];
                    $data[$i]['Action']['duree'] = $j;
                    $data[$i]['Action']['nom'] = $action['Action']['name'];
                    $data[$i]['Action']['description'] = $action['Action']['description'];
                    $data[$i]['Action']['game'] = $action['Game']['name'];
                    $data[$i]['Action']['respensable'] = $action['User']['name'];
				}
				else
					$clients[$i]['Client']['action'] =array();

                if (count($action) != 0) {
                    
                }
                
                $j = 0;
                foreach ($vv as $va) 
				{
					if($va['Visite']['client_id']==$clients[$i]['Client']['id'])
					{
						$data[$i]['Visite'][$j]['date'] = $va['Visite']['date'];
						$data[$i]['Visite'][$j]['commentaire'] = $va['Visite']['commentaire'];
						$data[$i]['Visite'][$j]['responsable'] = $users[$va['Visite']['user_id']];
						$j++;
					}
                }
            }
        }
		//echo date("m:s")."<br>";exit();
        //debug($data);exit();

        $data = array_values($data);
        $data = $this->utf8ize($data);
        //debug($data,0,0);

        if (count($data) == 1) {
            echo "[";
            foreach ($data as $d)
                echo str_replace("\\u00e9", "e", json_encode($d, JSON_UNESCAPED_UNICODE));
            echo "]";
        } else
            echo str_replace("\\u00e9", "e", json_encode($data, JSON_UNESCAPED_UNICODE));
        exit();
    }

    public function utf8ize($mixed) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
        }
        return $mixed;
    }

    function send_brochure($code = null) {
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
                $data = array();
                foreach ($brochures as $b) {
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
                echo json_encode($data);
                exit();
            }
        }
        echo '[]';
        exit();
    }

    function send_formation() {
        $this->loadModel('Formation');
        $this->Formation->recursive = -1;
        $this->loadModel('Game');
        $this->Game->recursive = -1;
        $brochure = $this->Formation->find('all', array('conditions' => array('Formation.archive' => 1)));
        $game = $this->Game->find('list');
        $i = 0;
        foreach ($brochure as $b) {
            foreach ($game as $g => $gname) {
                if ($b['Formation']['game_id'] == $g)
                    $brochure[$i]['Formation']['gamme'] = $gname;
            }
            $i++;
        }
        echo json_encode($brochure);
        exit();
    }

    function send_gammes() {
        $this->loadModel('Game');
        $this->Game->recursive = -1;
        $brochure = $this->Game->find('all', array('conditions' => array('Game.archive' => 1)));
        echo json_encode($brochure);
        exit();
    }

    function send_type($android = null) {
        $this->loadModel('Type');
        $data = $this->Type->find('list');
        if ($android == null)
            echo json_encode($data);
        else
            echo "[" . json_encode($data) . ']';
        exit();
    }

    function send_secteur() {
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $regions = $this->Secteur->find('all');
        echo json_encode($regions);
        exit();
        $regions = $this->Secteur->find('all', array('group' => 'region'));
        $data = array();
        foreach ($regions as $value) {
            $villes = $this->Secteur->find('all', array('conditions' => array('Secteur.code_region' => $value["Secteur"]["code_region"]),
                'group' => array('Secteur.ville')));
            foreach ($villes as $ville) {
                $secteurs = $this->Secteur->find('all', array('fields' => array('Secteur.id', 'Secteur.secteur'), 'conditions' => array('Secteur.code_ville' => $ville["Secteur"]['code_ville'])));
                $i = 0;
                foreach ($secteurs as $secteur) {
                    $data[$value["Secteur"]["region"]][$ville["Secteur"]['ville']][$i] = $secteur['Secteur'];
                    $i++;
                }
            }
        }
        echo json_encode($data);
        exit();
    }

    function send_categories($android = null) {
        $this->loadModel('Category');
        $data = $this->Category->find('list');
        if ($android == null)
            echo json_encode($data);
        else
            echo "[" . json_encode($data) . "]";
        exit();
    }

    function send_produits() {
        $this->loadModel('Produit');
        $this->Produit->recursive = -1;
        $brochure = $this->Produit->find('all', array('conditions' => array('Produit.archive' => 1)));
        echo str_replace("\\u00e9", "e", json_encode($brochure));
        exit();
    }

    function send_echantillons() {
        $this->loadModel('Echantillon');
        $this->Echantillon->recursive = -1;
        $brochure = $this->Echantillon->find('all', array('conditions' => array('Echantillon.archive' => 1)));
        echo json_encode($brochure);
        exit();
    }

    function send_stock($code = null) {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
        $code = $user["User"]["id"];
        $this->loadModel('Stockgadjet');
        $this->Stockgadjet->recursive = 1;
        $stock = $this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' => $code,
                'Stockgadjet.quantite>0')));
        $data = array();
        foreach ($stock as $s) {
            $temp["id"] = $s["Stockgadjet"]["id"];
            $temp["echantillon"] = $s["Echantillon"]["name"];
            $temp["quantite"] = $s["Stockgadjet"]["quantite"];
            $data[] = $temp;
        }
        echo json_encode($data);
        exit();
    }


    function sync_visites() {
        // if(date("Hi")>800 && date("Hi")<2000)
        // 	exit();
        $this->loadModel('Visite');
        $this->loadModel('Client');
        $this->loadModel('Stockgadjet');
        $this->Stockgadjet->recursive = -1;
        $value = json_decode($this->request->data, true);
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('fields' => array('User.id'),
            'conditions' => array('User.archive' => 1, 'User.iemi' => $value['Visite']['user_id'])));
        $value['Visite']['user_id'] = $user["User"]["id"];
        //foreach ($this->request->data as $value) 
        //{
        $this->Visite->create();
        $this->Client->id = $value['Visite']['client_id'];
        if ($value['Visite']['type_visite'] == "NON CLIENT" || $value['Visite']['type_visite'] == "CLIENT")
            $this->Client->saveField("potentialite", $value['Visite']['type_visite']);
        $type_client = $value['Visite']['type_visite'];
        $presentoir = "";
        if (isset($value['Visite']['objection'])) {
            $presentoirs = explode("|", $value['Visite']['objection']);

            if (count($presentoirs) > 2)
                $presentoir = $presentoirs[2];
        }
        $this->Client->saveField("dirigent", $presentoir);
        /* if(strlen($value['Visite']['echantillons']) >2)
          {
          $v=explode('||',$value['Visite']['echantillons']);
          foreach ($v as $stock)
          {
          $stock=  explode("-", $stock);
          if($stock[1]!= 0 && $stock[1]!= null)
          {
          $stockk=$this->Stockgadjet->find('first', array('conditions' =>array('Stockgadjet.user_id'=>$value['Visite']['user_id'],
          'Stockgadjet.echantillon_id'=>$stock[0])));
          $this->Stockgadjet->id=$stockk['Stockgadjet']['id'];
          $this->Stockgadjet->saveField('quantite',$stockk['Stockgadjet']['quantite']-$stock[1]);
          }
          }
          } */
        $this->Visite->save($value);
        //--------------------Systeme dial stock produit 3and les pharmacies-----------//
        if (isset($value["Stockvisite"])) {
            $this->loadModel("Stockvisite");
            foreach ($value["Stockvisite"] as $stock) {
                if ($stock["quantite"] == "")
                    continue;
                $stock["visite_id"] = $this->Visite->id;
                $stock["client_id"] = $value['Visite']['client_id'];
                $stock["user_id"] = $user["User"]["id"];
                $stockvisite = array();
                $stockvisite["Stockvisite"] = $stock;
                $this->Stockvisite->create();
                $this->Stockvisite->save($stockvisite);
            }
        }

        //-----------------------------Fin Systeme de stock produits-------------------//
        //}
        //debug($this->request->data["Stockvisite"]);
        echo true;
        exit();
    }

   
    function send_stat($code = null) {
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
        $data["Médecin"]["nb_visiter"]=0;
        $data["Médecin"]["objectif"]=0;
        $data["Médecin"]["objectifjour"]=0;
        $data["Médecin"]["jour"]=0;
        $data["Médecin"]["globaljour"]=0;
        $data["Pharmacie"]["nb_visiter"]=0;
        $data["Pharmacie"]["objectif"]=0;
        $data["Pharmacie"]["objectifjour"]=0;
        $data["Pharmacie"]["jour"]=0;
        $data["Pharmacie"]["globaljour"]=0;
        foreach ($listes as $listee) {
            if ($listee['date']['date_fin'] > date('Y-m-d') && $listee['date']['date_debut'] <= date('Y-m-d')) {
                $progressinfo1 = $this->requestAction('/listes/system_get_progress_info_affectedandnoaffected/' . $listee['Liste']['id'] . "/" . $user['User']['id'] . "/" . $date_debut . "/" . $date_fin);
                $objectifs = $this->requestAction('/objectifs/system_get_objectif_by_date/' . $user['User']['id'] . "/" . $listee['date']['date_debut']);

                foreach ($progressinfo1 as $ob) {
                    foreach ($objectifs as $obj) {
                        if ($ob["type"]["type"] == $obj["Type"]["name"]) {
                            $jour = $this->Visite->find("count", array("conditions" => array('Visite.archive' =>'1',"Visite.user_id" => $user['User']['id'],
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

        echo json_encode($data);
        exit();
    }

    function get_pharmacies_proches($code = null, $latitude = null, $longitude = null) {
        $this->loadModel('User');
        $this->User->recursive = -1;
        if ($latitude == null) {
            echo "[]";
            exit();
        }
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1,'User.iemi' => $code)));
          if (empty($user))
          {
          echo "[]";
          exit();
          }

        $this->loadModel('Action');
        $this->loadModel('Visite');
		$this->loadModel('Category');
        $this->loadModel('Secteur');
		$this->Secteur->recursive=-1;
        $this->loadModel('Stockvisite');
		$categories = $this->Category->find('list');
        $datnow = date("Y-m-d");
		$visites=array();
        //$visites = $this->Visite->find("list", array("fields" => array("id", "client_id"), "conditions" => array("Visite.date 
		//			  	BETWEEN DATE_ADD('$datnow', INTERVAL -1 MONTH) AND DATE_ADD('$datnow', INTERVAL 1 MONTH)")));
        $ids = "0";
        foreach ($visites as $k => $v)
            $ids = "$ids,$v";
			
		$clients = $this->Action->query("SELECT *
					  , ( 6371  * acos( cos( radians($latitude) ) * cos( radians( Client.latitude ) ) * cos( radians( Client.longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(Client.latitude)) ) ) AS distance 
					FROM 
					  clients as Client
					  where Client.type_id=2 and Client.archive=1 
					  AND Client.id NOT IN ($ids)
					HAVING 
					  distance < 1
					  order by distance asc limit 30");
		//debug($clients);exit();
					  
			
		$stockkamils=$this->stock_kamil($user["User"]["iemi"]);
		$clientskamil=array();
		
		if(!empty($stockkamils))
		{
			$idk=0;
			foreach($stockkamils as $idclient =>$stock)
				$idk = "$idk,$idclient";
			$clientskamil=$this->Action->query("SELECT *
					  , ( 6371  * acos( cos( radians($latitude) ) * cos( radians( Client.latitude ) ) * cos( radians( Client.longitude ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(Client.latitude)) ) ) AS distance 
					FROM 
					  clients as Client
					  where Client.type_id=2 and Client.archive=1 
					  AND Client.id NOT IN ($idk)
					HAVING 
					  distance < 10
					  order by distance asc limit 10");
			foreach($clientskamil as $c)
			{
				$clients[]=$c;
			}
		}
		
        $data = array();
        $action = array();
        $visites = array();
        for ($i = 0; $i < count($clients); $i++) 
		{
			//---------------------------------Stock Kamil------------------//
			$stock=$this->Stockvisite->find("first",array("conditions"=>array("Stockvisite.client_id"=>$clients[$i]['Client']['id']),"order"=>array("Stockvisite.created desc")));
			$stockkamil=array();
			if(!empty($stock))
			{
				$stockkamil["user"]=$stock["User"]["name"];
				$stockkamil["produit"]=$stock["Produit"]["name"];
				$stockkamil["stock"]=$stock["Stockvisite"]["quantite"];
				$stockkamil["date"]=explode(" ",$stock["Stockvisite"]["created"]);
				$stockkamil["date"]=$stockkamil["date"][0];
				$stockkamil["type"]=$stock["Stockvisite"]["type"];
			}
			//---------------------------------Fin stock Kamil------------------//
			$secteur = $this->Secteur->findById($clients[$i]['Client']['secteur_id']);
			
            $clients[$i]['Client']['visite'] = 0;
            $clients[$i]['Client']['categoryy_id'] = $clients[$i]['Client']['categoryy1_id'] = null;
            if ($clients[$i]['Client']['category1_id'] == null)
                $clients[$i]['Client']['category1_id'] = $clients[$i]['Client']['category_id'];
            $clients[$i]['Client']['categoryy_id'] = $categories[$clients[$i]['Client']['category_id']];
            $clients[$i]['Client']['categoryy1_id'] = $categories[$clients[$i]['Client']['category1_id']];
            $clients[$i]['Client']['typee_id'] = "Pharmacie";
            $data[$i]['id'] = $clients[$i]['Client']['id'];
            $data[$i]['name'] = $clients[$i]['Client']['nom'] . ' ' . $clients[$i]['Client']['prenom'];
            $data[$i]['type'] = $clients[$i]['Client']['typee_id'];
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
            //$data[$i]['username'] = $username;
            $nb_visite = $this->Visite->find('count', array('conditions' => array('Visite.archive' => 1, 'Visite.client_id' => $clients[$i]['Client']['id'], 'Visite.date >="' . $clients[$i]['Client']['date_recrutement'] . '"')));
            $data[$i]['visite'] = $nb_visite;
            $date = date("Y-m-d");
            $action = $this->Action->find('first', array('conditions' => array('Action.archive' => 2, 'Action.client_id' => $clients[$i]['Client']['id'], "Action.date_debut<='$date'", "Action.date_fin>='$date'")));
            if (count($action) != 0)
                $data[$i]['Action']['client_id'] = "Oui";
            else
                $data[$i]['Action']['client_id'] = "Non";
            $this->Visite->recursive = 0;
            $vv = $this->Visite->find('all', array('conditions' => array('Visite.client_id' => $clients[$i]['Client']['id'],
                    'Visite.archive' => 1), 'order' => array('Visite.date desc limit 3')));
            $j = 0;
            foreach ($vv as $va) {
                $data[$i]['Visite'][$j]['date'] = $va['Visite']['date'];
                $data[$i]['Visite'][$j]['commentaire'] = $va['Visite']['commentaire'];
                $data[$i]['Visite'][$j]['responsable'] = $va['User']['name'];
                $j++;
            }
			
			//----------------------------KAMIL-----------------//
				if(isset($stockkamils[$clients[$i]['Client']['id']]))
				{
					$data[$i]['kamil'] = $stockkamils[$clients[$i]['Client']['id']];
				}
				//------------------------------Fin KAMIL--------------//
				
        }

        $data = array_values($data);
        $data = $this->utf8ize($data);
        //debug($data,0,0);

        if (count($data) == 1) {
            echo "[";
            foreach ($data as $d)
                echo str_replace("\\u00e9", "e", json_encode($d, JSON_UNESCAPED_UNICODE));
            echo "]";
        } else
            echo str_replace("\\u00e9", "e", json_encode($data, JSON_UNESCAPED_UNICODE));
        exit();
    }

    function sync_version($v) {
        $ver = "7";
        if ($ver > $v) {
            echo 1;
            exit();
        }
        exit();
    }

    function get_produit_viste() {
        $this->loadModel("Produit");
        $produits_stock = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1, 'Produit.stock' => 1)));
        echo json_encode($produits_stock, JSON_UNESCAPED_UNICODE);
        exit();
    }
	
	
	function send_stockvisite($code = null,$produit_id) {
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' => $code)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
		$this->loadModel('Stockvisite');
		$stockvisites = $this->Stockvisite->find('all', array("fields"=>array("User.*","Produit.*","Client.*","Stockvisite.*","MAX(Stockvisite.id)")
            ,"group"=>array("Stockvisite.client_id"),"conditions"=>array("Stockvisite.produit_id"=>$produit_id)));
		$i=0;
		foreach ($stockvisites as $stockvisite)
		{
			$etat="";
			$days = (time() - strtotime($stockvisite['Stockvisite']['created'])) / (60 * 60 * 24);
            $stockvisites[$i]['Stockvisite']['day']=round($days,0);
			$span="";
			if($stockvisite['Stockvisite']['quantite']<4)$span="ff0000";
			else if($days<15)$span="5fdb18";
			else if($days<30)$span="f4e53a";
			else if($days>30)$span="f9a801";
			$stockvisites[$i]['Stockvisite']['etat']=$span;
			$i++;
		}
		echo json_encode($stockvisites);
        exit();
	}
    //hadi juste pour le test il faut suprimer une fois nhtouha f apimobile
	function sync_explication($user_id)
	{
        $this->loadModel('User');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' =>$user_id)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
		$this->loadModel("Ligne");
		$data=$this->Ligne->Lignespecialiteinfo->findAllByLigneId($user["User"]["ligne_id"]);
        echo json_encode($data);
        exit();
	}
	
    function addboiteidee($user_id)
	{
        $this->loadModel('User');
        $this->loadModel('Boiteidee');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' =>$user_id)));
        if (empty($user)) {
            echo "[]";
            exit();
        }
		$value = json_decode($this->request->data, true);
        $value["Boiteidee"]["user_id"]=$user["User"]["id"];
		if ($this->Boiteidee->save($value))
            echo 1;
        else
            echo 0;
        exit();
	}
	
	
	
	function stock_kamil($code)
	{
		$this->loadModel('User');
        $this->loadModel('Stockvisite');
        $this->User->recursive = -1;
        $user = $this->User->find('first', array('conditions' => array('User.archive' => 1, 'User.iemi' =>$code,"ligne_id"=>5)));
		
        if (empty($user)) {
            return array();
        }
		$this->loadModel('Stockvisite');
		$stocks=$this->Stockvisite->find("all",array("conditions"=>array("Stockvisite.produit_id in(120,121,122)"),"order"=>array("Stockvisite.created desc")));
		
		$stockkamils=array();
		$stockkamil=array();
		foreach($stocks as $stock)
		{
			$stockkamil=array();
			$stockkamil["user"]=$stock["User"]["name"];
			$stockkamil["produit"]=$stock["Produit"]["name"];
			$stockkamil["stock"]=$stock["Stockvisite"]["quantite"];
			$stockkamil["date"]=explode(" ",$stock["Stockvisite"]["created"]);
			$stockkamil["date"]=$stockkamil["date"][0];
			$stockkamil["type"]=$stock["Stockvisite"]["type"];
			$stockkamils[$stock["Client"]["id"]][]=$stockkamil;
		}
		return $stockkamils;
	}
}
