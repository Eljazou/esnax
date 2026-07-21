<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'Objectifs');
App::import('Controller', 'Listes');

class NotefraisController extends AppController
{

	function notedefrais($user_id = null, $date = null)
	{
		ini_set('memory_limit', '-1');
		set_time_limit(250);
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$this->loadModel("User");
		$this->User->recursive = -1;
		$this->loadModel("Visite");
		$this->Visite->recursive = -1;
		$users = $this->User->find("list", array("conditions" => array("User.archive" => 1)));
		$info = $visites = array();
		$reels = $maps = array();


		//hna je vais ajouter wahd system dial automatisation mn view pour généré d'une façon automatique les note de frais
		//si je poste next_user_auto_id=0 sela veux dire que le system va chercher les VM li ma3ndhomch les note de frais f les date demander wahd b wahd 
		//apres had next_user_auto_id ghadi ykoun fih user_id et ghadi nsifto l view
		//mli ghadi ywli next_user_auto_id fih -1 sa veux dire que tout le monde 3ando Note de frais donc stop ne fais rien
		$next_user_auto_id = -1;
		if ($this->request->is('get') || $user_id != null) {
			if ($user_id == null) {
				//$user_id = $this->request->data["Notefrai"]["user_id"];
				//$date = $this->request->data["Notefrai"]['date'];
				$user_id = $this->request->query('user_id');
				$date = $this->request->query('date');
			}

			$user = $this->User->findById($user_id);
			$date = explode('--', $date);
			$date_debut = $date[0];
			$date_fin = $date[1];
			if ($this->request->query('next_user_auto_id')) {

				$note = $this->Notefrai->find("list", array("fields" => array("Notefrai.user_id", "Notefrai.user_id"), "conditions" => array("Notefrai.date_debut" => $date_debut, "Notefrai.date_fin" => $date_fin)));
				$ids = $user_id;
				foreach ($note as $k => $v)
					$ids = "$ids,$v";

				$next_user_id = $this->Visite->find("first", array("conditions" => array(
					"Visite.user_id not in($ids)",
					"Visite.date between '$date_debut' and '$date_fin'",
					"Visite.archive" => 1
				)));
				if (!empty($next_user_id))
					$next_user_auto_id = $next_user_id["Visite"]["user_id"];
			}
			$this->loadModel("Visite");
			//cherchez les visites que des medcins 'Client.type_id=1'
			$visites = $this->Visite->query("SELECT * FROM clients AS Client,visites AS Visite,secteurs AS Secteur
                                        WHERE Client.id=Visite.client_id AND Client.secteur_id=Secteur.id and Visite.archive=1 and 
                                        Visite.user_id=$user_id and Visite.date between '$date_debut' and '$date_fin 23:59:59' order by Visite.date asc");
			$data = array();
			$datavisites = $nb_visites = array();

			$lat1 = $lon1=$changerdate = 0;
			foreach ($visites as $visite) {
				if (!isset($nb_visites[$visite["Client"]["type_id"]]))
					$nb_visites[$visite["Client"]["type_id"]] = 0;
				$nb_visites[$visite["Client"]["type_id"]] = $nb_visites[$visite["Client"]["type_id"]] + 1;
				$datee = explode(" ", $visite["Visite"]["date"]);
				$datee = $datee[0];
				$maps[$datee][] = $visite;
				if ($datee != $changerdate) {
					$changerdate = $datee;
					$lat1 = 0;
				}
				if ($visite["Visite"]["longitude"] != "" && $visite["Visite"]["longitude"] != 0) {
					if ($lat1 == 0) {
						$lat1 = $visite["Visite"]["latitude"];
						$lon1 = $visite["Visite"]["longitude"];
					} else {
						$lat2 = $visite["Visite"]["latitude"];
						$lon2 = $visite["Visite"]["longitude"];
						$distance = $this->system_calcule_km($lat1, $lon1, $lat2, $lon2);
						if (!isset($reels[$datee]))
							$reels[$datee] = $distance;
						else
							$reels[$datee] = $reels[$datee] + $distance;
						$lat1 = $visite["Visite"]["latitude"];
						$lon1 = $visite["Visite"]["longitude"];
					}
				}

				$visite["Visite"]["client"] = $visite["Client"]["nom"];
				$visite["Visite"]["potentialite"] = $visite["Client"]["potentialite"];
				$visite["Visite"]["longitude"] = $visite["Client"]["longitude"];
				$visite["Visite"]["latitude"] = $visite["Client"]["latitude"];
				$visite["Visite"]["type_id"] = $visite["Client"]["type_id"];
				$visite["Visite"]["category_id"] = $visite["Client"]["category_id"];

				$datavisites[$datee][] = $visite["Visite"];

				$date = explode(" ", $visite["Visite"]["date"]);
				$data[$date[0]][] = strtolower($visite["Secteur"]["ville"]);
			}

			$infoo = array();
			foreach ($data as $k => $date) {
				$ville_deplacements = array_count_values($date);
				/* debug($ville_deplacements);
                  $ville_deplacement="";
                  $nombrevisite_temp=0;
                  foreach($ville_deplacements as $ville => $nombrevisite)
                  {
                  if($nombrevisite_temp<$nombrevisite)
                  $ville_deplacement=$ville;
                  }
                  $info[$k]["ville"]=$ville_deplacement;
                  $info[$k]["nombre_visite"]=count($date); */
				$infoo[$k] = $ville_deplacements;
			}
			$ville_origine = strtolower($user["User"]["notefrais_qg"]);
			$info = array();
			foreach ($infoo as $date => $villes) {

				$info[$date]["villes"] = $villes;
				$itineraire = "$ville_origine ==> ";
				$allville = "";
				foreach ($villes as $ville => $nombrevisite) {
					$itineraire .= "$ville ==> ";
					$allville .= "'$ville',";
				}
				//ila kan vendredi j'ajout QG
				if (date('N', strtotime($date)) == 5) {
					$kain = explode(",", $allville);
					if (str_replace("'", '', $kain[count($kain) - 2]) != strtolower($user["User"]["notefrais_qg"])) {
						$itineraire .= strtolower($user["User"]["notefrais_qg"]) . " ==> ";
						$allville .= "'" . strtolower($user["User"]["notefrais_qg"]) . "',";
					}
				}

				// si on n'a deux ville on supprimer la méme ville car le systeme va calcluer hta dakchi li kain f la meme ville chose qui incorect
				$deplacement = "";
				if (count(explode(",", $allville)) > 2)
					$deplacement = " and ville != destination";

				$allville = trim($allville, ",");
				$this->loadModel("Notefraissecteur");
				$notes = $this->Notefraissecteur->find("all", array("conditions" => array("ville in('$ville_origine') and destination in ($allville) $deplacement")));
				//debug($notes);
				//echo "<br>ville in($allville) and destination in ($allville) $deplacement ::: Date : $date ::: ville $ville_origine ==> $itineraire";
				$urbain = $interville = $hotel = $restaurant = $divers = 0;
				foreach ($notes as $note) {
					$urbain = $urbain + $note["Notefraissecteur"]["urbain"];
					$interville = $interville + $note["Notefraissecteur"]["interville"];
					$hotel = $hotel + $note["Notefraissecteur"]["hotel"];
					$restaurant = $restaurant + $note["Notefraissecteur"]["restaurant"];
					$divers = $divers + $note["Notefraissecteur"]["divers"];
					if ($note["Notefraissecteur"]["divers"] != null)
						$ville = $note["Notefraissecteur"]["nuit"];
				}
				$info[$date]["urbain"] = $urbain;
				$info[$date]["interville"] = $interville;
				$info[$date]["hotel"] = $hotel;
				$info[$date]["restaurant"] = $restaurant;
				$info[$date]["divers"] = $divers;
				$itineraire = trim($itineraire, " ==> ");
				$info[$date]["itineraire"] = $itineraire;
				//cheque vendredi le VM doit retouner vers sa ville natal (QG)
				if (date('N', strtotime($date)) == 5)
					$ville_origine = strtolower($user["User"]["notefrais_qg"]);
				else
					$ville_origine = $ville;
			}


			//--------------------------------calcule de objectif---------------------//

			$nombredejour = $this->system_calcule_nombre_jour($date_debut, $date_fin);
			//je recupére le nombre de jours de congé et les absences et les maladies pour les supprimer de l'objectif
			$dataabsence = $this->system_getconge_et_absense($user["User"]['id'], $date_debut, $date_fin);
			$nombredejour = $nombredejour - $dataabsence["total"];

			//$objectifs=$this->requestAction("objectifs/system_dernier_objectif/".$user["User"]['id']);
			$this->loadModel("Objectif");
			$objectifs = $this->Objectif->find('all', array('conditions' => array('Objectif.user_id' => $user_id, 'Objectif.archive' => 1, 'Objectif.type_id' => 1), 'order' => array('Objectif.created desc')));
			$objectif = array();
			foreach ($objectifs as $obj)
				$objectif[$obj["Objectif"]['id']] = ($obj["Objectif"]['objectif'] / 5) * $nombredejour;


			//-----------------------------------Fin----------------------------------------//

		}
		//debug($maps,0,0);
		$gps = array();
		foreach ($maps as $d => $ms) {
			foreach ($ms as $m) {
				$dd = array();
				$dd["nom"] = $m["Client"]["nom"] . " " . $m["Client"]["prenom"];
				$dd["gps"] = $m["Visite"]["latitude"] . "," . $m["Visite"]["longitude"];
				$gps[$d][] = $dd;
			}
		}
		//debug($gps);
		//---------------------------Info de note de frais si elle existe pour le mois demander ou pas -----------//
		$mois = explode("-", $date_debut);
		$mois = $mois[0] . "_" . $mois[1];
		$notevalidations = $noteajustements = array();
		$noteajouter = $this->Notefrai->find("first", array("conditions" => array("Notefrai.user_id" => $user["User"]["id"], "Notefrai.date_debut" => $date_debut, "Notefrai.date_fin" => $date_fin)));
		if (!isset($noteajouter)) {
			$noteajustements = $this->Notefrai->Noteajustement->find("all", array("conditions" => array("Noteajustement.notefrai_id" => $noteajouter["Notefrai"]["id"]), "order" => array("Noteajustement.id asc")));
		}
		$this->loadModel("Notevalidation");
		$user_id = AuthComponent::user("id");
		$notevalidations = $this->Notevalidation->find('first', ['conditions' => [
			'Notevalidation.niveau' => $noteajouter['Notefrai']['archive'],
			'OR' => [
				array('Notevalidation.users' => $user_id),
				array('Notevalidation.users LIKE' => $user_id . ';%'),
				array('Notevalidation.users LIKE' => '%;' . $user_id . ';%'),
				array('Notevalidation.users LIKE' => '%;' . $user_id)
			]
		]]);

		//-----------------------------------Fin------------------------------------------//





		$this->set(compact("datavisites", "info", "user", 'date_debut', 'date_fin', "users", "reels", "maps", "gps", "noteajouter", "mois", "nb_visites", "objectif", "dataabsence", "next_user_auto_id", "noteajustements", "notevalidations"));


		//debug($datavisites,0,0);
		//exit();
	}


	//Ajouter le 04/10/2021 Nouvel version de Note de frais
	function ajustement()
	{
		if ($this->request->is('post') || $this->request->is('put')) {
			$n = $this->request->data;

			$note = $this->Notefrai->find("first", array("conditions" => array("Notefrai.user_id" => $n["Notefrai"]["user_id"], "Notefrai.mois" => $n["Notefrai"]["mois"])));
			if (!empty($note)) {
				$this->Notefrai->id = $note["Notefrai"]["id"];
			} else {
				$this->Notefrai->create();
			}
			$this->Notefrai->save($this->request->data);

			$this->Notefrai->Noteajustement->create();
			$d = array();
			$d['notefrai_id'] = $this->Notefrai->id;
			$d['user_id'] = AuthComponent::user("id");
			$d['nature'] = $n["Notefrai"]["nature"];
			$d['commentaire'] = $n["Notefrai"]["commentaire"];
			$d['ajustement'] = $n["Notefrai"]["ajustement"];
			if ($d['nature'] == "0") {
				unset($d['nature']);
			}

			$this->Notefrai->Noteajustement->save($d);


			//Systeme dial automatique si est activé 
			$date = $n["Notefrai"]["date_debut"] . "--" . $n["Notefrai"]["date_fin"];
			$this->Session->setFlash("Demande enregistrer sous");
			if (isset($n["Notefrai"]["next_user_auto_id"]) && $n["Notefrai"]["next_user_auto_id"] != -1) {
				return $this->redirect(array(
					'action' => 'notedefrais',
					'?' => array(
						'user_id' => $n["Notefrai"]["next_user_auto_id"],
						'date' => $date,
						"next_user_auto_id" => $n["Notefrai"]["next_user_auto_id"]
					)
				));
			} else
				return $this->redirect(array('action' => 'notedefrais', $n["Notefrai"]["user_id"], $date));
		}
	}


	function index($archive = 0, $mois = 0)
	{
		if ($mois == 0)
			$mois = date("y_m");

		$notes = $this->Notefrai->find("all", array("conditions" => array("Notefrai.archive in($archive)", "Notefrai.mois" => $mois)));
		$ids = 0;
		foreach ($notes as $n)
			$ids = "$ids," . $n["Notefrai"]["id"];
		//$this->Notefrai->Noteajustement->recursive=-1;
		$ajustements = $this->Notefrai->Noteajustement->find("all", array("conditions" => array("Noteajustement.notefrai_id in ($ids)")));

		$listenatures = array();
		$dataajustements = array();
		foreach ($ajustements as $j) {
			$j = $j["Noteajustement"];
			if (strlen($j["nature"]) < 3)
				continue;
			$listenatures[$j["nature"]] = $j["nature"];

			if (!isset($dataajustements[$j["notefrai_id"]])) {
				$dataajustements[$j["notefrai_id"]] = array();
			}
			$dataajustements[$j["notefrai_id"]][$j["nature"]] = $j["ajustement"];
		}

		$this->set(compact("notes", "archive", "dataajustements", "listenatures"));
	}


	//------------------ Calcule kélomtrage par entre deux points GPS -----------------------
	function system_calcule_km($lat1, $lon1, $lat2, $lon2)
	{
		$distance = 0;
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$distance = round($miles * 1.609344, 2);
		return $distance;
	}



	//Me donne le nombre de jours a travail sans compter les jours firié et les samedi dimanche
	function system_calcule_nombre_jour($date_debut = "2021-10-18", $date_fin = "2021-10-26")
	{
		$start = strtotime($date_debut);
		$end = strtotime($date_fin);

		$count = 0;
		$this->loadModel("Jourferier");
		$jours = $this->Jourferier->find("all", array("conditions" => array("Jourferier.date_debut>='$date_debut' and Jourferier.date_fin<='$date_fin'")));
		while (date('Y-m-d', $start) < date('Y-m-d', $end)) {
			foreach ($jours as $j) {
				$debut = $j["Jourferier"]["date_debut"];
				$fin = $j["Jourferier"]["date_fin"];
				do {
					if (date('Y-m-d', $start) == $debut) {
						$start = strtotime("+1 day", $start);
						continue;
					}
					$debut = strtotime($debut);
					$debut = date('Y-m-d', strtotime("+1 day", $debut));
				} while ($debut < $fin);
			}
			$count += date('N', $start) < 6 ? 1 : 0;
			$start = strtotime("+1 day", $start);
		}
		return $count;
	}

	//------------------ Calcule Nombre de jour entre deux date de absenses et congé et maladie-------
	function system_getconge_et_absense($user_id = 16, $date_debut = "2020-12-01", $date_fin = "2021-10-10")
	{
		$this->loadModel("Absence");
		$this->Absence->recursive = -1;
		$abss = $this->Absence->find("all", array("conditions" => array(
			"Absence.archive" => 1,
			"Absence.user_id" => $user_id,
			"Absence.date_debut>='$date_debut' and Absence.date_fin<='$date_fin'"
		)));
		$data = array();
		$data["total"] = 0;
		foreach ($abss as $abs) {
			if (!isset($data[$abs["Absence"]["type"]])) {
				$data[$abs["Absence"]["type"]] = array();
				$data[$abs["Absence"]["type"]]["nombre"] = 0;
				$data[$abs["Absence"]["type"]]["dates"] = "";
			}
			//Me donne le nombre de jours a travail sans compter les jours firié et les samedi dimanche
			$jour = $this->system_calcule_nombre_jour($abs["Absence"]["date_debut"], $abs["Absence"]["date_fin"]);

			$data[$abs["Absence"]["type"]]["nombre"] = $data[$abs["Absence"]["type"]]["nombre"] + $jour;
			$data["total"] = $data["total"] + $jour;
			$data[$abs["Absence"]["type"]]["dates"] = $data[$abs["Absence"]["type"]]["dates"] . "<br>" . $abs["Absence"]["date_debut"] . "--" . $abs["Absence"]["date_fin"];
		}
		return $data;
	}



	//had fonction hia li ta dir dakchi automatique
	//matadir walo ghir elle démarre ele process de automatisation des note de frais b l'envoie de next_user_auto_id

	function automatique_note_de_frais()
	{
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$date = "$date_debut--$date_fin";
		$next_user_id = -1;
		if ($this->request->query('date')) {
			$date = $this->request->query('date');
			$datee = explode('--', $date);
			$date_debut = $datee[0];
			$date_fin = $datee[1];
			$this->loadModel("Visite");
			$this->Visite->recursive = -1;
			$visite = $this->Visite->find("first", array("conditions" => array("Visite.date between '$date_debut' and '$date_fin'", "Visite.archive" => 1)));
			if (count($visite) == 1)
				$next_user_id = $visite["Visite"]["user_id"];
			return $this->redirect(array(
				'action' => 'notedefrais',
				'?' => array(
					'user_id' => $next_user_id,
					'date' => $date,
					"next_user_auto_id" => $next_user_id
				)
			));
		}
		$this->set(compact('date_debut', 'date_fin'));
	}



	function valider($valide, $mois = 0, $commentaire = "")
	{
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			$commentaire = $this->request->data["Notefrai"]["commentaire"];
			$this->loadModel("User");
			$this->User->recursive = -1;
			$responsable = AuthComponent::user("name");
			$usersss = explode(",", $this->request->data["Notefrai"]["ids_remove"]);
			$users = array();
			$this->loadModel("Notevalidation");
			foreach ($usersss as $k => $user_id) {
				$note = $this->Notefrai->find("first", array("conditions" => array("Notefrai.user_id" => $user_id, "Notefrai.mois" => $mois)));
				$ajustement = 0;
				foreach ($note["Noteajustement"] as $n)
					$ajustement += $n["ajustement"];


				$vm = $note["User"]["name"];
				$mois = $note["Notefrai"]["mois"];
				$total = $note['Notefrai']['thiorique'];


				$this->Notefrai->id = $note["Notefrai"]["id"];
				$archive = $note["Notefrai"]["archive"] + $valide;
				//echo $archive;exit();
				$this->Notefrai->saveField("archive", $archive);

				$this->Notefrai->Noteajustement->create();
				$d = array();
				$d['notefrai_id'] = $note["Notefrai"]["id"];
				$d['user_id'] = AuthComponent::user("id");
				$d['nature'] = $valide;
				$d['commentaire'] = $commentaire;
				$this->Notefrai->Noteajustement->save($d);
				$this->system_testsendmail($archive, $mois,$valide);
			}
			return $this->redirect(array('action' => 'validation'));
		}
	}


