<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'users');

/**
 * Groventes Controller
 *
 * @property Grovente $Grovente
 * @property PaginatorComponent $Paginator
 */
class GroventesController extends AppController {

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
        if (AuthComponent::user('role') == 'VMP' || AuthComponent::user('role') == 'Coordinateur')
        {
            $users = new UsersController;
            $user_id=$users->system_get_superviseur(AuthComponent::user('id'));
            $user_id=$user_id['User']['id'];
        }
        else if (AuthComponent::user('role') == 'Super viseur')
            $user_id=AuthComponent::user('id');
        else
            $user_id=0;
        if($user_id==0)
             $this->set('grosistes', $this->Grosiste->find("all",array("conditions"=>array('Grosiste.archive=1'))));
        else
            $this->set('grosistes', $this->Grosiste->find("all",array("conditions"=>array('Grosiste.super_id'=>$user_id,'Grosiste.archive=1'))));
        $this->Grovente->recursive = 0;
        $this->set('groventes', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($produit_id ,$date) {
        $ventes=$this->Grovente->find('all',array("conditions"=>array("Grovente.groproduit_id"=>"$produit_id  ",
                "Grovente.date BETWEEN \"$date-01\" AND \"$date-31\"")));
        $this->set('ventes',$ventes);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($grossiste_id) {
        if ($this->request->is('post')) {
            
            for($i=0;$i<count($this->request->data)-1;$i++)
            {
                $d=array();
                $d=$this->request->data[$i];
                if($d['Grovente']["quantite"]==0 || $d['Grovente']["quantite"]=="" || $d['Grovente']["quantite"]==null)
                    continue;
                $d['Grovente']['user_id']=AuthComponent::user('id');
                $d['Grovente']['date']=$this->request->data['Grovente']['date'];
                $d['Grovente']['grosiste_id']=$this->request->data['Grovente']['grosiste_id'];
                $this->Grovente->create();
                $this->Grovente->save($d);
                
            }
            $this->Session->setFlash("Commande inséré");
            return $this->redirect(array("controller"=>"grosistes",'action' => 'view',$this->request->data['Grovente']['grosiste_id']));
           
        }
        $groproduits = $this->Grovente->Groproduit->find('list',array("conditions" => array('Groproduit.archive=1')));
        $this->set(compact('grossiste_id', 'groproduits'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
		
        if ($this->request->is('post') || $this->request->is('put')) {
			$options = array('conditions' => array('Grovente.id' => $this->request->data["Grovente"]["id"]));
            $v = $this->Grovente->find('first', $options);
			
            if ($this->Grovente->save($this->request->data)) {
                $this->Session->setFlash(__('Modification effectuée'));
				$d=explode("-",$v["Grovente"]["date"]);
                $date=$d[0]."-".$d[1];
                return $this->redirect(array('action' => 'view',$v["Grovente"]["grosiste_id"],$date));
            } else {
                $this->Session->setFlash(__('The grovente could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Grovente.' . $this->Grovente->primaryKey => $id));
            $this->request->data = $this->Grovente->find('first', $options);
        }
        
    }

    

}
