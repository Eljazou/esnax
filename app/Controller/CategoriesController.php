<?php

App::uses('AppController', 'Controller');

/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

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
        $this->Category->recursive = 0;
        $this->loadModel("Client");
        $this->Client->recursive = -1;
        $this->Category->recursive = -1;
        $this->set('categories',$this->Category->find("all",array("conditions"=>array('Category.archive=1'))));
        $in=" and Client.id in (select DISTINCT(client_id) from affectations,listes where valide=1 and affectations.liste_id=listes.id and listes.archive=1) ";
        $clients=$this->Client->find("all",array('conditions'=>array("Client.archive=1 $in ")));
        $this->set('clients',$clients);
        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
		
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Catégorie invalide'));
        }
        $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
        $this->set('category', $this->Category->find('first', $options));
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $this->set('types', $this->Type->find('list'));
		$this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $this->set('secteurs', $this->Secteur->find('list'));
		//$this->loadModel('Visite');
		//$visites=$this->Visite->query("select * from visites v inner join clients c on v.client_id=c.id where c.category_id=".$id);
		//$this->set('visites',$visites);
		//debug($visites);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Catégorie ajoutée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La catégorie n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Catégorie invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Catégorie modifiée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La catégorie n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);
        }
    }

  
    
    
    function system_get_name($id=null)
    {
        if($id==null)
            return '--';
        else
        {
            $type=  $this->Category->findById($id);
            return $type['Category']['name'];
        }
    }
	
	public function archive($id = null,$valide = null)
    {
        if($id==null)
        {
            $this->Category->recursive = 0;
            $this->set('categories', $this->Category->find('all',array('conditions'=>array('Category.archive'=>0))));
        }
        else
        {
            $this->Category->id = $id;
            $this->Category->saveField('archive',$valide);
            if($valide==0)
            {
                $this->Session->setFlash(__('Spécialité Archivée'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Spécialité activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }
	
	/*//function demander dans /users/view.ctp line 895 envoie liste des categories
	function system_get_all()
	{
		$this->Category->recursive = -1;
        return $this->Category->find('list',array('conditions'=>array('Category.archive'=>1)));
	}*/
	

}
