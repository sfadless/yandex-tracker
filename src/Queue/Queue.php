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

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $description;

    /**
     * Queue constructor.
     * @param string $id
     * @param string $key
     * @param string $name
     * @param string $description
     */
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param int $version
     * @return Queue
     */
    public function setVersion(int $version): Queue
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @param string $name
     * @return Queue
     */
    public function setName(string $name): Queue
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $description
     * @return Queue
     */
    public function setDescription(string $description): Queue
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
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