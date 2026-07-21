<?php

App::uses('AppController', 'Controller');


class FormationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Formation->recursive = 0;
        $this->set('formations',  $this->Formation->find("all",array("conditions"=>array('Formation.archive=1'))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Formation->exists($id)) {
            throw new NotFoundException(__('Formation invalide'));
        }
        $options = array('conditions' => array('Formation.' . $this->Formation->primaryKey => $id));
        $this->set('formation', $this->Formation->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Formation->create();
            $date=date('H-i-s');
            $file=$this->request->data['Formation']['file']['tmp_name'];
            $ext= substr($this->request->data['Formation']['file']['name'], -4);
            if(!empty($file))
            {
                $this->request->data['Formation']['file']=$date.''.rand()."$ext";
                move_uploaded_file($file,'img/formations/'.$this->request->data['Formation']['file']);
            }
			else
			{
				$this->Session->setFlash(__('Merci de joindre un fichier'));
                return $this->redirect(array('action' => 'add'));
			}
            if ($this->Formation->save($this->request->data)) {
                $this->Session->setFlash(__('Formation Ajoutée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La formation n\'a pas pu étre enregistrée. Merci de réessayer.'));
            }
        }
        $categories = $this->Formation->Category->find('list');
        $this->set('games', $this->Formation->Game->find('list'));
        $this->set(compact('categories'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Formation->exists($id)) {
            throw new NotFoundException(__('Formation invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $date=date('H-i-s');
            $file=$this->request->data['Formation']['file']['tmp_name'];
            $ext= substr($this->request->data['Formation']['file']['name'], -4);
            if(!empty($file))
            {
                $this->request->data['Formation']['file']=$date.''.rand()."$ext";
                move_uploaded_file($file,'img/formations/'.$this->request->data['Formation']['file']);
            }
            else
            {
                $options = array('conditions' => array('Formation.' . $this->Formation->primaryKey => $id));
                $data = $this->Formation->find('first', $options);
                $this->request->data['Formation']['file']=$data['Formation']['file'];
            }
            if ($this->Formation->save($this->request->data)) {
                $this->Session->setFlash(__('Formation modifiée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La formation n\'a pas pu étre modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Formation.' . $this->Formation->primaryKey => $id));
            $this->request->data = $this->Formation->find('first', $options);
        }
        $categories = $this->Formation->Category->find('list');
        $this->set('games', $this->Formation->Game->find('list'));
        $this->set(compact('categories'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function archive($id = null,$valide = null)
    {
        if($id==null)
        {
            $this->Formation->recursive = 0;
            $this->set('formations', $this->Formation->find('all',array('conditions'=>array('Formation.archive'=>0))));
        }
        else
        {
            $this->Formation->id = $id;
            $this->Formation->saveField('archive',$valide);
            if($valide==0)
            {
                $this->Session->setFlash(__('Formation Archivée'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Formation activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }
    
    function archivetous()
    {
        $this->Formation->query('UPDATE formations SET `archive`=0');
        $this->Session->setFlash(__('Toutes les formations sont archivées'));
        return $this->redirect(array('action' => 'archive'));
    }

}
