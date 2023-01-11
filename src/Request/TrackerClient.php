<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Request;

use RuntimeException;
use Sfadless\YandexTracker\Exception\ForbiddenException;
use Sfadless\YandexTracker\Exception\UnauthorizedException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * TrackerClient
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TrackerClient implements Client
{
    private HttpClientInterface $client;
    private string $authToken;
    private string $organizationId;

    public function __construct(HttpClientInterface $client, string $authToken, string $organizationId)
    {
        $this->client = $client;
        $this->authToken = $authToken;
        $this->organizationId = $organizationId;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function request(string $method, string $path, array $parameters = [], bool $json = true)
    {
        $options = array_merge_recursive(
            [
                'headers' => [
                    Headers::AUTHORIZATION => 'OAuth ' . $this->authToken,
                    Headers::X_ORG_ID => $this->organizationId
                ]
            ],
            $parameters
        );

        $response = $this->client->request(
            $method,
            Paths::BASE_PATH . $path,
            $options
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode >= 200 && $statusCode < 300) {
            return $json ? json_decode($response->getContent(), true) : $response->getContent();
        }

        if (403 === $statusCode) {
            throw new ForbiddenException();
        }

        if (401 === $statusCode) {
            $content = json_decode($response->getContent(false), true);

            throw new UnauthorizedException($content['errorMessages'][0]);
        }

        throw new RuntimeException($response->getStatusCode() . ' ' . $response->getContent(false));
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function get(string $url, array $parameters = [], bool $json = true)
    {
        return $this->request('GET', $url, $parameters, $json);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function post(string $url, array $parameters = [])
    {
        return $this->request('POST', $url, $parameters);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function patch(string $url, array $parameters = [])
    {
        return $this->request('PATCH', $url, $parameters);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function delete(string $url, array $parameters = [])
    {
        return $this->request('DELETE', $url, $parameters);
    }
}