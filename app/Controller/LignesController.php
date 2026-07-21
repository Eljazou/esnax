<?php

App::uses('AppController', 'Controller');

/**
 * Lignes Controller
 *
 * @property Ligne $Ligne
 * @property PaginatorComponent $Paginator
 */
class LignesController extends AppController
{

	//hadi juste pour le test il faut suprimer une fois nhtouha f apimobile
	function system_json_explication_ligne_category($user_id)
	{
		$this->loadModel("User");
		$this->User->recursive = -1;
		$user = $this->User->findById($user_id);
		$this->loadModel("Ligne");
		$data = $this->Ligne->Lignespecialiteinfo->findAllByLigneId($user["User"]["ligne_id"]);
		debug($data);
		exit();
	}


	//hada dial ordre de produit a afficher
	function system_json_get_ordre($user_id)
	{
		$this->loadModel("User");
		$this->User->recursive = -1;
		$user = $this->User->findById($user_id);
		$this->loadModel("Brochure");
		$data = $this->Brochure->Brochureorganise->find("all", array("conditions" => array("Brochureorganise.ligne_id" => $user["User"]["ligne_id"]), "Brochureorganise.order" => "asc"));
		debug($data);
		exit();

	}
	public function index()
	{
		$this->Ligne->recursive = 1;
		$this->set('lignes', $this->Ligne->find("all"));
	}


	// function lié a Lignespecialiteinfo
	function ajouter_explication()
	{
		if ($this->request->is('post')) {
			$this->Ligne->Lignespecialiteinfo->create();
			$this->Ligne->Lignespecialiteinfo->save($this->request->data);
			$this->Session->setFlash("Expliacation ajouté");
			$this->redirect($this->referer());
		}
	}

