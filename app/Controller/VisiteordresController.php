<?php
App::uses('AppController', 'Controller');
/**
 * Visiteordres Controller
 *
 * @property Visiteordre $Visiteordre
 * @property PaginatorComponent $Paginator
 */
class VisiteordresController extends AppController {

/**
 * Components
 *
 * @var array
 */
	function system_get_visiteordre($visite_id)
	{
		return $this->Visiteordre->find("all",array("conditions"=>array("Visiteordre.visite_id"=>$visite_id),"order"=>array("Visiteordre.id ASC")));
	}

}
