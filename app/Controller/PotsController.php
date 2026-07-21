<?php
App::uses('AppController', 'Controller');
/**
 * Pots Controller
 *
 * @property Pot $Pot
 * @property PaginatorComponent $Paginator
 */
class PotsController extends AppController
{

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index()
	{
		ini_set('memory_limit', '-1');
		set_time_limit(-1);
		$this->loadModel("Client");
		$this->loadModel("Visite");
		$this->loadModel('Secteur');
		$this->loadModel('Game');
		$this->Secteur->recursive = -1;
		$this->loadModel('Category');
		$this->Category->recursive = -1;
		$this->loadModel('User');
		$this->User->recursive = -1;
		$this->loadModel('Apartient');
		//$this->Apartient->recursive = -1;
		$this->User->Ligne->recursive = -1;
		$this->Visite->recursive = -1;
		$this->loadModel("Liste");
		$this->Liste->recursive = -1;
		$this->Liste->Affectation->recursive = -1;
		$this->Pot->recursive = -1;


		$games = $this->Game->find("list");


		$date_debut = date("Y-01-01");
		$date_fin = date("Y-m-d");
		$dateaafficherdansleview = "$date_debut -- $date_fin";
		$query_gamme = "";
		$queryclient = " 1=1 ";
		$query_visite = " 1=1 ";
		$users_id = "0";
		$selected_users = array();
		$users = array();
		$gammes_id = array();
		if ($this->request->is('post')) {
			if (!empty($this->request->data["date"])) {
				$dateaafficherdansleview = $this->request->data["date"];
				$date = explode(" -- ", $this->request->data["date"]);
				$date_debut = $date[0];
				$date_fin = $date[1];
				$date = " (DATE(Visite.date) BETWEEN '$date[0]' AND '$date[1]') ";
				$query_visite = $query_visite . " and " . $date;
			}
			//----------------------------Gamme---------------------------
			if (!empty($this->request->data["game_id"])) {
				$ids = 0;
				foreach ($this->request->data["game_id"] as $key => $value) {
					$gammes_id[] = $value;
					$ids .= ",$value";
				}
				$query_gamme = " and Pot.game_id in($ids) ";
			}

			//----------------------------activité---------------------------
			if (!empty($this->request->data["activite"])) {
				$queryclient = $queryclient . " and Client.activite='" . $this->request->data["activite"] . "'";
			}
			//----------------------------Type client---------------------------
			if (!empty($this->request->data["type"])) {

				$types = 0;
				foreach ($this->request->data["type"] as $key => $value)
					$types = $types . "," . $value;
				$queryclient = $queryclient . " and Client.type_id in ($types)";
			}
			//----------------------Seteurs------------------------
			if (!empty($this->request->data["secteur_id"])) {
				$secteur = 0;
				foreach ($this->request->data["secteur_id"] as $key => $value) {
					$region = $this->Secteur->findById($value);
					$region = $this->Secteur->find('list', array("conditions" => array("Secteur.region" => $region["Secteur"]["region"])));
					foreach ($region as $k => $v) {
						$secteur = $secteur . "," . $k;
					}
				}
				$queryclient = $queryclient . " and Client.secteur_id in ($secteur)";
			}
			//--------------------------------Les categories---------------------------
			if (!empty($this->request->data["category_id"])) {
				$spesialite = 0;
				foreach ($this->request->data["category_id"] as $key => $value)
					$spesialite = $spesialite . "," . $value;
				$queryclient = $queryclient . " and Client.category_id in ($spesialite)";
			}
			//----------------------------Lignes ---------------------------
			if (!empty($this->request->data["ligne"])) {
				$ids = 0;
				foreach ($this->request->data["ligne"] as $key => $value)
					$ids .= "," . $value;
				$user = $this->User->find('list', array('conditions' => array("User.ligne_id in ($ids) and User.archive!=-1")));
				foreach ($user as $id => $name)
					$users_id .= ",$id";
			}
			//-------------------Users------------------------

			if (!empty($this->request->data["users"])) {
				$spesialite = 0;
				foreach ($this->request->data["users"] as $key => $value) {
					$users_id .= ",$value";
				}
				$selected_users = $this->request->data["users"];
			}
		}

		//---------------had rwina me permet de recupéré la lsite des users pour supervseur ou pour le tout
		//-----------------une je recupére users je doit recupéré leurs listes ainsi l'affectation des clients
		//------------------une fois récupéré je doit recupéré les clients pour chaque VM 
		//une fois terminer je doit fisioné les avec leurs portentilaité
		if ($users_id == "0") {
			if (AuthComponent::user('role') == 'Super viseur') {
				$user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
				//debug($user);exit();
				foreach ($user as $u) {
					if ($u['User1']['archive'] != -1)
						$users[$u["User1"]["id"]] = $u["User1"]["name"];
				}
				$u = $this->User->findById(AuthComponent::user('id'));
				$users[$u["User"]["id"]] = $u["User"]["name"];
			} else {
				//$users = $this->User->find("list", array('conditions' => array('User.archive' => 1,"User.role in('Coordinateur','Super viseur','VMP')")));
			}
		} else {
			$users = $this->User->find("list", array('conditions' => array("User.id in($users_id)")));
		}
		$users_id = 0;
		foreach ($users as $k => $v)
			$users_id .= ",$k";



		$affectations = $this->Liste->Affectation->find("all", array(
			"joins" => array(
				array(
					"table" => "listes",
					"alias" => "Liste",
					"type" => "INNER",
					"conditions" => array("Affectation.liste_id = Liste.id")
				),
				array(
					"table" => "clients",
					"alias" => "Client",
					"type" => "INNER",
					"conditions" => array("Affectation.client_id = Client.id")
				)
			),
			"conditions" => array(
				"Affectation.valide" => 1,
				//"Client.type_id" => 1,
				"Client.archive" => 1,
				"Liste.user_id IN ($users_id)",
				"Liste.archive" => 1,
				"$queryclient"
			),
			"fields" => array(
				"Affectation.liste_id",
				"Affectation.client_id",
				"Liste.user_id",
				"Client.id",
				"Client.nom",
				"Client.prenom",
				"Client.category_id",
				"Client.category1_id",
				"Client.secteur_id",
				"Client.activite",
				"Client.potentialite",
				"Client.latitude",
				"Client.longitude"
			)
		));
		$client_ids = 0;
		foreach ($affectations as $k => $v)
			$client_ids = "$client_ids," . $v["Affectation"]["client_id"];


		$potss = $this->Pot->find("all", array("conditions" => array("Pot.client_id IN ($client_ids)	  $query_gamme order by Pot.id desc")));

		$pots = array();
		foreach ($potss as $item) {
			$item = $item['Pot'];
			$clientId = $item['client_id'];
			if (!isset($pots[$clientId])) {
				$pots[$clientId] = array();
			}
			$item["gamme"] = $games[$item['game_id']];
			$item["pot"] = $item['pot_patient'] . "" . $item['pot_indication'] . "" . $item['pot_prescription'];
			$pots[$clientId][] = $item;
		}

		// Regrouper les affectations par utilisateur
		$allusers = array();
		$user_ids = 0;
		foreach ($users as $key => $value) {
			$user_ids = "$user_ids,$key";
			$allusers[$key] = array(
				"user_id" => $key,
				"name" => $value,
				"Clients" => array()
			);
		}
		$visites = $this->Visite->find("all", array(
			"conditions" => array(
				"$query_visite",
				"Visite.client_id IN ($client_ids)",
				"Visite.user_id IN ($user_ids)",
				"Visite.archive" => 1
			),
			"fields" => array("Visite.client_id", "Visite.user_id", "COUNT(*) as nb_visite"),
			"group" => array("Visite.user_id", "Visite.client_id")
		));
		$nombre_visites = array();
		foreach ($visites as $visit) {
			$nombre_visites[$visit["Visite"]["user_id"]][$visit["Visite"]["client_id"]] = $visit["0"]["nb_visite"];
		}
		//debug($nombre_visites);exit();

		foreach ($affectations as $affect) {
			$userId = $affect["Liste"]["user_id"];
			$clientData = $affect["Client"];
			$clientId = $clientData["id"];
			if (!isset($clientData["Pots"])) {
				$clientData["Pots"] = array();
			}
			if (isset($pots[$clientId])) {
				$clientData["Pots"] = $pots[$clientId];
				$clientData["pot"] = $pots[$clientId][0]["pot"];
				$clientData["gamme"] = $pots[$clientId][0]["gamme"];
			}
			// Ajouter nb_visite
			if (isset($nombre_visites[$userId][$clientId])) {
				$clientData["nb_visite"] = $nombre_visites[$userId][$clientId];
			} else {
				$clientData["nb_visite"] = 0;
			}

			$allusers[$userId]["Clients"][$clientId] = $clientData;
		}
		//debug($allusers);exit();
		$categories = $this->Category->find('list');
		$lignes = $this->User->Ligne->find('list');
		$types = $this->Client->Type->find("list");

		$secteurs = $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), "group" => array("Secteur.region")));
		$this->Secteur->recursive=-1;
		$allsecteurs = $this->Secteur->find("all");
		$temp=[];
		foreach($allsecteurs as $s){
			$temp[$s["Secteur"]["id"]]=$s["Secteur"];
		}
		$allsecteurs=$temp;
		$users_listes = $this->User->find("list", array(
			'conditions' => array(
				'User.archive' => 1,
				"User.id not in(2,4)",
				"User.role in('Coordinateur','Super viseur','VMP')"
			)
		));

		//debug($allusers);exit();

		$this->set(compact(
			'dateaafficherdansleview',
			'pots',
			"users",
			"secteurs",
			"categories",
			"lignes",
			"allusers",
			"games",
			"allsecteurs",
			"users_listes",
			"selected_users"
		));
	}



	/**
	 * add method
	 *
	 * @return void
	 */
	public function add($client_id = null)
	{
		if ($this->request->is('post')) {
			$this->Pot->create();
			$this->request->data["Pot"]["client_id"] = $client_id;
			if ($this->Pot->save($this->request->data)) {
				$this->Session->setFlash(__('La Pot à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("La Pot  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
			}
		}
		$users = $this->Pot->User->find('list');
		$games = $this->Pot->Game->find('list');
		$this->set(compact('users', "games"));
	}


	public function edit($id)
	{
		$pot = $this->Pot->find("first", array('conditions' => array('Pot.id' => $id)));
		// debug($pot);
		// exit();
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Pot->create();
			if ($this->Pot->save($this->request->data)) {
				$this->Session->setFlash(__('La Pot à été enregistré'));
				return $this->redirect(array("controller" => "pots", 'action' => 'index'));
			} else {
				$this->Session->setFlash(__("La Pot  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
			}
		}
		$this->request->data = $pot;
		$this->loadModel('User');
		$this->loadModel('Game');

		$users = $this->User->find('list');
		$games = $this->Game->find('list');
		$this->set(compact('users', "games"));
	}

	public function delete($id = null)
	{
		$this->Pot->id = $id;
		if (!$this->Pot->exists()) {
			throw new NotFoundException(__('Invalid Pot'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pot->delete()) {
			$this->Session->setFlash(__('L\'idee à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pot was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}


	function import()
	{
		ini_set('memory_limit', '-1');
		set_time_limit(-1);
		if ($this->request->is('post')) {
			$file = $this->request->data['Pot']['file']['tmp_name'];
			$ext = explode(".", $this->request->data['Pot']['file']['name']);
			$ext = $ext[count($ext) - 1];
			if (!empty($file)) {
				$this->request->data['Pot']['file'] = "client.$ext";
				move_uploaded_file($file, 'img/' . $this->request->data['Pot']['file']);
			} else {
				$this->Session->setFlash(__('Merci de joindre un fichier'));
				return $this->redirect(array('action' => 'import'));
			}

			require_once 'Component/simplexlsx.php';

			if ($xlsx = SimpleXLSX::parse(WWW_ROOT . 'img/client.xlsx')) {
				$skip_first_line = 0;

				foreach ($xlsx->rows() as $r) {
					$skip_first_line++;
					if ($skip_first_line == 1)
						continue;

					$d = array();
					$comma_separated = implode("||", $r);
					$rr = str_replace("'", "\'", $comma_separated);
					$r = explode("||", $rr);

					$this->Pot->create();
					$d["Pot"]["user_id"] = $this->request->data["Pot"]["user_id"];
					$d["Pot"]["game_id"] = $this->request->data["Pot"]["game_id"];
					$d["Pot"]["client_id"] = $r[0];
					$d["Pot"]["nb_patient"] = $r[1];
					$d["Pot"]["pot_patient"] = $r[2];
					$d["Pot"]["nb_indication"] = $r[3];
					$d["Pot"]["pot_indication"] = $r[4];
					$d["Pot"]["nb_prescription"] = $r[5];
					$d["Pot"]["pot_prescription"] = $r[6];
					$this->Pot->save($d);
					//debug($d);exit();
				}
			} else {
				echo SimpleXLSX::parseError();
				echo "erreur";
				exit();
			}

			$this->Session->setFlash("Importation terminer avec $skip_first_line insertion ");
		}
		$this->loadModel('User');
		$this->loadModel('Game');

		$users = $this->User->find('list');
		$games = $this->Game->find('list');
		$this->set(compact('users', "games"));
	}
}
