<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\User;

use Exception;
use Sfadless\YandexTracker\Reference\Id;
use Sfadless\YandexTracker\Request\Client;
use Sfadless\YandexTracker\Request\Paths;

/**
 * Class UserManager
 * @author Alexander Srokin <alexander.srokin@gmail.com>
 */
final class UserManager implements UserManagerInterface
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getCurrent(): User
    {
        $data = $this->client->get('/v2/myself');

        return new User($data);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getUser(Id $user): User
    {
        $data = $this->client->get(Paths::USERS_PATH . $user->getId());

        return new User($data);
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getUsersList(): array
    {
        $data = $this->client->get(Paths::USERS_PATH);

        $users = [];
        foreach ($data as $user) {
            $users[] = new User($user);
        }

        return $users;
    }
}