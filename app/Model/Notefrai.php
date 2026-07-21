<?php
App::uses('AppModel', 'Model');
/**
 * Notefrai Model
 *
 * @property User $User
 */
class Notefrai extends AppModel {


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
	
	 public $hasMany = array(
        'Noteajustement' => array(
            'className' => 'Noteajustement',
            'foreignKey' => 'notefrai_id',
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
