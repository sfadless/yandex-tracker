<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\File;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\File\FileFactory;

/**
 * FileFactoryTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class FileFactoryTest extends TestCase
{
    private FileFactory $fileFactory;

    public function setUp(): void
    {
        $this->fileFactory = new FileFactory();
    }

    public function testCreate()
    {
        $file = $this->fileFactory->create($this->getFileData());

        $this->assertEquals($file->getCreatedBy()->getDisplay(), 'creator_name');
        $this->assertEquals($file->getName(), 'file.txt');
        $this->assertEquals($file->getContent(), '<адрес для скачивания файла>');
    }
    
    private function getFileData()
    {
        return [
            "self" => "123qweasd",
            "id" => "<идентификатор файла>",
            "name" => "file.txt",
            "content" => "<адрес для скачивания файла>",
            "thumbnail" => "<адрес для скачивания превью>",
            "createdBy" => [
                "self" => "http://creator.url",
                "id" => "creator_id",
                "display" => "creator_name"
            ],
            "createdAt" => "<дата и время добавления файла>",
            "mimetype" => "<тип данных файла>",
            "size" => 2556,
            "metadata" => [
                "size" => "<геометрический размер (для изображений)>"
            ]
        ];
    }
}