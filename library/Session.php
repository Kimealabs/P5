<?php

namespace Library;

final class Session
{

  private static $instance = null;

  public function __construct()
  {
    session_start();
  }

  final public static function getInstance()
  {
    if (!(self::$instance instanceof self)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function token()
  {
    $token = uniqid('', true);
    $this->set('token', $token);
    return $token;
  }

  public function set(string $key, $value)
  {
    $_SESSION[$key] = $value;
  }

  public function get(string $key)
  {
    if (isset($_SESSION[$key])) return $_SESSION[$key];
    else return false;
  }

  public function delete(string $key)
  {
    if (isset($_SESSION[$key])) unset($_SESSION[$key]);
  }

  public function __clone()
  {
    throw new \Exception('Cet objet ne peut pas être cloné');
  }

  public function __wakeup()
  {
    throw new Exception('Cet objet ne peut pas être désérialisé');
  }

  public function signout()
  {
    $this->delete('login');
  }
}
