<?php

  namespace Managers;

  use Entities\Comment;
  use Library\Manager;

  class CommentManager extends Manager {

    public function create(Comment $comment) {
      $req = $this->db->prepare("INSERT INTO Comment (created_at, user_id, post_id, content, status) VALUES (NOW(), :user, :blogpost, :content, 0)");
      $req->bindValue(":user",$comment->getUserId());
      $req->bindValue(":blogpost", $comment->getPostId());
      $req->bindValue(":content", $comment->getContent());
      $req->execute();
    }

    public function update(Comment $comment) {
      $req = $this->db->prepare("UPDATE Comment SET status = :status WHERE id = :id");
      $req->bindValue(":id", $comment->getId());
      $req->bindValue(":status", $comment->getStatus());
      $req->execute();
    }

    public function delete(Comment $comment) {
      $req = $this->db->prepare("DELETE FROM Comment WHERE id = :id");
      $req->bindValue(":id", $comment->getId());
      $req->execute();
    }

    public function get(int $id) {
      $req = $this->db->prepare("SELECT * FROM Comment WHERE id = :id");
      $req->bindValue(":id", $id);
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $comment = new Comment($req->fetch());
      return $comment;
    }

    public function getAll(int $blogpost = 0) {
      if ($blogpost > 0) $target = "AND post_id = ".$blogpost;
      else $target = "";
      $req = $this->db->prepare("SELECT * FROM Comment WHERE status = 1 ".$target." ORDER BY created_at DESC");
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $comments = [];
      while ($comment = $req->fetch()) {
        $comments[] = new Comment($comment);
      }
      return $comments;
    }

    public function toValid() {
      $req = $this->db->prepare("SELECT * FROM Comment WHERE status = 0 ORDER BY date DESC");
      $req->execute();
      $req->setFetchMode(\PDO::FETCH_ASSOC);
      $comments = [];
      while ($comment = $req->fetch()) {
        $comments[] = new Comment($comment);
      }
      return $comments;
    }

  }
