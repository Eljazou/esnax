<?php

App::uses('AppController', 'Controller');

/**
 * Odpobjectifs Controller
 *
 * @property Odpobjectif $Odpobjectif
 * @property PaginatorComponent $Paginator
 */
class OdpobjectifsController extends AppController {
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
        $dates = array();
        $odps = array();
        if ($this->request->is('post')) {
            $date = explode("---", $this->request->data["Odpobjectif"]["dates"]);
            $odps = $this->Odpobjectif->find("all", array("conditions" => array("Odpobjectif.date_debut" => $date[0], "Odpobjectif.date_fin" => $date[1])));
        }
        $data_dates = $this->Odpobjectif->find("all");
        foreach ($data_dates as $k) {
            $dates[$k["Odpobjectif"]["date_debut"] . "---" . $k["Odpobjectif"]["date_fin"]] = $k["Odpobjectif"]["date_debut"] . "---" . $k["Odpobjectif"]["date_fin"];
        }
        $brochures = $this->Odpobjectif->Brochure->find('list');
        $this->set(compact('odps', "brochures", "dates"));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            foreach ($this->request->data["brochure"] as $brchure_id => $data) {
                foreach ($data as $region => $v) {
                    $this->Odpobjectif->create();
                    $d = array();
                    $d["date_debut"] = $this->request->data["Odpobjectif"]["date_debut"];
                    $d["date_fin"] = $this->request->data["Odpobjectif"]["date_fin"];
                    $d["brochure_id"] = $brchure_id;
                    $d["region"] = $region;
                    if ($v == "")
                        $v = 0;
                    $d["objectif"] = $v;
                    //debug($d);
                    $this->Odpobjectif->save($d);
                }
            }
            $this->Session->setFlash("Objectif ajouter");
            return $this->redirect(array('action' => 'index'));
        }
        $brochures = $this->Odpobjectif->Brochure->find('list');
        $this->set(compact('brochures'));
    }
	
	 public function ajout_unique() {
        if ($this->request->is('post')) 
		{
			$this->Odpobjectif->create();
			$this->Odpobjectif->save($this->request->data);
            $this->Session->setFlash("Objectif ajouter");
            return $this->redirect(array('action' => 'index'));
        }
        $brochures = $this->Odpobjectif->Brochure->find('list');
        $this->set(compact('brochures'));
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
            if ($this->Odpobjectif->save($this->request->data)) {
                $this->Session->setFlash("Objectif modifier");
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The odpobjectif could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Odpobjectif->findById($id);
        }
        $brochures = $this->Odpobjectif->Brochure->find('list');
        $this->set(compact('brochures'));
    }
	
    public function delete($id = null) {
        if (!$this->Odpobjectif->exists($id)) {
            throw new NotFoundException(__('Invalid odpobjectif'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Odpobjectif->delete($id)) {
            $this->Session->setFlash("Objectif supprimer");
        } else {
            $this->Session->setFlash(__('The odpobjectif could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
	
	
	
	
	//function qui repend l besoin de statistiques/system_odp
	function system_odp_objectif($regions="0",$date="0",$date_fin="0")
	{
		$this->Odpobjectif->recursive=-1;
		if($date=="0")
			$date=Date("Y-m-d");
		if($date_fin=="0")
			$date_fin=Date("Y-m-d");
		if($regions=="0")
		{
			$regions=array("CASA"=>"CASA","ORIENT"=>"ORIENT","RABAT"=>"RABAT","MARRAKECH"=>"MARRAKECH","TANGER"=>"TANGER","AGADIR"=>"AGADIR"); 
			$odps = $this->Odpobjectif->find("all", array('conditions' => array("'$date' BETWEEN Odpobjectif.date_debut AND Odpobjectif.date_fin")));
			if(empty($odps))
			{
				$lastOdpobjectif = $this->Odpobjectif->find('first', array('order' => array('Odpobjectif.id' => 'DESC')));
				$odps = $this->Odpobjectif->find("all", array('conditions' => array("Odpobjectif.date_debut"=>$lastOdpobjectif["Odpobjectif"]["date_debut"])));
			}
		}
		else
		{
			$regions=explode(",",$regions);
			$odps = $this->Odpobjectif->find("all", array('conditions' => array("Odpobjectif.region"=>$regions,"'$date' BETWEEN Odpobjectif.date_debut AND Odpobjectif.date_fin")));
			if(empty($odps))
			{
				$lastOdpobjectif = $this->Odpobjectif->find('first', array('order' => array('Odpobjectif.id' => 'DESC')));
				$odps = $this->Odpobjectif->find("all", array('conditions' => array("Odpobjectif.region"=>$regions,"Odpobjectif.date_debut"=>$lastOdpobjectif["Odpobjectif"]["date_debut"])));
			}
		}
		
		//remplir le vide si il on n'a
		
		$brochures = $this->Odpobjectif->Brochure->find('list');
		foreach($regions as $k=>$region)
		{
			foreach($brochures as $key=>$brochure)
			{
				$kain=0;
				foreach($odps as $i=>$odp)
				{
					if($odp["Odpobjectif"]["region"]==$region && $odp["Odpobjectif"]["brochure_id"]==$key)
					{
						// Récupérer le nombre de jours entre $odp["Odpobjectif"]["date_debut"] et $odp["Odpobjectif"]["date_fin"]
						$dateDebut = new DateTime($odp["Odpobjectif"]["date_debut"]);
						$dateFin = new DateTime($odp["Odpobjectif"]["date_fin"]);
						$interval1 = $dateDebut->diff($dateFin);
						$joursEntreDebutEtFin = $interval1->days;
						$objectif_par_jour=$odp["Odpobjectif"]["objectif"]/$joursEntreDebutEtFin;

						// Récupérer le nombre de jours entre $odp["Odpobjectif"]["date_debut"] et $date = date("Y-m-d")
						$dateActuelle = new DateTime($date_fin);
						$dateDebut = new DateTime($date);
						$interval2 = $dateDebut->diff($dateActuelle);
						$joursEntreDebutEtActuelle = $interval2->days;
						
						$odps[$i]["Odpobjectif"]["objectif2"]=round($objectif_par_jour * $joursEntreDebutEtActuelle,0);
						$odps[$i]["Odpobjectif"]["objectif3"]=$objectif_par_jour.' * '.$joursEntreDebutEtActuelle;

						$kain=1;
						break;
					}
				}
				if($kain==0)
				{
					$d=array();
					$d["Odpobjectif"]=array();
					$d["Odpobjectif"]["region"]=$region;
					$d["Odpobjectif"]["brochure_id"]=$key;
					$d["Odpobjectif"]["objectif"]=0;
					$d["Odpobjectif"]["objectif2"]=0;
					$odps[]=$d;
				}
					
			}
		}
		$data=array();
		foreach($odps as $d)
		{
			if(!isset($data[$d["Odpobjectif"]["region"]]))
				$data[$d["Odpobjectif"]["region"]]=array();
			$data[$d["Odpobjectif"]["region"]][$d["Odpobjectif"]["brochure_id"]]=$d["Odpobjectif"]["objectif2"];
			
		}
		
		//debug($data);exit();
		return $data;
		
		
	}
	

}
