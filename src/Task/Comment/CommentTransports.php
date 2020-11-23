<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

/**
 * CommentTransports
 *
 * Способ добавления комментария
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CommentTransports
{
    /**
     * Через интерфейс Трекера
     */
    public const INTERNAL = 'internal';

    /**
     * Через письмо
     */
    public const EMAIL = 'email';
}