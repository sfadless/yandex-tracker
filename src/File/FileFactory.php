<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\File;

use DateTimeImmutable;
use Exception;
use Sfadless\YandexTracker\Task\Employee;

/**
 * FileFactory
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class FileFactory
{
    /**
     * @throws Exception
     */
    public function create(array $data) : File
    {
        $file = new File($data['id'], $data['name'], $data['content']);

        $file
            ->setSelfUrl($data['self'])
            ->setCreatedBy($this->getEmployee($data['createdBy']))
            ->setCreatedAt(new DateTimeImmutable($data['createdAt']))
            ->setSize($data['size'])
            ->setMimetype($data['mimetype'])
            ->setThumbnail($data['thumbnail'] ?? null)
        ;

        return $file;
    }

    private function getEmployee(array $data) : Employee
    {
        return new Employee($data['id'], $data['self'], $data['display']);
    }
}