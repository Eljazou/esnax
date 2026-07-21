<?php

App::uses('AppController', 'Controller');
App::import('Controller', 'prospectaffaires');

/**
 * Rapportprocpects Controller
 *
 * @property Rapportprocpect $Rapportprocpect
 * @property PaginatorComponent $Paginator
 */
class RapportprocpectsController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('export_feuille', 'ajouter_cop', "edit_client_champ_vide", 'test_export');
    }


    function test_export()
    {
        echo "Test successful";
        exit();
    }
    /**
     * add method
     *
     * @return void
     */
    public function ajouter($client_id = 0, $affaire_id = null, $feuille_id = 0)
    {
        if ($this->request->is('post')) {

            $kain = $this->Rapportprocpect->find("count", array("conditions" => array("Rapportprocpect.prospectfeuille_id" => $this->request->data["Rapportprocpect"]["prospectfeuille_id"])));
            if ($kain != 0) {
                $this->Session->setFlash(__('La rapport  à été déja enregistré'));
                return $this->redirect(array('action' => 'fuille_route_conseiller'));
            }
            $this->Rapportprocpect->create();
            $this->request->data["Rapportprocpect"]["user_id"] = AuthComponent::user('id');
            $this->request->data["Rapportprocpect"]["type_user"] = AuthComponent::user('identification');
            if ($this->request->data["Rapportprocpect"]["commercial"] == "Oui")
                unset($this->request->data["Rapportprocpect"]["commande"]);

            if ($this->request->data["Rapportprocpect"]["connaissance"] == "Non") {
                unset($this->request->data["Rapportprocpect"]["disponibilite"]);
                unset($this->request->data["Rapportprocpect"]["vente"]);
                unset($this->request->data["Rapportprocpect"]["comment"]);
            }
            if (isset($this->request->data['Rapportprocpect']['reclamation'])) {
                $reclamationcases = $this->request->data['Rapportprocpect']['reclamation'];
                if (is_array($reclamationcases)) {
                    $this->request->data['Rapportprocpect']['reclamation'] = implode('|', $reclamationcases);
                } else {
                    $this->request->data['Rapportprocpect']['reclamation'] = '';
                }
            }

            if (isset($this->request->data['Rapportprocpect']['objection'])) {
                $objectioncases = $this->request->data['Rapportprocpect']['objection'];
                if (is_array($objectioncases)) {
                    $this->request->data['Rapportprocpect']['objection'] = implode('|', $objectioncases);
                } else {
                    $this->request->data['Rapportprocpect']['objection'] = '';
                }
            }

            if (isset($this->request->data['Rapportprocpect']['qualification'])) {
                $qualificationcases = $this->request->data['Rapportprocpect']['qualification'];
                if (is_array($qualificationcases)) {
                    $this->request->data['Rapportprocpect']['qualification'] = implode('|', $qualificationcases);
                } else {
                    $this->request->data['Rapportprocpect']['qualification'] = '';
                }
            }

            $this->request->data['Rapportprocpect']['qualification'] = implode('|', $qualificationcases);

            if (isset($this->request->data['Rapportprocpect']['objection_two'])) {
                $objection_twos = $this->request->data['Rapportprocpect']['objection_two'];
                if (is_array($objection_twos)) {
                    $this->request->data['Rapportprocpect']['objection_two'] = implode('|', $objection_twos);
                } else {
                    $this->request->data['Rapportprocpect']['objection_two'] = '';
                }

                // If objection_two is empty, unset it
                if (empty($this->request->data['Rapportprocpect']['objection_two'])) {
                    unset($this->request->data['Rapportprocpect']['objection_two']);
                }
            } else {
                // If objection_two is not set, unset it to ensure it's not included
                unset($this->request->data['Rapportprocpect']['objection_two']);
            }

            if ($this->Rapportprocpect->save($this->request->data)) {
                $etat = "Terminer";
                if ($this->request->data["Rapportprocpect"]["commercial"] == "Oui") {
                    $etat = "A traiter";
                    $this->loadModel("Secteur");
                    $this->Secteur->recursive = -1;
                    $this->Rapportprocpect->Client->recursive = -1;
                    $client = $this->Rapportprocpect->Client->findById($this->request->data["Rapportprocpect"]["client_id"]);
                    $secteur = $this->Secteur->findById($client["Client"]["secteur_id"]);
                    $message = "-   Nom pharmacie : " . $client["Client"]["nom"] . " / " . $client["Client"]["dirigent"] . "
                                -   Numéro de téléphone : " . $client["Client"]["tel"] . " / " . $client["Client"]["fixe"] . "
                                -   Région/ville : " . $secteur["Secteur"]["region"] . " / " . $secteur["Secteur"]["ville"] . "
                                -   Adresse : " . $client["Client"]["adress"] . "
                                -   Nom téléconseiller : " . AuthComponent::user('name');

                    $this->loadModel("Prospectfeuille");
                    $fueille = $this->Prospectfeuille->findById($this->request->data["Rapportprocpect"]["prospectfeuille_id"]);
                    $titre = "[CRM VMP]Vous avez une nouvelle opportunité [Campagne : " . $fueille["Prospectcompagne"]["name"] . " ]";
                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail();
                    $Email->to(array("m.elfidaoui@esnapharm.com", "m.hraoui@esnapharm.com", "y.farah@valpharma.ma"));
                    $Email->from('CRM@esnapharm.com');
                    $Email->subject($titre);
                    $Email->send($message);
                    $this->loadModel('Boitemail');
                    $this->Boitemail->create();
                    $d = array();
                    $d['Boitemail']['lien'] = "/clients/view/" . $client["Client"]["id"];
                    $d['Boitemail']['user_id'] = 223; //$super['User']['id'];
                    $d['Boitemail']['user1_id'] = 0;
                    $d['Boitemail']['titre'] = $titre;
                    $d['Boitemail']['message'] = $message;
                    $this->Boitemail->save($d);
                }



                $this->loadModel("Prospectfeuille");
                $this->Prospectfeuille->id = $this->request->data["Rapportprocpect"]["prospectfeuille_id"];
                $this->Prospectfeuille->saveField("etat", $etat);
                $this->Session->setFlash(__('La rapportprocpect à été enregistré'));
                return $this->redirect(array('action' => 'fuille_route_conseiller'));
            } else {
                $this->Session->setFlash(__("La rapportprocpect  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
            }
        }
        $exist = $this->Rapportprocpect->findByProspectfeuilleId($feuille_id);
        if (!empty($exist)) {
            $this->Session->setFlash("Appel déja effectué");
            return $this->redirect(array('action' => 'fuille_route_conseiller'));
        }

        $this->loadModel("Prospectcompagne");
        $this->Prospectcompagne->recursive = -1;
        $affaire = $this->Prospectcompagne->findById($affaire_id);
        $this->Rapportprocpect->Client->recursive = -1;
        $client = $this->Rapportprocpect->Client->findById($client_id);
        $this->loadModel("Client");
        $this->Client->Secteur->recursive = -1;
        $this->Client->Category->recursive = -1;
        $secteur = $this->Client->Secteur->findById($client["Client"]["secteur_id"]);
        $cat = $this->Client->Category->findById($client["Client"]["category_id"]);
        $client["Category"] = $cat["Category"];
        $client["Secteur"] = $secteur["Secteur"];
        $this->set(compact('client', "affaire", 'feuille_id'));
        // debug($client);
    }

    public function ajouter_cp($client_id = 0, $affaire_id = null, $feuille_id = 0)
    {
        if ($this->request->is('post')) {
            // debug($this->request->data);exit;
            $kain = $this->Rapportprocpect->find("count", array("conditions" => array("Rapportprocpect.prospectfeuille_id" => $this->request->data["Rapportprocpect"]["prospectfeuille_id"])));
            if ($kain != 0) {
                $this->Session->setFlash(__('La rapport  à été déja enregistré'));
                return $this->redirect(array('action' => 'fuille_route_conseiller'));
            }
            $this->Rapportprocpect->create();
            $this->request->data["Rapportprocpect"]["user_id"] = AuthComponent::user('id');
            $this->request->data["Rapportprocpect"]["type_user"] = AuthComponent::user('identification');
            if ($this->request->data["Rapportprocpect"]["commercial"] == "Oui")
                unset($this->request->data["Rapportprocpect"]["commande"]);

            if ($this->request->data["Rapportprocpect"]["connaissance"] == "Non") {
                unset($this->request->data["Rapportprocpect"]["disponibilite"]);
                unset($this->request->data["Rapportprocpect"]["vente"]);
                unset($this->request->data["Rapportprocpect"]["comment"]);
            }
            if (isset($this->request->data['Rapportprocpect']['reclamation'])) {
                $reclamationcases = $this->request->data['Rapportprocpect']['reclamation'];
                if (is_array($reclamationcases)) {
                    $this->request->data['Rapportprocpect']['reclamation'] = implode('|', $reclamationcases);
                } else {
                    $this->request->data['Rapportprocpect']['reclamation'] = '';
                }
            }

            if (isset($this->request->data['Rapportprocpect']['objection'])) {
                $objectioncases = $this->request->data['Rapportprocpect']['objection'];
                if (is_array($objectioncases)) {
                    $this->request->data['Rapportprocpect']['objection'] = implode('|', $objectioncases);
                } else {
                    $this->request->data['Rapportprocpect']['objection'] = '';
                }
            }

            if (isset($this->request->data['Rapportprocpect']['qualification'])) {
                $qualificationcases = $this->request->data['Rapportprocpect']['qualification'];
                if (is_array($qualificationcases)) {
                    $this->request->data['Rapportprocpect']['qualification'] = implode('|', $qualificationcases);
                } else {
                    $this->request->data['Rapportprocpect']['qualification'] = '';
                }
            }
            $this->request->data['Rapportprocpect']['qualification'] = implode('|', $qualificationcases);

            if (isset($this->request->data['Rapportprocpect']['objection_two'])) {
                $objection_twos = $this->request->data['Rapportprocpect']['objection_two'];
                if (is_array($objection_twos)) {
                    $this->request->data['Rapportprocpect']['objection_two'] = implode('|', $objection_twos);
                } else {
                    $this->request->data['Rapportprocpect']['objection_two'] = '';
                }
            }
            $this->request->data['Rapportprocpect']['objection_two'] = implode('|', $objection_twos);

            if ($this->Rapportprocpect->save($this->request->data)) {
                $etat = "Terminer";
                if ($this->request->data["Rapportprocpect"]["commercial"] == "Oui") {
                    $etat = "A traiter";
                    $this->loadModel("Secteur");
                    $this->Secteur->recursive = -1;
                    $this->Rapportprocpect->Client->recursive = -1;
                    $client = $this->Rapportprocpect->Client->findById($this->request->data["Rapportprocpect"]["client_id"]);
                    $secteur = $this->Secteur->findById($client["Client"]["secteur_id"]);
                    $message = "-   Nom pharmacie : " . $client["Client"]["nom"] . " / " . $client["Client"]["dirigent"] . "
                                -   Numéro de téléphone : " . $client["Client"]["tel"] . " / " . $client["Client"]["fixe"] . "
                                -   Région/ville : " . $secteur["Secteur"]["region"] . " / " . $secteur["Secteur"]["ville"] . "
                                -   Adresse : " . $client["Client"]["adress"] . "
                                -   Nom téléconseiller : " . AuthComponent::user('name');

                    $this->loadModel("Prospectfeuille");
                    $fueille = $this->Prospectfeuille->findById($this->request->data["Rapportprocpect"]["prospectfeuille_id"]);
                    $titre = "[CRM VMP]Vous avez une nouvelle opportunité [Campagne : " . $fueille["Prospectcompagne"]["name"] . " ]";
                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail();
                    $Email->to(array("z.ouzine@esnapharm.com", "m.ouichou@esnapharm.com", "y.farah@valpharma.ma"));
                    $Email->from('CRM@esnapharm.com');
                    $Email->subject($titre);
                    $Email->send($message);
                    $this->loadModel('Boitemail');
                    $this->Boitemail->create();
                    $d = array();
                    $d['Boitemail']['lien'] = "/clients/view/" . $client["Client"]["id"];
                    $d['Boitemail']['user_id'] = 223; //$super['User']['id'];
                    $d['Boitemail']['user1_id'] = 0;
                    $d['Boitemail']['titre'] = $titre;
                    $d['Boitemail']['message'] = $message;
                    $this->Boitemail->save($d);
                }



                $this->loadModel("Prospectfeuille");
                $this->Prospectfeuille->id = $this->request->data["Rapportprocpect"]["prospectfeuille_id"];
                $this->Prospectfeuille->saveField("etat", $etat);
                $this->Session->setFlash(__('La rapportprocpect à été enregistré'));
                return $this->redirect(array('action' => 'fuille_route_conseiller'));
            } else {
                $this->Session->setFlash(__("La rapportprocpect  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
            }
        }
        $exist = $this->Rapportprocpect->findByProspectfeuilleId($feuille_id);
        if (!empty($exist)) {
            $this->Session->setFlash("Appel déja effectué");
            return $this->redirect(array('action' => 'fuille_route_conseiller'));
        }

        $this->loadModel("Prospectcompagne");
        $this->Prospectcompagne->recursive = -1;
        $affaire = $this->Prospectcompagne->findById($affaire_id);
        $this->Rapportprocpect->Client->recursive = -1;
        $client = $this->Rapportprocpect->Client->findById($client_id);
        $this->loadModel("Client");
        $this->Client->Secteur->recursive = -1;
        $this->Client->Category->recursive = -1;
        $secteur = $this->Client->Secteur->findById($client["Client"]["secteur_id"]);
        $cat = $this->Client->Category->findById($client["Client"]["category_id"]);
        $client["Category"] = $cat["Category"];
        $client["Secteur"] = $secteur["Secteur"];
        $this->set(compact('client', "affaire", 'feuille_id'));
        // debug($client);
    }


    function export_feuille() 
	{
		//@ini_set('zlib.output_compression', 'Off');
		//@ini_set('implicit_flush', 1);
		//header('X-Accel-Buffering: identity');

		/*$rr=$this->Rapportprocpect->find("all" ,array("conditions"=>array("Rapportprocpect.type_user is null")));
		debug($rr);
		foreach($rr as $r)
		{
			$this->Rapportprocpect->id=$r["Rapportprocpect"]["id"];
			$this->Rapportprocpect->saveField("type_user",$r["User"]["identification"]);
		}
		exit();*/
		
        ini_set('memory_limit', '-1');
        set_time_limit(20);
        $date = date('Y-m-01') . '--' . date("Y-m-t");
        $appels = array();

        if (isset($_GET["date"])) {
            $date =$_GET["date"];

            //creation fichier
            $datename = str_replace("--", "_", $date);
            //$namefile = "CRM_export_" . AuthComponent::user('code_wavsoft') . "_$datename.zip";
            //$file = fopen("files/" . $namefile, "w") or die("Unable to open file!");
			$reclamation=["Demande delegue","Demande echantillons","Demande flyer/panneaux/plv","Demande gadgets publicitaires","Rupture produit","Ancienne reclamation non traitee"];
			$reclamationlabel=";reclamation:".implode(";reclamation:",$reclamation);
			$objection=["Probleme de prescription","Prix produit","Indication rare","Retour client negatif","Produit dispo mais ne se vend pas","Pharmacie ne fait pas de conseil"];
			$objectionlabel=";objection:".implode(";objection:",$objection);
			
			$qualification =["Donne du temps/ecoute","Mise en place assuree","Commande assuree","Benchmark","Pharmacie conseil","Interet tres faible pour la prospection telephonique"];
			$qualificationpoint =["Donne du temps/ecoute"=>1,"Mise en place assuree"=>2,"Commande assuree"=>3,"Benchmark"=>2,"Pharmacie conseil"=>2,"Interet tres faible pour la prospection telephonique"=>0];
			$qualificationlabel=";qualification:".implode(";qualification:",$qualification);
			
			$objection_two=["Promoteur","Prix produit","Detracteur","NPS","Non Renseigné"];
			$objection_twolabel=";objection_two:".implode(";objection_two:",$objection_two);
			
			
			
			$head = "type_tiers;code prospect_client;Code actions;état;Type action;intervenant_code;dordre_code;campagne;"
                ."affaire;Objet;Priorité;date debut;date fin;Heure debut;Heure fin;datetime visite;connaissance;disponibilite;vente;comment;".
                "commercial;commande;Apprécation $reclamationlabel$objectionlabel ;Propositions;duree;Actions CRM;type_user;is_reported;motif;hors_campagne;commercial_type;commercial_opportunite;commercial_produits;commercial_raison;commercial_date;commercial_codewavesoft;commercial_commentaire;date_programmer;commercial_programmer_codewavesoft;commercial_programmer_type;region;ville;secteur;nom_client $qualificationlabel;points;fix;type_achat;type_achat_grossiste;frequence_passage_commercial;commande_groupee;statut_client $objection_twolabel;commercial_campagne
";
			echo "$head<br>";
            //fwrite($file, $head);


            $datee = str_replace("--", "' and '", $date);
            if ($_GET["type"] == 2)
                $export = "";
            else
                $export = " and Rapportprocpect.export=" .$_GET["type"] . " ";
			$export = "";
            //$appels = $this->Rapportprocpect->Prospectfeuille->find("all", array("conditions" => array("1=1 $export and Prospectfeuille.etat!='En cours' and Prospectfeuille.modified BETWEEN '$datee'")));
			$appels = $this->Rapportprocpect->Prospectfeuille->find("all", array(
                "conditions" => array(
                    "1=1 $export and Prospectfeuille.etat!='En cours' and Prospectfeuille.modified BETWEEN '$datee'"
                ),
                "fields" => array(
                    // Prospectfeuille
                    "Prospectfeuille.id",
                    "Prospectfeuille.etat",
                    "Prospectfeuille.prospectcompagne_id",
                    "Prospectfeuille.modified",
                    "Prospectfeuille.rappel",
                    "Prospectfeuille.motif",
                    "Prospectfeuille.commercial_type",
                    "Prospectfeuille.commercial_opportunite",
                    "Prospectfeuille.commercial_produits",
                    "Prospectfeuille.commercial_raison",
                    "Prospectfeuille.commercial_date",
                    "Prospectfeuille.commercial_user_wavesoft",
                    "Prospectfeuille.commercial_commentaire",
                    "Prospectfeuille.commercial_programmer",

                    // Rapportprocpect
                    "Rapportprocpect.id",
                    "Rapportprocpect.created",
                    "Rapportprocpect.duree",
                    "Rapportprocpect.connaissance",
                    "Rapportprocpect.disponibilite",
                    "Rapportprocpect.vente",
                    "Rapportprocpect.comment",
                    "Rapportprocpect.commercial",
                    "Rapportprocpect.commande",
                    "Rapportprocpect.appreciation",
                    "Rapportprocpect.reclamation",
                    "Rapportprocpect.objection",
                    "Rapportprocpect.objection_two",
                    "Rapportprocpect.qualification",
                    "Rapportprocpect.proposition",
                    "Rapportprocpect.hors_campagne",
                    "Rapportprocpect.type_achat_direct",
                    "Rapportprocpect.type_achat_grossiste",
                    "Rapportprocpect.frequence_passage_commercial",
                    "Rapportprocpect.commande_groupee",
                    "Rapportprocpect.statut_client",
                    "Rapportprocpect.type_user",

                    // User
                    "User.code_wavsoft",
                    "User.identification",

                    // Client
                    "Client.type_pharmacie",
                    "Client.code_wavsoft",
                    "Client.secteur_id",
                    "Client.nom",
                    "Client.fixe",
                )
            ));
            /*$annuler = $this->Rapportprocpect->Prospectfeuille->find("all", array("conditions" => array("Prospectfeuille.etat='Annuler' and Prospectfeuille.modified BETWEEN '$datee'")));
            $i = 0;
            foreach ($annuler as $n) {
                $annuler[$i]["Rapportprocpect"]["type_user"] = $n["User"]["identification"];
                $i++;
            }
            $appels = array_merge($appels, $annuler);*/
			
            $prospectaffairc = new ProspectaffairesController;
            $ids = 0;
			$this->loadModel("Secteur");
			$this->Secteur->recursive=-1;
			$secteurs=$this->Secteur->find("all");
            foreach ($appels as $appel) 
			{
				//had l3iba derta le 09/12/2020 car kan un pug dial chi fuille kant khawia tatl3 bug
				if($appel["Prospectfeuille"]["prospectcompagne_id"]==null)
					continue;
                $campagne = $prospectaffairc->system_getaffaire($appel["Prospectfeuille"]["prospectcompagne_id"]);
				$datetime_visite=$dat = $heure = $ref = $heur_fin = $heur_debut = "";
                $duree = 0;

                $ref = "ACP " . date("y") . "_";
                for ($i = 0; $i < 9 - strlen($appel["Prospectfeuille"]["id"]); $i++)
                    $ref .= "0";
                $ref .= $appel["Prospectfeuille"]["id"];
				
				$date_commercial="";
                if ($appel["Rapportprocpect"]["created"] != null) {

                    $ids = $ids . "," . $appel["Rapportprocpect"]["id"];
                    $date = explode(" ", $appel["Rapportprocpect"]["created"]);
                    $dat = explode("-", $date[0]);
                    $dat = "$dat[2]/$dat[1]/$dat[0]";
					$datetime_visite=$dat." ".$date[1];
					
					if($appel["Prospectfeuille"]["commercial_date"]!=null && $appel["Prospectfeuille"]["commercial_date"]!="")
					{ 
						$date_commercia = explode(" ", $appel["Prospectfeuille"]["commercial_date"]);
						$datt = explode("-", $date_commercia[0]);
						$date_commercial = "$datt[2]/$datt[1]/$datt[0]";
					}
                    $duree = explode(":", $appel["Rapportprocpect"]["duree"]);
                    if (count($duree) == 3)
                        $duree = 3600 * (int)$duree[0] + 60 * (int)$duree[1] + (int)$duree[2];
                    else
                        $duree = 0;
                    $heure = explode(":", $date[1]);

                    if ($heure[1] > 52)
                        $heure[0] ++;
                    if ($heure[0] == 24)
                        $heure[0] = "00";
                    if ($heure[1] % 15 < 7)
                        $heure[1] = 15 * $heure[1] / 15 - $heure[1] % 15;
                    else
                        $heure[1] = 15 * $heure[1] / 15 + (15 - $heure[1] % 15);

                    if ($heure[1] == 60)
                        $heure[1] = "00";
                    $heur_debut = $heure[0] . $heure[1];
                    if ($heure[1] == 45) {
                        $heure[0] ++;
                        $heure[1] = "00";
                    } else
                        $heure[1] += 15;
                    if ($heure[0] == 24)
                        $heure[0] = "00";
                    $heur_fin = $heure[0] . $heure[1];
                } else {
                    $date = explode(" ", $appel["Prospectfeuille"]["modified"]);
                    $dat = explode("-", $date[0]);
                    $dat = "$dat[2]/$dat[1]/$dat[0]";
					$datetime_visite=$dat." ".$date[1];
                }
				//--------------------------Debut nouveau reclamation 28/05/2023--------------------------------//
				$reclamations=explode("|",$appel["Rapportprocpect"]["reclamation"]);
				$data_reclamation=array();
				foreach($reclamation as $k=>$v)
				{
					
					if(in_array($v,$reclamations))
						$data_reclamation[]="O";
					else
						$data_reclamation[]="N";
				}
				$data_reclamation=implode(";",$data_reclamation);
				$appel["Rapportprocpect"]["reclamation"] =$data_reclamation;
				//--------------------------Fin--------------------------------//
				//--------------------------Debut nouveau objection 28/05/2023--------------------------------//
				$objections=explode("|",$appel["Rapportprocpect"]["objection"]);
				$data_objection=array();
				foreach($objection as $k=>$v)
				{
					if(in_array($v,$objections))
						$data_objection[]="O";	
					else
						$data_objection[]="N";
				}
				$data_objection=implode(";",$data_objection);
				$appel["Rapportprocpect"]["objection"] =$data_objection;
				
				//--------------------------Fin--------------------------------//objection
				//--------------------------Debut nouveau qualification 28/05/2023--------------------------------//
				$qualifications=explode("|",$appel["Rapportprocpect"]["qualification"]);
				$data_qualification=array();
				$point=0;
				foreach($qualification as $k=>$v)
				{
					
					if(in_array($v,$qualifications))
					{
						$data_qualification[]="O";
						$point=$point+$qualificationpoint[$v];
					}
					else
						$data_qualification[]="N";
				}
				$data_qualification=implode(";",$data_qualification);
				$appel["Rapportprocpect"]["qualification"] =$data_qualification;
				
				//--------------------------Fin--------------------------------//qualification
				
				//--------------------------Debut nouveau objection_two 04/07/2024--------------------------------//
				$objections=explode("|",$appel["Rapportprocpect"]["objection_two"]);
				$data_objection=array();
				foreach($objection_two as $k=>$v)
				{
					if(in_array($v,$objections))
						$data_objection[]="O";	
					else
						$data_objection[]="N";
				}
				$data_objection=implode(";",$data_objection);
				$appel["Rapportprocpect"]["objection_two"] =$data_objection;
				
				//--------------------------Fin--------------------------------//objection_two
				
				
				
                //$appel["Rapportprocpect"]["question"] = $this->system_get_clean_text($appel["Rapportprocpect"]["question"]);
                
                $appel["Rapportprocpect"]["proposition"] = $this->system_get_clean_text($appel["Rapportprocpect"]["proposition"]);
                $appel["Prospectfeuille"]["motif"] = $this->system_get_clean_text($appel["Prospectfeuille"]["motif"]);
                $appel["Prospectfeuille"]["commercial_raison"] = $this->system_get_clean_text($appel["Prospectfeuille"]["commercial_raison"]);
                $commercial_commentaire = $this->system_get_clean_text($appel["Prospectfeuille"]["commercial_commentaire"]);
                $appel["Rapportprocpect"]["commande"] = $this->system_get_clean_text($appel["Rapportprocpect"]["commande"]);
                $appel["Rapportprocpect"]["hors_campagne"] = $this->system_get_clean_text($appel["Rapportprocpect"]["hors_campagne"]);
				
                $appel["Rapportprocpect"]["type_achat_direct"] = $this->system_get_clean_text($appel["Rapportprocpect"]["type_achat_direct"]);
                $appel["Rapportprocpect"]["type_achat_grossiste"] = $this->system_get_clean_text($appel["Rapportprocpect"]["type_achat_grossiste"]);
                $appel["Rapportprocpect"]["frequence_passage_commercial"] = $this->system_get_clean_text($appel["Rapportprocpect"]["frequence_passage_commercial"]);
                $appel["Rapportprocpect"]["commande_groupee"] = $this->system_get_clean_text($appel["Rapportprocpect"]["commande_groupee"]);
                $appel["Rapportprocpect"]["statut_client"] = $this->system_get_clean_text($appel["Rapportprocpect"]["statut_client"]);
				
				
				$type_user=$appel["User"]["identification"];
				if($appel["Rapportprocpect"]["type_user"]!=null)
					$type_user=$appel["Rapportprocpect"]["type_user"];
				
				if($appel["Prospectfeuille"]["etat"]=="A traiter")
					$appel["Prospectfeuille"]["etat"]="C";


                $is_reported = "N";
                if ($appel["Prospectfeuille"]["rappel"] != null)
                    $is_reported = "O";
				
				$commercial_programmer="";
				$commercial_programmer_codewavesoft="";
				$commercial_programmer_type="";
				if($appel["Prospectfeuille"]["commercial_programmer"]!=null)
				{
					$d=explode(";;",$appel["Prospectfeuille"]["commercial_programmer"]);
					$commercial_programmer_codewavesoft=$d[2];
					$commercial_programmer_type=$d[1];
					$dateprogramer = explode(" ", $d[0]);
                    $dateprogramer = explode("-", $dateprogramer[0]);
                    $commercial_programmer = "$dateprogramer[2]/$dateprogramer[1]/$dateprogramer[0]";
				}
				$region=$ville=$secteur="";
				foreach($secteurs as $s)
				{
					if($s["Secteur"]["id"]==$appel["Client"]["secteur_id"])
					{
						$region=$s["Secteur"]["region"];
						$ville=$s["Secteur"]["ville"];
						$secteur=$s["Secteur"]["secteur"];
						break;
					}
				}
				$nom_client=$appel["Client"]["nom"];
				$fix=$appel["Client"]["fixe"];
                
                $first = function($val) { return ($val ?? '')[0] ?? ''; };

                $body = $first($appel["Client"]["type_pharmacie"]) . ';' . 
                    $appel["Client"]["code_wavsoft"] . ';' . 
                    $ref . ';' . 
                    $first($appel["Prospectfeuille"]["etat"]) . ';TS;' . 
                    $appel["User"]["code_wavsoft"] . ';' .
                    $campagne["User"]["code_wavsoft"] . ';' . 
                    $campagne["Prospectcompagne"]["code_wavesoft"] . ';' .
                    $campagne["Prospectaffaire"]["code_wavesoft"] . ';' . 
                    $campagne["Prospectcompagne"]["name"] . ';N;' . 
                    $dat . ';' .
                    $dat . ';' . 
                    $heur_debut . ';' . 
                    $heur_fin . ';' . 
                    $datetime_visite . ';' . 
                    $first($appel["Rapportprocpect"]["connaissance"]) . ';' .
                    $first($appel["Rapportprocpect"]["disponibilite"]) . ';' . 
                    $first($appel["Rapportprocpect"]["vente"]) . ';' . 
                    $appel["Rapportprocpect"]["comment"] . ';' . 
                    $first($appel["Rapportprocpect"]["commercial"]) . ';' . 
                    $appel["Rapportprocpect"]["commande"] . ';' . 
                    $appel["Rapportprocpect"]["appreciation"] . ';' .
                    $appel["Rapportprocpect"]["reclamation"] . ';' . 
                    $appel["Rapportprocpect"]["objection"] . ';' . 
                    $appel["Rapportprocpect"]["proposition"] . ';' . 
                    $duree . ';O;' . 
                    $type_user . ';' . 
                    $is_reported . ';' . 
                    $appel["Prospectfeuille"]["motif"] . ';' . 
                    $appel["Rapportprocpect"]["hors_campagne"] . ';' . 
                    $appel["Prospectfeuille"]["commercial_type"] . ';' .
                    $appel["Prospectfeuille"]["commercial_opportunite"] . ';' . 
                    $appel["Prospectfeuille"]["commercial_produits"] . ';' . 
                    $appel["Prospectfeuille"]["commercial_raison"] . ';' . 
                    $date_commercial . ';' . 
                    $appel["Prospectfeuille"]["commercial_user_wavesoft"] . ';' .
                    $commercial_commentaire . ';' . 
                    $commercial_programmer . ';' . 
                    $commercial_programmer_codewavesoft . ';' . 
                    $commercial_programmer_type . ';' . 
                    $region . ';' . 
                    $ville . ';' . 
                    $secteur . ';' . 
                    $nom_client . ';' . 
                    $appel["Rapportprocpect"]["qualification"] . ';' . 
                    $point . ';' . 
                    $fix . ';' . 
                    $appel["Rapportprocpect"]["type_achat_direct"] . ';' .
                    $appel["Rapportprocpect"]["type_achat_grossiste"] . ';' . 
                    $appel["Rapportprocpect"]["frequence_passage_commercial"] . ';' .
                    $appel["Rapportprocpect"]["commande_groupee"] . ';' . 
                    $appel["Rapportprocpect"]["statut_client"] . ';' . 
                    $appel["Rapportprocpect"]["objection_two"] . ';' . 
                    $first($appel["Rapportprocpect"]["connaissance"]) . ";
                ";
				echo "$body<br>";
                //fwrite($file, $body);
            }
            $this->Rapportprocpect->query("UPDATE rapportprocpects SET export='1' WHERE  id IN ($ids);");

            /*fclose($file);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $namefile . '"');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . $namefile);
            ob_clean();
            flush();
            readfile(WWW_ROOT . "files/" . $namefile);*/
            exit();
        }
        $this->set(compact('appels', 'date'));
    }




    function fuille_route_conseiller($user_id = null)
    {
        $profile = array("Teleconseiller", "VMP", "Coordinateur");
        if (in_array(AuthComponent::user('role'), $profile) || $user_id == null) {
            $user_id = AuthComponent::user('id');
        }
        $this->loadModel("Prospectfeuille");
        $clientfeuillesterminer = $this->Prospectfeuille->find("all", array("conditions" => array("Prospectfeuille.user_id=$user_id", "DATE(Prospectfeuille.modified)" => date("Y-m-d"), "Prospectfeuille.etat in('Terminer','Annuler','A traiter')")));
        $this->Prospectfeuille->recursive = -1;
        $clientfeuilles = $this->Prospectfeuille->find("all", array("conditions" => array(
            "Prospectfeuille.user_id=$user_id",
            "Prospectfeuille.etat='En cours' limit 100"
        )));
        $id_clients = 0;
        $id_compagnes = 0;
        $ids = 0;
        foreach ($clientfeuilles as $cf) {
            $ids = "$ids," . $cf["Prospectfeuille"]["id"];
            $id_clients = "$id_clients," . $cf["Prospectfeuille"]["client_id"];
            $id_compagnes = "$id_compagnes," . $cf["Prospectfeuille"]["prospectcompagne_id"];
        }
        //-----------------------Client----------------------------//
        $this->Prospectfeuille->Client->recursive = -1;
        $clients = $this->Prospectfeuille->Client->find("all", array("conditions" => array("Client.id in ($id_clients)")));
        $restructuredClients = [];
        foreach ($clients as $client) {
            $restructuredClients[$client['Client']['id']] = $client["Client"];
        }
        //----------------------------------------Fin Clients-------------------------------------//
        //----------------------------------------prospectcompagnes-------------------------------------//
        $this->Prospectfeuille->Prospectcompagne->recursive = -1;
        $prospectcompagnes = $this->Prospectfeuille->Prospectcompagne->find("all", array("conditions" => array("Prospectcompagne.id in ($id_compagnes)")));
        $restructuredprospectcompagnes = [];
        foreach ($prospectcompagnes as $prospectcompagne) {
            $restructuredprospectcompagnes[$prospectcompagne['Prospectcompagne']['id']] = $prospectcompagne['Prospectcompagne'];
        }
        //----------------------------------------Fin prospectcompagnes-------------------------------------//

        //----------------------------------------Rapportprocpects-------------------------------------//
        $this->Prospectfeuille->Rapportprocpect->recursive = -1;
        $rapportprocpects = $this->Prospectfeuille->Rapportprocpect->find("all", array("conditions" => array("Rapportprocpect.prospectfeuille_id in ($ids)")));
        $restructuredrapportprocpects = [];
        foreach ($rapportprocpects as $rapportprocpect) {
            $restructuredrapportprocpects[$rapportprocpect['Rapportprocpect']['prospectfeuille_id']] = $rapportprocpect['Rapportprocpect'];
        }
        //----------------------------------------Fin Rapportprocpects-------------------------------------//




        foreach ($clientfeuilles as $key => $cf) {
            $clientfeuilles[$key]["Client"] = $restructuredClients[$cf["Prospectfeuille"]["client_id"]];
            $clientfeuilles[$key]["Prospectcompagne"] = $restructuredprospectcompagnes[$cf["Prospectfeuille"]["prospectcompagne_id"]];
            if (isset($restructuredrapportprocpects[$cf["Prospectfeuille"]["id"]]))
                $clientfeuilles[$key]["Rapportprocpect"] = $restructuredrapportprocpects[$cf["Prospectfeuille"]["id"]];
            else
                $clientfeuilles[$key]["Rapportprocpect"] = array();
        }



        $clientfeuilles = array_merge($clientfeuilles, $clientfeuillesterminer);
        $this->loadModel("Secteur");
        $secteurs = $this->Secteur->find("list");
        $this->set(compact('clientfeuilles', 'secteurs'));
    }

    function annuler_appel()
    {
        if ($this->request->is('post')) {
            $this->Rapportprocpect->Prospectfeuille->recursive = -1;
            $feuille = $this->Rapportprocpect->Prospectfeuille->findById($this->request->data["Rapportprocpect"]["prospectfeuille_id"]);
            if (AuthComponent::user('id') != $feuille["Prospectfeuille"]["user_id"])
                $this->Session->setFlash("Vous n'avez pas le droit d'annuler cette planification");
            else {
                $this->Rapportprocpect->Prospectfeuille->id = $this->request->data["Rapportprocpect"]["prospectfeuille_id"];
                $this->Rapportprocpect->Prospectfeuille->saveField("motif", $this->request->data["Rapportprocpect"]["motif"]);
                $this->Rapportprocpect->Prospectfeuille->saveField("etat", "Annuler");
                $this->Session->setFlash("Appel annuler");
            }
            return $this->redirect(array('action' => 'fuille_route_conseiller'));
        }
    }

    function reporter_appel()
    {
        if ($this->request->is('post')) {
            $this->Rapportprocpect->Prospectfeuille->recursive = -1;
            $feuille = $this->Rapportprocpect->Prospectfeuille->findById($this->request->data["Rapportprocpect"]["prospectfeuille_id"]);

            if (AuthComponent::user('id') != $feuille["Prospectfeuille"]["user_id"])
                $this->Session->setFlash("Vous n'avez pas le droit roporter cette planification");
            else {
                $this->Rapportprocpect->Prospectfeuille->id = $this->request->data["Rapportprocpect"]["prospectfeuille_id"];
                $this->Rapportprocpect->Prospectfeuille->saveField("rappel", $this->request->data["Rapportprocpect"]["rappel"]);
                $this->Session->setFlash("Appel roporter");
            }
            return $this->redirect(array('action' => 'fuille_route_conseiller'));
        }
    }

    function edit_client_champ_vide()
    {
        $this->loadModel("Client");
        $this->Client->recursive = -1;

        $client = $this->Client->findById($this->request->data["client_id"]);
        if (empty($client))
            exit();
        $client = $client["Client"];
        $this->Client->id = $this->request->data["client_id"];
        foreach ($this->request->data as $key => $value) {
            if ($key == "client_id")
                continue;

            // if (strlen($client[$key]) < 3) {

            if ($key == "mail") {
                $pos = strpos($value, "@");
                if ($pos === false)
                    continue;
            }
            if ($key == "tel" || $key == "fixe") {
                $value = preg_replace('/[^0-9]/', '', $value);
                if (strlen($value) != 10)
                    continue;
            }
            $this->Client->saveField($key, $value);
            // }
        }
        exit();
    }

    function system_get_appel_for_client($client_id)
    {
        $appels = $this->Rapportprocpect->find("all", array(
            "conditions" => array("Rapportprocpect.client_id" => $client_id),
            "order" => array("Rapportprocpect.created desc")
        ));
        $this->loadModel("Prospectcompagne");
        $campgnes = $this->Prospectcompagne->find('list');
        $i = 0;
        foreach ($appels as $p) {
            foreach ($campgnes as $k => $v) {
                if ($k == $p["Prospectfeuille"]["prospectcompagne_id"]) {
                    $appels[$i]["Prospectfeuille"]["prospectcompagne"] = $v;
                    break;
                }
            }
            $i++;
        }
        return $appels;
    }

    function system_get_clean_text($string = null)
    {
        if ($string === null || $string === '') {
            return '';
        }

        $string = (string)$string;
        $string = preg_replace('/\R+/', " ", $string);
        $string = str_replace(
            ['Ã©', 'é', 'è', 'à', 'Ã', 'ã', 'ô', 'ê'],
            ['e', 'e', 'e', 'a', 'a', 'a', 'o', 'e'],
            $string
        );
        $string = str_replace([';', '"'], ['', "'"], $string);

        return trim($string);
    }



    function opportunites()
    {
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $secteurs = $this->Secteur->find("all", array("conditions" => array("Secteur.id in (0," . AuthComponent::user('villes') . ")")));
        $villes = "'0'";
        foreach ($secteurs as $s) {
            $villes = $villes . ",'" . $s["Secteur"]["ville"] . "'";
        }
        $secteurs = $this->Secteur->find("all", array("conditions" => array("Secteur.ville in ($villes)")));
        $villes = "0";
        foreach ($secteurs as $s) {
            $villes = $villes . "," . $s["Secteur"]["id"];
        }

        $opportinites = $this->Rapportprocpect->query("SELECT * 
            FROM clients AS Client,prospectfeuilles AS Prospectfeuille,rapportprocpects AS Rapportprocpect ,prospectcompagnes AS Prospectcompagne
            ,secteurs AS Secteur
            WHERE Client.id=Prospectfeuille.client_id AND Prospectcompagne.id=Prospectfeuille.prospectcompagne_id and 
            Prospectfeuille.id =Rapportprocpect.prospectfeuille_id and Client.secteur_id=Secteur.id and 
            Client.secteur_id IN($villes) AND Prospectfeuille.commercial_type is null
            AND Rapportprocpect.commercial='Oui'");

        $terminer = $this->Rapportprocpect->query("SELECT * 
            FROM clients AS Client,prospectfeuilles AS Prospectfeuille,rapportprocpects AS Rapportprocpect ,prospectcompagnes AS Prospectcompagne ,secteurs AS Secteur
            WHERE Client.id=Prospectfeuille.client_id AND Prospectcompagne.id=Prospectfeuille.prospectcompagne_id and 
            Prospectfeuille.id =Rapportprocpect.prospectfeuille_id and Client.secteur_id=Secteur.id and 
            Client.secteur_id IN($villes) AND Prospectfeuille.commercial_type is not null and  DATE_FORMAT(Prospectfeuille.modified, '%Y-%m-%d') = CURDATE() 
            AND Rapportprocpect.commercial='Oui'");
        $opportinites = array_merge($opportinites, $terminer);
        $this->set(compact('opportinites'));
    }


    function traiter($prospectcompagne_id = null, $id = null)
    {
        if ($this->request->is('post')) {
            $this->Rapportprocpect->Prospectfeuille->id = $this->request->data["Prospectfeuille"]["prospectfeuille_id"];
            $this->request->data["Prospectfeuille"]["etat"] = "Terminer";
            $this->request->data["Prospectfeuille"]["commercial_date"] = date("Y-m-d H:i:s");
            $this->request->data["Prospectfeuille"]["commercial_user_wavesoft"] = AuthComponent::user('code_wavsoft');

            $this->Rapportprocpect->Prospectfeuille->save($this->request->data);
            $rapportprocpect = $this->Rapportprocpect->findByProspectfeuilleId($this->request->data["Prospectfeuille"]["prospectfeuille_id"]);
            $this->Rapportprocpect->query("UPDATE rapportprocpects SET export='0' WHERE  id =" . $rapportprocpect['Rapportprocpect']["id"]);
            $this->Session->setFlash(__('Rapport enregistré'));
            return $this->redirect(array('action' => 'opportunites'));
        }
        $this->loadModel("Prospectcompagne");
        $this->Prospectcompagne->recursive = -1;
        $prospectcompagne = $this->Prospectcompagne->findById($prospectcompagne_id);
        $rapportprocpect = $this->Rapportprocpect->findById($id);
        $secteur = $this->requestAction("/secteurs/system_get_secteur/" . $rapportprocpect["Client"]["secteur_id"]);
        $rapportprocpect["Client"]["ville"] = $secteur["Secteur"]["ville"];
        $rapportprocpect["Client"]["region"] = $secteur["Secteur"]["region"];
        $this->set(compact('prospectcompagne', 'rapportprocpect'));
    }


    function programmer_opportunites()
    {
        if ($this->request->is('post')) {
            $this->Rapportprocpect->Prospectfeuille->id = $this->request->data["Prospectfeuille"]["prospectfeuille_id"];
            $this->request->data["Prospectfeuille"]["commercial_programmer"] = $this->request->data["Prospectfeuille"]["date_programmer"] . ";;" . $this->request->data["Prospectfeuille"]["type_visite"] . ";;" . AuthComponent::user('name');
            $this->Rapportprocpect->Prospectfeuille->save($this->request->data);
        }
        $this->Session->setFlash(__('Rapport enregistré'));
        return $this->redirect(array('action' => 'opportunites'));
    }




    function supprimer($id)
    {
        $this->Rapportprocpect->id = $id;
        $this->Rapportprocpect->delete();
        $this->Session->setFlash('Rapport supprimer');
        $this->redirect($this->referer());
    }
}
