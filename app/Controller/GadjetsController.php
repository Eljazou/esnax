<?php

App::uses('AppController', 'Controller');


class GadjetsController extends AppController {

    public $components = array('Paginator');

    public function index() {
		$this->loadModel('Echantillon');
        $echantillons = $this->Echantillon->find('list',array('archive=1'));
        $this->Gadjet->User->recursive = -1;
		if (AuthComponent::user('role') == "Super viseur") {
			$super=$this->Gadjet->User->find('all',array('conditions' =>array('User.id'=>AuthComponent::user('id'))));
		}
		else
			$super=$this->Gadjet->User->find('all',array('conditions' =>array('User.role'=>'Super viseur','User.archive'=>1)));
        $this->set(compact('super', 'echantillons'));
    }

    
    
    public function voir($echantient_id=null,$date_debut=null,$date_fin=null) 
    {
        $echantillons = $this->Gadjet->Echantillon->find('list', array('conditions' =>array('Echantillon.id' => $echantient_id)));
		$this->Gadjet->User->recursive=-1;
        $users=$this->Gadjet->User->find('all',array('conditions' =>array('User.archive=1')));
        $this->set(compact('echantillons','users'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) 
		{
           
            // debug($$this->request->data["Gadjet"]["json"]);
			// $data=json_decode($this->request->data["Gadjet"]["json"],true);
			// $dataa="";
			// foreach($data as $k=>$v)
			// 	$dataa="$dataa&$k=$v";
			// $d=array();
			// parse_str($dataa, $d);
			
			// exit();
            foreach ($this->request->data['g'] as $value)
            {
				
                // if($value['Gadjet']['quantite']!='' && $value['Gadjet']['quantite']!=0)
                // {
					
                    $this->Gadjet->create();
                    $this->Gadjet->save($value);
                // }
            }
            $this->Session->setFlash(__('Demande ajoutée'));
            return $this->redirect(array('action' => 'index'));
            
        }
		$this->Gadjet->User->recursive=-1;
		if(AuthComponent::user('role')=="Super viseur")
			$users = $this->Gadjet->User->find('all',array('conditions'=>array('User.archive'=>1,"User.id"=>AuthComponent::user('id'))));
		else
			$users = $this->Gadjet->User->find('all',array('conditions'=>array('User.archive'=>1,"User.role"=>'Super viseur')));
        /*$this->loadModel('Apartient');
        $super = $this->Apartient->find('all', array('conditions' =>array('Apartient.user_id' => AuthComponent::user('id'))));
        $this->Gadjet->User->recursive = -1;
        $user=  $this->Gadjet->User->findById( AuthComponent::user('id'));
        $super[]['User1']=$user['User'];*/
        $echantillons = $this->Gadjet->Echantillon->find('list', array('conditions' =>array('Echantillon.archive=1 ')));
        $this->set(compact('users', 'echantillons'));
    }
    
    public function edit($id = null) {
        if (!$this->Gadjet->exists($id)) {
            throw new NotFoundException(__('Gadget invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Gadjet->save($this->request->data)) {
                $this->Session->setFlash(__('Gadget modifié'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le gadget n\'a pas pu être modifié. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Gadjet.' . $this->Gadjet->primaryKey => $id));
            $this->request->data = $this->Gadjet->find('first', $options);
        }
        $users = $this->Gadjet->User->find('list');
        $echantillons = $this->Gadjet->Echantillon->find('list');
        $this->set(compact('users', 'echantillons'));
    }

    
    
    function system_get_quantite($user_id,$echantillon_id)
    {
        $this->Gadjet->recursive = -1;
            $gadjet=  $this->Gadjet->find('all',array('conditions'=>array('Gadjet.user_id'=>$user_id
                ,'Gadjet.echantillon_id'=>$echantillon_id,'Gadjet.archive'=>0)));
        return $gadjet;
    }
    
    
    function admin($valide=null)
    {
        if ($this->request->is('post')) 
        {
            $info=  $this->request->data['Gadjet']['info'];
            $quantite=$this->request->data['Gadjet']['quantite'];
            $quntite_existe= $this->system_get_quantite_admin($info);
            if($quntite_existe!=$quantite) 
            {
                if($quntite_existe>$quantite)
                {
                    $quantite=$quntite_existe-$quantite;
                    while($quantite>0)
                    {
                        $gadjets=  $this->Gadjet->find('all',array('conditions'=>array('Gadjet.archive'=>0
                            ,'Gadjet.echantillon_id'=>$info)));
                        foreach ($gadjets as $value) {
                            if($value['Gadjet']['quantite']>0)
                            {
                                $this->Gadjet->id=$value['Gadjet']['id'];
                                $this->Gadjet->saveField('quantite',($value['Gadjet']['quantite']-1));
                                $quantite--;
                                echo $quantite.' '.$value['Gadjet']['id'];
                            }
                            if($quantite==0)
                                break;
                        }
                    }
                }
                else if($quntite_existe<$quantite)
                {
                    $quantite=$quantite-$quntite_existe;
                    while($quantite>0)
                    {
                        $gadjets=  $this->Gadjet->find('all',array('conditions'=>array('Gadjet.archive'=>0
                            ,'Gadjet.echantillon_id'=>$info)));
                        foreach ($gadjets as $value) {
                            $this->Gadjet->id=$value['Gadjet']['id'];
                            $this->Gadjet->saveField('quantite',($value['Gadjet']['quantite']+1));
                            $quantite--;
                        if($quantite==0)
                            break;
                        }
                    }
                }
            }
            $this->Session->setFlash(__('Les demandes sont bien changé'));
            return $this->redirect(array('action' => "admin"));
            
        }
        if($valide!=null)
        {
            $this->Gadjet->recursive = -1;
            $gadss=  $this->Gadjet->find('all', array('conditions' =>array("Gadjet.archive =0")));
            $this->loadModel('Stockgadjet');
            $this->Stockgadjet->recursive = -1;
            foreach ($gadss as $gads) {
                $stock=$this->Stockgadjet->find('first', array('conditions' =>array('Stockgadjet.user_id'=>$gads['Gadjet']['user_id'],
                    'Stockgadjet.echantillon_id'=>$gads['Gadjet']['echantillon_id'])));
                if(empty($stock))
                {
                    $this->Stockgadjet->create();
                    $s['Stockgadjet']['user_id']=$gads['Gadjet']['user_id'];
                    $s['Stockgadjet']['echantillon_id']=$gads['Gadjet']['echantillon_id'];
                    $s['Stockgadjet']['quantite']=$gads['Gadjet']['quantite'];
                    $this->Stockgadjet->save($s);
                }
                else
                {
                    $this->Stockgadjet->id=$stock['Stockgadjet']['id'];
                    $this->Stockgadjet->saveField('quantite',$stock['Stockgadjet']['quantite']+$gads['Gadjet']['quantite']);
                }
            }
            $this->Gadjet->query("UPDATE `gadjets` SET `archive`=1");

            $this->Session->setFlash(__('Les demandes sont bien validé'));
            return $this->redirect(array('action' => 'index'));
        }
        $echantillons = $this->Gadjet->Echantillon->find('list');
        $this->set(compact('echantillons'));
    }
    
    function system_get_quantite_admin($echantillon_id,$date_debut=null,$date_fin=null)
    {
        $this->Gadjet->recursive = -1;
        if($date_debut==null)
            $gadjet=  $this->Gadjet->find('all',array('fields' => array('sum(Gadjet.quantite) as total_sum'),
                'conditions'=>array('Gadjet.archive'=>0,'Gadjet.echantillon_id'=>$echantillon_id)));
        else
            $gadjet=  $this->Gadjet->find('all',array('fields' => array('sum(Gadjet.quantite) as total_sum'),'conditions'=>array('Gadjet.archive'=>0
              ,'Gadjet.echantillon_id'=>$echantillon_id,"Gadjet.date_debut>='$date_debut'","Gadjet.date_fin <='$date_fin'")));
        if(!empty($gadjet[0][0]['total_sum']))
            return $gadjet[0][0]['total_sum'];
        else
            return 0;
    }

}
