<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker;

use Sfadless\YandexTracker\Board\BoardManagerInterface;
use Sfadless\YandexTracker\Queue\QueueManagerInterface;
use Sfadless\YandexTracker\Task\TaskManagerInterface;

/**
 * Tracker
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class Tracker
{
    private TaskManagerInterface $taskManager;
    private QueueManagerInterface $queueManager;
    private BoardManagerInterface $boardManager;

    public function __construct(TaskManagerInterface $taskManager, QueueManagerInterface $queueManager, BoardManagerInterface $boardManager)
    {
        $this->taskManager = $taskManager;
        $this->queueManager = $queueManager;
        $this->boardManager = $boardManager;
    }

    public function getTaskManager(): TaskManagerInterface
    {
        return $this->taskManager;
    }

    public function getQueueManager(): QueueManagerInterface
    {
        return $this->queueManager;
    }

    public function getBoardManager(): BoardManagerInterface
    {
        return $this->boardManager;
    }
}