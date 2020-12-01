Действия с задачами
===============

### Конфигурация

Для работы с трекером необходит токен и id организации. Более подробно: https://yandex.ru/dev/connect/tracker/api/concepts/access.html

Работа с задачами реализована в классе Sfadless\YandexTracker\Task\TaskManager

```php
use Sfadless\YandexTracker\Task\TaskManager;

$token = "your_api_token_here";
$orgId = "your_org_id_here";

$taskManager = TaskManager::createManager($token, $orgId);
```

### Создание задачи

```php
use Sfadless\YandexTracker\Reference\KeyReference;
use Sfadless\YandexTracker\Task\Action\CreateTask;

$summary = "Название задачи";
$queueKey = "Ключ очереди";
$description = "Описание задачи (не обязятельно)";

$taskModel = new CreateTask($summary, new KeyReference($queueKey), $description);

/** @var $task Sfadless\YandexTracker\Task\Task */
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

### Получение комментариев к задаче

```php
use Sfadless\YandexTracker\Reference\IdReference;

$task = new IdReference('Id_задачи');

$comments = $taskManager->getComments($task);
```

### Редактирование задачи

```php
use Sfadless\YandexTracker\Task\Action\EditTask;

$newSummary = 'Новое название';
$newDescription = 'Новое описание';
$taskId = 'id_задачи';

$editTask = new EditTask($taskId, $newSummary, $newDescription);

$task = $taskManager->edit($editTask);
```

### Прикрепление файла к задаче
```php
use Sfadless\YandexTracker\Reference\IdReference;

$taskId = 'id_задачи';
$filePath = 'path/to/file.txt';

/** @var $fileManager Sfadless\YandexTracker\File\FileManagerInterface */
$fileManager = $taskManager->getFileManager();

$fileManager->attach(new IdReference($taskId), $filePath);
```

### Поиск задач по ключу
```php
use Sfadless\YandexTracker\Task\Action\SearchTasks;$taskKey = 'ключ_задача';
$taskKeys = ['Ключ_задачи_1', 'Ключ_задачи_2'];

$search = new SearchTasks([], null, $taskKeys);

/** @var $tasks Sfadless\YandexTracker\Task\Task[] */
$tasks = $taskManager->search($search);
```

### Получить прикрепленные файлы

```php
use Sfadless\YandexTracker\File\File;
use Sfadless\YandexTracker\Reference\IdReference;

$taskId = 'id_задачи';

/** @var $fileManager Sfadless\YandexTracker\File\FileManagerInterface */
$fileManager = $taskManager->getFileManager();

/** @var $files File[] */
$files = $fileManager->getFiles(new IdReference($taskId));
```