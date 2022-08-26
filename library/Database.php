<?php

namespace Library;

//SINGLETON PATTERN, ONE CONNECTION FOR ALL REQUEST
final class Database
{

  private static $instance = null;
  private $pdo;

  private function __construct()
  {
    $config = yaml_parse_file('./config.yaml');
    try {
      $this->pdo = new \PDO($config['database']['driver'] . ':host=' . $config['database']['host'] . ';dbname=' . $config['database']['db_name'] . ';charset=utf8', $config['database']['user'], $config['database']['password']);
    } catch (\PDOException $e) {
      print_r($e->getMessage());
    }
  }


  final public static function getInstance(): Database
  {
    if (!(self::$instance instanceof self)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __clone(): void
  {
    throw new \Exception('Cet objet ne peut pas être cloné');
  }

  public function __wakeup(): void
  {
    throw new Exception('Cet objet ne peut pas être désérialisé');
  }

  public function pdo(): \PDO
  {
    return $this->pdo;
  }
}
