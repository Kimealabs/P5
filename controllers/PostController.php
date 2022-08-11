<?php

namespace Controllers;

use Entities;
use Managers;
use Library\AbstractController;

class PostController extends AbstractController
{

  public function id(): void
  {
    $postManager = new Managers\PostManager();
    $commentManager = new Managers\CommentManager();
    $userManager = new Managers\UserManager();
    $params = $this->route->getParams();
    if (isset($params['get']) && $params['get'] > 0) {
      $post = $postManager->get((int) $params['get']);
      if (!$post) {
        $this->route->redirect('404');
      }
      $this->view->setData('post', $post);
      $this->session->set('blogpost', $params['get']);
      $comments = $commentManager->getAll($params['get']);
      $this->view->setData('comments', $comments);
      $this->view->setData('userManager', $userManager);

      $this->view->render('post', 'std');
    }
    $this->route->redirect('404');
  }

  public function addComment(): void
  {
    if ($this->session->get('login')) {
      $params = $this->route->getParams();
      $commentEntity = new Entities\Comment($params['post']);
      $commentEntity->setUserId($this->session->get('login'));
      $commentEntity->setPostId($this->session->get('blogpost'));
      if ($commentEntity->getContent() == '') {
        $this->view->setFlash('danger', 'Un commentaire ne peut être vide !');
        $this->route->redirect('post/id/' . $this->session->get('blogpost'));
      } else {
        $commentManager = new Managers\CommentManager();
        $commentManager->create($commentEntity);
        $this->view->setFlash('success', 'Le commentaire est posté et en attente de validation !');
        $this->route->redirect('post/id/' . $this->session->get('blogpost'));
      }
    } else {
      $this->route->redirect('404');
    }
  }
}
