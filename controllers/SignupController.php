<?php

namespace Controllers;

use Library;
use Managers;
use Entities;

class SignupController extends Library\View
{

  public function default()
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
        $this->setData('response', $error);
      }
    }
    $this->setData('name', $name);
    $this->setData('email', $email);
    $this->setData('password', '');
    //CREATE AND TAKE TOKEN SESSION
    $token = $this->session->token();
    // TOKEN TO HIDDEN FIELD
    $this->setData('token', $token);
    $this->render('signup', 'std');
  }
}
