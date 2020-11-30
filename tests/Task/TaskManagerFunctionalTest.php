<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Task;

use Sfadless\YandexTracker\Exception\ForbiddenException;
use Sfadless\YandexTracker\Exception\UnauthorizedException;
use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Task\Action\AddComment;
use Sfadless\YandexTracker\Task\Action\EditTask;
use Sfadless\YandexTracker\Task\Action\SearchTasks;
use Sfadless\YandexTracker\Task\Comment\Comment;
use Sfadless\YandexTracker\Task\TaskPriorities;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * TaskManagerFunctionalTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskManagerFunctionalTest extends TaskTestCase
{
    /**
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testGetTask()
    {
        $summary = 'Еще одна тестовая задача';
        $description = 'Описание тестовой залачи';
        $task = $this->createTask(
            $summary,
            $description,
            getenv('QUEUE_KEY')
        );

        $taskId = $task->getId();

        $foundedTask = $this->taskManager->getTask(new IdReference($taskId));

        $this->assertEquals($foundedTask->getId(), $taskId);
        $this->assertEquals($foundedTask->getSummary(), $summary);
        $this->assertEquals($foundedTask->getQueue()->getKey(), getenv('QUEUE_KEY'));
    }

    /**
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testEdit()
    {
        $summary = 'Еще одна тестовая задача';
        $description = 'Описание тестовой залачи';

        $task = $this->createTask(
            $summary,
            $description,
            getenv('QUEUE_KEY')
        );

        $newSummary = 'Отредактированное название';
        $newDescription = 'Отредактированное описание';

        $editedTask = $this->taskManager->edit(new EditTask(
            $task->getId(),
            $newSummary,
            $newDescription
        ));

        $this->assertEquals($editedTask->getSummary(), $newSummary);
        $this->assertEquals($editedTask->getDescription(), $newDescription);
        $this->assertEquals($editedTask->getId(), $task->getId());
    }

    /**
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testAddComment()
    {
        $task = $this->createTask(
            'Название для задачи',
            'Тестовое описание',
            getenv('QUEUE_KEY')
        );

        $commentText = 'Комментарий к задаче';
        $this->taskManager->addComment($task, new AddComment($commentText));

        $comments = $this->taskManager->getComments($task);
        $this->assertEquals(count($comments), 1);

        $comment = $comments[0];
        $this->assertInstanceOf(Comment::class, $comment);
        $this->assertEquals($comment->getText(), $commentText);
    }

    /**
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testChangePriority()
    {
        $task = $this->createTask(
            'Название для задачи',
            'Тестовое описание',
            getenv('QUEUE_KEY')
        );

        $this->assertNotEquals($task->getPriority()->getKey(), TaskPriorities::CRITICAL);

        $editTask = new EditTask(
            $task->getId(),
            null,
            null,
            null,
            new KeyReference(TaskPriorities::CRITICAL)
        );

        $editedTask = $this->taskManager->edit($editTask);

        $this->assertEquals($editedTask->getPriority()->getKey(), TaskPriorities::CRITICAL);
    }

    public function testSearch()
    {
        $task = $this->createTask(
            'Название для задачи',
            'Тестовое описание',
            getenv('QUEUE_KEY')
        );

        $taskKey = $task->getKey();

        $search = new SearchTasks([], null, [$taskKey]);

        $tasks = $this->taskManager->search($search);

        $this->assertEquals(1, count($tasks));
        $this->assertEquals($tasks[0]->getKey(), $taskKey);

        $anotherTask = $this->createTask(
            'Название для задачи',
            'Тестовое описание',
            getenv('QUEUE_KEY')
        );

        $anotherTaskKey = $anotherTask->getKey();

        $anotherSearch = new SearchTasks([], null, [$taskKey, $anotherTaskKey]);
        $multiTasks = $this->taskManager->search($anotherSearch);

        $this->assertEquals(2, count($multiTasks));
    }
}