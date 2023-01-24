<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Action;

use JsonSerializable;
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Reference\Reference;
use Sfadless\YandexTracker\Task\TaskOptions;

/**
 * CreateTask
 *
 * Класс для создания новой задачи
 *
 * Поля взяты из https://yandex.ru/dev/connect/tracker/api/concepts/issues/create-issue.html
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CreateTask implements JsonSerializable
{
    private string $summary;
    private ?string $description;
    private KeyReference $queue;
    private ?Reference $type = null;
    private ?Reference $parent = null;
    private array $sprints = [];
    private ?Reference $priority = null;

    /**
     * @var Reference[]
     */
    private array $followers = [];

    private ?string $unique = null;

    private array $additionalOptions = [];

    public function __construct(
        string $summary,
        KeyReference $queue,
        ?string $description = null,
        ?Reference $sprint = null,
        array $additionalOptions = []
    ) {
        $this->summary = $summary;
        $this->queue = $queue;
        $this->additionalOptions = $additionalOptions;

        null === $sprint ?: $this->sprints[] = $sprint;
        $this->description = $description;
    }

    public function getSprints() : array
    {
        return $this->sprints;
    }

    public function addSprint(Reference $sprint): CreateTask
    {
        $this->sprints[] = $sprint;

        return $this;
    }

    public function getType(): Reference
    {
        return $this->type;
    }

    public function setType(Reference $type): CreateTask
    {
        $this->type = $type;
        return $this;
    }

    public function getParent(): Reference
    {
        return $this->parent;
    }

    public function setParent(Reference $parent): CreateTask
    {
        $this->parent = $parent;
        return $this;
    }

    public function getPriority(): Reference
    {
        return $this->priority;
    }

    public function addFollower(Reference $follower): CreateTask
    {
        $this->followers[] = $follower;

        return $this;
    }

    public function setPriority(Reference $priority): CreateTask
    {
        $this->priority = $priority;
        return $this;
    }

    public function getUnique(): ?string
    {
        return $this->unique;
    }

    public function setUnique(?string $unique): CreateTask
    {
        $this->unique = $unique;
        return $this;
    }

    public function jsonSerialize(): array
    {
        $data = [];
        foreach ($this->additionalOptions as $option => $value) {
            $data[$option] = $value;
        }

        $data[TaskOptions::SUMMARY] = $this->summary;
        $data[TaskOptions::QUEUE] = $this->queue;

        null === $this->description ?: $data[TaskOptions::DESCRIPTION] = $this->description;
        null === $this->parent ?: $data[TaskOptions::PARENT] = $this->parent;
        null === $this->unique ?: $data[TaskOptions::UNIQUE] = $this->unique;
        null === $this->priority ?: $data[TaskOptions::PRIORITY] = $this->priority;
        null === $this->type ?: $data[TaskOptions::TYPE] = $this->type;

        empty($this->sprints) ?: $data[TaskOptions::SPRINT] = $this->sprints;
        empty($this->followers) ?: $data[TaskOptions::FOLLOWERS] = $this->followers;

        return $data;
    }
}