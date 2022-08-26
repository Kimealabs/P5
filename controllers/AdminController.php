<?php

namespace Controllers;

use Managers;
use Entities\Post;
use Entities\Comment;
use Library\AbstractController;

class AdminController extends AbstractController
{
    // TEST IF SESSION LOGIN EXIST AND USER LEVEL > 0 ELSE => 404
    private function security(): void
    {
        if ($this->session->get('login')) {
            $userManager = new Managers\UserManager();
            $user = $userManager->get($this->session->get('login'));
            if ($user->getLevel() == 0) $this->route->redirect('404');
            else {
                $userManager = new Managers\UserManager();
                $user = $userManager->get($user->getId());
                $this->view->setData('user', $user);
                $commentManager = new Managers\CommentManager();
                $commentsToValidate = $commentManager->toValid();
                if (count($commentsToValidate) > 0)  $this->view->setData('commentsToValidate', $commentsToValidate);
            }
        } else {
            $this->route->redirect('404');
        }
    }

    //IF EMPTY ACTION ON ROUTE OBJECT => DEFAULT
    public function default(): void
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
        $blogposts = $postManager->getAll();
        $this->view->setData('blogposts', $blogposts);
        $this->view->setData('userManager', $userManager);
        $this->view->render('admin/blogposts', 'admin');
    }

    // SHOW ALL POSTS
    public function blogposts(): void
    {
        $this->default();
    }

    // UPDATE POST PAGE
    public function blogpost(): void
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
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
                if ($params['post']['author'] == '') $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Erreur réseau, désolé !<br/>';
                else {
                    $params['post']['userId'] = $params['post']['author'];
                    $author = $userManager->get($params['post']['userId']);
                    // TEST LEVEL USER TO UPDATE PERMISSION 
                    if (!$author || $author->getLevel() == 0) $error .= '<i class="fa-solid fa-circle-exclamation text-danger"></i> Erreur réseau, désolé !<br/>';
                }
                if (!$error) {
                    // TAKE SESSION['POST'] TO HYDRATE POST ID ENTITY
                    $params['post']['id'] = $this->session->get('post');
                    $postEntity = new Post($params['post']);
                    $postEntity->setId($blogpost->getId());
                    $postManager->$method($postEntity);
                    $this->view->setData('response', '<div class="alert alert-success" role="alert"><i class="fa-solid fa-check"></i> Modifications enregistrées!</div>');
                    $blogpost = $postManager->get($params['get']);
                    $this->view->setFlash('success', 'Mise à jour effectuée !');
                    $this->route->redirect('admin/blogpost/' . $blogpost->getId());
                } else {
                    $this->view->setData('response', $error);
                }
            }

            if ($method == 'delete') {
                $params['post']['id'] = $this->session->get('post');
                $postEntity = new Post($params['post']);
                $postManager->delete($postEntity);
                $this->view->setFlash('success', 'Le Post est effacé !');
                $this->route->redirect('admin/blogposts');
            }
        }

        $authors = $userManager->getAllAdmin();

        $this->view->setData('authors', $authors);
        $this->view->setData('blogpost', $blogpost);
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        //CREATE POST SESSION TO INJECT POST ID FORM
        $this->session->set('post', $blogpost->getId());
        // TOKEN TO HIDDEN FIELD
        $this->view->setData('token', $token);

        $this->view->render('admin/blogpost', 'admin');
    }

    // CREATE POST PAGE
    public function createBlogpost(): void
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
                $params['userId'] = $this->session->get('login');
                $postEntity = new Post($params['post']);
                $postEntity->setUserId($this->session->get('login'));
                $postManager->create($postEntity);
                $this->view->setFlash('success', 'Le post est publié !');
                $this->route->redirect('admin/blogposts');
            } else {
                $this->view->setData('response', $error);
            }
        }
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->view->setData('token', $token);

        $this->view->render('admin/create', 'admin');
    }

    // LIST COMMENT(s) TO VALIDATE AND ALSO (IF ACTION BY BUTTON) => UPDATE STATUS COMMENT TO 1 (VALID) OR 2 (ARCHIVE, considered like deleted)
    public function comments(): void
    {
        $this->security();
        $userManager = new Managers\UserManager();
        $postManager = new Managers\PostManager();
        $commentManager = new Managers\CommentManager();

        $params = $this->route->getParams();
        if (!empty($params['post']) && $params['post']['token'] == $this->session->get('token')) {
            $commentEntity = new Comment($params['post']);
            $commentManager->update($commentEntity);
            if ($commentEntity->getStatus() == 1) $this->view->setFlash('success', 'Le commentaire est publié !');
            else $this->view->setFlash('success', 'Commentaire supprimé !');
            $this->route->redirect('admin/comments');
        }

        $comments = $commentManager->toValid();
        $this->view->setData('comments', $comments);
        $this->view->setData('userManager', $userManager);

        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->view->setData('token', $token);

        $this->view->render('admin/comments', 'admin');
    }
}
