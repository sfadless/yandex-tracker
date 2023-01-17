<?php

namespace Sfadless\YandexTracker\User;

use Sfadless\YandexTracker\Reference\Id;

interface UserManagerInterface
{
    /**
     * Запрос позволяет получить информацию об учетной записи пользователя, от имени которого выполняется обращение к API.
     * https://cloud.yandex.ru/docs/tracker/get-user-info
     */
    public function getCurrent(): User;

    /**
     * Запрос позволяет получить информацию об учетной записи пользователя организации.
     * https://cloud.yandex.ru/docs/tracker/get-user
     */
    public function getUser(Id $user): User;

    /**
     * Возвращает список учетных записей пользователей, которые зарегистрированы в организации
     * https://cloud.yandex.ru/docs/tracker/get-users
     * @return User[]
     */
    public function getUsersList(): array;
}