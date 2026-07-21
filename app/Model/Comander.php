<?php
App::uses('AppModel', 'Model');
/**
 * Comander Model
 *
 * @property Commande $Commande
 * @property Produit $Produit
 */
class Comander extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Commande' => array(
			'className' => 'Commande',
			'foreignKey' => 'commande_id',
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
