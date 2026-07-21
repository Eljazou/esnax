<?php

App::uses('AppController', 'Controller');

/**
 * Secteurs Controller
 *
 * @property Secteur $Secteur
 * @property PaginatorComponent $Paginator
 */
class SecteursController extends AppController
{

    public $components = array('Paginator');

    public function index()
    {
        $this->Secteur->recursive = -1;
        $secteurs = array();
        if (AuthComponent::user('role') == "Super viseur") {
            if (AuthComponent::user('secteur_id') != null) {
                $secteur = $this->Secteur->findById(AuthComponent::user('secteur_id'));
                $secteurs = $this->Secteur->find("all", array("conditions" => array('Secteur.archive=1', 'Secteur.region' => $secteur["Secteur"]["region"])));
            }
        } else {
            $secteurs = $this->Secteur->find("all", array("conditions" => array('Secteur.archive=1')));
        }

        // Compter les clients par secteur — UNE seule requête GROUP BY
        $this->loadModel('Client');
        $this->Client->recursive = -1;
        $clientCounts = $this->Client->find('all', array(
            'fields' => array('Client.secteur_id', 'COUNT(Client.id) AS nb_clients'),
            'conditions' => array('Client.archive' => 1),
            'group' => array('Client.secteur_id')
        ));
        // Indexer par secteur_id pour accès rapide
        $counts = array();
        foreach ($clientCounts as $c) {
            $counts[$c['Client']['secteur_id']] = $c[0]['nb_clients'];
        }

        $this->set('secteurs', $secteurs);
        $this->set('clientCounts', $counts);
    }

    public function view($id = null, $type = null)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(250);
        $this->loadModel('Type');
        $this->Type->recursive = -1;
        $this->set('types', $this->Type->find('list'));
        if ($type == null || $type == 'secteur') {
            if (!$this->Secteur->exists($id)) {
                throw new NotFoundException(__('Secteur invalide'));
            }
            $options = array('conditions' => array('Secteur.' . $this->Secteur->primaryKey => $id));
            $secteur = $this->Secteur->find('all', $options);
            $this->set('type', 'secteur');
        } else if ($type == 'region') {
            $options = array('conditions' => array('Secteur.code_region' => $id));
            $secteur = $this->Secteur->find('all', $options);
            $this->set('type', 'region');
        } else if ($type == 'ville') {
            $options = array('conditions' => array('Secteur.code_ville' => $id));
            $secteur = $this->Secteur->find('all', $options);
            $this->set('type', 'ville');
        } else if ($type == 'all') {
            $secteur = $this->Secteur->find('all');
            $this->set('type', 'ville');
        }
        foreach ($secteur as $value) {
            foreach ($value['Client'] as $v)
                $secteur['Client'][] = $v;
        }
        $ids = "0";
        foreach ($secteur['Client'] as $client)
            $ids = $ids . "," . $client['id'];
        $options = array(
            'conditions' => array("Client.archive" => 1, "Client.id in($ids)"),
            'fields' => array('Client.id', 'Client.type_id', 'Client.nom', 'Client.prenom', 'Client.activite', 'Client.type_pharmacie', 'Client.titre', 'Client.potentialitev2', 'Client.potentialite', 'Client.latitude', 'Client.longitude', 'Type.name', 'Category.name', 'Category1.name'),
            'recursive' => 0
        );
        $this->loadModel('Client');
        $clients = $this->Client->find("all", $options);
        $this->loadModel('Affectation');
        $options = array('conditions' => array("Affectation.client_id in($ids) and Liste.archive=1 and Affectation.valide =1"), 'fields' => array('Affectation.client_id', 'Liste.id', 'Liste.name'), 'recursive' => 0);
        $aff = $this->Affectation->find("all", $options);
        for ($i = 0; $i < count($clients); $i++) {
            foreach ($aff as $f) {
                if ($f["Affectation"]["client_id"] == $clients[$i]['Client']['id']) {
                    $clients[$i]['Liste'] = $f["Liste"];
                    break;
                }
            }
        }
        $secteur['Client'] = $clients;

        // --- PRE-CALCULATE AGGREGATED DATA FOR THE VIEW --- 
        $polygonArray = array();
        if (!empty($secteur[0]['Secteur']['gps'])) {
            $polygonArray = json_decode($secteur[0]['Secteur']['gps'], true);
        }

        $typesCounts = array();
        $potsCounts = array();
        $potsV2Counts = array();
        $specialites = array();
        $scoreByType = array(
            'Total' => array('count' => 0, 'in_zone' => 0, 'out_zone' => 0, 'no_gps' => 0)
        );
        $jsClients = array();
        $jsClientsMap = array();

