<?php
App::uses('AppModel', 'Model');
/**
 * MarDetail Model
 *
 * @property Marketing $Marketing
 * @property User $User
 */
class MarDetail extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Marketing' => array(
			'className' => 'Marketing',
			'foreignKey' => 'marketing_id',
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
