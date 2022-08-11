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

  public function setUserId(int $userId): void
  {
    $this->userId = $userId;
  }

  public function setCreatedAt(string $createAt): void
  {
    $this->createAt = $createAt;
  }

  public function setPostId(int $postId): void
  {
    $this->postId = $postId;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  public function setStatus(int $status): void
  {
    $this->status = $status;
  }

  public function getUserId(): int
  {
    return (int) $this->userId;
  }

  public function getCreatedAt(): string
  {
    return (string) $this->createAt;
  }

  public function getPostId(): int
  {
    return (int) $this->postId;
  }

  public function getContent(): string
  {
    return (string) str_replace(array('\n', '\r\n', '\r'), array("\n", "\r\n", "\r"), $this->content);
  }

  public function getStatus(): int
  {
    return (int) $this->status;
  }
}
