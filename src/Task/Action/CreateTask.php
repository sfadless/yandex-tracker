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
    /**
     * @var string
     */
    private string $summary;

    /**
     * @var string
     */
    private ?string $description;

    /**
     * @var KeyReference
     */
    private KeyReference $queue;

    /**
     * @var Reference
     */
    private ?Reference $type = null;

    /**
     * @var Reference
     */
    private ?Reference $parent = null;

    /**
     * @var Reference[]
     */
    private array $sprints = [];

    /**
     * @var Reference
     */
    private ?Reference $priority = null;

    /**
     * @var Reference[]
     */
    private array $followers = [];

    /**
     * @var string|null
     */
    private ?string $unique = null;

    /**
     * CreateTask constructor.
     *
     * @param string $summary
     * @param KeyReference $queue
     * @param string $description
     * @param Reference $sprint
     */
    public function __construct(
        string $summary,
        KeyReference $queue,
        ?string $description = null,
        ?Reference $sprint = null
    ) {
        $this->summary = $summary;
        $this->queue = $queue;

        null === $sprint ?: $this->sprints[] = $sprint;
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getSprints() : array
    {
        return $this->sprints;
    }

    /**
     * @param Reference $sprint
     * @return CreateTask
     */
    public function addSprint(Reference $sprint)
    {
        $this->sprints[] = $sprint;

        return $this;
    }

    /**
     * @return Reference
     */
    public function getType(): Reference
    {
        return $this->type;
    }

    /**
     * @param Reference $type
     * @return CreateTask
     */
    public function setType(Reference $type): CreateTask
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Reference
     */
    public function getParent(): Reference
    {
        return $this->parent;
    }

    /**
     * @param Reference $parent
     * @return CreateTask
     */
    public function setParent(Reference $parent): CreateTask
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return Reference
     */
    public function getPriority(): Reference
    {
        return $this->priority;
    }

    /**
     * @param Reference $follower
     * @return $this
     */
    public function addFollower(Reference $follower)
    {
        $this->followers[] = $follower;

        return $this;
    }

    /**
     * @param Reference $priority
     * @return CreateTask
     */
    public function setPriority(Reference $priority): CreateTask
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnique(): ?string
    {
        return $this->unique;
    }

    /**
     * @param string|null $unique
     * @return CreateTask
     */
    public function setUnique(?string $unique): CreateTask
    {
        $this->unique = $unique;
        return $this;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        $data = [
            TaskOptions::SUMMARY => $this->summary,
            TaskOptions::QUEUE => $this->queue
        ];

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