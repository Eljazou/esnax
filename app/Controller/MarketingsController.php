<?php
App::uses('AppController', 'Controller');
/**
 * Marketings Controller
 *
 * @property Marketing $Marketing
 * @property PaginatorComponent $Paginator
 */
class MarketingsController extends AppController
{



	/**
	 * index method
	 *
	 * @return void
	 */

	function ajouter_consomation()
	{
		if ($this->request->is('post')) {
			$this->Marketing->MarDetail->create();
			$d = array();
			$d["MarDetail"] = $this->request->data["Marketing"];
			$d["MarDetail"]["user_id"] = AuthComponent::user("id");
			$this->Marketing->MarDetail->save($d);
			$this->Session->setFlash(__('L\'action à été enregistré'));
			return $this->redirect(array('action' => 'index'));
		}
	}

	function supprimer_consomation($id)
	{
		$this->Marketing->MarDetail->id = $id;
		$this->Marketing->MarDetail->delete();
		$this->Session->setFlash(__('L\'action à été supprimer'));
		return $this->redirect(array('action' => 'index'));
	}

	public function index($annee = 0, $gammes_ok = 0, $return = null)
	{
		if ($gammes_ok == 0)
			$gammes_ok = array();
		else
			$gammes_ok = explode(",", $gammes_ok);

		if ($annee == 0)
			$annee = date("Y");

		$this->loadModel("Gadjet");
		$this->loadModel("Action");
		$this->loadModel("Apartient");
		$this->loadModel("Pack");
		$this->Apartient->recursive = -1;
		$this->Marketing->recursive = 1;


		if (AuthComponent::user("role") == "VMP") {
			$this->Session->setFlash("Erreur de navigation, merci de contacter administration");
			return $this->redirect(array("controller" => "users", 'action' => 'view'));
		}
		if (AuthComponent::user("role") == "Super viseur") {
			$marketings = $this->Marketing->find("all", array("conditions" => array("Marketing.user_id" => AuthComponent::user("id"), "Marketing.annee" => $annee), "order" => array("Marketing.id asc")));

			$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'), 'Apartient.type' => "Normal")));
			$ids = AuthComponent::user('id');

			foreach ($users as $value)
				$ids = $ids . ',' . $value["Apartient"]['user1_id'];

			$echantients = $this->Gadjet->find("all", array("conditions" => array("YEAR(Gadjet.created)='$annee'", "Gadjet.user_id in($ids)")));
			$actions = $this->Action->find("all", array("conditions" => array("YEAR(Action.date_debut)='$annee'", "Action.user_id in($ids)", "Action.archive" => 2)));
			$packs = $this->Pack->find("all", array("conditions" => array("YEAR(Pack.created)='$annee'", "Pack.user_id in($ids)", "Pack.valide" => 1)));
		} else {
			$asmId = AuthComponent::user('id');
			$superviseurs = $this->Apartient->find('all', array(
				'conditions' => array(
					'Apartient.user_id' => $asmId,
					'Apartient.type' => "ASM"
				)
			));

			$superviseurIds = array();
			foreach ($superviseurs as $sup) {
				$superviseurIds[] = $sup["Apartient"]["user1_id"];
			}

			$allIds = $superviseurIds;
			foreach ($superviseurIds as $supId) {
				$vms = $this->Apartient->find('all', array(
					'conditions' => array(
						'Apartient.user_id' => $supId,
						'Apartient.type' => "normal"
					)
				));
				foreach ($vms as $vm) {
					$allIds[] = $vm["Apartient"]["user1_id"];
				}
			}

			// ✅ If no supervisors found (admin), fetch everything unscoped
			if (empty($superviseurIds)) {
				$marketings = $this->Marketing->find("all", array(
					"conditions" => array("Marketing.annee" => $annee),
					"order" => array("Marketing.id asc")
				));
				$echantients = $this->Gadjet->find("all", array(
					"conditions" => array("YEAR(Gadjet.created)='$annee'")
				));
				$actions = $this->Action->find("all", array(
					"conditions" => array("YEAR(Action.date_debut)='$annee'", "Action.archive" => 2)
				));
				$packs = $this->Pack->find("all", array(
					"conditions" => array("YEAR(Pack.created)='$annee'", "Pack.valide" => 1)
				));
			} else {
				// ASM: scoped to their supervisors + VMs
				$ids = implode(",", $allIds);
				$marketings = $this->Marketing->find("all", array(
					"conditions" => array(
						"Marketing.user_id" => $superviseurIds,
						"Marketing.annee" => $annee
					),
					"order" => array("Marketing.id asc")
				));
				$echantients = $this->Gadjet->find("all", array(
					"conditions" => array(
						"YEAR(Gadjet.created)='$annee'",
						"Gadjet.user_id in($ids)"
					)
				));
				$actions = $this->Action->find("all", array(
					"conditions" => array(
						"YEAR(Action.date_debut)='$annee'",
						"Action.user_id in($ids)",
						"Action.archive" => 2
					)
				));
				$packs = $this->Pack->find("all", array(
					"conditions" => array(
						"YEAR(Pack.created)='$annee'",
						"Pack.user_id in($ids)",
						"Pack.valide" => 1
					)
				));
			}
		}

		$listgammes = $this->Marketing->Game->find("list", array("fields" => array("Game.name", "Game.id")));
		$actionss = array();
		$i = 0;
		foreach ($actions as $ii => $action) {

			$gammes = explode(",", $action["Action"]["game_id"]);
			array_pop($gammes);
			foreach ($gammes as $k => $gamme) {
				if (!in_array($listgammes[$gamme], $gammes_ok) && count($gammes_ok) !== 0)
					continue;
				$actionss[$i]["user_id"] = $action["User"]["id"];
				$actionss[$i]["id"] = $action["Action"]["id"];
				$actionss[$i]["user_name"] = $action["User"]["name"];
				$actionss[$i]["client"] = $action["Client"]["nom"] . " " . $action["Client"]["prenom"];
				$actionss[$i]["pot"] = $action["Client"]["potentialite"];
				$actionss[$i]["ligne_id"] = $action["User"]["ligne_id"];
				$actionss[$i]["date_debut"] = $action["Action"]["date_debut"];
				$actionss[$i]["date_fin"] = $action["Action"]["date_fin"];
				// action is nemeric and not null
				$nb = max(1, count($gammes));
				$value = is_numeric($action["Action"]["name"]) ? (float)$action["Action"]["name"] : 0;
				$actionss[$i]["valeur"] = floor($value / $nb);
				// end action is nemeric and not null
				$actionss[$i]["description"] = $action["Action"]["description"];
				//echo floor($action["Action"]["name"]/count($gammes));exit();
				$actionss[$i]["nature"] = $action["Action"]["nature"];
				$actionss[$i]["gamme"] = $listgammes[$gamme];
				$i++;
			}
		}
		$actions = $actionss;

		//pour les packs
		$listgammes = $this->Marketing->Game->find("list");
		$packss = array();
		$i = 0;
		foreach ($packs as $pack) {
			foreach ($pack["Packdetail"] as $v) {
				$packss[$i]["user_id"] = $pack["User"]["id"];
				$packss[$i]["user_name"] = $pack["User"]["name"];
				$packss[$i]["client"] = $pack["Client"]["nom"] . " " . $pack["Client"]["prenom"];
				$packss[$i]["ligne_id"] = $pack["User"]["ligne_id"];
				$packss[$i]["nombre"] = $pack["Pack"]["nombre"];
				$packss[$i]["gamme"] = $v["game_id"];
				$packss[$i]["nombre_gamme"] = $v["nombre"];
				$i++;
			}
		}
		$packs = $packss;


		//debug($echantients);//exit();
		$data = array();

		foreach ($marketings as $mar) {
			if (!in_array($mar["Marketing"]["game_id"], $gammes_ok) && count($gammes_ok) !== 0)
				continue;

			$user_id = $mar["Marketing"]["user_id"];
			$ligne = "1"; //$mar["Marketing"]["ligne_id"];
			$gamme = $mar["Marketing"]["game_id"];


			if (!isset($data[$user_id][$ligne][$gamme])) {
				$data[$user_id][$ligne][$gamme] = $mar["Marketing"];
				$data[$user_id][$ligne][$gamme]["echantillons_c"] = "0";
				$data[$user_id][$ligne][$gamme]["actions_c"] = "0";
				$data[$user_id][$ligne][$gamme]["packs_c"] = "0";
				$data[$user_id][$ligne][$gamme]["ca_c"] = "0";
				$data[$user_id][$ligne][$gamme]["budget_c"] = "0";
				$data[$user_id][$ligne][$gamme]["detail"] = $mar["MarDetail"];
			}
			//recupéré la liste des vm d'un superviseur
			$this->Apartient->recursive = 1;
			$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $user_id, 'Apartient.type' => "Normal")));
			$ids = AuthComponent::user('id');
			$superr["User1"]["id"] = $user_id;
			array_unshift($users, $superr);
			$ech = 0;
			$detailechaentients = array();
			foreach ($echantients as $echantient) {
				foreach ($users as $user) {
					if ($echantient["Echantillon"]["game_id"] == $gamme && $user["User1"]["id"] == $echantient["Gadjet"]["user_id"]) //&&  $user["User1"]["ligne_id"]==$ligne)
					{
						$ech = $ech + $echantient["Gadjet"]["quantite"];
						$detail = array();
						$detail["Echantillon"]["name"] = $echantient["Echantillon"]["name"];
						$detail["Echantillon"]["user"] = $echantient["User"]["name"];
						$detail["Echantillon"]["quantite"] = $echantient["Gadjet"]["quantite"];
						$detail["Echantillon"]["date"] = $echantient["Gadjet"]["created"];
						$detailechaentients[] = $detail;
					}
				}
			}


			//debug($ech);
			$data[$user_id][$ligne][$gamme]["echantillons_c"] = $ech;
			$data[$user_id][$ligne][$gamme]["echantillons_detail"] = $detailechaentients;
			//---------------------------Debut actions-----------------------------------//
			$detailsaction = array();
			$totalaction = 0;

			foreach ($actions as $action) {
				foreach ($users as $user) {
					if ($action["gamme"] == $gamme && $user["User1"]["id"] == $action["user_id"]) //&& $action["ligne_id"]==$ligne)
					{

						$totalaction = $totalaction + $action["valeur"];
						$detailsaction[] = $action;
					}
				}
			}
			$data[$user_id][$ligne][$gamme]["actions_c"] = $totalaction;
			$data[$user_id][$ligne][$gamme]["action_detail"] = $detailsaction;
			//----------------------Fin des actions --------------------------//
			//---------------------------Debut packs--------------------------------//
			$detailspacks = array();
			$totalpacks = 0;
			foreach ($packs as $pack) {
				foreach ($users as $user) {
					if ($pack["gamme"] == $gamme && $user["User1"]["id"] == $pack["user_id"]) //&& $pack["ligne_id"]==$ligne)
					{
						$totalpacks = $totalpacks + $pack["nombre_gamme"];
						$detailspacks[] = $pack;
					}
				}
			}
			$data[$user_id][$ligne][$gamme]["packs_c"] = $totalpacks;
			$data[$user_id][$ligne][$gamme]["pack_detail"] = $detailspacks;
			//debug($detailsaction);
			//----------------------Fin des actions --------------------------//
			foreach ($mar["MarDetail"] as $detail) {
				/*if($detail["type"]=="echantillons")
					$data[$user_id][$ligne][$gamme]["echantillons_c"]=$data[$user_id][$ligne][$gamme]["echantillons_c"]+$detail["consomation"];
				if($detail["type"]=="actions")			
					$data[$user_id][$ligne][$gamme]["actions_c"]=$data[$user_id][$ligne][$gamme]["actions_c"]+$detail["consomation"];
				*/
				//if($detail["type"]=="packs")
				//	$data[$user_id][$ligne][$gamme]["packs_c"]=$data[$user_id][$ligne][$gamme]["packs_c"]+$detail["consomation"];
				if ($detail["type"] == "budget")
					$data[$user_id][$ligne][$gamme]["budget_c"] = $data[$user_id][$ligne][$gamme]["budget_c"] + $detail["consomation"];
				if ($detail["type"] == "ca")
					$data[$user_id][$ligne][$gamme]["ca_c"] = $data[$user_id][$ligne][$gamme]["ca_c"] + $detail["consomation"];
			}
		}
		//exit();
		$global = $globals_generale = array();
		//inislaisation 

		foreach ($data as $user_id => $lignes) {
			foreach ($lignes as $ligne => $gammes) {
				foreach ($gammes as $gamme => $d) {
					if (!in_array($gamme, $gammes_ok) && count($gammes_ok) !== 0)
						continue;
					if (!isset($global[$user_id])) {
						$global[$user_id]["echantillons"] = 0;
						$global[$user_id]["actions"] = 0;
						$global[$user_id]["packs"] = 0;
						$global[$user_id]["ca"] = "0";
						$global[$user_id]["budget"] = "0";
						$global[$user_id]["echantillons_c"] = "0";
						$global[$user_id]["actions_c"] = "0";
						$global[$user_id]["packs_c"] = "0";
						$global[$user_id]["ca_c"] = "0";
						$global[$user_id]["budget_c"] = "0";
						$global[0]["echantillons"] = 0;
						$global[0]["actions"] = 0;
						$global[0]["packs"] = 0;
						$global[0]["ca"] = "0";
						$global[0]["budget"] = "0";
						$global[0]["echantillons_c"] = "0";
						$global[0]["actions_c"] = "0";
						$global[0]["packs_c"] = "0";
						$global[0]["ca_c"] = "0";
						$global[0]["budget_c"] = "0";
					}


					$global[$user_id]["echantillons"] += (int)($data[$user_id][$ligne][$gamme]["echantillons"] ?? 0);
					$global[$user_id]["actions"] = $global[$user_id]["actions"] + $data[$user_id][$ligne][$gamme]["actions"];
					$global[$user_id]["packs"] = $global[$user_id]["packs"] + $data[$user_id][$ligne][$gamme]["packs"];
					$global[$user_id]["ca"] = $global[$user_id]["ca"] + $data[$user_id][$ligne][$gamme]["ca"];
					$global[$user_id]["budget"] = $global[$user_id]["budget"] + $data[$user_id][$ligne][$gamme]["budget"];
					$global[$user_id]["echantillons_c"] = $global[$user_id]["echantillons_c"] + $data[$user_id][$ligne][$gamme]["echantillons_c"];
					$global[$user_id]["actions_c"] = $global[$user_id]["actions_c"] + $data[$user_id][$ligne][$gamme]["actions_c"];
					$global[$user_id]["packs_c"] = $global[$user_id]["packs_c"] + $data[$user_id][$ligne][$gamme]["packs_c"];
					$global[$user_id]["ca_c"] = $global[$user_id]["ca_c"] + $data[$user_id][$ligne][$gamme]["ca_c"];
					$global[$user_id]["budget_c"] = $global[$user_id]["budget_c"] + $data[$user_id][$ligne][$gamme]["budget_c"];

					$global[0]["echantillons"] += (int)($data[$user_id][$ligne][$gamme]["echantillons"] ?? 0);
					$global[0]["actions"] = $global[0]["actions"] + $data[$user_id][$ligne][$gamme]["actions"];
					$global[0]["packs"] = $global[0]["packs"] + $data[$user_id][$ligne][$gamme]["packs"];
					$global[0]["ca"] = $global[0]["ca"] + $data[$user_id][$ligne][$gamme]["ca"];
					$global[0]["budget"] = $global[0]["budget"] + $data[$user_id][$ligne][$gamme]["budget"];
					$global[0]["echantillons_c"] = $global[0]["echantillons_c"] + $data[$user_id][$ligne][$gamme]["echantillons_c"];
					$global[0]["actions_c"] = $global[0]["actions_c"] + $data[$user_id][$ligne][$gamme]["actions_c"];
					$global[0]["packs_c"] = $global[0]["packs_c"] + $data[$user_id][$ligne][$gamme]["packs_c"];
					$global[0]["ca_c"] = $global[0]["ca_c"] + $data[$user_id][$ligne][$gamme]["ca_c"];
					$global[0]["budget_c"] = $global[0]["budget_c"] + $data[$user_id][$ligne][$gamme]["budget_c"];


					//global de globals_generale
					$keys = array("pack_detail", "action_detail", "echantillons_detail", "detail");
					foreach ($keys as $key) {
						if (!isset($globals_generale[0][$ligne][$gamme][$key])) {
							$globals_generale[0][$ligne][$gamme][$key] = array();
						}
					}
					$keys = array("echantillons", "actions", "packs", 'ca', 'budget', "echantillons_c", "actions_c", "packs_c", "ca_c", "budget_c");
					foreach ($keys as $key) {
						if (!isset($globals_generale[0][$ligne][$gamme][$key])) {
							$globals_generale[0][$ligne][$gamme][$key] = 0;
						}
					}
					$globals_generale[0][$ligne][$gamme]["user_id"] = 1;
					$globals_generale[0][$ligne][$gamme]["ligne_id"] = 1;
					$globals_generale[0][$ligne][$gamme]["game_id"] = 1;
					$globals_generale[0][$ligne][$gamme]['annee'] = date("Y");
					$globals_generale[0][$ligne][$gamme]['id'] = $mar["Marketing"]["id"];



					if ($data[$user_id][$ligne][$gamme]['user_id'] != 2) {
						$globals_generale[0][$ligne][$gamme]["echantillons"] = $globals_generale[0][$ligne][$gamme]["echantillons"] + $data[$user_id][$ligne][$gamme]["echantillons"];
						$globals_generale[0][$ligne][$gamme]["actions"] = $globals_generale[0][$ligne][$gamme]["actions"] + $data[$user_id][$ligne][$gamme]["actions"];
						$globals_generale[0][$ligne][$gamme]["packs"] = $globals_generale[0][$ligne][$gamme]["packs"] + $data[$user_id][$ligne][$gamme]["packs"];
						$globals_generale[0][$ligne][$gamme]["ca"] = $globals_generale[0][$ligne][$gamme]["ca"] + $data[$user_id][$ligne][$gamme]["ca"];
						$globals_generale[0][$ligne][$gamme]["budget"] = $globals_generale[0][$ligne][$gamme]["budget"] + $data[$user_id][$ligne][$gamme]["budget"];
						$globals_generale[0][$ligne][$gamme]["echantillons_c"] = $globals_generale[0][$ligne][$gamme]["echantillons_c"] + $data[$user_id][$ligne][$gamme]["echantillons_c"];
						$globals_generale[0][$ligne][$gamme]["actions_c"] = $globals_generale[0][$ligne][$gamme]["actions_c"] + $data[$user_id][$ligne][$gamme]["actions_c"];
						$globals_generale[0][$ligne][$gamme]["packs_c"] = $globals_generale[0][$ligne][$gamme]["packs_c"] + $data[$user_id][$ligne][$gamme]["packs_c"];
						$globals_generale[0][$ligne][$gamme]["ca_c"] = $globals_generale[0][$ligne][$gamme]["ca_c"] + $data[$user_id][$ligne][$gamme]["ca_c"];
						$globals_generale[0][$ligne][$gamme]["budget_c"] = $globals_generale[0][$ligne][$gamme]["budget_c"] + $data[$user_id][$ligne][$gamme]["budget_c"];



						// merge the arrays
						$globals_generale[0][$ligne][$gamme]["pack_detail"] = array_merge(
							$globals_generale[0][$ligne][$gamme]["pack_detail"],
							$data[$user_id][$ligne][$gamme]["pack_detail"]
						);
						$globals_generale[0][$ligne][$gamme]["action_detail"] = array_merge(
							$globals_generale[0][$ligne][$gamme]["action_detail"],
							$data[$user_id][$ligne][$gamme]["action_detail"]
						);
						$globals_generale[0][$ligne][$gamme]["echantillons_detail"] = array_merge(
							$globals_generale[0][$ligne][$gamme]["echantillons_detail"],
							$data[$user_id][$ligne][$gamme]["echantillons_detail"]
						);
						$globals_generale[0][$ligne][$gamme]["detail"] = array_merge(
							$globals_generale[0][$ligne][$gamme]["detail"],
							$data[$user_id][$ligne][$gamme]["detail"]
						);
					}
				}
			}
		}
		//debug($global);
		//debug($actions);

		$lignes = $this->Marketing->Ligne->find('list');
		$games = $this->Marketing->Game->find('list', array("conditions" => array("Game.archive" => 1)));
		// $games = $this->Marketing->Game->find('list');
		$users = $this->Marketing->User->find('list', array("conditions" => array("User.archive" => 1)));
		$this->loadModel("Echantillon");
		$this->Echantillon->recursive = -1;
		$echantillont = $this->Echantillon->find('all');
		$marketings = array();
		$marketings[0] = $globals_generale[0] ?? [];
		foreach ($data as $k => $v)
			$marketings[$k] = $v;

		if ($return != null) {
			$data = array();
			$data["marketings"] = $marketings;
			$data["lignes"] = $lignes;
			$data["games"] = $games;
			$data["users"] = $users;
			$data["global"] = $global;
			$data["globals_generale"] = $globals_generale;
			//$data["echantillonts"]=$echantillonts;
			$data["annee"] = $annee;
		}
		$this->set(compact("marketings", 'lignes', 'games', 'users', "global", "globals_generale", "annee"));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null)
	{
		if (!$this->Marketing->exists($id)) {
			throw new NotFoundException(__('Invalid marketing'));
		}
		$options = array('conditions' => array('Marketing.' . $this->Marketing->primaryKey => $id));
		$this->set('marketing', $this->Marketing->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			foreach ($this->request->data["data"] as $d) {
				$dd = array();
				$dd["Marketing"] = array();
				if ($d["echantillons"] == 0 && $d["actions"] == 0 && $d["packs"] == 0)
					continue;
				$dd["Marketing"] = $d;
				$dd["Marketing"]["user_id"] = $this->request->data["Marketing"]["user_id"];
				$dd["Marketing"]["annee"] = $this->request->data["Marketing"]["annee"];
				$this->Marketing->create();
				$this->Marketing->save($dd);
			}
			$this->Session->setFlash(__('L\'action à été enregistré'));
			return $this->redirect(array('action' => 'index'));
		}
		$lignes = $this->Marketing->Ligne->find('list');
		$games = $this->Marketing->Game->find('list', array("conditions" => array("Game.archive" => 1)));
		$users = $this->Marketing->User->find('list', array("conditions" => array("User.role" => "Super viseur", "User.archive" => 1)));
		$this->set(compact('lignes', 'games', 'users'));
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
		if (!$this->Marketing->exists($id)) {
			throw new NotFoundException(__('Invalid marketing'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Marketing->save($this->request->data)) {
				$this->Session->setFlash(__('L\'action à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The marketing could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Marketing.' . $this->Marketing->primaryKey => $id));
			$this->request->data = $this->Marketing->find('first', $options);
		}
		$lignes = $this->Marketing->Ligne->find('list');
		$games = $this->Marketing->Game->find('list');
		$users = $this->Marketing->User->find('list', array("conditions" => array("User.role" => "Super viseur", "User.archive" => 1)));
		$this->set(compact('lignes', 'games', 'users'));
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		$this->Marketing->id = $id;
		if (!$this->Marketing->exists()) {
			throw new NotFoundException(__('Invalid marketing'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Marketing->delete()) {
			$this->Session->setFlash(__('La Marketing à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Marketing was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
