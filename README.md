# Push notification

Пример использования:
```php
use GuzzleHttp\Client;
use Push\Interfaces\DeviceInterface;
use Push\IOSDevice;
use Push\IOSPusher;
use Push\Message;
use Push\Options\IOSAlertOptionsMessage;
use Push\Payloads\IOSAlertPayload;
use Push\PushManager;
use Push\Interfaces\IOSPayloadType;

require_once 'vendor/autoload.php';

$guzzleClient = new Client;
$iosPusher = new IOSPusher(
    'some_key.p8',          // приватный ключ
    'AAAAAAAAAA',           // идентификатор разработчика
    'BBBBBBBBBB',           // идентификатор команды
    'com.example.app',      // идентификатор приложения
    $guzzleClient           // http клиент (PSR-18)
);

// регистрируем объект для формирования тела запроса
$iosPusher->setPayloadResolver(IOSPayloadType::ALERT, new IOSAlertPayload);

$manager = new PushManager;

// регистрируем объект для отправки уведомлений на IOS устройства
$manager->setPusher(DeviceInterface::TYPE_IOS, $iosPusher);

// некоторое IOS устройво на которое будем отправлять уведомление
$myIphone = new IOSDevice('6000000000000000000000000000000000000000000000000000000000000001');

// Сообщение для оправки
$testMessage = new Message('Тестовая тема', 'Некоторое сообщение');

// Дополнительные параметры сообщения для платформы IOS
IOSAlertOptionsMessage::init()
    ->setSubtitle('Подзаголовок')
    ->setCategory('test')
    ->setBadge(1)
    ->setSound('bingbong.aiff', 1, 1)
    ->loadTo($testMessage);

// Отправляем уведомление на указанные устройства
$resultList = $manager->sendMessage($testMessage, $myIphone);

```