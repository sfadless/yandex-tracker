<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Reference\Traits;

/**
 * DisplayTrait
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
trait DisplayTrait
{
    /**
     * @var string|null
     */
    protected ?string $display;

    /**
     * @return string|null
     */
    public function getDisplay(): ?string
    {
        return $this->display;
    }

    /**
     * @param string|null $display
     * @return DisplayTrait
     */
    public function setDisplay(?string $display): self
    {
        $this->display = $display;
        return $this;
    }
}