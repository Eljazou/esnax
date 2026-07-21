<?php

App::uses('AppController', 'Controller');

class AsmController extends AppController
{

    function asm_visites_double()
    {
        $this->loadModel('User');
        $users = $this->User->find('list', array(
            'conditions' => array('User.role' => 'Super viseur', 'User.archive' => 1),
            'fields' => array('User.id', 'User.name')
        ));
        $users_id = array_keys($users);

        // Objectifs statiques demandés
        $objectif_solo = 4;
        $objectif_double = 12;

        // Filtres par date (début et fin) au lieu d'un seul mois
        $date_debut = date('Y-m-01'); // Par défaut : début du mois en cours
        $date_fin = date('Y-m-t');   // Par défaut : fin du mois en cours

        if ($this->request->is('post') && !empty($this->request->data['Filtre'])) {
            if (!empty($this->request->data['Filtre']['date_debut'])) {
                $date_debut = $this->request->data['Filtre']['date_debut'];
            }
            if (!empty($this->request->data['Filtre']['date_fin'])) {
                $date_fin = $this->request->data['Filtre']['date_fin'];
            }
        }

        $this->loadModel('Visite');
        $this->Visite->recursive = -1;
        $visites = $this->Visite->find('all', array(
            'fields' => array(
                'Visite.id',
                'Visite.client_id',
                'Visite.user_id',
                'Visite.date',
                'Visite.created',
                'Visite.type_visite',
                'Visite.longitude',
                'Visite.latitude',
                'Visite.double_id',
                'Visite.double_gps',
                'Visite.double_date_validation',
                'Client.id',
                'Client.latitude', // Ajout de la latitude
                'Client.longitude', // Ajout de la longitude
                'Client.nom',
                'Client.prenom',
                'Client.potentialite',
                'Client.type_id', // Ajout pour le type client
                'Client.category1_id', // Ajout pour la tendance
                'Secteur.region',
                'Secteur.ville',
                'Secteur.secteur',
                "Category.name",
                "Type.name", // Ajout du nom du type
                "Tendance.name", // Ajout du nom de la tendance
                'User.id',
                'User.name'
            ),
            'joins' => array(
                array('table' => 'clients', 'alias' => 'Client', 'type' => 'INNER', 'conditions' => array('Client.id = Visite.client_id')),
                array('table' => 'secteurs', 'alias' => 'Secteur', 'type' => 'LEFT', 'conditions' => array('Secteur.id = Client.secteur_id')),
                array('table' => 'categories', 'alias' => 'Category', 'type' => 'LEFT', 'conditions' => array('Category.id = Client.category_id')),
                array('table' => 'types', 'alias' => 'Type', 'type' => 'LEFT', 'conditions' => array('Type.id = Client.type_id')), // Jointure avec types
                array('table' => 'categories', 'alias' => 'Tendance', 'type' => 'LEFT', 'conditions' => array('Tendance.id = Client.category1_id')), // Jointure avec categories pour la tendance
                array('table' => 'users', 'alias' => 'User', 'type' => 'LEFT', 'conditions' => array('User.id = Visite.user_id'))
            ),
            'conditions' => array(
                'Visite.archive' => 1,
                'DATE(Visite.date) >=' => $date_debut,
                'DATE(Visite.date) <=' => $date_fin,
                'OR' => array(
                    'Visite.double_id' => $users_id,
                    'Visite.user_id' => $users_id
                )
            )
        ));

        // Préparation du tableau final
        $stats = array();
        foreach ($users as $id => $name) {
            $stats[$id] = array(
                'nom' => $name,
                'solo' => array('S1' => array(), 'S2' => array(), 'S3' => array(), 'S4' => array(), 'S5' => array()),
                'double' => array('S1' => array(), 'S2' => array(), 'S3' => array(), 'S4' => array(), 'S5' => array())
            );
        }

        foreach ($visites as $v) {
            $is_double = (strtolower($v['Visite']['type_visite']) == 'double');
            $super_ids_concernes = array();

            if ($is_double) {
                $double_id = !empty($v['Visite']['double_id']) ? $v['Visite']['double_id'] : null;
                $user_id = !empty($v['Visite']['user_id']) ? $v['Visite']['user_id'] : null;

                // Si le double_id est le même que le user_id, c'est une visite solo déguisée
                // ou une erreur de saisie. On la repasse en solo.
                if ($double_id == $user_id || empty($double_id)) {
                    $is_double = false;
                    if (in_array($user_id, $users_id)) {
                        $super_ids_concernes[] = $user_id;
                    }
                } else {
                    // Vrai visite double
                    if (in_array($double_id, $users_id)) {
                        $super_ids_concernes[] = $double_id;
                    }
                    if (in_array($user_id, $users_id)) {
                        if (!in_array($user_id, $super_ids_concernes)) {
                            $super_ids_concernes[] = $user_id;
                        }
                    }
                }
            } else {
                if (!empty($v['Visite']['user_id']) && in_array($v['Visite']['user_id'], $users_id)) {
                    $super_ids_concernes[] = $v['Visite']['user_id'];
                }
            }

            // Allocation aux semaines et aux dates
            foreach ($super_ids_concernes as $super_id) {
                $type = $is_double ? 'double' : 'solo';
                $jour = (int)date('j', strtotime($v['Visite']['date']));
                $sem_num = ceil($jour / 7);
                if ($sem_num > 5) $sem_num = 5;
                $semaine = 'S' . $sem_num;
                $date_visite = date('Y-m-d', strtotime($v['Visite']['date']));

                if (!isset($stats[$super_id][$type][$semaine][$date_visite])) {
                    $stats[$super_id][$type][$semaine][$date_visite] = array();
                }

                // S'il s'agit d'une visite double pour le superviseur, et qu'il est le double_id, 
                // on veut afficher le nom du VMP (cad le user_id).
                // Si dans la requête on a joint User sur v.user_id, $v['User']['name'] contient bien le VMP.
                // Donc on laisse tel quel.

                // Calcul de la distance Client vs Visite (pour toutes les visites)
                if (!empty($v['Client']['latitude']) && !empty($v['Client']['longitude']) && !empty($v['Visite']['latitude']) && !empty($v['Visite']['longitude'])) {
                    $v['distance'] = round($this->system_distanceKm($v['Client']['latitude'], $v['Client']['longitude'], $v['Visite']['latitude'], $v['Visite']['longitude']) * 1000, 0); // en mètres
                } else {
                    $v['distance'] = null;
                }

                // Calcul de la distance pour les visites doubles (VMP vs DSM)
                if ($is_double && !empty($v['Visite']['double_gps']) && !empty($v['Visite']['latitude']) && !empty($v['Visite']['longitude'])) {
                    list($v_lat, $v_lng) = explode(',', $v['Visite']['double_gps']);
                    // Assurons-nous que v_lat et v_lng sont bien passés dans le bon ordre à la fonction (lat1, lon1, lat2, lon2)
                    $v['distance_double'] = round($this->system_distanceKm($v['Visite']['latitude'], $v['Visite']['longitude'], $v_lat, $v_lng) * 1000, 0); // en mètres
                } else {
                    $v['distance_double'] = null;
                }

                // Calcul du temps de validation en minutes
                if ($is_double && !empty($v['Visite']['created']) && !empty($v['Visite']['double_date_validation'])) {
                    $t1 = strtotime($v['Visite']['created']);
                    $t2 = strtotime($v['Visite']['double_date_validation']);
                    $v['temps_validation_min'] = round(abs($t2 - $t1) / 60);
                } else {
                    $v['temps_validation_min'] = null;
                }

                $stats[$super_id][$type][$semaine][$date_visite][] = $v;
            }
        }

        // Ajout du total et de la réalisation pour vue facile
        $stats_filtered = array();
        foreach ($stats as $super_id => &$data) {
            $has_visites = false;
            foreach (['solo', 'double'] as $type) {
                $total_jours = 0;
                foreach (['S1', 'S2', 'S3', 'S4', 'S5'] as $semaine) {
                    $jours_count = count($data[$type][$semaine]); // nb de jours travaillés
                    $data[$type][$semaine . '_count'] = $jours_count;
                    $total_jours += $jours_count;
                }
                $data[$type]['total_jours'] = $total_jours;
                $obj = ($type == 'solo') ? $objectif_solo : $objectif_double;

                if ($obj > 0) {
                    // Format standard comme l'image, on remplace le point par la virgule dans la vue
                    $data[$type]['realisation'] = round(($total_jours / $obj) * 100, 2);
                } else {
                    $data[$type]['realisation'] = 0;
                }

                if ($total_jours > 0) {
                    $has_visites = true;
                }
            }

            // Ne garder que les superviseurs ayant au moins une visite
            if ($has_visites) {
                $stats_filtered[$super_id] = $data;
            }
        }
        $stats = $stats_filtered;

        // --- Ajout de la logique pour potV2 comme demandé ---
        // 1. Récupération de tous les IDs clients visités
        $client_ids = array();
        foreach ($visites as $v) {
            $client_ids[] = $v['Client']['id'];
        }
        $client_ids = array_unique($client_ids); // Éviter les doublons

        $potv2 = array(); // Initialisation de notre tableau potv2 qu'on va envoyer à la vue

        // 2. Si on a des clients, on va chercher leurs pots et gammes
        if (!empty($client_ids)) {
            $this->loadModel("Pot");
            $this->loadModel("Game");
            $gammes = $this->Game->find('list'); // Liste des gammes [id => name]

            // On récupère l'identifiant maximum du pot (pour avoir la dernière mise à jour) pour chaque client
            $this->Pot->recursive = -1;
            $pots = $this->Pot->find('all', array(
                'fields' => array(
                    'Pot.client_id',
                    'MAX(Pot.id) AS last_id'
                ),
                'conditions' => array(
                    'Pot.client_id' => $client_ids,
                ),
                'group' => array('Pot.client_id'),
            ));

            $max_ids = array();
            foreach ($pots as $pot) {
                if (!empty($pot[0]["last_id"])) {
                    $max_ids[] = $pot[0]["last_id"];
                }
            }

            // Si on a trouvé des IDs maximums, on récupère les données complètes de ces pots
            if (!empty($max_ids)) {
                $pots_data = $this->Pot->find('all', array(
                    'conditions' => array('Pot.id' => $max_ids),
                    'recursive' => -1
                ));

                // Formatage des données dans le tableau potv2
                foreach ($pots_data as $pd) {
                    $potv2[$pd['Pot']['client_id']] = array(
                        "id" => $pd["Pot"]["id"],
                        "pot" => $pd["Pot"]["pot_patient"] . '' . $pd["Pot"]["pot_indication"] . '' . $pd["Pot"]["pot_prescription"],
                        "gamme" => isset($gammes[$pd["Pot"]["game_id"]]) ? $gammes[$pd["Pot"]["game_id"]] : '-'
                    );
                }
            }
        }

        // On passe les variables nécessaires à la vue : date_debut, date_fin, et potv2
        $this->set(compact('stats', 'objectif_solo', 'objectif_double', 'date_debut', 'date_fin', 'potv2'));
    }

