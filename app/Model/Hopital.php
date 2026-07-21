<?php

App::uses('AppModel', 'Model');

/**

 * Hopital Model

 *

 */

class Hopital extends AppModel
{





	//The Associations below have been created with all possible keys, those that are not needed can be removed

	



	/**

	 * hasMany associations

	 *

	 * @var array

	 */

	public $hasMany = array(

		'Client' => array(

			'className' => 'Client',

			'foreignKey' => 'hopital_id',

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

		

	);

}
