<?php

  namespace Controllers;

  use Library;

  class Code404Controller extends Library\View {

    public function default() {
      $this->setData('route', $this->route);
      $this->render('code404', 'std');

  }
  }

