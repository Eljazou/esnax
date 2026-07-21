<?php
App::uses('AppModel', 'Model');
/**
 * Brochure Model
 *
 * @property Category $Category
 * @property Game $Game
 * @property Temp $Temp
 */
class Brochure extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Temp' => array(
			'className' => 'Temp',
			'foreignKey' => 'brochure_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'date desc',
			'limit' => '100',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Brochureorganise' => array(
			'className' => 'Brochureorganise',
			'foreignKey' => 'brochure_id',
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