    public function suivi_pharmacie()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(50);
        $this->loadModel('User');
        $this->loadModel('Client');
        $this->loadModel('Visite');
        $this->loadModel('Type');
        $types = $this->Type->find('list');
        $this->loadModel("Category");
        $categories = $this->Category->find('list');
        $this->loadModel("Secteur");
        $secteurs = $this->Secteur->find('list');

        // Liste des lignes pour le filtre
        $this->loadModel('Ligne');
        $lignes_list = $this->Ligne->find('list', array(
            'fields' => array('Ligne.id', 'Ligne.name'),
            'order' => array('Ligne.name ASC')
        ));

        // Liste des VMPs et Superviseurs actifs
        $users_list = $this->User->find('list', array(
            'conditions' => array('User.archive' => 1, 'User.role' => array('Super viseur', 'VMP')),
            'fields' => array('User.id', 'User.name')
        ));

        // Filtres par défaut
        $date_debut = date('Y-m-01');
        $date_fin = date('Y-m-t');
        $users_to_search = array(0);
        $selected_users = [];
        $selected_ligne = null;

        if ($this->request->is('post') && !empty($this->request->data['Filtre'])) {
            if (!empty($this->request->data['Filtre']['date_debut'])) {
                $date_debut = $this->request->data['Filtre']['date_debut'];
            }
            if (!empty($this->request->data['Filtre']['date_fin'])) {
                $date_fin = $this->request->data['Filtre']['date_fin'];
            }
            if (!empty($this->request->data['Filtre']['ligne_id'])) {
                $selected_ligne = $this->request->data['Filtre']['ligne_id'];
                // Filtrer users_list pour ne garder que ceux de cette ligne
                $users_de_la_ligne = $this->User->find('list', array(
                    'conditions' => array(
                        'User.archive' => 1,
                        'User.role' => array('Super viseur', 'VMP'),
                        'User.ligne_id' => $selected_ligne
                    ),
                    'fields' => array('User.id', 'User.name')
                ));
                $users_list = $users_de_la_ligne;
            }
            if (!empty($this->request->data['Filtre']['users'])) {
                $selected_users = $this->request->data['Filtre']['users'];
                $users_to_search = $selected_users;
            } elseif (!empty($selected_ligne)) {
                // Si ligne sélectionnée mais pas d'utilisateur précis : prendre tous ceux de la ligne
                $users_to_search = !empty($users_list) ? array_keys($users_list) : array(0);
            }
        }

