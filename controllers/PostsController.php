<?php

namespace Controllers;

use Library;
use Managers;

class PostsController extends Library\View
{

  public function default()
  {
    $this->setData('message', 'Bienvenue à tous<br/>');
    $postManager = new Managers\PostManager();
    $userManager = new Managers\UserManager();
    $posts = $postManager->getAll();
    $this->setData('userManager', $userManager);
    $this->setData('posts', $posts);
    $this->render('posts', 'std');
  }
}
