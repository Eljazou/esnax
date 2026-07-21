<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'users');

/**
 * Grosistes Controller
 *
 * @property Grosiste $Grosiste
 * @property PaginatorComponent $Paginator
 */
class GrosistesController extends AppController {

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
        $this->Grosiste->recursive = 0;
        if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {
            $users = new UsersController;
            $user_id = $users->system_get_superviseur(AuthComponent::user('id'));
            $user_id = $user_id['User']['id'];
        } else if (AuthComponent::user('role') == 'Super viseur' && AuthComponent::user('username') != 'r.ennafi@esnapharm.com')
            $user_id = AuthComponent::user('id');
        else
            $user_id = 0;
        if ($user_id == 0)
            $this->set('grosistes', $this->Grosiste->find("all", array("conditions" => array('Grosiste.archive=1'))));
        else
            $this->set('grosistes', $this->Grosiste->find("all", array("conditions" => array('Grosiste.super_id' => $user_id, 'Grosiste.archive=1'))));
    }

    function statistiqueglobal()
	{
		if ($this->request->is('post') || $this->request->is('put')) 
			$anne=$this->request->data["annee"];
		else
			$anne=date("Y");
		
		$this->set('grosistes', $this->Grosiste->find('all'));
		$this->set('villes', $this->Grosiste->query("select region  from grosistes  group by region"));
		$this->loadModel("Groproduit");
		$this->Groproduit->recursive =-1;
		$this->set('groproduits', $this->Groproduit->find("list", array("conditions" => array('Groproduit.archive=1'))));
		$this->set('anne',$anne);
	}
    public function view($id = null) 
	{
		
		if ($this->request->is('post') || $this->request->is('put')) 
			$anne=$this->request->data["annee"];
		else
			$anne=date("Y");
        if (!$this->Grosiste->exists($id)) {
            throw new NotFoundException(__('Invalid grossiste'));
        }
		$conditions = array('Grosiste.id' => $id);
        $grosiste = $this->Grosiste->find('first',array('conditions' => $conditions));
        $this->loadModel("Groproduit");
        $this->Groproduit->recursive =-1;
        $groproduits=$this->Groproduit->find("list", array("conditions" => array('Groproduit.archive=1')));
		$this->set(compact("anne","grosiste","groproduits"));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Grosiste->create();
            if ($this->Grosiste->save($this->request->data)) {
                $this->Session->setFlash(__('Ajout effectuer '));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The grosiste could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('User');
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $super_id = $this->User->find('list', array("conditions" => array("User.role" => 'Super viseur')));
        $rr = $this->Secteur->find('all', array('fields' => array('Secteur.region'), 'group' => array('Secteur.region')));
        foreach ($rr as $r) {
            $region[$r["Secteur"]['region']] = $r["Secteur"]['region'];
        }
        $this->set(compact('region', 'super_id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Grosiste->exists($id)) {
            throw new NotFoundException(__('Invalide grossiste'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Grosiste->save($this->request->data)) {
                $this->Session->setFlash(__('Modification effectuer '));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The grosiste could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Grosiste.' . $this->Grosiste->primaryKey => $id));
            $this->request->data = $this->Grosiste->find('first', $options);
        }
        $this->loadModel('User');
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $super_id = $this->User->find('list', array("conditions" => array("User.role" => 'Super viseur')));
        $rr = $this->Secteur->find('all', array('fields' => array('Secteur.region'), 'group' => array('Secteur.region')));
        foreach ($rr as $r) {
            $region[$r["Secteur"]['region']] = $r["Secteur"]['region'];
        }
        $this->set(compact('region', 'super_id'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function archive($id = null, $valide = null) {
        if ($id == null) {
            $this->Grosiste->recursive = 0;
            $this->set('grosistes', $this->Grosiste->find('all', array('conditions' => array('Grosiste.archive' => 0))));
        } else {
            $this->Grosiste->id = $id;
            $this->Grosiste->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Grosiste Archivée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Grosiste activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }

}
