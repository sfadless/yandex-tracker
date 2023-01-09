<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\File;

/**
 * Class FileResponse
 * @author Alexander Srokin <alexander.srokin@gmail.com>
 */
final class FileResponse
{
    private string $name;
    private string $contentType;
    private string $source;

    public function __construct(string $name, string $contentType, string $source)
    {
        $this->name = $name;
        $this->contentType = $contentType;
        $this->source = $source;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getSource(): string
    {
        return $this->source;
    }
}