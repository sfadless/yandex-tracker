<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

/**
 * Id
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface Id extends AssociatedReference
{
    public function getId() : string;
}