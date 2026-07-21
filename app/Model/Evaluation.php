<?php
App::uses('AppModel', 'Model');
/**
 * Evaluation Model
 *
 * @property User $User
 * @property User1 $User1
 */
class Evaluation extends AppModel {


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
		'Chef' => array(
			'className' => 'User',
			'foreignKey' => 'chef_id',
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
