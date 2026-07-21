<?php
App::uses('AppModel', 'Model');
/**
 * Grovente Model
 *
 * @property Grosiste $Grosiste
 * @property Groproduit $Groproduit
 * @property User $User
 */
class Grovente extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Grosiste' => array(
			'className' => 'Grosiste',
			'foreignKey' => 'grosiste_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Groproduit' => array(
			'className' => 'Groproduit',
			'foreignKey' => 'groproduit_id',
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
}
