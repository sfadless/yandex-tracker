<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\File;

use Exception;
use Sfadless\YandexTracker\Exception\ForbiddenException;
use Sfadless\YandexTracker\Exception\UnauthorizedException;
use Sfadless\YandexTracker\Reference\Id;
use Sfadless\YandexTracker\Request\Paths;
use Sfadless\YandexTracker\Request\TrackerClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * FileManager
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class FileManager implements FileManagerInterface
{
    private TrackerClient $client;

    private FileFactory $fileFactory;

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function getFiles(Id $task): array
    {
        $url = Paths::TASK_PATH . $task->getId() . '/attachments';

        $data = $this->client->get($url);

        $files = [];

        foreach ($data as $item) {
            $files[] = $this->fileFactory->create($item);
        }

        return $files;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     * @throws Exception
     */
    public function getFileData(Id $task, Id $file): File
    {
        $url = Paths::TASK_PATH . $task->getId() . '/attachments/' . $file->getId();
        $data = $this->client->get($url);

        return  $this->fileFactory->create($data);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws ForbiddenException
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws UnauthorizedException
     */
    public function download(Id $task, Id $file): FileResponse
    {
        $fileData = $this->getFileData($task, $file);
        $url = Paths::TASK_PATH . $task->getId() . '/attachments/' . $file->getId() . '/' . $fileData->getName();
        $source = $this->client->get($url, [], false);

        return new FileResponse($fileData->getName(), $fileData->getMimetype(), $source);
    }

    /**
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function attach(Id $task, string $file, ?string $name = null) : File
    {
        $url = Paths::TASK_PATH . $task->getId() . '/attachments';

        $filepath = pathinfo($file);

        if (null !== $name) {
            $url .= '?filename=' . $name;
        }

        $eol = "\r\n";
        $boundary = md5((string) time());

        $body = '--'. $boundary . $eol
            . 'Content-Disposition: form-data; name="' . $filepath['filename'] . '"; filename=' . $filepath['basename'] . $eol
            . 'Content-Transfer-Encoding: base64' . $eol . $eol
            . file_get_contents($file) . $eol
            . '--' . $boundary .'--' . $eol. $eol
        ;

        $data = $this->client->post($url, [
            'headers' => [
                'Content-Type' => "multipart/form-data; boundary=" . $boundary
            ],
            'body' => $body,
        ]);

        return $this->fileFactory->create($data);
    }

    public function __construct(TrackerClient $client, FileFactory $fileFactory)
    {
        $this->client = $client;
        $this->fileFactory = $fileFactory;
    }
}