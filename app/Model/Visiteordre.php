<?php
App::uses('AppModel', 'Model');
/**
 * Visiteordre Model
 *
 * @property Brochure $Brochure
 * @property Visite $Visite
 */
class Visiteordre extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Brochure' => array(
			'className' => 'Brochure',
			'foreignKey' => 'brochure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Visite' => array(
			'className' => 'Visite',
			'foreignKey' => 'visite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