        // --- MANAGE DATES FOR VISITS FILTER ---
        $dateDebut = date('Y-m-01');
        $dateFin = date('Y-m-t');
        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->request->data['Secteur']['date_debut'])) {
                $dateDebut = $this->request->data['Secteur']['date_debut'];
            }
            if (!empty($this->request->data['Secteur']['date_fin'])) {
                $dateFin = $this->request->data['Secteur']['date_fin'];
            }
        } elseif (isset($this->request->query['date_debut'])) {
            $dateDebut = $this->request->query['date_debut'];
            $dateFin = $this->request->query['date_fin'];
        }

        // --- CLIENT MAP TO GET COORDS QUICKLY ---
        $clientGpsMap = array();

        foreach ($secteur['Client'] as &$clientData) {
            $c = $clientData['Client'];
            $cat = isset($clientData['Category']['name']) ? $clientData['Category']['name'] : '';
            
            // Clean type encoding directly
            $rawType = isset($clientData['Type']['name']) ? $clientData['Type']['name'] : '';
            $type = (strpos($rawType, 'Ã') !== false) ? utf8_decode($rawType) : $rawType;
            if (empty($type)) $type = 'Autre';
            
            if (!isset($scoreByType[$type])) {
                $scoreByType[$type] = array('count' => 0, 'in_zone' => 0, 'out_zone' => 0, 'no_gps' => 0);
            }
            
            // GPS calc
            $hasGps = (!empty($c['latitude']) && !empty($c['longitude']) && $c['latitude'] != '0' && $c['longitude'] != '0');
            $inZone = false;
            $cLat = 0;
            $cLng = 0;
            
            if ($hasGps) {
                $cLat = (float)str_replace(',', '.', $c['latitude']);
                $cLng = (float)str_replace(',', '.', $c['longitude']);
                if (!empty($polygonArray)) {
                    $inZone = $this->system_isPointInPolygon(array($cLat, $cLng), $polygonArray);
                }
            }
            
            // Add custom flags to Client array to simplify the View
            $clientData['Client']['hasGps'] = $hasGps;
            $clientData['Client']['inZone'] = $inZone;
            
            // Save to map for visits distance calculation
            $clientGpsMap[$c['id']] = array('lat' => $cLat, 'lng' => $cLng, 'hasGps' => $hasGps, 'nom' => $c['nom'] . ' ' . $c['prenom']);
            
            // Score calculations
            $scoreByType['Total']['count']++;
            $scoreByType[$type]['count']++;
            
            if ($hasGps) {
                if ($inZone) {
                    $scoreByType['Total']['in_zone']++;
                    $scoreByType[$type]['in_zone']++;
                } else {
                    $scoreByType['Total']['out_zone']++;
                    $scoreByType[$type]['out_zone']++;
                }
            } else {
                $scoreByType['Total']['no_gps']++;
                $scoreByType[$type]['no_gps']++;
            }
            
            if (!isset($typesCounts[$type])) $typesCounts[$type] = 0;
            $typesCounts[$type]++;
            
            $pot = $c['potentialite'];
            if (!empty($pot)) {
                if (!isset($potsCounts[$pot])) $potsCounts[$pot] = 0;
                $potsCounts[$pot]++;
            }
            
            $potv2 = $c['potentialitev2'];
            if (!empty($potv2)) {
                if (!isset($potsV2Counts[$potv2])) $potsV2Counts[$potv2] = 0;
                $potsV2Counts[$potv2]++;
            }

            // Specialites Matrix
            if (!empty($cat) && !empty($pot)) {
                if (!isset($specialites[$cat])) {
                    $specialites[$cat] = array('specialite' => $cat);
                }
                if (!isset($specialites[$cat][$pot])) {
                    $specialites[$cat][$pot] = 0;
                }
                $specialites[$cat][$pot]++;
            }

            // JS clients
            $typeKey = '';
            // Match specific wording from legacy code if any
            if ($type == 'Pharmacien') $typeKey = 'Pharmacie';
            elseif ($type == 'Médecin') $typeKey = 'Médecin';
            else $typeKey = $type;

            $jsClients[] = array(
                'id' => $c['id'],
                'type' => $typeKey,
                'nom' => $c['nom'] . ' ' . $c['prenom'],
                'spec' => $cat,
                'pot' => $pot,
                'potv2' => $potv2,
                'act' => $c['activite'],
                'hasGps' => $hasGps,
                'inZone' => $inZone,
                'titre' => $c['titre'],
                'latitude' => $c['latitude'],
                'longitude' => $c['longitude']
            );

            if ($hasGps) {
                $jsClientsMap[$c['id']] = array(
                    'lat' => (float)str_replace(',', '.', $c['latitude']),
                    'lng' => (float)str_replace(',', '.', $c['longitude']),
                    'type' => $typeKey,
                    'nom' => $c['nom'] . ' ' . $c['prenom'],
                    'spec' => $cat,
                    'pot' => $pot,
                    'act' => $c['activite'],
                    'inZone' => $inZone
                );
            }
        }

        $allPots = array_keys($potsCounts);
        sort($allPots);

        // Sort scoreByType descending by total count
        uasort($scoreByType, function ($a, $b) {
            return $b['count'] - $a['count'];
        });

        // Compute assignment stats
        $totalClients = count($secteur['Client']);
        $nbAffecter = 0;
        foreach ($secteur['Client'] as $client) {
            if (isset($client["Liste"])) $nbAffecter++;
        }

        // --- FETCH VISITS FOR THIS SECTOR'S CLIENTS ---
        $this->loadModel('Visite');
        $clientIdsArray = explode(',', $ids);
        if (empty($clientIdsArray) || (count($clientIdsArray) == 1 && $clientIdsArray[0] === '0')) {
            $clientIdsArray = array(0);
        }
        $visitesOptions = array(
            'conditions' => array(
                'Visite.client_id' => $clientIdsArray,
                'Visite.archive' => 1,
                'Visite.date >=' => $dateDebut . ' 00:00:00',
                'Visite.date <=' => $dateFin . ' 23:59:59'
            ),
            'recursive' => 0 // to pull User
        );
        $rawVisites = $this->Visite->find('all', $visitesOptions);

        $visitesStats = array(
            'total' => 0,
            'vraie' => 0,
            'fausse' => 0,
            'vraie_in' => 0,
            'vraie_out' => 0,
            'no_gps' => 0
        );
        
        $tableVisites = array();
        $jsVisitesMap = array();

        foreach ($rawVisites as $v) {
            $visitesStats['total']++;
            $clientId = $v['Visite']['client_id'];
            $clientInfo = isset($clientGpsMap[$clientId]) ? $clientGpsMap[$clientId] : null;

            $vLat = !empty($v['Visite']['latitude']) ? (float)str_replace(',', '.', $v['Visite']['latitude']) : 0;
            $vLng = !empty($v['Visite']['longitude']) ? (float)str_replace(',', '.', $v['Visite']['longitude']) : 0;
            $hasVGps = ($vLat != 0 && $vLng != 0);

            $distanceStr = 'N/A';
            $isVraie = false;
            $isVraieInZone = false;

            if ($clientInfo && $clientInfo['hasGps'] && $hasVGps) {
                // Calculate distance manually
                $distKm = $this->_distanceKm($clientInfo['lat'], $clientInfo['lng'], $vLat, $vLng);
                $distMeters = round($distKm * 1000);
                $distanceStr = $distMeters . ' m';

                if ($distMeters <= 500) {
                    $isVraie = true;
                    $visitesStats['vraie']++;
                    
                    // Check if visit point is inside sector polygon
                    $isVraieInZone = $this->system_isPointInPolygon(array($vLat, $vLng), $polygonArray);
                    if ($isVraieInZone) {
                        $visitesStats['vraie_in']++;
                    } else {
                        $visitesStats['vraie_out']++;
                    }
                } else {
                    $visitesStats['fausse']++;
                }

                // Add to map JS array
                $jsVisitesMap[] = array(
                    'id' => $v['Visite']['id'],
                    'lat' => $vLat,
                    'lng' => $vLng,
                    'user' => isset($v['User']['name']) ? $v['User']['name'] : 'Inconnu',
                    'client' => $clientInfo['nom'],
                    'date' => isset($v['Visite']['date']) ? $v['Visite']['date'] : 'N/A',
                    'isVraie' => $isVraie,
                    'inZone' => $isVraieInZone
                );

            } else {
                $visitesStats['no_gps']++;
            }

            // For data table
            $tableVisites[] = array(
                'id' => $v['Visite']['id'],
                'user' => isset($v['User']['name']) ? $v['User']['name'] : 'Inconnu',
                'client' => $clientInfo ? $clientInfo['nom'] : 'N/A',
                'date' => isset($v['Visite']['date']) ? $v['Visite']['date'] : 'N/A',
                'comment' => isset($v['Visite']['commentaire']) ? $v['Visite']['commentaire'] : (isset($v['Visite']['description']) ? $v['Visite']['description'] : ''),
                'distance' => $distanceStr,
                'isVraie' => $isVraie,
                'inZone' => $isVraieInZone,
                'hasGps' => ($clientInfo && $clientInfo['hasGps'] && $hasVGps)
            );
        }

        $this->set(compact('secteur', 'polygonArray', 'typesCounts', 'potsCounts', 'potsV2Counts', 'specialites', 'allPots', 'scoreByType', 'jsClients', 'jsClientsMap', 'totalClients', 'nbAffecter', 'dateDebut', 'dateFin', 'visitesStats', 'tableVisites', 'jsVisitesMap'));
    }

    protected function _distanceKm($lat1, $lon1, $lat2, $lon2)
    {
        if (empty($lat1) || empty($lon1) || empty($lat2) || empty($lon2)) return 0;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad((float)$lat1)) * sin(deg2rad((float)$lat2)) +  cos(deg2rad((float)$lat1)) * cos(deg2rad((float)$lat2)) * cos(deg2rad((float)$theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return round($miles * 1.609344, 3);
    }

    protected function system_isPointInPolygon($point, $polygon)
    {
        if (empty($polygon) || !is_array($polygon)) return false;
        $x = $point[0];
        $y = $point[1];
        $inside = false;
        $j = count($polygon) - 1;
        for ($i = 0; $i < count($polygon); $i++) {
            $xi = $polygon[$i][0];
            $yi = $polygon[$i][1];
            $xj = $polygon[$j][0];
            $yj = $polygon[$j][1];
            $intersect = (($yi > $y) != ($yj > $y))
                && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi + 0.0000001) + $xi);
            if ($intersect) {
                $inside = !$inside;
            }
            $j = $i;
        }
        return $inside;
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;

            // Si région existante sélectionnée, récupérer ses infos
            if (!empty($data['Secteur']['region_select']) && $data['Secteur']['region_select'] != '_new_') {
                $regionInfo = $this->Secteur->find('first', array(
                    'conditions' => array('Secteur.region' => $data['Secteur']['region_select']),
                    'fields' => array('region', 'region_ims', 'code_region')
                ));
                $data['Secteur']['region'] = $regionInfo['Secteur']['region'];
                $data['Secteur']['region_ims'] = $regionInfo['Secteur']['region_ims'];
                $data['Secteur']['code_region'] = $regionInfo['Secteur']['code_region'];
            } else {
                // Nouvelle région - code_region vide ou auto
                if (empty($data['Secteur']['code_region'])) {
                    $data['Secteur']['code_region'] = '';
                }
            }

            // Si ville existante sélectionnée, récupérer ses infos
            if (!empty($data['Secteur']['ville_select']) && $data['Secteur']['ville_select'] != '_new_') {
                $villeInfo = $this->Secteur->find('first', array(
                    'conditions' => array('Secteur.ville' => $data['Secteur']['ville_select'], 'Secteur.region' => $data['Secteur']['region']),
                    'fields' => array('ville', 'ville_ims', 'code_ville')
                ));
                $data['Secteur']['ville'] = $villeInfo['Secteur']['ville'];
                $data['Secteur']['ville_ims'] = $villeInfo['Secteur']['ville_ims'];
                $data['Secteur']['code_ville'] = $villeInfo['Secteur']['code_ville'];
            } else {
                if (empty($data['Secteur']['code_ville'])) {
                    $data['Secteur']['code_ville'] = '';
                }
            }

            // Code secteur vide si pas fourni
            if (empty($data['Secteur']['code_secteur'])) {
                $data['Secteur']['code_secteur'] = '';
            }

            // Nettoyage des champs select temporaires
            unset($data['Secteur']['region_select']);
            unset($data['Secteur']['ville_select']);

            // Vérifier doublon de secteur
            $doublon = $this->Secteur->find('count', array(
                'conditions' => array(
                    'Secteur.region' => $data['Secteur']['region'],
                    'Secteur.ville' => $data['Secteur']['ville'],
                    'Secteur.secteur' => $data['Secteur']['secteur']
                )
            ));

            if ($doublon > 0) {
                $this->Session->setFlash(__('Ce secteur existe déjà dans cette ville.'), 'default', array('class' => 'alert alert-danger'));
            } else {
                $this->Secteur->create();
                if ($this->Secteur->save($data)) {
                    $this->Session->setFlash(__('Secteur ajouté avec succès.'), 'default', array('class' => 'alert alert-success'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Le secteur n\'a pas pu être enregistré. Merci de réessayer.'), 'default', array('class' => 'alert alert-danger'));
                }
            }
        }

        // Charger toutes les données pour le formulaire
        $this->Secteur->recursive = -1;
        $allSecteurs = $this->Secteur->find('all', array(
            'conditions' => array('Secteur.archive' => 1),
            'fields' => array('id', 'region', 'region_ims', 'ville', 'ville_ims', 'secteur', 'secteur_ims'),
            'order' => array('Secteur.region ASC', 'Secteur.ville ASC', 'Secteur.secteur ASC')
        ));
        $this->set('allSecteurs', $allSecteurs);
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->Secteur->exists($id)) {
            throw new NotFoundException(__('Secteur invalide'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Secteur->save($this->request->data)) {
                $this->Session->setFlash(__('Secteur modifié'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Le secteur n\'a pas pu être modifié. Merci de réessayer.'));
            }
        } else {
            $options = array('conditions' => array('Secteur.' . $this->Secteur->primaryKey => $id));
            $this->request->data = $this->Secteur->find('first', $options);
        }
    }

    function temp()
    {
        $this->loadModel('Category');

        $this->Secteur->Client->recursive = -1;
        $this->Category->recursive = -1;
        $clients = $this->Secteur->Client->find('all', array('conditions' =>
        array('category_id is null')));
        foreach ($clients as $value) {
            $k = $this->Category->find('first', array('conditions' =>
            array('name' => $value['Client']['specialite'])));
            $this->Secteur->Client->id = $value['Client']['id'];
            $this->Secteur->Client->saveField('category_id', $k['Category']['id']);
        }
        exit();
    }

    function system_get_ville($region = 0, $ville = 0, $secteur = 0, $liste_id = null)
    {
        $this->Secteur->recursive = -1;
        if ($region != '0') {
            $region = explode('||', $region);
            $villes = $this->Secteur->find('all', array(
                'conditions' => array('Secteur.code_region' => $region[1]),
                'group' => array('Secteur.ville')
            ));
            echo '<label for="ClientCategoryId">Ville</label> <select name="data[Secteur][ville]" class="form-control" onchange="
            var id = $(this).val();
            $(\'#secteur\').empty();
            $(\'#secteur\').show();
            $.post(
                    \'/secteurs/system_get_ville/0/\' + id+\'/0/' . $liste_id . '\',
                    {
                        //id: $(\'#ChembreBlocId\').val()
                    },
                    function (data)
                    {
                        $(\'#secteur\').empty();
                        $(data).appendTo(\'#secteur\');
                        $(\'#secteur\').show();
                    },
                    \'text\' // type
                    );"> ';
            echo '<option  value="0">Choisissez une ville</option>';
            foreach ($villes as $value)
                echo '<option  value="' . $value['Secteur']['ville'] . '||' . $value['Secteur']['code_ville'] . '">' . $value['Secteur']['ville'] . '</option>';
            echo '</select>';
        } else if ($ville != '0') {
            $ville = explode('||', $ville);
            $secteurs = $this->Secteur->find('all', array('conditions' => array('Secteur.code_ville' => $ville[1])));
            echo '<label for="ClientCategoryId">Secteur</label> <select class="form-control" id="secteurs"
               onchange=\'
			  select();
            var id = $(this).val();
			var table = $("#example1").DataTable();
			var i;
			var notcheck = table.$("input:not(:checked)");
			notcheck.each(function(){
				$(this).parent().parent().addClass("select");
				table.row(".select").remove().draw( false );
			});
			var check = table.$("input:checkbox:checked");	
			var ncheck = check.length;
			$("th:eq(8) b").text("");
			$("th:eq(8) b").text(ncheck);
					if(ncheck<=70)
					$("thead th:eq(8) b").css("color", "black");
			if(ncheck>70 && ncheck<=80)
					$("thead th:eq(8) b").css("color", "#fde61d");
				if(ncheck>80)
					$("thead th:eq(8) b").css("color", "red");
            $.post(
                    "/secteurs/system_get_ville/0/0/" + id+"/' . $liste_id . '",
                    {
                    },
                    function (data)
                    {
						var datai;
						var json = data;
						var arrdata = $.parseJSON(json);
						for(var i=0; i<arrdata.length; i++){
								if(jQuery.inArray(arrdata[i][0],clientid) == -1){
										table.row.add( [
											arrdata[i][0],
											arrdata[i][1],
											arrdata[i][2],
											arrdata[i][3],
											arrdata[i][4],
											arrdata[i][5],
											arrdata[i][6],
											arrdata[i][7],
											arrdata[i][8]
										] ).draw( false );
								}									
							}
                    },
                    "text" // type
                    );
			\'> ';
            echo '<option value="0">Choisissez un secteur</option>';
            foreach ($secteurs as $value)
                echo '<option  value="' . $value['Secteur']['id'] . '">' . $value['Secteur']['secteur'] . '</option>';
            echo '</select>';
        } else if ($secteur != '0') {
            $this->loadModel('Liste');
            $this->Liste->recursive = -1;
            $this->Liste->Affectation->recursive = -1;
            $listes = $this->Liste->findById($liste_id);
            $listes = $this->Liste->find('list', array('conditions' => array('Liste.archive' => 1, 'Liste.user_id' => $listes['Liste']['user_id'])));
            $ids = 0;
            $idaussi = "";
            foreach ($listes as $key => $value) {
                if ($key != $liste_id)
                    $ids = $ids . ",$key";
            }

            //illiminer les clients qui sont dans les méme liste de user mais qui ne sont pas PCM et en action
            $affectations = $this->Liste->Affectation->find('all', array('conditions' => array("Affectation.liste_id in ($ids) and valide=1")));
            $affectationsids = 0;
            foreach ($affectations as $value) {
                $affectationsids = $affectationsids . "," . $value['Affectation']['client_id'];
            }
            $this->Secteur->Client->recursive = -1;
            $clients = $this->Secteur->Client->find('all', array(
                'fields' => array('Client.id', "Client.potentialitev2"),
                'conditions' => array('Client.archive' => 1, 'Client.secteur_id' => $secteur, "Client.id in($affectationsids)"),
                'order' => array('Client.potentialite asc')
            ));
            $this->loadModel('Action');
            $this->Action->recursive = -1;
            foreach ($clients as $value) {
                if ($value['Client']['potentialitev2'] != "PCM") {
                    $date = date('Y-m-d');
                    $action = $this->Action->find('count', array('conditions' => array(
                        'Action.client_id' => $value['Client']['id'],
                        "Action.date_debut<='$date'",
                        "Action.date_fin>='$date'"
                    )));
                    if ($action == 0)
                        $idaussi = $idaussi . $value['Client']['id'] . ",";
                }
            }
            //Illiminer la listes des clients dans d'autre liste des users
            $affectations = $this->Liste->Affectation->find('all', array('conditions' => array("Affectation.liste_id not in ($ids) and valide=1")));
            $ids = 0;
            foreach ($affectations as $value) {
                $ids = $ids . "," . $value['Affectation']['client_id'];
            }
            $this->Secteur->Client->recursive = 1;
            $clients = $this->Secteur->Client->find('all', array(
                'fields' => array('Client.id', 'Client.nom', 'Client.prenom', 'Client.activite', 'Client.potentialitev2', 'Type.name', 'Category.name', 'Secteur.secteur'),
                'conditions' => array('Client.archive' => 1, 'Client.secteur_id' => $secteur), //had la line qui permet pas double reseau,"Client.id not in($idaussi.$ids)"
                'order' => array('Client.potentialite asc'),
            ));


            $ids = explode(",", $ids);
            $idaussi = explode(",", $idaussi);
            for ($i = 0; $i < count($clients); $i++) {
                foreach ($ids as $c => $idd) {
                    if ($idd == $clients[$i]["Client"]["id"]) {
                        $clients[$i]["Client"]["affecter"] = "un autre VM";
                        break;
                    }
                }
                foreach ($idaussi as $c => $idd) {
                    if ($idd == $clients[$i]["Client"]["id"]) {
                        $clients[$i]["Client"]["affecter"] = "une autre liste";
                        break;
                    }
                }
            }
            $i = 0;
            $data = "[";
            foreach ($clients as $value) {
                $date = date('Y-m-d');
                $action = $this->Action->find('count', array('conditions' => array(
                    'Action.client_id' => $value['Client']['id'],
                    "Action.date_debut<='$date'",
                    "Action.date_fin>='$date'"
                )));
                $act = '';
                if (!isset($value['Client']['affecter']))
                    $value['Client']['affecter'] = "non";
                if ($action != 0)
                    $act = 'yes';
                $inp = '<input name=\"data[client][]\" type=\"checkbox\" value=\"' . $value['Client']['id'] . '\"><b style=\"visibility:hidden;font-size:0px;position:absolute;\">false</b>';
                $data = $data . '["' . $act . $value['Client']['id'] . '","' . $value['Type']['name'] . '","' . $value['Client']['nom'] . ' ' . $value['Client']['prenom'] . '","' . $value['Client']['activite'] . '","' . $value['Category']['name'] . '","' . $value['Client']['potentialitev2'] . '","' . $value['Secteur']['secteur'] . '","' . $value['Client']['affecter'] . '","' . $inp . '"],'; //"'.$value['Client']['id'].'",
                //echo '<li class="ui-state-default item'.$i.' li'.$value['Client']['id'].' '.$value['Type']['name'].$i++.'" '.$act.'>' . '<input name="data[client][]" type="hidden" value="'.$value['Client']['id'].'">'." ".$value['Category']['name'].' '.$value['Client']['nom'].' '.$value['Client']['prenom'].' (<b style="font-size:12px;">'.$value['Client']['potentialite'].'</b>)</li>';
            }
            $data = substr($data, 0, -1);
            echo "$data]";
        }
        exit();
    }

    function system_get_name($id = 0)
    {
        $this->Secteur->recursive = -1;
        $type = $this->Secteur->findById($id);
        return $type['Secteur']['region'] . " " . $type['Secteur']['ville'] . " " . $type['Secteur']['secteur'];
    }

    //function appler f chi une autre place
    //05/07/202
    //appel f controller rapportproepects line 
    function system_get_secteur($id = 0)
    {
        $this->Secteur->recursive = -1;
        $secteur = $this->Secteur->findById($id);
        return $secteur;
    }

    public function archive($id = null, $valide = null)
    {
        if ($id == null) {
            $this->Secteur->recursive = 0;
            $this->set('secteurs', $this->Secteur->find('all', array('conditions' => array('Secteur.archive' => 0))));
        } else {
            $this->Secteur->id = $id;
            $this->Secteur->saveField('archive', $valide);
            if ($valide == 0) {
                $this->Session->setFlash(__('Secteur Archivée'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Secteur activée'));
                return $this->redirect(array('action' => 'archive'));
            }
        }
    }

    //function appeler soulement dans users/view.ctp line 189 
    //input les id des villes format 0,2,5
    //out put tableau des secteurs
    function system_get_affectations_villes($ids = 0)
    {
        $this->Secteur->recursive = -1;
        return ($this->Secteur->find("all", array("conditions" => array("Secteur.id in($ids)"))));
    }


    public function delete($id = null)
    {
        $this->Secteur->id = $id;
        if (!$this->Secteur->exists()) {
            throw new NotFoundException(__('Invalid secteur'));
        }
        $this->request->onlyAllow('post', 'delete');
        $existe = $this->Secteur->Client->find("count", array("conditions" => array("Client.secteur_id" => $id)));
        if ($existe != 0) {
            $this->Session->setFlash("Secteur contient des clients, merci de les déplacés avant de supprimer le secteur");
            return $this->redirect(array('action' => 'view', $id));
        }

        if ($this->Secteur->delete()) {
            $this->Session->setFlash(__('La Secteur à été supprimer'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Secteur was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * Géocodage automatique de TOUS les secteurs sans GPS
     * Utilise Nominatim (OpenStreetMap) - Gratuit, pas de clé API
     * URL: /secteurs/geocode_all
     */
    public function geocode_all()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $this->autoRender = false;

        $this->Secteur->recursive = -1;

        // Trouver tous les secteurs sans GPS  
        $secteurs = $this->Secteur->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'Secteur.gps' => '',
                    'Secteur.gps IS NULL'
                ),
                'Secteur.archive' => 1
            ),
            'fields' => array('id', 'ville', 'secteur', 'region'),
            'order' => array('Secteur.ville ASC')
        ));

        $total = count($secteurs);
        $updated = 0;
        $errors = array();
        $cache = array(); // Cache par ville pour éviter les appels API redondants

        header('Content-Type: text/html; charset=utf-8');
        echo '<html><head><title>Géocodage des secteurs</title>';
        echo '<link rel="stylesheet" href="/labo/css/bootstrap.min.css">';
        echo '</head><body style="padding:20px;">';
        echo '<h2><i class="glyphicon glyphicon-globe"></i> Géocodage automatique des secteurs</h2>';
        echo '<div class="alert alert-info">Total secteurs sans GPS : <strong>' . $total . '</strong></div>';
        echo '<div class="progress"><div class="progress-bar progress-bar-striped active" id="pbar" style="width:0%">0%</div></div>';
        echo '<table class="table table-bordered table-striped table-condensed" id="results">';
        echo '<thead><tr><th>#</th><th>ID</th><th>Ville</th><th>Secteur</th><th>Statut</th><th>Coordonnées</th></tr></thead><tbody>';
        ob_flush();
        flush();

        $i = 0;
        foreach ($secteurs as $s) {
            $i++;
            $ville = $s['Secteur']['ville'];
            $secteurNom = $s['Secteur']['secteur'];
            $id = $s['Secteur']['id'];

            // Vérifier le cache par ville+secteur, puis par ville seule
            $cacheKey = $ville . '_' . $secteurNom;

            if (isset($cache[$cacheKey])) {
                $center = $cache[$cacheKey];
            } elseif (isset($cache[$ville])) {
                // Même ville, décaler légèrement pour différencier les secteurs
                $center = $cache[$ville];
                // Petit offset aléatoire pour ne pas superposer les secteurs d'une même ville
                $offset = ($i % 10) * 0.005;
                $center['lat'] += $offset * (($i % 2 == 0) ? 1 : -1);
                $center['lng'] += $offset * (($i % 3 == 0) ? 1 : -1);
            } else {
                // Appel API Nominatim
                $query = urlencode($secteurNom . ', ' . $ville . ', Maroc');
                $url = "https://nominatim.openstreetmap.org/search?q={$query}&format=json&limit=1&countrycodes=ma";

                $context = stream_context_create(array(
                    'http' => array(
                        'header' => "User-Agent: CRM-Labo/1.0\r\n",
                        'timeout' => 10
                    )
                ));

                $response = @file_get_contents($url, false, $context);
                $center = null;

                if ($response !== false) {
                    $data = json_decode($response, true);
                    if (!empty($data[0])) {
                        $center = array(
                            'lat' => (float)$data[0]['lat'],
                            'lng' => (float)$data[0]['lon']
                        );
                    }
                }

                // Si pas trouvé avec secteur+ville, essayer juste la ville
                if ($center === null) {
                    $query2 = urlencode($ville . ', Maroc');
                    $url2 = "https://nominatim.openstreetmap.org/search?q={$query2}&format=json&limit=1&countrycodes=ma";
                    usleep(1100000); // Respecter rate limit Nominatim (1 req/sec)
                    $response2 = @file_get_contents($url2, false, $context);
                    if ($response2 !== false) {
                        $data2 = json_decode($response2, true);
                        if (!empty($data2[0])) {
                            $center = array(
                                'lat' => (float)$data2[0]['lat'],
                                'lng' => (float)$data2[0]['lon']
                            );
                        }
                    }
                }

                if ($center !== null) {
                    $cache[$cacheKey] = $center;
                    $cache[$ville] = $center;
                }

                // Respecter le rate limit de Nominatim (1 requête/seconde)
                usleep(1100000);
            }

            if ($center !== null) {
                // Créer un polygone rectangulaire approximatif (~1-2 km autour du centre)
                $delta = 0.012; // ~1.3 km
                $gps = json_encode(array(
                    array($center['lat'] + $delta, $center['lng'] - $delta),
                    array($center['lat'] + $delta, $center['lng'] + $delta),
                    array($center['lat'] - $delta, $center['lng'] + $delta),
                    array($center['lat'] - $delta, $center['lng'] - $delta)
                ));

                $this->Secteur->id = $id;
                $this->Secteur->saveField('gps', $gps);
                $updated++;

                $status = '<span class="label label-success">OK</span>';
                $coords = round($center['lat'], 4) . ', ' . round($center['lng'], 4);
            } else {
                $errors[] = $id;
                $status = '<span class="label label-danger">ERREUR</span>';
                $coords = '-';
            }

            $pct = round(($i / $total) * 100);
            echo "<tr><td>$i</td><td>$id</td><td>" . h($ville) . "</td><td>" . h($secteurNom) . "</td><td>$status</td><td>$coords</td></tr>";
            echo "<script>document.getElementById('pbar').style.width='{$pct}%';document.getElementById('pbar').innerHTML='{$pct}%';</script>";
            ob_flush();
            flush();
        }

        echo '</tbody></table>';
        echo '<div class="alert alert-success"><strong>Terminé !</strong> ' . $updated . '/' . $total . ' secteurs géocodés avec succès.</div>';
        if (!empty($errors)) {
            echo '<div class="alert alert-warning"><strong>' . count($errors) . ' erreurs</strong> (IDs: ' . implode(', ', $errors) . '). Ces secteurs pourront être définis manuellement via la page Éditer.</div>';
        }
        echo '<a href="/labo/secteurs/index" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> Retour aux secteurs</a>';
        echo '</body></html>';
        exit();
    }

    /**
     * Géocodage d'un seul secteur
     * URL: /secteurs/geocode_secteur/123
     */
    public function geocode_secteur($id = null)
    {
        $this->autoRender = false;

        if (!$this->Secteur->exists($id)) {
            echo json_encode(array('success' => false, 'message' => 'Secteur introuvable'));
            return;
        }

        $this->Secteur->recursive = -1;
        $s = $this->Secteur->findById($id);
        $ville = $s['Secteur']['ville'];
        $secteurNom = $s['Secteur']['secteur'];

        $query = urlencode($secteurNom . ', ' . $ville . ', Maroc');
        $url = "https://nominatim.openstreetmap.org/search?q={$query}&format=json&limit=1&countrycodes=ma";

        $context = stream_context_create(array(
            'http' => array(
                'header' => "User-Agent: CRM-Labo/1.0\r\n",
                'timeout' => 10
            )
        ));

        $response = @file_get_contents($url, false, $context);
        $center = null;

        if ($response !== false) {
            $data = json_decode($response, true);
            if (!empty($data[0])) {
                $center = array('lat' => (float)$data[0]['lat'], 'lng' => (float)$data[0]['lon']);
            }
        }

        // Fallback : juste la ville
        if ($center === null) {
            $query2 = urlencode($ville . ', Maroc');
            $url2 = "https://nominatim.openstreetmap.org/search?q={$query2}&format=json&limit=1&countrycodes=ma";
            $response2 = @file_get_contents($url2, false, $context);
            if ($response2 !== false) {
                $data2 = json_decode($response2, true);
                if (!empty($data2[0])) {
                    $center = array('lat' => (float)$data2[0]['lat'], 'lng' => (float)$data2[0]['lon']);
                }
            }
        }

        if ($center !== null) {
            $delta = 0.012;
            $gps = json_encode(array(
                array($center['lat'] + $delta, $center['lng'] - $delta),
                array($center['lat'] + $delta, $center['lng'] + $delta),
                array($center['lat'] - $delta, $center['lng'] + $delta),
                array($center['lat'] - $delta, $center['lng'] - $delta)
            ));

            $this->Secteur->id = $id;
            $this->Secteur->saveField('gps', $gps);

            echo json_encode(array('success' => true, 'gps' => $gps, 'center' => $center));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Localisation introuvable'));
        }
        exit();
    }
}
