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
    /**
     * @var string
     */
    protected string $key;

    /**
     * KeyReference constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    public function jsonSerialize()
    {
        return [
            'key' => $this->key
        ];
    }
}