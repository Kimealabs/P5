<?php

  namespace Library;

  class Router {

    private $controller;
    private $action;
    private $params = array();

    public function __construct() {
      $route = ['index', 'default'];
      $url = filter_var($_GET['route'], FILTER_SANITIZE_URL);
      if (isset($url) && $url != '') $route = explode('/', $url);
      $this->controller = ($route[0] != '') ? filter_var($route[0], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'index';
      $this->action = isset($route[1]) ? filter_var($route[1], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : 'default';
      $this->params['get'] = isset($route[2]) ? filter_var($route[2], FILTER_SANITIZE_NUMBER_INT) : '';
      $this->params['post'] = ($_POST) ? filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : [];
    }

    public function getController() {
      return $this->controller;
    }

    public function getAction() {
      return $this->action;
    }

    public function getParams() {
      return $this->params;
    }

    public function setParams($value) {
      $this->params = $value;
    }

    public function redirect($url) {
      header('Location: '.PATH.'/'.$url);
    }
  }