        // Si aucun utilisateur sélectionné, on prend tout le monde pour éviter une grille vide au chargement
        //$users_to_search = !empty($selected_users) ? $selected_users : array_keys($users_list);


        //je recupere toutes les pharmacies visites par les utilisateurs selectionnes
        $this->Visite->recursive = -1;
        $clients_visites = $this->Visite->find('all', array(
            'fields' => array(
                'Visite.user_id',
                'Visite.client_id',
                'Visite.id',
                "Visite.latitude",
                "Visite.longitude",
                "Visite.created",
                'Client.id',
                'Client.nom',
                'Client.prenom',
                'Client.code_wavsoft',
                'Client.tel',
                'Client.fixe',
                'Client.adress',
                'Client.latitude',
                'Client.longitude',
                'Client.type_id',
                'Client.category_id',
                'Client.category1_id',
                'Client.secteur_id'
            ),
            'joins' => array(
                // On s'assure que c'est une pharmacie
                array(
                    'table' => 'clients',
                    'alias' => 'Client',
                    'type' => 'INNER',
                    'conditions' => array('Client.id = Visite.client_id', 'Client.type_id!=1')
                )
            ),
            'conditions' => array(
                'Visite.archive' => 1,
                'DATE(Visite.date) >=' => $date_debut,
                'DATE(Visite.date) <=' => $date_fin,
                'Visite.user_id' => $users_to_search
            )
        ));
        $data = [];
        foreach ($clients_visites as $client_visite) {
            $user_id = $client_visite["Visite"]["user_id"];
            $client_id = $client_visite["Client"]["id"];
            $client_visite["Client"]["type"] = $types[$client_visite["Client"]["type_id"]];
            $client_visite["Client"]["category"] = $categories[$client_visite["Client"]["category_id"]];
            $client_visite["Client"]["secteur"] = $secteurs[$client_visite["Client"]["secteur_id"]];
            if (!isset($data[$user_id])) {
                $data[$user_id] = array();
            }
            if (!isset($data[$user_id][$client_id])) {
                $client_visite["Client"]["localiser"] = 0;
                $client_visite["Client"]["instantane"] = 0;
                $client_visite["Client"]["nb_visite"] = 1;
                $client_visite["DetailVisites"] = array();
                $client_visite["DetailVisites"][] = $client_visite["Visite"];
                if (
                    !empty($client_visite['Client']['latitude']) && !empty($client_visite['Client']['longitude'])
                    && !empty($client_visite['Visite']['latitude']) && !empty($client_visite['Visite']['longitude'])
                ) {
                    // Assurons-nous que v_lat et v_lng sont bien passés dans le bon ordre à la fonction (lat1, lon1, lat2, lon2)
                    $distance = round($this->system_distanceKm($client_visite['Client']['latitude'], $client_visite['Client']['longitude'], $client_visite['Visite']['latitude'], $client_visite['Visite']['longitude']) * 1000, 0); // en mètres
                    $client_visite["Client"]["localiser"] = 1;
                    if ($distance < 500) {
                        $client_visite["Client"]["instantane"] = 1;
                    }
                }

                $data[$user_id][$client_id] = $client_visite;
            } else {
                $data[$user_id][$client_id]["Client"]["nb_visite"]++;
                $data[$user_id][$client_id]["DetailVisites"][] = $client_visite["Visite"];
                if (
                    !empty($client_visite['Client']['latitude']) && !empty($client_visite['Client']['longitude'])
                    && !empty($client_visite['Visite']['latitude']) && !empty($client_visite['Visite']['longitude'])
                ) {
                    // Assurons-nous que v_lat et v_lng sont bien passés dans le bon ordre à la fonction (lat1, lon1, lat2, lon2)
                    $distance = round($this->system_distanceKm($client_visite['Client']['latitude'], $client_visite['Client']['longitude'], $client_visite['Visite']['latitude'], $client_visite['Visite']['longitude']) * 1000, 0); // en mètres
                    $data[$user_id][$client_id]["Client"]["localiser"]++;
                    if ($distance < 500) {
                        $data[$user_id][$client_id]["Client"]["instantane"]++;
                    }
                }
            }
        }
        //debug($data);
        //debug($clients_visites);

