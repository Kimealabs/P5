<?php

namespace Controllers;

use Entities;
use Managers;
use Library\AbstractController;

class UserController extends AbstractController
{

    private $userManager;

    // SIGNIN PAGE DEFAULT FORM
    public function signin(): void
    {
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->view->setData('token', $token);
        $this->view->render('signin', 'std');
    }

    // LOGIN SYSTEM => CONTROL IF USER EXIST = REDIRECT TO HOME ELSE TO SIGNIN PAGE WITH MESSAGE
    public function connect(): void
    {
        $this->userManager = new Managers\UserManager();
        $params = $this->route->getParams();
        $userEntity = new Entities\User($params['post']);
        $user = $this->userManager->login($userEntity, $params['post']['token']);
        if ($user) {
            $this->session->set('login', $user->getId());
            $this->session->set('level', $user->getLevel());
            $this->session->delete('token');
            $this->view->setFlash('success', 'Vous êtes maintenant connecté !');
            $this->route->redirect('./');
        } else {
            if ($this->session->get('login')) $this->session->delete('login');
            $token = $this->session->token();
            $this->view->setData('token', $token);
            $this->view->setFlash('danger', 'L\'authentification a échoué !');
            $this->route->redirect('user/signin');
        }
        $this->view->render('signin', 'std');
    }

    // SIGNOUT METHOD, REDIRECT TO HOME
    public function signout(): void
    {
        $this->session->signout();
        $this->view->setFlash('primary', 'Vous êtes Déconnecté !');
        $this->route->redirect('./');
    }

    // SIGNUP METHOD WITH FORM CONTROL, SHOW MESSAGE ON SIGNUP PAGE IF ERROR, REDIRECT ON HOME WITH FLASH IN CASE OF SUCCESS
    public function signup(): void
    {
        $userManager = new Managers\UserManager();
        $params = $this->route->getParams();
        $email = '';
        $name = '';
        if (!empty($params['post'])) {
            $email = $params['post']['email'];
            $name = $params['post']['name'];

            $error = '';
            if ($params['post']['email'] == '') $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> L\'Adresse email est obligatoire</div>';
            else {
                if (!filter_var($params['post']['email'], FILTER_VALIDATE_EMAIL)) $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> Mauvais format d\'adresse email</div>';
                else {
                    $user = $userManager->getByEmail($params['post']['email']);
                    if ($user) $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> Cette Adresse email existe déjà dans notre base de données</div>';
                }
            }
            if ($params['post']['name'] == '') $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> Votre nom est obligatoire</div>';
            else {
                if (!preg_match("/^[a-z\ &;,.'-]+$/i", $params['post']['name'])) {
                    $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> Votre nom ne peux pas contenir de caractères spéciaux</div>';
                }
            }
            if ($params['post']['password'] == '') $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> Votre mot de passe est obligatoire</div>';
            else {
                if (strlen($params['post']['password']) < 6 || strlen($params['post']['password']) > 10) $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> La longueur du mot de passe est incorrecte</div>';
            }

            if ($params['post']['token'] == '' || $params['post']['token'] != $this->session->get('token')) $error .= '<div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation text-danger"></i> Erreur réseau, désolé !</div>';

            if (!$error) {
                $userEntity = new Entities\User($params['post']);
                $userManager->create($userEntity);
                $this->session->delete('token');

                $this->session->set('flash', ['type' => 'success', 'message' => '<i class="fa-solid fa-hands-clapping text-success"></i> Votre inscription est validée !<br/><br/>Vous pouvez vous connecter et commenter !']);
                $this->route->redirect('./');
            } else {
                $this->view->setData('response', $error);
            }
        }
        $this->view->setData('name', $name);
        $this->view->setData('email', $email);
        $this->view->setData('password', '');
        //CREATE AND TAKE TOKEN SESSION
        $token = $this->session->token();
        // TOKEN TO HIDDEN FIELD
        $this->view->setData('token', $token);
        $this->view->render('signup', 'std');
    }
}
