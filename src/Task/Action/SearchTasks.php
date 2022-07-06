<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Action;

use Sfadless\YandexTracker\Filter\Filter;
use Sfadless\YandexTracker\Reference\StringReference;
use Sfadless\YandexTracker\Task\TaskOptions;

/**
 * SearchTasks
 *
 * Класс для представления фильтра при поиске задач
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class SearchTasks extends Filter
{
    /**
     * Дополнительные поля, которые будут включены в ответ:
     *
     * - transitions — переходы по жизненному циклу;
     * - attachments — вложения.
     *
     * @var string
     */
    private ?string $expand = null;

    /**
     * Список ключей задач. Данный параметр не используется вместе с параметрами filter или query.
     * При совместной передаче этих параметров, поиск будет производиться только по keys.
     *
     * @var array
     */
    private array $keys = [];

    /**
     *
     * Очередь. Данный параметр не используется вместе с параметрами filter или query. При совместной передаче этих
     * параметров, поиск будет производиться только по queue.
     *
     * @var StringReference
     */
    private ?StringReference $queue = null;

    /**
     * Filter constructor.
     * @param array $filter
     * @param string|null $query
     * @param array $keys
     */
    public function __construct(array $filter = [], ?string $query = null, array $keys = [])
    {
        parent::__construct($filter, $query);

        $this->keys = $keys;
    }

    /**
     * @return string
     */
    public function getExpand(): ?string
    {
        return $this->expand;
    }

    public function setExpand(string $expand): SearchTasks
    {
        $this->expand = $expand;
        return $this;
    }

    public function getKeys(): array
    {
        return $this->keys;
    }

    public function getQueue(): ?StringReference
    {
        return $this->queue;
    }

    public function setQueue(StringReference $queue): SearchTasks
    {
        $this->queue = $queue;
        return $this;
    }

    public function jsonSerialize() : array
    {
        $data = parent::jsonSerialize();

        null === $this->queue ?: $data[TaskOptions::QUEUE] = $this->queue;
        null === $this->expand ?: $data[TaskOptions::EXPAND] = $this->expand;
        empty($this->keys) ?: $data[TaskOptions::KEYS] = $this->keys;

        return $data;
    }
}