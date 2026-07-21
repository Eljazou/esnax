<?php
App::uses('AppModel', 'Model');
/**
 * Rapportprocpect Model
 *
 * @property Client $Client
 * @property User $User
 * @property Prospectfeuille $Prospectfeuille
 */
class Rapportprocpect extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Prospectfeuille' => array(
			'className' => 'Prospectfeuille',
			'foreignKey' => 'prospectfeuille_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
