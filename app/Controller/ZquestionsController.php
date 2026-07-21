<?php
App::uses('AppController', 'Controller');
/**
 * Visiteordres Controller
 *
 * @property Visiteordre $Visiteordre
 * @property PaginatorComponent $Paginator
 */
class ZquestionsController extends AppController {


	function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('addv0',"sucess","syetem_json"); 
    }
	

	public function addv0() 
	{
		if ($this->request->is('post')) {
			$nom = "";
			$ref = "";
			//debug($this->request->data);exit();
			foreach ($this->request->data["Zquestion"] as $key => $value) {
				if ($key == "nom") {
					$nom = $value;
					continue;
				}
				if (is_array($value)) 
				{
					if (isset($value["repense"]))
					{
						if (is_array($value["repense"]))
							$value["repense"]=implode("|", $value["repense"]);
					}
					
					$this->Zquestion->create();
					$value["nom"] = $nom;
					$value["ref"] = $ref;
					$this->Zquestion->save($value);
					if ($ref == "") {
						$ref = $this->Zquestion->id;
						$this->Zquestion->saveField("ref", $ref);
					}
				}
			}
			//exit();
			$this->Session->setFlash(__('Les réponses ont été enregistrées.'));
			return $this->redirect(['action' => 'sucess']);
		}
		$json=$this->system_json();
		$this->set(compact("json"));
		$this->layout = '';
	}
	
	
	public function sucess() {
		$this->layout = '';
	}
	
	
	function index()
	{ 
		$questions=$this->Zquestion->find("all",array("oreder"=>array("id asc")));
		$listeusers="";
		$users=array();
		foreach($questions as $question)
		{
			$question=$question["Zquestion"];
			if(!isset($users[$question["nom"]]))
			{
				$users[$question["nom"]]=array();
				$listeusers="$listeusers,".$question["nom"];
			}
			$users[$question["nom"]][]=$question;
			
			
		}
		$stats=array();
		//debug($users);
		$this->set(compact("questions","users","listeusers"));
		//$this->layout = '';
	}
	
	function delete($id = null)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$this->Zquestion->id = $id;
		if (!$this->Zquestion->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}

		if ($this->Zquestion->delete()) {
			$this->Session->setFlash(__('Repense deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash("Repense not deleted");
		$this->redirect(array('action' => 'index'));
	}
	
	
	function detail($id)
	{
		$question=$this->Zquestion->findById($id);
		$questions=$this->Zquestion->find("all",array("conditions"=>array("Zquestion.question"=>$question["Zquestion"]["question"],
						"Zquestion.titre"=>$question["Zquestion"]["titre"],
						"Zquestion.soustitre"=>$question["Zquestion"]["soustitre"]),"order"=>array("repense asc")));
		$stats=array();
		foreach($questions as $q)
		{
			$q=$q["Zquestion"];
			if(!isset($stats[$q["repense"]]))
				$stats[$q["repense"]]=0;
			$stats[$q["repense"]]++;
		}
		$this->set(compact("question","stats","questions"));
	}
	
	
	
	
	
	function system_json()
	{
		$json='{
			  "planification": {
				"plan_d_actions": {
				  "questions": [
					{
					  "question": "Avez-vous établi un plan d’actions en début d’année 2024 ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Si oui, avez-vous validé le plan d’actions ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Est-ce que vous avez respecté votre plan d’actions initial ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Si oui, à quel pourcentage l’avez-vous respecté ?",
					  "options": ["50%", "70%", "90%", "100%"]
					},
					{
					  "question": "Comment jugez-vous le plan d’actions exécuté par rapport aux sorties grossistes ? Donnez une note sur 10.",
					  "options": ["5/10", "7/10", "9/10", "10/10"]
					},
					{
					  "question": "Quel est le degré d’importance de la planification du plan d’action dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				},
				
				"plan_de_tournees": {
				  "questions": [
					{
					  "question": "Avez-vous établi un plan de tournées en début d’année 2024 ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Si oui, avez-vous validé le plan de tournées ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Est-ce que vous avez respecté votre plan de tournées initial ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Si oui, à quel pourcentage l’avez-vous respecté ?",
					  "options": ["50%", "70%", "90%", "100%"]
					},
					{
					  "question": "Est-ce que votre plan de tournées 2024 vous a permis de réaliser vos objectifs ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Quel est le degré d’importance de planifier un plan de tournée annuel dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				},
				
				"feuilles_de_route": {
				  "questions": [
					{
					  "question": "Est-ce que vous validez les feuilles de route des VM ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Comment jugez-vous le respect des feuilles de route par votre équipe ? Donnez une note sur 10.",
					  "options": ["5/10", "7/10", "9/10", "10/10"]
					},
					{
					  "question": "Pour les VM : À quelle fréquence vous validez la feuille de route du VM 2 fois et plus dans la même journée ?",
					  "options": ["Fréquemment", "Régulièrement", "Rare"]
					},
					{
					  "question": "Quel est le degré d’importance de planifier les feuilles de route dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				},
				
				 "ordre_de_presentation_produits": {
				  "questions": [
					{
					  "question": "Avez-vous respecté l’ordre de présentation produits en 2024 ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Comment jugez-vous le respect des ordre de présentation par votre équipe ? Donnez une note sur 10.",
					  "options": ["5/10", "7/10", "9/10", "10/10"]
					},
					{
					  "question": "À quel pourcentage pensez-vous la contribution du respect de l’ordre de présentation produits dans la réalisation des objectifs ?",
					  "options": ["50%", "70%", "90%", "100%"]
					},
					{
					  "question": "Comment vérifiez-vous le respect de l’ordre de présentation produits de votre équipe ?",
					  "options": ["Rapport des visites", "Réunions hebdomadaires", "l\'engagement du VMP"],
					  "type":"multi"
					},
					{
					  "question": "Est-ce que vous analyser le respect de l’ODP ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Quel est le degré d’importance du respect de l’ordre de présentation dans votre analyse?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				}	
				
			  },
			  
			  "listing": {
				"listes": {
				  "questions": [
					{
					  "question": "Est-ce que actuellement le listing des VM est stable ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "À quelle fréquence le listing est à revoir ?",
					  "options": ["1 fois/an", "2 fois/an", "3 fois/an"]
					},
					{
					  "question": "Avez-vous des secteurs importants qui ont été couverts avant et non affectés aujourd’hui ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Dans le listing des VM, est-ce que les potentialité médecins sont à jour ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Dans le listing des VM, comment jugez-vous les potentialité médecins renseignés ?",
					  "options": ["reflète la réalité", "nécessite une mise à jour"]
					},
					{
					  "question": "Quel est le degré d’importance de la potentialité dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				},
				
				"visites_medcins": {
				  "questions": [
					{
					  "question": "Quel est l’objectif de visites moyen médecins par jour ?",
					  "options": ["8", "9", "10", "11", "12", "13", "14", "15"]
					},
					{
					  "question": "Quel est l’objectif de visites médecins publiques par jour ?",
					  "options": ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"]
					},
					{
					  "question": "Quel est l’objectif de visites médecins privés par jour ?",
					  "options": ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"]
					},
					{
					  "question": "Quel est l’importance des objectifs de visite médecin dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					},
					{
					  "question": "Quel est le pourcentage potentiel 1 produit quel que soit le potentiel cabinet?",
					  "options": ["10%", "20%", "30%", "40%", "50%", "60%"]
					},
					{
					  "question": "Quel est le pourcentage potentiel 2 produit quel que soit le potentiel cabinet?",
					  "options": ["10%", "20%", "30%", "40%", "50%", "60%"]
					},
					{
					  "question": "Quel est le pourcentage potentiel 3 produit quel que soit le potentiel cabinet?",
					  "options": ["10%", "20%", "30%", "40%", "50%", "60%"]
					},
					{
					  "question": "Comment vous constituez votre portefeuille clients ?",
					  "options": ["Remontées terrain brut", "Après vérification"]
					},
					{
					  "question": "Est-ce que vos visites sont reportés ?",
					  "options": ["Oui", "Non"]
					},
					
					{
					  "question": "Comment gérez-vous vos médecins potentiels ?",
					  "options": ["Par visite", "Prise en charge", "Tables rondes", "Actions directes"],
					  "type":"multi"
					},
					{
					  "question": "Quelle stratégie adoptée face à un départ ? (choix multiple)",
					  "options": [
						"Affecter des médecins potentiels à un autre VM",
						"Assurer la visite vous-mêmes",
						"Attente nouvelle recrue"
					  ],
					  "type":"multi"
					},
					{
					  "question": "En cas de nouveau délégué, comment lui affecter le listing ?",
					  "options": ["Validation de l’ancien listing", "Affectation sans validation"]
					},
					{
					  "question": "Comment vérifiez-vous le potentiel prescription de vos médecins ? (choix multiples)",
					  "options": ["Promesse médecin", "Enquête Pharmacie", "Enquête secrétaire"],
					  "type":"multi"
					}
					  
				  ]
				},
				
				"visites_pharmacies": {
				  "questions": [
					{
					  "question": "Quel est l’objectif de visites moyen pharmacies par jour ?",
					  "options": ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"]
					},
					{
					  "question": "Quelle est la moyenne de visites pharmacies par jour réalisée en 2024 ?",
					  "options": ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"]
					},
					{
					  "question": "Quel est l’importance des objectifs de visite pharmacie dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				},
				
				"visites_en_double": {
				  "questions": [
					{
					  "question": "Planifiez-vous des visites en double ?",
					  "options": ["Oui", "Non"]
					},
					{
					  "question": "Quel est généralement (à 80%) l’objectif de la visite en double ?",
					  "options": ["Contrôle de la visite","Contrôle qualitatif du VM","Traiter des objections","Confirmer l’engagement du Médecin (Actions)"]
					},
					{
					  "question": "En moyenne, combien de visites en double vous faites en une journée ?",
					  "options": ["3 visites", "6 visites", "+ de 8 visites"]
					},
					{
					  "question": "Sur la base des visites en double réalisées en 2024, comment jugez-vous l’autonomie de votre équipe ?",
					  "options": ["Faible", "Satisfaisante", "Excellente"]
					},
					{
					  "question": "Sur la base des visites en double réalisées en 2024, comment jugez-vous la maitrise du portefeuille prescripteurs ?",
					  "options": ["Faible", "Satisfaisante", "Excellente"]
					},
					{
					  "question": "Quel est le degré d’importance de la visite en double dans votre analyse ?",
					  "options": ["moyennement important", "important", "très important"]
					}
				  ]
				}
				
			  },
			  
			  
			  "formations": {
					"formation_argumentaires": {
					"questions": [
					  {
						"question": "Pensez-vous que votre équipe a besoin d’une formation produit (recyclage) ?",
						"options": ["Oui", "Non"]
					  },
					  {
						"question": "Pensez-vous que votre équipe a besoin d’une formation scientifique (physiopathologie) ?",
						"options": ["Oui", "Non"]
					  },
					  {
						"question": "Est-ce que les VM utilisent les argumentaires produits ?",
						"options": ["Oui", "Non"]
					  },
					  {
						"question": "Quel est le degré de maitrise des argumentaires produits par l’équipe ?",
						"options": ["Faible", "Satisfaisante", "Excellente"]
					  },
					  {
						"question": "Quel est le degré d’importance de la formation de votre équipe dans votre analyse ?",
						"options": ["moyennement important", "important", "très important"]
					  }
					]
				  }
			  },
			  
			  
			  "reporting": {
					"reporting": {
						"questions": [
						  {
							"question": "Est-ce que toute l’équipe prépare un rapport de visite hebdomadaire (synthèse hebdomadaire de la semaine) ?",
							"options": ["Oui", "Non"]
						  },
						  {
							"question": "Comment l’équipe partage les rapports hebdomadaires ?",
							"options": ["CRM", "Autre support"]
						  },
						  {
							"question": "Est-ce que vous consultez les rapports de visites ?",
							"options": ["Oui", "Non"]
						  },
						  {
							"question": "Est-ce que vous analysez les rapports ?",
							"options": ["Oui", "Non"]
						  },
						  {
							"question": "Est-ce qu’en tant que responsable régionale vous préparez une synthèse mensuelle à partir des rapports de l’équipe ?",
							"options": ["Oui", "Non"]
						  },
						  {
							"question": "Si oui, sur quel support ?",
							"options": ["CRM", "Autres"]
						  },
						  {
							"question": "Quels sont les objectifs de la réunion hebdomadaire ?",
							"options": ["Feed back secteur", "Produits en difficulté","Simulation présentation produit","Suivi R/O","Coaching d’équipe"],
							"type":"multi"
						  },
						  {
							"question": "Selon vous, à quelle fréquence vous préférez tenir la réunion du Lundi ?",
							"options": ["1fois/mois", "2fois/mois", "4fois/mois"]
						  },
						  {
							"question": "Quel est le degré d’importance des reporting dans vos analyses ?",
							"options": ["moyennement important", "important", "très important"]
						  }
						]
					}
			  },
			  
			  
			  "veille_concurrentielle": {
					"veille_concurrentielle": {
					"questions": [
					  {
						"question": "Connaissez-vous vos concurrents ?",
						"options": ["Oui", "Non"]
					  },
					  {
						"question": "Partagez-vous un rapport sur la concurrence ?",
						"options": ["Oui", "Non"]
					  },
					  {
						"question": "Si oui, généralement sur quel support ?",
						"options": ["CRM", "Par mail", "Par Whatsapp", "Appel"]
					  },
					  {
						"question": "Dans quelle classe sentez-vous une agressivité élevée de la concurrence ?",
						"options": ["G.Trivimag", "G.Panax", "Maxi20", "Maxi G", "Antimetil","G.Dornat", "G.Leventerol", "Promenol", "Properiod", "Forcar", "Biosept", "Centelys", "Hepanat", "Kogast", "Florafit"],
						"type":"multi"
					  },
					  {
						"question": "Suggérez-vous des actions pour contrecarrer la concurrence ?",
						"options": ["Oui", "Non"]
					  },
					  {
						"question": "Si oui, comment estimez-vous votre réactivité (délai d’action/réaction) par rapport à la concurrence ?",
						"options": ["Immédiate", "Délai de traitement moyen", "Réaction tardive", "Aucune réaction"]
					  },
					  {
						"question": "Par quel moyen/levier ?",
						"options": ["Action directe", "Pack", "EMG", "Fréquence de visite"],
						"type":"multi"
					  },
					  {
						"question": "Quel est le degré d’importance de connaitre ses concurrents dans vos analyses ?",
						"options": ["moyennement important", "important", "très important"]
					  }
					]
				  }
			  }
			}';
	return json_decode($json, true);
	}
	

}
