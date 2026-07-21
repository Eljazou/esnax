<?php
App::uses('AppModel', 'Model');
/**
 * Game Model
 *
 * @property Brochure $Brochure
 * @property Echantillon $Echantillon
 * @property Produit $Produit
 */
class Game extends AppModel
{

	/**
	 * Display field
	 *
	 * @var string
	 */
	// public $virtualFields = array(
	// 	'full_name' => 'CONCAT(Game.name, " ", Game.archive)'
	// );
	// public $displayField = 'full_name';
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
			'foreignKey' => 'game_id',
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
		'Echantillon' => array(
			'className' => 'Echantillon',
			'foreignKey' => 'game_id',
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
		'Produit' => array(
			'className' => 'Produit',
			'foreignKey' => 'game_id',
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
