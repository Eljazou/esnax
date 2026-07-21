<?php
App::uses('AppController', 'Controller');


class ServicesController extends AppController
{



	public function set_liste_to_user()
	{
		$alldata = array();
		if ($this->request->is('post')) {
			if (isset($this->request->data['Type']['file'])) {
				$date = date("ymdhis");
				$name = $this->request->data["Type"]["user_id"] . " $date.xlsx";
				file_put_contents("files/$name", file_get_contents($this->request->data['Type']['file']["tmp_name"]));
			} else {
				echo "Erreur dans fichier";
				exit();
			}

			$listename = $this->request->data['Type']['liste'];
			$user_id = $this->request->data["Type"]["user_id"];

			ini_set('memory_limit', '-1');
			set_time_limit(10000);
			$file = WWW_ROOT . "files/$name";

			// Read xlsx without any library using ZipArchive + XML
			$rows = array();
			$zip = new ZipArchive();
			if ($zip->open($file) === TRUE) {
				// Read shared strings
				$sharedStrings = array();
				$ssXml = $zip->getFromName('xl/sharedStrings.xml');
				if ($ssXml !== false) {
					$ss = simplexml_load_string($ssXml);
					foreach ($ss->si as $si) {
						$sharedStrings[] = (string) $si->t;
					}
				}
				// Read sheet data
				$sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
				if ($sheetXml !== false) {
					$sheet = simplexml_load_string($sheetXml);
					foreach ($sheet->sheetData->row as $row) {
						$rowData = array();
						foreach ($row->c as $cell) {
							$type = (string) $cell['t'];
							$value = (string) $cell->v;
							if ($type === 's') {
								$value = isset($sharedStrings[(int) $value]) ? $sharedStrings[(int) $value] : '';
							}
							$rowData[] = $value;
						}
						$rows[] = $rowData;
					}
				}
				$zip->close();
			}

			if (empty($rows)) {
				$this->Session->setFlash("Erreur : Le fichier importé n'est pas un fichier Excel (.xlsx) valide ou il est corrompu.");
			} else {
				$totalajouter = $totalintrovable = 0;
				$this->loadModel("Client");
				$this->Client->recursive = -1;
				$this->loadModel("Liste");

				$l = array();
				$l["Liste"]["name"] = $listename;
				$l["Liste"]["user_id"] = $user_id;
				$this->Liste->create();
				$this->Liste->save($l);
				$liste_id = $this->Liste->id;

				foreach ($rows as $data) {


					if (empty($data) || !isset($data[0]))
						continue;

					$client_id = (int) trim($data[0]);

					if (empty($client_id))
						continue;

					$client = $this->Client->findById($client_id);
					if (!empty($client)) {
						$totalajouter++;

						$f = array();
						$f["Affectation"]["liste_id"] = $liste_id;
						$f["Affectation"]["client_id"] = $client["Client"]["id"];
						$this->Liste->Affectation->create();
						$this->Liste->Affectation->save($f);

						$d = array();
						$d["code"] = $client_id;
						$d["id"] = $client["Client"]["id"];
						$d["nom"] = $client["Client"]["nom"];
						$d["etat"] = "Ajouter";
						$alldata[] = $d;
					} else {
						$d = array();
						$d["code"] = $client_id;
						$d["id"] = 1;
						$d["nom"] = '--';
						$d["etat"] = "Introvable";
						$alldata[] = $d;
						$totalintrovable++;
					}
				}

				$this->Session->setFlash("Nombre de clients ajoutés dans la liste : $totalajouter. Nombre de clients non trouvés : $totalintrovable");
			}
		}

		$this->loadModel("User");
		$this->User->recursive = -1;
		$users = $this->User->find("list", array("conditions" => array("User.archive" => 1)));
		$this->set("users", $users);
		$this->set("alldata", $alldata);
	}


