<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task\Action;

/**
 * AddComment
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class AddComment implements \JsonSerializable
{
    /**
     * @var string
     */
    private string $text;

    /**
     * AddComment constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    public function jsonSerialize()
    {
        return [
            'text' => $this->text
        ];
    }
}