<?php

App::uses('AppController', 'Controller');

class EvaluationsController extends AppController
{

    // =========================================================================
    // MÉTHODE PRIVÉE : Récupérer les IDs des VMP de l'équipe du superviseur
    // - Si admin → retourne null (pas de restriction)
    // - Si superviseur → retourne un tableau d'IDs autorisés
    // =========================================================================
    private function _getTeamVmpIds()
    {
        $role = AuthComponent::user('role');
        $myId = AuthComponent::user('id');

        if ($role != 'Admin' && $role != 'Super viseur') {
            return array($myId);
        }

        // Admin = pas de restriction
        if ($role != 'Super viseur') {
            return null;
        }

        $myId = AuthComponent::user('id');
        $this->loadModel('Apartient');

        $apartients = $this->Apartient->find('all', array(
            'conditions' => array('Apartient.user_id' => $myId),
            'recursive' => -1,
            'fields' => array('Apartient.user1_id')
        ));

        $ids = array();
        foreach ($apartients as $a) {
            $ids[] = $a['Apartient']['user1_id'];
        }

        return $ids;
    }

    // =========================================================================
    // MÉTHODE PRIVÉE : Vérifier qu'un user_id fait partie de l'équipe
    // - Bloque avec une exception si le superviseur n'a pas le droit
    // =========================================================================
    private function _checkTeamAccess($user_id)
    {
        $allowedIds = $this->_getTeamVmpIds();

        // null = admin, pas de restriction
        if ($allowedIds === null) {
            return true;
        }

        // Vérifier que le user_id est dans l'équipe du superviseur
        if (!in_array($user_id, $allowedIds)) {
            throw new ForbiddenException(__('Accès non autorisé : ce membre ne fait pas partie de votre équipe.'));
        }

        return true;
    }

