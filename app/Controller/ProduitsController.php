<?php

App::uses('AppController', 'Controller');

/**
 * Produits Controller
 *
 * @property Produit $Produit
 * @property PaginatorComponent $Paginator
 */
class ProduitsController extends AppController {

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
        $this->Produit->recursive = 0;
        $this->set('produits', $this->Produit->find('all',array('conditions'=>array('Produit.archive'=>1),'order'=>array('Produit.created asc'))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Produit->exists($id)) {
            throw new NotFoundException(__('Produit invalide'));
        }
        $options = array('conditions' => array('Produit.' . $this->Produit->primaryKey => $id));
        $this->set('produit', $this->Produit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Produit->create();
            if ($this->Produit->save($this->request->data)) {
                $this->Session->setFlash(__('Produit ajouté'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le produit n\'a pas pu être enregistré. Merci de réessayer.'));
            }
        }
        $this->set('games', $this->Produit->Game->find('list'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Produit->exists($id)) {
            throw new NotFoundException(__('Produit invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Produit->save($this->request->data)) {
                $this->Session->setFlash(__('Produit modifié'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le produit n\'a pas pu être modifié. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Produit.' . $this->Produit->primaryKey => $id));
            $this->request->data = $this->Produit->find('first', $options);
            $this->set('games', $this->Produit->Game->find('list'));
        }
    }

    function archive($id=null,$archive=null)
    {
        if ($id!=null)
        {
            $this->Produit->id=$id;
            $this->Produit->saveField('archive',$archive);
            if($archive==0)
            {
                $this->Session->setFlash(__('Produit archivé'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Produit Activé'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
        $produits=$this->Produit->find('all',array('conditions'=>array('Produit.archive'=>0)));
        $this->set('produits', $produits);
    }
    
    //demander dans view/rapports/view.ctp line 88
    //demander dans view/users/admin_statistique.ctp line 559
    function system_get_name_produit($id=null)
    {
        $this->Produit->recursive = -1;
        $produit=  $this->Produit->findById($id);
        if(empty($produit))
            return "";
        else
            return $produit['Produit']['name'];
    }

}
