<?php

App::uses('AppController', 'Controller');

/**
 * Jourferiers Controller
 *
 * @property Jourferier $Jourferier
 * @property PaginatorComponent $Paginator
 */
class JourferiersController extends AppController {

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
        $this->Jourferier->recursive = 0;
        $this->set('jourferiers', $this->Jourferier->find('all'));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Jourferier->create();
            if ($this->Jourferier->save($this->request->data)) {
                $this->Session->setFlash(__('Jour ajoutée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The jourferier could not be saved. Please, try again.'));
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
        if (!$this->Jourferier->exists($id)) {
            throw new NotFoundException(__('Invalid jourferier'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Jourferier->save($this->request->data)) {
                $this->Session->setFlash(__('Fête modifiée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The jourferier could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Jourferier.' . $this->Jourferier->primaryKey => $id));
            $this->request->data = $this->Jourferier->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Jourferier->id = $id;
        if (!$this->Jourferier->exists()) {
            throw new NotFoundException(__('Invalid jourferier'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Jourferier->delete()) {
            $this->Session->setFlash(__('fête supprimé'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Jourferier was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    
    
    //function retourn le nombre de jour entre deux date mais elle ilimine les jour férier et le dimanche
	// je vais utiliser cette fonction dans absences/addconge et vu que ici j'ai besoin de echo et exit au lieu de return je vais ajouter un param
    function system_getjourforconge($date_debut=null,$date_fin=null,$var=null)
    {
        $jour=$this->Jourferier->find("all");
        $now = strtotime($date_debut);
        $your_date = strtotime($date_fin);
        $datediff = $your_date - $now;
        $j = ceil($datediff / (60 * 60 * 24));
        //$j++;
		
		//illimine dimanche
        $dated=$date_debut;
        do
        {
			//dimanche
            if(date('w', strtotime($dated)) == 0)
				$j--;
			//samedi
			//if(date('w', strtotime($dated)) == 6)
			//	$j--;//$j=$j-0.5;
			//echo "$dated<$date_fin $j <br>";
            $dated = date('Y-m-d',strtotime($dated . "+1 days"));
        }while ($dated<$date_fin);
		//-----------------Fin ilimine dimanche-------------//
        $dated = strtotime($date_debut);
        $datef = strtotime($date_fin);
        foreach ($jour as $value)
        {
            $dateFerierD=$value['Jourferier']['date_debut'];
            do
            {
                $dfd = strtotime($dateFerierD);
                if($dfd >= $dated && $dfd < $datef) 
                {
					//echo "$j ::: $date_debut : $date_fin -- ". date('Y-m-d',strtotime($dateFerierD))."<br>";
                    if(date('w', strtotime($dateFerierD)) != 0)// && date('w', strtotime($dateFerierD)) != 6)
                        $j--;
                }
                $dateFerierD = date('Y-m-d',strtotime($dateFerierD . "+1 days"));
            }while ($dateFerierD<=$value['Jourferier']['date_fin']);
        }
		if($var==1){
			echo $j;
			exit();
		}
		else{
        return $j;
		}
    }

}