    // =========================================================================
    // DASHBOARD - Page principale avec score, ranking, tendance
    // =========================================================================
    public function index()
    {
        $this->loadModel('User');
        $this->loadModel('Apartient');

        $role = AuthComponent::user('role');
        $myId = AuthComponent::user('id');

        // --- 1. Conditions de filtre selon le rôle ---
        $conditions = array('User.archive' => 1);
        if ($role == 'Super viseur') {
            $conditions['Apartient.user_id'] = $myId;
        } elseif ($role != 'Admin') {
            $conditions['Apartient.user1_id'] = $myId;
        }

        // --- 2. Récupérer les relations Superviseur → VMP ---
        $apartients = $this->Apartient->find('all', array(
            'conditions' => $conditions,
            'recursive' => 0
        ));

        // --- 3. Construire les données du dashboard ---
        $dashboardData = array();
        $allScores = array(); // Pour le ranking global CRM
        $supIds = array();    // Stocker les IDs des superviseurs pour les ajouter en bas

        foreach ($apartients as $row) {
            $supName = isset($row['User']['name']) ? $row['User']['name'] : 'Inconnu';
            $supId = isset($row['User']['id']) ? $row['User']['id'] : null;
            $vmp = isset($row['User1']) ? $row['User1'] : null;

            if (!$vmp || empty($vmp['id'])) continue;

            // Stocker l'ID du superviseur pour l'ajouter comme ligne en bas
            if ($supId) {
                $supIds[$supName] = $supId;
            }

            // Récupérer la dernière évaluation
            $lastEvalInfo = $this->system_dernier_evaluation($vmp['id']);

            // Calculer les jours écoulés
            $lastDate = '';
            $daysPassed = null;
            $evalCount = isset($lastEvalInfo['Evaluation']['count']) ? $lastEvalInfo['Evaluation']['count'] : 0;
            $lastScore = null;

            if (!empty($lastEvalInfo['Evaluation']['created'])) {
                $lastDate = $lastEvalInfo['Evaluation']['created'];
                $diff = time() - strtotime($lastDate);
                $daysPassed = floor($diff / (60 * 60 * 24));
            }

            // Score de la dernière évaluation
            if (!empty($lastEvalInfo['Evaluation']['total_percentage'])) {
                $lastScore = (float) $lastEvalInfo['Evaluation']['total_percentage'];
            }

            // Calculer la tendance (comparer avec l'avant-dernière évaluation)
            $tendance = $this->_calculerTendance($vmp['id'], $lastScore);

            // Statut par rapport aux 60 jours
            $status = 'A_JOUR';
            if ($daysPassed === null) {
                $status = 'NON_EVALUE';
            } else if ($daysPassed > 60) {
                $status = 'RETARD';
            }

            $vmpData = array(
                'vmp_id' => $vmp['id'],
                'vmp_name' => $vmp['name'],
                'count' => $evalCount,
                'last_date' => $lastDate,
                'days' => $daysPassed,
                'status' => $status,
                'last_score' => $lastScore,
                'tendance' => $tendance,
                'is_superviseur' => false
            );

            $dashboardData[$supName][] = $vmpData;

            // Stocker le score pour le ranking global
            if ($lastScore !== null) {
                $allScores[$vmp['id']] = $lastScore;
            }
        }

        // --- 4. Ajouter les superviseurs en bas de leur équipe (admin seulement) ---
        if ($role == 'Admin') {
            foreach ($supIds as $supName => $supId) {
                $supEvalInfo = $this->system_dernier_evaluation($supId);
                $supUser = $this->User->findById($supId);

                $supLastDate = '';
                $supDays = null;
                $supCount = isset($supEvalInfo['Evaluation']['count']) ? $supEvalInfo['Evaluation']['count'] : 0;
                $supScore = null;

                if (!empty($supEvalInfo['Evaluation']['created'])) {
                    $supLastDate = $supEvalInfo['Evaluation']['created'];
                    $diff = time() - strtotime($supLastDate);
                    $supDays = floor($diff / (60 * 60 * 24));
                }

                if (!empty($supEvalInfo['Evaluation']['total_percentage'])) {
                    $supScore = (float) $supEvalInfo['Evaluation']['total_percentage'];
                }

                $supTendance = $this->_calculerTendance($supId, $supScore);

                $supStatus = 'A_JOUR';
                if ($supDays === null) {
                    $supStatus = 'NON_EVALUE';
                } else if ($supDays > 60) {
                    $supStatus = 'RETARD';
                }

                $dashboardData[$supName][] = array(
                    'vmp_id' => $supId,
                    'vmp_name' => $supUser ? $supUser['User']['name'] : $supName,
                    'count' => $supCount,
                    'last_date' => $supLastDate,
                    'days' => $supDays,
                    'status' => $supStatus,
                    'last_score' => $supScore,
                    'tendance' => $supTendance,
                    'is_superviseur' => true
                );

                if ($supScore !== null) {
                    $allScores[$supId] = $supScore;
                }
            }
        }

        // --- 5. Calculer les rankings ---
        // Ranking global CRM : trier tous les scores de manière décroissante
        arsort($allScores);
        $globalRanking = array();
        $rang = 1;
        foreach ($allScores as $uid => $score) {
            $globalRanking[$uid] = $rang;
            $rang++;
        }

        // Ranking par équipe : trier les scores au sein de chaque équipe
        $teamRanking = array();
        foreach ($dashboardData as $supName => $vmps) {
            // Extraire les scores de l'équipe
            $teamScores = array();
            foreach ($vmps as $v) {
                if ($v['last_score'] !== null) {
                    $teamScores[$v['vmp_id']] = $v['last_score'];
                }
            }
            arsort($teamScores);

            $r = 1;
            foreach ($teamScores as $uid => $score) {
                $teamRanking[$uid] = $r;
                $r++;
            }
        }

        // --- 6. Compter les alertes (retard) ---
        $alertCount = 0;
        foreach ($dashboardData as $supName => $vmps) {
            foreach ($vmps as $v) {
                if ($v['status'] == 'RETARD') {
                    $alertCount++;
                }
            }
        }

        $this->set('dashboardData', $dashboardData);
        $this->set('globalRanking', $globalRanking);
        $this->set('teamRanking', $teamRanking);
        $this->set('totalCrm', count($allScores));
        $this->set('alertCount', $alertCount);
        $this->set('role', $role);
    }

    // =========================================================================
    // TENDANCE : comparer la dernière note à l'avant-dernière
    // Retourne 'up', 'down' ou 'stable'
    // =========================================================================
    private function _calculerTendance($user_id, $lastScore)
    {
        if ($lastScore === null) {
            return 'stable';
        }

        // Chercher les 2 dernières évaluations
        $this->Evaluation->recursive = -1;
        $lastTwo = $this->Evaluation->find('all', array(
            'conditions' => array('Evaluation.user_id' => $user_id, 'Evaluation.archive' => 1),
            'order' => array('Evaluation.created DESC'),
            'fields' => array('Evaluation.total_percentage'),
            'limit' => 2
        ));

        // S'il n'y a qu'une seule évaluation → stable
        if (count($lastTwo) < 2) {
            return 'stable';
        }

        $previousScore = (float) $lastTwo[1]['Evaluation']['total_percentage'];

        if ($lastScore > $previousScore) {
            return 'up';
        } else if ($lastScore < $previousScore) {
            return 'down';
        }

        return 'stable';
    }

