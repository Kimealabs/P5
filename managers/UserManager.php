<?php

  namespace Managers;

  use Entities\User;
  use Library;

  class UserManager extends Library\Manager {

    public function login(User $userLogin) {
      if ($this->session->get('token') != $userLogin->getToken()) return false;
      $req = $this->db->prepare("SELECT * FROM User WHERE email = :email");
      $req->bindValue(":email", $userLogin->getEmail());
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $user = $req->fetch();
      if ($user && password_verify($userLogin->getPassword(), $user['password'])) {
        return new User($user);
      }
      else {
        return false;
      }
    }

    public function create(User $user) {
      $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
      $req = $this->db->prepare("INSERT INTO User (name, email, password, level) VALUES (:name, :email, :password, 0)");
      $req->bindValue(":name", $user->getName());
      $req->bindValue(":email", $user->getEmail());
      $req->bindValue(":password", $password);
      $req->execute();
    }

    public function update(User $user) {
      if ($data['password']) {
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
      }
      $req = $this->db->prepare("UPDATE User SET name = :name, email = :email, password = :password, level = :level WHERE id = :id");
      $req->bindValue(":id", $user->getId());
      $req->bindValue(":name", $user->getName());
      $req->bindValue(":email", $user->getEmail());
      $req->bindValue(":password", $user->getPassword());
      $req->bindValue(":level", $user->getLevel());
      $req->execute();
    }

    public function get(int $id) {
      $req = $this->db->prepare("SELECT * FROM User WHERE id = :id");
      $req->bindValue(":id", $id);
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $userManager = $req->fetch();
      $user = ($userManager)? new User($userManager) : false;
      return $user;
    }

    public function getByEmail(string $email) {
      $req = $this->db->prepare("SELECT * FROM User WHERE email = :email");
      $req->bindValue(":email", $email);
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $userManager = $req->fetch();
      $user = ($userManager)? new User($userManager) : false;
      return $user;
    }

    public function getAll() {
      $req = $this->db->prepare("SELECT * FROM User");
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $users = [];
      while ($user = $req->fetch()) {
        $users[] = new User($user);
      }
      return $users;
    }

  }
