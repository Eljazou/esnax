<?php

App::uses('AppController', 'Controller');

/**
 * Rapports Controller
 *
 * @property Rapport $Rapport
 * @property PaginatorComponent $Paginator
 */
class RapportsController extends AppController
{


	function beforeFilter()
	{

		parent::beforeFilter();
		$this->Auth->allow('index_vmp', 'index_dsm'); //,'system_get_superviseur','system_get_name_user');
	}
	/**
	 * Components
	 *
	 * @var array
	 */

	function viewsp($id)
	{
		$rapport = $this->Rapport->findById($id);
		$this->set(compact("rapport"));
	}
	function editsp($id)
	{
		if (!$this->Rapport->exists($id)) {
			throw new NotFoundException(__('Invalid rapport'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$date = explode(" -- ", $this->request->data['Rapport']['date']);
			$this->request->data['Rapport']['date_debut'] = $date[0];
			$this->request->data['Rapport']['date_fin'] = $date[1];

			if ($this->Rapport->save($this->request->data)) {
				$this->Session->setFlash(__('Rapport modifié'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Le rapport n\'a pas été modifié.Merci de réessayer.'));
			}
		}
		$options = array('conditions' => array('Rapport.id' => $id));
		$this->request->data = $this->Rapport->find('first', $options);
	}
	function addsp()
	{
		if ($this->request->is('post')) {
			$this->Rapport->create();
			$date = explode(" -- ", $this->request->data['Rapport']['date']);
			$this->request->data['Rapport']['date_debut'] = $date[0];
			$this->request->data['Rapport']['date_fin'] = $date[1];
			$this->request->data['Rapport']['user_id'] = AuthComponent::user('id');
			$this->request->data['Rapport']['archive'] = 1;

			if (isset($this->request->data['poa']))
				$this->request->data['Rapport']['actions'] = json_encode($this->request->data['poa']);

			if (isset($this->request->data['taux_realis_objectif']))
				$this->request->data['Rapport']['produits'] = json_encode($this->request->data['taux_realis_objectif']);
			// debug($this->request->data);exit;
			// Handle second file upload (file_terrain)
			if (!empty($this->request->data['Rapport']['file_terrain']) && is_array($this->request->data['Rapport']['file_terrain'])) {
				$uploadedFiles = [];

				// Define upload directory
				$uploadDir = WWW_ROOT . 'files' . DS . 'rapports' . DS;

				// Create directory if it doesn't exist
				if (!file_exists($uploadDir)) {
					mkdir($uploadDir, 0777, true);
				}

				// Loop through each uploaded file
				foreach ($this->request->data['Rapport']['file_terrain'] as $fileIndex => $fileData) {
					// Skip empty uploads
					if (empty($fileData['tmp_name']) || $fileData['error'] != 0) {
						continue;
					}

					// Generate unique filename
					$uniqueFilename = time() . '_' . $fileIndex . '_terrain_' . $fileData['name'];
					$uploadFile = $uploadDir . $uniqueFilename;

					// Move uploaded file
					if (move_uploaded_file($fileData['tmp_name'], $uploadFile)) {
						// Save file path to array
						$uploadedFiles[] = 'files/rapports/' . $uniqueFilename;
					} else {
						$this->Session->setFlash(__('Erreur lors du téléchargement d\'un ou plusieurs fichiers'));
						return;
					}
				}

				// Store file paths as JSON in database
				if (!empty($uploadedFiles)) {
					$this->request->data['Rapport']['file_terrain'] = json_encode($uploadedFiles);
				}

				if (empty($uploadedFiles)) {
					unset($this->request->data['Rapport']['file_terrain']);
				}
			}



			// Save data
			if ($this->Rapport->save($this->request->data)) {
				$this->Session->setFlash(__('Rapport Ajouté'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Erreur lors de l\'enregistrement du rapport'));
			}
		}

		$this->loadModel("Produit");
		$this->Produit->recursive = -1;
		$produits = $this->Produit->find("list", array("conditions" => array("Produit.archive" => 1)));
		$this->set(compact("produits"));
	}

	function visites()
	{
		$date_debut = date('Y-m-d 00:00', strtotime(date('Y-m-d') . ' -10 days'));
		$date_fin = date("Y-m-d 23:59");
		// if (AuthComponent::user('role') == "Admin")
		// {
		// if (isset($_GET['date'])) {
		// $date = $_GET['date'];
		// $date = explode('--', $date);
		// $date_debut = $date[0];
		// $date_fin = $date[1];
		// }
		// }
		$this->loadModel('Apartient');
		$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
		$ids = AuthComponent::user('id');
		foreach ($users as $value)
			$ids = $ids . ',' . $value["Apartient"]['user1_id'];
		$this->loadModel("Visite");
		if (AuthComponent::user('role') == "Admin" || AuthComponent::user('role') == 'Ressource humain' || AuthComponent::user('role') == "Responsable promotion")
			$visites = $this->Visite->find('all', array('conditions' => array('Visite.archive' => 1, "Visite.date between '$date_debut' and '$date_fin'"), "order" => array('Visite.user_id desc ,Visite.date asc')));
		else
			$visites = $this->Visite->find('all', array('conditions' => array('Visite.archive' => 1, "Visite.date between '$date_debut' and '$date_fin'", " Visite.user_id in ($ids)"), "order" => array('Visite.user_id desc ,Visite.date asc')));
		$this->loadModel('Type');
		$types =  $this->Type->find('list');
		$this->loadModel('Category');
		$categories =  $this->Category->find('list');
		$this->set(compact("date_debut", "date_fin", "visites", "types", "categories"));
	}


	public function index($date = null)
	{
		$date_debut = '';
		$date_fin = '';

		// Handle POST request first (filter submission)
		if ($this->request->is('post')) {
			$date = $this->request->data['date'];
			$type_user = $this->request->data['type_user'];

			if ($type_user == 'DSM') {
				return $this->redirect(array('action' => 'index_dsm', '?' => array('date' => $date)));
			} else if ($type_user == 'VMP') {
				return $this->redirect(array('action' => 'index_vmp', '?' => array('date' => $date)));
			} else {
				// Redirect to index with date parameter
				return $this->redirect(array('action' => 'index', str_replace(' ', '', $date)));
			}
		}

		// Handle date parameter
		if ($date == null) {
			$date_debut = date("Y-m-01 00:00");
			$date_fin = date("Y-m-31 23:59");
		} else {
			$date = explode('--', $date);
			$date_debut = trim($date[0]);
			$date_fin = trim($date[1]);
		}

		$this->Rapport->recursive = 0;

		$this->loadModel('Ligne');
		$this->loadModel('RapportConcurance');
		$this->loadModel('Produit');

		if (AuthComponent::user('role') == "Admin" || AuthComponent::user('role') == 'Ressource humain' || AuthComponent::user('role') == "Responsable promotion") {
			$rapports = $this->Rapport->find('all', [
				'conditions' => [
					'Rapport.archive' => 1,
					"Rapport.date_debut <" => "$date_fin 23:59",
					"Rapport.date_fin >" => $date_debut
				],
				'order' => ['Rapport.created DESC']
			]);
		} else if (AuthComponent::user('role') == "Super viseur") {
			$this->loadModel("Apartient");
			$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
			$ids = AuthComponent::user('id');
			foreach ($users as $value)
				$ids = $ids . ',' . $value["Apartient"]['user1_id'];
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59' and Rapport.user_id in($ids)"), "order" => array('Rapport.created desc')));
		} else {
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59'", "Rapport.user_id" => AuthComponent::user('id')), "order" => array('Rapport.created desc')));
		}

		foreach ($rapports as &$rapport) {
			/* ---------- LIGNE ---------- */
			if (!empty($rapport['User']['ligne_id'])) {
				$ligne = $this->Ligne->find('first', [
					'conditions' => ['Ligne.id' => $rapport['User']['ligne_id']],
					'fields' => ['Ligne.name'],
					'recursive' => -1
				]);
				$rapport['Rapport']['ligne_name'] = !empty($ligne['Ligne']['name']) ? $ligne['Ligne']['name'] : null;
			}

			/* ---------- CONCURRENCES ---------- */
			$rapport['Rapport']['concurances'] = '';
			$rapport['Rapport']['our_produits'] = '';
			$rapport['Rapport']['agressivite'] = '';
			$rapport['Rapport']['type_offre'] = '';
			$rapport['Rapport']['offre'] = '';
			$rapport['Rapport']['commentaires'] = '';

			$rapport_concurances = $this->RapportConcurance->find('all', [
				'conditions' => ['RapportConcurance.rapport_id' => $rapport['Rapport']['id']],
				'recursive' => -1
			]);
			$produits = $this->Produit->find('list', [
				'fields' => ['Produit.id', 'Produit.name'],
				'recursive' => -1
			]);

			$our_products = [];

			foreach ($rapport_concurances as $concurance) {
				if (!empty($concurance['RapportConcurance']['produit_id']) && isset($produits[$concurance['RapportConcurance']['produit_id']])) {
					$our_products[] = $produits[$concurance['RapportConcurance']['produit_id']];
				}

				if (!empty($concurance['RapportConcurance']['produit_concurant'])) {
					$rapport['Rapport']['concurances'] .= ($rapport['Rapport']['concurances'] ? '; ' : '') . $concurance['RapportConcurance']['produit_concurant'];
				}

				if (!empty($concurance['RapportConcurance']['agressivite'])) {
					$rapport['Rapport']['agressivite'] .= ($rapport['Rapport']['agressivite'] ? '; ' : '') . $concurance['RapportConcurance']['agressivite'];
				}

				if (!empty($concurance['RapportConcurance']['type_offre'])) {
					$rapport['Rapport']['type_offre'] .= ($rapport['Rapport']['type_offre'] ? '; ' : '') . $concurance['RapportConcurance']['type_offre'];
				}

				if (!empty($concurance['RapportConcurance']['offre'])) {
					$rapport['Rapport']['offre'] .= ($rapport['Rapport']['offre'] ? '; ' : '') . $concurance['RapportConcurance']['offre'];
				}

				if (!empty($concurance['RapportConcurance']['commentaire'])) {
					$rapport['Rapport']['commentaires'] .= ($rapport['Rapport']['commentaires'] ? '; ' : '') . $concurance['RapportConcurance']['commentaire'];
				}
			}

			$rapport['Rapport']['our_produits'] = implode('; ', $our_products);
		}

		$this->set(compact("date_debut", "date_fin", "rapports"));
	}


	public function index_dsm($date = null)
	{
		//$date_debut = date("Y-m-01 00:00");
		//$date_fin = date("Y-m-31 23:59");
		$date_debut = '';
		$date_fin = '';
		if (isset($_GET['date'])) {
			$date = $_GET['date'];
			$date = explode('--', $date);
			$date_debut = $date[0];
			$date_fin = $date[1];
		}
		$this->Rapport->recursive = 0;

		$this->loadModel('Ligne');
		$this->loadModel('RapportConcurance');
		$this->loadModel('Produit');

		$user_dsm = $this->Rapport->User->find('list', [
			'conditions' => ['User.role' => 'Super viseur'],
			'fields' => ['User.id']
		]);

		$ids = implode(',', array_keys($user_dsm));

		if (AuthComponent::user('role') == "Admin" || AuthComponent::user('role') == 'Ressource humain' || AuthComponent::user('role') == "Responsable promotion") {

			$rapports = $this->Rapport->find('all', [
				'conditions' => [
					'Rapport.archive' => 1,
					"Rapport.date_debut <" => "$date_fin 23:59",
					"Rapport.date_fin >"   => $date_debut,
					"Rapport.user_id in($ids)"
				],
				'order' => ['Rapport.created DESC']
			]);
		} else if (AuthComponent::user('role') == "Super viseur") {
			//$ids = '0';
			$ids = AuthComponent::user('id');
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59' and Rapport.user_id in($ids)"), "order" => array('Rapport.created desc')));
		} else {
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59'", "Rapport.user_id" => AuthComponent::user('id')), "order" => array('Rapport.created desc')));
		}




		foreach ($rapports as &$rapport) {

			/* ---------- LIGNE ---------- */
			if (!empty($rapport['User']['ligne_id'])) {

				$ligne = $this->Ligne->find('first', [
					'conditions' => ['Ligne.id' => $rapport['User']['ligne_id']],
					'fields'     => ['Ligne.name'],
					'recursive'  => -1
				]);

				$rapport['Rapport']['ligne_name'] =
					!empty($ligne['Ligne']['name']) ? $ligne['Ligne']['name'] : null;
			}

			/* ---------- CONCURRENCES ---------- */
			$rapport['Rapport']['concurances'] = '';
			$rapport['Rapport']['our_produits']    = '';
			$rapport['Rapport']['agressivite'] = '';
			$rapport['Rapport']['type_offre'] = '';
			$rapport['Rapport']['offre'] = '';
			$rapport['Rapport']['commentaires'] = '';

			$rapport_concurances = $this->RapportConcurance->find('all', [
				'conditions' => ['RapportConcurance.rapport_id' => $rapport['Rapport']['id']],
				'recursive'  => -1
			]);
			$produits = $this->Produit->find('list', [
				'fields' => ['Produit.id', 'Produit.name'],
				'recursive' => -1
			]);

			$our_products = [];

			foreach ($rapport_concurances as $concurance) {

				// our products
				if (!empty($concurance['RapportConcurance']['produit_id']) && isset($produits[$concurance['RapportConcurance']['produit_id']])) {
					$our_products[] = $produits[$concurance['RapportConcurance']['produit_id']];
				}

				// concurrent products (FIXED .=)
				if (!empty($concurance['RapportConcurance']['produit_concurant'])) {
					$rapport['Rapport']['concurances'] .=
						($rapport['Rapport']['concurances'] ? '; ' : '') .
						$concurance['RapportConcurance']['produit_concurant'];
				}

				// agressivite
				if (!empty($concurance['RapportConcurance']['agressivite'])) {
					$rapport['Rapport']['agressivite'] .=
						($rapport['Rapport']['agressivite'] ? '; ' : '') .
						$concurance['RapportConcurance']['agressivite'];
				}
				// type_offre
				if (!empty($concurance['RapportConcurance']['type_offre'])) {
					$rapport['Rapport']['type_offre'] .=
						($rapport['Rapport']['type_offre'] ? '; ' : '') .
						$concurance['RapportConcurance']['type_offre'];
				}
				// offre
				if (!empty($concurance['RapportConcurance']['offre'])) {
					$rapport['Rapport']['offre'] .=
						($rapport['Rapport']['offre'] ? '; ' : '') .
						$concurance['RapportConcurance']['offre'];
				}
				// commentaire
				if (!empty($concurance['RapportConcurance']['commentaire'])) {
					$rapport['Rapport']['commentaires'] .=
						($rapport['Rapport']['commentaires'] ? '; ' : '') .
						$concurance['RapportConcurance']['commentaire'];
				}
			}

			$rapport['Rapport']['our_produits'] = implode('; ', $our_products);
		}

		// debug($rapports, 0, 0);
		// exit();

		//$rapports=$this->Rapport->query("select * from rapports where Rapport.archive=1 and visites.date_debut<=".$date_fin ." 23:59 and ")

		$this->set(compact("date_debut", "date_fin", "rapports"));
	}

	public function index_vmp($date = null)
	{
		//$date_debut = date("Y-m-01 00:00");
		//$date_fin = date("Y-m-31 23:59");
		$date_debut = '';
		$date_fin = '';
		if (isset($_GET['date'])) {
			$date = $_GET['date'];
			$date = explode('--', $date);
			$date_debut = $date[0];
			$date_fin = $date[1];
		}
		$this->Rapport->recursive = 0;

		$this->loadModel('Ligne');
		$this->loadModel('RapportConcurance');
		$this->loadModel('Produit');

		$user_vmp = $this->Rapport->User->find('list', [
			'conditions' => ['User.role' => 'VMP'],
			'fields' => ['User.id']
		]);

		$ids = implode(',', array_keys($user_vmp));

		if (AuthComponent::user('role') == "Admin" || AuthComponent::user('role') == 'Ressource humain' || AuthComponent::user('role') == "Responsable promotion") {

			$rapports = $this->Rapport->find('all', [
				'conditions' => [
					'Rapport.archive' => 1,
					"Rapport.date_debut <" => "$date_fin 23:59",
					"Rapport.date_fin >"   => $date_debut,
					"Rapport.user_id in($ids)"
				],
				'order' => ['Rapport.created DESC']
			]);
		} else if (AuthComponent::user('role') == "Super viseur") {
			$this->loadModel("Apartient");
			$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
			$ids = '0';
			foreach ($users as $value)
				$ids = $ids . ',' . $value["Apartient"]['user1_id'];
			// $rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59' and Rapport.user_id in($ids)"), "order" => array('Rapport.created desc')));
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59' and Rapport.user_id in($ids)"), "order" => array('Rapport.created desc')));
		} else {
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => 1, "Rapport.date_debut<'$date_fin 23:59'", "Rapport.date_fin>'$date_debut 23:59'", "Rapport.user_id" => AuthComponent::user('id')), "order" => array('Rapport.created desc')));
		}




