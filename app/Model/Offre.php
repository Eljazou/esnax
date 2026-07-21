<?php
App::uses('AppModel', 'Model');
/**
 * Offre Model
 *
 * @property Offrespicial $Offrespicial
 */
class Offre extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Offrespicial' => array(
			'className' => 'Offrespicial',
			'foreignKey' => 'offre_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
