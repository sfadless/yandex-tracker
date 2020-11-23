<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue;

use Sfadless\YandexTracker\Queue\Action\CreateQueue;
use Sfadless\YandexTracker\Reference\Reference;
use Sfadless\YandexTracker\Request\Client;
use Sfadless\YandexTracker\Request\Paths;

/**
 * QueueManager
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class QueueManager implements QueueManagerInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * QueueManager constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Создать очередь
     *
     * @param CreateQueue $createQueue
     * @return Queue
     */
    public function create(CreateQueue $createQueue) : Queue
    {
        $data = $this->client->post(Paths::QUEUE_PATH, [
            'json' => $createQueue
        ]);

        return QueueFactory::createFromArray($data);
    }

    /**
     * Получить параметры очереди
     *
     * @param Reference $reference
     * @return Queue
     */
    public function getParameters(Reference $reference) : Queue
    {
        $data = $this->client->get(Paths::QUEUE_PATH . $reference->getId(), []);

        return QueueFactory::createFromArray($data);
    }

    /**
     * Получить список очередей
     *
     * @return Queue[]
     */
    public function getList() : array
    {
        $data = $this->client->get(Paths::QUEUE_PATH);

        $queues = [];

        foreach ($data as $queueData) {
            $queues[] = QueueFactory::createFromArray($queueData);
        }

        return $queues;
    }

    /**
     * Получить версии очереди
     *
     * TODO
     */
    public function getVersions()
    {

    }

    /**
     * Получить обязательные поля очереди
     *
     * TODO
     */
    public function getRequiredFields()
    {

    }

    /**
     * Удалить очередь
     *
     * @param Reference $reference
     * @return bool
     */
    public function delete(Reference $reference) : bool
    {
        $this->client->delete(Paths::QUEUE_PATH . $reference->getId());

        return true;
    }

    /**
     * Восстановить очередь
     * @param Reference $reference
     * @return Queue
     */
    public function restore(Reference $reference) : Queue
    {
        $data = $this->client->post(Paths::QUEUE_PATH . $reference->getId() . '/_restore');

        return QueueFactory::createFromArray($data);
    }
}