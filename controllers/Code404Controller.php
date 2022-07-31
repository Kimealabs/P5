<?
  namespace Controllers;

  class Code404Controller {

    protected $route;

    public function construct(Router $route) {
      $this->route = $route;
    }

    public function default() {
        echo "404";
    }
  }

