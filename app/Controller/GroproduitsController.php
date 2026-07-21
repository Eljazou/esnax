<?php

App::uses('AppController', 'Controller');

/**
 * Groproduits Controller
 *
 * @property Groproduit $Groproduit
 * @property PaginatorComponent $Paginator
 */
class GroproduitsController extends AppController {

    
    function system_get_name($id)
    {
        $this->Groproduit->recursive = -1;
        $p=$this->Groproduit->findById($id);
        return $p["Groproduit"]["name"];
    }
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Groproduit->recursive = 0;
        $this->set('groproduits', $this->Groproduit->find("all", array("conditions" => array('Groproduit.archive=1'))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Groproduit->exists($id)) {
            throw new NotFoundException(__('Invalid groproduit'));
        }
        $options = array('conditions' => array('Groproduit.' . $this->Groproduit->primaryKey => $id));
        $this->set('groproduit', $this->Groproduit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Groproduit->create();
            if ($this->Groproduit->save($this->request->data)) {
                $this->Session->setFlash(__('Ajout effectuer '));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The groproduit could not be saved. Please, try again.'));
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
        if (!$this->Groproduit->exists($id)) {
            throw new NotFoundException(__('Invalide produit'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Groproduit->save($this->request->data)) {
                $this->Session->setFlash(__('Modification effectuer '));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The groproduit could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Groproduit.' . $this->Groproduit->primaryKey => $id));
            $this->request->data = $this->Groproduit->find('first', $options);
        }
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
            $this->Groproduit->recursive = 0;
            $this->set('grosistes', $this->Groproduit->find('all', array('conditions' => array('Groproduit.archive' => 0))));
        } else {
            $this->Groproduit->id = $id;
            $this->Groproduit->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Produit Archivée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Produit activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }

}
