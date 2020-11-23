<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Action;

use JsonSerializable;
use RuntimeException;
use Sfadless\YandexTracker\Reference\AssociatedReference;
use Sfadless\YandexTracker\Reference\Id;
use Sfadless\YandexTracker\Task\TaskOptions;

/**
 * EditTask
 *
 * Объект для редактирования задачи
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class EditTask implements JsonSerializable, Id
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string|null
     */
    private ?string $summary;

    /**
     * @var string|null
     */
    private ?string $description;

    /**
     * @var AssociatedReference|null
     */
    private ?AssociatedReference $type;

    /**
     * @var AssociatedReference|null
     */
    private ?AssociatedReference $priority;

    /**
     * EditTask constructor.
     * @param string $id
     * @param string|null $summary
     * @param string|null $description
     * @param AssociatedReference|null $type
     * @param AssociatedReference|null $priority
     */
    public function __construct(string $id, ?string $summary = null, ?string $description = null, ?AssociatedReference $type = null, ?AssociatedReference $priority = null)
    {
        if (
            null === $summary
            && null === $description
            && null === $priority
            && null === $type
        ) {
            throw new RuntimeException("Не указано ни одного поля для изменения");
        }

        $this->summary = $summary;
        $this->description = $description;
        $this->type = $type;
        $this->priority = $priority;
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return AssociatedReference|null
     */
    public function getType(): ?AssociatedReference
    {
        return $this->type;
    }

    /**
     * @return AssociatedReference|null
     */
    public function getPriority(): ?AssociatedReference
    {
        return $this->priority;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = [];

        null === $this->description ?: $data[TaskOptions::DESCRIPTION] = $this->description;
        null === $this->summary ?: $data[TaskOptions::SUMMARY] = $this->summary;
        null === $this->type ?: $data[TaskOptions::TYPE] = $this->type;
        null === $this->priority ?: $data[TaskOptions::PRIORITY] = $this->priority;

        return $data;
    }
}