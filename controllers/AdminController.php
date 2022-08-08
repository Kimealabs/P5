<?php

namespace Controllers;

use Library;
use Managers;
use Entities\Post;
use Entities\Comment;

class AdminController extends Library\View
{

    private function security()
    {
        if ($this->session->get('login')) {
            $userManager = new Managers\UserManager();
            $user = $userManager->get($this->session->get('login'));
            if ($user->getLevel() == 0) $this->route->redirect('404');
            else {
                $userManager = new Managers\UserManager();
                $user = $userManager->get($user->getId());
                $this->setData('user', $user);
                $commentManager = new Managers\CommentManager();
                $commentsToValidate = $commentManager->toValid();
                if (count($commentsToValidate) > 0)  $this->setData('commentsToValidate', $commentsToValidate);
                return true;
            }
        } else {
            $this->route->redirect('404');
        }
    }

    public function default()
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
        $blogposts = $postManager->getAll();
        $this->setData('blogposts', $blogposts);
        $this->setData('userManager', $userManager);
        $this->render('admin/blogposts', 'admin');
    }

    public function blogposts()
    {
        $this->default();
    }

    public function blogpost()
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
        $commentManager = new Managers\CommentManager();
        $params = $this->route->getParams();

        $blogpost = $postManager->get($params['get']);
        if (!$blogpost) $this->route->redirect('404');

        if (!empty($params['post']) && $params['post']['token'] == $this->session->get('token')) {
            $method = $params['post']['action'];
            if ($method != 'delete' && $method != 'update') $this->route->redirect('404');

            if ($method == 'update') {
                $error = false;
                if ($params['post']['title'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Le titre est obligatoire<br/>';
                if ($params['post']['chapo'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Le chapô est obligatoire<br/>';
                if ($params['post']['content'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Le texte est obligatoire<br/>';
                if ($params['post']['token'] != $this->session->get('token')) $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Erreur réseau, désolé !<br/>';

                if (!$error) {
                    $postEntity = new Post($params['post']);
                    $postEntity->setUserId($this->session->get('login'));
                    $postManager->$method($postEntity);
                    $this->setData('response', '<div class="alert alert-success" role="alert"><i class="fa-solid fa-check"></i> Modifications enregistrées!</div>');
                    $blogpost = $postManager->get($params['get']);
                    $this->setFlash('success', 'Mise à jour effectuée !');
                    $this->route->redirect('admin/blogpost/' . $blogpost->getId());
                } else {
                    $this->setData('response', $error);
                }
            }

            if ($method == 'delete') {
                $postEntity = new Post($params['post']);
                $postEntity->setUserId($this->session->get('login'));
                $postManager->delete($postEntity);
                // $comments = $commentManager->getAll($postEntity->getId());
                // foreach ($comments as $comment) {
                //     $commentManager->delete($comment);
                // }
                $this->setFlash('success', 'Le Post est effacé !');
                $this->route->redirect('admin/blogposts');
            }
        }
        // $blogpost->setChapo(str_replace("<br />", "", $blogpost->getChapo()));
        // $blogpost->setContent(str_replace("<br />", "", $blogpost->getContent()));
        $this->setData('blogpost', $blogpost);
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->setData('token', $token);

        $this->render('admin/blogpost', 'admin');
    }


    public function createBlogpost()
    {
        $this->security();
        $postManager = new Managers\PostManager();
        $params = $this->route->getParams();

        $error = false;
        if (!empty($params['post'])) {
            if ($params['post']['title'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Le titre est obligatoire<br/>';
            if ($params['post']['chapo'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Le chapô est obligatoire<br/>';
            if ($params['post']['content'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Le texte est obligatoire<br/>';
            if ($params['post']['token'] != $this->session->get('token')) $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Erreur réseau, désolé !<br/>';
            if (!$error) {
                $params['author'] = $this->session->get('login');
                $postEntity = new Post($params['post']);
                $postEntity->setUserId($this->session->get('login'));
                $postManager->create($postEntity);
                $this->setFlash('success', 'Le post est publié !');
                $this->route->redirect('admin/blogposts');
            } else {
                $this->setData('response', $error);
            }
        }
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->setData('token', $token);

        $this->render('admin/create', 'admin');
    }


    public function comments()
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
        $commentManager = new Managers\CommentManager();

        $params = $this->route->getParams();
        if (!empty($params['post']) && $params['post']['token'] == $this->session->get('token')) {
            $commentEntity = new Comment($params['post']);
            $commentManager->update($commentEntity);
            if ($commentEntity->getStatus() == 1) $this->setFlash('success', 'Le commentaire est publié !');
            else $this->setFlash('success', 'Commentaire supprimé !');
            $this->route->redirect('admin/comments');
        }

        $comments = $commentManager->toValid();
        $this->setData('comments', $comments);
        $this->setData('userManager', $userManager);
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->setData('token', $token);

        $this->render('admin/comments', 'admin');
    }
}
