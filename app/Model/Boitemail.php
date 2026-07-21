<?php
App::uses('AppModel', 'Model');
/**
 * Boitemail Model
 *
 * @property User $User
 * @property User1 $User1
 */
class Boitemail extends AppModel {


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
		'User1' => array(
			'className' => 'User',
			'foreignKey' => 'user1_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
