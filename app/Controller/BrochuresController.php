<?php

App::uses('AppController', 'Controller');

/**
 * Brochures Controller
 *
 * @property Brochure $Brochure
 * @property PaginatorComponent $Paginator
 */
class BrochuresController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('system_get_brochure');
    }
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    
    
    public function index() {
		$brochuresall=$this->Brochure->find("all",array("conditions"=>array("Brochure.archive"=>1)));
        $this->Brochure->recursive = 0;
        // debug($this->Brochure->find('list'));exit();
        $this->loadModel("Brochureorganise");
        $categories = $this->Brochureorganise->Category->find('list');
        $lignes = $this->Brochureorganise->Ligne->find('list');
        $gammes = $this->Brochure->Game->find('list');
		
        $this->set(compact('categories','lignes','gammes',"brochuresall"));
    }
    
    function system_getbrochures($ligne=null,$cat=null)
    {
        $this->loadModel("Brochureorganise");
        $brochures=$this->Brochureorganise->find("all",array('conditions'=>array('Brochureorganise.ligne_id'=>$ligne,
            'Brochureorganise.category_id'=>$cat,"Brochureorganise.ordre!=''"),"order"=>array("Brochureorganise.ordre asc")));
        return $brochures;
    }
     public function organiser($cat_id=1) 
     {
        $this->loadModel("Brochureorganise");
        if ($this->request->is('post')) {
            foreach($this->request->data["Brochureorganise"] as $d)
            {
                if(isset($d["id"]))
                    $this->Brochureorganise->id=$d["id"];
                else
                     $this->Brochureorganise->create();
                $fin["Brochureorganise"]=$d;
                
                $this->Brochureorganise->save($fin);
            }
            $this->Session->setFlash(__('La organisation des brochures à été enregistré'));
            return $this->redirect(array("controller"=>'brochures','action' => 'index'));
        }
        $lignes = $this->Brochureorganise->Ligne->find('list');
        $this->Brochureorganise->Brochure->recursive = -1;
        $brochures = $this->Brochureorganise->Brochure->find('all',array('conditions'=>array('Brochure.archive'=>1,'Brochure.category_id'=>$cat_id)));
        $organiser = $this->Brochureorganise->find('all',array('conditions'=>array('Brochureorganise.category_id'=>$cat_id)));
        $this->set(compact('organiser', 'cat_id', 'lignes', 'brochures'));
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
        if (!$this->Brochure->exists($id)) {
            throw new NotFoundException(__('Brochure invalide'));
        }
        $brochure=$this->Brochure->find('first', array('conditions' => array('Brochure.id' => $id)));
		$this->loadModel("Brochureorganise");
		$categories = $this->Brochureorganise->Category->find('list');
        $lignes = $this->Brochureorganise->Ligne->find('list');
        $this->set(compact('categories','lignes','brochure'));
    }
    
    public function detail_vmp($user_id = null) 
    {
        $this->loadModel('Affectation');
        $this->Affectation->recursive = -1;
        $listes=  $this->Affectation->Liste->find('list',array('conditions'=>array('Liste.user_id'=>$user_id)));
        $ids=0;
        foreach ($listes as $key => $value) 
            $ids=$ids.",".$key;
        $listes=  $this->Affectation->find('all',array('conditions'=>array("Affectation.liste_id in($ids)")));
        $ids=0;
        foreach ($listes as $key ) 
            $ids=$ids.",".$key['Affectation']['client_id'];
        $clients = $this->Brochure->query("select categories.name, brochures.name,brochures.file,count(brochures.id), sum(temps.durree) from categories,temps,brochures where 
                        brochures.id=temps.brochure_id and  temps.client_id in($ids) and categories.id=brochures.category_id
                        group by brochure_id order by categories.name asc");
        $this->set('brochures', $clients);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Brochure->create();
            $date=date('H-i-s');
            $file=$this->request->data['Brochure']['logo']['tmp_name'];
			$ext= explode(".",$this->request->data['Brochure']['logo']['name']);
            $ext=".".$ext[count($ext)-1];
            if(!empty($file))
            {
                $this->request->data['Brochure']['logo']=$date.''.rand()."$ext";
                move_uploaded_file($file,'img/brochures/'.$this->request->data['Brochure']['logo']);
            }else{
				$this->request->data['Brochure']['logo']="";
			}
            
            if(!empty($this->request->data['Brochure']['file']))
            {
                $nb=1;
                $n=1;
                foreach ($this->request->data['Brochure']['file'] as $image)
                {
                    if($nb>=5)
                        break;
                    $n=$nb;
                    if($nb==1)
                        $n="";
                    $data=array();
                    $date=date('H-i-s');
                    $file=$image['tmp_name'];
                    $ext=explode(".",$image['name']);
                    $ext=$ext[count($ext)-1];
                    if($image['size']>0)
                    {
                        $filename=$date.''.rand().'.'.$ext;
                        $this->request->data['Brochure']['file'.$n]=$filename;
                        move_uploaded_file($file,'img/brochures/'.$filename);
                        $nb++;
                    }else
                        $this->request->data['Brochure']['file'.$n]="";
                }
            }
            if ($this->Brochure->save($this->request->data)) {
                $this->Session->setFlash(__('Brochure ajoutée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La brochure n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
        $categories = $this->Brochure->Category->find('list');
        $this->set(compact('categories'));
        $this->set('games', $this->Brochure->Game->find('list'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Brochure->exists($id)) {
            throw new NotFoundException(__('Brochure invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
			$options = array('conditions' => array('Brochure.' . $this->Brochure->primaryKey => $id));
            $data = $this->Brochure->find('first', $options);
            $date=date('H-i-s');
            $file=$this->request->data['Brochure']['logo']['tmp_name'];
			$ext= explode(".",$this->request->data['Brochure']['logo']['name']);
            $ext=".".$ext[count($ext)-1];
            if(!empty($file))
            {
                $this->request->data['Brochure']['logo']=$date.''.rand()."$ext";
                move_uploaded_file($file,'img/brochures/'.$this->request->data['Brochure']['logo']);
            }else{
				$this->request->data['Brochure']['logo']=$data['Brochure']['logo'];
			}
            if(!empty($this->request->data['Brochure']['file']))
            {
                $nb=1;
                $n=1;
                foreach ($this->request->data['Brochure']['file'] as $image)
                {
                    if($nb>=5)
                        break;
                    $n=$nb;
                    if($nb==1)
                        $n="";
                    $data=array();
                    $date=date('H-i-s');
                    $file=$image['tmp_name'];
                    $ext=explode(".",$image['name']);
                    $ext=$ext[count($ext)-1];
                    if($image['size']>0)
                    {
                        $filename=$date.''.rand().'.'.$ext;
                        $this->request->data['Brochure']['file'.$n]=$filename;
                        move_uploaded_file($file,'img/brochures/'.$filename);
                        $nb++;
                    }
                    else{
                        unset($this->request->data['Brochure']['file']);
                        break;
                    }
                }
            }
            if ($this->Brochure->save($this->request->data)) {
                $this->Session->setFlash(__('Brochure modifiée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('La brochure n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Brochure.' . $this->Brochure->primaryKey => $id));
            $this->request->data = $this->Brochure->find('first', $options);
        }
        $categories = $this->Brochure->Category->find('list');
        $this->set(compact('categories'));
        $this->set('games', $this->Brochure->Game->find('list'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function archive($id = null,$valide = null)
    {
        if($id==null)
        {
            $this->Brochure->recursive = 0;
            $this->set('brochures', $this->Brochure->find('all',array('conditions'=>array('Brochure.archive'=>0))));
        }
        else
        {
            $this->Brochure->id = $id;
            $this->Brochure->saveField('archive',$valide);
			$this->loadModel("Brochureorganise");
			$organises = $this->Brochureorganise->findAllByBrochureId($id);
			foreach($organises as $or)
			{
				$this->Brochureorganise->id=$or["Brochureorganise"]["id"];
				$this->Brochureorganise->delete();
			}
            if($valide==0)
            {
                $this->Session->setFlash(__('Brochure Archivée'));
                return $this->redirect(array('action' => 'index'));
            }
            else
            {
                $this->Session->setFlash(__('Brochure activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }
    
    
//    function rapport($client_id) {
//        if ($this->request->is('post')) {
//            $date = $this->Brochure->query("select id,date from visites where client_id=" . $this->request->data['Brochure'][0]['client_id'] . " order by id desc limit 1");
//            $date = date('Y-m-d H:m:s');
//            if (isset($this->request->data['Brochure'])) {
//                foreach ($this->request->data['Brochure'] as $value) {
//                    if (isset($value['brochure_id'])) {
//                        $d = array();
//                        $d['Temp']['client_id'] = $value['client_id'];
//                        $d['Temp']['brochure_id'] = $value['brochure_id'];
//                        $d['Temp']['durree'] = 0;
//                        $d['Temp']['date'] = $date;
//                        $this->loadModel('Temp');
//                        $this->Temp->create();
//                        $this->Temp->save($d);
//                    }
//                }
//            }
//            $this->Session->setFlash(__('Rapport ajouté'));
//            return $this->redirect(array('controller' => 'listes', 'action' => 'view'));
//        }
//        $this->Brochure->recursive = -1;
//        $cat = $this->Brochure->query("select Category.id from clients as Client , categories as Category "
//                . "where Client.category_id =Category.id and Client.id=$client_id");
//        $brochures = $this->Brochure->find('all', array('conditions' => array('Brochure.category_id' => $cat[0]['Category']['id'])));
//        if (empty($brochures)) {
//            $this->Session->setFlash(__('Rapport ajouté'));
//            return $this->redirect(array('controller' => 'listes', 'action' => 'view'));
//        }
//        $this->set(compact('brochures', "client_id"));
//    }

    function system_get_brochure($id)
    {
        $this->Brochure->recursive = -1;
        $brochure=  $this->Brochure->findById($id);
        return $brochure;
    }
    
    function archivetous()
    {
        $this->Brochure->query('UPDATE brochures SET `archive`=0');
        $this->Session->setFlash(__('Toutes les brochures sont archivées'));
        return $this->redirect(array('action' => 'archive'));
    }
	
	
	
	//envoie la liste des brochure présenté par client_id dans une date précis 
	//appeler seulement dans views/clients/detail_visite.ctp line 50
	function system_get_temp_for_client($client_id,$date_debut,$date_fin)
	{
		//$this->loadModel('Temp');
		//$this->Temp->recursive = -1;
		//$temps=$this->Temp->find('all',array('conditions'=>array('Temp.client_id'=>$client_id." and date BETWEEN '$date_debut' and '$date_fin' ")));
		$temps=$this->Brochure->query("select count(brochures.id) as nombre,brochures.name,brochures.id from temps, brochures 
										where temps.brochure_id=brochures.id and client_id=$client_id and temps.date BETWEEN '$date_debut' and '$date_fin'
										group by brochures.id");
		return $temps;
	}
	
	//-----------------------------pour ordre des produits
	function ajouter_ordre($brochureorganise_id=0)
	{
		if ($this->request->is('post')) 
		{
			if($brochureorganise_id==0)
			{
				$this->Session->setFlash("Ordre ajouté");
				$this->Brochure->Brochureorganise->create();
			}
			else
			{
				$this->Session->setFlash("Ordre modifier");
				$this->Brochure->Brochureorganise->id=$brochureorganise_id;
			}
			$this->Brochure->Brochureorganise->save($this->request->data);
			
			$this->redirect($this->referer());
		}
	}
	
	
	function supprimer_ordre($id=null)
	{
		$this->Brochure->Brochureorganise->id = $id;
		if (!$this->Brochure->Brochureorganise->exists()) {
			throw new NotFoundException(__('Invalid Brochure'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Brochure->Brochureorganise->delete()) {
			$this->Session->setFlash(__('L\'ordre à été supprimer'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Ordre was not deleted'));
		$this->redirect($this->referer());
	}
	
	
	

}
