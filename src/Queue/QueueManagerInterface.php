<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue;

use Sfadless\YandexTracker\Queue\Action\CreateQueue;

/**
 * QueueManagerInterface
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface QueueManagerInterface
{
    /**
     * @param CreateQueue $createQueue
     *
     * @return Queue
     */
    public function create(CreateQueue $createQueue) : Queue;

    /**
     * @return Queue[]
     */
    public function getList() : array;
}