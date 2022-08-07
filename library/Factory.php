<?php

namespace Library;

use Controllers;

class Factory
{

  public function __construct(Router $route)
  {
    $controller = ucfirst(strtolower($route->getController()));
    $classController = 'Controllers\\' . $controller . "Controller";
    $session = Session::getInstance();
    if (class_exists($classController)) {
      // classController Parent is View => construct (Router, Session)
      $controllerView = new $classController($route, $session);
    }

    if (method_exists($classController, $route->getAction())) {
      $action = $route->getAction();
      $controllerView->$action();
    } else {
      $noWhere = new Controllers\Code404Controller($route, $session);
      $noWhere->default();
      exit;
    }
  }
}
