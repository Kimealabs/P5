<?php

namespace Controllers;

use Library\AbstractController;

class ContactController extends AbstractController
{

  public function default(): void
  {
    //CREATE AND TAKE TOKEN SESSION
    $token = $this->session->token();
    // TOKEN TO HIDDEN FIELD
    $this->view->setData('token', $token);
    $this->view->render('contact', 'std');
  }

  public function send(): void
  {
    $params = $this->route->getParams();
    $error = false;
    if (empty($params['post']['name'])) {
      $error .= '<div class="alert alert-danger" role="alert">Le nom est obligatoire!</div>';
    }

    if (empty($params['post']['email'])) {
      $error .= '<div class="alert alert-danger" role="alert">L\'adresse Email est obligatoire!</div>';
    } else {
      if (!filter_var(($params['post']['email']), FILTER_VALIDATE_EMAIL)) {
        $error .= '<div class="alert alert-danger" role="alert">Mauvais format d\'adresse Email!</div>';
      }
    }

    if (empty($params['post']['message'])) {
      $error .= '<div class="alert alert-danger" role="alert">Votre message est vide!</div>';
    }

    if ($params['post']['token'] != $this->session->get('token')) {
      $error .= '<div class="alert alert-danger" role="alert">Erreur réseau!</div>';
    }

    if ($error) {
      //CREATE AND TAKE TOKEN SESSION
      $token = $this->session->token();
      // TOKEN TO HIDDEN FIELD
      $this->view->setData('token', $token);
      $this->view->setData('response', $error);
    }

    if (!$error) {
      $config = yaml_parse_file('./config.yaml');
      $name = strip_tags(htmlspecialchars($params['post']['name']));
      $email = strip_tags(htmlspecialchars($params['post']['email']));
      $message = strip_tags(htmlspecialchars($params['post']['message']));
      $to      = $config['email'];
      $subject = "P5 message";
      $message = "Vous avez reçu un message du blog P5.\n\n\nDe : $name\n\nAdresse email : $email\n\nMessage :\n$message";
      $headers = array(
        'From' => $email,
        'Reply-To' => $email,
        'X-Mailer' => 'PHP/' . phpversion()
      );
      mail($to, $subject, $message, $headers);
      $this->view->setData('response', '<div class="alert alert-success" role="alert">Le message est envoyé!</div>');
    }
    $this->view->render('contact', 'std');
  }
}
