<?php

namespace Controllers;

use Library;

class SignoutController extends Library\View
{

  public function default()
  {
    $this->session->signout();
    $this->setFlash('primary', 'Vous êtes Déconnecté !');
    $this->route->redirect('./');
  }
}
