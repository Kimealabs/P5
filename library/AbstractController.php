<?php

namespace Library;

// CALLED INDIRECTECTLY BY LEGACY OF ALL "controllers"
abstract class AbstractController
{
    protected $view;
    protected $route;
    protected $session;

    public function __construct(Router $route, Session $session, View $view)
    {
        $this->view = $view;
        $this->route = $route;
        $this->session = $session;
    }
}
