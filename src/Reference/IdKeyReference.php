<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

/**
 * IdKeyReference
 *
 * Класс, для представления ссылки вида {"id" : "foo", "key" : "bar"}
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class IdKeyReference implements Key, Id
{
    /**
     * @var string
     */
    protected string $key;

    /**
     * @var string
     */
    protected string $id;

    /**
     * IdKeyReference constructor.
     * @param string $id
     * @param string $key
     */
    public function __construct(string $id, string $key)
    {
        $this->id = $id;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'key' => $this->key
        ];
    }
}