	function system_testsendmail($archive, $mois,$valide)
	{
		$archive=$archive-$valide;
		$this->loadModel('User');
		$this->User->recursive=-1;
		$kain = $this->Notefrai->find("count", array("conditions" => array("Notefrai.archive " => $archive, "Notefrai.mois" => $mois)));
		if ($kain == 0) {
			$archive=$archive+$valide;
			$notevalidation = $this->Notevalidation->find('first', ['conditions' => ['Notevalidation.niveau' => $archive]]);
			if (!empty($notevalidation)) {
				$users = explode(";", $notevalidation["Notevalidation"]["users"]);
				if ($valide == 1)
					$message = $notevalidation["Notevalidation"]["messagevalidation"];
				else
					$message = $notevalidation["Notevalidation"]["messageannulation"];
				$sujet = "Mise a jour de note de frais";
				$from = "no-replay@esnapharm.com";
				foreach ($users as $k => $v) {
					$u = $this->User->findById($v);
					$to = $u["User"]["username"];
					$this->system_sendmail($from, $to, $sujet, $message,$v, $mois);
				}
			}
		}
	}


	function system_sendmail($from, $to, $sujet, $message, $user_id, $mois)
	{
		//$to = "godsneek@hotmail.com";
		if (!filter_var($to, FILTER_VALIDATE_EMAIL))
			$to = "godsneek@hotmail.com";
		App::uses('CakeEmail', 'Network/Email');
		$Email = new CakeEmail();
		$Email->to($to);
		$Email->from($from);
		$Email->subject($sujet);
		$Email->send($message);
		//envoyé la notif 
		$this->loadModel('Boitemail');
		$this->Boitemail->create();

		$d['Boitemail']['user_id'] = $user_id;
		$date = date("$mois-01") . "--" . date("$mois-t");
		$date = str_replace("_", "-", $date);
		$d['Boitemail']['user1_id'] = 0;
		$d['Boitemail']['titre'] = $sujet;
		$d['Boitemail']['message'] = $message;
		$this->Boitemail->save($d);
	}



