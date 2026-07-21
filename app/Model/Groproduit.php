<?php
App::uses('AppModel', 'Model');
/**
 * Groproduit Model
 *
 * @property Grovente $Grovente
 */
class Groproduit extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Grovente' => array(
			'className' => 'Grovente',
			'foreignKey' => 'groproduit_id',
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
