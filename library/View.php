<?php

namespace Library;

abstract class View
{

  private $data = array();
  protected $session;
  protected $route;

  public function __construct(Router $route, Session $session)
  {
    $this->session = $session;
    $this->route = $route;
    $flash = $this->getFlash();
    $this->setData('flash', $flash);
  }

  public function render($view, $template)
  {
    if ($view == '') $view = 'index';
    foreach ($this->data as $key => $value) {
      $$key = $value;
    }

    ob_start();
    include './view/' . $view . '.view.php';
    $main = ob_get_clean();
    $config = yaml_parse_file('./config.yaml');
    $socialNetworks = $config['socialNetworks'];
    include './templates/' . $template . '.html.php';
    exit;
  }

  public function setData($key, $value)
  {
    $this->data[$key] = $value;
  }

  public function setFlash(string $type, string $message): void
  {
    $this->session->set('flash', ['type' => $type, 'message' => $message]);
  }

  public function getFlash(): array
  {
    if ($this->session->get('flash')) {
      $flash = $this->session->get('flash');
      $this->session->delete('flash');
      return $flash;
    } else return [];
  }

  public function cancelFlash(): void
  {
    $this->session->delete('flash');
  }
}
