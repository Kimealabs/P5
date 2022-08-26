<?php

$loader = require_once __DIR__ . '/vendor/autoload.php';

if (!defined('PATH')) {
  define('PATH', '/p5');
}

$route = new Library\Router();
$ctrl = new Library\Factory($route);
