<?php



App::uses('AppController', 'Controller');



/**

 * Droits Controller

 *

 * @property Droit $Droit

 * @property PaginatorComponent $Paginator

 */

class DroitsController extends AppController
{







	function beforeFilter()

	{

		parent::beforeFilter();

		$this->Auth->allow('getrole', "system_backup_database", "sendallbuckup");
	}





	public function gestion($user_id = 1)
	{
		$this->Droit->recursive = -1;


		// Handle form submission
		if ($this->request->is('post')) {

			// Extract user_id from posted data
			if (!empty($this->request->data['Droit']['user_id'])) {
				$userParts = explode('/droits/gestion/', $this->request->data['Droit']['user_id']);
				$this->request->data['Droit']['user_id'] = isset($userParts[1]) ? $userParts[1] : $user_id;
			}

			// Delete existing rights for this user
			$liste = $this->Droit->find('list', array(
				'conditions' => array('user_id' => $this->request->data['Droit']['user_id'])
			));

			foreach ($liste as $key => $value) {
				$this->Droit->id = $key;
				$this->Droit->delete();
			}

			// Insert new rights
			if (!empty($this->request->data['Droit']['droit']) && is_array($this->request->data['Droit']['droit'])) {
				foreach ($this->request->data['Droit']['droit'] as $value) {
					$d = array(
						'Droit' => array(
							'name' => $value,
							'user_id' => $this->request->data['Droit']['user_id']
						)
					);
					$this->Droit->create();
					$this->Droit->save($d);
				}
			}

			$this->Session->setFlash(__('Opération effectuée avec succès'));
			return $this->redirect(array('action' => 'gestion'));
		}

		// Build controllers and actions list
		$controllerClasses = App::objects('controller');
		$controllers = array();

		foreach ($controllerClasses as $controller) {
			if (
				$controller != 'AppController' &&
				$controller != 'VisitemobileapisController' &&
				$controller != 'AppwebController'
			) {
				// Import controller
				App::import('Controller', str_replace('Controller', '', $controller));

				// Ensure the class exists before getting its methods
				if (class_exists($controller)) {
					$actionMethods = get_class_methods($controller);

					if (is_array($actionMethods)) {
						// Remove private/protected methods
						foreach ($actionMethods as $key => $method) {
							if (isset($method[0]) && $method[0] == '_') {
								unset($actionMethods[$key]);
							}
						}

						// Get parent actions
						App::import('Controller', 'AppController');
						$parentActions = get_class_methods('AppController');

						// Keep only controller-specific actions
						$controllers[$controller] = array_diff($actionMethods, $parentActions);
					}
				}
			}
		}

		// Load users and their rights
		$users = $this->Droit->User->find('list', array(
			'conditions' => array('User.archive' => 1)
		));

		$liste = $this->Droit->find('list', array(
			'conditions' => array('user_id' => $user_id)
		));

		// Send data to the view
		$this->set(compact('users', 'controllers', 'liste', 'user_id'));
	}




	function getrole($controller = null, $view = null)

	{

		if ($controller == null || $view == null)

			return 0;

		$droits = $this->Session->read('droits');

		if (empty($droits))

			return 0;

		if (in_array(ucfirst($controller) . '|' . $view, $droits))

			return 1;

		else

			return 0;
	}





	function system_backup_database()

