<?php

declare(strict_types=1);

namespace Sfadless\YandexTracker\Queue;

/**
 * QueueOptions
 *
 * Список опций, используемых в запросах/ответах при работе с очередями
 *
 * @author Pavel Golikov <pgolikov327@gmail.com>
 */
final class QueueOptions
{
    /**
     * Идентификатор очереди.
     */
    public const ID = 'id';

    /**
     * Ссылка на очередь.
     */
    public const SELF_URL = 'self';

    /**
     * Версия очереди. Каждое изменение очереди увеличивает номер версии.
     */
    public const VERSION = 'version';

    /**
     * Массив с информацией о версиях очереди
     */
    public const VERSIONS = 'versions';

    /**
     * Текстовое описание очереди.
     */
    public const DESCRIPTION = 'description';

    /**
     * Автоматически назначить исполнителя для новых задач очереди
     */
    public const ASSIGN_AUTO = 'assignAuto';

    /**
     * Ключ очереди.
     */
    public const KEY = 'key';

    /**
     * Название очереди.
     */
    public const NAME = 'name';

    /**
     * Логин или идентификатор владельца очереди
     */
    public const LEAD = 'lead';

    /**
     * Идентификатор или ключ типа задач по умолчанию.
     */
    public const DEFAULT_TYPE = 'defaultType';

    /**
     * Идентификатор или ключ приоритета задач по умолчанию.
     */
    public const DEFAULT_PRIORITY = 'defaultPriority';

    /**
     * Массив с настройками типов задач очереди.
     */
    public const ISSUE_TYPES_CONFIG = 'issueTypesConfig';

    /**
     * Массив с информацией о типах задач очереди.
     */
    public const ISSUE_TYPES = 'issueTypes';

    /**
     * Признак возможности голосования за задачи.
     */
    public const DENY_VOTING = 'denyVoting';

    /**
     * Список жизненных циклов очереди и их типов задач.
     */
    public const WORKFLOWS = 'workflows';

    /**
     * Массив с информацией об участниках команды очереди
     */
    public const TEAM_USERS = 'teamUsers';

    /**
     * TODO Добавить описание
     */
    public const USE_LATEST_SIGNATURE = 'useLastSignature';

    /**
     * TODO Добавить описание
     */
    public const USE_COMPONENT_PERMISSIONS_INTERSECTION = 'useComponentPermissionsIntersection';

    /**
     * TODO Добавить описание
     */
    public const DENY_TRACKER_AUTOLINK = 'denyTrackerAutolink';

    /**
     * TODO Добавить описание
     */
    public const DENY_CONDUCTOR_AUTOLINK = 'denyConductorAutolink';

    /**
     * TODO Добавить описание
     */
    public const ALLOW_EXTRA_MAILING = 'allowExternalMailing';

    /**
     * TODO Добавить описание
     */
    public const ADD_ISSUE_KEY_IN_EMAIL = 'addIssueKeyInEmail';

    /**
     * TODO Добавить описание
     */
    public const WORK_FLOW_ACTIONS_STYLE = 'workflowActionsStyle';
}