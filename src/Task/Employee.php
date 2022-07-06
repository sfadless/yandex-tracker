<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Reference\Traits\DisplayTrait;
use Sfadless\YandexTracker\Reference\Traits\SelfUrlTrait;

/**
 * Employee
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class Employee extends IdReference
{
    use SelfUrlTrait;
    use DisplayTrait;

    public function __construct(string $id, string $selfUrl, string $display)
    {
        parent::__construct($id);

        $this->selfUrl = $selfUrl;
        $this->display = $display;
    }

    public function jsonSerialize() : array
    {
        return [
            'self' => $this->selfUrl,
            'id' => $this->id,
            'display' => $this->display
        ];
    }
}