	{

		$DBUSER = "root";

		$DBPASSWD = "icoz@NETWORK";

		$DATABASE = "esna";

		$filename = "backup-" . date("Y-m-dHis") . "";

		$serveur = 'localhost';

		$login = 'root';
		$password = 'icoz@NETWORK';
		$base = 'esna';

		$mode = 3;





		$bases = array("esna", "esnacommande", "gestionesna");



		$filename = '/var/www/app/webroot/backup-' . date('d-m-Y_Hi') . '.sql';

		$fichierDump = fopen($filename, "wb");

		for ($ii = 0; $ii < count($bases); $ii++) {

			$base = $bases[$ii];

			$connexion = mysql_connect($serveur, $login, $password);

			mysql_select_db($base, $connexion);



			$entete = "-- dump de la base " . $base . " au " . date("d-M-Y") . "\n";

			$entete .= "-- ----------------------\n\n\n";

			$creations = "";

			$insertions = "\n\n";



			$listeTables = mysql_query("show tables", $connexion);

			while ($table = mysql_fetch_array($listeTables)) {

				// si l'utilisateur a demandé la structure ou la totale

				if ($mode == 1 || $mode == 3) {

					$creations .= "-- -----------------------------\n";

					$creations .= "-- $base creation de la table " . $table[0] . "\n";

					$creations .= "-- -----------------------------\n";

					$listeCreationsTables = mysql_query("show create table " . $table[0], $connexion);

					while ($creationTable = mysql_fetch_array($listeCreationsTables)) {

						$creations .= $creationTable[1] . ";\n\n";
					}
				}

				// si l'utilisateur a demandé les données ou la totale

				if ($mode > 1) {

					$donnees = mysql_query("SELECT * FROM " . $table[0]);

					$insertions .= "-- -----------------------------\n";

					$insertions .= "-- $base insertions dans la table " . $table[0] . "\n";

					$insertions .= "-- -----------------------------\n";

					while ($nuplet = mysql_fetch_array($donnees)) {

						$insertions .= "INSERT INTO " . $table[0] . " VALUES(";

						for ($i = 0; $i < mysql_num_fields($donnees); $i++) {

							if ($i != 0)

								$insertions .=  ", ";

							//if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")

							$insertions .=  "'";

							$insertions .= addslashes($nuplet[$i]);

							//if(mysql_field_type($donnees, $i) == "string" || mysql_field_type($donnees, $i) == "blob")

							$insertions .=  "'";
						}

						$insertions .=  ");\n";
					}

					$insertions .= "\n";
				}
			}

			fwrite($fichierDump, $entete);

			fwrite($fichierDump, $creations);

			fwrite($fichierDump, $insertions);

			mysql_close($connexion);
		}





		$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);



		fclose($fichierDump);

		// Name of the file we're compressing

		$file = $filename;

		// Name of the gz file we're creating

		$gzfile = '/var/www/app/webroot/backup-' . date('d-m-Y_Hi') . '.gz';

		// Open the gz file (w9 is the highest compression)

		$fp = gzopen($gzfile, 'w9');

		// Compress the file

		gzwrite($fp, file_get_contents($file));

		// Close the gz file and we're done

		gzclose($fp);

		unlink($filename);

		$random_hash = md5(date('r', time()));

		$content = file_get_contents($gzfile);

		$content = chunk_split(base64_encode($content));

		$uid = md5(uniqid(time()));

		$mailto = "backup@isiolaboratoires.com";

		//$mailto="godsneek@hotmail.com";

		$subject = "CRM VMP : Buck up  data base " . date('d-m-Y');

		// header

		$header = "From: ICOZ CRM VMP <contact@icoz.ma>\r\n";

		$header .= "Reply-To: backup@isiolaboratoires.com\r\n";

		$header .= "MIME-Version: 1.0\r\n";

		$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";



		// message & attachment

		$nmessage = "--" . $uid . "\r\n";

		$nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";

		$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";

		$nmessage .= "Bonjour Voila la backup de la base CRM VMP\r\n\r\n";

		$nmessage .= "--" . $uid . "\r\n";

		$nmessage .= "Content-Type: application/octet-stream; name=\"backup.gz\"\r\n";

		$nmessage .= "Content-Transfer-Encoding: base64\r\n";

		$nmessage .= "Content-Disposition: attachment; filename=\"backup.gz\"\r\n\r\n";

		$nmessage .= $content . "\r\n\r\n";

		$nmessage .= "--" . $uid . "--";



		mail($mailto, $subject, $nmessage, $header);

		unlink($gzfile);



		exit();
	}
}
