<?php

App::uses('AppController', 'Controller');

/**
 * Digitals Controller
 *
 * @property Digital $Digital
 * @property PaginatorComponent $Paginator
 */
class DigitalsController extends AppController {
    
    public function traitement_administratif() 
    {
        $this->Digital->recursive = 0;
        $requete="1=1 order by Digital.id desc";
        if(AuthComponent::user('username')=="n.korda@esnapharm.com")
            $requete="Digital.type ='Questions techniques' order by Digital.id desc";
        else if(AuthComponent::user('username')=="s.abahmane@esnapharm.com")
            $requete="Digital.type ='Demande de partenariat' order by Digital.id desc";
        $this->set('digitals', $this->Digital->find("all",array("conditions"=>array($requete))));
    }

    function traitement_commercail() {
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
		$secteur_id="0,".AuthComponent::user('villes');
		$secteur_id=trim($secteur_id,",");
        $secteurs = $this->Secteur->find("all", array("conditions" => array("Secteur.id in ($secteur_id)")));
        $villes = "'0'";
        foreach ($secteurs as $s) {
            $villes = $villes . ",'" . $s["Secteur"]["ville"] . "'";
        }
        $secteurs = $this->Secteur->find("all", array("conditions" => array("Secteur.ville in ($villes)")));
        $villes = "0";
        foreach ($secteurs as $s) {
            $villes = $villes . "," . $s["Secteur"]["id"];
        }
        $this->Digital->recursive = 0;
        $this->set('digitals', $this->Digital->find("all", array("conditions" => array("Digital.secteur_id in ($villes)","Digital.super_id is null and Digital.type !='Questions techniques' and Digital.type !='Demande de partenariat'  order by Digital.id desc"))));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Digital->exists($id)) {
            throw new NotFoundException(__('Invalid digital'));
        }
        $options = array('conditions' => array('Digital.' . $this->Digital->primaryKey => $id));
        $this->set('digital', $this->Digital->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $clients = array();
        if ($this->request->is('post')) {
            if (isset($this->request->data["Digital"]["client"])) {
                $this->loadModel("Client");
                $search = $this->request->data["Digital"]["client"];
                $clients = $this->Client->find('all', array("conditions" => array("(Client.nom like '%$search%' or Client.dirigent like '%$search%' "
                        . "or  Client.code_wavsoft like '%$search%') and Client.archive=1 limit 10")));
            } else {
                $gamme = "";
                if ($this->request->data["Digital"]["game_id"] != "") {
                    foreach ($this->request->data["Digital"]["game_id"] as $k => $v) {
                        $gamme = $gamme . ",$v";
                    }
                    $gamme = trim($gamme, ",");
                }
                $this->request->data["Digital"]["user_id"] = AuthComponent::user('id');
                $this->request->data["Digital"]["game_id"] = $gamme;
                $this->Digital->create();
                if ($this->Digital->save($this->request->data)) {
                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail();
                    if ($this->request->data["Digital"]["type"] == "Demande de partenariat") 
                        $mailto=array("s.abahmane@esnapharm.com", "z.ouzine@esnapharm.com");
                    if ($this->request->data["Digital"]["type"] == "Questions techniques") 
                        $mailto=array("n.korda@esnapharm.com", "z.ouzine@esnapharm.com");
                    else
                        $mailto=array("z.ouzine@esnapharm.com");
                    $Email->to($mailto);
                    $Email->from("noreplay@esnapharm.com");
                    $Email->subject("[CRM VMP] Digital : ".$this->request->data["Digital"]["type"]);
                    $Email->send($this->request->data["Digital"]["type"]." \n<br> merci de trouver toutes les infos dans
                            https://connectlabo.com/digitals/traitement_administratif");

                    $this->Session->setFlash(__('Votre demande à été enregistré'));
                    return $this->redirect(array('action' => 'traitement_administratif'));
                } else {
                    $this->Session->setFlash(__("La digital  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
                }
            }
        }
        $games = $this->Digital->Game->find('list', array("fields" => array("name", "name")));
        $this->Digital->Secteur->recursive = -1;
        $secteurs = $this->Digital->Secteur->find('all');
        $regions = array();
        $villes = array();
        foreach ($secteurs as $s) {
            if (!isset($regions[$s["Secteur"]["region"]]))
                $regions[$s["Secteur"]["region"]][] = $s["Secteur"]["ville"];
            if (!in_array($s["Secteur"]["ville"], $regions[$s["Secteur"]["region"]]))
                $regions[$s["Secteur"]["region"]][] = $s["Secteur"]["ville"];
            $villes[$s["Secteur"]["ville"]][$s["Secteur"]["id"]] = $s["Secteur"]["secteur"];
            //exit();
        }
        // debug($villes);
        // debug($regions);
        $this->set(compact('games', 'secteurs', 'regions', 'villes', 'clients'));
    }

    function traiter($id = null) {
        if ($this->request->is('post')) {
            $this->request->data["Digital"]["super_id"] = AuthComponent::user('id');
            $this->request->data["Digital"]["date_repense"] = date("y-m-d h:i:s");
            $this->request->data["Digital"]["etat"] = "Traiter";
            $this->Digital->save($this->request->data);
            $this->Session->setFlash(__('La digital à été enregistré'));
            return $this->redirect(array('action' => 'traitement_administratif'));
        }
        $digital = $this->Digital->findById($id);
        $this->set(compact("digital", "id"));
    }

    public function delete($id = null) {
        $this->Digital->id = $id;
        if (!$this->Digital->exists()) {
            throw new NotFoundException(__('Invalid Digital'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Digital->delete()) {
            $this->Session->setFlash(__('La demande à été supprimer'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Digital was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

}