        //la liste des clients affecter
        $this->loadModel("Affectation");
        $affectations = $this->Affectation->find('all', array(
            'fields' => array(
                'Client.*',
                'Liste.user_id'
            ),
            'conditions' => array(
                'Affectation.valide' => 1,
                'Liste.user_id' => $users_to_search,
                'Liste.archive' => 1,
                'Client.type_id!=1',
                'Client.archive' => 1
            )
        ));
        foreach ($affectations as $affectation) {
            $affectation["Client"]["type"] = $types[$affectation["Client"]["type_id"]];
            $affectation["Client"]["category"] = $categories[$affectation["Client"]["category_id"]];
            if ($affectation["Client"]["category1_id"] != null) {
                $affectation["Client"]["tendance"] = $categories[$affectation["Client"]["category1_id"]];
            } else {
                $affectation["Client"]["tendance"] = "";
            }
            $affectation["Client"]["secteur"] = $secteurs[$affectation["Client"]["secteur_id"]];
            if (isset($data[$affectation["Liste"]["user_id"]][$affectation["Client"]["id"]])) {
                $data[$affectation["Liste"]["user_id"]][$affectation["Client"]["id"]]["Client"]["affecter"] = 1;
            } else {
                $data[$affectation["Liste"]["user_id"]][$affectation["Client"]["id"]] = [];
                $affectation["Client"]["nb_visite"] = 0;
                $affectation["Client"]["localiser"] = 0;
                $affectation["Client"]["instantane"] = 0;
                $affectation["Client"]["affecter"] = 1;
                $data[$affectation["Liste"]["user_id"]][$affectation["Client"]["id"]] = $affectation;
            }
        }

        $this->set(compact('data', 'users_list', 'selected_users', 'date_debut', 'date_fin', 'lignes_list', 'selected_ligne'));
    }

    public function system_distanceKm($lat1, $lon1, $lat2, $lon2)
    {
        $lat1 = (float) str_replace(',', '.', $lat1);
        $lon1 = (float) str_replace(',', '.', $lon1);
        $lat2 = (float) str_replace(',', '.', $lat2);
        $lon2 = (float) str_replace(',', '.', $lon2);

        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
        return $km;
    }
}
