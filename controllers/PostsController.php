<?php

namespace Controllers;

use Managers;
use Library\AbstractController;

class PostsController extends AbstractController
{

  public function default(): void
  {
    $this->view->setData('message', 'Bienvenue à tous<br/>');
    $postManager = new Managers\PostManager();
    $userManager = new Managers\UserManager();
    $posts = $postManager->getAll();
    $this->view->setData('userManager', $userManager);
    $this->view->setData('posts', $posts);
    $this->view->render('posts', 'std');
  }
}
