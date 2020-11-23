Действия с задачами
===============

### Конфигурация

Для работы с трекером необходит токен и id организации. Более подробно: https://yandex.ru/dev/connect/tracker/api/concepts/access.html

Работа с задачами реализована в классе Sfadless\YandexTracker\Task\TaskManager

```php
use Sfadless\YandexTracker\Task\TaskManager;

$token = "your_api_token_here";
$orgId = "your_org_id_here";

$taskManager = Sfadless\YandexTracker\Task\TaskManager::createManager($token, $orgId);
```

### Создание задачи

```php
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Task\Action\CreateTask;

$summary = "Название задачи";
$queueKey = "Ключ очереди";
$description = "Описание задачи (не обязятельно)";

$taskModel = new CreateTask($summary, new KeyReference($queueKey), $description);

// объект класса Sfadless\YandexTracker\Task\Task
$task = $taskManager->create($taskModel);
```

### Добавление комментария

```php
use Sfadless\YandexTracker\Reference\IdReference;
use Sfadless\YandexTracker\Task\Action\AddComment;

$task = new IdReference('Id_задачи');
$comment = new AddComment('Текст комментария');

$taskManager->addComment($task, $comment);
```

