<?
  namespace Controllers;

  class IndexController {

    protected $route;

    public function construct(Router $route) {
      $this->route = $route;
    }

    public function default() {
      echo "Welcome on Homepage !";
    }
  }