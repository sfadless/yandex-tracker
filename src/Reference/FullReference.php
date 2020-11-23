<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference;

use Sfadless\YandexTracker\Reference\Traits\DisplayTrait;
use Sfadless\YandexTracker\Reference\Traits\SelfUrlTrait;

/**
 * FullReference
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
class FullReference extends IdKeyReference
{
    use DisplayTrait;
    use SelfUrlTrait;

    public function __construct(string $id, string $key, string $display, string $selfUrl)
    {
        parent::__construct($id, $key);

        $this->display = $display;
        $this->selfUrl = $selfUrl;
    }

    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'self' => $this->selfUrl,
            'display' => $this->display
        ]);
    }
}