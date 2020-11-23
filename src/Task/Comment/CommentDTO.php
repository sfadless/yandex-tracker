<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

use DateTimeImmutable;
use Sfadless\YandexTracker\Task\Employee;

/**
 * CommentDTO
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CommentDTO
{
    use CommentTrait;

    /**
     * @param string|null $selfUrl
     * @return CommentDTO
     */
    public function setSelfUrl(string $selfUrl): CommentDTO
    {
        $this->selfUrl = $selfUrl;
        return $this;
    }

    /**
     * @param string|null $id
     * @return CommentDTO
     */
    public function setId(string $id): CommentDTO
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $longId
     * @return CommentDTO
     */
    public function setLongId(string $longId): CommentDTO
    {
        $this->longId = $longId;
        return $this;
    }

    /**
     * @param string|null $text
     * @return CommentDTO
     */
    public function setText(string $text): CommentDTO
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param Employee|null $createdBy
     * @return CommentDTO
     */
    public function setCreatedBy(Employee $createdBy): CommentDTO
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @param Employee|null $updatedBy
     * @return CommentDTO
     */
    public function setUpdatedBy(Employee $updatedBy): CommentDTO
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * @param int $version
     * @return CommentDTO
     */
    public function setVersion(int $version): CommentDTO
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param string $type
     * @return CommentDTO
     */
    public function setType(string $type): CommentDTO
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $transport
     * @return CommentDTO
     */
    public function setTransport(string $transport): CommentDTO
    {
        $this->transport = $transport;
        return $this;
    }

    /**
     * @param DateTimeImmutable $createdAt
     * @return CommentDTO
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): CommentDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param DateTimeImmutable $updatedAt
     * @return CommentDTO
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): CommentDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}