	function validation()
	{
		$this->loadModel("Notevalidation");
		$userId = AuthComponent::user("id");

		$notevalidation = $this->Notevalidation->find('all', array(
			'conditions' => array(
				'OR' => array(
					array('Notevalidation.users' => $userId),
					array('Notevalidation.users LIKE' => $userId . ';%'),
					array('Notevalidation.users LIKE' => '%;' . $userId . ';%'),
					array('Notevalidation.users LIKE' => '%;' . $userId)
				)
			)
		));
		$this->Notefrai->recursive = -1;
		$moisCount = array();
		$valide = 0;
		foreach ($notevalidation as $notevalide) {
			$valide = $notevalide["Notevalidation"]["niveau"];
			$notes = $this->Notefrai->find("all", array("conditions" => array("Notefrai.archive" => $notevalide["Notevalidation"]["niveau"])));
			foreach ($notes as $note) {
				$mois = $note['Notefrai']['mois'];
				if (!isset($moisCount[$mois]))
					$moisCount[$mois] = 0;
				$moisCount[$mois]++;
			}
		}
		ksort($moisCount);
		$this->set(compact('moisCount', "valide"));
	}
	
	
	function exporter()
	{
		$this->loadModel("Notevalidation");
		$userId = AuthComponent::user("id");
		$notevalide = $this->Notevalidation->find('first', array('order' => array("Notevalidation.niveau desc")));
		$this->Notefrai->recursive = -1;
		$moisCount = array();
		$valide = $notevalide["Notevalidation"]["niveau"]+1;
		$notes = $this->Notefrai->find("all", array("conditions" => array("Notefrai.archive = $valide" )));
		foreach ($notes as $note) {
			$mois = $note['Notefrai']['mois'];
			if (!isset($moisCount[$mois]))
				$moisCount[$mois] = 0;
			$moisCount[$mois]++;
		}
		ksort($moisCount);
		$this->set(compact('moisCount', "valide"));
	}
	
}
