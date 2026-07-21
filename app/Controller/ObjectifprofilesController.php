<?php

App::uses('AppController', 'Controller');

/**
 * Objectifprofiles Controller
 *
 * @property Objectifprofile $Objectifprofile
 * @property PaginatorComponent $Paginator
 */
class ObjectifprofilesController extends AppController {

    
    
    public function index($user_id=null) {
        $this->Objectifprofile->recursive = 0;
        $this->set('objectifprofiles', $this->Objectifprofile->find('all'));
        $this->set('user_id', $user_id);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Objectifprofile->exists($id)) {
            throw new NotFoundException(__('Invalid objectifprofile'));
        }
        $options = array('conditions' => array('Objectifprofile.' . $this->Objectifprofile->primaryKey => $id));
        $this->set('objectifprofile', $this->Objectifprofile->find('first', $options));
    }

    
    public function add() {
        if ($this->request->is('post')) {
            $this->Objectifprofile->create();
            foreach ($this->request->data as $value) {
                if(isset($value['type']))
                {
                    $data=array();
                    $this->Objectifprofile->create();
                    $data['Objectifprofile']['name']=$this->request->data['Objectifprofile']['name'];
                    $data['Objectifprofile']['type_id']=$value['type'];
                    $data['Objectifprofile']['objectif']=$value['objectif'];
                    $this->Objectifprofile->save($data);
                }
            }
            $this->Session->setFlash(__('Objectif profile est ajouté'));
            return $this->redirect(array('action' => 'index'));
        }
        $types = $this->Objectifprofile->Type->find('list');
        $this->set(compact('types'));
    }
    public function edit($id = null) {
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Objectifprofile->query("delete from objectifprofiles where name='".$this->request->data['Objectifprofile']['name']."'");
            foreach ($this->request->data as $value) {
                if(isset($value['type']))
                {
                    $data=array();
                    $this->Objectifprofile->create();
                    $data['Objectifprofile']['name']=$this->request->data['Objectifprofile']['name'];
                    $data['Objectifprofile']['type_id']=$value['type'];
                    $data['Objectifprofile']['objectif']=$value['objectif'];
                    $this->Objectifprofile->save($data);
                }
            }
            $this->Session->setFlash(__('Objectif profile est modifié'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $options = array('conditions' => array('Objectifprofile.name' => $id));
            $this->request->data = $this->Objectifprofile->find('all', $options);
        }
        $this->set(compact("id"));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     
    public function delete($id = null) {
        $this->Objectifprofile->query("delete from objectifprofiles where name='".$id."'");
            $this->Session->setFlash(__('Objectif profile est supprimé'));
            return $this->redirect(array('action' => 'index'));
        
    }
	*/

}
