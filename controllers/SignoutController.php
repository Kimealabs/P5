<?php

namespace Controllers;

use Library;

class SignoutController extends Library\View
{

  public function default()
  {
    $this->session->signout();
    $this->session->set('flash', ['type' => 'success', 'message' => 'Vous êtes Déconnecté !']);
    $this->route->redirect('./');
  }
}
