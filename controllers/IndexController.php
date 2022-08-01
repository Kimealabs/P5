<?php
  namespace Controllers;

  use Library;

  class IndexController extends Library\View {

    public function default() {
      $this->render('home', 'std');
    }
  }