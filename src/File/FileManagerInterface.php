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
     * Получить информацию о прикрепленном файле
     */
    public function getFileData(Id $task, Id $file) : File;

    /**
     * Скачать файл
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-attachment.html
     */
    public function download(Id $task, Id $file): FileResponse;

    /**
     * Прикрепить файл
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/post-attachment.html/
     */
    public function attach(Id $task, string $file, ?string $name = null);

    /**
     * Удалить файл
     *
     * https://cloud.yandex.ru/docs/tracker/concepts/issues/delete-attachment
     */
    public function remove(Id $task, Id $file): bool;
}