	public function system_update_message_event()
	{
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Ligne->id = $this->request->data['Ligne']['id'];
			if ($this->Ligne->saveField('message_event', $this->request->data['Ligne']['message_event'])) {
				$this->_notifyLigneUsers($this->request->data['Ligne']['id'], $this->request->data['Ligne']['message_event']);
				$this->Session->setFlash("Message d'événement mis à jour et collaborateurs notifiés");
			} else {
				$this->Session->setFlash("Erreur lors de la mise à jour du message");
			}
			$this->redirect($this->referer());
		}
	}

	private function _notifyLigneUsers($ligne_id, $message_event)
	{
		App::uses('ConnectionManager', 'Model');
		$credentialsPath = APP . 'Config' . DS . 'firebase_credentials.json';

		try {
			$db = ConnectionManager::getDataSource('default');
			$pdo = $db->getConnection();

			// Get Ligne Name
			$stmt = $pdo->prepare("SELECT name FROM lignes WHERE id = ? LIMIT 1");
			$stmt->execute([$ligne_id]);
			$ligne = $stmt->fetch(PDO::FETCH_ASSOC);
			$ligneName = $ligne ? $ligne['name'] : 'Ligne';

			// Get all active users on this ligne with their FCM tokens
			$stmt = $pdo->prepare("SELECT id, fcm_token FROM users WHERE ligne_id = ? AND archive = 1");
			$stmt->execute([$ligne_id]);
			$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$senderId = AuthComponent::user('id');
			if (empty($senderId)) {
				$senderId = 0;
			}

			$titre = "Nouveau message de la ligne : " . $ligneName;

			// Insert notification for each user + send FCM push
			$stmtNotif = $pdo->prepare("INSERT INTO notifications (user_id, user1_id, titre, message, vue, lien, created, modified) VALUES (?, ?, ?, ?, 0, '/notifications', NOW(), NOW())");

			foreach ($users as $u) {
				$stmtNotif->execute([
					$u['id'],
					$senderId,
					$titre,
					$message_event
				]);

				// Send FCM push if user has a registered token and credentials exist
				if (!empty($u['fcm_token']) && file_exists($credentialsPath)) {
					$this->_sendFcmPushV1($u['fcm_token'], $titre, $message_event, $credentialsPath);
				}
			}
		} catch (Exception $e) {
			CakeLog::write('error', 'Notification error: ' . $e->getMessage());
		}
	}

	/**
	 * Send a push notification using Firebase Cloud Messaging HTTP v1 API.
	 */
	private function _sendFcmPushV1($fcmToken, $title, $body, $credentialsPath)
	{
		try {
			$accessToken = $this->_getGoogleAccessToken($credentialsPath);
			if (empty($accessToken)) {
				CakeLog::write('error', '[FCM V1] Failed to generate OAuth2 access token.');
				return;
			}

			$config = json_decode(file_get_contents($credentialsPath), true);
			$projectId = $config['project_id'] ?? null;
			if (empty($projectId)) {
				CakeLog::write('error', '[FCM V1] Project ID not found in credentials.');
				return;
			}

			$payload = json_encode([
				'message' => [
					'token' => $fcmToken,
					'notification' => [
						'title' => $title,
						'body' => $body,
					],
					'data' => [
						'title' => $title,
						'body' => $body,
					],
					'android' => [
						'priority' => 'HIGH',
					],
				]
			]);

			$url = "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send";

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Authorization: Bearer ' . $accessToken,
				'Content-Type: application/json',
			]);
			
			$result = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			CakeLog::write('debug', '[FCM V1] Push sent. HTTP ' . $httpCode . ' Response: ' . $result);
		} catch (Exception $e) {
			CakeLog::write('error', '[FCM V1] Push failed: ' . $e->getMessage());
		}
	}

	/**
	 * Generate an OAuth2 access token for Google API authentication.
	 */
	private function _getGoogleAccessToken($credentialsPath)
	{
		try {
			$json = json_decode(file_get_contents($credentialsPath), true);
			$privateKey = $json['private_key'];
			$clientEmail = $json['client_email'];

			$header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
			$now = time();
			$payload = json_encode([
				'iss' => $clientEmail,
				'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
				'aud' => 'https://oauth2.googleapis.com/token',
				'exp' => $now + 3600,
				'iat' => $now
			]);

			$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
			$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

			$signature = '';
			if (!openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
				return null;
			}
			$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

			$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

			$ch = curl_init('https://oauth2.googleapis.com/token');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
				'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
				'assertion' => $jwt
			]));
			
			$response = curl_exec($ch);
			curl_close($ch);

			$resJson = json_decode($response, true);
			return $resJson['access_token'] ?? null;
		} catch (Exception $e) {
			return null;
		}
	}


	function supprimer_explication($id = null)
	{
		$this->Ligne->Lignespecialiteinfo->id = $id;
		if (!$this->Ligne->Lignespecialiteinfo->exists()) {
			throw new NotFoundException(__('Invalid Brochure'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ligne->Lignespecialiteinfo->delete()) {
			$this->Session->setFlash(__('L\'expliacation à été supprimer'));
			$this->redirect($this->referer());
		}
		$this->Session->setFlash(__('Ordre was not deleted'));
		$this->redirect($this->referer());
	}

	public function view($id = null)
	{
		if (!$this->Ligne->exists($id)) {
			throw new NotFoundException(__('Invalid ligne'));
		}
		$options = array('conditions' => array('Ligne.id' => $id));
		$this->set('ligne', $this->Ligne->find('first', $options));
		$this->loadModel("Category");
		$categories = $this->Category->find("list");
		$this->set(compact("categories"));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add()
	{
		if ($this->request->is('post')) {
			$this->Ligne->create();
			if ($this->Ligne->save($this->request->data)) {
				$this->Session->setFlash(__('La ligne à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__("La ligne  n'a pas pu être sauvée. S'il vous plaît essayer à nouveau."));
			}
		}
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
		if (!$this->Ligne->exists($id)) {
			throw new NotFoundException(__('Invalid ligne'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$oldLigne = $this->Ligne->findById($id);
			if ($this->Ligne->save($this->request->data)) {
				$oldMsg = isset($oldLigne['Ligne']['message_event']) ? $oldLigne['Ligne']['message_event'] : '';
				$newMsg = isset($this->request->data['Ligne']['message_event']) ? $this->request->data['Ligne']['message_event'] : '';
				if ($oldMsg !== $newMsg && !empty($newMsg)) {
					$this->_notifyLigneUsers($id, $newMsg);
				}
				$this->Session->setFlash(__('La ligne à été enregistré'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ligne could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Ligne.' . $this->Ligne->primaryKey => $id));
			$this->request->data = $this->Ligne->find('first', $options);
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null)
	{
		$this->Ligne->id = $id;
		if (!$this->Ligne->exists()) {
			throw new NotFoundException(__('Invalid ligne'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Ligne->delete()) {
			$this->Session->setFlash(__('La Ligne à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Ligne was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}

}
