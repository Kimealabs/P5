<?php

namespace Entities;

use Library\Entity;

class Comment extends Entity
{

  private $userId;
  private $createAt;
  private $postId;
  private $content;
  private $status;

  public function setUserId(int $userId)
  {
    $this->userId = $userId;
  }

  public function setCreatedAt(string $createAt)
  {
    $this->createAt = $createAt;
  }

  public function setPostId(int $postId)
  {
    $this->postId = $postId;
  }

  public function setContent(string $content)
  {
    $this->content = $content;
  }

  public function setStatus(int $status)
  {
    $this->status = $status;
  }

  public function getUserId()
  {
    return (int) $this->userId;
  }

  public function getCreatedAt()
  {
    return (string) $this->createAt;
  }

  public function getPostId()
  {
    return (int) $this->postId;
  }

  public function getContent()
  {
    return (string) str_replace(array('\n', '\r\n', '\r'), array("\n", "\r\n", "\r"), $this->content);
  }

  public function getStatus()
  {
    return (int) $this->status;
  }
}
