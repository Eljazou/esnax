<?php
App::uses('AppController', 'Controller');

class HopitalsController extends AppController
{
    public $components = array('Paginator');

    public function index()
    {
        $this->Hopital->recursive = -1;
        $hopitals = $this->Hopital->find('all', array('order' => array('Hopital.name' => 'ASC')));

        // Client count per hospital
        $this->loadModel('Client');
        $this->Client->recursive = -1;
        $counts_raw = $this->Client->find('all', array(
            'fields'     => array('Client.hopital_id', 'COUNT(Client.id) AS nb_clients'),
            'conditions' => array('Client.hopital_id IS NOT NULL'),
            'group'      => array('Client.hopital_id')
        ));
        $counts = array();
        foreach ($counts_raw as $c) {
            $counts[$c['Client']['hopital_id']] = $c[0]['nb_clients'];
        }

        $this->set(compact('hopitals', 'counts'));
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->Hopital->create();
            if ($this->Hopital->save($this->request->data)) {
                $this->Session->setFlash('Hôpital ajouté avec succès.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('Erreur lors de l\'ajout.', 'default', array('class' => 'alert alert-danger'));
        }
    }

    public function edit($id = null)
    {
        if (!$this->Hopital->exists($id)) {
            throw new NotFoundException('Hôpital introuvable');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Hopital->save($this->request->data)) {
                $this->Session->setFlash('Hôpital modifié avec succès.', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('Erreur lors de la modification.', 'default', array('class' => 'alert alert-danger'));
        } else {
            $this->request->data = $this->Hopital->findById($id);
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod('post', 'delete');
        if (!$this->Hopital->exists($id)) {
            throw new NotFoundException('Hôpital introuvable');
        }
        if ($this->Hopital->delete($id)) {
            $this->Session->setFlash('Hôpital supprimé.', 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash('Impossible de supprimer cet hôpital.', 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
