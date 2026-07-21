<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Brochure $Brochure
 * @property Client $Client
 * @property Formation $Formation
 */
class Category extends AppModel {

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
		'Brochure' => array(
			'className' => 'Brochure',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => 'archive=1',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => 'archive=1',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Formation' => array(
			'className' => 'Formation',
			'foreignKey' => 'category_id',
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
