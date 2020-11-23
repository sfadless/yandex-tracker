<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Filter;

use JsonSerializable;

/**
 * Filter
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
abstract class Filter implements JsonSerializable
{
    /**
     * Параметры фильтрации задач. В параметре можно указать название любого поля и значение, по которому будет
     * производиться фильтрация.
     *
     * @var array
     */
    protected array $filter = [];

    /**
     * Фильтр на языке запросов https://yandex.ru/support/connect-tracker/user/query-filter.html
     *
     * @var string|null
     */
    protected ?string $query = null;

    /**
     * Filter constructor.
     * @param array $filter
     * @param string|null $query
     */
    public function __construct(array $filter = [], ?string $query = null)
    {
        $this->filter = $filter;
        $this->query = $query;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $data = [];

        empty($this->filter) ?: $data['filter'] = $this->filter;
        null === $this->query ?: $data['query'] = $this->query;

        return $data;
    }
}