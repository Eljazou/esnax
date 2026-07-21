<?php
App::uses('AppModel', 'Model');
/**
 * Rapport Model
 *
 * @property User $User
 */
class Rapport extends AppModel {


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
		)
	);
	
	public $hasMany = array(
		'RapportConcurance' => array(
			'className' => 'RapportConcurance',
			'foreignKey' => 'rapport_id',
			'dependent' => false,
			'fields' => '',
			'order' => 'id asc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
