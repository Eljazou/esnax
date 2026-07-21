<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Secteur $Secteur
 * @property Apartient $Apartient
 * @property Commande $Commande
 * @property Conge $Conge
 * @property Droit $Droit
 * @property Liste $Liste
 * @property Notefrai $Notefrai
 * @property Objectif $Objectif
 * @property Representant $Representant
 * @property Visite $Visite
 */
class User extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Secteur' => array(
            'className' => 'Secteur',
            'foreignKey' => 'secteur_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Ligne' => array(
            'className' => 'Ligne',
            'foreignKey' => 'ligne_id',
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
        'Apartient' => array(
            'className' => 'Apartient',
            'foreignKey' => 'user_id',
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
        'Absence' => array(
            'className' => 'Absence',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => 'archive=2',
            'fields' => '',
            'order' => 'date_debut desc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Droit' => array(
            'className' => 'Droit',
            'foreignKey' => 'user_id',
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
        'Liste' => array(
            'className' => 'Liste',
            'foreignKey' => 'user_id',
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
        'Notefrai' => array(
            'className' => 'Notefrai',
            'foreignKey' => 'user_id',
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
        'Objectif' => array(
            'className' => 'Objectif',
            'foreignKey' => 'user_id',
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
        'Visite' => array(
            'className' => 'Visite',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => 'archive=1',
            'fields' => '',
            'order' => 'date desc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
