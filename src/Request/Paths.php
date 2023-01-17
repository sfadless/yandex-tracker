<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Request;

/**
 * Paths
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class Paths
{
    public const BASE_PATH = 'https://api.tracker.yandex.net';

    public const QUEUE_PATH = '/v2/queues/';

    /**
     * Создать задачу
     */
    public const TASK_PATH = '/v2/issues/';

    public const USERS_PATH = '/v2/users/';
}