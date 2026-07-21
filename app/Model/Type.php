<?php

App::uses('AppModel', 'Model');

/**
 * Type Model
 *
 * @property Client $Client
 * @property Objectif $Objectif
 */
class Type extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'type_id',
            'dependent' => false,
            'conditions' => 'archive=1',
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
