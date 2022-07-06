<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

/**
 * StringReference
 *
 * Класс, для представления ссылки строкой
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class StringReference implements Reference
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function jsonSerialize() : array
    {
        return $this->name;
    }
}