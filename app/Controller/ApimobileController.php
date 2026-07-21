<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'listes');

class ApimobileController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        header("Access-Control-Allow-Origin: *");
        $this->Auth->allow();
    }
	
	function login_android() {
		///echo "[0]";exit();
        if ($this->Auth->login()) {
            if (AuthComponent::user('archive') == 1) {
                echo '[{"id" : "'.$this->Auth->user('id') . '" , "name" :"' . AuthComponent::user('name').'", "usernmae" :"' . AuthComponent::user('username').'"}]';
            } else {
                $this->Auth->logout();
                echo '[{"id" : "0" , "name" :"0"}]';
            }
        } else
            echo '[{"id" : "0" , "name" :"0"}]';
        exit();
    }
	
	
    function login() {
		///echo "[0]";exit();
        if ($this->Auth->login()) {
            if (AuthComponent::user('archive') == 1) {
                echo $this->Auth->user('id') . '|||' . AuthComponent::user('name');
            } else {
                $this->Auth->logout();
                echo '0';
            }
        } else
            echo '0';
        exit();
    }

    //r'envoie le nom du perssone c'est elle qui fais le controle du compte si il est blocker ou pas 
    function getuser($code = null,$android=null) {

        if ($code != null) {
            preg_match_all('!\d+!', $code, $cod);
            $user_id = $cod[0][0]; ///20121204;
            $this->loadModel('User');
            $this->User->recursive = -1;
            $user = $this->User->find('first', array('fields' => array('User.name', 'User.id'),
                'conditions' => array('User.archive' => 1, 'User.id' => $user_id)));
            if (!empty($user)) {
				if($android!=null)
					echo '[{"id" : "1" , "name" :"1"}]';
				else
					echo 'true';
                exit();
            }
        }
		if($android!=null)
			echo '[{"id" : "0" , "name" :"0"}]';
		else
			echo 'false';
        exit();
    }

    //Return pour ma liste
    function getliste($code = null, $feuiile = null) {
        $this->loadModel('Liste');
        $time = strtotime("1 January " . date("Y"), time());
        $day = date('w', $time);
        $time += ((7 * date("W", strtotime(date('Y-m-d')))) + 1 - $day) * 24 * 3600;
        $date_debut = date('Y-n-j', $time);
        $date_fin = date('Y-m-d', strtotime($date_debut . " +7 day "));
        $listes = $this->Liste->find('list', array('conditions' => array('Liste.user_id' => $code)));
        $liste_ids = '0';
        foreach ($listes as $key => $value)
            $liste_ids = $liste_ids . ",$key";

        $plans = $this->Liste->query("select * from plantournes as Plantourne where "
                . "date >='$date_debut' and date <'$date_fin' and  liste_id in($liste_ids)");
        if (empty($plans)) {
            $liste = array();
            if ($feuiile != null)
                return $liste;
            else {
                echo json_encode($liste);
                exit();
            }
        }
        $id = $plans[0]['Plantourne']['liste_id'];
        $options = array('conditions' => array('Liste.' . $this->Liste->primaryKey => $id));
        $liste = $this->Liste->find('first', $options);
        $ids = 0;
        foreach ($liste['Affectation'] as $value) {
            $ids = $ids . ',' . $value['client_id'];
        }
        $clients = $this->Liste->query("select secteur_id,category_id,category1_id,type_id,id,nom,prenom,potentialite from clients as Client where Client.id in($ids)");
        $this->loadModel('Action');
        $this->Action->recursive = -1;
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $types = $this->Type->find('all', array('condtions' => array('Type.archive' => '1')));
        $categories = $this->Category->find('all', array('condtions' => array('Category.archive' => '1')));
        $secteurs = $this->Secteur->find('all');
        $data = array();
        $listess = new ListesController;
        for ($i = 0; $i < count($clients); $i++) {
            $action = $this->Action->find('count', array('conditions' => array('Action.archive' => 2, 'Action.client_id' => $clients[$i]['Client']['id']
                    , "Action.date_debut<='$date_debut'", "Action.date_fin>='$date_fin'")));
            $clients[$i]['Client']['action'] = $action;
            $clients[$i]['Client']['visite'] = 0;
            if ($clients[$i]['Client']['category1_id'] != null)
                $clients[$i]['Client']['category_id'] = $clients[$i]['Client']['category1_id'];
            foreach ($categories as $value) {
                if ($value['Category']['id'] == $clients[$i]['Client']['category_id']) {
                    $clients[$i]['Client']['category_id'] = $value['Category']['name'];
                    break;
                }
            }
            foreach ($types as $value) {
                if ($value['Type']['id'] == $clients[$i]['Client']['type_id']) {
                    $clients[$i]['Client']['type_id'] = $value['Type']['name'];
                    break;
                }
            }
            foreach ($secteurs as $value) {
                if ($value['Secteur']['id'] == $clients[$i]['Client']['secteur_id']) {
                    $clients[$i]['Client']['secteur'] = $value['Secteur']['secteur'];
                    break;
                }
            }
            $data[$i]['code'] = $clients[$i]['Client']['id'];
            $data[$i]['name'] = $clients[$i]['Client']['nom'] . ' ' . $clients[$i]['Client']['prenom'];
            $data[$i]['type'] = $clients[$i]['Client']['type_id'];
            $data[$i]['category'] = $clients[$i]['Client']['category_id'];
            $data[$i]['secteur'] = $clients[$i]['Client']['secteur'];
            $data[$i]['potentialite'] = $clients[$i]['Client']['potentialite'];
            $data[$i]['action'] = $action;
            $visites = $listess->system_get_nombre_visite($clients[$i]['Client']['id'], $date_debut, $date_fin);
            $data[$i]['visite'] = count($visites);
        }
        if ($feuiile != null)
            return $data;
        else {
            echo json_encode($data);
            exit();
        }
    }

    //functiion qui renvoie la liste des client pour remplire fuille de route contient juste les clients non visiter
    function get_liste_non_visiter($code = null) {
        $clients = $this->getliste($code, 1);
        $data = array();
        for ($i = 0; $i < count($clients); $i++) {
            if ($clients[$i]['visite'] == 0)
                $data[$i] = $clients[$i];
        }
        $s = '[';
        foreach ($data as $value) {
            $s = $s . json_encode($value) . ',';
        }
        echo substr($s, 0, -1);
        echo ']';
        exit();
    }

    //functiion qui renvoie la liste des client  retard pour remplire fuille de route contient juste les clients non visiter
    function liste_retard($code = null) {
        $time = strtotime("1 January " . date("Y"), time());
        $day = date('w', $time);
        $time += ((7 * date("W", strtotime(date('Y-m-d')))) + 1 - $day) * 24 * 3600;
        $date_debut = date('Y-n-j', $time);
        $date_fin = date('Y-m-d', strtotime($date_debut . " +7 day "));
        $listess = new ListesController;
        $clientsr = $listess->listeretard($code, 1);
        $ids = 0;
        foreach ($clientsr as $key => $value) {
            $ids = $ids . ',' . $key;
        }
        $this->loadModel('Action');
        $this->Action->recursive = -1;
        $clients = $this->Action->query("select secteur_id,category_id,category1_id,type_id,id,nom,prenom,potentialite from clients as Client where Client.id in($ids)");
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $types = $this->Type->find('all', array('condtions' => array('Type.archive' => '1')));
        $categories = $this->Category->find('all', array('condtions' => array('Category.archive' => '1')));
        $secteurs = $this->Secteur->find('all');
        $data = array();
        for ($i = 0; $i < count($clients); $i++) {

            $action = $this->Action->find('count', array('conditions' => array('Action.archive' => 2, 'Action.client_id' => $clients[$i]['Client']['id']
                    , "Action.date_debut<='$date_debut'", "Action.date_fin>='$date_fin'")));
            $clients[$i]['Client']['action'] = $action;
            $clients[$i]['Client']['visite'] = 0;
            if ($clients[$i]['Client']['category1_id'] != null)
                $clients[$i]['Client']['category_id'] = $clients[$i]['Client']['category1_id'];
            foreach ($categories as $value) {
                if ($value['Category']['id'] == $clients[$i]['Client']['category_id']) {
                    $clients[$i]['Client']['category_id'] = $value['Category']['name'];
                    break;
                }
            }
            foreach ($types as $value) {
                if ($value['Type']['id'] == $clients[$i]['Client']['type_id']) {
                    $clients[$i]['Client']['type_id'] = $value['Type']['name'];
                    break;
                }
            }
            foreach ($secteurs as $value) {
                if ($value['Secteur']['id'] == $clients[$i]['Client']['secteur_id']) {
                    $clients[$i]['Client']['secteur'] = $value['Secteur']['secteur'];
                    break;
                }
            }
            $data[$i]['secteur'] = $clients[$i]['Client']['secteur'];
            $data[$i]['code'] = $clients[$i]['Client']['id'];
            $data[$i]['name'] = $clients[$i]['Client']['nom'] . ' ' . $clients[$i]['Client']['prenom'];
            $data[$i]['type'] = $clients[$i]['Client']['type_id'];
            $data[$i]['category'] = $clients[$i]['Client']['category_id'];
            $data[$i]['potentialite'] = $clients[$i]['Client']['potentialite'];
            $data[$i]['action'] = $action;
            $data[$i]['retard'] = $clientsr[$clients[$i]['Client']['id']];
        }
        echo json_encode($data);
        exit();
    }

    //function qui envoie feulle de route si il existe
    function feuille_route($code = null) {
        $date = date('Y-m-d'); // you can put any date you want
			$nbDay = date('N', strtotime($date));
			$monday = new DateTime($date);
			$sunday = new DateTime($date);
			$date_debut=$monday->modify('-'.($nbDay-1).' days')->format('Y-m-d');
			$date_fin=$sunday->modify('+'.(7-$nbDay).' days')->format('Y-m-d');
        $date = date('Y-m-d');
        $this->loadModel('Feuilleroute');
        $this->Feuilleroute->recursive = -1;
        $listes = $this->Feuilleroute->find('all', array('conditions' => array('Feuilleroute.user_id' => $code, 'Feuilleroute.date' => $date ,'Feuilleroute.valide' => 1)));
		$this->loadModel('User');
        $this->User->recursive = -1;
		$username=$this->User->findById($code);
		$username=$username["User"]["username"];
        if (empty($listes)) {
            echo json_encode(array());
            exit();
        }
        $ids = 0;
        foreach ($listes as $value) {
            $ids = $ids . ',' . $value['Feuilleroute']['client_id'];
        }
        $clients = $this->Feuilleroute->query("select * from clients as Client where Client.id in($ids)");
        $this->loadModel('Action');
        $this->loadModel('Visite');
        $this->loadModel('Liste');
        $this->loadModel('Plantourne');
        $this->loadModel('Category');
        $this->Category->recursive = -1;
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $this->loadModel('Temp');
        //$this->Temp->recursive = -1;
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $this->loadModel('Game');
        $this->Game->recursive = -1;
        $types = $this->Type->find('all', array('condtions' => array('Type.archive' => '1')));
        $categories = $this->Category->find('all', array('condtions' => array('Category.archive' => '1')));
        $data = array();
        $action = array();
        $visites = array();
        $listess = new ListesController;
        for ($i = 0; $i < count($clients); $i++) {
            //if($i==4){debug($clients[$i]);exit();}
            $visites = $listess->system_get_nombre_visite($clients[$i]['Client']['id'], $date_debut, $date_fin,$code);
			
			
			
            if (count($visites) == 0) 
			{
                $action = $this->Action->find('first', array('conditions' => array('Action.archive' => 2, 'Action.client_id' => $clients[$i]['Client']['id']
                        , "Action.date_debut<='$date_debut'", "Action.date_fin>='$date_fin'")));
                $clients[$i]['Client']['action'] = $action;
                $clients[$i]['Client']['visite'] = 0;
                $clients[$i]['Client']['categoryy_id'] = $clients[$i]['Client']['categoryy1_id'] = null;
                if ($clients[$i]['Client']['category1_id'] == null)
                    $clients[$i]['Client']['category1_id'] = $clients[$i]['Client']['category_id'];
                foreach ($categories as $value) {
                    if ($value['Category']['id'] == $clients[$i]['Client']['category_id'])
                        $clients[$i]['Client']['categoryy_id'] = $value['Category']['name'];
                    if ($value['Category']['id'] == $clients[$i]['Client']['category1_id'])
                        $clients[$i]['Client']['categoryy1_id'] = $value['Category']['name'];
                }
                foreach ($types as $value) {
                    if ($value['Type']['id'] == $clients[$i]['Client']['type_id']) {
                        $clients[$i]['Client']['typee_id'] = $value['Type']['name'];
                        break;
                    }
                }
                $secteur = $this->Secteur->findById($clients[$i]['Client']['secteur_id']);
                $data[$i]['id'] = $clients[$i]['Client']['id'];
                $data[$i]['name'] = $clients[$i]['Client']['nom'] . ' ' . $clients[$i]['Client']['prenom'];
                $data[$i]['nom'] = $clients[$i]['Client']['nom'];
                $data[$i]['prenom'] = $clients[$i]['Client']['prenom'];
                $data[$i]['dirigent'] = $clients[$i]['Client']['dirigent'];
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
                $data[$i]['produit'] = $clients[$i]['Client']['produit'];
				$data[$i]['username'] = $username;
                $nb_visite = $this->Visite->find('count', array('conditions' => array('Visite.archive' => 1, 'Visite.client_id' => $clients[$i]['Client']['id'], 'Visite.date >="' . $clients[$i]['Client']['date_recrutement'] . '"')));
                $data[$i]['visite'] = $nb_visite;
                $liste = $this->Liste->Affectation->find('all', array('conditions' => array('Affectation.client_id' => $clients[$i]['Client']['id']), 'fields' => array('Affectation.liste_id')));
                $idliste = "0";
                foreach ($liste as $key) {
                    $idliste = $idliste . ',' . $key['Affectation']['liste_id'];
                }
                $nb_retard = $this->Plantourne->find('count', array('conditions' => array("Plantourne.liste_id in($idliste)", 'Plantourne.date >="' . $clients[$i]['Client']['date_recrutement'] . '" and Plantourne.date <"' . date('Y-m-d') . '"')));
                $data[$i]['retard'] = $nb_visite - $nb_retard;

                //Gammes
                $data[$i]['gammes'] = "";
                $produits = explode(",", $clients[$i]['Client']['produit']);
                if (strlen($produits[0]) > 0) {
                    for ($iii = 0; $iii < count($produits); $iii++) {
                        $g = $this->Game->findById($produits[$iii]);
                        $data[$i]['gammes'] = $data[$i]['gammes'] . ',' . $g['Game']['name'];
                    }
                }

                if (count($action) != 0) {
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
                $this->Visite->recursive = 0;
                $vv = $this->Visite->find('all', array('conditions' => array('Visite.client_id' => $clients[$i]['Client']['id'],
                        'Visite.archive' => 1), 'order' => array('Visite.date desc limit 3')));
                $j = 0;
                foreach ($vv as $va) {
                    $visites['Visite'][$j]['client_id'] = $clients[$i]['Client']['id'];
                    $data[$i]['Visite'][$j]['date'] = $va['Visite']['date'];
                    $data[$i]['Visite'][$j]['commentaire'] = preg_match("/([a-zA-Z0-9])/", $va['Visite']['commentaire']);
                    $data[$i]['Visite'][$j]['echantillons'] = $va['Visite']['echantillons'];
                    $data[$i]['Visite'][$j]['objection'] = $va['Visite']['objection'];
                    $data[$i]['Visite'][$j]['veille'] = $va['Visite']['veille'];
                    $data[$i]['Visite'][$j]['responsable'] = $va['User']['name'];
					$data[$i]['Visite'][$j]['partenaires'] = $va['Visite']['partenaires'];
                    $data[$i]['Visite'][$j]['produits'] = $va['Visite']['produits'];
                    $data[$i]['Visite'][$j]['produitsNP'] = $va['Visite']['produitsNP'];
					$data[$i]['Visite'][$j]['type_visite'] = $va['Visite']['type_visite'];
                    $data[$i]['Visite'][$j]['concurrence_p'] = $va['Visite']['concurrence_p'];
					$data[$i]['Visite'][$j]['prescripteurs'] = $va['Visite']['prescripteurs'];
                    $j++;
                }
                $vv = $this->Temp->find('all', array('conditions' => array('Temp.client_id' => $clients[$i]['Client']['id']
                    ), 'order' => array('Temp.date desc limit 3')));
                $j = 0;
                foreach ($vv as $va) {
                    $data[$i]['Brochure'][$j]['id'] = $va['Brochure']['id'];
                    $data[$i]['Brochure'][$j]['date'] = $va['Temp']['date'];
                    $data[$i]['Brochure'][$j]['nom'] = $va['Brochure']['name'];
                    $data[$i]['Brochure'][$j]['duree'] = $va['Temp']['durree'];
                    $j++;
                }
				$this->loadModel('Client');
				$this->Client->recursive = -1;
				if($clients[$i]['Client']['type_id']=="2")
				{
					$vv=$this->Client->find("all", array('fields' => array('Client.id', 'Client.nom','Client.prenom'),'conditions' => array('Client.type_id' => 1,'Client.secteur_id' => $clients[$i]['Client']['secteur_id'])));
					$j = 0;
					foreach ($vv as $va) {
							$data[$i]['Proche'][$j]['id'] = $va['Client']['id'];
							$data[$i]['Proche'][$j]['name'] = $va['Client']['nom']." ".$va['Client']['prenom'];
							$j++;
						}
                }
            }
        }
		//debug($data,0,0);exit();
		
		$data=array_values($data);
		$data =$this->utf8ize( $data );
		if(count($data)==1)
		{
			echo "[";
			foreach ($data as $d)
				echo str_replace("\\u00e9", "e", json_encode($d,JSON_UNESCAPED_UNICODE ));
			echo "]";
		}
		else
			echo str_replace("\\u00e9", "e", json_encode($data,JSON_UNESCAPED_UNICODE ));
        exit();
    }
	
	public function utf8ize( $mixed ) {
		if (is_array($mixed)) {
			foreach ($mixed as $key => $value) {
				$mixed[$key] = $this->utf8ize($value);
			}
		} elseif (is_string($mixed)) {
			return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
		}
		return $mixed;
	}


    function send_brochure() {
        /*$this->loadModel('Brochure');
        $this->Brochure->recursive = -1;
        $brochures = $this->Brochure->find('all', array('conditions' => array('Brochure.archive' => 1)));
        $cat = array();
        foreach ($brochures as $brochure) {
            $i = 0;
            foreach ($cat as $cc) {
                if ($cc['Brochure']['name'] == $brochure['Brochure']['name']) {
                    $i++;
                    break;
                }
            }
            if ($i == 0)
                $cat[] = $brochure;
        }
        $brochure = $cat;*/
		$brochures=array();
        echo json_encode($brochures);
        exit();
    }

    function send_formation() {
        $this->loadModel('Formation');
        $this->Formation->recursive = -1;
		$this->loadModel('Game');
        $this->Game->recursive = -1;
        $brochure = $this->Formation->find('all', array('conditions' => array('Formation.archive' => 1)));
		$game = $this->Game->find('list');
		$i=0;
		foreach($brochure as $b)
		{
			foreach($game as $g=>$gname)
			{
				if($b['Formation']['game_id']==$g)
					$brochure[$i]['Formation']['gamme']=$gname;
			}
			$i++;
			break;
		}
		$brochures=array();
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

    function send_type($android=null) {
        $this->loadModel('Type');
        $data = $this->Type->find('list');
		if($android==null)
			echo json_encode($data);
		else
			echo "[".json_encode($data).']';
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

    function send_categories($android=null) {
        $this->loadModel('Category');
        $data = $this->Category->find('list');
		if($android==null)
			echo json_encode($data);
		else
			echo "[".json_encode($data)."]";
        exit();
    }

    function send_produits() {
        $this->loadModel('Produit');
        $this->Produit->recursive = -1;
        $brochure = $this->Produit->find('all', array('conditions' => array('Produit.archive' => 1)));
        echo str_replace("\\u00e9", "e", json_encode($brochure));
        exit();
    }

    function send_offres() {
        $this->loadModel('Offre');
        $this->Offre->recursive = 2;
        $brochure = $this->Offre->find('all', array('conditions' => array('Offre.archive' => 1)));
        echo json_encode($brochure);
        exit();
    }
    
    function send_echantillons() {
        $this->loadModel('Echantillon');
        $this->Echantillon->recursive = -1;
        $brochure = $this->Echantillon->find('all', array('conditions' => array('Echantillon.archive' => 1)));
        echo json_encode($brochure);
        exit();
    }
    
    function send_stock($code=null) 
    {
        if($code==null)
        {
            return '';
            exit();
        }
        $this->loadModel('Stockgadjet');
        $this->Stockgadjet->recursive = -1;
        $stock=$this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' =>$code,
            'Stockgadjet.quantite>0')));
        echo json_encode($stock);
        exit();
    }

    function get_feuille_route() {
        $code = $this->request->data['code'];
        $date = date('Y-m-d');
        $this->loadModel('Feuilleroute');
        $this->Feuilleroute->query("DELETE FROM feuilleroutes WHERE `user_id`=$code and date='$date' and valide => 1");
        foreach ($this->request->data['ids'] as $value => $v) {
            $a = array();
            $this->Feuilleroute->create();
            $a['Feuilleroute']['client_id'] = $v;
            $a['Feuilleroute']['date'] = $date;
            $a['Feuilleroute']['user_id'] = $code;
            $this->Feuilleroute->save($a); 
        }
        return $this->redirect(array('action' => 'feuille_route', $code));
    }

    function sync_visites() {
        $this->loadModel('Visite');
        $this->loadModel('Client');
        $this->loadModel('Stockgadjet');
        $this->Stockgadjet->recursive = -1;
        foreach ($this->request->data as $value) 
        {
            $this->Visite->create();
            $this->Client->id=$value['Visite']['client_id'];
			if($value['Visite']['type_visite']=="NON CLIENT" || $value['Visite']['type_visite']=="CLIENT")
				$this->Client->saveField("potentialite",$value['Visite']['type_visite']);
            $type_client=$value['Visite']['type_visite'];
            $presentoir="";
            if(isset($value['Visite']['objection']))
            {
                $presentoirs= explode("|", $value['Visite']['objection']);
                if(count($presentoirs)>2)
                    $presentoir=$presentoirs[2];
            }
            $this->Client->saveField("dirigent",$presentoir);
            if(strlen($value['Visite']['echantillons']) >2)
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
            }
            $this->Visite->save($value);
        }
        echo true;
        exit();
    }

    function sync_actions() {
		if(!empty($this->request->data))
		{
			$this->loadModel('Action');
			$this->loadModel('User');
			$this->User->recursive = -1;
			$this->loadModel('Boitemail');
			$this->Boitemail->recursive = -1;
			$user = $this->User->findById($this->request->data[0]['Action']['user_id']);
			
			$super = $this->requestAction('/users/system_get_superviseur/' . $user['User']['id']);
			if ($user['User']['role'] == "Super viseur") {

				$super = $this->requestAction('/users/system_get_promotion/');
			}
			foreach ($this->request->data as $value) {
				$this->Action->create();
				if ($user['User']['role'] == "Super viseur") {
					$value['Action']['archive'] = 1;
				}
				$this->Action->save($value);

				$this->Boitemail->create();
				$d['Boitemail']['user_id'] = $super['User']['id'];
				$d['Boitemail']['user1_id'] = 0;
				$d['Boitemail']['titre'] = 'Demande d\'action';
				$d['Boitemail']['message'] = "Une demande d'action a été faite par :" . $user['User']['name'];
				$this->Boitemail->save($d);
			}
		}
        echo true;
        exit();
    }

    function sync_brochures() {
        $this->loadModel('Temp');
        foreach ($this->request->data as $value) {
            $to_time = strtotime($value['Temp']['date_debut']);
            $from_time = strtotime($value['Temp']['date_fin']);
            $value['Temp']['durree'] = round(abs($to_time - $from_time) / 60, 0);
            $value['Temp']['date'] = $value['Temp']['date_debut'];
            $this->Temp->create();
            $this->Temp->save($value);
        }
        echo true;
        exit();
    }

    function sync_commandes() {
		if(empty($this->request->data))
		{
			echo true;
			exit();
		}
        $this->loadModel('Comander');
        $this->loadModel('Commande');
        $this->loadModel('User');
        $this->User->recursive = -1;
        $this->loadModel('Boitemail');
        $this->Boitemail->recursive = -1;			
        $user = $this->User->findById($this->request->data[0]['Commande']['user_id']);
        $super = $this->requestAction('/users/system_get_superviseur/' . $user['User']['id']);
        if ($user['User']['role'] == "Super viseur") {
            $super = $this->requestAction('/users/system_get_promotion/');
        }
        foreach ($this->request->data as $v) {
            //debug($v);exit();
            $a = array();
            $this->Commande->create();
            if ($user['User']['role'] == "Super viseur") {
                $a['Commande']['archive'] = 1;
            }
            $a['Commande']['user_id'] = $v['Commande']['user_id'];
            if(isset($v['Commande']['client_id']) && $v['Commande']['client_id']!=null && $v['Commande']['client_id']!="")
                $a['Commande']['client_id'] = $v['Commande']['client_id'];
            else
            {
                $a['Commande']['nom'] = $v['Commande']['nom'];
                $a['Commande']['tel'] = $v['Commande']['tel'];
            }
            $a['Commande']['paiement'] = $v['Commande']['paiement'];
            $a['Commande']['surplace'] = $v['Commande']['surplace'];
            $this->Commande->save($a);
            foreach ($v as $va) {
                foreach ($va as $val) {
                    if (is_array($val)) {
                        foreach ($val as $value) {
                            $this->Comander->create();
                            $a = array();
                            $a['Comander']['commande_id'] = $this->Commande->id;
                            $a['Comander']['produit_id'] = $value['produit_id'];
                            $a['Comander']['quantite'] = $value['quantite'];
                            $a['Comander']['prix'] = $value['prix'];
                            $this->Comander->save($a);
                        }
                    }
                }
            }
            $this->Boitemail->create();
            $d['Boitemail']['user_id'] = $super['User']['id'];
            $d['Boitemail']['user1_id'] = 0;
            $d['Boitemail']['titre'] = 'Commande ajoutée';
            $d['Boitemail']['message'] = "Une commande a été ajoutée par :" . $user['User']['name'];
            $this->Boitemail->save($d);
        }
        echo true;
        exit();
    }

    function sync_clientpropose() {
		if(!empty($this->request->data))
		{
			$this->loadModel('Clientspropose');
			$this->loadModel('User');
			$this->User->recursive = -1;
			$this->loadModel('Boitemail');
			$this->Boitemail->recursive = -1;
			$user = $this->User->findById($this->request->data[0]['Clientspropose']['user_id']);
			$super = $this->requestAction('/users/system_get_superviseur/' . $user['User']['id']);
			if ($user['User']['role'] == "Super viseur") {
				$super = $this->requestAction('/users/system_get_promotion/');
			}
			foreach ($this->request->data as $value) {
				$value['Clientspropose']['created'] = Date('Y-m-d H:i:s');
				if ($user['User']['role'] == "Super viseur") {
					$value['Clientspropose']['archive'] = 1;
				}
				$this->Clientspropose->create();

				$this->Clientspropose->save($value);
				$this->Boitemail->create();
				$d['Boitemail']['user_id'] = $super['User']['id'];
				$d['Boitemail']['user1_id'] = 0;
				if ($value['Clientspropose']['client_id'] != null) {
					$d['Boitemail']['titre'] = 'Proposition de modification des informations d\'un client';
					$d['Boitemail']['message'] = "Une proposition de modification des informations d'un client a été faite par :" . $user['User']['name'] . ".";
				} else {
					$d['Boitemail']['titre'] = 'Proposition d\'un client';
					$d['Boitemail']['message'] = "Une proposition de client a été faite par :" . $user['User']['name'] . ".";
				}
				$this->Boitemail->save($d);
			}
		}
        echo true;
        exit();
    }

    function sync_notes() {
        $this->loadModel('Notefrai');
        foreach ($this->request->data as $value) {

            debug($value);
            $this->Notefrai->create();
            $this->Notefrai->save($value);
        }
        echo true;
        exit();
    }

}
