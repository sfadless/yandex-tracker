<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

use Sfadless\YandexTracker\File\FileManagerInterface;
use Sfadless\YandexTracker\Reference\Id;
use Sfadless\YandexTracker\Task\Action\AddComment;
use Sfadless\YandexTracker\Task\Action\CreateTask;
use Sfadless\YandexTracker\Task\Action\EditTask;
use Sfadless\YandexTracker\Task\Action\SearchTasks;
use Sfadless\YandexTracker\Task\Comment\Comment;

/**
 * TaskManagerInterface
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
interface TaskManagerInterface
{
    /**
     * Создать задачу
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/create-issue.html
     */
    public function create(CreateTask $task) : Task;

    /**
     * Найти задачи
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/search-issues.html
     */
    public function search(SearchTasks $searchTasks) : array;

    /**
     * Получить комментарии к задаче
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-comments.html
     *
     * @return Comment[]
     */
    public function getComments(Id $task) : array;

    /**
     * Добавить комментарий
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/add-comment.html
     */
    public function addComment(Id $task, AddComment $comment) : Comment;

    /**
     * Редактировать задачу
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/patch-issue.html/
     */
    public function edit(EditTask $task) : Task;

    /**
     * Получить параметры задачи
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-issue.html/
     */
    public function getTask(Id $task) : Task;

    /**
     * Узнать количество задач
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/count-issues.html
     */
    public function getCount() : int;

    public function getFileManager() : FileManagerInterface;
}