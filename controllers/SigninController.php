<?php

namespace Controllers;

use Library;
use Managers;
use Entities;

class SigninController extends Library\View
{

  private $userManager;

  public function default()
  {
    //CREATE AND TAKE TOKEN SESSION
    $token = $this->session->token();
    // TOKEN TO HIDDEN FIELD
    $this->setData('token', $token);
    $this->render('signin', 'std');
  }

  public function connect()
  {
    $this->userManager = new Managers\UserManager();
    $params = $this->route->getParams();
    $userEntity = new Entities\User($params['post']);
    $user = $this->userManager->login($userEntity, $params['post']['token']);
    if ($user) {
      $this->session->set('login', $user->getId());
      $this->session->set('level', $user->getLevel());
      $this->session->delete('token');
      $this->setFlash('success', 'Vous êtes maintenant connecté !');
      $this->route->redirect('./');
    } else {
      if ($this->session->get('login')) $this->session->delete('login');
      $token = $this->session->token();
      $this->setData('token', $token);
      $this->setFlash('danger', 'L\'authentification a échoué !');
      $this->route->redirect('signin');
    }
    $this->render('signin', 'std');
  }
}
