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
    /**
     * @var string
     */
    private string $key;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Reference
     */
    private Reference $lead;

    /**
     * @var Reference
     */
    private Reference $defaultType;

    /**
     * @var Reference
     */
    private Reference $defaultPriority;

    /**
     * @var array
     */
    private array $issueTypesConfig;

    /**
     * CreateQueue constructor.
     * @param string $key
     * @param string $name
     * @param Reference $lead
     */
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