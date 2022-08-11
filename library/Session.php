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

  public function token(): string
  {
    $token = uniqid('', true);
    $this->set('token', $token);
    return $token;
  }

  public function set(string $key, $value): void
  {
    $_SESSION[$key] = $value;
  }

  public function get(string $key): array|string|bool
  {
    return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
  }

  public function delete(string $key): void
  {
    unset($_SESSION[$key]);
  }

  public function __clone(): void
  {
    throw new \Exception('Cet objet ne peut pas être cloné');
  }

  public function __wakeup(): void
  {
    throw new Exception('Cet objet ne peut pas être désérialisé');
  }

  public function signout(): void
  {
    $this->delete('login');
    $this->delete('level');
  }
}
