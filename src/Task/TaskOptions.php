<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Task;

/**
 * TaskOptions
 *
 * Набор ключей, используемых в запросах/ответах в задачах
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class TaskOptions
{
    /**
     * Название задачи
     */
    public const SUMMARY = 'summary';

    /**
     * Очередь, в которой нужно создать задачу.
     */
    public const QUEUE = 'queue';

    /**
     * Описание задачи.
     */
    public const DESCRIPTION = 'description';

    /**
     * Тип задачи.
     */
    public const TYPE = 'type';

    /**
     * Теги задачи
     */
    public const TAGS = 'tags';

    /**
     * Приоритет задачи.
     */
    public const PRIORITY = 'priority';

    /**
     * Наблюдатели задачи.
     */
    public const FOLLOWERS = 'followers';

    /**
     * Поле с уникальным значением, позволяющее предотвратить создание дубликатов задач. При повторной попытке создать
     * задачу с тем же значением данного параметра дубликат создан не будет, а ответ будет содержать ошибку с кодом 409.
     */
    public const UNIQUE = 'unique';

    /**
     * Блок с информацией о спринтах.
     */
    public const SPRINT = 'sprint';

    /**
     * Блок с информацией о досках.
     */
    public const BOARDS = 'boards';

    /**
     * Родительская задача.
     */
    public const PARENT = 'parent';

    /**
     * Дополнительные поля, которые будут включены в ответ
     */
    public const EXPAND = 'expand';

    /**
     * Идентификатор задачи
     */
    public const ID = 'id';

    /**
     * Ключ задачи
     */
    public const KEY = 'key';

    public const KEYS = 'keys';

    /**
     * Версия задачи. Каждое изменение параметров задачи увеличивает номер версии.
     */
    public const VERSION = 'version';

    public const SELF_URL = 'self';

    public const STATUS_START_TIME = 'statusStartTime';

    public const UPDATED_BY = 'updatedBy';

    public const SLA = 'sla';

    public const CREATED_AT = 'createdAt';

    public const CREATED_BY = 'createdBy';

    /**
     * Исполнитель
     */
    public const ASSIGNEE = 'assignee';

    public const PREVIOUS_STATUS_LAST_ASSIGNEE = 'previousStatusLastAssignee';

    public const COMMENT_WITHOUT_EXTERNAL_MESSAGE_COUNT= 'commentWithoutExternalMessageCount';

    public const COMMENT_WITH_EXTERNAL_MESSAGE_COUNT= 'commentWithExternalMessageCount';

    public const LAST_COMMENT_UPDATED_AT= 'lastCommentUpdatedAt';

    public const VOTES = 'votes';

    public const UPDATED_AT = 'updatedAt';

    /**
     * Дата закрытия
     */
    public const RESOLVED_AT = 'resolvedAt';

    /**
     * Закрывший сотрудник
     */
    public const RESOLVED_BY = 'resolvedBy';

    public const FAVORITE = 'favorite';

    public const STATUS = 'status';

    public const PREVIOUS_STATUS = 'previousStatus';

    public const RESOLUTION = 'resolution';

    public const CHECK_LIST_DONE = 'checklistDone';

    public const CHECK_LIST_ITEMS = 'checklistItems';

    public const CHECK_LIST_TOTAL = 'checklistTotal';

    public const VOTED_BY = 'votedBy';

    public const EMAIL_FROM = 'emailFrom';

    public const EMAIL_TO = 'emailTo';

    /**
     * Копия (список email-ов)
     */
    public const EMAIL_CC = 'emailCc';
}