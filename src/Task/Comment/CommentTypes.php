<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Comment;

/**
 * CommentTypes
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CommentTypes
{
    /**
     * Отправлен через интерфейс Трекера
     */
    public const STANDARD = 'standard';

    /**
     * Ооздан из входящего письма
     */
    public const INCOMING = 'incoming';

    /**
     * Создан из исходящего письма
     */
    public const UOTCOMING = 'outcoming';
}