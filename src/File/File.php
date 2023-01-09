<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\File;

use DateTimeImmutable;
use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Reference\Traits\SelfUrlTrait;
use Sfadless\YandexTracker\Task\Employee;

/**
 * File
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class File extends IdReference
{
    use SelfUrlTrait;

    private string $name;
    private ?string $thumbnail = null;
    private string $content;
    private string $mimetype;
    private int $size; // Размер файла в байтах.
    private ?DateTimeImmutable $createdAt;
    private ?Employee $createdBy;

    public function __construct(string $id, string $name, string $content)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->content = $content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedBy(): ?Employee
    {
        return $this->createdBy;
    }

    public function setCreatedBy(Employee $createdBy): File
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): File
    {
        $this->thumbnail = $thumbnail;
        return $this;
    }

    public function getMimetype(): string
    {
        return $this->mimetype;
    }

    public function setMimetype(string $mimetype): File
    {
        $this->mimetype = $mimetype;
        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(int $size): File
    {
        $this->size = $size;
        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeImmutable $createdAt): File
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}