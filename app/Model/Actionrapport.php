<?php
App::uses('AppModel', 'Model');

/**
 * Actionrapport Model
 *
 * @property User $User
 * @property Action $Action
 */
class Actionrapport extends AppModel {

	public $displayField = 'id';

	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Action' => array(
			'className' => 'Action',
			'foreignKey' => 'action_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
