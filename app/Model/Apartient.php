<?php
App::uses('AppModel', 'Model');
/**
 * Apartient Model
 *
 * @property User1 $User1
 * @property User2 $User2
 */
class Apartient extends AppModel {


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
			'conditions' => 'archive=1',
			'fields' => '',
			'order' => ''
		),
		'User1' => array(
			'className' => 'User',
			'foreignKey' => 'user1_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
