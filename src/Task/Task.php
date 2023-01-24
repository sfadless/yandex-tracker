<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

use DateTime;
use Sfadless\YandexTracker\Reference\AssociatedReference;
use Sfadless\YandexTracker\Reference\IdKeyReference;
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Reference\Traits\SelfUrlTrait;
use Sfadless\YandexTracker\Reference\Traits\VersionTrait;

/**
 * Task
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class Task extends IdKeyReference
{
    use VersionTrait;
    use SelfUrlTrait;

    private string $summary;
    private ?string $description = null;
    private Employee $createdBy;
    private ?Employee $updatedBy;
    private array $followers;
    private array $tags = [];
    private ?Employee $assignee;

    private AssociatedReference $queue;
    private AssociatedReference $status;
    private ?AssociatedReference $resolution = null;
    private AssociatedReference $type;
    private AssociatedReference $priority;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(string $id, string $key, string $summary)
    {
        parent::__construct($id, $key);

        $this->status = new KeyReference('open');
        $this->type = new KeyReference(TaskTypes::TASK);
        $this->priority = new KeyReference(TaskPriorities::NORMAL);
        $this->summary = $summary;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): Task
    {
        $this->summary = $summary;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Task
    {
        $this->description = $description;
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): Task
    {
        $this->tags = $tags;
        return $this;
    }

    public function getCreatedBy(): Employee
    {
        return $this->createdBy;
    }

    public function setCreatedBy(Employee $createdBy): Task
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getUpdatedBy(): ?Employee
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?Employee $updatedBy): Task
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    public function getFollowers(): array
    {
        return $this->followers;
    }

    public function setFollowers(array $followers): Task
    {
        $this->followers = $followers;
        return $this;
    }

    public function getAssignee(): ?Employee
    {
        return $this->assignee;
    }

    public function setAssignee(?Employee $assignee): Task
    {
        $this->assignee = $assignee;
        return $this;
    }

    public function getStatus(): AssociatedReference
    {
        return $this->status;
    }

    public function setStatus(AssociatedReference $status): Task
    {
        $this->status = $status;
        return $this;
    }

    public function getResolution(): ?AssociatedReference
    {
        return $this->resolution;
    }

    public function setResolution(?AssociatedReference $resolution): Task
    {
        $this->resolution = $resolution;
        return $this;
    }

    public function getType(): AssociatedReference
    {
        return $this->type;
    }

    public function setType(AssociatedReference $type): Task
    {
        $this->type = $type;

        return $this;
    }

    public function getQueue(): AssociatedReference
    {
        return $this->queue;
    }

    public function setQueue(AssociatedReference $queue): Task
    {
        $this->queue = $queue;
        return $this;
    }

    public function getPriority(): AssociatedReference
    {
        return $this->priority;
    }

    public function setPriority(AssociatedReference $priority): Task
    {
        $this->priority = $priority;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): Task
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): Task
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            TaskOptions::TYPE => $this->type,
        ]);
    }
}