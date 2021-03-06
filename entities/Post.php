<?php
  namespace Entities;

  use Library\Entity;

  class Post extends Entity {

    private $title;
    private $chapo;
    private $content;
    private $createdAt;
    private $modifiedAt;
    private $userId;

    public function setTitle(string $title) {
      $this->title = $title;
    }

    public function setChapo(string $chapo) {
      $this->chapo = $chapo;
    }

    public function setContent(string $content) {
      $this->content = $content;
    }

    public function setCreatedAt(string $createdAt) {
      $this->createdAt = $createdAt;
    }

    public function setModifiedAt(string $modifiedAt = NULL) {
      $this->modifiedAt = $modifiedAt;
    }

    public function setUserId(int $userId) {
      $this->userId = $userId;
    }

    public function getTitle() {
      return (string) html_entity_decode($this->title);
    }

    public function getChapo() {
      return (string) nl2br(html_entity_decode($this->chapo));
    }

    public function getContent() {
      return (string) nl2br(html_entity_decode($this->content));
    }

    public function getCreatedAt() {
      return (string) $this->createdAt;
    }

    public function getModifiedAt() {
      return (string) $this->modifiedAt;
    }

    public function getUserId() {
      return (int) $this->userId;
    }
  }
