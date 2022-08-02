<?php

  namespace Entities;

  use Library\Entity;

  class User extends Entity {

    private $email;
    private $password;
    private $name;
    private $level;

    public function setName(string $name) {
      $this->name = $name;
    }

    public function setEmail(string $email) {
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) $this->email = $email;
    }

    public function setPassword(string $password) {
      $this->password = $password;
    }

    public function setLevel(int $level) {
      $this->level = $level;
    }

    public function getName() {
      return (string) html_entity_decode($this->name);
    }

    public function getEmail() {
      return (string) $this->email;
    }

    public function getPassword() {
      return (string)$this->password;
    }

    public function getLevel() {
      return (int)$this->level;
    }
  }
