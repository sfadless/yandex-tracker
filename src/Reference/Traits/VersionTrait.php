<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference\Traits;

/**
 * VersionTrait
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
trait VersionTrait
{
    protected int $version = 1;

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return VersionTrait
     */
    public function setVersion(int $version): self
    {
        $this->version = $version;
        return $this;
    }
}