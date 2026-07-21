<?php
App::uses('AppModel', 'Model');
/**
 * Noteajustement Model
 *
 * @property User $User
 */
class Noteajustement extends AppModel {


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
		'Notefrai' => array(
			'className' => 'Notefrai',
			'foreignKey' => 'notefrai_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
