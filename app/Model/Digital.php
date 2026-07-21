<?php
App::uses('AppModel', 'Model');
/**
 * Digital Model
 *
 * @property Client $Client
 * @property Game $Game
 * @property User $User
 * @property Secteur $Secteur
 */
class Digital extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Game' => array(
			'className' => 'Game',
			'foreignKey' => 'game_id',
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
		'Secteur' => array(
			'className' => 'Secteur',
			'foreignKey' => 'secteur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
