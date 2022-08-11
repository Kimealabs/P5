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
    $view = new View($session);
    if (class_exists($classController)) {
      // classController Parent is abstractController => construct (Router, Session, View)
      $controllerView = new $classController($route, $session, $view);
    }

    if (method_exists($classController, $route->getAction())) {
      $action = $route->getAction();
      $controllerView->$action();
    }

    $noWhere = new Controllers\Code404Controller($route, $session, $view);
    $noWhere->default();
  }
}
