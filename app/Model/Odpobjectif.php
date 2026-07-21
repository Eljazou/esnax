<?php
App::uses('AppModel', 'Model');
/**
 * Odpobjectif Model
 *
 * @property Brochure $Brochure
 */
class Odpobjectif extends AppModel {


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
		)
	);
}
