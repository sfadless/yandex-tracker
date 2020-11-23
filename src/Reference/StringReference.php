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
    /**
     * @var string
     */
    private string $name;

    /**
     * StringReference constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed|string
     */
    public function jsonSerialize()
    {
        return $this->name;
    }
}