<?php

namespace Controllers;

use Library;
use Managers;

class IndexController extends Library\View
{

  public function default()
  {
    $this->setData('message', 'Bienvenue à tous<br/>');
    $postManager = new Managers\PostManager();
    $userManager = new Managers\UserManager();
    $posts = $postManager->getAll(2);
    $this->setData('userManager', $userManager);
    $this->setData('posts', $posts);

    $flash = $this->session->get('flash') ? $this->session->get('flash') : [];
    $this->session->delete('flash');
    $this->setData('flash', $flash);

    $this->render('home', 'std');
  }
}