	function system_mise_ajour_visites()
	{
		$this->loadModel("Visite");
		$this->Visite->recursive = -1;

		$conditions = array(
			"Visite.archive" => 1,
			"Visite.produit_adoption IS NULL",
			"Visite.produits IS NOT NULL",
			"Visite.produits !=''"
		);

		// Paginate through records
		$limit = 1000; // Number of records to process per batch
		$page = 1;

		while (true) {
			$visites = $this->Visite->find('all', array('conditions' => $conditions, 'limit' => $limit, 'page' => $page));
			debug($visites);
			if (empty($visites)) {
				echo "vide";
				break;
			}


			$updates = [];

			foreach ($visites as $v) {
				$input = $v["Visite"]["produits"];
				$produit_nbr_boite_adoption = $v["Visite"]["produit_nbr_boite_adoption"];
				list($numbersStr, $value) = explode('|', $input);
				$numbersStr = ltrim($numbersStr, '*');
				$numbers = explode(',', $numbersStr);

				$data = [];
				foreach ($numbers as $number) {
					if ($number == "")
						break;

					if ($value > 5)
						$value = 3;
					else if ($value > 2)
						$value = 2;
					else if ($value > 1)
						$value = 1;

					$data[$number]['pot'] = (int) $value;
					$data[$number]['nb'] = (int) $produit_nbr_boite_adoption;
				}

				$json = json_encode($data, true);
				$updates[] = array(
					'id' => $v["Visite"]["id"],
					'produit_adoption' => $json
				);
			}

			// Batch update
			if (!empty($updates)) {
				$this->Visite->saveMany($updates, array('validate' => false, 'callbacks' => false));
			}

		}
		exit();
	}



	function system_temp()
	{
		ini_set('memory_limit', '-1');
		set_time_limit(250);
		$file = WWW_ROOT . "files/temp.xlsx";

		require_once 'Component/simplexlsx.php';
		set_time_limit(10000);
		$unevers = SimpleXLSX::parse($file);

		$this->loadModel("Client");
		$this->loadModel("Rapportprocpect");
		$this->Client->recursive = -1;


		foreach ($unevers->rows() as $data) {
			$code = trim($data[0]);
			$client = $this->Client->findByCodeWavsoft($code);
			if (empty($client))
				continue;
			echo "$code <br>";
			$rapports = $this->Rapportprocpect->findAllByClient_id($client["Client"]["id"]);
			foreach ($rapports as $r) {
				if ($r["Prospectfeuille"]["prospectcompagne_id"] == 42) {
					debug($r);
					exit();
				}
			}

		}
		exit();
	}


	public function system_get_data_for_ai()
	{
		ini_set('memory_limit', '-1');
		set_time_limit(-1);
		$this->loadModel("Visite");
		$this->loadModel("Client");
		$this->loadModel("Secteur");
		$this->loadModel("User");
		$this->loadModel("Category");
		$this->loadModel("Apartient");
		$this->loadModel("Type");
		$cats = $this->Category->find("list");
		$types = $this->Type->find("list");
		$users = $this->User->find("list");
		$this->Secteur->recursive = -1;
		$this->Visite->recursive = -1;
		$this->Client->recursive = -1;
		$this->Apartient->recursive = -1;
		$secteurs = $this->Secteur->find("all");
		$formattedSecteurs = [];

		foreach ($secteurs as $secteur) {
			$id = $secteur['Secteur']['id'];
			$formattedSecteurs[$id] = $secteur['Secteur'];
		}

		$clts = $this->Client->find("all");
		$clients = [];

		foreach ($clts as $c) {
			$id = $c['Client']['id'];
			$clients[$id] = $c['Client'];
		}


		$apartientsdata = $this->Apartient->find("all");
		$apartients = array();
		foreach ($apartientsdata as $p) {
			$apartients[$p["Apartient"]["user1_id"]] = $users[$p["Apartient"]["user_id"]];
		}

		$date_debut = date("Y-01-01");
		$date_fin = date("Y-m-d");
		$conditions = array(
			"Visite.archive" => 1,
			"Visite.date between '$date_debut' and '$date_fin'"
		);
		$visites = $this->Visite->find('all', array('conditions' => $conditions));
		$data = array();
		foreach ($visites as $v) {
			$d = array();
			$client = $clients[$v["Visite"]["client_id"]];
			$d["specailite"] = isset($cats[$client["category_id"]]) ? $cats[$client["category_id"]] : '';
			$d["delege"] = $users[$v["Visite"]["user_id"]];
			$client = $clients[$v["Visite"]["client_id"]];
			$d["client"] = $client["nom"];
			$d["potentialite"] = $client["potentialite"];
			$d["date_visite"] = $v["Visite"]["date"];
			$d["gps_visite"] = $v["Visite"]["longitude"] . "," . $v["Visite"]["latitude"];
			$d["gps_client"] = $client["longitude"] . "," . $client["latitude"];
			$s = $formattedSecteurs[$client["secteur_id"]];
			$d["region"] = $s['region'];
			$d["ville"] = $s['ville'];
			$d["secteur"] = $s['secteur'];
			$d["superviseur"] = isset($apartients[$v["Visite"]["user_id"]]) ? $apartients[$v["Visite"]["user_id"]] : '';

			$d["type"] = $types[$client["type_id"]];
			$data[] = $d;
		}
		echo json_encode($data);

		exit();

	}



	function syetem_chat_ia_simple()
	{

	}


}
