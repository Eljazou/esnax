<?php
App::uses('AppModel', 'Model');
/**
 * Affectation Model
 *
 * @property Liste $Liste
 * @property Client $Client
 */
class Affectation extends AppModel {

	public $belongsTo = array(
		'Liste' => array(
			'className' => 'Liste',
			'foreignKey' => 'liste_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
