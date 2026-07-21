<?php

App::uses('AppController', 'Controller');

/**
 * Avences Controller
 *
 * @property Avence $Avence
 * @property PaginatorComponent $Paginator
 */
class AvencesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Avence->recursive = 0;
		if(AuthComponent::user('role') != "Ressource humain"){
		$this->set('avences', $this->Avence->find("all",array('conditions' => array('Avence.user_id' =>AuthComponent::user('id')),'order' => array('Avence.created desc' ))));	
		}
		else
		{
			$this->set('avences', $this->Avence->find("all",array('order' => array('Avence.created desc' ))));
		}
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Avence->create();
			$this->loadModel('User');
             $this->request->data['Avence']['user_id']=AuthComponent::user('id');
            if ($this->Avence->save($this->request->data)) {
                $super = $this->requestAction('/users/system_get_superviseur/' . AuthComponent::user('id'));
                if (AuthComponent::user('role') == "Super viseur") {
                    $super = $this->requestAction('/users/system_get_promotion/');
                }
				$r= $this->User->findByRole("Ressource humain");
				App::uses('CakeEmail', 'Network/Email');
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                $d['Boitemail']['lien'] = "/avences/valider/";
                $d['Boitemail']['user_id'] = $super['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
				if($this->request->data['Avence']['type']=='Pret'){
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a demandé un '.$this->request->data['Avence']['type'];
                $d['Boitemail']['message'] = "Une demande de ".$this->request->data['Avence']['type']." a été envoyé par " . AuthComponent::user('name');
				$Email = new CakeEmail();
                    $Email->to($r['User']['username']);//AuthComponent::user('prenom')
                    $Email->from('rh@esnapharm.com');
                    $Email->subject(AuthComponent::user('name') . ' a demandé un '.$this->request->data['Avence']['type']);
                    $Email->send("Une demande de ".$this->request->data['Avence']['type']." a été envoyé par " . AuthComponent::user('name')."."."\n"."Merci de valider la demande sur le CRM"."\n"."\n"."\n"."***Cet email sert juste à vous envoyer des notifications,merci de ne jamais y répondre");
				}else if($this->request->data['Avence']['type']=='Avance'){
					$d['Boitemail']['titre'] = AuthComponent::user('name') . ' a demandé une '.$this->request->data['Avence']['type'];
                $d['Boitemail']['message'] = "Une demande d\'".$this->request->data['Avence']['type']." a été envoyé par " . AuthComponent::user('name');
				$Email = new CakeEmail();
                    $Email->to($r['User']['username']);//AuthComponent::user('prenom')
                    $Email->from('rh@esnapharm.com');
                    $Email->subject(AuthComponent::user('name') . ' a demandé une '.$this->request->data['Avence']['type']);
                    $Email->send("Une demande d\' ".$this->request->data['Avence']['type']." a été envoyé par " . AuthComponent::user('name')."."."\n"."Merci de valider la demande sur le CRM"."\n"."\n"."\n"."***Cet email sert juste à vous envoyer des notifications,merci de ne jamais y répondre");
				}
                $this->Boitemail->save($d);
            
                $this->Session->setFlash(__('Demande Envoyée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La demande n\'a pas été envoyé,merci de réessayer'));
            }
        }
        $users = $this->Avence->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Avence->exists($id)) {
            throw new NotFoundException(__('Invalid avence'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Avence->save($this->request->data)) {
                $this->Session->setFlash(__('Modification enregistré'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La modification n\'a pas été enregistré,merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Avence.' . $this->Avence->primaryKey => $id));
            $this->request->data = $this->Avence->find('first', $options);
        }
        $users = $this->Avence->User->find('list');
        $this->set(compact('users'));
    }
    
    
    function valider($id = null, $valide = null,$temriner=null) {
		$documents=array();
        if ($this->request->is('post') || $this->request->is('put')) {
                $this->Avence->id = $id;
                $this->Avence->saveField('repense', $this->request->data["reponse"]);
        }
		if ($id != null && $temriner != null) 
		{
			$this->Avence->id = $id;
            $document = $this->Avence->saveField("etat","1");
		}
        elseif ($id != null && $valide != null) {
            $this->Avence->id = $id;
            $document = $this->Avence->findById($id);
            $this->loadModel('Boitemail');
            $this->Boitemail->create();
            $d['Boitemail']['user_id'] = $document['Avence']['user_id'];
            $d['Boitemail']['user1_id'] = 0;
            if ($valide ==1) {
                $this->Session->setFlash(__('Avance validée'));
                //envoi une notification RH
                $this->loadModel('User');
                $this->User->recursive = -1;
                $r= $this->User->findByRole("Ressource humain");
                $this->Boitemail->create();
                $dd['Boitemail']['lien'] = "/avences/index/".$document['Avence']['user_id'];
                $dd['Boitemail']['user_id'] = $r['User']['id'];
                $dd['Boitemail']['user1_id'] = 0;
				if($document['Avence']['type']=='Pret'){
					$dd['Boitemail']['titre'] = 'La demande du '.$document['Avence']['type']." à été accepté";
					$dd['Boitemail']['message'] = "Une demande de ".$document['Avence']['type']." a été validée par l'administration. ";
				}else if($document['Avence']['type']=='Avance'){
					$dd['Boitemail']['titre'] = 'La demande de l\' '.$document['Avence']['type']." a été accepté";
					$dd['Boitemail']['message'] = "Une demande d\' ".$document['Avence']['type']." a été validée par l'administration. ";
				}
                $this->Boitemail->save($dd);
                //envoie notifiacation a VM
                $this->Boitemail->create();
                $d['Boitemail']['titre'] = 'Demande d\'un '.$document['Avence']['type']." est valider";
                $d['Boitemail']['message'] = "Votre demande de document a été validée par l'administration. ";
            }
            if ($valide ==-1) {
                $this->Session->setFlash(__('Avence réfusé'));
                $d['Boitemail']['titre'] = 'Demande du  '.$document['Avence']['type']." est réfusé.";
                $d['Boitemail']['message'] = "Votre demande de ".$document['Avence']['type']." a été réfusée par l'administration. ";
            }
            $this->Boitemail->save($d);
            $this->Avence->saveField('valide', $valide);
        }
        if (AuthComponent::user('role') == "Super viseur") {
            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $super = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = '0';
            foreach ($super as $value) {
                $ids = $ids . ',' . $value['Apartient']['user1_id'];
            }
            $documents = $this->Avence->find('all', array('conditions' => array('Avence.valide' => 0, "Avence.user_id in($ids)"),
                "order"=>array("Avence.id desc")));
        }
		else
		{
			$documents = $this->Avence->find('all', array("order"=>array("Avence.created desc")));
		}
        $this->set('documents', $documents);
    }
    
    function archive()
    {
        $documents = $this->Avence->find('all', array('conditions' => array('Avence.valide' => -1),
                "order"=>array("Avence.id desc")));
        $this->set('documents', $documents);
    }
	
	
	
	function system_get_pret_for_notedefrais($user_id)
	{
		$this->Avence->recursive=-1;
		$avence=$this->Avence->find('first', array('conditions' => array('Avence.valide' => 1,'Avence.etat' => 0,'Avence.user_id' =>$user_id)));
		return $avence;
	}

    

}
