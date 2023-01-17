<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

use DateTimeImmutable;
use Sfadless\YandexTracker\Task\Email;
use Sfadless\YandexTracker\Task\Employee;

/**
 * CommentTrait
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
trait CommentTrait
{
    protected ?string $id = null;
    protected ?string $longId = null;
    protected ?string $selfUrl = null;
    protected ?string $text = null;
    protected ?Email $email = null;
    protected ?Employee $createdBy = null;
    protected ?Employee $updatedBy = null;
    protected ?DateTimeImmutable $createdAt = null;
    protected ?DateTimeImmutable $updatedAt = null;
    protected int $version = 1;
    protected string $type = CommentTypes::STANDARD;
    protected string $transport = CommentTransports::INTERNAL;

    public function getSelfUrl(): ?string
    {
        return $this->selfUrl;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLongId(): ?string
    {
        return $this->longId;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function getCreatedBy(): ?Employee
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): ?Employee
    {
        return $this->updatedBy;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTransport(): string
    {
        return $this->transport;
    }

    public function getEmail(): ?Email
    {
        return $this->email;
    }
}