<?
  namespace Library;
  use Controllers;

  class Factory {

    public function __construct(Router $route) {
      $controller = ucfirst(strtolower($route->getController()));
      $classController = 'Controllers\\'.$controller."Controller";
      if (class_exists($classController)) {
        $controllerView = new $classController($route);
      }

      if (method_exists($classController, $route->getAction()) ) {
        $action = $route->getAction();
        $controllerView->$action();
      }
      else {
        $noWhere = new Controllers\Code404Controller();
        $noWhere->default();
        exit;
      }
    }
  }
