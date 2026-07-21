<?php
App::uses('AppModel', 'Model');
/**
 * Offrespicial Model
 *
 * @property Offre $Offre
 * @property Produit $Produit
 */
class Offrespicial extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Offre' => array(
			'className' => 'Offre',
			'foreignKey' => 'offre_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Produit' => array(
			'className' => 'Produit',
			'foreignKey' => 'produit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