		foreach ($rapports as &$rapport) {

			/* ---------- LIGNE ---------- */
			if (!empty($rapport['User']['ligne_id'])) {

				$ligne = $this->Ligne->find('first', [
					'conditions' => ['Ligne.id' => $rapport['User']['ligne_id']],
					'fields'     => ['Ligne.name'],
					'recursive'  => -1
				]);

				$rapport['Rapport']['ligne_name'] =
					!empty($ligne['Ligne']['name']) ? $ligne['Ligne']['name'] : null;
			}

			/* ---------- CONCURRENCES ---------- */
			$rapport['Rapport']['concurances'] = '';
			$rapport['Rapport']['our_produits']    = '';
			$rapport['Rapport']['agressivite'] = '';
			$rapport['Rapport']['type_offre'] = '';
			$rapport['Rapport']['offre'] = '';
			$rapport['Rapport']['commentaires'] = '';

			$rapport_concurances = $this->RapportConcurance->find('all', [
				'conditions' => ['RapportConcurance.rapport_id' => $rapport['Rapport']['id']],
				'recursive'  => -1
			]);
			$produits = $this->Produit->find('list', [
				'fields' => ['Produit.id', 'Produit.name'],
				'recursive' => -1
			]);

			$our_products = [];

			foreach ($rapport_concurances as $concurance) {

				// our products
				if (!empty($concurance['RapportConcurance']['produit_id']) && isset($produits[$concurance['RapportConcurance']['produit_id']])) {
					$our_products[] = $produits[$concurance['RapportConcurance']['produit_id']];
				}

				// concurrent products (FIXED .=)
				if (!empty($concurance['RapportConcurance']['produit_concurant'])) {
					$rapport['Rapport']['concurances'] .=
						($rapport['Rapport']['concurances'] ? '; ' : '') .
						$concurance['RapportConcurance']['produit_concurant'];
				}

				// agressivite
				if (!empty($concurance['RapportConcurance']['agressivite'])) {
					$rapport['Rapport']['agressivite'] .=
						($rapport['Rapport']['agressivite'] ? '; ' : '') .
						$concurance['RapportConcurance']['agressivite'];
				}
				// type_offre
				if (!empty($concurance['RapportConcurance']['type_offre'])) {
					$rapport['Rapport']['type_offre'] .=
						($rapport['Rapport']['type_offre'] ? '; ' : '') .
						$concurance['RapportConcurance']['type_offre'];
				}
				// offre
				if (!empty($concurance['RapportConcurance']['offre'])) {
					$rapport['Rapport']['offre'] .=
						($rapport['Rapport']['offre'] ? '; ' : '') .
						$concurance['RapportConcurance']['offre'];
				}
				// commentaire
				if (!empty($concurance['RapportConcurance']['commentaire'])) {
					$rapport['Rapport']['commentaires'] .=
						($rapport['Rapport']['commentaires'] ? '; ' : '') .
						$concurance['RapportConcurance']['commentaire'];
				}
			}

			$rapport['Rapport']['our_produits'] = implode('; ', $our_products);
		}

