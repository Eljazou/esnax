<?php

App::uses('AppController', 'Controller');

class ClientsproposesController extends AppController {

    public function view($id = null) {
        if (!$this->Clientspropose->exists($id)) {
            throw new NotFoundException(__('Proposition invalide'));
        }
        $options = array('conditions' => array('Clientspropose.' . $this->Clientspropose->primaryKey => $id));
        $clientspropose = $this->Clientspropose->find('first', $options);
        $this->set('clientspropose', $clientspropose);
        if ($clientspropose['Clientspropose']['client_id'] != null) {
            $this->loadModel('Client');
            $client = $this->Client->findById($clientspropose['Clientspropose']['client_id']);
            $this->set('client', $client);
        }
    }

    public function add($type = null) {
        if ($this->request->is('post')) {
            $ids = "";
			//verfie si il n'ai pas double
			if(!empty($this->request->data['Clientspropose']['category_id'])){
			$existe=$this->Clientspropose->query("select count(id) from clients where nom like'%".$this->request->data['Clientspropose']['nom']."%' and prenom like '%".$this->request->data['Clientspropose']['prenom']."%' and secteur_id='".$this->request->data['Clientspropose']['secteur_id']."' and category_id='".$this->request->data['Clientspropose']['category_id']."' ");}
			else{
				$existe=$this->Clientspropose->query("select count(id) from clients where nom like'%".$this->request->data['Clientspropose']['nom']."%' and prenom like '%".$this->request->data['Clientspropose']['prenom']."%' and secteur_id='".$this->request->data['Clientspropose']['secteur_id']."'");
			}
			if($existe[0][0]['count(id)']==1)
			{
				$this->Session->setFlash("Client en double merci de contacter votre superviseur");
                return $this->redirect(array( 'action' => 'add'));
			}
			
            if (isset($this->request->data['Clientspropose']['produits'])) {
                foreach ($this->request->data['Clientspropose']['produits'] as $value)
                    $ids = $ids . $value . ',';
                $this->request->data['Clientspropose']['produit'] = substr($ids, 0, -1);
            }
            $this->Clientspropose->create();
            if (AuthComponent::user('role') == "Super viseur")
                $this->request->data['Clientspropose']['archive'] = 1;
            $this->request->data['Clientspropose']['user_id'] = AuthComponent::user('id');
            if (isset($this->request->data['Clientspropose']['A']))
                $this->request->data['Clientspropose']['potentialite'] = $this->request->data['Clientspropose']['A'] . $this->request->data['Clientspropose']['1'];
			 $super = $this->requestAction('/users/system_get_superviseur/' . AuthComponent::user('id'));
            if(AuthComponent::user('role')=="Super viseur")
            {
                $super = $this->requestAction('/users/system_get_promotion/');
            }
            if ($this->Clientspropose->save($this->request->data)) {
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
				$d['Boitemail']['lien']="/clientsproposes/view/".$this->Clientspropose->id;
                $d['Boitemail']['user_id']=$super['User']['id'];
                $d['Boitemail']['user1_id']=0;
                $d['Boitemail']['titre']='Proposition d\'un nouveau client';
                $d['Boitemail']['message']="Une proposition de client a été faite par ".AuthComponent::user('name').".";
                $this->Boitemail->save($d);  
                $this->Session->setFlash(__('Votre demande a été envoyée'));
                return $this->redirect(array('controller' => 'listes', 'action' => 'view'));
            } else {
                $this->Session->setFlash(__('La proposition du client n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
        $this->loadModel('Game');
        $produits = $this->Game->find('list');
        $types = $this->Clientspropose->Type->find('list');
        $this->Clientspropose->Secteur->recursive=-1;
        $regions=$this->Clientspropose->Secteur->find('list',array('fields' => array('Secteur.code_region', 'Secteur.region'),'group'=>'region'));
        $categories = $this->Clientspropose->Category->find('list', array('conditions' => array('Category.name not like "%-%"')));
        $category1s = $categories;
        $this->set(compact('type', 'produits', 'types', 'regions', 'categories', 'category1s'));
    }

    
    public function edit($client_id = null, $editer = null) {
        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['Clientspropose']['produits'])) {
                $ids = "";
                foreach ($this->request->data['Clientspropose']['produits'] as $value)
                    $ids = $ids . $value . ',';
                $this->request->data['Clientspropose']['produit'] = substr($ids, 0, -1);
            }
            $this->request->data['Clientspropose']['user_id'] = AuthComponent::user('id');
            if (isset($this->request->data['Clientspropose']['A']))
                $this->request->data['Clientspropose']['potentialite'] = $this->request->data['Clientspropose']['A'] . $this->request->data['Clientspropose']['1'];
			 $super = $this->requestAction('/users/system_get_superviseur/' . AuthComponent::user('id'));
            if(AuthComponent::user('role')=="Super viseur")
            {
				$this->request->data['Clientspropose']['archive']=1;
                $super = $this->requestAction('/users/system_get_promotion/');
            }
            if ($this->Clientspropose->save($this->request->data)) {
				$this->loadModel('Boitemail');
                $this->Boitemail->create();
                $d['Boitemail']['user_id']=$super['User']['id'];
				$d['Boitemail']['lien']="/clientsproposes/view/".$this->Clientspropose->id;
                $d['Boitemail']['user1_id']=0;
                $d['Boitemail']['titre']='Proposition de modification des informations d\'un client';
                $d['Boitemail']['message']="Une proposition de modification des informations d'un client a été faite par ".AuthComponent::user('name').".";
                $this->Boitemail->save($d); 
                $this->Session->setFlash(__('Votre demande a été envoyée'));
                if (isset($this->request->data['Clientspropose']['client_id']))
                    return $this->redirect(array('controller' => 'clients', 'action' => 'view', $this->request->data['Clientspropose']['client_id']));
                else
                    return $this->redirect(array('action' => 'view', $this->request->data['Clientspropose']['id']));
            } else {
                $this->Session->setFlash(__('La proposition du client n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else if ($editer == null) {
            $this->loadModel('Client');
            $this->Client->recursive = -1;
            $this->request->data = $this->Client->findById($client_id);
            $this->request->data['Clientspropose'] = $this->request->data['Client'];
        } else {
            $options = array('conditions' => array('Clientspropose.' . $this->Clientspropose->primaryKey => $client_id));
            $this->request->data = $this->Clientspropose->find('first', $options);
        }
        $this->loadModel('Game');
        $produits = $this->Game->find('list');
        $types = $this->Clientspropose->Type->find('list');
        $this->Clientspropose->Secteur->recursive=-1;
        $regions=$this->Clientspropose->Secteur->find('all',array('fields' => array('Secteur.code_region','Secteur.id', 'Secteur.region'),'group'=>'region'));
        $secteur=$this->Clientspropose->Secteur->findById($this->request->data['Clientspropose']['secteur_id']);
        $categories = $this->Clientspropose->Category->find('list', array('conditions' => array('Category.name not like "%-%"')));
        $category1s = $categories;
        $this->set(compact('secteur','produits', 'types', 'regions', 'categories', 'category1s', 'client_id', 'editer'));
    }

    function valider($id = null, $valide = null) {
        if ($id != null && $valide != null) {
            $this->Clientspropose->id = $id;
            $this->Clientspropose->saveField('archive', $valide);
            $client = $this->Clientspropose->findById($id);
            if ($valide == -1) {
                if (AuthComponent::user('role') == "Super viseur") {
                    $super = $this->requestAction('/users/system_get_promotion/');
                    $this->loadModel('Boitemail');
                    $this->Boitemail->create();
                    $d['Boitemail']['lien'] = "/clientsproposes/view/" . $this->Clientspropose->id;
                    $d['Boitemail']['user_id'] = $super['User']['id'];
                    $d['Boitemail']['user1_id'] = 0;
                    if ($client['Clientspropose']['client_id'] != null) {
                        $d['Boitemail']['titre'] = 'Une proposition de modification des informations d\'un client a été archivée ';
                        $d['Boitemail']['message'] = "Une proposition de modification des informations d'un client a été archivée par :" . AuthComponent::user('name') . ".";
                    } else {
                        $d['Boitemail']['titre'] = 'Une proposition de client a été archivée';
                        $d['Boitemail']['message'] = "Une proposition de client a été archivée par :" . AuthComponent::user('name') . ".";
                    }
                    $this->Boitemail->save($d);
                }
                $this->Session->setFlash(__('Proposition client annulée'));
            } else {
                if (AuthComponent::user('role') == "Super viseur") {
                    $super = $this->requestAction('/users/system_get_promotion/');
                    $this->loadModel('Boitemail');
                    $this->Boitemail->create();
                    $d['Boitemail']['lien'] = "/clientsproposes/view/" . $this->Clientspropose->id;
                    $d['Boitemail']['user_id'] = $super['User']['id'];
                    $d['Boitemail']['user1_id'] = 0;
                    if ($client['Clientspropose']['client_id'] != null) {
                        $d['Boitemail']['titre'] = 'Une proposition de modification des informations d\'un client a été validée';
                        $d['Boitemail']['message'] = "Une proposition de modification des informations d'un client a été  validée par :" . AuthComponent::user('name') . ".";
                    } else {
                        $d['Boitemail']['titre'] = 'Une proposition de client a été validée';
                        $d['Boitemail']['message'] = "Une proposition de client a été  validée par :" . AuthComponent::user('name') . ".";
                    }
                    $this->Boitemail->save($d);
                }
                $this->Session->setFlash(__('Proposition client validée'));
            }
            // if ($valide == -1 && AuthComponent::user('role') == "Super viseur") {
                // $this->loadModel('User');
                // $this->loadModel('Boitemail');
                // $this->User->recursive = -1;
                // $users = $this->User->find('all', array('conditions' => array('User.role' => 'Responsable promotion')));
                // foreach ($users as $value) {
                    // $d = array();
                    // $this->Boitemail->create();
                    // $d['Boitemail']['user_id'] = $value['User']['id'];
                    // $d['Boitemail']['user1_id'] = 0;
                    // $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a annulé une proposition de client ';
                    // $d['Boitemail']['message'] = "Mounir va nous fournir plus de detail ";
                    // $this->Boitemail->save($d);
                // }
            // }
            if ($valide == 2) {
                //$client = $this->Clientspropose->findById($id);
                $c['Client'] = $client['Clientspropose'];
                $c['Client']['archive'] = 1;
                if ($client['Clientspropose']['client_id'] != null) {
                    $c['Client']['id'] = $client['Clientspropose']['client_id'];
                    $this->loadModel('Client');
                    $this->Client->id = $client['Clientspropose']['client_id'];
                    $this->Client->saveField('potentialite', $client['Clientspropose']["potentialite"]);
                    //$this->Client->save($c);
                } else {
                    $c['Client']['id'] = 0;
                    $this->loadModel('Client');
                    $c['Client']['date_recrutement'] = date('Y-m-d');
                    //$this->Client->create();
                    $this->Client->save($c);
					
					//------------Affecation automatique au VM qui proposé le client
					$date = date('Y-m-d');
					$nbDay = date('N', strtotime($date));
					$monday = new DateTime($date);
					$sunday = new DateTime($date);
					$date_debut=$monday->modify('-'.($nbDay-1).' days')->format('Y-m-d');
					$date_fin=$sunday->modify('+'.(7-$nbDay).' days')->format('Y-m-d');

					$client = $this->Clientspropose->findById($id);
					$this->loadModel('Liste');
					$listes = $this->Liste->find('list',array('conditions'=>array('Liste.user_id'=>$client['User']['id'])));
					$liste_ids='0';
					foreach ($listes as $key => $value) 
						 $liste_ids=$liste_ids.",$key";
						
					$plans=$this->Liste->query("select * from plantournes as Plantourne where "
								. "date >='$date_debut' and date <'$date_fin' and  liste_id in($liste_ids)");
					if(empty($plans))
					{
							$this->Session->setFlash("Client valider mais il n'ai pas affecter au VM ".$client['User']['name']." car il n'a pas de liste en cours.");
					}
					else
					{
						$this->loadModel('Affectation');
						$this->Liste->Affectation->create();
						$d=array();
						$d['Affectation']['liste_id']=$plans[0]['Plantourne']['liste_id'];
						$d['Affectation']['client_id']=$this->Client->id;
						$this->Liste->Affectation->save($d); 
						$this->Session->setFlash("Client valider et affecter au VM ".$client['User']['name']);
					}				
            }
                }
            return $this->redirect(array('action' => 'valider'));
        }
        if (AuthComponent::user('role') == "Super viseur") {
            $actions = $this->Clientspropose->query('SELECT `Clientspropose`.`id`, `Clientspropose`.`produit`, `Clientspropose`.`client_id`, `Clientspropose`.`type_id`, `Clientspropose`.`secteur_id`,
	    `Clientspropose`.`category_id`, `Clientspropose`.`user_id`, `Clientspropose`.`category1_id`, `Clientspropose`.`nom`,
	  `Clientspropose`.`prenom`, `Clientspropose`.`titre`, `Clientspropose`.`activite`, `Clientspropose`.`exercice`, 
	  `Clientspropose`.`potentialite`, `Clientspropose`.`potentialitev2`, `Clientspropose`.`mail`, `Clientspropose`.`tel`,
	   `Clientspropose`.`fixe`, `Clientspropose`.`fax`, `Clientspropose`.`adress`, `Clientspropose`.`archive`,`Type`.`id`,
		 `Type`.`name`, `Secteur`.`id`, `Secteur`.`region`, `Secteur`.`code_region`, `Secteur`.`ville`, 
		 `Secteur`.`code_ville`, `Secteur`.`secteur`, `Secteur`.`code_secteur`, (CONCAT(region, " ", ville, " ",
		  secteur)) AS `Secteur__full_name`, `Category`.`id`, `Category`.`name`, `Category`.`description`, `User`.`id`,
		   `User`.`secteur_id`, `User`.`name`, `User`.`username`, `User`.`role`, `User`.`password`, 
			`User`.`date_de_naissance`, `User`.`image`, `User`.`date_de_recrutement`, `User`.`adresse`, `User`.`tel`,
			 `User`.`kilometrage_urbain`, `User`.`kilometrage_interville`, `User`.`archive`, `User`.`created`,
			  `User`.`modified`, `Category1`.`id`, `Category1`.`name`, `Category1`.`description` 
			  FROM `clientsproposes` AS `Clientspropose` LEFT JOIN `types` AS `Type` ON 
			  (`Clientspropose`.`type_id` = `Type`.`id`) LEFT JOIN `secteurs` AS `Secteur` ON
			   (`Clientspropose`.`secteur_id` = `Secteur`.`id`) LEFT JOIN `categories` AS `Category` 
				ON (`Clientspropose`.`category_id` = `Category`.`id`) LEFT JOIN `users` AS `User` ON 
				(`Clientspropose`.`user_id` = `User`.`id`) LEFT JOIN `categories` AS `Category1` ON 
				(`Clientspropose`.`category1_id` = `Category1`.`id`) WHERE `Clientspropose`.`archive` = 0
            and `Clientspropose`.`user_id` in(select user1_id from apartients where user_id=' . AuthComponent::user('id') . ')');
        } else {
            $actions = $this->Clientspropose->find('all', array('conditions' => array('Clientspropose.archive' => 1)));
        }
        $this->set('clientsproposes', $actions);
    }

    function archive($id = null, $archive = null) {
        if ($id != null) {
            $this->Clientspropose->id = $id;
            $this->Clientspropose->saveField('archive', $archive);
            if ($archive == -1) {
                $this->Session->setFlash(__('Proposition client archivée'));
                return $this->redirect(array('action' => 'valider'));
            } else {
                $this->Session->setFlash(__('Proposition client activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
        if (AuthComponent::user('role') == 'Super viseur') {
                $this->loadModel('User');
                $this->User->Apartient->recursive = -1;
                $users = $this->User->Apartient->find('all', array('conditions' =>
                    array('Apartient.user_id' => AuthComponent::user('id'))));
                $ids = AuthComponent::user('id');
                foreach ($users as $value)
                    $ids = $ids . ',' . $value["Apartient"]['user1_id'];
                $actions = $this->Clientspropose->find('all', array('conditions' => array('Clientspropose.archive' => -1
                    ,"Clientspropose.user_id in($ids)")));
        }
        else
            $actions = $this->Clientspropose->find('all', array('conditions' => array('Clientspropose.archive' => -1)));
        $this->set('clientsproposes', $actions);
    }

    //function qui permet de qualifié les données au cas de incomplet data 
    function system_add_info() {
        $clientpro = $this->request->data;
		if(isset($this->request->data['Clientspropose']))
		{
			$this->Session->setFlash(__('Merci '));
			return $this->redirect(array('controller' => 'visites', 'action' => 'add', $this->request->data['Clientspropose']['client_id']));
		}
        $this->request->data['Clientspropose']['potentialite'] = $this->request->data['Clientspropose']['potentialite'] = $this->request->data['Clientspropose']['A'] . $this->request->data['Clientspropose']['1'];
        $this->loadModel('Client');
        $this->Client->recursive = -1;
        $client = $this->Client->findById($this->request->data['Clientspropose']['client_id']);
        $clien['Clientspropose'] = $client['Client'];
        $clien['Clientspropose']['id'] = null;
        $client = array_merge($clien['Clientspropose'], $clientpro['Clientspropose']);
        $client['potentialite'] = $this->request->data['Clientspropose']['potentialite'] = $this->request->data['Clientspropose']['A'] . $this->request->data['Clientspropose']['1'];
        $ids = "";
        foreach ($this->request->data['Clientspropose']['produits'] as $value)
            $ids = $ids . $value . ',';
        $client['produit'] = substr($ids, 0, -1);
        $clie['Clientspropose'] = $client;
        debug($clie);
        $this->Clientspropose->create();
        if (AuthComponent::user('role') == "Super viseur")
            $clie['Clientspropose']['archive'] = 1;
        else
            $clie['Clientspropose']['archive'] = 0;
        $clie['Clientspropose']['user_id'] = AuthComponent::user('id');
        $this->Clientspropose->save($clie);
		if (AuthComponent::user('role') == "VMP" || AuthComponent::user('role') == "Coordinateur"){
		$super = $this->requestAction('/users/system_get_superviseur/' . AuthComponent::user('id'));
		$this->loadModel('Boitemail');
                $this->Boitemail->create();
				$d['Boitemail']['lien']="/clientsproposes/view/".$this->Clientspropose->id;
                $d['Boitemail']['user_id']=$super['User']['id'];
                $d['Boitemail']['user1_id']=0;
                $d['Boitemail']['titre']='Proposition de modification de la potentialité d\'un client';
                $d['Boitemail']['message']="Une proposition de modification de la potentialité d'un client a été faite par ".AuthComponent::user('name').".";
                $this->Boitemail->save($d); 
		}				
        $this->Session->setFlash(__('Merci '));
        return $this->redirect(array('controller' => 'visites', 'action' => 'add', $this->request->data['Clientspropose']['client_id']));
    }
    
    
    function system_get_ville($region_id=null,$ville_id=null)
    {
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        if($ville_id==null)
        {
            $villes= $this->Secteur->find('all',array('conditions'=>array('Secteur.code_region'=>$region_id),
                'group' => array('Secteur.ville')));
            echo '<label for="ClientCategoryId">Ville</label> <select class="form-control" required="required" onchange="
            var id = $(this).val();
            $(\'#secteur\').empty();
            $(\'#secteur\').show();
            $.post(
                    \'/clientsproposes/system_get_ville/0/\' + id,
                    {
                        //id: $(\'#ChembreBlocId\').val()
                    },
                    function (data)
                    {
                        $(\'#secteur\').empty();
                        $(data).appendTo(\'#secteur\');
                        $(\'#secteur\').show();
                    },
                    \'text\' // type
                    );">';
            echo '<option value="">Choisissez une ville</option>';
             foreach ($villes as $value)
                echo '<option value="'.$value['Secteur']['code_ville'].'">'.$value['Secteur']['ville'].'</option>';
            echo '</select>';
        }
        else
        {
            $villes= $this->Secteur->find('all',array('conditions'=>array('Secteur.code_ville'=>$ville_id),
                'group' => array('Secteur.secteur')));
            echo '<label for="ClientCategoryId">Secteur</label><select name="data[Clientspropose][secteur_id]" required="required" class="form-control"';
            echo '<option value="" selected>Choisissez un secteur</option>';
             foreach ($villes as $value)
                echo '<option  value="'.$value['Secteur']['id'].'">'.$value['Secteur']['secteur'].'</option>';
            echo '</select>';
        }
        exit();
    }

}
