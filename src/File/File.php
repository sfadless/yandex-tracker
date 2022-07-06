<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\File;

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
    private string $content;
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
}