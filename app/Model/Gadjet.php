<?php
App::uses('AppModel', 'Model');
/**
 * Gadjet Model
 *
 * @property User $User
 * @property Echantillon $Echantillon
 */
class Gadjet extends AppModel {


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
		'Echantillon' => array(
			'className' => 'Echantillon',
			'foreignKey' => 'echantillon_id',
			'conditions' => 'Echantillon.archive=1',
			'fields' => '',
			'order' => ''
		)
	);
}
