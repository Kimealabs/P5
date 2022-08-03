<?php

  namespace Controllers;

  use Library;
 
  class SignoutController extends Library\View {

    public function default() {
        $this->session->signout();
        $this->route->redirect('./');

    }
  }
