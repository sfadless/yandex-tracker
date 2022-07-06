<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue;

use Sfadless\YandexTracker\Reference\IdKeyReference;
use Sfadless\YandexTracker\Reference\Traits\SelfUrlTrait;
use Sfadless\YandexTracker\Reference\Traits\VersionTrait;

/**
 * Queue
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class Queue extends IdKeyReference
{
    use SelfUrlTrait;
    use VersionTrait;

    private string $name;
    private string $description;

    public function __construct(
        string $id,
        string $key,
        string $name,
        string $description
    ) {
        $this->name = $name;
        $this->description = $description;

        parent::__construct($id, $key);
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setVersion(int $version): Queue
    {
        $this->version = $version;
        return $this;
    }

    public function setName(string $name): Queue
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription(string $description): Queue
    {
        $this->description = $description;
        return $this;
    }

    public function jsonSerialize() : array
    {
        return [
            'self' => $this->selfUrl,
            'name' => $this->name,
            'description' => $this->description,
            'version' =>$this->version,
            'id' => $this->id
        ];
    }
}