Действия с очередями
===============

### Конфигурация

Для работы с трекером необходим токен и id организации. Более подробно: https://yandex.ru/dev/connect/tracker/api/concepts/access.html

Работа с очередями реализована в классе Sfadless\YandexTracker\Queue\QueueManager

```php
use Sfadless\YandexTracker\Queue\QueueManager;
use Sfadless\YandexTracker\Request\TrackerClient;

$token = "your_api_token_here";
$orgId = "your_org_id_here";

$client = new TrackerClient(HttpClient::create(), $token, $orgId);

$queueManager = new QueueManager($client);
```

### Получение информации об очереди

```php
use Sfadless\YandexTracker\Queue\Queue;
use Sfadless\YandexTracker\Reference\IdReference;

$queueKey = "your_queue_key_here"; 

/** @var $queue Queue */
$queue = $queueManager->getParameters(new IdReference($queueKey));
```

### Получение списка очередей

```php
use Sfadless\YandexTracker\Queue\Queue;

/** @var $list Queue[] */
$list = $queueManager->getList();
```

### Получение списка тегов очереди

```php
use Sfadless\YandexTracker\Queue\Queue;
use Sfadless\YandexTracker\Reference\IdReference;

$queueKey = "your_queue_key_here"; 

/** @var $tags string[] */
$tags = $queueManager->getTags(new IdReference($queueKey));
```
