<?php
App::uses('AppController', 'Controller');
/**
 * Iaservices Controller
 *
 * @property Iaservice $Iaservice
 * @property PaginatorComponent $Paginator
 */
class IaservicesController extends AppController {

/**
 * Components
 *
 * @var array
 */

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Iaservice->recursive = 0;
		$this->set('iaservices', $this->Iaservice->find("all"));
	}

	public function delete($id = null) {
		$this->Iaservice->id = $id;
		if (!$this->Iaservice->exists()) {
			throw new NotFoundException(__('Invalid iaservice'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Iaservice->delete()) {
			$this->Session->setFlash(__('La Iaservice à été supprimer'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Iaservice was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
	
	
	
	public function system_askia()
	{
		// Désactive le rendu automatique et définit la réponse en JSON
		$this->autoRender = false;

		// Récupère les données POST : message et rapports
		$message = $this->request->data['message'] ?? '';
		$html = $this->request->data['html'] ?? [];

		// Vérifie que le message est présent
		if (!$message) {
			return $this->response->body(json_encode([
				'success' => false,
				'error' => 'No message provided'
			]));
		}

		// Clé API Gemini (à sécuriser en pratique)
		$apiKey = 'AIzaSyCkoXrV-FtE7Fy_q9Vu03S8KhFjYxgLQA0';

		// Construction du message complet à envoyer
		$prompt = '## CONTEXTE ##
Tu es un assistant IA expert en analyse de données CRM pour le secteur pharmaceutique. Ton rôle est d\'aider à comprendre l\'activité des délégués médicaux (visiteurs médicaux et pharmaceutiques - VMP) et de leurs superviseurs.
Tu recevras des données au format JSON et une question posée par un client.

## STRUCTURE DES DONNÉES (APERÇU IMPORTANT) ##
Le JSON principal que tu recevras contiendra une clé "users".
Sous "users", chaque clé numérique (ex: "418") regroupe un ou plusieurs utilisateurs. La valeur associée à ces clés numériques est un tableau d\'objets.
Chaque objet dans ce tableau a typiquement trois clés principales : `User`, `Visite`, et `Objectif`.

1.  **`User`**: Un objet contenant les informations du profil de l\'employé.
    *   Fais attention au champ `User.name` pour identifier les personnes (ex: "EL QORCHI ABDELFATH").
    *   Le champ `User.role` est crucial (ex: "VMP" pour Délégué, "Super viseur").

2.  **`Visite`**: Un objet où chaque clé est une date de visite (format "YYYY-MM-DD").
    *   Sous chaque date, tu trouveras des clés correspondant au type de professionnel visité (ex: "Médecin", "Pharmacie", "Autres professions de la sante").
    *   La valeur de ces clés est un TABLEAU de visites individuelles. Chaque élément de ce tableau est un objet représentant une visite.
    *   Pour chaque visite à un "Médecin", le champ `client_potentialite` (ex: "A1", "B2", "C3") est particulièrement important pour l\'analyse.
    *   Le champ `client_type` (ex: "Médecin", "Pharmacie") indique le type de client visité.

3.  **`Objectif`**: Un tableau contenant les objectifs assignés à l\'utilisateur.

## TA MISSION ##
1.  **Analyser la question du client avec soin** : Les questions peuvent parfois manquer de précision. Utilise ton expertise du contexte CRM pour les interpréter au mieux.
    *   Par exemple, si le client demande "POT" ou "pot.", cela fait référence au champ `client_potentialite` des médecins.
    *   Si le client demande des informations sur "l\'équipe" ou "toute l\'équipe", cela fait généralement référence à TOUS les utilisateurs ayant le rôle "VMP" présents dans les données, sauf indication contraire. Si la question est ambiguë sur ce point, tu peux le signaler et/ou faire l\'hypothèse la plus raisonnable.
2.  **Naviguer dans le JSON** pour extraire les données pertinentes afin de répondre à la question.
3.  **Effectuer les calculs demandés avec une extrême précision.** Compte attentivement les visites, regroupe-les correctement, etc.
4.  **Fournir une réponse claire, structurée et si possible, approfondie.**
    *   Présente les chiffres clés de manière lisible (listes à puces, phrases claires).
    *   Si la question implique des étapes de calcul (ex: regroupement par potentialité), explique brièvement ta méthode ou montre le détail.
    *   Lorsque c\'est pertinent, ajoute une courte phrase d\'analyse ou une observation (ex: "La majorité des visites de ce délégué ciblent les médecins de potentialité A1.").

## FORMAT DE LA REQUÊTE QUE TU RECEVRAS ##
Tu recevras le JSON complet, suivi de la question du client.

[JSON DATA]
'.$html.'

[QUESTION CLIENT]
'.$message.'

---
Prépare-toi à analyser les données et à répondre.';
		

		// Préparation des données pour l'appel API
		$postData = json_encode([
			'contents' => [[
				'parts' => [[ 'text' => $prompt ]]
			]],
			'generationConfig' => [
				'temperature' => 0.2,
				'topP' => 0.95,
				'topK' => 40,
				'maxOutputTokens' => 4096
			]
		]);

		// Appel API via cURL
		$ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey);
		curl_setopt_array($ch, [
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData,
			CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
			CURLOPT_TIMEOUT => 60
		]);

		$result = curl_exec($ch);
		$curlError = curl_error($ch);
		curl_close($ch);

		// Gestion des erreurs cURL
		if ($result === false) {
			return $this->response->body(json_encode([
				'success' => false,
				'error' => 'cURL error: ' . $curlError
			]));
		}

		// Traitement de la réponse
		$responseData = json_decode($result, true);
		if (!empty($responseData['error']['message'])) {
			return $this->response->body(json_encode([
				'success' => false,
				'error' => $responseData['error']['message']
			]));
		}

		// Retourne la réponse du modèle
		$texte = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Réponse vide';
		$currentUrl = Router::url(null, true); // URL complète de la page actuelle
		$refererUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';


		$d=[];
		$d["Iaservice"]["user_id"]=AuthComponent::user('id');
		$d["Iaservice"]["data_send"]=$html;
		$d["Iaservice"]["controller"] = $this->request->params['controller']; // Nom du contrôleur actuel
		$d["Iaservice"]["action"] = $this->request->params['action']; // Nom de l'action actuelle
		$d["Iaservice"]["link"]=$refererUrl;
		$d["Iaservice"]["message"]=$message;
		$d["Iaservice"]["repense"]=$texte;
		$d["Iaservice"]["key_api"]=$apiKey;
		$this->Iaservice->create();
		$this->Iaservice->save($d);
		
		return $this->response->body(json_encode([
			'success' => true,
			'message' => $texte
		]));
	}
	
	
}
