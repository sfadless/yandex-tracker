<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Task;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\Reference\AssociatedReference;
use Sfadless\YandexTracker\Reference\FullReference;
use Sfadless\YandexTracker\Task\Employee;
use Sfadless\YandexTracker\Task\TaskFactory;

/**
 * TaskFactoryTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class TaskFactoryTest extends TestCase
{
    private TaskFactory $taskFactory;

    protected function setUp(): void
    {
        $this->taskFactory = new TaskFactory();
    }

    public function testCreate()
    {
        $taskData = $this->getTaskData();
        $task = $this->taskFactory->create($taskData);

        $this->assertEquals($task->getSummary(), $taskData["summary"]);
        $this->assertEquals($task->getDescription(), $taskData["description"]);
        $this->assertInstanceOf(Employee::class, $task->getCreatedBy());
        $this->assertEquals($task->getCreatedBy()->jsonSerialize(), $taskData["createdBy"]);
        $this->assertInstanceOf(Employee::class, $task->getUpdatedBy());
        $this->assertEquals($task->getUpdatedBy()->jsonSerialize(), $taskData["updatedBy"]);
        $this->assertInstanceOf(AssociatedReference::class, $task->getQueue());
        $this->assertEquals($task->getQueue()->jsonSerialize(), $taskData["queue"]);
        $this->assertInstanceOf(AssociatedReference::class, $task->getStatus());
        $this->assertEquals($task->getStatus()->jsonSerialize(), $taskData["status"]);
        $this->assertInstanceOf(AssociatedReference::class, $task->getType());
        $this->assertEquals($task->getType()->jsonSerialize(), $taskData["type"]);
        $this->assertInstanceOf(AssociatedReference::class, $task->getPriority());
        $this->assertEquals($task->getPriority()->jsonSerialize(), $taskData["priority"]);
        $this->assertEquals($task->getCreatedAt()->format("d.m.Y"), "16.11.2020");
        $this->assertEquals($task->getUpdatedAt()->format("d.m.Y"), "16.11.2020");
        $this->assertEquals($task->getKey(), $taskData["key"]);
        $this->assertEquals($task->getId(), $taskData["id"]);
        $this->assertEquals($task->getVersion(), $taskData["version"]);
        $this->assertEquals($task->getSelfUrl(), $taskData["self"]);
        $this->assertEquals($task->getFollowers(), []);
        $this->assertEquals($task->getAssignee(), null);
    }

    public function testCreateExtended()
    {
        $taskData = $this->getTaskDataExtended();
        $task = $this->taskFactory->create($taskData);

        $this->assertInstanceOf(Employee::class, $task->getAssignee());
        $this->assertEquals($task->getAssignee()->jsonSerialize(), $taskData["assignee"]);

        $followers = $task->getFollowers();
        $this->assertCount(2, $followers);
        $this->assertInstanceOf(Employee::class, $followers[0]);
        $this->assertEquals($followers[0]->jsonSerialize(), $taskData["followers"][0]);
        $this->assertInstanceOf(Employee::class, $followers[1]);
        $this->assertEquals($followers[1]->jsonSerialize(), $taskData["followers"][1]);
    }

    private function getTaskData(): array
    {
        return [
            "self" => "https://api.tracker.yandex.net/v2/issues/FOO_BAR",
            "id" => "5fb2c08c3f21ab52fec3d93c",
            "key" => "FOO_BAR",
            "version" => 1,
            "summary" => "Тестовая задача",
            "statusStartTime" => "2020-11-16T18:10:20.338+0000",
            "updatedBy" => [
                "self" => "https://api.tracker.yandex.net/v2/users/1130000041581601",
                "id" => "1130000041581601",
                "display" => "Павел Голиков"
            ],
            "sla" => [
                [
                    "id" => "5fb2c08c3f21ab52fec3d93b",
                    "settingsId" => 3,
                    "clockStatus" => "STARTED",
                    "violationStatus" => "NOT_VIOLATED",
                    "warnThreshold" => 21600000,
                    "failedThreshold" => 32400000,
                    "warnAt" => "2020-11-17T11:00:00.000+0000",
                    "failAt" => "2020-11-17T14:00:00.000+0000",
                    "startedAt" => "2020-11-16T18:10:20.291+0000",
                    "pausedAt" => null,
                    "stoppedAt" => null,
                    "pausedDuration" => 0,
                    "toFailTimeWorkDuration" => null,
                    "spent" => null,
                    "previousSLAs" => [],
                    "startShiftedByPause" => "2020-11-16T13:59:59.999+0000"
                ]
            ],
            "description" => "Тестовая задача, созданая через api",
            "type" => [
                "self" => "https://api.tracker.yandex.net/v2/issuetypes/2",
                "id" => "2",
                "key" => "task",
                "display" => "Задача"
            ],
            "priority" => ["self" => "https://api.tracker.yandex.net/v2/priorities/3", "id" => "3", "key" => "normal", "display" => "Средний"],
            "createdAt" => "2020-11-16T18:10:20.291+0000",
            "createdBy" => ["self" => "https://api.tracker.yandex.net/v2/users/1130000041581601", "id" => "1130000041581601", "display" => "Павел Голиков"],
            "commentWithoutExternalMessageCount" => 0,
            "votes" => 0,
            "commentWithExternalMessageCount" => 0,
            "queue" => ["self" => "https://api.tracker.yandex.net/v2/queues/FOOFF", "id" => "10", "key" => "FOOFF", "display" => "Предпроверка"],
            "updatedAt" => "2020-11-16T18:10:20.291+0000",
            "status" => ["self" => "https://api.tracker.yandex.net/v2/statuses/1", "id" => "1", "key" => "open", "display" => "Открыт"],
            "favorite" => false
        ];
    }

    private function getTaskDataExtended(): array
    {
        return [
            "self" => "https://api.tracker.yandex.net/v2/issues/FOO_BAR",
            "id" => "5fb2c08c3f21ab52fec3d93c",
            "key" => "FOO_BAR",
            "version" => 1,
            "summary" => "Тестовая задача",
            "statusStartTime" => "2020-11-16T18:10:20.338+0000",
            "updatedBy" => [
                "self" => "https://api.tracker.yandex.net/v2/users/1130000041581601",
                "id" => "1130000041581601",
                "display" => "Павел Голиков"
            ],
            "sla" => [
                [
                    "id" => "5fb2c08c3f21ab52fec3d93b",
                    "settingsId" => 3,
                    "clockStatus" => "STARTED",
                    "violationStatus" => "NOT_VIOLATED",
                    "warnThreshold" => 21600000,
                    "failedThreshold" => 32400000,
                    "warnAt" => "2020-11-17T11:00:00.000+0000",
                    "failAt" => "2020-11-17T14:00:00.000+0000",
                    "startedAt" => "2020-11-16T18:10:20.291+0000",
                    "pausedAt" => null,
                    "stoppedAt" => null,
                    "pausedDuration" => 0,
                    "toFailTimeWorkDuration" => null,
                    "spent" => null,
                    "previousSLAs" => [],
                    "startShiftedByPause" => "2020-11-16T13:59:59.999+0000"
                ]
            ],
            "description" => "Тестовая задача, созданая через api",
            "type" => [
                "self" => "https://api.tracker.yandex.net/v2/issuetypes/2",
                "id" => "2",
                "key" => "task",
                "display" => "Задача"
            ],
            "priority" => ["self" => "https://api.tracker.yandex.net/v2/priorities/3", "id" => "3", "key" => "normal", "display" => "Средний"],
            "createdAt" => "2020-11-16T18:10:20.291+0000",
            "createdBy" => ["self" => "https://api.tracker.yandex.net/v2/users/1130000041581601", "id" => "1130000041581601", "display" => "Павел Голиков"],
            "commentWithoutExternalMessageCount" => 0,
            "votes" => 0,
            "commentWithExternalMessageCount" => 0,
            "queue" => ["self" => "https://api.tracker.yandex.net/v2/queues/FOOFF", "id" => "10", "key" => "FOOFF", "display" => "Предпроверка"],
            "updatedAt" => "2020-11-16T18:10:20.291+0000",
            "status" => ["self" => "https://api.tracker.yandex.net/v2/statuses/1", "id" => "1", "key" => "open", "display" => "Открыт"],
            "favorite" => false,
            "assignee" => ["self" => "https://api.tracker.yandex.net/v2/users/1130000041581601", "id" => "1130000041581601", "display" => "Павел Голиков"],
            "followers" => [
                ["self" => "https://api.tracker.yandex.net/v2/users/1130000041581601", "id" => "1130000041581601", "display" => "Павел Голиков"],
                ["self" => "https://api.tracker.yandex.net/v2/users/1130000041581642", "id" => "1130000041581642", "display" => "Александр Срокин"],
            ],
        ];
    }
}