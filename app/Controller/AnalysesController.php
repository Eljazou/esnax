<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'Absences');

class AnalysesController extends AppController
{
	public function moyenne_visites()
	{
		// =============================================================================
		// CONFIGURATION SÉCURITÉ ET RESSOURCES
		// =============================================================================
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		// =============================================================================
		// CHARGEMENT DES MODÈLES
		// =============================================================================
		$models = array('Client', 'Secteur', 'Game', 'Visite', 'Category', 'User', 'Apartient');
		foreach ($models as $model) {
			$this->loadModel($model);
			$this->{$model}->recursive = -1;
		}

		// =============================================================================
		// VARIABLES PAR DÉFAUT
		// =============================================================================
		$dateaafficherdansleview = "";
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$conditions_visite = array('Visite.archive' => 1);
		$conditions_client = array('Client.archive' => 1);
		$users_id = array();
		$types = array();

		// =============================================================================
		// TRAITEMENT DES DONNÉES POST
		// =============================================================================
		if ($this->request->is('post')) {
			$data = $this->request->data;
			// -------------------------------------------------------------------------
			// TRAITEMENT DES DATES (crée une condition BETWEEN pour Visite.date)
			// -------------------------------------------------------------------------
			if (!empty($data["date"])) {
				$dateaafficherdansleview = h($data["date"]);
				$dates = explode(" -- ", $data["date"]);
				if (count($dates) === 2) {
					$date_debut = date('Y-m-d', strtotime($dates[0]));
					$date_fin = date('Y-m-d', strtotime($dates[1]));
					$conditions_visite["DATE(Visite.date) BETWEEN '" . $date_debut . "' AND '" . $date_fin . "'"] = "";
				}
			}

			// -------------------------------------------------------------------------
			// FILTRES CLIENTS
			// -------------------------------------------------------------------------
			if (!empty($data["activite"])) {
				$conditions_client['Client.activite'] = h($data["activite"]);
			}

			if (!empty($data["type"]) && is_array($data["type"])) {
				// Liste des types qui servira pour calculer l'objectif
				$types = array_map('intval', $data["type"]);
				$conditions_client['Client.type_id'] = $types;
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR SECTEURS/RÉGIONS (on traduit liste d'IDs -> régions -> secteurs)
			// -------------------------------------------------------------------------
			if (!empty($data["secteur_id"]) && is_array($data["secteur_id"])) {
				$secteur_ids = array_map('intval', $data["secteur_id"]);
				$regions = $this->Secteur->find('list', array(
					'fields' => array('Secteur.region', 'Secteur.region'),
					'conditions' => array('Secteur.id' => $secteur_ids)
				));
				$secteurs = $this->Secteur->find('list', array(
					'fields' => array('Secteur.id', 'Secteur.id'),
					'conditions' => array('Secteur.region' => array_keys($regions))
				));
				$conditions_client['Client.secteur_id'] = array_keys($secteurs);
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR CATÉGORIES
			// -------------------------------------------------------------------------
			if (!empty($data["category"]) && is_array($data["category"])) {
				$selected_categories = array_map('intval', $data["category"]);
				$conditions_client['Client.category_id'] = $selected_categories;
			}

			// =============================================================================
			// RÉCUPÉRATION DES UTILISATEURS SELON RÔLE/CRITÈRES
			// =============================================================================
			if (!empty($data["ligne"]) && is_array($data["ligne"])) {
				$ligne_ids = array_map('intval', $data["ligne"]);
				$users_id = $this->User->find('list', array(
					'conditions' => array('User.ligne_id' => $ligne_ids, 'User.archive !=' => -1)
				));
			} elseif (!empty($data["users"]) && is_array($data["users"])) {
				$user_ids = array_map('intval', $data["users"]);
				$users_id = $this->User->find('list', array(
					'conditions' => array('User.id' => $user_ids, 'User.archive !=' => -1)
				));
			} elseif (AuthComponent::user('role') == 'Super viseur') {
				// Superviseur : récupère ses VMP + lui-même
				$apartients = $this->Apartient->find('all', array(
					'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
				));
				foreach ($apartients as $u) {
					if ($u['User1']['archive'] != -1) {
						$users_id[$u["User1"]["id"]] = $u["User1"]["name"];
					}
				}
				$current_user = $this->User->findById(AuthComponent::user('id'));
				$users_id[$current_user["User"]["id"]] = $current_user["User"]["name"];
			} else {
				// Tous les utilisateurs autorisés
				$users_id = $this->User->find("list", array(
					'conditions' => array(
						'User.archive' => 1,
						'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
					)
				));
			}

			// =============================================================================
			// RÉCUPÉRATION DES ABSENCES POUR LA PÉRIODE GLOBALE CHOISIE
			// (on s'en sert pour objectifs & jours travaillés)
			// =============================================================================
			$absences = array();
			$absencesController = new AbsencesController;
			foreach ($users_id as $user_id => $user_name) {
				// Retour attendu: ["jours_travailles"], ["Total_objectif"], ["Type"][type_id]...
				$absences[$user_id] = $absencesController->system_get_jour_absence_joursferie($user_id, $date_debut, $date_fin);
				
				//hadi a supprimer katzid nhar f l'absence 
				//$absences[$user_id] = $absencesController->system_get_jour_absence($user_id, $date_debut, $date_fin);
			}
			//debug($absences);

			// =============================================================================
			// RÉCUPÉRATION DES VISITES
			// =============================================================================
			$user_ids_array = array_keys($users_id);
			$conditions_visite['Visite.user_id'] = $user_ids_array;
			$all_conditions = array_merge($conditions_visite, $conditions_client);

			$visites = $this->Visite->find('all', array(
				'fields' => array(
					'Visite.date',
					'Visite.user_id',
					'User.ligne_id',
					'Client.id',
					'Client.nom',
					'Secteur.region',
					'Category.name'
				),
				'conditions' => $all_conditions,
				'joins' => array(
					array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id = Visite.client_id')),
					array('table' => 'secteurs', 'alias' => 'Secteur', 'type' => 'LEFT', 'conditions' => array('Secteur.id = Client.secteur_id')),
					array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id = Client.category_id')),
					array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Visite.user_id'))
				)
			));

			// =============================================================================
			// MAPPING DES SUPERVISEURS (user_id VMP -> user_id Superviseur)
			// =============================================================================
			$superviseur_conditions = array();
			if (AuthComponent::user('role') == 'Super viseur') {
				$superviseur_conditions['Apartient.user_id'] = AuthComponent::user('id');
			}
			$superviseurs = $this->Apartient->find('list', array(
				'fields' => array('Apartient.user1_id', 'Apartient.user_id'),
				'conditions' => $superviseur_conditions
			));

			// =============================================================================
			// INITIALISATION DES STRUCTURES DE DONNÉES
			// =============================================================================
			$data_moyenne = array(
				'par_vm' => array(),
				'par_region' => array(),
				'par_ligne' => array(),
				'par_super' => array(),
				'par_mois' => array()
			);

			// =============================================================================
			// 1) COMPTAGE DES VISITES POUR LES 4 REGROUPEMENTS "CLASSIQUES"
			// =============================================================================
			foreach ($visites as $v) {
				$user_id = $v['Visite']['user_id'];

				$region = !empty($v['Secteur']['region']) ? $v['Secteur']['region'] : 'Non définie';
				$ligne_id = !empty($v['User']['ligne_id']) ? $v['User']['ligne_id'] : 0;
				$super_id = isset($superviseurs[$user_id]) ? $superviseurs[$user_id] : $user_id;

				$groupements = array(
					'par_vm' => $user_id,
					'par_region' => $region,
					'par_ligne' => $ligne_id,
					'par_super' => $super_id
				);

				foreach ($groupements as $type_group => $cle_group) {
					if (!isset($data_moyenne[$type_group][$cle_group][$user_id])) {
						$data_moyenne[$type_group][$cle_group][$user_id] = array('total' => 0);
					}
					$data_moyenne[$type_group][$cle_group][$user_id]['total']++;
				}
			}

			// =============================================================================
			// 2) CALCUL COMPLET (objectif, absences, moyennes) POUR LES 4 REGROUPEMENTS
			//    Remarque: on utilise l'objectif et jours_travailles de la période globale
			// =============================================================================
			$types_classiques = array('par_vm', 'par_region', 'par_ligne', 'par_super');

			foreach ($types_classiques as $type_groupement) {

				foreach ($data_moyenne[$type_groupement] as $cle_groupe => &$users_du_groupe) {

					$total_visites_groupe = 0;
					$total_objectif_groupe = 0;
					$total_jours_travailles_groupe = 0;

					foreach ($users_du_groupe as $user_id => &$donnees_user) {
						if (!is_numeric($user_id)) {
							// ignore les clés spéciales (ex: _moyenne_groupe)
							continue;
						}
						if (!isset($absences[$user_id])) {
							// pas d'absences -> impossible de calculer objectifs / jours
							continue;
						}

						// --------- Objectif (soit total, soit somme par types choisis)
						$objectif = 0;
						if (!empty($types)) {
							foreach ($types as $type_id) {
								if (isset($absences[$user_id]["Type"]) && isset($absences[$user_id]["Type"][$type_id])) {
									$objectif += $absences[$user_id]["Type"][$type_id];
								}
							}
						} else {
							$objectif = isset($absences[$user_id]["Total_objectif"]) ? (float) $absences[$user_id]["Total_objectif"] : 0;
						}
						if ($objectif <= 0)
							$objectif = 1; // anti-division par 0

						// --------- Jours travaillés (de la période globale)
						$jours_travailles = isset($absences[$user_id]["jours_travailles"]) ? (float) $absences[$user_id]["jours_travailles"] : 0;
						if ($jours_travailles == 0)
							$jours_travailles = 1; // anti-division par 0

						// --------- Enrichissement des données utilisateur du groupe
						$donnees_user['absences'] = $absences[$user_id];
						$donnees_user['objectif'] = $objectif;
						$donnees_user['moyenne_visite_objectif'] = round(($donnees_user['total'] / $objectif) * 100, 2);
						$donnees_user['moyenne_visite_par_jour'] = (float) round($donnees_user['total'] / $jours_travailles, 2);

						// --------- Accumulation pour la moyenne de ce groupe
						$total_visites_groupe += $donnees_user['total'];
						$total_objectif_groupe += $objectif;
						$total_jours_travailles_groupe += $jours_travailles;
					}
					unset($donnees_user);

					// --------- Moyenne du groupe
					if ($total_objectif_groupe > 0 && $total_jours_travailles_groupe > 0) {
						$users_du_groupe['_moyenne_groupe'] = array(
							'moyenne_visite_objectif' => round(($total_visites_groupe / $total_objectif_groupe) * 100, 2),
							'moyenne_visite_par_jour' => (float) round($total_visites_groupe / $total_jours_travailles_groupe, 2)
						);
					}
				}
				unset($users_du_groupe);

				// --------- Moyenne GLOBALE pour ce type (somme sur tous les groupes)
				$total_visites_global = 0;
				$total_objectif_global = 0;
				$total_jours_global = 0;

				foreach ($data_moyenne[$type_groupement] as $cle_groupe => $users_du_groupe) {
					foreach ($users_du_groupe as $user_id => $donnees_user) {
						if (!is_array($donnees_user) || !isset($donnees_user['total']) || !is_numeric($user_id)) {
							continue;
						}
						$total_visites_global += $donnees_user['total'];
						if (isset($donnees_user['objectif'])) {
							$total_objectif_global += $donnees_user['objectif'];
						}
						if (isset($absences[$user_id]["jours_travailles"])) {
							$total_jours_global += (float) $absences[$user_id]["jours_travailles"];
						}
					}
				}

				if ($total_objectif_global > 0 && $total_jours_global > 0) {
					$data_moyenne[$type_groupement]['_moyenne_globale'] = array(
						'moyenne_visite_objectif' => round(($total_visites_global / $total_objectif_global) * 100, 2),
						'moyenne_visite_par_jour' => (float) round($total_visites_global / $total_jours_global, 2)
					);
				}
			}
			//debug($data_moyenne); //exit();

			// =============================================================================
			// 3) TRAITEMENT ISOLÉ POUR PAR_MOIS
			//    - on groupe les visites par mois "m-Y"
			//    - pour CHAQUE mois, on proportionne objectif & jours aux jours du mois
			//      qui intersectent la période sélectionnée
			// =============================================================================
			$visites_par_mois = array();
			foreach ($visites as $v) {
				$mois_key = date('m-Y', strtotime($v['Visite']['date']));
				if (!isset($visites_par_mois[$mois_key])) {
					$visites_par_mois[$mois_key] = array();
				}
				$visites_par_mois[$mois_key][] = $v;
			}

			$ts_debut_periode = strtotime($date_debut);
			$ts_fin_periode = strtotime($date_fin);

			foreach ($visites_par_mois as $mois => $visites_du_mois) {
				if (!isset($data_moyenne['par_mois'][$mois])) {
					$data_moyenne['par_mois'][$mois] = array();
				}

				// Bornes naturelles du mois (ex: 01-05-2025 à 31-05-2025)
				list($mois_num, $annee) = explode('-', $mois);
				$premier_jour_mois = date('Y-m-01', strtotime($annee . '-' . $mois_num . '-01'));
				$dernier_jour_mois = date('Y-m-t', strtotime($premier_jour_mois));

				// Intersection avec la période globale choisie
				$ts_debut_mois_inter = max($ts_debut_periode, strtotime($premier_jour_mois));
				$ts_fin_mois_inter = min($ts_fin_periode, strtotime($dernier_jour_mois));
				if ($ts_fin_mois_inter < $ts_debut_mois_inter) {
					// Mois entièrement hors période -> on ignore
					continue;
				}

				// --------- Comptage des visites par utilisateur pour ce mois
				foreach ($visites_du_mois as $visite) {
					$uid = $visite['Visite']['user_id'];
					if (!isset($data_moyenne['par_mois'][$mois][$uid])) {
						$data_moyenne['par_mois'][$mois][$uid] = array('total' => 0);
					}
					$data_moyenne['par_mois'][$mois][$uid]['total']++;
				}

				// --------- Calcul par utilisateur (objectif/jours proportionnés au mois)
				$total_visites_groupe = 0;
				$total_objectif_groupe = 0;
				$total_jours_travailles_groupe = 0;

				// Jours dans l'intersection "ce mois ∩ période"
				$jours_dans_mois = (int) floor(($ts_fin_mois_inter - $ts_debut_mois_inter) / (24 * 60 * 60)) + 1;
				// Jours totaux de la période
				$jours_totaux_periode = (int) floor(($ts_fin_periode - $ts_debut_periode) / (24 * 60 * 60)) + 1;
				if ($jours_totaux_periode <= 0)
					$jours_totaux_periode = 1; // sécurité
				$ratio = $jours_dans_mois / $jours_totaux_periode;

				foreach ($data_moyenne['par_mois'][$mois] as $uid => &$du) {
					if (!is_numeric($uid))
						continue;
					if (!isset($absences[$uid]))
						continue;

					// ---- objectif de base (période globale), puis proportionné au mois
					$objectif_base = 0;
					if (!empty($types)) {
						foreach ($types as $type_id) {
							if (isset($absences[$uid]["Type"]) && isset($absences[$uid]["Type"][$type_id])) {
								$objectif_base += (int) $absences[$uid]["Type"][$type_id];
							}
						}
					} else {
						$objectif_base = isset($absences[$uid]["Total_objectif"]) ? (float) $absences[$uid]["Total_objectif"] : 0;
					}
					$objectif_calc = (float) round($objectif_base * $ratio);
					if ($objectif_calc <= 0)
						$objectif_calc = 1;

					// ---- jours travaillés proportionnés au mois
					$jours_trav_base = isset($absences[$uid]["jours_travailles"]) ? (float) $absences[$uid]["jours_travailles"] : 0;
					$jours_trav_calc = (float) round($jours_trav_base * $ratio);
					if ($jours_trav_calc == 0)
						$jours_trav_calc = 1;

					// ---- enrichissement
					$du['absences'] = $absences[$uid];
					$du['objectif'] = $objectif_calc;
					$du['jours_travailles_calc'] = $jours_trav_calc; // utile pour _moyenne_globale par_mois
					//hadi a voir dans  les mois wach kaina oula la hadi ajoutiha rassi ma3raftch wach salha ou pas 19/09/2025
					//$objectif_calc = $absences[$uid]['Total_objectif'];
					//$jours_trav_calc = $absences[$uid]['jours_travailles'];
					// fin rwina dialiiiii
					$du['objectif'] = $objectif_calc;
					$du['jours_travailles_calc'] = $jours_trav_calc;

					$du['moyenne_visite_objectif'] = round(($du['total'] / $objectif_calc) * 100, 2);
					$du['moyenne_visite_par_jour'] = (float) round($du['total'] / $jours_trav_calc, 2);

					// ---- accumulation groupe (ce mois)
					$total_visites_groupe += $du['total'];
					$total_objectif_groupe += $objectif_calc;
					$total_jours_travailles_groupe += $jours_trav_calc;
				}
				unset($du);

				// ---- moyenne du groupe (le mois)
				if ($total_objectif_groupe > 0 && $total_jours_travailles_groupe > 0) {
					$data_moyenne['par_mois'][$mois]['_moyenne_groupe'] = array(
						'moyenne_visite_objectif' => round(($total_visites_groupe / $total_objectif_groupe) * 100, 2),
						'moyenne_visite_par_jour' => (float) round($total_visites_groupe / $total_jours_travailles_groupe, 2)
					);
				}
			}

			// --------- Moyenne GLOBALE pour "par_mois" (somme sur tous les mois)
			$total_visites_global = 0;
			$total_objectif_global = 0;
			$total_jours_global = 0;

			foreach ($data_moyenne['par_mois'] as $mois => $users_du_mois) {
				foreach ($users_du_mois as $uid => $du) {
					if (!is_array($du) || !isset($du['total']) || !is_numeric($uid)) {
						continue;
					}
					$total_visites_global += $du['total'];
					if (isset($du['objectif'])) {
						$total_objectif_global += (float) $du['objectif'];
					}
					// Ici on additionne les "jours travaillés proportionnés" du mois
					if (isset($du['jours_travailles_calc'])) {
						$total_jours_global += (float) $du['jours_travailles_calc'];
					} elseif (isset($du['absences']) && isset($du['absences']['jours_travailles'])) {
						// fallback (ne devrait pas arriver)
						$total_jours_global += $du['absences']['jours_travailles'];
					}
				}
			}

			if ($total_objectif_global > 0 && $total_jours_global > 0) {
				$data_moyenne['par_mois']['_moyenne_globale'] = array(
					'moyenne_visite_objectif' => round(($total_visites_global / $total_objectif_global) * 100, 2),
					'moyenne_visite_par_jour' => (float) round($total_visites_global / $total_jours_global, 2),
				);
			}
			//debug($data_moyenne);//exit();
			// =============================================================================
			// ENVOI DES DONNÉES À LA VUE
			// =============================================================================
			$this->set('data_moyenne', $data_moyenne);
		}

		// =============================================================================
		// PRÉPARATION DES LISTES POUR LES FORMULAIRES (toujours exécuté)
		// =============================================================================
		$allusers = array();
		if (AuthComponent::user('role') == 'Super viseur') {
			$this->Apartient->recursive = 1;
			$user = $this->Apartient->find('all', array(
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
			foreach ($user as $u) {
				if ($u['User1']['archive'] != -1) {
					$allusers[$u["User1"]["id"]] = $u["User1"]["name"];
				}
			}
			$allusers[AuthComponent::user('id')] = AuthComponent::user('name');
		} else {
			$allusers = $this->User->find("list", array(
				'conditions' => array(
					'User.archive' => 1,
					'User.role' => array('Coordinateur', 'Super viseur', 'VMP')
				)
			));
		}

		// convertir les keys de users_id en integer pour la comparaison dans le view
		$users_id = array_map('intval', array_keys($users_id));
		$activite = isset($data["activite"]) ? $data["activite"] : "";
		$selected_secteur = isset($data["secteur_id"]) ? $data["secteur_id"] : array();


		$this->set(array(
			'tout_user_pour_affchage_dans_le_view' => $allusers,
			'allusers' => $allusers,
			'secteurs' => $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), 'group' => array('Secteur.region'))),
			'categories' => $this->Category->find('list'),
			'lignes' => $this->User->Ligne->find('list'),
			'games' => $this->Game->find("list"),
			'allsecteurs' => $this->Secteur->find("list"),
			'types' => $this->Client->Type->find("list"),
			'dateaafficherdansleview' => $dateaafficherdansleview,
			'selected_users' => $users_id,
			'activite_selected' => $activite,
			'selected_secteur' => array_values($selected_secteur)
		));
	}



	public function visite_dsm()
	{
		// --- Config
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		$this->loadModel('Client');
		$this->loadModel('Visite');
		$this->Visite->recursive = -1;
		$this->loadModel('Apartient');
		$this->loadModel('User');

		// --- Dates
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$conditions = array();
		$dateaafficherdansleview = "$date_debut -- $date_fin";
		if ($this->request->is('post') && !empty($this->request->data["date"])) {
			$dateaafficherdansleview = $this->request->data["date"];
			$dates = explode(" -- ", $this->request->data["date"]);
			if (count($dates) == 2) {
				$date_debut = date('Y-m-d', strtotime($dates[0]));
				$date_fin = date('Y-m-d', strtotime($dates[1]));
			}
			$ids = [];
			foreach ($this->request->data['super'] as $k => $v) {
				$ids[] = $v;
			}
			$conditions = array('Apartient.user_id' => $ids);
		}



		if (AuthComponent::user('role') == 'Super viseur') {
			$users = $this->Apartient->find('all', array(
				'fields' => array('Apartient.user_id', 'Apartient.user1_id'),
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
		} else {
			$users = $this->Apartient->find('all', array(
				'fields' => array('Apartient.user_id', 'Apartient.user1_id'),
				'conditions' => $conditions
			));
		}

		$supers = array();

		foreach ($users as $user) {
			$super_id = $user['Apartient']['user_id'];
			$user_id = $user['Apartient']['user1_id'];
			$supers[$super_id][0] = $super_id; // le superviseur lui-même
			$supers[$super_id][] = $user_id;
			//echo "Superviseur $super_id a le VMP $user_id<br>";
		}

		// --- Récupération visites
		$visites = $this->Visite->find('all', array(
			'fields' => array(
				'Visite.created',
				'Visite.date',
				'Visite.user_id',
				'Visite.type_visite',
				'Client.id',
				'Client.nom',
				'Client.prenom',
				'Client.potentialite',
				'Category.name'
			),
			'conditions' => array(
				'Visite.archive' => 1,
				"DATE(Visite.date) BETWEEN '$date_debut' AND '$date_fin'"
			),
			'joins' => array(
				array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id=Visite.client_id')),
				array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id=Client.category_id'))
			)
		));
		//debug($visites);exit();

		// --- Comptage par superviseur
		$data = array();
		foreach ($supers as $super_id => $users) {
			$data[$super_id] = array("solo" => 0, "double" => 0, "total" => 0, "nb_client" => 0, "clients" => array());

			foreach ($visites as $v) {
				if (in_array($v['Visite']['user_id'], $users)) {
					$dialo = 0;
					if ($v['Visite']['type_visite'] == "double") {
						$data[$super_id]["double"]++;
						$data[$super_id]["total"]++;
						$dialo = 1;
					} elseif ($v['Visite']['user_id'] == $super_id) {
						$data[$super_id]["solo"]++;
						$data[$super_id]["total"]++;
						$dialo = 1;
					}
					if ($dialo == 1) {
						if (!isset($data[$super_id]["clients"][$v['Client']['id']]))
							$data[$super_id]["nb_client"]++;
						$data[$super_id]["clients"][$v['Client']['id']] = $v;
					}
				}
			}
		}
		$temp = array();
		$users = $this->User->find('list');
		foreach ($data as $super_id => $d) {
			//if ($d["nb_client"] > 0)
			$temp[$users[$super_id]] = $d;
		}
		$data = $temp;
		if (AuthComponent::user('role') == 'Super viseur')
			$supers = $this->User->find('list', array('conditions' => array("User.id" => $this->Auth->user("id"))));
		else
			$supers = $this->User->find('list', array('conditions' => array('User.role' => "Super viseur", 'User.archive' => 1)));

		$this->set(array(
			'data' => $data,
			'dateaafficherdansleview' => $dateaafficherdansleview,
			"users" => $users,
			"supers" => $supers
		));
	}



	public function portefeuille_vm()
	{
		// -------------------- Config runtime --------------------
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		// -------------------- Models --------------------
		$this->loadModel('Client');
		$this->loadModel('User');
		$this->loadModel('Apartient');   // liens superviseur -> VMP
		$this->loadModel('Affectation'); // liens liste <-> client
		$this->loadModel('Liste');

		$this->Client->recursive = -1;
		$this->User->recursive = -1;
		$this->Apartient->recursive = -1;
		$this->Affectation->recursive = -1;
		$this->Liste->recursive = -1;

		// =============================================================================
		// CONFIGURATION SÉCURITÉ ET RESSOURCES
		// =============================================================================
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		// =============================================================================
		// CHARGEMENT DES MODÈLES
		// =============================================================================
		$models = array('Client', 'Secteur', 'Game', 'Visite', 'Category', 'User', 'Apartient', "Liste");
		foreach ($models as $model) {
			$this->loadModel($model);
			$this->{$model}->recursive = -1;
		}
		$this->Liste->Affectation->recursive = -1;

		// =============================================================================
		// VARIABLES PAR DÉFAUT
		// =============================================================================

		$conditions_client = array('Client.archive' => 1);
		$users_id = array();
		$types = array();
		$selected_categories = array();
		$activite = "";
		$potentialite_selected = array();
		$users_id = array();
		$secteur_ids = array();

		// =============================================================================
		// TRAITEMENT DES DONNÉES POST
		// =============================================================================
		if ($this->request->is('post')) {
			$data = $this->request->data;


			// -------------------------------------------------------------------------
			// FILTRES CLIENTS
			// -------------------------------------------------------------------------

			if (!empty($data["activite"])) {
				$activite = $data["activite"];
				$conditions_client['Client.activite'] = $data["activite"];
			}

			if (!empty($data["type"]) && is_array($data["type"])) {
				// Liste des types qui servira pour calculer l'objectif
				$types = array_map('intval', $data["type"]);
				$conditions_client['Client.type_id'] = $types;
				// debug($types);exit();
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR SECTEURS/RÉGIONS (on traduit liste d'IDs -> régions -> secteurs)
			// -------------------------------------------------------------------------
			if (!empty($data["secteur"]) && is_array($data["secteur"])) {
				$secteur_ids = array_map('intval', $data["secteur"]);
				$regions = $this->Secteur->find('list', array(
					'fields' => array('Secteur.region', 'Secteur.region'),
					'conditions' => array('Secteur.id' => $secteur_ids)
				));
				$secteurs = $this->Secteur->find('list', array(
					'fields' => array('Secteur.id', 'Secteur.id'),
					'conditions' => array('Secteur.region' => array_keys($regions))
				));
				$conditions_client['Client.secteur_id'] = array_keys($secteurs);
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR CATÉGORIES
			// -------------------------------------------------------------------------
			// debug($data);
			if (!empty($data["category"]) && is_array($data["category"])) {
				$selected_categories = array_map('intval', $data["category"]);
				$conditions_client['Client.category_id'] = $selected_categories;
			}

			if (!empty($data["potentialite"]) && is_array($data["potentialite"])) {
				$potentialite_selected = array_values($data["potentialite"]);
				$conditions_client['Client.potentialite'] = $potentialite_selected;
			}
			if (!empty($data["users"]) && is_array($data["users"])) {
				$users_id = array_map('intval', $data["users"]);
			} else {
				if (AuthComponent::user('role') === 'Super viseur') {
					$userssuper = $this->Apartient->find('list', array(
						'fields' => array('Apartient.user_id', 'Apartient.user1_id'), // clé=superviseur, valeur=VMP
						'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
					));
					foreach ($userssuper as $super_id => $user_id) {
						$users_id[] = (int) $user_id;
					}
				} else {
					$users_id = $this->User->find('list', array(
						'fields' => array('User.id', 'User.id'),
						'conditions' => array(
							'User.archive' => 1,
							'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
						)
					));
					$users_id = array_map('intval', array_values($users_id));
				}
			}
		}


		// -------------------- Agrégation 1 : spécialités par user --------------------
		// On compte les clients affectés (valides + entités actives) par (user, spécialité).
		// NOTE perfs : prévoir des index (voir notes en bas)
		$specialitesRows = $this->Affectation->find('all', array(
			'fields' => array(
				'Liste.user_id',
				'Category.id',
				'Category.name',
				'COUNT(DISTINCT Client.id) AS nb'
			),
			'joins' => array(
				array(
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => array('Liste.id = Affectation.liste_id')
				),
				array(
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => array('Client.id = Affectation.client_id', $conditions_client) //medcin
				),
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => array('Category.id = Client.category_id')
				),
				array(
					'table' => 'categories',
					'alias' => 'Category1',
					'type' => 'LEFT',
					'conditions' => array('Category1.id = Client.category1_id')
				),
			),
			'conditions' => array(
				'Affectation.valide' => 1,
				'Liste.archive' => 1,
				'Client.archive' => 1,
				'Liste.user_id' => $users_id
			),
			'group' => array('Liste.user_id', 'Category.id', 'Category.name'),
			'order' => array('Liste.user_id' => 'ASC', 'Category.name' => 'ASC'),
			'recursive' => -1
		));

		// -------------------- Totaux par user pour pourcentages --------------------
		$totauxParUser = array(); // user_id => total clients
		foreach ($specialitesRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			$nb = (int) $r[0]['nb']; // agrégat aliasé
			if (!isset($totauxParUser[$uid]))
				$totauxParUser[$uid] = 0;
			$totauxParUser[$uid] += $nb;
		}

		// -------------------- Construction data spécialités par user --------------------
		$data = array(); // structure finale
		foreach ($users_id as $uid) {
			$data[$uid] = array(
				'total_clients' => isset($totauxParUser[$uid]) ? (int) $totauxParUser[$uid] : 0,
				'specialites' => array(),        // pour graphique circulaire
				'tendance_if_generaliste' => array() // rempli plus bas
			);
		}

		foreach ($specialitesRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			$label = isset($r['Category']['name']) && $r['Category']['name'] !== null ? $r['Category']['name'] : 'Non renseigné';
			$nb = (int) $r[0]['nb'];
			$total = max(1, (int) $data[$uid]['total_clients']); // évite division par zéro
			$data[$uid]['specialites'][] = array(
				'label' => $label,
				'count' => $nb,
				'percent' => round(($nb * 100.0) / $total, 2)
			);
		}

		// -------------------- Agrégation 2 : tendances uniquement sur les "généralistes" --------------------
		// On filtre côté SQL sur Category.name IN ($generalisteLabels) (case-insensitive).
		// On groupe par (user, tendance).
		// NB : on reste tolérant aux NULL -> "Non renseigné".
		$tendanceRows = $this->Affectation->find('all', array(
			'fields' => array(
				'Liste.user_id',
				'Category1.id',
				'Category1.name',
				'COUNT(DISTINCT Client.id) AS nb'
			),
			'joins' => array(
				array(
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => array('Liste.id = Affectation.liste_id')
				),
				array(
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => array('Client.id = Affectation.client_id', $conditions_client)
				),
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => array('Category.id = Client.category_id')
				),
				array(
					'table' => 'categories',
					'alias' => 'Category1',
					'type' => 'LEFT',
					'conditions' => array('Category1.id = Client.category1_id')
				),
			),
			'conditions' => array(
				'Affectation.valide' => 1,
				'Liste.archive' => 1,
				'Client.archive' => 1,
				'Liste.user_id' => $users_id,
				'LOWER(Category.id)' => 7, //7 id dial generaliste
			),
			'group' => array('Liste.user_id', 'Category1.id', 'Category1.name'),
			'order' => array('Liste.user_id' => 'ASC', 'Category1.name' => 'ASC'),
			'recursive' => -1
		));

		// Totaux "généraliste" par user (pour pourcentages de tendance)
		$totalGeneralistesParUser = array();
		foreach ($tendanceRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			$nb = (int) $r[0]['nb'];
			if (!isset($totalGeneralistesParUser[$uid]))
				$totalGeneralistesParUser[$uid] = 0;
			$totalGeneralistesParUser[$uid] += $nb;
		}

		foreach ($tendanceRows as $r) {
			$uid = (int) $r['Liste']['user_id'];
			if (isset($r['Category1']['name']) && $r['Category1']['name'] !== null)
				$label = $r['Category1']['name'];
			else
				$label = 'Generaliste';
			$nb = (int) $r[0]['nb'];
			$totalGen = max(1, isset($totalGeneralistesParUser[$uid]) ? (int) $totalGeneralistesParUser[$uid] : 1);
			$data[$uid]['tendance_if_generaliste'][] = array(
				'label' => $label,
				'count' => $nb,
				'percent' => round(($nb * 100.0) / $totalGen, 2)
			);
		}
		//debug($data);exit();

		// -------------------- Agrégation 3 (GLOBAL) : même structure qu’un user (sans doublons) --------------------
		// -> $global['total_clients'], $global['specialites'], $global['tendance_if_generaliste']

		// 3.a) Spécialités globales (tous users_id confondus, clients uniques)
		$globalRows = $this->Affectation->find('all', array(
			'fields' => array(
				'Category.id',
				'Category.name',
				'COUNT(DISTINCT Client.id) AS nb'
			),
			'joins' => array(
				array(
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => array('Liste.id = Affectation.liste_id')
				),
				array(
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => array('Client.id = Affectation.client_id', $conditions_client)
				),
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => array('Category.id = Client.category_id')
				),
			),
			'conditions' => array(
				'Affectation.valide' => 1,
				'Liste.archive' => 1,
				'Client.archive' => 1,
				'Liste.user_id' => $users_id
			),
			'group' => array('Category.id', 'Category.name'),
			'order' => array('Category.name' => 'ASC'),
			'recursive' => -1
		));

		// Total global (tous clients uniques)
		$totalGlobal = 0;
		foreach ($globalRows as $r) {
			$totalGlobal += (int) $r[0]['nb'];
		}

		// 3.b) Tendance uniquement sur les "généralistes" (category_id = 7) — global, sans doublons
		$globalTendanceRows = $this->Affectation->find('all', array(
			'fields' => array(
				'Category1.id',
				'Category1.name',
				'COUNT(DISTINCT Client.id) AS nb'
			),
			'joins' => array(
				array(
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => array('Liste.id = Affectation.liste_id')
				),
				array(
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => array('Client.id = Affectation.client_id', $conditions_client)
				),
				array(
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => array('Category.id = Client.category_id')
				),
				array(
					'table' => 'categories',
					'alias' => 'Category1',
					'type' => 'LEFT',
					'conditions' => array('Category1.id = Client.category1_id')
				),
			),
			'conditions' => array(
				'Affectation.valide' => 1,
				'Liste.archive' => 1,
				'Client.archive' => 1,
				'Liste.user_id' => $users_id,
				'Category.id' => 7 // 7 = Généraliste
			),
			'group' => array('Category1.id', 'Category1.name'),
			'order' => array('Category1.name' => 'ASC'),
			'recursive' => -1
		));

		// Total global des généralistes (clients uniques) pour les pourcentages de tendance
		$totalGlobalGeneralistes = 0;
		foreach ($globalTendanceRows as $r) {
			$totalGlobalGeneralistes += (int) $r[0]['nb'];
		}

		// 3.c) Construction de la structure finale $global (comme un user)
		$global = array(
			'total_clients' => (int) $totalGlobal,
			'specialites' => array(),
			'tendance_if_generaliste' => array()
		);

		// Spécialités
		foreach ($globalRows as $r) {
			$label = !empty($r['Category']['name']) ? $r['Category']['name'] : 'Non renseigné';
			$nb = (int) $r[0]['nb'];
			$global['specialites'][] = array(
				'label' => $label,
				'count' => $nb,
				'percent' => round(($nb * 100.0) / max(1, $totalGlobal), 2)
			);
		}

		// Tendance si généraliste
		foreach ($globalTendanceRows as $r) {
			$label = isset($r['Category1']['name']) && $r['Category1']['name'] !== null ? $r['Category1']['name'] : 'Generaliste';
			$nb = (int) $r[0]['nb'];
			$global['tendance_if_generaliste'][] = array(
				'label' => $label,
				'count' => $nb,
				'percent' => round(($nb * 100.0) / max(1, $totalGlobalGeneralistes), 2)
			);
		}


		$users = [];
		if (AuthComponent::user('role') === 'Super viseur') {
			$users_supers = [];
			$users_supers[] = AuthComponent::user('id');
			$userssuper = $this->Apartient->find('list', array(
				'fields' => array('Apartient.user1_id', 'Apartient.user_id'), // clé=superviseur, valeur=VMP
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));

			foreach ($userssuper as  $user_id => $super_id) {
				$users_supers[] = (int) $user_id;
			}
			$users = $this->User->find('list', array(
				'fields' => array('User.id', 'User.name'),
				'conditions' => array(
					'User.archive' => 1,
					'User.id' => $users_supers,
					'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
				)
			));
		} else {
			$users = $this->User->find('list', array(
				'fields' => array('User.id', 'User.name'),
				'conditions' => array(
					'User.archive' => 1,
					'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
				)
			));
		}



		//debug($data_view);
		$this->set(array(
			'tout_user_pour_affchage_dans_le_view' => $this->User->find("list"),
			'secteurs' => $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), 'group' => array('Secteur.region'))),
			'categories' => $this->Category->find('list'),
			'users' => $users,
			'lignes' => $this->User->Ligne->find('list'),
			'games' => $this->Game->find("list"),
			'allsecteurs' => $this->Secteur->find("list"),
			'types' => $this->Client->Type->find("list"),
			'selected_users' => $users_id,
			'selected_types' => $types,
			'selected_categories' => $selected_categories,
			'data' => $data,
			'global' => $global,
			'activite' => $activite,
			'potentialite_selected' => $potentialite_selected,
			'selected_secteur' => $secteur_ids,
		));
	}


	public function doublons_vm()
	{
		$this->loadModel('User');
		$this->loadModel('Client');
		$this->loadModel('Liste');
		$this->loadModel('Affectation');

		// Désactiver récursivité pour accélérer
		$this->User->recursive = -1;
		$this->Client->recursive = -1;
		$this->Liste->recursive = -1;
		$this->Affectation->recursive = -1;

		// Configuration superviseur
		$users_id = [];
		if (AuthComponent::user('role') == 'Super viseur') {
			$this->loadModel('Apartient');
			//$this->Apartient->recursive = -1;
			// Superviseur : récupère ses VMP + lui-même
			$users_id[AuthComponent::user('id')] = AuthComponent::user('id');
			$apartients = $this->Apartient->find('all', array(
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
			foreach ($apartients as $u) {
				if ($u['User1']['archive'] != -1) {
					$users_id[$u["User1"]["id"]] = $u["User1"]["id"];
				}
			}
		} else {
			// Tous les utilisateurs autorisés
			$users_id = $this->User->find("list", array(
				"fields" => array('User.id', 'User.id'),
				'conditions' => array(
					'User.archive' => 1,
					'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
				)
			));
		}

		// Requête SQL optimisée : récupérer les clients affectés à plusieurs listes
		$results = $this->Affectation->find('all', [
			'fields' => [
				'User.id',
				'User.name AS vm_name',
				'Client.id',
				'Client.nom AS client_name',
				'Client.prenom AS client_prenom',
				'Category.name AS specialite',
				'Secteur.region AS region',
				'Secteur.ville AS ville',
				'Secteur.secteur AS secteur',
				'GROUP_CONCAT(DISTINCT Liste.name ORDER BY Liste.name SEPARATOR ", ") AS listes',
				'COUNT(DISTINCT Liste.id) AS nb_listes'
			],
			'joins' => [
				[
					'table' => 'listes',
					'alias' => 'Liste',
					'type' => 'INNER',
					'conditions' => ['Liste.id = Affectation.liste_id']
				],
				[
					'table' => 'users',
					'alias' => 'User',
					'type' => 'INNER',
					'conditions' => ['User.id = Liste.user_id']
				],
				[
					'table' => 'clients',
					'alias' => 'Client',
					'type' => 'INNER',
					'conditions' => ['Client.id = Affectation.client_id']
				],
				[
					'table' => 'categories',
					'alias' => 'Category',
					'type' => 'LEFT',
					'conditions' => ['Category.id = Client.category_id']
				],
				[
					'table' => 'secteurs',
					'alias' => 'Secteur',
					'type' => 'LEFT',
					'conditions' => ['Secteur.id = Client.secteur_id']
				],
			],
			'conditions' => [
				'Affectation.valide' => 1,
				'Client.archive' => 1,
				'Liste.archive' => 1,
				'User.id' => $users_id,
			],
			'group' => ['Client.id', 'User.id'],
			'having' => ['COUNT(DISTINCT Liste.id) > 1'], // ✅ en string pur
			'order' => ['User.id ASC', 'Client.nom ASC']
			//'limit' => 1000 // Limite pour éviter surcharge, ajustez selon vos besoins
		]);

		// Formater les données pour la vue
		$data = [];
		foreach ($results as $r) {
			if ($r[0]['nb_listes'] <= 1)
				continue;
			$data[$r['User']['id']][] = [
				'vm' => $r["User"]['vm_name'],
				'client' => $r["Client"]['client_name'] . " " . $r["Client"]['client_prenom'],
				'client_id' => $r["Client"]['id'],
				'specialite' => $r['Category']['specialite'],
				'localisation' => trim($r['Secteur']['region'] . ', ' . $r['Secteur']['ville'] . ', ' . $r['Secteur']['secteur'], ', '),
				'listes' => $r[0]['listes'],
				'nb_listes' => $r[0]['nb_listes']
			];
		}

		$this->set(compact('data'));
	}



	function calcule_couverture()
	{
		// =============================================================================
		// CONFIGURATION SÉCURITÉ ET RESSOURCES
		// =============================================================================
		ini_set('memory_limit', '-1');
		set_time_limit(300);

		// =============================================================================
		// CHARGEMENT DES MODÈLES
		// =============================================================================
		$models = array('Client', 'Secteur', 'Game', 'Visite', 'Category', 'User', 'Apartient', "Liste");
		foreach ($models as $model) {
			$this->loadModel($model);
			$this->{$model}->recursive = -1;
		}
		$this->Liste->Affectation->recursive = -1;

		// =============================================================================
		// VARIABLES PAR DÉFAUT
		// =============================================================================
		$dateaafficherdansleview = "";
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$conditions_visite = array('Visite.archive' => 1);
		$conditions_client = array('Client.archive' => 1);
		$conditions_client_type_pour_absences = [];
		$users_id = array();
		$types = array();
		$ligne_ids = array();
		$selected_categories = array();
		$potentialite_selected = array();
		$secteur_ids = array();
		$data_view = [];
		$realisations = [];
		$activite = "";

		// =============================================================================
		// TRAITEMENT DES DONNÉES POST
		// =============================================================================
		if ($this->request->is('post')) {
			$data = $this->request->data;
			// -------------------------------------------------------------------------
			// TRAITEMENT DES DATES (crée une condition BETWEEN pour Visite.date)
			// -------------------------------------------------------------------------
			if (!empty($data["date"])) {
				$dateaafficherdansleview = h($data["date"]);
				$dates = explode(" -- ", $data["date"]);
				if (count($dates) === 2) {
					$date_debut = date('Y-m-d', strtotime($dates[0]));
					$date_fin = date('Y-m-d', strtotime($dates[1]));
					//$conditions_visite["DATE(Visite.date) BETWEEN '" . $date_debut . "' AND '" . $date_fin . "'"] = "";
				}
			}

			// -------------------------------------------------------------------------
			// FILTRES CLIENTS
			// -------------------------------------------------------------------------
			if (!empty($data["activite"])) {
				$activite = $data["activite"];
				$conditions_client['Client.activite'] = $data["activite"];
			}

			if (!empty($data["type"]) && is_array($data["type"])) {
				// Liste des types qui servira pour calculer l'objectif
				$types = array_map('intval', $data["type"]);
				$conditions_client['Client.type_id'] = $types;
				$conditions_client_type_pour_absences['Objectif.type_id'] = $types;
				// debug($types);exit();
			}
			// filter pare potentialité
			// debug($data["potentialite"]);exit();
			if (!empty($data["potentialite"]) && is_array($data["potentialite"])) {
				$potentialite_selected = array_values($data["potentialite"]);
				$conditions_client['Client.potentialite'] = $potentialite_selected;
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR SECTEURS/RÉGIONS (on traduit liste d'IDs -> régions -> secteurs)
			// -------------------------------------------------------------------------
			if (!empty($data["secteur"]) && is_array($data["secteur"])) {
				$secteur_ids = array_map('intval', $data["secteur"]);
				$regions = $this->Secteur->find('list', array(
					'fields' => array('Secteur.region', 'Secteur.region'),
					'conditions' => array('Secteur.id' => $secteur_ids)
				));
				$secteurs = $this->Secteur->find('list', array(
					'fields' => array('Secteur.id', 'Secteur.id'),
					'conditions' => array('Secteur.region' => array_keys($regions))
				));
				$conditions_client['Client.secteur_id'] = array_keys($secteurs);
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR CATÉGORIES
			// -------------------------------------------------------------------------
			// debug($secteur_ids);exit();
			if (!empty($data["category"]) && is_array($data["category"])) {
				$selected_categories = array_map('intval', $data["category"]);
				$conditions_client['Client.category_id'] = $selected_categories;
			}

			// =============================================================================
			// RÉCUPÉRATION DES UTILISATEURS SELON RÔLE/CRITÈRES
			// =============================================================================
			if (!empty($data["ligne"]) && is_array($data["ligne"])) {
				$ligne_ids = array_map('intval', $data["ligne"]);
				$users_id = $this->User->find('list', array(
					'conditions' => array('User.ligne_id' => $ligne_ids, 'User.archive !=' => -1)
				));
			} elseif (!empty($data["users"]) && is_array($data["users"])) {
				$user_ids = array_map('intval', $data["users"]);

				$users_id = $this->User->find('list', array(
					'conditions' => array('User.id' => $user_ids, 'User.archive !=' => -1)
				));
			} elseif (AuthComponent::user('role') == 'Super viseur') {
				// Superviseur : récupère ses VMP + lui-même
				$apartients = $this->Apartient->find('all', array(
					'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
				));
				foreach ($apartients as $u) {
					if ($u['User1']['archive'] != -1) {
						$users_id[$u["User1"]["id"]] = $u["User1"]["name"];
					}
				}
				$current_user = $this->User->findById(AuthComponent::user('id'));
				$users_id[$current_user["User"]["id"]] = $current_user["User"]["name"];
			} else {
				// Tous les utilisateurs autorisés
				$users_id = $this->User->find("list", array(
					'conditions' => array(
						'User.archive' => 1,
						'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
					)
				));
			}

			// =============================================================================
			// RÉCUPÉRATION DES ABSENCES POUR LA PÉRIODE GLOBALE CHOISIE
			// (on s'en sert pour objectifs & jours travaillés)
			// =============================================================================
			$absences = array();
			$absencesController = new AbsencesController;
			// Calcul du nombre total de mois entre les 2 dates (années incluses)
			$nb_mois = (date("Y", strtotime($date_fin)) - date("Y", strtotime($date_debut))) * 12
				+ (date("m", strtotime($date_fin)) - date("m", strtotime($date_debut)));

			for ($i = 0; $i <= $nb_mois; $i++) {
				// Calcul du mois en tenant compte de l'année
				$mois = date("Y-m", strtotime($date_debut . " +$i month"));
				$debut_mois = date("Y-m-01", strtotime($mois));
				$fin_mois = date("Y-m-t", strtotime($mois));
				// Ajuster pour le premier et dernier mois
				if ($i == 0) {
					$debut_mois = $date_debut;
				}
				if ($i == $nb_mois) {
					$fin_mois = $date_fin;
				}
				foreach ($users_id as $user_id => $user_name) {
					// Retour attendu: ["jours_travailles"], ["Total_objectif"], ["Type"][type_id]...
					$absences[$user_id] = $absencesController->system_get_jour_absence_joursferie($user_id, $debut_mois, $fin_mois, $conditions_client_type_pour_absences);
					//recupéré la liste des affecations validé pour chaque user
					$listes = $this->Liste->find('list', array("fields" => array('Liste.id', "Liste.id"), 'conditions' => array('Liste.user_id' => $user_id, 'Liste.archive' => 1)));
					$affectations = $this->Liste->Affectation->find('all', array(
						'conditions' => array('Affectation.liste_id' => $listes, 'Affectation.valide' => 1),
						'fields' => array('COUNT(DISTINCT Affectation.client_id) as nbclients', 'Client.type_id'),
						'joins' => array(
							array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id=Affectation.client_id', $conditions_client))
						),
						'group' => array('Client.type_id')
					));
					//debug($affectations);
					if (empty($affectations)) {
						$affectations = [["0" => ["nbclients" => 0, "type_id" => 0]]];
					}
					$nbclients = 0;
					foreach ($affectations as $a) {
						$nbclients += $a[0]['nbclients'];
					}
					//echo $user_id." : ".$user_name." : ".$nbclients."<br>";
					$data_view[$user_id][$mois]['affectations'] = $nbclients;
					$data_view[$user_id][$mois]['absences'] = $absences[$user_id]["total"];
					$data_view[$user_id][$mois]['jours_ouvres'] = $absences[$user_id]["jours_ouvres"];
					$data_view[$user_id][$mois]['jours_travailles'] = $absences[$user_id]["jours_travailles"];
					$data_view[$user_id][$mois]['clients_attendu'] = round($nbclients * ($absences[$user_id]["jours_travailles"] / $absences[$user_id]["jours_ouvres"]), 2);

					$realisations[$user_id]['absences'] = $absences[$user_id]["total"];
					$realisations[$user_id]['jours_ouvres'] = $absences[$user_id]["jours_ouvres"];
					$realisations[$user_id]['jours_travailles'] = $absences[$user_id]["jours_travailles"];
					$realisations[$user_id]['Total_objectif'] = $absences[$user_id]["Total_objectif"];
				}

				//debug($absences);

				// =============================================================================
				// RÉCUPÉRATION DES VISITES
				// =============================================================================
				$user_ids_array = array_keys($users_id);
				$autres_conditions = array();
				$autres_conditions['Visite.user_id'] = $user_ids_array;
				$autres_conditions["DATE(Visite.date) BETWEEN '" . $debut_mois . "' AND '" . $fin_mois . "'"] = "";
				$all_conditions = array_merge($conditions_visite, $conditions_client, $autres_conditions);

				$visites = $this->Visite->find('all', array(
					'fields' => array(
						'Visite.created',
						'Visite.id',
						'Visite.user_id',
						"Visite.type_visite",
						"Visite.longitude",
						"Visite.latitude",
						'Client.id',
						"Client.longitude",
						"Client.latitude"
					),
					'conditions' => $all_conditions,
					'joins' => array(
						array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id = Visite.client_id')),
						array('table' => 'secteurs', 'alias' => 'Secteur', 'type' => 'LEFT', 'conditions' => array('Secteur.id = Client.secteur_id')),
						array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id = Client.category_id')),
						array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Visite.user_id'))
					)
				));
				//debug($visites);
				$data_visites = array();
				foreach ($visites as $v) {
					$user_id = $v['Visite']['user_id'];
					if (!isset($data_visites[$user_id]))
						$data_visites[$user_id] = array();
					if (!isset($data_visites[$user_id][$mois])) {
						$data_visites[$user_id][$mois] = array();
						$data_visites[$user_id][$mois]["all"] = array();
						$data_visites[$user_id][$mois]["gps"] = array();
						$data_visites[$user_id][$mois]["heure"] = array();
						$data_visites[$user_id][$mois]["temp_travail"] = array();
					}
					$data_visites[$user_id][$mois]["all"][$v['Client']['id']] = $v['Client']['id'];
					$data_visites[$user_id][$mois]["all_visites"][$v['Visite']['id']] = $v['Client']['id'];
					$data_visites[$user_id][$mois]["gps"][$v['Visite']['id']] = $v['Client']['longitude'] . "," . $v['Client']['latitude'] . ";" . $v['Visite']['longitude'] . "," . $v['Visite']['latitude'];
					$data_visites[$user_id][$mois]["heure"][$v['Visite']['id']] = $v['Visite']['created'];

					if (!isset($realisations[$user_id]['visites']))
						$realisations[$user_id]['visites'] = 0;
					$realisations[$user_id]['visites']++;
				}
				//debug($data_visites);
				//debug($absences[$user_id]);
				$data_visites = $this->system_analyser_visites($data_visites, $absences[$user_id]["jours_travailles"]);
				//debug($data_visites);
				foreach ($realisations as $uid => $r) {
					$conditions = array();
					$conditions["DATE(Visite.date) BETWEEN '" . $debut_mois . "' AND '" . $fin_mois . "'"] = "";
					$nbclients_for_superviseur = $this->system_get_nb_clients_par_superviseur($uid, "0", $conditions);
					if (!isset($realisations[$uid]['visites']))
						$realisations[$uid]['visites'] = 0;
					$realisations[$uid]["visites"] += $nbclients_for_superviseur;
				}
				//ajouter les visites des clients des vmp sous la supervision du superviseur les visites en double

				//fin

				//debug($data_visites);
				//echo "$user_id !! Mois $mois : " . count($visites) . " visites pour " . count($data_visites) . " users<br>";
				//debug($data_view);
				foreach ($data_view as $user_id => $datav) {
					foreach ($datav as $mois_date => $v) {
						if (isset($data_view[$user_id][$mois_date]["couverture"]))
							continue;
						if (isset($data_visites[$user_id][$mois_date]["all"])) {
							$data_view[$user_id][$mois_date]['clients_visites'] = count($data_visites[$user_id][$mois_date]["all"]);
							$data_view[$user_id][$mois_date]['visites_instantanees'] = $data_visites[$user_id][$mois_date]["visites_instantanees"];
							$data_view[$user_id][$mois_date]['moyenne_visites_jour'] = $data_visites[$user_id][$mois_date]["moyenne_visites_jour"];
							$data_view[$user_id][$mois_date]['heure_debut_moyenne'] = $data_visites[$user_id][$mois_date]["heure_debut_moyenne"];
							$data_view[$user_id][$mois_date]['heure_fin_moyenne'] = $data_visites[$user_id][$mois_date]["heure_fin_moyenne"];
							$data_view[$user_id][$mois_date]['temps_travail_moyen'] = $data_visites[$user_id][$mois_date]["temps_travail_moyen"];
						} else {
							$data_view[$user_id][$mois_date]['clients_visites'] = 0;
							$data_view[$user_id][$mois_date]['visites_instantanees'] = 0;
							$data_view[$user_id][$mois_date]['moyenne_visites_jour'] = 0;
							$data_view[$user_id][$mois_date]['heure_debut_moyenne'] = "00:00";
							$data_view[$user_id][$mois_date]['heure_fin_moyenne'] = "00:00";
							$data_view[$user_id][$mois_date]['temps_travail_moyen'] = "00:00";
						}

						//ajouter les visites des clients des vmp sous la supervision du superviseur les visites en double
						$nbclients_for_superviseur = $this->system_get_nb_clients_par_superviseur($user_id, $mois_date);
						$data_view[$user_id][$mois_date]['clients_visites'] += $nbclients_for_superviseur;
						//fin

						if ($data_view[$user_id][$mois_date]['clients_attendu'] == 0)
							$data_view[$user_id][$mois_date]['couverture'] = 0;
						else
							$data_view[$user_id][$mois_date]['couverture'] = round(($data_view[$user_id][$mois_date]['clients_visites'] / $data_view[$user_id][$mois_date]['clients_attendu']) * 100, 2);
					}
				}
			}
			//debug($data);
		}


		$allusers = array();
		if (AuthComponent::user('role') == 'Super viseur') {
			$this->Apartient->recursive = 1;
			$user = $this->Apartient->find('all', array(
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
			foreach ($user as $u) {
				if ($u['User1']['archive'] != -1) {
					$allusers[$u["User1"]["id"]] = $u["User1"]["name"];
				}
			}
			$allusers[AuthComponent::user('id')] = AuthComponent::user('name');
		} else {
			$allusers = $this->User->find("list", array(
				'conditions' => array(
					'User.archive' => 1,
					'User.role' => array('Coordinateur', 'Super viseur', 'VMP')
				)
			));
		}
		//debug($allusers);
		//$tout_user_pour_affchage_dans_le_view = $this->User->find("list");
		//debug($data_view);
		$this->set(array(
			'tout_user_pour_affchage_dans_le_view' => $allusers,
			'allusers' => $allusers,
			'secteurs' => $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), 'group' => array('Secteur.region'))),
			'categories' => $this->Category->find('list'),
			'lignes' => $this->User->Ligne->find('list'),
			'games' => $this->Game->find("list"),
			'allsecteurs' => $this->Secteur->find("list"),
			'types' => $this->Client->Type->find("list"),
			'dateaafficherdansleview' => $dateaafficherdansleview,
			'data_view' => $data_view,
			'realisations' => $realisations,
			'selected_users' => $users_id,
			'selected_types' => $types,
			'selected_categories' => $selected_categories,
			'potentialite_selected' => $potentialite_selected,
			'selected_lignes' => $ligne_ids,
			'activite_selected' => $activite,
			'selected_secteur' => $secteur_ids,
		));
	}


	function frequences_visites()
	{
		// =============================================================================
		// CONFIGURATION SÉCURITÉ ET RESSOURCES
		// =============================================================================
		ini_set('memory_limit', '-1');
		set_time_limit(60);

		// =============================================================================
		// CHARGEMENT DES MODÈLES
		// =============================================================================
		$models = array('Client', 'Secteur', 'Visite', 'Category', 'User', 'Apartient', "Liste", 'Affectation');
		foreach ($models as $model) {
			$this->loadModel($model);
			$this->{$model}->recursive = -1;
		}
		$this->Liste->Affectation->recursive = -1;

		// =============================================================================
		// VARIABLES PAR DÉFAUT
		// =============================================================================
		$dateaafficherdansleview = "";
		$date_debut = date("Y-m-01");
		$date_fin = date("Y-m-t");
		$conditions_visite = array('Visite.archive' => 1);
		$conditions_client = array('Client.archive' => 1);
		$users_id = array();
		$types = array();
		$selected_categories = array();
		$visitesParClient = array();
		$distribution = array();
		$activite = "";
		$potentialite_selected = array();
		$secteur_ids = array();
		$ligne_ids = array();


		// =============================================================================
		// TRAITEMENT DES DONNÉES POST
		// =============================================================================
		if ($this->request->is('post')) {
			$data = $this->request->data;
			// -------------------------------------------------------------------------
			// TRAITEMENT DES DATES (crée une condition BETWEEN pour Visite.date)
			// -------------------------------------------------------------------------
			if (!empty($data["date"])) {
				$dateaafficherdansleview = h($data["date"]);
				$dates = explode(" -- ", $data["date"]);
				if (count($dates) === 2) {
					$date_debut = date('Y-m-d', strtotime($dates[0]));
					$date_fin = date('Y-m-d', strtotime($dates[1]));
					$conditions_visite["DATE(Visite.created) BETWEEN '" . $date_debut . "' AND '" . $date_fin . "'"] = "";
				}
			}

			// -------------------------------------------------------------------------
			// FILTRES CLIENTS
			// -------------------------------------------------------------------------
			if (!empty($data["activite"])) {
				$activite = $data["activite"];
				$conditions_client['Client.activite'] = $data["activite"];
			}

			if (!empty($data["type"]) && is_array($data["type"])) {
				// Liste des types qui servira pour calculer l'objectif
				$types = array_map('intval', $data["type"]);
				$conditions_client['Client.type_id'] = $types;
				// debug($types);exit();
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR SECTEURS/RÉGIONS (on traduit liste d'IDs -> régions -> secteurs)
			// -------------------------------------------------------------------------
			if (!empty($data["secteur"]) && is_array($data["secteur"])) {
				$secteur_ids = array_map('intval', $data["secteur"]);
				$regions = $this->Secteur->find('list', array(
					'fields' => array('Secteur.region', 'Secteur.region'),
					'conditions' => array('Secteur.id' => $secteur_ids)
				));
				$secteurs = $this->Secteur->find('list', array(
					'fields' => array('Secteur.id', 'Secteur.id'),
					'conditions' => array('Secteur.region' => array_keys($regions))
				));
				$conditions_client['Client.secteur_id'] = array_keys($secteurs);
			}

			// -------------------------------------------------------------------------
			// FILTRAGE PAR CATÉGORIES
			// -------------------------------------------------------------------------
			// debug($data);
			if (!empty($data["category"]) && is_array($data["category"])) {
				$selected_categories = array_map('intval', $data["category"]);
				$conditions_client['Client.category_id'] = $selected_categories;
			}

			if (!empty($data["potentialite"]) && is_array($data["potentialite"])) {
				$potentialite_selected = array_values($data["potentialite"]);
				$conditions_client['Client.potentialite'] = $potentialite_selected;
			}

			// =============================================================================
			// RÉCUPÉRATION DES UTILISATEURS SELON RÔLE/CRITÈRES
			// =============================================================================
			if (!empty($data["ligne"]) && is_array($data["ligne"])) {
				$ligne_ids = array_map('intval', $data["ligne"]);
				$users_id = $this->User->find('list', array(
					'conditions' => array('User.ligne_id' => $ligne_ids, 'User.archive !=' => -1)
				));
			} elseif (!empty($data["users"]) && is_array($data["users"])) {
				$user_ids = array_map('intval', $data["users"]);

				$users_id = $this->User->find('list', array(
					'conditions' => array('User.id' => $user_ids, 'User.archive !=' => -1)
				));
			} elseif (AuthComponent::user('role') == 'Super viseur') {
				// Superviseur : récupère ses VMP + lui-même
				$apartients = $this->Apartient->find('all', array(
					'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
				));
				foreach ($apartients as $u) {
					if ($u['User1']['archive'] != -1) {
						$users_id[$u["User1"]["id"]] = $u["User1"]["name"];
					}
				}
				$current_user = $this->User->findById(AuthComponent::user('id'));
				$users_id[$current_user["User"]["id"]] = $current_user["User"]["name"];
			} else {
				// Tous les utilisateurs autorisés
				$users_id = $this->User->find("list", array(
					'conditions' => array(
						'User.archive' => 1,
						'User.role' => array('VMP', 'Super viseur', 'Coordinateur')
					)
				));
			}

			// =============================================================================
			// RÉCUPÉRATION DES VISITES
			// =============================================================================
			$conditions_visite['Visite.user_id'] = array_keys($users_id);
			$all_conditions = array_merge($conditions_visite, $conditions_client);



			$visites = $this->Visite->find('all', array(
				'fields' => array(
					'Visite.created',
					'Visite.user_id',
					'Client.id',
					'Client.nom'
				),
				'conditions' => $all_conditions,
				'joins' => array(
					array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id = Visite.client_id')),
					array('table' => 'secteurs', 'alias' => 'Secteur', 'type' => 'LEFT', 'conditions' => array('Secteur.id = Client.secteur_id')),
					array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id = Client.category_id')),
					array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Visite.user_id'))
				),
				//'limit' => 10
			));


			foreach ($visites as $visite) {
				$clientId = $visite['Client']['id'];
				$clientNom = $visite['Client']['nom'];

				if (!isset($visitesParClient[$clientId])) {
					$visitesParClient[$clientId] = array(
						'client_id' => $clientId,
						'client_nom' => $clientNom,
						'nb_visites' => 0
					);
				}

				$visitesParClient[$clientId]['nb_visites']++;
			}

			// Créer la distribution
			foreach ($visitesParClient as $client) {
				$nbVisites = $client['nb_visites'];

				if (!isset($distribution[$nbVisites])) {
					$distribution[$nbVisites] = 0;
				}

				$distribution[$nbVisites]++;
			}

			ksort($distribution);

			//debug($all_conditions);
			//debug($visites);//exit();
			//debug($visitesParClient);
			//debug($distribution);exit();
		}

		// =============================================================================
		// PRÉPARATION DES LISTES POUR LES FORMULAIRES (toujours exécuté)
		// =============================================================================
		$allusers = array();
		if (AuthComponent::user('role') == 'VMP') {
			$allusers = $this->User->find("list", array(
				'conditions' => array(
					'User.id' => $this->Auth->user('id')
				)
			));
		} else if (AuthComponent::user('role') == 'Super viseur') {
			$this->Apartient->recursive = 1;
			$user = $this->Apartient->find('all', array(
				'conditions' => array('Apartient.user_id' => AuthComponent::user('id'))
			));
			foreach ($user as $u) {
				if ($u['User1']['archive'] != -1) {
					$allusers[$u["User1"]["id"]] = $u["User1"]["name"];
				}
			}
			$allusers[AuthComponent::user('id')] = AuthComponent::user('name');
		} else {
			$allusers = $this->User->find("list", array(
				'conditions' => array(
					'User.archive' => 1,
					'User.role' => array('Coordinateur', 'Super viseur', 'VMP')
				)
			));
		}


		//$tout_user_pour_affchage_dans_le_view =$this->User->find("list");
		//debug($data_view);
		$this->set(array(
			'tout_user_pour_affchage_dans_le_view' => $allusers,
			'allusers' => $allusers,
			'secteurs' => $this->Secteur->find('list', array('fields' => array('Secteur.id', 'Secteur.region'), 'group' => array('Secteur.region'))),
			'categories' => $this->Category->find('list'),
			'lignes' => $this->User->Ligne->find('list'),
			'allsecteurs' => $this->Secteur->find("list"),
			'types' => $this->Client->Type->find("list"),
			'dateaafficherdansleview' => $dateaafficherdansleview,
			'activite' => $activite,
			'selected_users' => $users_id,
			'selected_types' => $types,
			'selected_categories' => $selected_categories,
			'visitesParClient' => $visitesParClient,
			'distribution' => $distribution,
			'potentialite_selected' => $potentialite_selected,
			'selected_secteur' => $secteur_ids,
			'selected_lignes' => $ligne_ids,
		));
	}

	// Fonction simple pour analyser les visites
	function system_analyser_visites($data_visites, $jours_travailles)
	{
		$result = array();
		//debug($data_visites);
		foreach ($data_visites as $user_id => $mois_data) {
			foreach ($mois_data as $mois => $data) {
				// Grouper par jour
				$jours = array();
				foreach ($data['heure'] as $client_id => $date) {
					$jour = date('Y-m-d', strtotime($date));
					if (!isset($jours[$jour]))
						$jours[$jour] = array();
					$jours[$jour][] = array(
						'date' => $date,
						'gps' => $data['gps'][$client_id]
					);
				}
				$visites_instantanees = 0;
				$total_visites = $total_visites_clients_localises = 0;
				$heures_debut = array();
				$heures_fin = array();
				$temps_travail = array();

				foreach ($jours as $visites_jour) {
					$heures = array();

					foreach ($visites_jour as $v) {
						//compter les visites localisées
						// Calculer distance
						list($client_gps, $visite_gps) = explode(';', $v['gps']);
						list($c_lng, $c_lat) = explode(',', $client_gps);
						list($v_lng, $v_lat) = explode(',', $visite_gps);

						if (is_numeric($c_lat) && is_numeric($c_lng)) {
							$total_visites_clients_localises++;
						}
						$total_visites++;

						$distance = round($this->system_distanceKm($c_lat, $c_lng, $v_lat, $v_lng), 1);
						if ($distance <= 0.5) {
							$visites_instantanees++;
						}

						// Extraire heure et minutes seulement
						list($h, $m) = explode(':', date('H:i', strtotime($v['date'])));
						$heures[] = ($h * 60) + $m; // Convertir en minutes
					}

					sort($heures);
					$heures_debut[] = $heures[0];
					//echo "<br>Heure Debut : ".floor($heures[0] / 60).":" . $heures[0] % 60;
					//echo "<br>Heure fin : ".floor(end($heures) / 60).":".end($heures) % 60;
					$heures_fin[] = end($heures);
					$temps_travail[] = end($heures) - $heures[0];
				}
				$nb_jours = count($jours);

				$heure_debut_moy = $nb_jours > 0 ? array_sum($heures_debut) / $nb_jours : 0;
				$heure_fin_moy = $nb_jours > 0 ? array_sum($heures_fin) / $nb_jours : 0;
				$temps_moy = $nb_jours > 0 ? array_sum($temps_travail) / $nb_jours : 0;

				$result[$user_id][$mois] = array(
					'all' => $data['all'],
					'visites_instantanees' => $total_visites_clients_localises > 0 ? round(($visites_instantanees / $total_visites_clients_localises) * 100, 1) : 0,
					//'visites_instantanees' =>"'($visites_instantanees / $total_visites_clients_localises ) ",
					'moyenne_visites_jour' => $jours_travailles > 0 ? round($total_visites / $jours_travailles, 1) : 0,
					'heure_debut_moyenne' => sprintf('%02d:%02d', floor($heure_debut_moy / 60), $heure_debut_moy % 60),
					'heure_fin_moyenne' => sprintf('%02d:%02d', floor($heure_fin_moy / 60), $heure_fin_moy % 60),
					'temps_travail_moyen' => sprintf('%02d:%02d', floor($temps_moy / 60), $temps_moy % 60),
					'koko' => "$jours_travailles > 0 ? round($total_visites / $jours_travailles, 1) : 0"

				);
				//debug($result);
			}
		}

		return $result;
	}

	// Fonction calcul distance en km
	function system_distanceKm($lat1, $lng1, $lat2, $lng2)
	{
		if (!is_numeric($lat1) || !is_numeric($lng1) || !is_numeric($lat2) || !is_numeric($lng2)) {
			return 1000; // Valeur par défaut si une coordonnée est vide ou incorrecte
		}
		$r = 6371;
		$dLat = deg2rad($lat2 - $lat1);
		$dLng = deg2rad($lng2 - $lng1);
		$a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) * sin($dLng / 2);
		return $r * 2 * atan2(sqrt($a), sqrt(1 - $a));
	}



	function system_get_nb_clients_par_superviseur($super_id = "211", $mois = "2025-09", $conditions = array())
	{
		$this->loadModel('Apartient');
		$this->loadModel('Visite');
		$this->Visite->recursive = -1;
		$users = $this->Apartient->find('list', array(
			'fields' => array('Apartient.user1_id', 'Apartient.user1_id'),
			'conditions' => array('Apartient.user_id' => $super_id)
		));
		if (empty($users)) {
			return 0;
		}
		$visites = 0;
		if ($mois != "0") {
			$visites = $this->Visite->find('count', array(
				//"fields" => array('Visite.client_id', 'Visite.user_id', 'Visite.date', 'Visite.type_visite'),
				'conditions' => array_merge(array(
					'Visite.user_id' => $users,
					'Visite.archive' => 1,
					'DATE(Visite.date) >=' => $mois . '-01',
					'DATE(Visite.date) <=' => $mois . '-31',
					'Visite.type_visite' => 'double'
				), $conditions)
			));
		}
		if (!empty($conditions)) {
			$conditions['Visite.user_id'] = $users;
			$conditions['Visite.archive'] = 1;
			$conditions['Visite.type_visite'] = 'double';
			$visites = $this->Visite->find('count', array(
				//"fields" => array('Visite.client_id', 'Visite.user_id', 'Visite.date', 'Visite.type_visite'),
				'conditions' => $conditions
			));
		}
		return $visites;
	}


}
