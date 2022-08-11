<?php

namespace Library;

class Router
{

  private $controller;
  private $action;
  private $params = array();

  public function __construct()
  {
    $route = ['index', 'default'];
    $getRoute = isset($_GET['route']) ? $_GET['route'] : '';
    $url = filter_var($getRoute, FILTER_SANITIZE_URL);
    if (isset($url) && $url != '') $route = explode('/', $url);
    $this->controller = ($route[0] != '') ? filter_var($route[0], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'index';
    $this->action = isset($route[1]) ? filter_var($route[1], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'default';
    $this->params['get'] = isset($route[2]) ? filter_var($route[2], FILTER_SANITIZE_NUMBER_INT) : '';
    $this->params['post'] = isset($_POST) ? filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : [];
  }

  public function getController(): string
  {
    return $this->controller;
  }

  public function getAction(): string
  {
    return $this->action;
  }

  public function getParams(): array
  {
    return $this->params;
  }

  public function setParams($value): void
  {
    $this->params = $value;
  }

  public function redirect($url): void
  {
    header('Location: ' . PATH . '/' . $url);
  }
}
