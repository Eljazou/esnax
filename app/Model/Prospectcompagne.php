<?php
App::uses('AppModel', 'Model');
/**
 * Prospectcompagne Model
 *
 * @property Prospectaffaire $Prospectaffaire
 * @property User $User
 * @property Prospectfeuille $Prospectfeuille
 */
class Prospectcompagne extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Prospectaffaire' => array(
			'className' => 'Prospectaffaire',
			'foreignKey' => 'prospectaffaire_id',
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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Prospectfeuille' => array(
			'className' => 'Prospectfeuille',
			'foreignKey' => 'prospectcompagne_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'id asc',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
