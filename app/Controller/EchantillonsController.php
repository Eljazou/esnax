<?php



App::uses('AppController', 'Controller');



class EchantillonsController extends AppController {



    public $components = array('Paginator');



    public function index() {

        $this->Echantillon->recursive = 0;

        $this->set('echantillons', $this->Echantillon->find('all', array('conditions' => array('Echantillon.archive' => 1))));

    }



    /**

     * view method

     *

     * @throws NotFoundException

     * @param string $id

     * @return void

     */

    public function view($id = null) {

        if (!$this->Echantillon->exists($id)) {

            throw new NotFoundException(__('Echantillon invalide'));

        }

        $options = array('conditions' => array('Echantillon.' . $this->Echantillon->primaryKey => $id));

        $this->set('echantillon', $this->Echantillon->find('first', $options));

    }



    /**

     * add method

     *

     * @return void

     */

    public function add() {

        if ($this->request->is('post')) {
            $this->Echantillon->create();

            if ($this->Echantillon->save($this->request->data)) {

                $this->Session->setFlash(__('Echantillon ajouté'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('L\'échantillon n\'a pas pu être enregistré. Merci de réessayer.'));

            }

        }

        $this->set('games', $this->Echantillon->Game->find('list'));

    }



    /**

     * edit method

     *

     * @throws NotFoundException

     * @param string $id

     * @return void

     */

    public function edit($id = null) {

        if (!$this->Echantillon->exists($id)) {

            throw new NotFoundException(__('Echantillon invalide'));

        }

        if ($this->request->is('post') || $this->request->is('put')) {

            if ($this->Echantillon->save($this->request->data)) {

                $this->Session->setFlash(__('Echantillon modifié'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('L\'échantillon n\'a pas pu être modifié. Merci de réessayer.'));

            }

        } else {

            $options = array('conditions' => array('Echantillon.' . $this->Echantillon->primaryKey => $id));

            $this->request->data = $this->Echantillon->find('first', $options);

            $this->set('games', $this->Echantillon->Game->find('list'));

        }

    }



    /**

     * delete method

     *

     * @throws NotFoundException

     * @param string $id

     * @return void

     */

    public function archive($id = null, $valide = null) {

        if ($id != null) {

            $this->Echantillon->id = $id;

            $this->Echantillon->saveField('archive', $valide);

            if ($valide == 0) {

                $this->Session->setFlash(__('Echantillon archivé'));

                return $this->redirect(array('action' => 'index'));

            } else {

                $this->Session->setFlash(__('Echantillon activé'));

                return $this->redirect(array('action' => 'archive'));

            }

        }

        $actions = $this->Echantillon->find('all', array('conditions' => array('Echantillon.archive' => 0)));

        $this->set('echantillons', $actions);

    }



    function archivetous() {

        $this->Echantillon->query('UPDATE echantillons SET `archive`=0');

        $this->Session->setFlash(__('Tout les échantillons sont archivés'));

        return $this->redirect(array('action' => 'archive'));

    }



    public function system_get_name($id) {

        $this->Echantillon->recursive = -1;

        $ch = $this->Echantillon->find('first', array('conditions' => array('Echantillon.id' => $id)));

        return $ch['Echantillon']['name'];

    }



    public function stockvmp($user_id = null) {

        if ($user_id == null || AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur') {

            $user_id = AuthComponent::user('id');

        }

        if (AuthComponent::user('role') == "Super viseur") {

            

            $this->loadModel('Apartient');

            $this->Apartient->recursive = -1;

            $super=  $this->Apartient->find('all',array('conditions'=>array('Apartient.user_id'=>AuthComponent::user('id'))));

            $ids='0';

            foreach ($super as $value) {

                if($user_id==$value['Apartient']['user1_id'])

                    $ids=1;

            }

            if($ids==0)

                $user_id = AuthComponent::user('id');

        }

        $this->loadModel('Stockgadjet');

        $stock=$this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' =>$user_id,

            'Stockgadjet.quantite>0')));

        $this->set('stock', $stock);

        

    }

    public function system_get_stock($user_id = null) {

        $this->loadModel('Stockgadjet');

        $this->Stockgadjet->recursive = -1;

        $stock=$this->Stockgadjet->find('all', array('conditions' => array('Stockgadjet.user_id' =>$user_id,

            'Stockgadjet.quantite>0')));

        return $stock;

    }



}

