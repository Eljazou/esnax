<?php

App::uses('AppController', 'Controller');

/**
 * Prospectaffaires Controller
 *
 * @property Prospectaffaire $Prospectaffaire
 * @property PaginatorComponent $Paginator
 */
class ProspectaffairesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Prospectaffaire->recursive = 0;
        $this->set('prospectaffaires', $this->Prospectaffaire->find("all"));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) 
	{
        if (!$this->Prospectaffaire->exists($id)) {
            throw new NotFoundException(__('Invalid prospectaffaire'));
        }
        $prospectaffaire=$this->Prospectaffaire->find('first',array('conditions' => array('Prospectaffaire.id'=> $id)));
		$this->loadModel("User");
		$this->User->recursive=-1;
		$i=0;
		foreach( $prospectaffaire['Prospectcompagne'] as $p)
		{
			$user=$this->User->findById($p["user_id"]);
			$prospectaffaire["Prospectcompagne"][$i]["user"]=$user['User']['name'];
			$i++;
		}
        $this->set('prospectaffaire', $prospectaffaire);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Prospectaffaire->create();
            $this->request->data["Prospectaffaire"]["user_id"]=AuthComponent::user('id');
            if ($this->Prospectaffaire->save($this->request->data)) {
				$this->Prospectaffaire->saveField("code_wavesoft","AFF".$this->Prospectaffaire->id);

                $this->Session->setFlash(__('La prospectaffaire à été enregistré'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__("La prospectaffaire  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
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
        if (!$this->Prospectaffaire->exists($id)) {
            throw new NotFoundException(__('Invalid prospectaffaire'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Prospectaffaire->save($this->request->data)) {
                $this->Session->setFlash(__('La prospectaffaire à été enregistré'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The prospectaffaire could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Prospectaffaire.' . $this->Prospectaffaire->primaryKey => $id));
            $this->request->data = $this->Prospectaffaire->find('first', $options);
        }
        
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Prospectaffaire->id = $id;
        if (!$this->Prospectaffaire->exists()) {
            throw new NotFoundException(__('Invalid prospectaffaire'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Prospectaffaire->delete()) 
		{
			$prospectcompagnes=$this->Prospectaffaire->Prospectcompagne->find("all",array("conditions"=>array("Prospectcompagne.prospectaffaire_id"=>$id)));
			$this->loadModel('Prospectfeuille');
			foreach($prospectcompagnes as $comp)
			{
				$this->Prospectaffaire->Prospectcompagne->id=$comp["Prospectcompagne"]["id"];
				$this->Prospectaffaire->Prospectcompagne->delete();
				foreach($comp["Prospectfeuille"] as $feuille)
				{
					$this->Prospectfeuille->id=$feuille["id"];
					$this->Prospectfeuille->delete();
				}
			}
            $this->Session->setFlash(__('La Prospectaffaire à été supprimer'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Prospectaffaire was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
	
	
	
	
	function system_getaffaire($prospectcompagne_id=null)
	{
		$this->Prospectaffaire->Prospectcompagne->recursive=-1;
		$com=$this->Prospectaffaire->Prospectcompagne->findById($prospectcompagne_id);
		$affaire= $this->Prospectaffaire->findById($com['Prospectcompagne']['prospectaffaire_id']);
		$affaire["Prospectcompagne"]=$com["Prospectcompagne"];
		return $affaire;
	}

}
