<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference\Traits;

/**
 * SelfUrlTrait
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
trait SelfUrlTrait
{
    protected ?string $selfUrl = null;

    public function getSelfUrl(): ?string
    {
        return $this->selfUrl;
    }

    public function setSelfUrl(string $selfUrl): self
    {
        $this->selfUrl = $selfUrl;

        return $this;
    }
}