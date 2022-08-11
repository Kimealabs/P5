<?php

namespace Controllers;

use Library\AbstractController;

class SignoutController extends AbstractController
{

  public function default(): void
  {
    $this->session->signout();
    $this->view->setFlash('primary', 'Vous êtes Déconnecté !');
    $this->route->redirect('./');
  }
}
