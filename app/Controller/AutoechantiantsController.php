<?php

App::uses('AppController', 'Controller');

/**
 * Autoechantiants Controller
 *
 * @property Autoechantiant $Autoechantiant
 * @property PaginatorComponent $Paginator
 */
class AutoechantiantsController extends AppController {

    function proposition($nombredecycle) {
        $cycle = $data = array();
        $date = date("Y-m-d", strtotime('next monday'));
        for ($i = 0; $i < $nombredecycle; $i++) {
            $cycle[] = $date;
            $date = date("Y-m-d", strtotime("+7 day", strtotime($date)));
        }
        $this->loadModel("User");
        $this->loadModel("Affectation");
        $this->loadModel("Plantourne");
        $this->loadModel("Gadjet");
        $this->User->recursive = -1;
        for ($i = 0; $i < count($cycle); $i++) {
            $plans = $this->Plantourne->find('all', array('conditions' => array('Plantourne.date' => $cycle[$i])));
            foreach ($plans as $plan) {
                if (!isset($data[$plan["Liste"]["user_id"]]))
                    $data[$plan["Liste"]["user_id"]] = $plan["Liste"]["id"];
                else
                    $data[$plan["Liste"]["user_id"]] = $data[$plan["Liste"]["user_id"]] . "," . $plan["Liste"]["id"];
            }
        }

        $info = array();
        $autoechantiants = $this->Autoechantiant->find("all");
        foreach ($data as $key => $value) {
            //$value=$data[4];
            //$key=4;
            echo $value . " " . $key; //exit();
            $clients = $this->Affectation->find('all', array('conditions' => array('Affectation.valide' => 1, "Affectation.liste_id in($value)")));
            foreach ($clients as $c) {
                $c = $c["Client"];
                if (isset($info[$key][$c["potentialite"] . "|" . $c["category_id"]]))
                    $info[$key][$c["potentialite"] . "|" . $c["category_id"]]["nombre"] ++;
                else {
                    $info[$key][$c["potentialite"] . "|" . $c["category_id"]]["nombre"] = 1;
                    $info[$key][$c["potentialite"] . "|" . $c["category_id"]]["category_id"] = $c["category_id"];
                }
            }
            $gadjet = array();
            foreach ($info as $user_id => $datauser) {
                foreach ($datauser as $pot => $infopot) {
                    $pot = explode("|", $pot);
                    $pot = $pot[0];
                    foreach ($autoechantiants as $auto) {
                        if ($auto["Autoechantiant"]["category_id"] == $infopot["category_id"] &&
                                $auto["Autoechantiant"]["classification"] == $pot) {
                            $gadjets = explode("||", $auto["Autoechantiant"]["gadjets"]);
                            for ($i = 0; $i < count($gadjets); $i++) {
                                $gadjetsdata = explode("&&", $gadjets[$i]);
                                if (!isset($gadjet[$user_id . $gadjetsdata[0]])) {
                                    $gadjet[$user_id . $gadjetsdata[0]]["Gadjet"]["user_id"] = $user_id;
                                    $gadjet[$user_id . $gadjetsdata[0]]["Gadjet"]["echantillon_id"] = $gadjetsdata[0];
                                    $gadjet[$user_id . $gadjetsdata[0]]["Gadjet"]["quantite"] = $gadjetsdata[1] * $infopot["nombre"];
                                } else
                                    $gadjet[$user_id . $gadjetsdata[0]]["Gadjet"]["quantite"] += $gadjetsdata[1] * $infopot["nombre"];
                            }
                            break;
                        }
                    }
                }
            }
            //exit();			
        }
        foreach ($gadjet as $gadjete) {
            $this->Gadjet->create();
            $this->Gadjet->save($gadjete);
        }
        $this->Session->setFlash('Auto echantiant ajouté');
        return $this->redirect(array('action' => 'index'));
    }

    public function index() {
        $this->set('autoechantiants', $this->Autoechantiant->find("all"));
        $categories = $this->Autoechantiant->Category->find('list');
        $this->set(compact('categories'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($category_id, $pot) {
        if ($this->request->is('post')) {
            $d = "";
            foreach ($this->request->data["a"] as $value) {
                if ($value["nombre"] != 0 && $value["nombre"] != "") {
                    $d = $d . $value["echantillons"] . "&&" . $value["nombre"] . "||";
                }
            }
            $d = rtrim($d, "||");
            $this->request->data["Autoechantiant"]["gadjets"] = $d;
            $this->Autoechantiant->create();
            if ($this->Autoechantiant->save($this->request->data)) {
                $this->Session->setFlash(__('Auto echantiant ajouté'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The autoechantiant could not be saved. Please, try again.'));
            }
        }
        $this->loadModel("Echantillon");
        $this->Echantillon->recursive = -1;
        $echantillons = $this->Echantillon->find('list');
        $this->set(compact('category_id', 'pot', "echantillons"));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($category_id, $pot) {

        if ($this->request->is('post') || $this->request->is('put')) {
            $d = "";
            foreach ($this->request->data["a"] as $value) {
                if ($value["nombre"] != 0 && $value["nombre"] != "") {
                    $d = $d . $value["echantillons"] . "&&" . $value["nombre"] . "||";
                }
            }
            $d = rtrim($d, "||");
            $this->request->data["Autoechantiant"]["gadjets"] = $d;
            if ($this->Autoechantiant->save($this->request->data)) {
                $this->Session->setFlash(__('Echantillon modifier'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The autoechantiant could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Autoechantiant.category_id' => $category_id, 'Autoechantiant.classification' => $pot));
            $this->request->data = $this->Autoechantiant->find('first', $options);
        }
        $this->loadModel("Echantillon");
        $this->Echantillon->recursive = -1;
        $echantillons = $this->Echantillon->find('list');
        $this->set(compact('category_id', 'pot', "echantillons"));
    }
    
    
    function suppnonvalide()
    {
        $this->Autoechantiant->query("delete from gadjets where archive=0");
        $this->Session->setFlash(__('Echantillon non valide sont supprimer'));
        return $this->redirect(array('action' => 'index'));
    }

}
