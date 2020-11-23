<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

/**
 * TaskPriorities
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskPriorities
{
    public const PRIORITY_HIERARCHY = [
        1 => self::TRIVIAL,
        2 => self::MINOR,
        3 => self::NORMAL,
        4 => self::CRITICAL,
        5 => self::BLOCKER,
    ];

    /**
     * Незначительный
     */
    public const TRIVIAL = 'trivial';

    /**
     * Низкий
     */
    public const MINOR = 'minor';

    /**
     * Средний
     */
    public const NORMAL = 'normal';

    /**
     * Критичный
     */
    public const CRITICAL = 'critical';

    /**
     * Блокер
     */
    public const BLOCKER = 'blocker';
}