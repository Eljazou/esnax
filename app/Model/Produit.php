<?php
App::uses('AppModel', 'Model');
/**
 * Produit Model
 *
 * @property Game $Game
 * @property Comander $Comander
 * @property Offrespicial $Offrespicial
 */
class Produit extends AppModel {

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
		'Comander' => array(
			'className' => 'Comander',
			'foreignKey' => 'produit_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Offrespicial' => array(
			'className' => 'Offrespicial',
			'foreignKey' => 'produit_id',
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
	
	public $validate = array(
		'code' => array(
			 'login' => array(
                                'rule' => 'isUnique',
                                'message' => 'Code wavesoft existe déja'
                        ),
		)
	);

}
