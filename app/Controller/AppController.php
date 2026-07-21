<?php

App::uses('Controller', 'Controller');


class AppController extends Controller
{
  var $components = array('Auth', 'Session', 'Cookie');
  public function beforeFilter()
  {
    $this->Auth->authError = __('E-mail ou mot de passe incorrect');
    $this->Auth->loginError = __("session expirée merci d'entrer votre email et mot de passe");
    $this->Auth->authorize = 'Controller';

    //$this->Auth->allow();
  }



  public function isAuthorized()
  {

    $this->loadModel('Droit');
    $this->Droit->recursive = -1;
    $pos = strpos($this->params['action'], "system");
    if ($pos === false) {
      //systeme de log ecrire dans la table looog tout les click et event demender par un user
      $this->loadModel('Looog');
      $this->Looog->create();
      $d = array();
      $d["user_id"] = AuthComponent::user("id");
      $d["lien"] = $this->params->url;
      $this->Looog->save($d);

      $nbAcces = $this->Droit->find('count', array(
        'conditions' =>
        array(
          'name' => $this->params['controller'] . '|' . $this->params['action'],
          'user_id' => $this->Auth->user('id')
        )
      ));
    } else
      $nbAcces = 1;
    if ($nbAcces == 0) {
      $this->Session->setFlash('Erreur de navigation, merci de contacter l\'administrateur de l\'application.');
      $this->redirect(array('controller' => 'users', 'action' => 'view'));
    } else
      return true;
  }
}
