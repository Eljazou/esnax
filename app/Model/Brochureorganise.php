<?php
App::uses('AppModel', 'Model');
/**
 * Brochureorganise Model
 *
 * @property Category $Category
 * @property Ligne $Ligne
 * @property Brochure $Brochure
 */
class Brochureorganise extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

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
		'Ligne' => array(
			'className' => 'Ligne',
			'foreignKey' => 'ligne_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Brochure' => array(
			'className' => 'Brochure',
			'foreignKey' => 'brochure_id',
			'conditions' => 'Brochure.archive=1',
			'fields' => '',
			'order' => ''
		)
	);
}
