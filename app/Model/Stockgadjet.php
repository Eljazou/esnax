<?php
App::uses('AppModel', 'Model');
/**
 * Stockgadjet Model
 *
 * @property Echantillon $Echantillon
 * @property User $User
 */
class Stockgadjet extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Echantillon' => array(
			'className' => 'Echantillon',
			'foreignKey' => 'echantillon_id',
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
		)
	);
}
