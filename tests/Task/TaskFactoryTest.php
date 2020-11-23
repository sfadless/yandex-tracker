<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Task;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\Reference\FullReference;
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
        $task = $this->taskFactory->create($this->getTaskData());

        $this->assertEquals($task->getSelfUrl(), 'https://api.tracker.yandex.net/v2/issues/FOO_BAR');
        $this->assertEquals($task->getId(), '5fb2c08c3f21ab52fec3d93c');
        $this->assertEquals($task->getKey(), 'FOO_BAR');
        $this->assertEquals($task->getVersion(), 1);
        $this->assertEquals($task->getSummary(), 'Тестовая задача');
        $this->assertEquals($task->getDescription(), 'Тестовая задача, созданая через api');
        $this->assertInstanceOf(FullReference::class, $task->getType());
    }
    
    private function getTaskData()
    {
        return [
            "self" => "https://api.tracker.yandex.net/v2/issues/FOO_BAR",
            "id" =>"5fb2c08c3f21ab52fec3d93c",
            "key" =>"FOO_BAR",
            "version" => 1,
            "summary" => "Тестовая задача",
            "statusStartTime" =>"2020-11-16T18:10:20.338+0000",
            "updatedBy" => [
                "self" => "https://api.tracker.yandex.net/v2/users/1130000041581601",
                "id" =>"1130000041581601",
                "display" =>"Павел Голиков"
            ],
            "sla" => [
                [
                    "id" =>"5fb2c08c3f21ab52fec3d93b",
                    "settingsId" => 3,
                    "clockStatus" =>"STARTED",
                    "violationStatus" =>"NOT_VIOLATED",
                    "warnThreshold" => 21600000,
                    "failedThreshold" => 32400000,
                    "warnAt" =>"2020-11-17T11:00:00.000+0000",
                    "failAt" =>"2020-11-17T14:00:00.000+0000",
                    "startedAt" =>"2020-11-16T18:10:20.291+0000",
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
                "self" =>"https://api.tracker.yandex.net/v2/issuetypes/2",
                "id" =>"2",
                "key" =>"task",
                "display" =>"Задача"
            ],
            "priority"=> ["self" =>"https://api.tracker.yandex.net/v2/priorities/3","id" =>"3","key" =>"normal","display" =>"Средний"],
            "createdAt" =>"2020-11-16T18:10:20.291+0000",
            "createdBy" => ["self" =>"https://api.tracker.yandex.net/v2/users/1130000041581601","id" =>"1130000041581601","display" =>"Павел Голиков"],
            "commentWithoutExternalMessageCount" => 0,
            "votes" => 0,
            "commentWithExternalMessageCount" => 0,
            "queue" => ["self" =>"https://api.tracker.yandex.net/v2/queues/FOOFF","id" =>"10","key" =>"FOOFF","display" =>"Предпроверка"],
            "updatedAt" =>"2020-11-16T18:10:20.291+0000",
            "status" => ["self" =>"https://api.tracker.yandex.net/v2/statuses/1","id" =>"1","key" =>"open","display" =>"Открыт"],
            "favorite" => false
        ];
    }
}