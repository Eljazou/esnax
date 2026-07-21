<?php

App::uses('AppController', 'Controller');

/**
 * Prospectcompagnes Controller
 *
 * @property Prospectcompagne $Prospectcompagne
 * @property PaginatorComponent $Paginator
 */
class ProspectcompagnesController extends AppController {

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Prospectcompagne->recursive = 0;
        $this->set('prospectcompagnes', $this->Prospectcompagne->find("all"));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Prospectcompagne->exists($id)) {
            throw new NotFoundException(__('Invalid prospectcompagne'));
        }
        $prospectcompagne = $this->Prospectcompagne->find('first', array('conditions' => array('Prospectcompagne.id' => $id)));
        $this->loadModel("Client");
        $this->Client->Secteur->recursive = -1;
        $secteurs = $this->Client->Secteur->find("all");
		$this->loadModel("User");
		$users=$this->User->find("list",array("conditions"=>array("User.archive"=>1)));
		$clients=array();
		$ids=0;
		if (!empty($prospectcompagne['Prospectfeuille']))
		{
			foreach ($prospectcompagne['Prospectfeuille'] as $prospectfeuille)
			{
				$ids="$ids,".$prospectfeuille["client_id"];
			}
			$this->Client->recursive = -1;
			$clients=$this->Client->find("all",array("fields"=>array("id","nom","type_pharmacie","secteur_id")));
			$clientsById=array();
			foreach ($clients as $client) {
				$clientId = $client['Client']['id'];
				$clientsById[$clientId] = $client['Client'];
			}
			$clients=$clientsById;
			
		}

        $this->set(compact('prospectcompagne', "secteurs","users",'clients'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($prospectaffaire_id = 0) {
        if ($this->request->is('post')) {
            $date = date('H-i-s');
            $file = $this->request->data['Prospectcompagne']['file']['tmp_name'];
            $ext = substr($this->request->data['Prospectcompagne']['file']['name'], -4);
            if (!empty($file)) {
                $this->request->data['Prospectcompagne']['file'] = $date . '' . rand() . "$ext";
                move_uploaded_file($file, 'img/affaires/' . $this->request->data['Prospectcompagne']['file']);
            } else {
                $this->request->data['Prospectcompagne']['file'] = "";
            }

            $this->Prospectcompagne->create();
            $this->request->data["Prospectcompagne"]["user_id"] = AuthComponent::user('id');
            if ($this->Prospectcompagne->save($this->request->data)) {
                $this->Prospectcompagne->id = $this->Prospectcompagne->id;
                $this->Prospectcompagne->saveField("code_wavesoft", "CMP_" . $this->Prospectcompagne->id);
                $this->Session->setFlash(__('La compagne à été enregistré'));
                return $this->redirect(array('action' => 'view', $this->Prospectcompagne->id));
            } else {
                $this->Session->setFlash(__("La compagne  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
            }
        }
        $this->set(compact('prospectaffaire_id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Prospectcompagne->exists($id)) {
            throw new NotFoundException(__('Invalid prospectcompagne'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $data = $this->Prospectcompagne->find('first', array('conditions' => array('Prospectcompagne.id' => $id)));

            $date = date('H-i-s');
            $file = $this->request->data['Prospectcompagne']['file']['tmp_name'];
            $ext = substr($this->request->data['Prospectcompagne']['file']['name'], -4);
            if (!empty($file)) {
                $this->request->data['Prospectcompagne']['file'] = $date . '' . rand() . "$ext";
                move_uploaded_file($file, 'img/affaires/' . $this->request->data['Prospectcompagne']['file']);
            } else {

                $this->request->data['Prospectcompagne']['file'] = $data['Prospectcompagne']['file'];
            }

            if ($this->Prospectcompagne->save($this->request->data)) {
                $this->Session->setFlash(__('La compagne à été enregistré'));
                return $this->redirect(array('action' => 'view', $this->request->data['Prospectcompagne']['id']));
            } else {
                $this->Session->setFlash(__('The prospectcompagne could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Prospectcompagne.' . $this->Prospectcompagne->primaryKey => $id));
            $this->request->data = $this->Prospectcompagne->find('first', $options);
        }
        $prospectaffaires = $this->Prospectcompagne->Prospectaffaire->find('list');
        $users = $this->Prospectcompagne->User->find('list');
        $this->set(compact('prospectaffaires', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Prospectcompagne->id = $id;
        if (!$this->Prospectcompagne->exists()) {
            throw new NotFoundException(__('Invalid prospectcompagne'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Prospectcompagne->delete()) {
            $this->Session->setFlash(__('La compagne à été supprimer'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Prospectcompagne was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function generer($id = 0, $type = "null",$clientcall="null", $ville = "null", $categorie = "null", $limit = 100, $date_debut = "null", $date_fin = "null",$vm="null",$compgne_id="null") {
        $limite = $limit;
        $this->loadModel("Client");
        $this->Client->recursive = -1;
        $this->Client->Secteur->recursive = -1;
        $search = "";
        if ($this->request->is('post')) {
            //recherche par nom ou code wavesoft
            if (isset($this->request->data["client_search"]))
                $search = $this->request->data["client_search"];
            else {
                $this->loadModel("Prospectfeuille");
                foreach ($this->request->data["Prospectfeuille"] as $prospectfeuille) {
                    if (isset($prospectfeuille['client_id'])) {
                        $d = array();
                        $this->Prospectfeuille->create();
                        $d["Prospectfeuille"] = $prospectfeuille;
                        $d["Prospectfeuille"]["prospectcompagne_id"] = $this->request->data["Prospectcompagne"]["id"];
                        $d["Prospectfeuille"]["user_id"] = $this->request->data["Prospectcompagne"]["user_id"];
                        $d["Prospectfeuille"]["date_debut"] = $this->request->data["Prospectcompagne"]["date_debut"];
                        $d["Prospectfeuille"]["date_fin"] = $this->request->data["Prospectcompagne"]["date_fin"];
                        $this->Prospectfeuille->save($d);
                    }
                }
                $this->Session->setFlash(__('La liste des appels à été enregistré'));
                return $this->redirect(array('action' => 'view', $this->request->data["Prospectcompagne"]["id"]));
            }
        }

        $this->loadModel("Prospectaffectation");
        $this->loadModel("User");
        $this->User->recursive = -1;
        
        $users = $this->User->find('list', array('conditions' => array('User.role in ("Coordinateur","Teleconseiller")', 'User.archive' => 1)));

        $clients = array();
        if ($limit != 'null')
            $limit = " limit " . ltrim(rtrim($limit));
        if ($ville != 'null') {
            $ville = str_replace(",", "','", $ville);
            $villee = "'$ville'";
            debug($villee);

            if (strlen($ville) >= 1) {
                $ville = ' and ';
                $villes = $this->Client->Secteur->find("list", array("fields" => Array("id", "ville"), "conditions" => array("Secteur.id in($villee)")));
                debug($villes);$ids = "0";
                foreach ($villes as $k => $vil)
                    $ids = $ids . ",$k";
                $ville = $ville . "Client.secteur_id in($ids)";
            }
        }
        if ($type != 'null') {
            $villes = explode(",", $type);
            if (count($villes) > 1) {
                $v = ' and (';
                for ($i = 0; $i < count($villes); $i++) {
                    $v = $v . "Client.type_pharmacie='" . ltrim(rtrim($villes[$i])) . "' or ";
                }
                $v = rtrim($v, "or ");
                $type = $v . ')  ';
            } else
                $type = " and Client.type_pharmacie like '" . ltrim(rtrim($type)) . "'";
        }

        if ($categorie != 'null') {
            if (strlen($categorie) > 1) {
                $categorie = " and Client.category_id in($categorie)";
            }
        }
		if ($clientcall != 'null') 
		{
			
            $clientcall = " and Client.client_call = $clientcall";
        }
        $catesgories = array("35" => "PHARMACIES", "36" => "PARA DIRECT", "37" => "PARA GROSSISTES", "41" => "Salles de sport");
        if ($type != "null") 
		{
			if($type=="null") $type="";
			if($categorie=="null") $categorie="";
			if($ville=="null") $ville="";
			if($limit=="null") $limit="limit 100";
			
			$idsclientsincompgne="";
			if($compgne_id!="null")
			{
				$this->loadModel("Prospectfeuille");
				$this->Prospectfeuille->recursive=-1;
				$allclientincompgnes=$this->Prospectfeuille->find("all",array(
                    "conditions"=>array("Prospectfeuille.prospectcompagne_id in($compgne_id)","Prospectfeuille.user_id in($vm)")));
				$ididsclientsincompgne="";
				foreach($allclientincompgnes as $v)
				{
					$ididsclientsincompgne=$v["Prospectfeuille"]["client_id"].",$ididsclientsincompgne";
				}
				$ididsclientsincompgne=trim($ididsclientsincompgne,",");
				$idsclientsincompgne=" and Client.id in($ididsclientsincompgne)";
				//echo $idsclientsincompgne;exit();
			}
            $clientencours = $this->Prospectcompagne->findById($id);
            debug($clientencours);
            $ids = "0";
            foreach ($clientencours["Prospectfeuille"] as $c) {
                $ids = $ids . "," . $c["client_id"];
            }
            $clients = $this->Client->find('all', 
            array("conditions" => array("Client.archive=1 and Clien t.id NOT IN ($ids) $idsclientsincompgne  $ville $type $categorie $clientcall $limit")));
        }
        if ($search != "") {
            $clients = $this->Client->find('all', array("conditions" => array("(Client.nom like '%$search%' or Client.dirigent like '%$search%' or  Client.code_wavsoft like '%$search%') and Client.type_id=2 and Client.archive=1 limit 100")));
        }
        $secteurs = $this->Client->Secteur->find("all");
        $i = 0;
        foreach ($clients as $p) 
		{
            foreach ($catesgories as $k => $v) {
                if ($p["Client"]["category_id"] == $k) {
                    $clients[$i]["Client"]["categorie"] = $v;
                    break;
                }
            }
            foreach ($secteurs as $s) {
                if ($p["Client"]["secteur_id"] == $s["Secteur"]["id"]) {
                    $clients[$i]["Client"]["Secteur"] = $s["Secteur"];
                    break;
                }
            }
            $i++;
        }



        $types = array("Prospect" => "Prospect", "Client" => "Client");
        if ($date_debut == "") {
            $this->Prospectcompagne->recursive = -1;
            $prospectcompagne = $this->Prospectcompagne->findById($id);
            $date_debut = $prospectcompagne["Prospectcompagne"]["date_debut"];
            $date_fin = $prospectcompagne["Prospectcompagne"]["date_fin"];
        }
        
        $this->Client->Secteur->recursive=-1;
        $regions = $this->Client->Secteur->find("list", array("fields" => Array("id", "region"), "group" => array("region")));
        $villes=array();
        foreach($regions as $k=>$v)
        {
			$secteursall=$this->Client->Secteur->find("all", array("conditions" => array("Secteur.region"=>$v)));
			$secteurs=array();
			foreach($secteursall as $s)
			{
				$secteurs[$s["Secteur"]["id"]]=$s["Secteur"]["ville"]."-".$s["Secteur"]["secteur"];
			}
            $villes[$v] = $secteurs;
        }
        
		$prospectcompagnes=$this->Prospectcompagne->find("list");
		$vms=$users;
        $this->set(compact('prospectcompagnes','vms','id', 'catesgories', 'types', 'villes', 'clients', 'date_debut', 'date_fin', 'users', 'limite'));
    }

    function delete_appel($prospectfeuille_id = 0) 
	{
		$this->loadModel("Prospectfeuille");
		$ids=explode(",",$prospectfeuille_id);
		if(count($ids)>1)
		{
			foreach( $ids as $id=>$v)
			{
				$this->Prospectfeuille->id = $v;
				$this->Prospectfeuille->delete();
			}
			$this->Session->setFlash(__('La programation de l\'appel à été supprimer'));
			$this->redirect($this->referer());
		}
		else
		{
			$this->loadModel("Prospectfeuille");
			$this->Prospectfeuille->id = $prospectfeuille_id;
			if (!$this->Prospectfeuille->exists()) {
				throw new NotFoundException(__('Invalid Prospectfeuille'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Prospectfeuille->delete()) {
				$this->Session->setFlash(__('La programation de l\'appel à été supprimer'));
				$this->redirect($this->referer());
			}
			$this->Session->setFlash(__('Prospectfeuille was not deleted'));
			$this->redirect($this->referer());
		}
    }
	
	
	function system_get_type_user_count($client_id=11665)
	{
		$d=$this->Prospectcompagne->query("SELECT * FROM (
				SELECT COUNT(type_user) AS nombre,type_user FROM rapportprocpects WHERE client_id=$client_id
				GROUP BY type_user ) AS data");
		$info="";
		foreach($d as $s)
		{
			$info.=$s["data"]["type_user"]." : ".$s["data"]["nombre"]."<br>";
		}
		return $info;
		exit();
	}
	
	
	
	function affectation_auto_excel()
	{
		$prospects=array();
		if ($this->request->is('post')) 
		{
			$this->loadModel("Prospectfeuille");
			$prospectcompagne_id = $this->request->data["Prospectcompagne"]["prospectcompagne_id"];
            $user_id = $this->request->data["Prospectcompagne"]["user_id"];
            if (isset($this->request->data["Prospectcompagne"]["recherche"]))
			{
				$prospects=$this->Prospectfeuille->find("all",array("conditions"=>array("Prospectfeuille.prospectcompagne_id"=>$prospectcompagne_id,"Prospectfeuille.user_id"=>$user_id,"Prospectfeuille.etat"=>"En cours"),"order"=>array("Prospectfeuille.id asc")));
			}
            else {
				
				
				if(isset( $this->request->data['Prospectcompagne']['file']))
				{
					$date=date("ymdhis");
					$name=$this->request->data["Prospectcompagne"]["user_id"]." $date..xlsx";
					file_put_contents("files/$name", file_get_contents($this->request->data['Prospectcompagne']['file']["tmp_name"]));
				}
				else 
				{
					echo "Erreur dans fichier";
				}
				
				ini_set('memory_limit', '-1');
				set_time_limit(250);
				$file = WWW_ROOT . "files/$name";
				
				require_once 'Component/simplexlsx.php';
				set_time_limit(10000);
				$unevers = SimpleXLSX::parse($file);
				$totalajouter=$totalintrovable=0;

				$this->loadModel("Client");
				$this->Client->recursive=-1;
				$clientnonreconnus=array();
				$prospects=$this->Prospectfeuille->find("all",array("conditions"=>array("Prospectfeuille.prospectcompagne_id"=>$prospectcompagne_id,"Prospectfeuille.user_id"=>$user_id,"Prospectfeuille.etat"=>"En cours"),"order"=>array("Prospectfeuille.id asc")));
				foreach($prospects as $p)
				{
					$this->Prospectfeuille->id=$p["Prospectfeuille"]["id"];
					$this->Prospectfeuille->delete();
				}

				foreach($unevers->rows()  as $data ) 
				{
					$code_wavesoft=trim($data[0]);
					$client=$this->Client->findByCodeWavsoft($code_wavesoft);
					if(!empty($client))
					{
						$totalajouter++;
						 $d = array();
                        $this->Prospectfeuille->create();
                        $d["Prospectfeuille"]["prospectcompagne_id"] = $prospectcompagne_id;
                        $d["Prospectfeuille"]["client_id"] = $client["Client"]["id"];
                        $d["Prospectfeuille"]["user_id"] = $user_id;
                        $d["Prospectfeuille"]["date_debut"] = date("Y-01-01");
                        $d["Prospectfeuille"]["date_fin"] = date("Y-12-31");
                        $this->Prospectfeuille->save($d);
					}
					else
					{
						$totalintrovable++;
						$clientnonreconnus[]=$code_wavesoft;
					}
				}
				$prospects=$this->Prospectfeuille->find("all",array("conditions"=>array("Prospectfeuille.prospectcompagne_id"=>$prospectcompagne_id,"Prospectfeuille.user_id"=>$user_id,"Prospectfeuille.etat"=>"En cours"),"order"=>array("Prospectfeuille.id asc")));
			
                $this->Session->setFlash(__("La mise à jour de la liste des appels a été effectuée avec succès. $totalajouter entrées ont été ajoutées, tandis que $totalintrovable clients n'ont pas été reconnus"));
				$this->set("clientnonreconnus",$clientnonreconnus);
            }
        }
		$affaires=$this->Prospectcompagne->Prospectaffaire->find("list");
		$this->Prospectcompagne->recursive=-1;
		$d=$this->Prospectcompagne->find("all");
		$prospectcompagnes=array();
		foreach($d as $k)
		{
            if (isset($k["Prospectcompagne"]["id"]) && isset($k["Prospectcompagne"]["prospectaffaire_id"]) && isset($k["Prospectcompagne"]["name"])) {
                $prospectcompagnes[$k["Prospectcompagne"]["id"]] = $affaires[$k["Prospectcompagne"]["prospectaffaire_id"]] . ' - ' . $k["Prospectcompagne"]["name"];
            } else {
                // Traiter le cas où les indices n'existent pas
                // Par exemple, ajouter un message d'erreur ou un log
                // echo "Un des indices est manquant pour la clé $k['Prospectcompagne']['id']";
            }
		}
		$this->loadModel("User");
		$users = $this->User->find('list', array('conditions' => array('User.role in ("Coordinateur","VMP","Teleconseiller")', 'User.archive' => 1)));
		$this->set(compact('prospectcompagnes','users',"prospects"));
		
	}

}
