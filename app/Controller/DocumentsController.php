<?php

App::uses('AppController', 'Controller');

/**
 * Documents Controller
 *
 * @property Document $Document
 * @property PaginatorComponent $Paginator
 */
class DocumentsController extends AppController {

    public $components = array('Paginator');


    public function index($user_id=null) {
        $date_debut = date("Y-01-01");
        $date_fin = date("Y-12-31");
        if (isset($_GET['date'])) {
            $date = $_GET['date'];
            $date = explode('--', $date);
            $date_debut = $date[0];
            $date_fin = $date[1];
        }
        $users=array();
        if($user_id==null)
            $user_id = AuthComponent::user('id');
        if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')
            $user_id = AuthComponent::user('id');
        else {
            if (AuthComponent::user('role') == 'Super viseur')
            {
                 $this->loadModel('Apartient');
                //$this->Apartient->recursive = -1;
                $user = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
                foreach ($user as $u) 
                $users["User"][]=$u["User1"];
            }
            else {
                $this->Document->User->recursive = -1;
                $user=$this->Document->User->find("all",array('conditions' => array('User.archive' => 1)));
                foreach ($user as $u) 
                    $users["User"][]=$u["User"];
            }            
        }
        $documents = $this->Document->find('all', array('conditions' => array('Document.user_id' => $user_id,
                "Document.created BETWEEN '$date_debut' and '$date_fin'"),"order"=>array("Document.id desc")));
        $this->set('users', $users);
        $this->set('documents', $documents);
        $this->set('date_debut', $date_debut);
        $this->set('date_fin', $date_fin);
        $this->set('user_id', $user_id);
    }

   
    public function add() {
        if ($this->request->is('post')) {
            $this->Document->create();
            $this->request->data['Document']['user_id'] = AuthComponent::user('id');
            if ($this->Document->save($this->request->data)) {
                $this->loadModel('User');
                $this->User->recursive = -1;
                $r= $this->User->findByRole("Ressource humain");
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                $d['Boitemail']['lien'] = "/documents/valider/";
                $d['Boitemail']['user_id'] = $r['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = AuthComponent::user('name') . ' a demandé une  '.$this->request->data['Document']['document'];
                $d['Boitemail']['message'] = "Une demande de document  a été envoyé par " . AuthComponent::user('name');
                $this->Boitemail->save($d);
				 App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail();
                    $Email->to($r['User']['username']);//AuthComponent::user('prenom')
                    $Email->from('rh@esnapharm.com');
                    $Email->subject(AuthComponent::user('name') . ' a demandé une  '.$this->request->data['Document']['document']);
                    $Email->send("Une demande de document  a été envoyé par " . AuthComponent::user('name')."\n"."\n"."\n"."\n"."***Cet email sert juste à vous envoyer des notifications,merci de ne jamais y répondre");
                
                $this->Session->setFlash(__('La demande est envoyée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please, try again.'));
            }
        }
        $users = $this->Document->User->find('list');
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
        if (!$this->Document->exists($id)) {
            throw new NotFoundException(__('Invalid document'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Document->save($this->request->data)) {
                $this->Session->setFlash(__('Document modifié'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The document could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Document.' . $this->Document->primaryKey => $id));
            $this->request->data = $this->Document->find('first', $options);
        }
        $users = $this->Document->User->find('list');
        $this->set(compact('users'));
    }

    
    function valider($id = null, $valide = null) {
		$documents=array();
        if ($id != null && $valide != null) {
            $this->Document->id = $id;
            $document = $this->Document->findById($id);
            $this->loadModel('Boitemail');
            $this->Boitemail->create();
            $d['Boitemail']['user_id'] = $document['Document']['user_id'];
            $d['Boitemail']['user1_id'] = 0;
            if ($valide ==1) {
                //envoi une notification RH
                $this->loadModel('User');
                $this->User->recursive = -1;
                $r= $this->User->findByRole("Ressource humain");
                $this->Boitemail->create();
                $dd['Boitemail']['lien'] = "/documents/valider/";
                $dd['Boitemail']['user_id'] = $r['User']['id'];
                $dd['Boitemail']['user1_id'] = 0;
                $dd['Boitemail']['titre'] = 'La demande du document '.$document['Document']['document']." a été acceptée";
                $dd['Boitemail']['message'] = "Une demande de document a été validée par l'administration. ";
                $this->Boitemail->save($dd);
                //envoie notifiacation a VM
                $this->Boitemail->create();
                $d['Boitemail']['titre'] = 'La demande du document '.$document['Document']['document']." est en cours de préparation";
                $d['Boitemail']['message'] = "Votre demande de document a été validée par l'administration. ";
            }
            if ($valide ==-1) {
                $d['Boitemail']['titre'] = 'La demande du document '.$document['Document']['document']."est refusée.";
                $d['Boitemail']['message'] = "Votre demande de document a été réfusée par l'administration. ";
            }
            if ($valide ==2) {
                $d['Boitemail']['titre'] = 'Le document : '.$document['Document']['document']." est prêt.";
                $d['Boitemail']['message'] = "Votre document est prêt,vous pouvez le récupérer. ";
            }
            $this->Boitemail->save($d);
            $this->Document->saveField('archive', $valide);
        }
        if (AuthComponent::user('role') == "Super viseur") {
            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $super = $this->Apartient->find('all', array('conditions' => array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = '0';
            foreach ($super as $value) {
                $ids = $ids . ',' . $value['Apartient']['user1_id'];
            }
            $documents = $this->Document->find('all', array('conditions' => array('Document.archive' => 0, "Document.user_id in($ids)"),"order"=>array("Document.id desc")));
        } else if (AuthComponent::user('role') == "Ressource humain")  {
            $documents = $this->Document->find('all', array('conditions' => array('Document.archive' => 1),"order"=>array("Document.id desc")));
        }
        $this->set('documents', $documents);
    }
    
    function archive()
    {
        $documents = $this->Document->find('all', array('conditions' => array('Document.archive' => -1)));
        $this->set('documents', $documents);
    }
    
    function system_relance($id)
    {
        $document=$this->Document->findById($id);
        $this->loadModel('User');
        $this->User->recursive = -1;
        $r= $this->User->findByRole("Ressource humain");
        $this->loadModel('Boitemail');
        $this->Boitemail->create();
        $dd['Boitemail']['lien'] = "/documents/valider/";
        $dd['Boitemail']['user_id'] = $r['User']['id'];
        $dd['Boitemail']['user1_id'] = 0;
        $dd['Boitemail']['titre'] = 'Relance de la demande du document '.$document['Document']['document']." du ".AuthComponent::user('name');
        $dd['Boitemail']['message'] = 'Relance de la demande du document '.$document['Document']['document']." du ".AuthComponent::user('name');
        $this->Boitemail->save($dd);
        $this->Session->setFlash(__('Relance envoyée'));
        return $this->redirect(array('action' => 'index',$id));
    }

}
