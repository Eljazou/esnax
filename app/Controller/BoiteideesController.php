<?php
App::uses('AppController', 'Controller');
/**
 * Boiteidees Controller
 *
 * @property Boiteidee $Boiteidee
 * @property PaginatorComponent $Paginator
 */
class BoiteideesController extends AppController {



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Boiteidee->recursive = 0;
		if (AuthComponent::user('role') == 'Admin')
			$boiteidees=$this->Boiteidee->find("all");
		else 
		{
			$this->loadModel("User");
			$this->User->Apartient->recursive = -1;
			$users = $this->User->Apartient->find('all', array('conditions' =>
				array('Apartient.user_id' => AuthComponent::user('id'))));
			$ids = '0';
			foreach ($users as $value)
				$ids = $ids . ',' . $value["Apartient"]['user1_id'];
			$boiteidees=$this->Boiteidee->find("all",array("conditions"=>array("Boiteidee.user_id in($ids)")));
		}
		$this->set('boiteidees', $boiteidees);
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Boiteidee->create();
			if ($this->Boiteidee->save($this->request->data)) {
				$this->Session->setFlash(__('La boiteidee à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("La boiteidee  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
			}
		}
		$users = $this->Boiteidee->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Boiteidee->id = $id;
		if (!$this->Boiteidee->exists()) {
			throw new NotFoundException(__('Invalid boiteidee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Boiteidee->delete()) {
			$this->Session->setFlash(__('L\'idee à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Boiteidee was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
