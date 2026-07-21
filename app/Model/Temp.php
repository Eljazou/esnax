<?php
App::uses('AppModel', 'Model');
/**
 * Temp Model
 *
 * @property Client $Client
 * @property Brochure $Brochure
 */
class Temp extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Brochure' => array(
			'className' => 'Brochure',
			'foreignKey' => 'brochure_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
