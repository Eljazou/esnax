<?php
App::uses('AppModel', 'Model');
/**
 * Packdetail Model
 *
 * @property Pack $Pack
 * @property Game $Game
 */
class Packdetail extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Pack' => array(
			'className' => 'Pack',
			'foreignKey' => 'pack_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
