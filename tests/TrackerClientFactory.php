<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test;

use Sfadless\YandexTracker\Request\TrackerClient;
use Symfony\Component\HttpClient\HttpClient;

/**
 * TrackerClientFactory
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TrackerClientFactory
{
    public static function create() : TrackerClient
    {
        $client = HttpClient::create();

        $token = getenv('API_TOKEN');
        $orgId = getenv('ORG_ID');

        return new TrackerClient($client, $token, $orgId);
    }
}