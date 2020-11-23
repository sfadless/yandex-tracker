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
    /**
     * @var TaskManagerInterface
     */
    private TaskManagerInterface $taskManager;

    /**
     * @var QueueManagerInterface
     */
    private QueueManagerInterface $queueManager;

    /**
     * @var BoardManagerInterface
     */
    private BoardManagerInterface $boardManager;

    /**
     * Tracker constructor.
     *
     * @param TaskManagerInterface $taskManager
     * @param QueueManagerInterface $queueManager
     * @param BoardManagerInterface $boardManager
     */
    public function __construct(TaskManagerInterface $taskManager, QueueManagerInterface $queueManager, BoardManagerInterface $boardManager)
    {
        $this->taskManager = $taskManager;
        $this->queueManager = $queueManager;
        $this->boardManager = $boardManager;
    }

    /**
     * @return TaskManagerInterface
     */
    public function getTaskManager(): TaskManagerInterface
    {
        return $this->taskManager;
    }

    /**
     * @return QueueManagerInterface
     */
    public function getQueueManager(): QueueManagerInterface
    {
        return $this->queueManager;
    }

    /**
     * @return BoardManagerInterface
     */
    public function getBoardManager(): BoardManagerInterface
    {
        return $this->boardManager;
    }
}