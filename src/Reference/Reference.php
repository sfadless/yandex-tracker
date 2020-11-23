<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

use JsonSerializable;

/**
 * Reference
 *
 * Интерфейс, необходимый для того, чтобы ссылаться в запросах на другие задачи/спринты/очереди и т.п.
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface Reference extends JsonSerializable
{
}