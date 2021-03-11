<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Task;

use Sfadless\YandexTracker\Exception\ForbiddenException;
use Sfadless\YandexTracker\Exception\UnauthorizedException;
use Sfadless\YandexTracker\Reference\IdKeyReference;
use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Task\Action\AddComment;
use Sfadless\YandexTracker\Task\Action\CreateTask;
use Sfadless\YandexTracker\Task\TaskOptions;
use Sfadless\YandexTracker\Task\TaskPriorities;
use Sfadless\YandexTracker\Task\TaskTypes;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * TaskCreateTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskCreateTest extends TaskTestCase
{
    public function testCreateWithSummaryOnly()
    {
        $task = new CreateTask('Foo bar', new KeyReference('queueId'));

        $data = $task->jsonSerialize();

        $this->assertEquals(2, count($data));
        $this->assertArrayHasKey(TaskOptions::SUMMARY, $data);
        $this->assertArrayHasKey(TaskOptions::QUEUE, $data);
    }

    public function testCreateWithMultiSprints()
    {
        $task = new CreateTask('foo', new KeyReference('queueId'), null, new IdReference('sprintId'));

        $task->addSprint(new IdReference('88675'));

        $data = $task->jsonSerialize();

        $this->assertArrayHasKey(TaskOptions::SPRINT, $data);
        $this->assertEquals(2, count($data[TaskOptions::SPRINT]));
    }

    public function testCreateWithFullSetOfFields()
    {
        $task = new CreateTask(
            'foo',
            new KeyReference('sprint-id'),
            'foo description',
            new IdKeyReference('567', '567-BAR')
        );

        $task
            ->setParent(new IdKeyReference('123qweasd', 'FOO-244'))
            ->setPriority(new IdReference(TaskPriorities::CRITICAL))
            ->setType(new IdReference(TaskTypes::BUG))
            ->setUnique('fooBar');

        $task->addFollower(new IdReference('qweasd'));

        $data = $task->jsonSerialize();

        $this->assertEquals(9, count($data));

        $this->assertArrayHasKey(TaskOptions::SUMMARY, $data);
        $this->assertArrayHasKey(TaskOptions::DESCRIPTION, $data);
        $this->assertArrayHasKey(TaskOptions::SPRINT, $data);
        $this->assertArrayHasKey(TaskOptions::UNIQUE, $data);
        $this->assertArrayHasKey(TaskOptions::FOLLOWERS, $data);
        $this->assertArrayHasKey(TaskOptions::PRIORITY, $data);
        $this->assertArrayHasKey(TaskOptions::TYPE, $data);
        $this->assertArrayHasKey(TaskOptions::QUEUE, $data);
    }

    /**
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function testApiCreate()
    {
        $summary = 'Тестовая задача';
        $description = 'Тестовая задача, созданая через api';
        $queueKey = getenv('QUEUE_KEY');

        $task = $this->createTask($summary, $description, $queueKey);

        $this->assertEquals($task->getSummary(), $summary);
        $this->assertEquals($task->getDescription(), $description);
        $this->assertEquals($task->getQueue()->getKey(), $queueKey);
    }

    public function testAddComment()
    {
        $comment = new AddComment("Второй комментарий, созданный через Api");
        $result = $this->taskManager->addComment(new IdReference('TEST-59'), $comment);
        $this->assertEquals($result->getText(), $comment->getText());
    }
}