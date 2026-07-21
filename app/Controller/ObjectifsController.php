<?php

App::uses('AppController', 'Controller');

/**
 * Objectifs Controller
 *
 * @property Objectif $Objectif
 * @property PaginatorComponent $Paginator
 */
class ObjectifsController extends AppController {
    
    public $components = array('Paginator');

     function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("system_get_objectif_by_date");
    }
    public function index() 
	{
		$this->Objectif->User->recursive=-1;
		$users=array();
        if(AuthComponent::user('role')=='Super viseur')
        {
            $this->loadModel('Apartient');
            $users=$this->Apartient->find('all',array('conditions'=>array('Apartient.user_id'=>AuthComponent::user('id'))));
        }
        if(AuthComponent::user('role')=='Responsable promotion')
        {
            $users=$this->Objectif->User->find('all',array('conditions'=>array('User.role'=>'Super viseur','User.archive'=>1)));
        }
        if(AuthComponent::user('role')=='Directeur')
        {
            $users=$this->Objectif->User->find('all',array('conditions'=>array('User.role'=>'Responsable promotion','User.archive'=>1)));
        }
		if(AuthComponent::user('role')=='Admin')
        {
            $users=$this->Objectif->User->find('all',array('conditions'=>array('User.archive'=>1)));
           
        }
		
		$this->set('users',$users);
        $this->set('types', $this->Objectif->Type->find('list'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Objectif->exists($id)) {
            throw new NotFoundException(__('Objectif invalide'));
        }
        $options = array('conditions' => array('Objectif.' . $this->Objectif->primaryKey => $id));
        $this->set('objectif', $this->Objectif->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($user_id=null,$info=null) 
    {
        if($info!=null)
        {
            $objs=$this->Objectif->find('all',array('conditions'=>array('Objectif.user_id'=>$user_id)));
            foreach ($objs as $v) 
            {
                $this->Objectif->id = $v['Objectif']['id'];
                $this->Objectif->saveField('archive',0);
            }
            $info=  explode(',', $info);
            for($i=1;$i<count($info);$i++)
            {
                $inf=  explode("||", $info[$i]);
                $data=array();
                $this->Objectif->create();
                $data['Objectif']['user_id']=$user_id;
                $data['Objectif']['type_id']=$inf[0];
                $data['Objectif']['objectif']=$inf[1];
                $this->Objectif->save($data);
            }
            $this->Session->setFlash(__('Objectif ajouté'));
            return $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post'))
        {
            $objs=$this->Objectif->find('all',array('conditions'=>array('Objectif.user_id'=>$this->request->data[0]['user_id'])));
            foreach ($objs as $v) 
            {
                $this->Objectif->id = $v['Objectif']['id'];
                $this->Objectif->saveField('archive',0);
            }
            foreach ($this->request->data as $value) 
			{
				if($value['objectif']==0)
					continue;
                $data=array();
                $this->Objectif->create();
                $data['Objectif']['user_id']=$value['user_id'];
                $data['Objectif']['type_id']=$value['type'];
                $data['Objectif']['objectif']=$value['objectif'];
                $this->Objectif->save($data);
            }
            $this->Session->setFlash(__('Objectif ajouté'));
            return $this->redirect(array('action' => 'index'));
            
        }
        $types = $this->Objectif->Type->find('list');
        $this->set(compact('types','user_id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Objectif->exists($id)) {
            throw new NotFoundException(__('Objectif invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Objectif->save($this->request->data)) {
                $this->Session->setFlash(__('Objectif modifié'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'objectif n\'a pas pu être modifié. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Objectif.' . $this->Objectif->primaryKey => $id));
            $this->request->data = $this->Objectif->find('first', $options);
        }
        $types = $this->Objectif->Type->find('list');
        $users = $this->Objectif->User->find('list');
        $this->set(compact('types', 'users'));
    }

    function system_dernier_objectif($user_id)
    {
        $user=$this->Objectif->find('all',array('conditions'=>array('Objectif.user_id'=>$user_id,'Objectif.archive'=>1),
            'order'=>array('Objectif.created desc')));
        $this->Objectif->Type->find('list');
        return $user;
    }
    
	
	//pour index de objectif recupéré le tout
	//pour users/admin_statistique
	//Demander par /view/system_rachid.ctp 
	//Demander dans /layout/mail/html/raportrachid.ctp 
    function system_get_objectif_by_date($user_id,$date=null)
    {
		$objectif=$this->Objectif->find('all',array('conditions'=>array('Objectif.user_id'=>$user_id)));
        return $objectif;
    }
	
	
	function delete ($id)
	{
		$this->Objectif->id=$id;
		$this->Objectif->delete();
		$this->Session->setFlash('Objectif supprimer');
        return $this->redirect(array('action' => 'index'));
	}
    
}
