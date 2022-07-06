<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

/**
 * KeyReference
 *
 * Класс, для представления ссылки вида {"key" : "bar"}
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class KeyReference implements Key
{
    protected string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function jsonSerialize() : array
    {
        return [
            'key' => $this->key
        ];
    }
}