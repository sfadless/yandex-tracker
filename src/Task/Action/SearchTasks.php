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
    private string $expand;

    /**
     * Список ключей задач. Данный параметр не используется вместе с параметрами filter или query.
     * При совместной передаче этих параметров, поиск будет производиться только по keys.
     *
     * @var string
     */
    private string $keys;

    /**
     *
     * Очередь. Данный параметр не используется вместе с параметрами filter или quiery. При совместной передаче этих
     * параметров, поиск будет производиться только по queue.
     *
     * @var StringReference
     */
    private StringReference $queue;

    /**
     * @return string
     */
    public function getExpand(): string
    {
        return $this->expand;
    }

    /**
     * @param string $expand
     * @return SearchTasks
     */
    public function setExpand(string $expand): SearchTasks
    {
        $this->expand = $expand;
        return $this;
    }

    /**
     * @return string
     */
    public function getKeys(): string
    {
        return $this->keys;
    }

    /**
     * @param string $keys
     * @return SearchTasks
     */
    public function setKeys(string $keys): SearchTasks
    {
        $this->keys = $keys;
        return $this;
    }

    /**
     * @return StringReference
     */
    public function getQueue(): StringReference
    {
        return $this->queue;
    }

    /**
     * @param StringReference $queue
     * @return SearchTasks
     */
    public function setQueue(StringReference $queue): SearchTasks
    {
        $this->queue = $queue;
        return $this;
    }

    public function jsonSerialize()
    {
        $data = parent::jsonSerialize();

        null === $this->queue ?: $data[TaskOptions::QUEUE] = $this->queue;
        null === $this->expand ?: $data[TaskOptions::EXPAND] = $this->expand;
        null === $this->keys ?: $data[TaskOptions::QUEUE] = $this->queue;

        return $data;
    }
}