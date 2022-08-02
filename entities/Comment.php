<?php

namespace Entities;

  use Library\Entity;

  class Comment extends Entity {

    private $userId;
    private $createAt;
    private $postId;
    private $content;

    public function setUserId(int $userId) {
      $this->userId = $userId;
    }

    public function setCreatedAt(string $createAt) {
      $this->createAt = $createAt;
    }

    public function setPost_id(int $postId) {
      $this->postId = $postId;
    }

    public function setContent(string $content) {
      $this->content = $content;
    }

    public function getUserId() {
      return (int) $this->userId;
    }

    public function getCreatedAt() {
      return (string) $this->createAt;
    }

    public function getPostId() {
      return (int) $this->postId;
    }

    public function getContent() {
      return (string) nl2br(html_entity_decode($this->content));
    }
  }
