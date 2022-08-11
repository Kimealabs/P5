<?php

namespace Controllers;

use Entities;
use Managers;
use Library\AbstractController;

class SigninController extends AbstractController
{

  private $userManager;

  public function default(): void
  {
    //CREATE AND TAKE TOKEN SESSION
    $token = $this->session->token();
    // TOKEN TO HIDDEN FIELD
    $this->view->setData('token', $token);
    $this->view->render('signin', 'std');
  }

  public function connect(): void
  {
    $this->userManager = new Managers\UserManager();
    $params = $this->route->getParams();
    $userEntity = new Entities\User($params['post']);
    $user = $this->userManager->login($userEntity, $params['post']['token']);
    if ($user) {
      $this->session->set('login', $user->getId());
      $this->session->set('level', $user->getLevel());
      $this->session->delete('token');
      $this->view->setFlash('success', 'Vous êtes maintenant connecté !');
      $this->route->redirect('./');
    } else {
      if ($this->session->get('login')) $this->session->delete('login');
      $token = $this->session->token();
      $this->view->setData('token', $token);
      $this->view->setFlash('danger', 'L\'authentification a échoué !');
      $this->route->redirect('signin');
    }
    $this->view->render('signin', 'std');
  }
}
