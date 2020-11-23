<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Task;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\Exception\ForbiddenException;
use Sfadless\YandexTracker\Exception\UnauthorizedException;
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Task\Action\CreateTask;
use Sfadless\YandexTracker\Task\Task;
use Sfadless\YandexTracker\Task\TaskManager;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * TaskTestCase
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
abstract class TaskTestCase extends TestCase
{
    protected TaskManager $taskManager;

    protected function setUp(): void
    {
        $token = getenv('API_TOKEN');
        $orgId = getenv('ORG_ID');

        $this->taskManager = TaskManager::createManager($token, $orgId);
    }

    /**
     * @param string $summary
     * @param string $description
     * @param string $queue
     * @return Task
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function createTask(string $summary, string $description, string $queue) : Task
    {
        $createTask = new CreateTask(
            $summary,
            new KeyReference($queue),
            $description
        );
        return $this->taskManager->create($createTask);
    }
}