<?php
App::uses('AppModel', 'Model');
/**
 * Prospectfeuille Model
 *
 * @property Prospect $Prospect
 * @property User $User
 * @property Prospectcompagne $Prospectcompagne
 */
class Prospectfeuille extends AppModel {


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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Prospectcompagne' => array(
			'className' => 'Prospectcompagne',
			'foreignKey' => 'prospectcompagne_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	 public $hasOne = array(
        'Rapportprocpect' => array(
            'className' => 'Rapportprocpect',
            'conditions' => ''
        )
    );
}
