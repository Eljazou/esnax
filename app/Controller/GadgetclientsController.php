<?php

App::uses('AppController', 'Controller');

/**
 * Gadgetclients Controller
 *
 * @property Gadgetclient $Gadgetclient
 * @property PaginatorComponent $Paginator
 */
class GadgetclientsController extends AppController {



    public function statistique() 
	{
		$date_debut=date("Y-m-d");
		$date_fin=date("Y-m-t");
        if ($this->request->is('post')) {
            $d = explode("--",$this->request->data["date"]);
			$date_debut=$d[0];
            $date_fin = $d[1];
        } else {
            $this->request->data["Client"]["date_debut"] = $date_debut;
            $this->request->data["Client"]["date_fin"] = $date_fin;
        }
        $this->loadModel("Category");
        $this->loadModel("Secteur");

        $categories = $this->Category->find("list");
        $this->Secteur->recursive = -1;
        $secteurs = $this->Secteur->find("list");
        
		
        $this->Gadgetclient->recursive = 1;
		$gadgetclients = $this->Gadgetclient->find('all', array('conditions' => array("Gadgetclient.created between '$date_debut' and '$date_fin'")));
		
		

        $this->set(compact('gadgetclients','date_debut','date_fin',"categories","secteurs"));
    }



    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Gadgetclient->create();
			$this->request->data["Gadgetclient"]["user_id"]=AuthComponent::user('id');
            if ($this->Gadgetclient->save($this->request->data)) {
                $this->Session->setFlash(__('Ajout effectuer '));
                return $this->redirect(array("controller"=>"clients",'action' => 'view',$this->request->data["Gadgetclient"]["client_id"]));
            } else {
                $this->Session->setFlash(__('The Gadgetclient could not be saved. Please, try again.'));
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
        if (!$this->Gadgetclient->exists($id)) {
            throw new NotFoundException(__('Invalide produit'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Gadgetclient->save($this->request->data)) 
			{
				$g=$this->Gadgetclient->find('first', array('conditions' => array('Gadgetclient.id' => $this->request->data["Gadgetclient"]["id"])));
                $this->Session->setFlash(__('Modification effectuer '));
                return $this->redirect(array("controller"=>"clients",'action' => 'view',$g["Gadgetclient"]["client_id"]));
            } else {
                $this->Session->setFlash(__('The Gadgetclient could not be saved. Please, try again.'));
            }
        } else {
            
        }
    }
	
	
	function supprimer($id)
	{
		$this->Gadgetclient->id=$id;
		$this->Gadgetclient->delete();
		$this->Session->setFlash('Suppression effectuer ');
		$this->redirect($this->referer());

	}
	
	
	

    

}
