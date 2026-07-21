<?php
App::uses('AppModel', 'Model');
/**
 * Liste Model
 *
 * @property User $User
 * @property Affectation $Affectation
 * @property Feuilleroute $Feuilleroute
 */
class Liste extends AppModel {

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
		'Affectation' => array(
			'className' => 'Affectation',
			'foreignKey' => 'liste_id',
			'dependent' => false,
			'conditions' => 'valide=1',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
            'Plantourne' => array(
			'className' => 'Plantourne',
			'foreignKey' => 'liste_id',
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
