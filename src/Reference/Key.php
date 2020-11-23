<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

/**
 * Key
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface Key extends AssociatedReference
{
    public function getKey() : string;
}