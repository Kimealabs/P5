<?php

  namespace Library;

  final class Database {

    private static $instance = null;
    private $pdo;
    
    private function __construct() {
      $config = yaml_parse_file('./config.yaml');
      try {
        $this->pdo = new \PDO($config['database']['driver'].':host='.$config['database']['host'].';dbname='.$config['database']['db_name'].';charset=utf8', $config['database']['user'], $config['database']['password']);
      }
      catch (\PDOException $e) {
        echo $e->getMessage();
      }
    }


    final public static function getInstance() {
  		if(!(self::$instance instanceof self)) {
  			self::$instance = new self();
  		}
  		return self::$instance;
  	}

    public function __clone() {
      throw new \Exception('Cet objet ne peut pas être cloné');
    }

    public function __wakeup() {
      throw new Exception('Cet objet ne peut pas être désérialisé');
    }

    public function pdo() {
  		return $this->pdo;
  	}
  }
