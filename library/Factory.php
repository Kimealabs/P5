<?
  namespace Library;
  use Controllers;

  class Factory {

    static function follow(Router $route) {
      $controller = ucfirst(strtolower($route->getController()));
      $classController = 'Controllers\\'.$controller."Controller";
      if (class_exists($classController)) {
        $control = new $classController;
      }

      if (method_exists($classController, $route->getAction()) ) {
        $action = $route->getAction();
        $control->$action($route);
      }
      else {
        $noWhere = new Controllers\Code404Controller();
        $noWhere->default($route);
        exit;
      }
    }
  }

