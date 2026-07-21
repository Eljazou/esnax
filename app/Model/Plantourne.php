<?php
App::uses('AppModel', 'Model');
/**
 * Plantourne Model
 *
 * @property Liste $Liste
 */
class Plantourne extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Liste' => array(
			'className' => 'Liste',
			'foreignKey' => 'liste_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
