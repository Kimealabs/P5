<?

namespace Library;

//essai

class Router
{

  private $controller;

  private $action;

  private $params = array();



  public function __construct()
  {

    $route = ['index', 'default'];

    if (isset($_GET['route']) && $_GET['route'] != '') $route = explode('/', filter_var($_GET['route'], FILTER_SANITIZE_URL));

    $this->controller = ($route[0] != '') ? $route[0] : 'index';

    $this->action = isset($route[1]) ? $route[1] : 'default';

    $this->params['get'] = isset($route[2]) ? (int) $route[2] : '';

    $this->params['post'] = isset($_POST) ? $_POST : [];
  }



  public function getController()
  {

    return $this->controller;
  }



  public function getAction()
  {

    return $this->action;
  }



  public function getParams()
  {

    return $this->params;
  }



  public function setParams($value)
  {

    $this->params = $value;
  }



  public function redirect($url)
  {

    header('Location: ' . PATH . '/' . $url);
  }
}
