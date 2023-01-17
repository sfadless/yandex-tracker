<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker;

use Sfadless\YandexTracker\Board\BoardManagerInterface;
use Sfadless\YandexTracker\Queue\QueueManagerInterface;
use Sfadless\YandexTracker\Task\TaskManagerInterface;
use Sfadless\YandexTracker\User\UserManager;

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
    private UserManager $userManager;

    public function __construct(
        TaskManagerInterface $taskManager,
        QueueManagerInterface $queueManager,
        BoardManagerInterface $boardManager,
        UserManager $userManager
    ) {
        $this->taskManager = $taskManager;
        $this->queueManager = $queueManager;
        $this->boardManager = $boardManager;
        $this->userManager = $userManager;
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

    public function getUserManager(): UserManager
    {
        return $this->userManager;
    }
}