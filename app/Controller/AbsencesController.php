<?php
App::uses('AppController', 'Controller');
App::import('Controller', 'jourferiers');

class AbsencesController extends AppController
{

    function calendrier()
    {
        $this->loadModel("User");
        $this->User->recursive = -1;

        $role = AuthComponent::user('role');
        $userId = AuthComponent::user('id');
        $absences = [];
        $ids = [];

        if ($this->request->is('post') || $this->request->is('put')) {
            if (in_array($role, ['VMP', 'Coordinateur'])) {
                $ids[] = $userId;
            } elseif ($role === 'Super viseur') {
                // Add supervisor's own ID first
                $ids[] = $userId;

                $this->User->Apartient->recursive = -1;
                foreach ($this->request->data['Absence']['vmp_id'] as $vmpId) {
                    $exists = $this->User->Apartient->find('count', [
                        'conditions' => [
                            'Apartient.user_id' => $userId,
                            'Apartient.user1_id' => $vmpId
                        ]
                    ]);
                    if ($exists == 0) {
                        $ids[] = $vmpId;
                    }
                }
            } else {
                foreach ($this->request->data['Absence']['vmp_id'] as $vmpId) {
                    $ids[] = $vmpId;
                }
            }
        } else {
            $ids[] = $userId;
            if (in_array($role, ['Admin', "Responsable promotion", "Ressource humain"])) {
                $ids = $this->User->find('list', [
                    'conditions' => [
                        'User.archive' => 1,
                        'User.role IN' => ["VMP", "Super viseur", "Coordinateur"]
                    ]
                ]);
                $ids = array_keys($ids);
            } elseif ($role === 'Super viseur') {
                // Add supervisor's own ID first
                $ids[] = $userId;

                $this->User->Apartient->recursive = -1;
                $rows = $this->User->Apartient->find('list', [
                    'fields' => ['Apartient.user1_id'],
                    'conditions' => ['Apartient.user_id' => $userId]
                ]);
                // Add team members
                $teamIds = array_values($rows);
                $ids = array_merge($ids, $teamIds);
            }
        }

        $absences = $this->Absence->find("all", [
            "fields" => ["Absence.*", "User.name"],
            "conditions" => ["Absence.user_id" => $ids],
            "order" => ["Absence.date_debut" => "DESC"]
        ]);

        $vmps = [];
        if ($role === 'Super viseur') {
            $this->User->Apartient->recursive = -1;
            $rows = $this->User->Apartient->find('list', [
                'fields' => ['Apartient.user1_id'],
                'conditions' => ['Apartient.user_id' => $userId]
            ]);
            $teamIds = array_values($rows);
            $vmps = $this->User->find('list', ['conditions' => ['User.archive' => 1, "User.id IN" => $teamIds]]);
        } elseif (in_array($role, ['Admin', "Responsable promotion", "Ressource humain"])) {
            $vmps = $this->User->find('list', ['conditions' => ['User.archive' => 1, "User.role IN" => ["VMP", "Super viseur", "Coordinateur"]]]);
        }

        $this->loadModel('Jourferier');
        $jourferies = $this->Jourferier->find('all');

        // --- Construction des données calendrier ---
        $colors = [];
        $data = [];

        foreach ($absences as $a) {
            $abs = $a['Absence'];
            $usr = $a['User']['name'];
            // Couleur unique par type
            if (!isset($colors[$abs['type']])) {
                $colors[$abs['type']] = $this->system_color($abs['type']);
            }

            // Dates
            $jour = $abs['part_jour'];
            $start = $abs['date_debut'];
            $end = $abs['date_fin'];

            if (empty($jour)) {
                $jour = (strtotime($end) - strtotime($start)) / 86400;
            } else {
                $date = $abs['date_debut'];
                $times = [
                    "1/4" => ["08:00:00", "12:00:00"],
                    "1/2" => ["08:00:00", "12:00:00"],
                    "3/4" => ["08:00:00", "15:00:00"],
                    "1" => ["00:00:00", "23:59:59"]
                ];
                if (isset($times[$jour])) {
                    $s = $times[$jour][0];
                    $e = $times[$jour][1];
                    $start = "$date $s";
                    $end = "$date $e";
                }
            }

            $data[] = [
                'id' => $abs['id'],
                'title' => $abs['titre'],
                'type' => $abs['type'],
                'description' => "", //$abs['description'],
                'start' => $start,
                'date_debut' => $abs['date_debut'],
                'end' => $end,
                'date_fin' => $abs['date_fin'],
                'jour' => $jour,
                'user' => $usr,
                'backgroundColor' => $colors[$abs['type']],
                'borderColor' => $colors[$abs['type']]
            ];
        }

        // Ajouter les jours fériés
        foreach ($jourferies as $jf) {
            $data[] = [
                'id' => $jf['Jourferier']['id'],
                'title' => 'Jour férié: ' . $jf['Jourferier']['name'],
                'type' => 'Jour férié',
                'description' => $jf['Jourferier']['name'],
                'start' => $jf['Jourferier']['date_debut'] . ' 00:00:00',
                'date_debut' => $jf['Jourferier']['date_debut'],
                'end' => $jf['Jourferier']['date_fin'] . ' 23:59:59',
                'date_fin' => $jf['Jourferier']['date_fin'],
                'jour' => 1,
                'user' => 'Tous',
                'backgroundColor' => '#FF0000',
                'borderColor' => '#FF0000'
            ];
        }


        usort($data, function ($a, $b) {
            $dateA = strtotime($a['date_debut']);
            $dateB = strtotime($b['date_debut']);

            // Sort by date_debut DESC (newest first)
            if ($dateA == $dateB) {
                return 0;
            }
            return ($dateA > $dateB) ? -1 : 1;
        });

        $absences = $data;

        $this->set(compact('colors', 'absences', 'vmps'));
    }
    function index($user_id = null) {}