    // =========================================================================
    // HISTORIQUE - Affiche l'historique d'un seul VMP ou de tous (admin)
    // $user_id = null → historique global (admin)
    // $user_id = X   → historique de ce seul VMP
    // =========================================================================
    public function historique($user_id = null)
    {
        $this->Evaluation->recursive = 0;
        $role = AuthComponent::user('role');
        $conditions = array('Evaluation.archive' => 1);

        // --- Mode individuel : un seul VMP ---
        if ($user_id) {
            // Sécurité : vérifier que le superviseur a le droit de voir ce VMP
            $this->_checkTeamAccess($user_id);

            $conditions['Evaluation.user_id'] = $user_id;

            // Récupérer le nom du VMP pour l'affichage
            $this->loadModel('User');
            $vmpUser = $this->User->findById($user_id);
            $this->set('vmpName', $vmpUser ? $vmpUser['User']['name'] : 'Inconnu');
            $this->set('vmpId', $user_id);
        } else {
            // Mode global : restriction selon le rôle
            if ($role == 'Super viseur') {
                $conditions['Evaluation.chef_id'] = AuthComponent::user('id');
            } elseif ($role != 'Admin') {
                $conditions['Evaluation.user_id'] = AuthComponent::user('id');
            }
        }

        $evaluations = $this->Evaluation->find('all', array(
            'conditions' => $conditions,
            'order' => array('Chef.name ASC', 'User.name ASC', 'Evaluation.created DESC')
        ));

        // Grouper les données par superviseur puis par VMP
        $groupedHistory = array();
        foreach ($evaluations as $eva) {
            $chefName = $eva['Chef']['name'];
            $vmpName = $eva['User']['name'];
            $groupedHistory[$chefName][$vmpName][] = $eva;
        }

        $this->set('groupedHistory', $groupedHistory);
        $this->set('role', $role);
        $this->set('isIndividuel', !empty($user_id));
    }

    // =========================================================================
    // VIEW - Voir le rapport d'une évaluation
    // =========================================================================
    public function view($id = null)
    {
        if (!$this->Evaluation->exists($id)) {
            throw new NotFoundException(__('Evaluation invalide'));
        }

        $options = array('conditions' => array('Evaluation.' . $this->Evaluation->primaryKey => $id));
        $evaluation = $this->Evaluation->find('first', $options);

        // Sécurité : vérifier l'accès à ce VMP
        $this->_checkTeamAccess($evaluation['Evaluation']['user_id']);

        // 1. Historique pour le graphique ligne
        $user_id = $evaluation['Evaluation']['user_id'];
        $historyList = $this->Evaluation->find('all', array(
            'conditions' => array('Evaluation.user_id' => $user_id, 'Evaluation.archive' => 1),
            'order' => array('Evaluation.created ASC'),
            'fields' => array('created', 'total_percentage')
        ));

        $historyDates = array();
        $historyScores = array();
        foreach ($historyList as $h) {
            $historyDates[] = date('d/m/Y', strtotime($h['Evaluation']['created']));
            $historyScores[] = (float)$h['Evaluation']['total_percentage'];
        }

        // 2. Top 3 Forces / Top 3 Axes d'amélioration
        $questionsMap = array(
            'q1_1' => 'Planification via CRM',
            'q1_2' => 'Objectifs clairs',
            'q1_3' => 'Messages pertinents',
            'q1_4' => 'Moyens promotionnels',
            'q1_5' => 'Présentation standards',
            'q1_6' => 'Attitude professionnelle',
            'q2_1' => 'Introduction et attention',
            'q2_2' => 'Structure des axes',
            'q2_3' => 'Utilisation des visuels',
            'q2_4' => 'Traitement objections',
            'q2_5' => 'Écoute active',
            'q2_6' => 'Focalisation entretien',
            'q3_1' => 'Conclusion efficace',
            'q3_2' => 'Engagement obtenu',
            'q3_3' => 'Reporting CRM complet',
            'q3_4' => 'Analyse de visite',
            'q3_5' => 'Actions de suivi'
        );

        $scoresArray = array();
        foreach ($questionsMap as $key => $label) {
            if (isset($evaluation['Evaluation'][$key]) && $evaluation['Evaluation'][$key] !== null) {
                $scoresArray[$label] = (int)$evaluation['Evaluation'][$key];
            }
        }

        arsort($scoresArray);
        $topForces = array_slice($scoresArray, 0, 3, true);

        asort($scoresArray);
        $topAxes = array_slice($scoresArray, 0, 3, true);

        $this->set(compact('evaluation', 'historyDates', 'historyScores', 'topForces', 'topAxes'));
    }

