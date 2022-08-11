<?php

namespace Entities;

use Library\Entity;

class Post extends Entity
{

  private $title;
  private $chapo;
  private $content;
  private $createdAt;
  private $modifiedAt;
  private $userId;

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function setChapo(string $chapo): void
  {
    $this->chapo = $chapo;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  public function setCreatedAt(string $createdAt): void
  {
    $this->createdAt = $createdAt;
  }

  public function setModifiedAt(string $modifiedAt = NULL): void
  {
    $this->modifiedAt = $modifiedAt;
  }

  public function setUserId(int $userId): void
  {
    $this->userId = $userId;
  }

  public function getTitle(): string
  {
    return (string) $this->title;
  }

  public function getChapo(): string
  {
    //return (string) nl2br(html_entity_decode($this->chapo));
    return (string) str_replace(array('\n', '\r\n', '\r'), array("\n", "\r\n", "\r"), $this->chapo);
  }

  public function getContent(): string
  {
    //return (string) html_entity_decode(nl2br($this->content));
    return (string) str_replace(array('\n', '\r\n', '\r'), array("\n", "\r\n", "\r"), $this->content);
  }

  public function getCreatedAt(): string
  {
    return (string) $this->createdAt;
  }

  public function getModifiedAt(): string
  {
    return (string) $this->modifiedAt;
  }

  public function getUserId(): int
  {
    return (int) $this->userId;
  }
}
