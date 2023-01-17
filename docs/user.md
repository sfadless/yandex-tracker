Действия с задачами
===============

### Конфигурация

Для работы с трекером необходим токен и id организации. Более подробно: https://yandex.ru/dev/connect/tracker/api/concepts/access.html

Работа с задачами реализована в классе Sfadless\YandexTracker\User\UserManager

```php
use Sfadless\YandexTracker\User\UserManager;
use Sfadless\YandexTracker\Request\TrackerClient;

$token = "your_api_token_here";
$orgId = "your_org_id_here";

$client = new TrackerClient(HttpClient::create(), $token, $orgId);

$userManager = new UserManager($client);
```

### Получение текущего пользователя

```php
use Sfadless\YandexTracker\User\User;

/** @var $user User */
$user = $userManager->getCurrent();
```

### Получение списка пользователей организации

```php
use Sfadless\YandexTracker\User\User;

/** @var $user User */
$users = $userManager->getUsersList();
```

### Получение информации о пользователе в организации

```php
use Sfadless\YandexTracker\User\User;
use Sfadless\YandexTracker\Reference\IdReference;

$userId = "your_user_id_here"; 
$idRef = new IdReference($userId);

/** @var $user User */
$user = $userManager->getUser($idRef);
```