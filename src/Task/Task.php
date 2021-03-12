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

    /**
     * @var string
     */
    private string $summary;

    /**
     * @var string
     */
    private ?string $description = null;

    /**
     * @var Employee
     */
    private Employee $createdBy;

    /**
     * @var Employee|null
     */
    private ?Employee $updatedBy;

    /**
     * @var Employee[]
     */
    private array $followers;

    /**
     * @var Employee|null
     */
    private ?Employee $assignee;

    /**
     * @var AssociatedReference
     */
    private AssociatedReference $queue;

    /**
     * @var AssociatedReference
     */
    private AssociatedReference $status;

    /**
     * @var AssociatedReference
     */
    private AssociatedReference $type;

    /**
     * @var AssociatedReference
     */
    private AssociatedReference $priority;

    /**
     * @var DateTime
     */
    private DateTime $createdAt;

    /**
     * @var DateTime
     */
    private DateTime $updatedAt;

    /**
     * Task constructor.
     * @param string $id
     * @param string $key
     * @param string $summary
     */
    public function __construct(string $id, string $key, string $summary)
    {
        parent::__construct($id, $key);

        $this->status = new KeyReference('open');
        $this->type = new KeyReference(TaskTypes::TASK);
        $this->priority = new KeyReference(TaskPriorities::NORMAL);
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     * @return Task
     */
    public function setSummary(string $summary): Task
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Task
     */
    public function setDescription(string $description): Task
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Employee
     */
    public function getCreatedBy(): Employee
    {
        return $this->createdBy;
    }

    /**
     * @param Employee $createdBy
     * @return Task
     */
    public function setCreatedBy(Employee $createdBy): Task
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * @return Employee|null
     */
    public function getUpdatedBy(): ?Employee
    {
        return $this->updatedBy;
    }

    /**
     * @param Employee|null $updatedBy
     * @return Task
     */
    public function setUpdatedBy(?Employee $updatedBy): Task
    {
        $this->updatedBy = $updatedBy;
        return $this;
    }

    /**
     * @return Employee[]
     */
    public function getFollowers(): array
    {
        return $this->followers;
    }

    /**
     * @param Employee[] $followers
     * @return Task
     */
    public function setFollowers(array $followers): Task
    {
        $this->followers = $followers;
        return $this;
    }

    /**
     * @return Employee|null
     */
    public function getAssignee(): ?Employee
    {
        return $this->assignee;
    }

    /**
     * @param Employee|null $assignee
     * @return Task
     */
    public function setAssignee(?Employee $assignee): Task
    {
        $this->assignee = $assignee;
        return $this;
    }

    /**
     * @return AssociatedReference
     */
    public function getStatus(): AssociatedReference
    {
        return $this->status;
    }

    /**
     * @param AssociatedReference $status
     * @return Task
     */
    public function setStatus(AssociatedReference $status): Task
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return AssociatedReference
     */
    public function getType(): AssociatedReference
    {
        return $this->type;
    }

    /**
     * @param AssociatedReference $type
     * @return Task
     */
    public function setType(AssociatedReference $type): Task
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return AssociatedReference
     */
    public function getQueue(): AssociatedReference
    {
        return $this->queue;
    }

    /**
     * @param AssociatedReference $queue
     * @return Task
     */
    public function setQueue(AssociatedReference $queue): Task
    {
        $this->queue = $queue;
        return $this;
    }

    /**
     * @return AssociatedReference
     */
    public function getPriority(): AssociatedReference
    {
        return $this->priority;
    }

    /**
     * @param AssociatedReference $priority
     * @return Task
     */
    public function setPriority(AssociatedReference $priority): Task
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     * @return Task
     */
    public function setCreatedAt(DateTime $createdAt): Task
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     * @return Task
     */
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