    public function add()
    {
        if ($this->request->is('post')) {
            $this->request->data['Absence']['user_id'] = AuthComponent::user('id');
            $this->request->data['Absence']['type'] = $this->request->data['Absence']['titre'];

            if ($this->request->data['Absence']['type'] == "Autre") {
                $this->request->data['Absence']['type'] = $this->request->data['Absence']['autre_titre'];
            }

            $super = $this->requestAction('/users/system_get_superviseur/' . AuthComponent::user('id'));
            if (AuthComponent::user('role') == "Super viseur") {
                $super = $this->requestAction('/users/system_get_promotion/');
            }

            // Normalize $super to always have User.id, User.name, User.username
            if (empty($super) || !isset($super['User']['id'])) {
                $super = [
                    'User' => [
                        'id'       => 1,
                        'name'     => 'Administrateur',
                        'username' => 'admin@esnapharm.com', // fallback email
                    ]
                ];
            }

            $this->Absence->create();
            if ($this->Absence->save($this->request->data)) {
                $this->loadModel('Boitemail');
                $this->Boitemail->create();
                $d['Boitemail']['user_id'] = $super['User']['id'];
                $d['Boitemail']['user1_id'] = 0;
                $d['Boitemail']['titre'] = "Déclaration d'une activité hors terrain par " . AuthComponent::user('name');

                // Check if it's a partial day or full day(s)
                if (!empty($this->request->data['Absence']['part_jour'])) {
                    // Partial day - use part_jour value
                    $fin = "• Durée : " . $this->request->data['Absence']['part_jour'] . " journée";
                } else {
                    // Full day(s) - calculate duration
                    $dateDebut = new DateTime($this->request->data['Absence']['date_debut']);
                    $dateFin = new DateTime($this->request->data['Absence']['date_fin']);

                    // Calculate difference in days
                    $interval = $dateDebut->diff($dateFin);
                    $nombreJours = $interval->days;

                    $fin = "• Date de reprise : " . $this->request->data['Absence']['date_fin'] . "\n";
                    $fin .= "• Durée : " . $nombreJours . " jour" . ($nombreJours > 1 ? "s" : "");
                }

                $d['Boitemail']['message'] = "
                Bonjour " . $super['User']['name'] . ",
                Le délégué " . AuthComponent::user('name') . " vient de déclarer une activité hors terrain dans le CRM.
                Détails :
                • Date d'arrêt : " . $this->request->data['Absence']['date_debut'] . "
                $fin
                • Motif : " . $this->request->data['Absence']['type'] . "
                Merci de prendre en compte cette information.
                Cordialement,
                Système CRM – Esnapharm / Valpharma";

                $this->Boitemail->save($d);

                App::uses('CakeEmail', 'Network/Email');
                $Email = new CakeEmail();
                $Email->to($super['User']['username']);
                $Email->from('crm@esnapharm.com');
                $Email->subject($d['Boitemail']['titre']);
                $Email->send($d['Boitemail']['message']);

                $this->Session->setFlash(__('Demande d\'absence ajoutée'));
                return $this->redirect(array('action' => 'calendrier'));
            } else {
                $this->Session->setFlash(__('L\'absence n\'a pas pu être enregistrée. Merci de réessayer.'));
            }
        }
    }

