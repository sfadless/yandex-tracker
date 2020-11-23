<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

use DateTimeImmutable;
use Sfadless\YandexTracker\Task\Employee;

/**
 * CommentTrait
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
trait CommentTrait
{
    /**
     * @var string|null
     */
    protected ?string $selfUrl = null;

    /**
     * @var string|null
     */
    protected ?string $id = null;

    /**
     * @var string|null
     */
    protected ?string $longId = null;

    /**
     * @var string|null
     */
    protected ?string $text = null;

    /**
     * @var Employee|null
     */
    protected ?Employee $createdBy = null;

    /**
     * @var Employee|null
     */
    protected ?Employee $updatedBy = null;

    /**
     * @var DateTimeImmutable|null
     */
    protected ?DateTimeImmutable $createdAt = null;

    /**
     * @var DateTimeImmutable|null
     */
    protected ?DateTimeImmutable $updatedAt = null;

    /**
     * @var int
     */
    protected int $version = 1;

    /**
     * @var string
     */
    protected string $type = CommentTypes::STANDARD;

    /**
     * @var string
     */
    protected string $transport = CommentTransports::INTERNAL;

    /**
     * @return string|null
     */
    public function getSelfUrl(): ?string
    {
        return $this->selfUrl;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLongId(): ?string
    {
        return $this->longId;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return Employee|null
     */
    public function getCreatedBy(): ?Employee
    {
        return $this->createdBy;
    }

    /**
     * @return Employee|null
     */
    public function getUpdatedBy(): ?Employee
    {
        return $this->updatedBy;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTransport(): string
    {
        return $this->transport;
    }
}