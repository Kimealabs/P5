<?php

namespace Controllers;

use Library\AbstractController;
use Managers;

class IndexController extends AbstractController
{
  // HOME PAGE CONTROLLER (DEFAULT = EMPTY ACTION ON ROUTE OBJECT)
  public function default(): void
  {
    $this->view->setData('message', 'Bienvenue à tous<br/>');
    $postManager = new Managers\PostManager();
    $userManager = new Managers\UserManager();
    $posts = $postManager->getAll(2);
    $this->view->setData('userManager', $userManager);
    $this->view->setData('posts', $posts);

    $this->view->render('home', 'std');
  }
}