		// debug($rapports, 0, 0);
		// exit();

		//$rapports=$this->Rapport->query("select * from rapports where Rapport.archive=1 and visites.date_debut<=".$date_fin ." 23:59 and ")

		$this->set(compact("date_debut", "date_fin", "rapports"));
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
		if (!$this->Rapport->exists($id)) {
			throw new NotFoundException(__('Invalid rapport'));
		}
		$options = array('conditions' => array('Rapport.' . $this->Rapport->primaryKey => $id));
		$rapport = $this->Rapport->find('first', $options);
		//debug($rapport);
		$this->set('rapport', $rapport);
		$this->loadModel('Visite');
		$this->loadModel('Type');
		$types =  $this->Type->find('list');
		$this->loadModel('Category');
		$categories =  $this->Category->find('list');
		$this->loadModel('Apartient');
		$this->Apartient->recursive = -1;
		$date_debut = $rapport['Rapport']['date_debut'];
		$date_fin = $rapport['Rapport']['date_fin'];

		if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
			$visites = $this->Visite->find('all', array('conditions' => array(
				"Visite.user_id " => $rapport["User"]["id"],
				'Visite.archive' => 1,
				"Visite.date between '$date_debut' and '$date_fin  23:59'"
			)));
			$this->loadModel('User');
			$this->User->recursive = -1;
			$users = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.id" => $rapport["User"]["id"])));
			$u = array();
			foreach ($users as $user) {
				$a["Apartient"]["user_id"] = 2;
				$a["Apartient"]["user1_id"] = $user["User"]["id"];
				$u[] = $a;
			}
			$users = $u;
		}

		if (AuthComponent::user('role') == "Super viseur") {
			$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => $rapport['Rapport']['user_id'])));
			$ids = '0';
			foreach ($users as $value) {
				if ($value["Apartient"]['archive'] == 1)
					$ids = $ids . ',' . $value["Apartient"]['user1_id'];
			}
			$visites = $this->Visite->find('all', array('conditions' => array(
				"Visite.user_id in($ids)",
				'Visite.archive' => 1,
				"Visite.date between '$date_debut' and '$date_fin  23:59'"
			)));
		}
		if (AuthComponent::user('role') == "Responsable promotion" || AuthComponent::user('role') == "Admin") {
			$visites = $this->Visite->find('all', array('conditions' => array(
				'Visite.archive' => 1,
				"Visite.date between '$date_debut' and '$date_fin  23:59'"
			)));
			$this->loadModel('User');
			$this->User->recursive = -1;
			$users = $this->User->find('all', array('conditions' => array(
				'User.archive' => 1,
				"NOT" => array("User.role" => array('Admin', 'Responsable promotion'), "User.id" => array(2, 3, 4))
			)));
			//debug($users);
			$u = array();
			foreach ($users as $user) {
				$a["Apartient"]["user_id"] = 2;
				$a["Apartient"]["user1_id"] = $user["User"]["id"];
				$u[] = $a;
			}
			$users = $u;
		}
		$this->set('visites', $visites);
		$this->loadModel('Type');
		$types =  $this->Type->find('list');
		$this->loadModel('Game');
		$gammes = $this->Game->find('list', array('fields' => array('Game.id', 'Game.name')));
		$this->loadModel('Produit');
		$produits = $this->Produit->find('list');
		$this->set('types', $types);
		$this->loadModel('Category');
		$specialities =  $this->Category->find('list');
		//$this->set('specialities', $specialities);
		$this->set('categories', $specialities);
		$this->loadModel('Secteur');
		$secteurrs =  $this->Secteur->find('list');
		//$this->set('secteurrs',$secteurrs);	
		$this->set('secteurs', $secteurrs);
		$this->set('users', $users);
		$date_debut = $rapport['Rapport']['date_debut'];
		$date_fin = $rapport['Rapport']['date_fin'];
		$this->set('date_debut', $date_debut);
		$this->set('date_fin', $date_fin);
		$this->set('produits', $produits);
		$this->set('gammes', $gammes);
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		$date_debut = '';
		$date_fin = '';
		$visites = $type = $categories = array();
		$this->loadModel('Visite');
		$this->loadModel('Type');
		$types =  $this->Type->find('list');
		$this->loadModel('Category');
		$this->loadModel('Secteur');
		$secteurs =  $this->Secteur->find('list');
		$categories =  $this->Category->find('list');
		$this->loadModel('Game');
		$gammes = $this->Game->find('list', array('fields' => array('Game.id', 'Game.name')));
		$this->loadModel('Produit');
		$produits = $this->Produit->find('list', array('conditions' => array('Produit.archive' => 1)));
		$users = array();
		if (isset($_GET['date'])) {
			$date = $_GET['date'];
			$date =  explode('--', $date);
			$date_debut = $date[0];
			$date_fin = $date[1];


			$this->loadModel('Apartient');
			$this->Apartient->recursive = -1;
			if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
				$visites = $this->Visite->find('all', array('conditions' => array(
					"Visite.user_id " => AuthComponent::user('id'),
					'Visite.archive' => 1,
					"Visite.date between '$date_debut' and '$date_fin  23:59'"
				)));
				$this->loadModel('User');
				$this->User->recursive = -1;
				$users = $this->User->find('all', array('conditions' => array('User.archive' => 1, "User.id" => AuthComponent::user('id'))));
				$u = array();
				foreach ($users as $user) {
					$a["Apartient"]["user_id"] = 2;
					$a["Apartient"]["user1_id"] = $user["User"]["id"];
					$u[] = $a;
				}
				$users = $u;
			}
			if (AuthComponent::user('role') == "Super viseur") {
				$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
				$ids = '0';
				foreach ($users as $value)
					$ids = $ids . ',' . $value["Apartient"]['user1_id'];
				$visites = $this->Visite->find('all', array('conditions' => array(
					"Visite.user_id in($ids)",
					'Visite.archive' => 1,
					"Visite.date between '$date_debut' and '$date_fin  23:59'"
				)));
			}
			if (AuthComponent::user('role') == "Responsable promotion" || AuthComponent::user('role') == "Admin") {
				$visites = $this->Visite->find('all', array('conditions' => array(
					'Visite.archive' => 1,
					"Visite.date between '$date_debut' and '$date_fin  23:59'"
				)));
				$this->loadModel('User');
				$this->User->recursive = -1;
				$users = $this->User->find('all', array('conditions' => array(
					'User.archive' => 1,
					"NOT" => array("User.role" => array('Admin', 'Responsable promotion'), "User.id" => array(2, 3, 4))
				)));
				$u = array();
				foreach ($users as $user) {
					$a["Apartient"]["user_id"] = 2;
					$a["Apartient"]["user1_id"] = $user["User"]["id"];
					$u[] = $a;
				}
				$users = $u;
			}
		}
		if ($this->request->is('post')) {
			$this->Rapport->create();

			$this->request->data['Rapport']['user_id'] = AuthComponent::user('id');
			if ($this->request->data['Rapport']['date_debut'] == null) {
				$this->request->data['Rapport']['date_debut'] = $this->request->data['Rapport']['date_fin'] = date("Y-m-d");
			}

			// Handle file_terrain upload (same as addsp)
			if (!empty($this->request->data['Rapport']['file_terrain']) && is_array($this->request->data['Rapport']['file_terrain'])) {
				$uploadedFiles = [];
				$uploadDir = WWW_ROOT . 'files' . DS . 'rapports' . DS;

				if (!file_exists($uploadDir)) {
					mkdir($uploadDir, 0777, true);
				}

				foreach ($this->request->data['Rapport']['file_terrain'] as $fileIndex => $fileData) {
					if (empty($fileData['tmp_name']) || $fileData['error'] != 0) {
						continue;
					}
					$uniqueFilename = time() . '_' . $fileIndex . '_terrain_' . $fileData['name'];
					$uploadFile = $uploadDir . $uniqueFilename;

					if (move_uploaded_file($fileData['tmp_name'], $uploadFile)) {
						$uploadedFiles[] = 'files/rapports/' . $uniqueFilename;
					} else {
						$this->Session->setFlash(__('Erreur lors du téléchargement d\'un ou plusieurs fichiers'));
						return;
					}
				}

				if (!empty($uploadedFiles)) {
					$this->request->data['Rapport']['file_terrain'] = json_encode($uploadedFiles);
				}
				if (empty($uploadedFiles)) {
					unset($this->request->data['Rapport']['file_terrain']);
				}
			}

			if ($this->Rapport->save($this->request->data)) {
				foreach ($this->request->data['RapportConcurance'] as $c) {
					if (!empty($c["type_offre"])) {
						$info = "";
						foreach ($c["type_offre"] as $k => $va)
							$info = $info . "," . $va;
						$c["type_offre"] = substr($info, 1);
					}
					if (!empty($c["agressivite"])) {
						$info = "";
						foreach ($c["agressivite"] as $k => $va)
							$info = $va;
						$c["agressivite"] = $info;
					}
					$c["rapport_id"] = $this->Rapport->id;
					$c["RapportConcurance"] = $c;
					$this->Rapport->RapportConcurance->create();
					$this->Rapport->RapportConcurance->save($c);
				}
				$this->Session->setFlash(__('Rapport envoyé'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Le rapport n\'a pas été enregistré.Merci de réessayer.'));
			}
		}
		$this->set(compact('categories', 'types', 'visites', 'date_fin', 'date_debut', 'users', 'produits', 'gammes', 'secteurs'));
	}

	public function edit($id = null)
	{
		if (!$this->Rapport->exists($id)) {
			throw new NotFoundException(__('Invalid rapport'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rapport->save($this->request->data)) {
				$this->Session->setFlash(__('Rapport modifié'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Le rapport n\'a pas été modifié.Merci de réessayer.'));
			}
		}
		$options = array('conditions' => array('Rapport.' . $this->Rapport->primaryKey => $id));
		$this->request->data = $this->Rapport->find('first', $options);
		$date_debut = $this->request->data['Rapport']['date_debut'];
		$date_fin = $this->request->data['Rapport']['date_fin'];
		$visites = $type = $categories = array();
		if (isset($_GET['date'])) {
			$date = $_GET['date'];
			$date =  explode('--', $date);
			$date_debut = $date[0];
			$date_fin = $date[1];
		}
		$this->loadModel('Visite');
		$this->loadModel('Type');
		$types =  $this->Type->find('list');
		$this->loadModel('Category');
		$this->loadModel('Secteur');
		$secteurs =  $this->Secteur->find('list');
		$categories =  $this->Category->find('list');
		$this->loadModel('Game');
		$gammes = $this->Game->find('list', array('fields' => array('Game.id', 'Game.name')));
		//debug($games);
		$this->loadModel('Produit');
		$produits = $this->Produit->find('list');
		$categories =  $this->Category->find('list');
		$this->loadModel('Apartient');
		$this->Apartient->recursive = -1;
		$users = array();
		if (AuthComponent::user('role') == "Super viseur") {
			$users = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
			$ids = '0';
			foreach ($users as $value)
				$ids = $ids . ',' . $value["Apartient"]['user1_id'];
			$visites = $this->Visite->find('all', array('conditions' => array(
				"Visite.user_id in($ids)",
				'Visite.archive' => 1,
				"Visite.date between '$date_debut' and '$date_fin  23:59'"
			)));
		}
		if (AuthComponent::user('role') == "Responsable promotion" || AuthComponent::user('role') == "Admin") {
			$visites = $this->Visite->find('all', array('conditions' => array(
				'Visite.archive' => 1,
				"Visite.date between '$date_debut' and '$date_fin  23:59'"
			)));
			$this->loadModel('User');
			$this->User->recursive = -1;
			$users = $this->User->find('all', array('conditions' => array(
				'User.archive' => 1,
				"NOT" => array("User.role" => array('Admin', 'Responsable promotion'), "User.id" => array(2, 3, 4))
			)));
			$u = array();
			foreach ($users as $user) {
				$a["Apartient"]["user_id"] = 2;
				$a["Apartient"]["user1_id"] = $user["User"]["id"];
				$u[] = $a;
			}
			$users = $u;
		}
		$this->set(compact('categories', 'types', 'visites', 'date_fin', 'date_debut', 'users', 'secteurs', 'gammes', 'produits'));
	}


	function archive($id = null, $valide = null)
	{
		if ($id != null && $valide != null) {
			$this->Rapport->id = $id;
			$this->Rapport->saveField('archive', $valide);
			if ($valide == 1) {
				$this->Session->setFlash(__('Rapport validé'));
				return $this->redirect(array('action' => 'archive'));
			} else
				$this->Session->setFlash(__('Rapport archivé'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Rapport->recursive = 0;
		if (AuthComponent::user('role') == "Super viseur")
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => -1, "Rapport.user_id" => AuthComponent::user('id')), "order" => array('Rapport.created desc')));
		if (AuthComponent::user('role') == "Admin" || AuthComponent::user('role') == 'Ressource humain' || AuthComponent::user('role') == "Responsable promotion")
			$rapports = $this->Rapport->find('all', array('conditions' => array('Rapport.archive' => -1), "order" => array('Rapport.created desc')));
		$this->set('rapports', $rapports);
	}
	/* had fonction je ne sais pas 3lach thatat hna : Faycal 
	//demander f /users/admin_statistique.ctp line 167 
	//t9dar tkoun demander f chi blassa khra*/
	function system_get_nbr_affectation_potv2($user_id, $date_debut = null, $date_fin = null)
	{
		$this->loadModel('Liste');
		$listes = $this->Liste->find('list', array('conditions' => array('Liste.user_id' => $user_id)));
		$liste_ids = '0';
		$result['QAM'] = 0;
		$result['PCM'] = 0;
		$result['PM'] = 0;
		$result['NR'] = 0;
		foreach ($listes as $key => $value)
			if ($liste_ids != null)
				$liste_ids = $liste_ids . ",$key";
		$listeaff = $this->Liste->query("select liste_id from plantournes as Plantourne where "
			. "date <='$date_fin' and date >='$date_debut' and  liste_id in($liste_ids) order by date desc");
		foreach ($listeaff as $v) {
			$list_id = $v['Plantourne']['liste_id'];
			$nbaffbypot = $this->Liste->query("SELECT COUNT( potentialitev2 )as nbraff , potentialitev2
					FROM clients cl
					INNER JOIN affectations af ON cl.id = af.client_id
					WHERE liste_id=$list_id AND valide =1
					GROUP BY potentialitev2");

			foreach ($nbaffbypot as $value)
				if ($value['cl']['potentialitev2'] == 'QAM') {
					$result['QAM'] = $result['QAM'] + $value[0]['nbraff'];
				} elseif ($value['cl']['potentialitev2'] == 'PCM') {
					$result['PCM'] = $result['PCM'] + $value[0]['nbraff'];
				} elseif ($value['cl']['potentialitev2'] == 'PM') {
					$result['PM'] = $result['PM'] + $value[0]['nbraff'];
				} else {
					$result['NR'] = $result['NR'] + $value[0]['nbraff'];
				}
		}
		return $result;
	}
}
