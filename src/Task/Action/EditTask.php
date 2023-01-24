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
    private string $id;
    private ?string $summary;
    private ?string $description;
    private array $additionalOptions;
    private ?AssociatedReference $type;
    private ?AssociatedReference $priority;

    public function __construct(
        string $id,
        ?string $summary = null,
        ?string $description = null,
        ?AssociatedReference $type = null,
        ?AssociatedReference $priority = null,
        array $additionalOptions = []
    ) {
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
        $this->additionalOptions = $additionalOptions;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getType(): ?AssociatedReference
    {
        return $this->type;
    }

    public function getPriority(): ?AssociatedReference
    {
        return $this->priority;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        $data = [];
        foreach ($this->additionalOptions as $option => $value) {
            $data[$option] = $value;
        }

        null === $this->description ?: $data[TaskOptions::DESCRIPTION] = $this->description;
        null === $this->summary ?: $data[TaskOptions::SUMMARY] = $this->summary;
        null === $this->type ?: $data[TaskOptions::TYPE] = $this->type;
        null === $this->priority ?: $data[TaskOptions::PRIORITY] = $this->priority;

        return $data;
    }
}