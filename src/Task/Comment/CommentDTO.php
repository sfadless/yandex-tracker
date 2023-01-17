<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

use DateTimeImmutable;
use Sfadless\YandexTracker\Task\Email;
use Sfadless\YandexTracker\Task\Employee;

/**
 * CommentDTO
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CommentDTO
{
    use CommentTrait;

    public function setSelfUrl(string $selfUrl): CommentDTO
    {
        $this->selfUrl = $selfUrl;
        return $this;
    }

    public function setId(string $id): CommentDTO
    {
        $this->id = $id;
        return $this;
    }

    public function setLongId(string $longId): CommentDTO
    {
        $this->longId = $longId;
        return $this;
    }

    public function setText(string $text): CommentDTO
    {
        $this->text = $text;
        return $this;
    }

    public function setCreatedBy(Employee $createdBy): CommentDTO
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function setUpdatedBy(Employee $updatedBy): CommentDTO
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function setVersion(int $version): CommentDTO
    {
        $this->version = $version;
        return $this;
    }

    public function setType(string $type): CommentDTO
    {
        $this->type = $type;
        return $this;
    }

    public function setTransport(string $transport): CommentDTO
    {
        $this->transport = $transport;
        return $this;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): CommentDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setUpdatedAt(DateTimeImmutable $updatedAt): CommentDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function setEmail(?Email $email): CommentDTO
    {
        $this->email = $email;
        return $this;
    }
}