    public function edit($id = null)
    {
        if (!$this->Absence->exists($id)) {
            throw new NotFoundException(__('Absence invalide'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            // Set the ID to ensure we're updating the correct record
            $this->request->data['Absence']['id'] = $id;

            // Handle type field
            $this->request->data['Absence']['type'] = $this->request->data['Absence']['titre'];
            if ($this->request->data['Absence']['type'] == "Autre") {
                $this->request->data['Absence']['type'] = $this->request->data['Absence']['autre_titre'];
            }

            // Clear date_fin if part_jour is set (partial day absence)
            if (!empty($this->request->data['Absence']['part_jour'])) {
                $this->request->data['Absence']['date_fin'] = null;
            } else {
                // Clear part_jour if it's a full day absence
                $this->request->data['Absence']['part_jour'] = null;
            }

            if ($this->Absence->save($this->request->data)) {
                $this->Session->setFlash(__('Demande d\'absence modifiée'));
                return $this->redirect(array('action' => 'calendrier'));
            } else {
                $this->Session->setFlash(__('L\'absence n\'a pas pu être modifiée. Merci de réessayer.'));
            }
        } else {
            // GET request - load existing data for editing
            $this->request->data = $this->Absence->findById($id);

            // If type is not in the predefined list, it means it's "Autre"
            $predefinedTypes = array('Congés', 'Formations', 'Congrès', 'Réunions', 'Journée administrative', 'Maladie', 'Délai de route (déplacements inter-régionaux)');

            if (!in_array($this->request->data['Absence']['type'], $predefinedTypes)) {
                $this->request->data['Absence']['autre_titre'] = $this->request->data['Absence']['type'];
                $this->request->data['Absence']['titre'] = 'Autre';
            } else {
                $this->request->data['Absence']['titre'] = $this->request->data['Absence']['type'];
            }
        }
    }


    function supprimer($id = null)
    {
        if (!$this->Absence->exists($id)) {
            throw new NotFoundException(__('Absence invalide'));
        }
        $this->Absence->id = $id;
        $this->Absence->delete();
        $this->Session->setFlash(__('Demande d\'absence supprimée'));
        return $this->redirect(array('action' => 'calendrier'));
    }


    function system_color($type)
    {
        // Créer un nombre basé sur le nom du type
        $hash = crc32($type);
        // Utiliser ce nombre pour générer une teinte (0-360° sur la roue de couleurs)
        $hue = $hash % 360;
        // Fixer saturation et luminosité pour garder des couleurs claires et lisibles
        $saturation = 70; // %
        $lightness = 70; // %
        return "hsl($hue, {$saturation}%, {$lightness}%)";
    }


    public function system_get_jour_absence($userId = 0, $periodeDebut = '', $periodeFin = '')
    {
        $this->loadModel('Jourferier');
        $this->loadModel('Absence');
        $this->loadModel('Objectif');

        // Fractions possibles pour absences partielles
        $fractions = array('1/4' => 0.25, '1/2' => 0.5, '3/4' => 0.75, '1' => 1);

        // --- 1. Liste des jours fériés (ouvrés uniquement)
        $joursFeries = array();
        $feries = $this->Jourferier->find('all', array(
            'fields' => array('date_debut', 'date_fin'),
            'conditions' => array(
                'OR' => array(
                    array('date_debut BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('date_fin BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('AND' => array('date_debut <=' => $periodeDebut, 'date_fin >=' => $periodeFin))
                )
            )
        ));
        foreach ($feries as $f) {
            $tDebut = strtotime($f['Jourferier']['date_debut']);
            $tFin = strtotime($f['Jourferier']['date_fin']);
            for ($t = $tDebut; $t <= $tFin; $t += 86400) {
                if (date('N', $t) <= 5) {
                    $joursFeries[date('Y-m-d', $t)] = 1;
                }
            }
        }

        // --- 2. Récupérer absences utilisateur
        $absences = $this->Absence->find('all', array(
            'fields' => array('date_debut', 'date_fin', 'part_jour'),
            'conditions' => array(
                'user_id' => $userId,
                'archive !=' => 0,
                'OR' => array(
                    array('date_debut BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('date_fin BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('AND' => array('date_debut <=' => $periodeDebut, 'date_fin >=' => $periodeFin))
                )
            ),
            'recursive' => -1
        ));

        // --- 3. Construire tableau des absences (inclut les fériés déjà marqués à 1)
        $joursAbsence = $joursFeries;

        foreach ($absences as $a) {
            $debut = max($a['Absence']['date_debut'], $periodeDebut);
            $fin = $a['Absence']['date_fin'];
            if (empty($fin))
                $fin = $a['Absence']['date_debut'];
            $fin = min($fin, $periodeFin);

            $fraction = 1;
            if ($debut == $fin && !empty($a['Absence']['part_jour']) && isset($fractions[$a['Absence']['part_jour']])) {
                $fraction = $fractions[$a['Absence']['part_jour']];
            }

            $t = strtotime($debut);

            do {
                $date = date('Y-m-d', $t);
                if (date('N', $t) <= 5) {
                    if (isset($joursAbsence[$date])) {
                        $joursAbsence[$date] = 1;
                    } else {
                        $existante = isset($joursAbsence[$date]) ? $joursAbsence[$date] : 0;
                        $joursAbsence[$date] = max($existante, $fraction);
                    }
                }
                $t += 86400;
            } while ($t <= strtotime($fin));
        }

        // --- 4. Totaux absences
        $total = array_sum($joursAbsence);
        $joursEntiers = floor($total);
        $reste = $total - $joursEntiers;
        if ($reste >= 0.75) {
            $fractionFinale = '3/4';
        } elseif ($reste >= 0.5) {
            $fractionFinale = '1/2';
        } elseif ($reste >= 0.25) {
            $fractionFinale = '1/4';
        } else {
            $fractionFinale = '0';
        }

        // --- 5. Jours ouvrés de la période
        $joursOuvres = 0;
        for ($t = strtotime($periodeDebut); $t <= strtotime($periodeFin); $t += 86400) {
            if (date('N', $t) <= 5) {
                $joursOuvres++;
            }
        }
        $joursTravailles = $joursOuvres - $total;

        // --- 6. Objectifs ajustés aux jours travaillés
        $objectifs = array("Type" => array(), "Total_objectif" => 0);
        $objectifsdata = $this->Objectif->find("all", array(
            "conditions" => array("Objectif.user_id" => $userId),
            "recursive" => -1
        ));
        foreach ($objectifsdata as $o) {
            $parJour = round($o["Objectif"]["objectif"] / 5, 0);
            $val = $parJour * $joursTravailles;
            $objectifs["Type"][$o["Objectif"]["type_id"]] = $val;
            $objectifs["Total_objectif"] += $val;
        }

        // --- 7. Résultat
        return array_merge(array(
            'jours' => $joursEntiers,
            'fraction' => $fractionFinale,
            'total' => round($total, 2),
            'jours_ouvres' => $joursOuvres,
            'jours_travailles' => $joursTravailles,
            'debug_detail' => $joursAbsence
        ), $objectifs);
    }



    //hadi supprime les jours fériés de jours ouvrés
    public function system_get_jour_absence_joursferie($userId = 343, $periodeDebut = '2025-09-01', $periodeFin = '2025-09-30', $conditions_client_type_pour_absences = array())
    {
        $this->loadModel('Jourferier');
        $this->loadModel('Absence');
        $this->loadModel('Objectif');

        // Fractions possibles pour absences partielles
        $fractions = array('1/4' => 0.25, '1/2' => 0.5, '3/4' => 0.75, '1' => 1);

        // --- 1. Liste des jours fériés (ouvrés uniquement)
        $joursFeries = array();
        $feries = $this->Jourferier->find('all', array(
            'fields' => array('date_debut', 'date_fin'),
            'conditions' => array(
                'OR' => array(
                    array('date_debut BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('date_fin BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('AND' => array('date_debut <=' => $periodeDebut, 'date_fin >=' => $periodeFin))
                )
            )
        ));
        foreach ($feries as $f) {
            $tDebut = strtotime($f['Jourferier']['date_debut']);
            $tFin = strtotime($f['Jourferier']['date_fin']);
            for ($t = $tDebut; $t <= $tFin; $t += 86400) {
                if (date('N', $t) <= 5) {
                    $joursFeries[date('Y-m-d', $t)] = 1;
                }
            }
        }

        // --- 2. Récupérer absences utilisateur
        $absences = $this->Absence->find('all', array(
            'fields' => array('date_debut', 'date_fin', 'part_jour'),
            'conditions' => array(
                'user_id' => $userId,
                'archive !=' => 0,
                'OR' => array(
                    array('date_debut BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('date_fin BETWEEN ? AND ?' => array($periodeDebut, $periodeFin)),
                    array('AND' => array('date_debut <=' => $periodeDebut, 'date_fin >=' => $periodeFin))
                )
            ),
            'recursive' => -1
        ));
        // debug($absences);
        // --- 3. Construire tableau des absences (inclut les fériés déjà marqués à 1)
        $joursAbsence = []; //$joursFeries;

        foreach ($absences as $a) {
            $debut = max($a['Absence']['date_debut'], $periodeDebut);
            $fin = $a['Absence']['date_fin'];
            if (empty($fin))
                $fin = $a['Absence']['date_debut'];
            $fin = min($fin, $periodeFin);

            $fraction = 1;
            if ($debut == $fin && !empty($a['Absence']['part_jour']) && isset($fractions[$a['Absence']['part_jour']])) {
                $fraction = $fractions[$a['Absence']['part_jour']];
            }

            $t = strtotime($debut);

            do {
                $date = date('Y-m-d', $t);
                if (isset($joursFeries[$date])) {
                    $t += 86400;
                    continue;
                }
                if (date('N', $t) <= 5) {
                    if (isset($joursAbsence[$date])) {
                        $joursAbsence[$date] = 1;
                    } else {
                        $existante = isset($joursAbsence[$date]) ? $joursAbsence[$date] : 0;
                        $joursAbsence[$date] = max($existante, $fraction);
                    }
                }
                $t += 86400;
            } while ($t < strtotime($fin));
        }

        // --- 4. Totaux absences
        $total = array_sum($joursAbsence);
        $joursEntiers = floor($total);
        $reste = $total - $joursEntiers;
        if ($reste >= 0.75) {
            $fractionFinale = '3/4';
        } elseif ($reste >= 0.5) {
            $fractionFinale = '1/2';
        } elseif ($reste >= 0.25) {
            $fractionFinale = '1/4';
        } else {
            $fractionFinale = '0';
        }

        // --- 5. Jours ouvrés de la période
        $joursOuvres = 0;
        $tDebut = strtotime($periodeDebut);
        $tFin = strtotime($periodeFin);
        for ($t = $tDebut; $t <= $tFin; $t += 86400) {
            if (date('N', $t) <= 5) {
                if (isset($joursFeries[date('Y-m-d', $t)])) {
                    continue; // skip this holiday
                }
                $joursOuvres++;
            }
        }
        $joursTravailles = $joursOuvres - $total;

        // --- 6. Objectifs ajustés aux jours travaillés
        $objectifs = array("Type" => array(), "Total_objectif" => 0);
        $objectifsdata = $this->Objectif->find("all", array(
            "conditions" => array($conditions_client_type_pour_absences, "Objectif.user_id" => $userId),
            "recursive" => -1
        ));
        //debug($objectifsdata);exit();
        foreach ($objectifsdata as $o) {
            $parJour = round($o["Objectif"]["objectif"] / 5, 0);
            $val = $parJour * $joursTravailles;
            $objectifs["Type"][$o["Objectif"]["type_id"]] = $val;
            $objectifs["Total_objectif"] += $val;
        }
        // --- 7. Résultat
        return array_merge(array(
            'jours' => $joursEntiers,
            'fraction' => $fractionFinale,
            'total' => round($total, 2),
            'jours_ouvres' => $joursOuvres,
            'jours_travailles' => $joursTravailles,
            'debug_detail' => $joursAbsence
        ), $objectifs);
    }
}