    // =========================================================================
    // ADD - Ajouter une évaluation pour un VMP spécifique
    // =========================================================================
    public function add($user_id = null)
    {
        // Sécurité : vérifier que le superviseur a le droit d'évaluer ce VMP
        if ($user_id) {
            $this->_checkTeamAccess($user_id);
        }

        if ($this->request->is('post')) {
            $this->Evaluation->create();
            $this->request->data['Evaluation']['chef_id'] = AuthComponent::user('id');

            // Backwards compat
            if (!empty($this->request->data['Evaluation']['user_id'])) {
                $this->request->data['Evaluation']['user1_id'] = AuthComponent::user('id');
            }

            if ($this->Evaluation->save($this->request->data)) {
                $this->Session->setFlash(__('Evaluation ajoutée avec succès !'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Erreur lors de l\'enregistrement de l\'évaluation.'), 'default', array('class' => 'alert alert-danger'));
            }
        }

        // Récupérer les infos du VMP à évaluer
        $this->Evaluation->User->recursive = -1;
        $user = $this->Evaluation->User->findById($user_id);
        $this->set(compact('user'));
    }

    // =========================================================================
    // EDIT - Modifier une évaluation existante
    // =========================================================================
    public function edit($id = null)
    {
        if (!$this->Evaluation->exists($id)) {
            throw new NotFoundException(__('Evaluation invalide'));
        }

        // Charger l'évaluation pour vérifier l'accès
        $options = array('conditions' => array('Evaluation.' . $this->Evaluation->primaryKey => $id));
        $existingEval = $this->Evaluation->find('first', $options);

        // Sécurité : vérifier que le VMP appartient à l'équipe
        $this->_checkTeamAccess($existingEval['Evaluation']['user_id']);

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Evaluation->save($this->request->data)) {
                $this->Session->setFlash(__('Evaluation modifiée avec succès'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'historique'));
            } else {
                $this->Session->setFlash(__('Erreur lors de la modification.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $this->request->data = $existingEval;
        }

        $user_id = $this->request->data['Evaluation']['user_id'];
        $user = $this->Evaluation->User->findById($user_id);
        $this->set(compact('user', 'id'));
    }

    // =========================================================================
    // ARCHIVE - Archiver / Activer une évaluation
    // =========================================================================
    public function archive($id = null, $valide = null)
    {
        if ($id == null) {
            $this->Evaluation->recursive = 0;
            $this->set('evaluations', $this->Evaluation->find('all', array('conditions' => array('Evaluation.archive' => 0))));
        } else {
            $this->Evaluation->id = $id;
            $this->Evaluation->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Evaluation Archivée'), 'default', array('class' => 'alert alert-warning'));
                return $this->redirect(array('action' => 'historique'));
            } else {
                $this->Session->setFlash(__('Evaluation activée'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }

    // =========================================================================
    // SYSTÈME : Récupérer la dernière évaluation d'un utilisateur
    // =========================================================================
    function system_dernier_evaluation($user_id)
    {
        $this->Evaluation->recursive = -1;
        $count = $this->Evaluation->find('count', array(
            'conditions' => array('Evaluation.user_id' => $user_id, 'Evaluation.archive' => 1)
        ));
        $user = $this->Evaluation->find('first', array(
            'conditions' => array('Evaluation.user_id' => $user_id, 'Evaluation.archive' => 1),
            'order' => array('Evaluation.created desc')
        ));
        if ($count == 0) {
            $user['Evaluation']['note'] = '';
            $user['Evaluation']['created'] = '';
        }
        $user['Evaluation']['count'] = $count;
        return $user;
    }

    // =========================================================================
    // SYSTÈME : Récupérer les évaluations d'un utilisateur (avec filtre date)
    // =========================================================================
    function system_get_evalusation_for_user($user_id, $date_debut = null, $date_fin = null)
    {
        if ($date_debut == null) {
            $eva = $this->Evaluation->find('all', array(
                'conditions' => array('Evaluation.user_id' => $user_id, 'Evaluation.archive' => 1),
                'order' => array('Evaluation.created desc')
            ));
        } else {
            $eva = $this->Evaluation->find('all', array(
                'conditions' => array(
                    'Evaluation.user_id' => $user_id,
                    'Evaluation.archive' => 1,
                    "DATE(Evaluation.created)>='" . $date_debut . "' and DATE(Evaluation.created)<='" . $date_fin . "'"
                ),
                'order' => array('Evaluation.created desc')
            ));
        }
        return $eva;
    }
}
