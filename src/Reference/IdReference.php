<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

/**
 * IdReference
 *
 * Класс, для представления ссылки вида {"id" : "foo"}
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class IdReference implements Id
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return ['id' => $this->id];
    }
}