<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\File;

use Sfadless\YandexTracker\Reference\Id;

/**
 * FileManagerInterface
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface FileManagerInterface
{
    /**
     * Получить список прикрепленных файлов
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-attachments-list.html/
     *
     * @return File[]
     */
    public function getFiles(Id $task) : array;

    /**
     * Скачать файл
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-attachment.html
     *
     * @return mixed
     */
    public function download(Id $task, Id $file, string $filename);

    /**
     * Прикрепить файл
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/post-attachment.html/
     */
    public function attach(Id $task, string $file, ?string $name = null);
}