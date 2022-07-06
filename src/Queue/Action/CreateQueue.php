<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue\Action;

use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Reference\Reference;
use Sfadless\YandexTracker\Reference\StringReference;

/**
 * CreateQueue
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class CreateQueue implements \JsonSerializable
{
    private string $key;
    private string $name;
    private Reference $lead;
    private Reference $defaultType;
    private Reference $defaultPriority;
    private array $issueTypesConfig = [];

    public function __construct(string $key, string $name, Reference $lead)
    {
        $this->key = $key;
        $this->name = $name;
        $this->lead = $lead;

        $this->defaultType = new StringReference('task');
        $this->defaultPriority = new StringReference('normal');
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}