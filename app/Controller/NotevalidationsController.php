<?php
App::uses('AppController', 'Controller');
/**
 * Notevalidations Controller
 *
 * @property Notevalidation $Notevalidations
 * @property PaginatorComponent $Paginator
 */
class NotevalidationsController extends AppController {

	public function index() {
        $this->Notevalidation->recursive = 0;
        $this->set('notevalidations', $this->Notevalidation->find("all"));
		$this->loadModel("User");
        $this->set('users', $this->User->find("list",array("conditions"=>array("User.archive"=>1))));
    }
	
	
	
	 public function add() 
	 {
        if ($this->request->is('post')) {
			$this->request->data['Notevalidation']['users'] = implode(';', $this->request->data['Notevalidation']['users']);

            $this->Notevalidation->create();
            if ($this->Notevalidation->save($this->request->data)) 
			{
                $this->Session->setFlash(__('Validation ajouté'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La validation n\'a pas pu étre enregistré. Merci de réessayer.'));
            }
        }
		$this->loadModel("User");
		$this->set('users', $this->User->find("list",array("conditions"=>array("User.archive"=>1))));

    }
	
	
	
	
	
	
	public function delete($id = null) {
		$this->Notevalidation->id = $id;
		if (!$this->Notevalidation->exists()) {
			throw new NotFoundException(__('Invalid validation'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notevalidation->delete()) {
			$this->Session->setFlash(__('La validation à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('validation was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}

}
