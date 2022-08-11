<?php

namespace Entities;

use Library\Entity;

class User extends Entity
{

  private $email;
  private $password;
  private $name;
  private $level;

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function setEmail(string $email): void
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) $this->email = $email;
  }

  public function setPassword(string $password): void
  {
    $this->password = $password;
  }

  public function setLevel(int $level): void
  {
    $this->level = $level;
  }

  public function getName(): string
  {
    return (string) html_entity_decode($this->name);
  }

  public function getEmail(): string
  {
    return (string) $this->email;
  }

  public function getPassword(): string
  {
    return (string)$this->password;
  }

  public function getLevel(): int
  {
    return (int)$this->level;
  }
}
