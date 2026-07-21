<?php

App::uses('AppController', 'Controller');

/**
 * Stockvisites Controller
 *
 * @property Stockvisite $Stockvisite
 * @property PaginatorComponent $Paginator
 */
class StockvisitesController extends AppController
{

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('system_getdatafromesnacommande');
	}


	function system_get_stock_client($client_id)
	{
		$stock = $this->Stockvisite->find("all", array("conditions" => array("Stockvisite.client_id" => $client_id), "order" => array("Stockvisite.id desc")));
		return $stock;
	}


	function system_getdatafromesnacommande()
	{
		//debug($this->request->data);

		$this->Stockvisite->User->recursive = -1;
		$user = $this->Stockvisite->User->findByUsername($this->request->data["User"]["username"]);
		$user_id = 1;
		if (!empty($user))
			$user_id = $user["User"]["id"];

		$this->Stockvisite->Client->recursive = -1;
		$client = $this->Stockvisite->Client->findByCodeWavsoft($this->request->data["User"]["client"]);
		$client_id = 1;
		if (!empty($client)) {
			$client_id = $client["Client"]["id"];
		} else {
			$this->loadModel('Boitemail');
			$this->Boitemail->create();
			$d['Boitemail']['lien'] = "https://valpharma.icozdev.com/commandes/view/" . $this->request->data["User"]["commande_id"];
			$d['Boitemail']['user_id'] = 1;
			$d['Boitemail']['user1_id'] = 0;
			$d['Boitemail']['titre'] = "CRM pharmacie non trouvé : " . $this->request->data["User"]["client"];
			$d['Boitemail']['message'] = "CRM pharmacie non trouvé : " . $this->request->data["User"]["client"] . " \n <br>
			Voila le lien de la commande https://valpharma.icozdev.com/commandes/view/" . $this->request->data["User"]["commande_id"];
			$this->Boitemail->save($d);

			App::uses('CakeEmail', 'Network/Email');
			$Email = new CakeEmail();
			$Email->to("z.ouzine@esnapharm.com"); //AuthComponent::user('prenom')
			$Email->from('no-replay@esnapharm.com');
			$Email->subject("CRM pharmacie non trouvé : " . $this->request->data["User"]["client"]);
			$Email->send("CRM pharmacie non trouvé : " . $this->request->data["User"]["client"] . " \n <br>
			Voila le lien de la commande https://valpharma.icozdev.com/commandes/view/" . $this->request->data["User"]["commande_id"]);
			exit();
		}

		$this->Stockvisite->Produit->recursive = -1;
		foreach ($this->request->data["Stock"] as $c) {
			$d = array();
			$d["Stockvisite"]["user_id"] = $user_id;
			$d["Stockvisite"]["client_id"] = $client_id;
			$d["Stockvisite"]["quantite"] = $c["quantite"];
			$d["Stockvisite"]["type"] = "Vente";
			$produit = $this->Stockvisite->Produit->findByCode($c["code"]);
			$produit_id = 1;
			if (!empty($produit))
				$produit_id = $produit["Produit"]["id"];
			$d["Stockvisite"]["produit_id"] = $produit_id;
			$this->Stockvisite->create();
			$this->Stockvisite->save($d);
		}
		exit();
	}
	public function index()
	{
		// ✅ OPTIMISATION 1 : Construire les conditions proprement
		$conditions = array('1=1');
		$stockvisites = array();
		$produits = $this->Stockvisite->Produit->find('list', array(
			'conditions' => array('Produit.stock' => 1),
			'cache' => array('name' => 'produits_stock_list', 'time' => '+1 day')
		));

		$this->loadModel("Secteur");
		$secteurs = $this->Secteur->find("list", array(
			'cache' => array('name' => 'secteurs_list', 'time' => '+1 day')
		));


		if ($this->request->is('post') || $this->request->is('put')) {
			$quantite_min = isset($this->request->data["Stockvisite"]["quantite_min"])
				? (int) $this->request->data["Stockvisite"]["quantite_min"]
				: 0;
			$quantite_max = isset($this->request->data["Stockvisite"]["quantite_max"])
				? (int) $this->request->data["Stockvisite"]["quantite_max"]
				: 10000;

			if ($this->request->data["Stockvisite"]["produit_id"] != 0) {
				$conditions['Stockvisite.produit_id'] = (int) $this->request->data["Stockvisite"]["produit_id"];
			}

			// ✅ Utiliser CakePHP syntax au lieu de concatenation SQL
			$conditions[] = array(
				'Stockvisite.quantite >=' => $quantite_min,
				'Stockvisite.quantite <=' => $quantite_max
			);
			// ✅ OPTIMISATION 2 : UNE SEULE REQUÊTE au lieu de 2
			// Utiliser DISTINCT + JOIN au lieu de GROUP BY
			$this->Stockvisite->recursive = -1;

			$stockvisites = $this->Stockvisite->find('all', array(
				'fields' => array(
					'Stockvisite.*',
					'User.id',
					'User.name',
					'Produit.id',
					'Produit.name',
					'Produit.code',
					'Client.id',
					'Client.nom',
					'Client.prenom',
					'Client.secteur_id ',
					'Client.latitude ',
					'Client.longitude'
				),
				'conditions' => $conditions,
				'joins' => array(
					array(
						'table' => 'users',
						'alias' => 'User',
						'type' => 'LEFT',
						'conditions' => array('User.id = Stockvisite.user_id')
					),
					array(
						'table' => 'produits',
						'alias' => 'Produit',
						'type' => 'LEFT',
						'conditions' => array('Produit.id = Stockvisite.produit_id')
					),
					array(
						'table' => 'clients',
						'alias' => 'Client',
						'type' => 'LEFT',
						'conditions' => array('Client.id = Stockvisite.client_id')
					)
				),
				'group' => array('Stockvisite.client_id'),
				'order' => array('Stockvisite.id DESC')
			));
		}



		$this->set(compact('stockvisites', "produits", "secteurs"));
	}

	public function edit($id = null)
	{
		if (!$this->Stockvisite->exists($id)) {
			throw new NotFoundException(__('Invalid stockvisite'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Stockvisite->save($this->request->data)) {
				$this->Session->setFlash(__('La stockvisite à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stockvisite could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Stockvisite.' . $this->Stockvisite->primaryKey => $id));
			$this->request->data = $this->Stockvisite->find('first', $options);
		}
		$visites = $this->Stockvisite->Visite->find('list');
		$produits = $this->Stockvisite->Produit->find('list');
		$this->set(compact('visites', 'produits'));
	}
	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function supprimer($id = null)
	{
		$this->Stockvisite->id = $id;
		$this->Stockvisite->delete();
		$this->Session->setFlash(__('Le stock à été supprimer'));
		return $this->redirect(array('action' => 'index'));
	}
}