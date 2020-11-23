<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

/**
 * TaskTypes
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskTypes
{
    /**
     * Задача
     */
    public const TASK = 'task';

    /**
     * Ошибка
     */
    public const BUG = 'bug';

    /**
     * Epiq
     */
    public const EPIQ = 'epiq';

    /**
     * Story
     */
    public const STORY = 'story';
}