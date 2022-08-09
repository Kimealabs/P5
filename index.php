<?php

$loader = require_once __DIR__ . '/vendor/autoload.php';

if (!defined('PATH')) {

  define('PATH', 'localhost');
}

$route = new Library\Router();
$ctrl = new Library\Factory($route);
