<?php

App::uses('AppModel', 'Model');

/**

 * Client Model

 *

 * @property Liste $Liste

 * @property Type $Type

 * @property Secteur $Secteur

 * @property Category $Category

 * @property Action $Action

 * @property Commande $Commande

 * @property Temp $Temp

 * @property Visite $Visite

 */

class Client extends AppModel
{





	//The Associations below have been created with all possible keys, those that are not needed can be removed



	/**

	 * belongsTo associations

	 *

	 * @var array

	 */

	public $belongsTo = array(

		'Type' => array(

			'className' => 'Type',

			'foreignKey' => 'type_id',

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

		),

		'Category' => array(

			'className' => 'Category',

			'foreignKey' => 'category_id',

			'conditions' => '',

			'fields' => '',

			'order' => ''

		),

		'Category1' => array(

			'className' => 'Category',

			'foreignKey' => 'category1_id',

			'conditions' => '',

			'fields' => '',

			'order' => ''

		),
		'Hopital' => array(

			'className' => 'Hopital',

			'foreignKey' => 'hopital_id',

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

		'Action' => array(

			'className' => 'Action',

			'foreignKey' => 'client_id',

			'dependent' => false,

			'conditions' => 'archive=2',

			'fields' => '',

			'order' => 'date_fin desc',

			'limit' => '',

			'offset' => '',

			'exclusive' => '',

			'finderQuery' => '',

			'counterQuery' => ''

		),

		'Temp' => array(

			'className' => 'Temp',

			'foreignKey' => 'client_id',

			'dependent' => false,

			'conditions' => '',

			'fields' => '',

			'order' => 'date desc',

			'limit' => '3',

			'offset' => '',

			'exclusive' => '',

			'finderQuery' => '',

			'counterQuery' => ''

		),

		'Visite' => array(

			'className' => 'Visite',

			'foreignKey' => 'client_id',

			'dependent' => false,

			'conditions' => 'archive=1',

			'fields' => '',

			'order' => 'date desc',

			'limit' => '',

			'offset' => '',

			'exclusive' => '',

			'finderQuery' => '',

			'counterQuery' => ''

		),

		'Affectation' => array(

			'className' => 'Affectation',

			'foreignKey' => 'client_id',

			'dependent' => false,

			'conditions' => '',

			'fields' => '',

			'order' => 'created desc',

			'limit' => '',

			'offset' => '',

			'exclusive' => '',

			'finderQuery' => '',

			'counterQuery' => ''

		)

	);

}
