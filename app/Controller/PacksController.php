<?php
App::uses('AppController', 'Controller');
/**
 * Packs Controller
 *
 * @property Pack $Pack
 * @property PaginatorComponent $Paginator
 */
class PacksController extends AppController {

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
		$this->Pack->recursive = 0;
		$this->set('packs', $this->Pack->find("all"));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pack->exists($id)) {
			throw new NotFoundException(__('Invalid pack'));
		}
		$options = array('conditions' => array('Pack.' . $this->Pack->primaryKey => $id));
		$this->set('pack', $this->Pack->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($client_id=0) {
		if ($this->request->is('post')) {
			$this->Pack->create();
			$this->request->data["Pack"]["user_id"]=AuthComponent::user('id');
			if(AuthComponent::user('role')=="Super viseur")
                $this->request->data['Pack']['valide']=1;

			if ($this->Pack->save($this->request->data)) 
			{
				foreach($this->request->data["Packdetail"] as $value)
				{
					if($value["nombre"]!="")
					{
						$this->Pack->Packdetail->create();
						$value["pack_id"]=$this->Pack->id;
						$this->Pack->Packdetail->save($value);
					}
				}
				$this->Session->setFlash(__('Le pack à été enregistré'));
				return $this->redirect(array("controller"=>"clients",'action' => 'view',$this->request->data["Pack"]["client_id"]));
			} else {
				$this->Session->setFlash(__("La pack  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
			}
		}
		$this->loadModel("Game");
		$games=$this->Game->find("list");
		$this->set(compact('games',"client_id"));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pack->exists($id)) {
			throw new NotFoundException(__('Invalid pack'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pack->save($this->request->data)) {
				$this->Session->setFlash(__('La pack à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pack could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pack.' . $this->Pack->primaryKey => $id));
			$this->request->data = $this->Pack->find('first', $options);
		}
		$this->loadModel("Game");
		$games=$this->Game->find("list");
        $this->set('games', $games);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pack->id = $id;
		if (!$this->Pack->exists()) {
			throw new NotFoundException(__('Invalid pack'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pack->delete()) {
			$this->Session->setFlash(__('La Pack à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pack was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
	
	
	
	function valider($id=null,$valide=null)
	{
        if ($id!=null && $valide!=null)
        {
            $this->Pack->id=$id;
            $this->Pack->saveField('valide',$valide);
		}
		if(AuthComponent::user('role')=="Super viseur")
        {
            $this->loadModel('Apartient');
            $this->Apartient->recursive = -1;
            $super=  $this->Apartient->find('all',array('conditions'=>array('Apartient.user_id'=>AuthComponent::user('id'))));
            $ids='0';
            foreach ($super as $value) {
                $ids=$ids.','.$value['Apartient']['user1_id'];
            }
            $packs=$this->Pack->find('all',array('conditions'=>array('Pack.valide'=>0,"Pack.user_id in($ids)")));
        }
		else if(AuthComponent::user('role')=='Responsable promotion')
			$packs=$this->Pack->find('all',array('conditions'=>array('Pack.valide'=>0)));
        else
            $packs=$this->Pack->find('all',array('conditions'=>array('Pack.valide'=>0)));
		$this->loadModel("Game");
		$games=$this->Game->find("list");
        $this->set('packs', $packs);
        $this->set('games', $games);
	}
}
