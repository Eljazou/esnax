<?php
App::uses('AppModel', 'Model');
/**
 * Lignespecialiteinfo Model
 *
 * @property Ligne $Ligne
 * @property Category $Category
 */
class Lignespecialiteinfo extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Ligne' => array(
			'className' => 'Ligne',
			'foreignKey' => 'ligne_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
