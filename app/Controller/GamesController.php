<?php

App::uses('AppController', 'Controller');

/**
 * Games Controller
 *
 * @property Game $Game
 * @property PaginatorComponent $Paginator
 */
class GamesController extends AppController {

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
        $this->Game->recursive = -1;
        $this->set('games', $this->Game->find('all',array('conditions'=>array('Game.archive'=>1))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Game->exists($id)) {
            throw new NotFoundException(__('Invalid game'));
        }
        $options = array('conditions' => array('Game.' . $this->Game->primaryKey => $id));
        $this->set('game', $this->Game->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Game->create();
            if ($this->Game->save($this->request->data)) {
                $this->Session->setFlash(__('The game has been saved'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The game could not be saved. Please, try again.'));
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
        if (!$this->Game->exists($id)) {
            throw new NotFoundException(__('Invalid game'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Game->save($this->request->data)) {
                $this->Session->setFlash(__('The game has been saved'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The game could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Game.' . $this->Game->primaryKey => $id));
            $this->request->data = $this->Game->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     
    public function delete($id = null) {
        $this->Game->id = $id;
        if (!$this->Game->exists()) {
            throw new NotFoundException(__('Invalid game'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Game->delete()) {
            $this->Session->setFlash(__('Game deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Game was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    */
    
    function system_get_name_game($id=null)
    {
		if($id==null)
			return "";
        $this->Game->recursive = -1;
        $user=  $this->Game->findById($id);
		if(!empty($user))
			return $user['Game']['name'];
		else
			return "";
    }
public function archive($id = null,$valide = null) 
    {
        if($id==null)
        {
            $this->Game->recursive = 0;
            $this->set('games', $this->Game->find('all',array('conditions'=>array('Game.archive'=>0))));
        }
        else
        {
            $this->Game->id = $id;
            $this->Game->saveField('archive',$valide);
            if($valide==0)
            {
                $this->Session->setFlash(__('Gamme Archivée'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Gamme activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }
}
