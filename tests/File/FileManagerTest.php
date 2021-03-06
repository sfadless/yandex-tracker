<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Test\File;

use PHPUnit\Framework\TestCase;
use Sfadless\YandexTracker\File\FileFactory;
use Sfadless\YandexTracker\File\FileManager;
use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Test\TrackerClientFactory;

/**
 * FileManagerTest
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class FileManagerTest extends TestCase
{
    private FileManager $fileManager;

    protected function setUp(): void
    {
        $this->fileManager = new FileManager(TrackerClientFactory::create(), new FileFactory());
    }

    public function testAttach()
    {
        $fileName = '33.jpg';
        $file = __DIR__ . '/' . $fileName;

        $file = $this->fileManager->attach(new IdReference('TEST-59'), $file);

        dump($file);
        $this->assertEquals($file->getName(), $fileName);
    }
}