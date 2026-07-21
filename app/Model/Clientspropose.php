<?php
App::uses('AppModel', 'Model');
/**
 * Clientspropose Model
 *
 * @property Type $Type
 * @property Secteur $Secteur
 * @property Category $Category
 * @property User $User
 * @property Category1 $Category1
 */
class Clientspropose extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Type' => array(
			'className' => 'Type',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Secteur' => array(
			'className' => 'Secteur',
			'foreignKey' => 'secteur_id',
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
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category1' => array(
			'className' => 'Category',
			'foreignKey' => 'category1_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
