<?php

App::uses('AppController', 'Controller');

/**
 * Boitemails Controller
 *
 * @property Boitemail $Boitemail
 * @property PaginatorComponent $Paginator
 */
class BoitemailsController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('system_get_nombre_mail');
    }
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index($send=null) {
        $this->Boitemail->recursive = 0;
        if($send==0)
            $this->set('boitemails', $this->Paginator->paginate(array('Boitemail.user_id='.AuthComponent::user('id').''
            . '  order by Boitemail.created desc')));
        else
            $this->set('boitemails', $this->Paginator->paginate(array('Boitemail.user1_id='.AuthComponent::user('id').''
            . '  order by Boitemail.created desc')));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Boitemail->exists($id)) {
            throw new NotFoundException(__('Email invalide'));
        }
        $options = array('conditions' => array('Boitemail.' . $this->Boitemail->primaryKey => $id));
        $boitemail= $this->Boitemail->find('first', $options);
        $this->Boitemail->id = $id;
        $this->Boitemail->saveField('vue',$boitemail['Boitemail']['vue']+1);
        $this->set('boitemail', $boitemail);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Boitemail->create();
            $this->request->data['Boitemail']['user1_id']=AuthComponent::user('id');
            if ($this->Boitemail->save($this->request->data)) {
                $this->Session->setFlash(__('Email envoyé'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Email non envoyé. Merci de réessayer.'));
            }
        }
        $this->loadModel("Apartient");
        $this->Apartient->recursive=-1;
        if(AuthComponent::user('role')=='VMP' || AuthComponent::user('role')=='Coordinateur' )
        {
            $user = $this->Apartient->find('all', array('conditions' => 
                array('Apartient.user1_id' => AuthComponent::user('id'))));
            $user=$user[0]['Apartient']['user_id'];
            $users = $this->Boitemail->User->find('list',array('conditions'=>array('User.archive'=>1,"User.role='VMP' OR User.role='Coordinateur'"
                . "OR User.id=$user")));
        }
        else if(AuthComponent::user('role')=='Super viseur')
        {
            $users = $this->Apartient->find('all', array('conditions' =>
                array('Apartient.user_id' => AuthComponent::user('id'))));
            $ids = '0';
            foreach ($users as $value)
                $ids = $ids . ',' . $value["Apartient"]['user1_id'];
            $users = $this->Boitemail->User->find('list', array('conditions' => array("User.id in($ids) OR User.role='Super viseur' OR User.role='Responsable promotion'", 'User.archive' => 1)));
        }
        else 
            $users = $this->Boitemail->User->find('list',array('conditions'=>array('User.archive'=>1)));
        $this->set(compact('users'));
    }

    public function archive($id = null,$valide=9) {
        $this->Boitemail->id = $id;
        $this->Boitemail->saveField('archive',$valide);
        $this->Session->setFlash(__('Email archivé'));
        return $this->redirect(array('action' => 'index'));
    }
    
    
    function system_get_nombre_mail()
    {
        $this->Boitemail->recursive =-1;
        $count=$this->Boitemail->find('count',array('conditions'=>array('Boitemail.user_id'=>AuthComponent::user('id')
                ,"Boitemail.vue"=>'0')));
        return $count;
    }

}
