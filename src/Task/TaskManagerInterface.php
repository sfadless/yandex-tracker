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
     *
     * @param CreateTask $task
     *
     * @return Task
     */
    public function create(CreateTask $task) : Task;

    /**
     * Найти задачи
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/search-issues.html
     *
     * @param SearchTasks $searchTasks
     *
     * @return array
     */
    public function search(SearchTasks $searchTasks) : array;

    /**
     * Получить комментарии к задаче
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-comments.html
     *
     * @param Id $task
     *
     * @return Comment[]
     */
    public function getComments(Id $task) : array;

    /**
     * Добавить комментарий
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/add-comment.html
     *
     * @param Id $task
     * @param AddComment $comment
     *
     * @return Comment
     */
    public function addComment(Id $task, AddComment $comment) : Comment;

    /**
     * Редактировать задачу
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/patch-issue.html/
     *
     * @param EditTask $task
     *
     * @return Task
     */
    public function edit(EditTask $task) : Task;

    /**
     * Получить параметры задачи
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/get-issue.html/
     *
     * @param Id $task
     *
     * @return Task
     */
    public function getTask(Id $task) : Task;

    /**
     * Узнать количество задач
     *
     * https://yandex.ru/dev/connect/tracker/api/concepts/issues/count-issues.html
     *
     * @return int
     */
    public function getCount() : int;

    /**
     * @return FileManagerInterface
     */
    public function getFileManager() : FileManagerInterface;
}