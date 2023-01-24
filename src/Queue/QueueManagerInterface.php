<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue;

use Sfadless\YandexTracker\Queue\Action\CreateQueue;
use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Reference\Reference;

/**
 * QueueManagerInterface
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface QueueManagerInterface
{
    /**
     * Создать очередь
     */
    public function create(CreateQueue $createQueue) : Queue;

    /**
     * Получить список очередей
     * @return Queue[]
     */
    public function getList() : array;

    /**
     * Получить параметры очереди
     */
    public function getParameters(Reference $reference) : Queue;

    /**
     * Получить список тегов очереди
     * @return string[]
     */
    public function getTags(IdReference $queue): array;
}