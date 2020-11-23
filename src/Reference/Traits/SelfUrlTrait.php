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
    /**
     * @var string
     */
    protected ?string $selfUrl = null;

    /**
     * @return string
     */
    public function getSelfUrl(): ?string
    {
        return $this->selfUrl;
    }

    /**
     * @param string $selfUrl
     * @return SelfUrlTrait
     */
    public function setSelfUrl(string $selfUrl): self
    {
        $this->selfUrl = $selfUrl;

        return $this;
    }
}