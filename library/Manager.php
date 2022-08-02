<?php

namespace Library;

abstract class Manager {

  protected $db;
  protected $session;

  public function __construct() {
    $singleton = Database::getInstance();
    $this->db = $singleton->pdo();
    $this->session = Session::getInstance();

  }
}