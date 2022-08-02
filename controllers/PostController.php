<?php

  namespace Controllers;

  use Library;
  use Managers;
  use Entities;

  class PostController extends Library\View {

    public function id() {
      $postManager = new Managers\PostManager();
      $commentManager = new Managers\CommentManager();
      $userManager = new Managers\UserManager();
      $params = $this->route->getParams();
      if (isset($params['get']) && $params['get'] > 0) {
        $post = $postManager->get((int) $params['get']);
        if (!$post) {
          $route->redirect('404');
        }
        $this->setData('post', $post);
        $this->session->set('blogpost', $params['get']);
        $comments = $commentManager->getAll($params['get']);
        $this->setData('comments', $comments);
        $this->setData('userManager', $userManager);
        $this->render('post', 'std');
      }
    }

    public function addComment() {
      if ($this->session->get('login')) {
        $params = $this->route->getParams();
        $commentEntity = new Entities\Comment($params['post']);
        $commentEntity->setUser($this->session->get('login'));
        $commentEntity->setBlogpost($this->session->get('blogpost'));
        $commentManager = new Managers\CommentManager();
        $commentManager->create($commentEntity);
        $this->route->redirect('post/id/'.$this->session->get('blogpost'));
      }
      else {
        $this->route->redirect('404');
      }
    }
  }
