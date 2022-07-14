<?php

  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $loader = require __DIR__ . '/vendor/autoload.php';

  $path = $_SERVER["PHP_SELF"];

  if (!defined('PATH')) {
      define('PATH', 'localhost/OCR/P5');
  }

  dump($_SERVER);
