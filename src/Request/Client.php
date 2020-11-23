<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Request;

/**
 * Client
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface Client
{
    public function get(string $url, array $parameters = []);

    public function post(string $url, array $parameters = []);

    public function delete(string $url, array $parameters = []);

    public function patch(string $url, array $parameters = []);
}