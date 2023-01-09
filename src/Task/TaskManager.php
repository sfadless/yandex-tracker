<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

use Sfadless\YandexTracker\Exception\ForbiddenException;
use Sfadless\YandexTracker\Exception\UnauthorizedException;
use Sfadless\YandexTracker\File\FileFactory;
use Sfadless\YandexTracker\File\FileManager;
use Sfadless\YandexTracker\File\FileManagerInterface;
use Sfadless\YandexTracker\Reference\Id;
use Sfadless\YandexTracker\Request\Paths;
use Sfadless\YandexTracker\Request\TrackerClient;
use Sfadless\YandexTracker\Task\Action\AddComment;
use Sfadless\YandexTracker\Task\Action\CreateTask;
use Sfadless\YandexTracker\Task\Action\EditTask;
use Sfadless\YandexTracker\Task\Action\SearchTasks;
use Sfadless\YandexTracker\Task\Comment\Comment;
use Sfadless\YandexTracker\Task\Comment\CommentFactory;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * TaskManager
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskManager implements TaskManagerInterface
{
    private FileManagerInterface $fileManager;

    /**
     * @param string $token
     * @param string $orgId
     * @return TaskManager
     */
    public static function createManager(string $token, string $orgId)
    {
        $httpClient = HttpClient::create();

        $trackerClient = new TrackerClient($httpClient, $token, $orgId);

        $commentFactory = new CommentFactory();
        $taskFactory = new TaskFactory();
        $fileManager = new FileManager($trackerClient, new FileFactory());

        return new self(
            $trackerClient,
            $commentFactory,
            $taskFactory,
            $fileManager
        );
    }

    /**
     * @var TrackerClient
     */
    private TrackerClient $client;

    /**
     * @var CommentFactory
     */
    private CommentFactory $commentFactory;

    /**
     * @var TaskFactory
     */
    private TaskFactory $taskFactory;

    /**
     * @param CreateTask $task
     * @return Task
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function create(CreateTask $task): Task
    {
        $data = $this->client->post(Paths::TASK_PATH, [
            'json' => $task
        ]);

        return $this->taskFactory->create($data);
    }

    /**
     * @param SearchTasks $searchTasks
     * @return array
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function search(SearchTasks $searchTasks): array
    {
        $data = $this->client->post(Paths::TASK_PATH . '_search', [
            'json' => $searchTasks
        ]);

        $tasks = [];

        foreach ($data as $item) {
            $tasks[] = $this->taskFactory->create($item);
        }

        return $tasks;
    }

    /**
     * @param Id $task
     * @return Comment[]
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function getComments(Id $task): array
    {
        $data = $this->client->get(Paths::TASK_PATH . $task->getId() . '/comments');

        $comments = [];

        foreach ($data as $item) {
            $comments[] = $this->commentFactory->create($item);
        }

        return $comments;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function edit(EditTask $task): Task
    {
        $data = $this->client->patch(Paths::TASK_PATH . $task->getId(), [
            'json' => $task
        ]);

        return $this->taskFactory->create($data);
    }

    public function getCount(): int
    {
        // TODO: Implement getCount() method.
    }

    public function addComment(Id $task, AddComment $comment): Comment
    {
        $url = Paths::TASK_PATH . $task->getId() . '/comments';
        $result = $this->client->post($url, ['json' => $comment]);

        return $this->commentFactory->create($result);
    }

    /**
     * @param Id $task
     * @return Task
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function getTask(Id $task): Task
    {
        $data = $this->client->get(Paths::TASK_PATH . $task->getId());

        return $this->taskFactory->create($data);
    }

    /**
     * @return FileManagerInterface
     */
    public function getFileManager(): FileManagerInterface
    {
        return $this->fileManager;
    }

    /**
     * TaskManager constructor.
     *
     * @param TrackerClient $client
     * @param CommentFactory $commentFactory
     * @param TaskFactory $taskFactory
     * @param FileManagerInterface $fileManager
     */
    public function __construct(
        TrackerClient $client,
        CommentFactory $commentFactory,
        TaskFactory $taskFactory,
        FileManagerInterface $fileManager
    ) {
        $this->client = $client;
        $this->commentFactory = $commentFactory;
        $this->taskFactory = $taskFactory;
        $this->fileManager = $fileManager;
    }
}