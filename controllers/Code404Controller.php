<?php

namespace Controllers;

use Library\AbstractController;

class Code404Controller extends AbstractController
{
  // REDIRECT METHOD TO 404 VIEW
  public function default(): void
  {
    $this->view->setData('route', $this->route);
    $this->view->render('code404', 'std');
  }
}
