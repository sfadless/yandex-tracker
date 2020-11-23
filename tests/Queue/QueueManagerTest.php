<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\Queue;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\Queue\QueueManager;
use Sfadless\YandexTracker\Queue\QueueManagerInterface;
use Sfadless\YandexTracker\Request\TrackerClient;
use Symfony\Component\HttpClient\HttpClient;

/**
 * QueueManagerTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class QueueManagerTest extends TestCase
{
    private QueueManagerInterface $queueManager;

    protected function setUp(): void
    {
        $token = getenv('API_TOKEN');
        $orgId = getenv('ORG_ID');

        $httpClient = HttpClient::create();

        $trackerClient = new TrackerClient($httpClient, $token, $orgId);

        $this->queueManager = new QueueManager($trackerClient);
    }

    public function testGetList()
    {
        $this->assertGreaterThan(0, count($this->queueManager->getList()));
    }
}