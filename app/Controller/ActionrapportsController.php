<?php

App::uses('AppController', 'Controller');

class ActionrapportsController extends AppController
{

    public $components = array('Paginator', 'Session');

    /**
     * Récupère les IDs des VM (délégués) d'un superviseur via la table Apartient
     */
    private function system_getVmIds($superviseur_id)
    {
        $this->loadModel('Apartient');
        $this->Apartient->recursive = -1;
        $affectations = $this->Apartient->find('all', array(
            'conditions' => array('Apartient.user_id' => $superviseur_id)
        ));
        $ids = array($superviseur_id);
        foreach ($affectations as $a) {
            $ids[] = $a['Apartient']['user1_id'];
        }
        return $ids;
    }

    /**
     * Vue index : affiche juste les rapportactions déjà ajoutés.
     * Admin : toutes les actions
     * Superviseur : siennes + ses VM
     * Délégué : siennes
     */
    public function index()
    {
        $this->loadModel('Actionrapport');
        $this->loadModel('Action');
        $this->loadModel('Pot');
        $this->loadModel("Game");

        $role = AuthComponent::user('role');
        $user_id = AuthComponent::user('id');

        $date_debut = date('Y-m-01');
        $date_fin = date('Y-m-t');

        if (isset($this->request->query['date_debut']) && !empty($this->request->query['date_debut'])) {
            $date_debut = $this->request->query['date_debut'];
        }
        if (isset($this->request->query['date_fin']) && !empty($this->request->query['date_fin'])) {
            $date_fin = $this->request->query['date_fin'];
        }

        $conditions = array(
            'Actionrapport.created >=' => $date_debut,
            'Actionrapport.created <=' => $date_fin . ' 23:59:59'
        );

        if ($role == 'Admin') {
            // voit tout
        } elseif ($role == 'Super viseur') {
            $vm_ids = $this->system_getVmIds($user_id);
            $conditions['Actionrapport.user_id'] = $vm_ids;
        } else {
            $conditions['Actionrapport.user_id'] = $user_id;
        }

        $rapports = $this->Actionrapport->find('all', array(
            'conditions' => $conditions,
            'order' => array('Actionrapport.created' => 'DESC')
        ));
        $client_ids = array();
        foreach ($rapports as &$rapport) {
            $action = $this->Action->find('first', array(
                'conditions' => array('Action.id' => $rapport['Actionrapport']['action_id'])
            ));
            $client_ids[$action['Action']['client_id']] = $action['Action']['client_id'];
            $rapport['ActionDetail'] = $action;
        }
        unset($rapport);
        // --- Ajout de la logique pour potV2 comme demandé ---
        // 1. Récupération de tous les IDs clients visités

        $potv2 = array(); // Initialisation de notre tableau potv2 qu'on va envoyer à la vue

        // 2. Si on a des clients, on va chercher leurs pots et gammes
        if (!empty($client_ids)) {

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
        $this->loadModel('Secteur');
        $this->Secteur->recursive = -1;
        $secteurs = $this->Secteur->find('all');
        $temp = array();
        foreach ($secteurs as $secteur) {
            $temp[$secteur['Secteur']['id']] = $secteur['Secteur'];
        }
        $secteurs = $temp;
        $this->set(compact('rapports', 'date_debut', 'date_fin', 'role', 'secteurs', 'potv2'));
    }

    /**
     * Ajouter un nouveau rapport d'action
     */
    public function add()
    {
        $this->loadModel('Action');
        $this->loadModel('Actionrapport');

        $user_id = AuthComponent::user('id');
        $role = AuthComponent::user('role');

        if ($this->request->is('post')) {
            $this->Actionrapport->create();
            // Assigner le user connecté
            $this->request->data['Actionrapport']['user_id'] = $user_id;

            if ($this->Actionrapport->save($this->request->data)) {
                $this->Session->setFlash(__('Le rapport a été ajouté avec succès.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Erreur lors de l\'ajout du rapport. Merci de vérifier les données.'));
            }
        }

        // Actions actives pour le Select
        $date_courante = date('Y-m-d');
        $conditions = array(
            'Action.archive' => 2,
            'Action.date_debut <=' => $date_courante,
            'Action.date_fin >=' => $date_courante
        );

        if ($role == 'Admin') {
            // voit tout
        } elseif ($role == 'Super viseur') {
            $vm_ids = $this->system_getVmIds($user_id);
            $conditions['Action.user_id'] = $vm_ids;
        } else {
            $conditions['Action.user_id'] = $user_id;
        }

        $actions_actives = $this->Action->find('all', array(
            'conditions' => $conditions
        ));

        $actions_list = array();
        $actions_json = array();
        foreach ($actions_actives as $a) {
            $nom = isset($a['Client']['nom']) ? $a['Client']['nom'] . ' ' . $a['Client']['prenom'] : 'Client Inconnu';
            $gamme = isset($a['Action']['game_id']) ? rtrim($a['Action']['game_id'], ',') : '';
            // Inclure le nom du délégué si on n'est pas délégué pour clarifier
            if ($role == 'Admin' || $role == 'Super viseur') {
                $delegue = isset($a['User']['name']) ? $a['User']['name'] : 'Inconnu';
                $actions_list[$a['Action']['id']] = $nom . ' (Gamme: ' . $gamme . ') - Délégué: ' . $delegue;
            } else {
                $actions_list[$a['Action']['id']] = $nom . ' (Gamme: ' . $gamme . ')';
            }

            $date_debut_str = isset($a['Action']['date_debut']) ? $a['Action']['date_debut'] : '';
            $date_fin_str = isset($a['Action']['date_fin']) ? $a['Action']['date_fin'] : '';

            $duree_jours = 0;
            $jours_restants = 0;

            if (!empty($date_debut_str) && !empty($date_fin_str)) {
                $ts_debut = strtotime($date_debut_str);
                $ts_fin = strtotime($date_fin_str);
                if ($ts_debut && $ts_fin) {
                    $duree_jours = max(0, round(($ts_fin - $ts_debut) / 86400));
                    $jours_restants = max(0, round(($ts_fin - time()) / 86400));
                }
            }

            $actions_json[$a['Action']['id']] = array(
                'client_nom' => $nom,
                'gamme' => $gamme,
                'date_debut' => !empty($date_debut_str) ? date('d/m/Y', strtotime($date_debut_str)) : '',
                'date_fin' => !empty($date_fin_str) ? date('d/m/Y', strtotime($date_fin_str)) : '',
                'duree_totale' => $duree_jours,
                'jours_restants' => $jours_restants,
                'remarque' => isset($a['Action']['remarque']) ? $a['Action']['remarque'] : ''
            );
        }

        $this->set(compact('actions_list', 'actions_json', 'role'));
    }


    /**
     * Vue Suivi : Liste des médecins (clients) en action pour voir l'état des rapports
     * Drapeaux rouge (>30j), jaune (>15j), vert (<15j)
     */
    public function suivi()
    {
        $this->loadModel('Action');
        $this->loadModel('Actionrapport');

        $role = AuthComponent::user('role');
        $user_id = AuthComponent::user('id');

        $date_courante = date('Y-m-d');

        $conditions = array(
            'Action.archive' => 2,
            'Action.date_debut <=' => $date_courante,
            'Action.date_fin >=' => $date_courante
        );

        if ($role == 'Admin') {
            // voit tout
        } elseif ($role == 'Super viseur') {
            $vm_ids = $this->system_getVmIds($user_id);
            $conditions['Action.user_id'] = $vm_ids;
        } else {
            $conditions['Action.user_id'] = $user_id;
        }

        $actions_actives = $this->Action->find('all', array(
            'conditions' => $conditions,
            'order' => array('Client.nom' => 'ASC')
        ));

        $suivi_actions = array();
        foreach ($actions_actives as $a) {
            $action_id = $a['Action']['id'];

            // Dernier rapport de cette action
            $last_rapport = $this->Actionrapport->find('first', array(
                'conditions' => array('Actionrapport.action_id' => $action_id),
                'order' => array('Actionrapport.created' => 'DESC')
            ));

            if ($last_rapport) {
                $last_date = strtotime($last_rapport['Actionrapport']['created']);
            } else {
                $last_date = strtotime($a['Action']['date_debut']);
            }

            $jours_depuis = max(0, round((time() - $last_date) / 86400));

            if ($jours_depuis >= 30) {
                $statut = 'rouge';
            } elseif ($jours_depuis >= 15) {
                $statut = 'jaune';
            } else {
                $statut = 'vert';
            }

            $suivi_actions[] = array(
                'Action' => $a['Action'],
                'Client' => isset($a['Client']) ? $a['Client'] : array(),
                'User' => isset($a['User']) ? $a['User'] : array('name' => ''),
                'dernier_rapport' => $last_rapport ? $last_rapport['Actionrapport']['created'] : null,
                'jours_depuis' => $jours_depuis,
                'statut' => $statut
            );
        }

        $this->set(compact('suivi_actions', 'role'));
    }
}
