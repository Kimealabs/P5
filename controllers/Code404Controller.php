<?php

namespace Controllers;

use Library\AbstractController;

class Code404Controller extends AbstractController
{

  public function default(): void
  {
    $this->view->setData('route', $this->route);
    $this->view->render('code404', 'std');
  }
}
