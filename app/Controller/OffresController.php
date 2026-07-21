<?php

App::uses('AppController', 'Controller');

/**
 * Offres Controller
 *
 * @property Offre $Offre
 * @property PaginatorComponent $Paginator
 */
class OffresController extends AppController {

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
    public function index() 
    {
        $this->Offre->recursive = 1;
        $offres=$this->Offre->find('all', array('conditions' => array('Offre.archive' => 1)));
        $this->set('offres', $offres);
    }

    public function view($id = null) {
        if (!$this->Offre->exists($id)) {
            throw new NotFoundException(__('Offre invalide'));
        }
        $this->Offre->recursive = 2;
        $options = array('conditions' => array('Offre.' . $this->Offre->primaryKey => $id));
        $this->set('offre', $this->Offre->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->loadModel('Offrespicial');
            $this->Offre->create();
            if ($this->Offre->save($this->request->data)) 
            {
                foreach ($this->request->data as $value) {
                    if(isset($value['Offrespicial']))
                    {
                        if($value['Offrespicial']['quantite']!='')
                        {
                            $this->Offrespicial->create();
                            $a=array();
                            $a['Offrespicial']['quantite']=$value['Offrespicial']['quantite'];
                            $a['Offrespicial']['produit_id']=$value['Offrespicial']['produit_id'];
                            $a['Offrespicial']['reduction']=$value['Offrespicial']['reduction'];
                            $a['Offrespicial']['offre_id']=$this->Offre->id;
                            $this->Offrespicial->save($a);
                        }
                    }
                }
                $this->Session->setFlash(__('Offre ajoutée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'offre n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
        $this->loadModel('Produit');
        $this->Produit->recursive = -1;
        $produits = $this->Produit->find('list', array('fields' => array('Produit.id', 'Produit.name'),'conditions' => array('Produit.archive' => 1)));
        $this->set(compact('produits'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Offre->exists($id)) {
            throw new NotFoundException(__('Offre invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) 
        {
            $this->loadModel('Offrespicial');
            if ($this->Offre->save($this->request->data)) 
            {
                $this->Offre->query('DELETE FROM `offrespicials` WHERE  offre_id='.$this->request->data['Offre']['id']);
                foreach ($this->request->data as $value) 
                {
                    if(isset($value['Offrespicial']))
                    {
                        if($value['Offrespicial']['quantite']!='')
                        {
                            $this->Offrespicial->create();
                            $a=array();
                            $a['Offrespicial']['quantite']=$value['Offrespicial']['quantite'];
                            $a['Offrespicial']['produit_id']=$value['Offrespicial']['produit_id'];
                            $a['Offrespicial']['offre_id']=$this->request->data['Offre']['id'];
                            $a['Offrespicial']['reduction']=$value['Offrespicial']['reduction'];
                            $this->Offrespicial->save($a);
                        }
                    }
                }
                $this->Session->setFlash(__('Offre modifiée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('L\'offre n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Offre.' . $this->Offre->primaryKey => $id));
            $this->request->data = $this->Offre->find('first', $options);
            $this->loadModel('Produit');
            $this->Produit->recursive = -1;
            $produits = $this->Produit->find('list', array('fields' => array('Produit.id', 'Produit.name'),'conditions' => array('Produit.archive' => 1)));
            $offres=  $this->Offre->Offrespicial->find('all',array('conditions'=>array('Offrespicial.offre_id'=>$id)));
            $this->set(compact('produits','offres'));
        }
    }
    
    
    public function archive($id = null,$valide = null)
    {
        if($id==null)
        {
            $this->Offre->recursive = 1;
            $this->set('offres', $this->Offre->find('all',array('conditions'=>array('Offre.archive'=>0))));
        }
        else
        {
            $this->Offre->id = $id;
            $this->Offre->saveField('archive',$valide);
            if($valide==0)
            {
                $this->Session->setFlash(__('Offre Archivée'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Offre activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }
}