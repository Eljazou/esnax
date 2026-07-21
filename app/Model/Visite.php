<?php
App::uses('AppModel', 'Model');
/**
 * Visite Model
 *
 * @property User $User
 * @property Client $Client
 */
class Visite extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
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
	
	public $hasMany = array(
		'Visiteordre' => array(
			'className' => 'Visiteordre',
			'foreignKey' => 'visite_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'id asc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
}
