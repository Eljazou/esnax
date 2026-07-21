<?php
App::uses('AppModel', 'Model');
/**
 * Grosiste Model
 *
 * @property Grovente $Grovente
 */
class Grosiste extends AppModel {

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
			'foreignKey' => 'grosiste_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'date asc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
