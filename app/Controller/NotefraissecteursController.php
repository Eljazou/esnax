<?php

App::uses('AppController', 'Controller');

/**
 * Notefraissecteurs Controller
 *
 * @property Notefraissecteur $Notefraissecteur
 * @property PaginatorComponent $Paginator
 */
class NotefraissecteursController extends AppController {

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
        $this->Notefraissecteur->recursive = 0;
        $this->set('notefraissecteurs', $this->Notefraissecteur->find("all"));
    }

    
    

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Notefraissecteur->create();
            if($this->request->data["Notefraissecteur"]["nuit"]=="Ville")
                $this->request->data["Notefraissecteur"]["nuit"]=$this->request->data["Notefraissecteur"]["ville"];
            else
                $this->request->data["Notefraissecteur"]["nuit"]=$this->request->data["Notefraissecteur"]["destination"];
            if ($this->Notefraissecteur->save($this->request->data)) 
            {
                $this->Session->setFlash(__('La notefraissecteur à été enregistré'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__("La notefraissecteur  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
            }
        }
        
        $this->loadModel("Secteur");
        $this->Secteur->recursive=-1;
        $villes=$this->Secteur->find("all",array("fields"=>array('DISTINCT (Secteur.ville) as ville'),"order"=>"Secteur.ville asc"));
        $data=array();
        foreach ( $villes as $ville)
        {
            $ville=strtolower($ville["Secteur"]["ville"]);
            $data[$ville]=$ville;
        }
        $this->set("villes",$data);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Notefraissecteur->exists($id)) {
            throw new NotFoundException(__('Invalid notefraissecteur'));
        }
        if ($this->request->is('post') || $this->request->is('put')) 
        {
            if($this->request->data["Notefraissecteur"]["nuit"]=="Ville")
                $this->request->data["Notefraissecteur"]["nuit"]=$this->request->data["Notefraissecteur"]["ville"];
            else
                $this->request->data["Notefraissecteur"]["nuit"]=$this->request->data["Notefraissecteur"]["destination"];
			
            if ($this->Notefraissecteur->save($this->request->data)) {
                $this->Session->setFlash(__('La notefraissecteur à été enregistré'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The notefraissecteur could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Notefraissecteur.' . $this->Notefraissecteur->primaryKey => $id));
            $this->request->data = $this->Notefraissecteur->find('first', $options);
        }
        
        $this->loadModel("Secteur");
        $this->Secteur->recursive=-1;
        $villes=$this->Secteur->find("all",array("fields"=>array('DISTINCT (Secteur.ville) as ville'),"order"=>"Secteur.ville asc"));
        $data=array();
        foreach ( $villes as $ville)
        {
            $ville=strtolower($ville["Secteur"]["ville"]);
            $data[$ville]=$ville;
        }
        $this->set("villes",$data);
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Notefraissecteur->id = $id;
        if (!$this->Notefraissecteur->exists()) {
            throw new NotFoundException(__('Invalid notefraissecteur'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Notefraissecteur->delete()) {
            $this->Session->setFlash(__('La Notefraissecteur à été supprimer'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Notefraissecteur was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}
