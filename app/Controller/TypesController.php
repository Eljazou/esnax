<?php

App::uses('AppController', 'Controller');

/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 */
class TypesController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("system_cron_requetes");         
    }
	
	function system_cron_requetes()
	{
		//had requete permet de supprimer double visite dans le meme jour de meme VM et meme client
		$re="DELETE FROM visites WHERE id IN (
			SELECT * 
			FROM (
			 select id from visites
			GROUP BY client_id, DATE( DATE ),user_id
			HAVING COUNT(*) >1
			)tmp
			)";
		debug($this->Type->query($re));
		debug($this->Type->query($re));
		exit();
	}
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Type->recursive = 0;
        $this->set('types', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Type->exists($id)) {
            throw new NotFoundException(__('Type invalide'));
        }
		$this->loadModel("Secteur");
		$this->Secteur->recursive = -1;
		
		$this->loadModel("Category");
		$this->Category->recursive = -1;
		
        $this->set('type', $this->Type->find('first', array('conditions' => array('Type.id'=> $id))));
		$this->set('secteurs',$this->Secteur->find("list"));
		$this->set('categories',$this->Category->find("list"));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Type->create();
            if ($this->Type->save($this->request->data)) {
                $this->Session->setFlash(__('Type ajouté'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le type n\'a pas pu étre enregistré. Merci de réessayer.'));
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
        if (!$this->Type->exists($id)) {
            throw new NotFoundException(__('Type invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Type->save($this->request->data)) {
                $this->Session->setFlash(__('Type modifié'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le type n\'a pas pu étre modifié. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
            $this->request->data = $this->Type->find('first', $options);
        }
    }
    
    
    function system_get_name($id)
    {
        $type=  $this->Type->findById($id);
        return $type['Type']['name'];
    }


    function system_walo()
    {
        $this->loadModel("Visite");
        $this->loadModel("Apartient");
        $this->Visite->recursive = -1;
        $this->Apartient->recursive = -1;
        $visites = $this->Visite->find("all", array("fields" => array("Visite.id","Visite.user_id","Visite.latitude","Visite.longitude",
                                            "Visite.created", "Visite.type_visite"),
                    "conditions" => array("Visite.archive" => 1, "Visite.type_visite" => "double","Visite.double_id IS NULL"),
                    "order" => array("Visite.created" => "DESC")));
        echo count($visites);exit();

            $apartients = $this->Apartient->find("all", array("conditions" => array("Apartient.type"=>"Normal")));
        //debug($apartients);exit();
        foreach ($visites as $visite) {
            $d=[];

            foreach ($apartients as $apartient) {
                if($apartient["Apartient"]["user1_id"]==$visite["Visite"]["user_id"])
                {
                    $d["Visite"]["double_id"]=$apartient["Apartient"]["user_id"];
                    $d["Visite"]["double_date_validation"]=$visite["Visite"]["created"];
                    $d["Visite"]["double_gps"]=$visite["Visite"]["latitude"].",".$visite["Visite"]["longitude"];
                    $this->Visite->id = $visite["Visite"]["id"];
                    $this->Visite->save($d);
                    
                    break;
                }
            }
            
        }        
        

        echo "SAlit";exit();
    }
}
