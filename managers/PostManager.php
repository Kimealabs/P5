<?php

  namespace Managers;

  use Entities\Post;
  use Library\Manager;

  class PostManager extends Manager {

    public function create(Post $blogpost) {
      $req = $this->db->prepare("INSERT INTO Post (created_at, modified_at, title, chapo, content, author) VALUES (NOW(), NULL, :title, :chapo, :content, :author)");
      $req->bindValue(":title", $blogpost->getTitle());
      $req->bindValue(":chapo", $blogpost->getChapo());
      $req->bindValue(":content", $blogpost->getContent());
      $req->bindValue(":author", $blogpost->getAuthor());
      $req->execute();
    }

    public function update(Post $blogpost) {
      $req = $this->db->prepare("UPDATE Post SET title = :title, chapo = :chapo, content = :content, author = :author, modified_at = NOW() WHERE id = :id");
      $req->bindValue(":id", $blogpost->getId());
      $req->bindValue(":title", $blogpost->getTitle());
      $req->bindValue(":chapo", $blogpost->getChapo());
      $req->bindValue(":content", $blogpost->getContent());
      $req->bindValue(":author", $blogpost->getAuthor());
      $req->execute();
    }

    public function delete(Post $blogpost) {
      $req = $this->db->prepare("DELETE FROM Post WHERE id = :id");
      $req->bindValue(":id", $blogpost->getId());
      $req->execute();
    }

    public function get(int $id) {
      $req = $this->db->prepare("SELECT * FROM Post WHERE id = :id");
      $req->bindValue(":id", $id);
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $blogpostManager = $req->fetch();
      $blogpost = ($blogpostManager) ? new Post($blogpostManager) : false;
      return $blogpost;
    }

    public function getAll(int $limit=0) {
      if ($limit > 0) $limit = "LIMIT ".$limit;
      else $limit = "";
      $req = $this->db->prepare("SELECT * FROM Post ORDER BY created_at DESC ".$limit);
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $blogposts = [];
      while ($blogpost = $req->fetch()) {
        $blogposts[] = new Post($blogpost);
      }
      return $blogposts;
    }

  }
