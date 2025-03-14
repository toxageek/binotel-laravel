# Binotel Laravel Package

Laravel-пакет для інтеграції з Binotel API. Пакет був створений для спрощення роботи з API Binotel, надаючи простий і зручний інтерфейс для виконання запитів.

Пакет підтримує всі основні функції API Binotel, включаючи отримання статистики дзвінків, управління клієнтами, налаштуваннями та дзвінками.

Пакет був створений на основі документації API Binotel, доступної за посиланням: [Binotel API Documentation](http://developers.binotel.ua/).

## Встановлення

```bash
composer require toxageek/laravel-binotel
```

Сервіс-провайдер буде автоматично зареєстрований; однак, якщо ви бажаєте зареєструвати його вручну, ви можете додати `Toxageek\BinotelLaravel\BinotelServiceProvider::class` до масиву в `bootstrap/providers.php` (`config/app.php` у Laravel 10 або старіших).

```php
'providers' => [
    Toxageek\BinotelLaravel\BinotelServiceProvider::class,
],
'aliases' => [
    'Binotel' => Toxageek\BinotelLaravel\Facades\Binotel::class,
],
```

Опублікуйте конфігураційний файл:

```bash
php artisan vendor:publish --tag=config
```

або додайте конфігурацію вручну у `config/services.php`:

```bash
'binotel' => [
  'key' => env('BINOTEL_KEY', ''),
  'secret' => env('BINOTEL_SECRET', ''),
  'api_url' => env('BINOTEL_API_URL', 'https://api.binotel.com/api/4.0/'),
],
```

Додайте ключі API у `.env`:

```env
BINOTEL_KEY=your_api_key
BINOTEL_SECRET=your_api_secret
BINOTEL_API_URL=https://api.binotel.com/api/
```

## Використання

### Отримання статистики

```php
use Toxageek\BinotelLaravel\Facades\Binotel;

// Вхідні дзвінки за певний період.
$stats = Binotel::stats()
    ->incomingCallsForPeriod(
        from: now()->subDays(5)->timestamp, 
        to: now()->timestamp
    );

// Вихідні дзвінки за певний період.
$stats = Binotel::stats()
    ->outgoingCallsForPeriod(
        from: now()->subDays(5)->timestamp, 
        to: now()->timestamp
    );

// CallTracking дзвінки за певний період.
$stats = Binotel::stats()
    ->callTrackingCallsForPeriod(
        from: now()->subDays(5)->timestamp, 
        to: now()->timestamp
    );

// Вхідні дзвінки з певного часу.
$stats = Binotel::stats()
    ->allIncomingCallsSince(
        from: now()->subDays(5)->timestamp
    );

// Вихідні дзвінки з певного часу.
$stats = Binotel::stats()
    ->allOutgoingCallsSince(
        from: now()->subDays(5)->timestamp
    );

// Вхідні та вихідні дзвінки за внутрішнім номером співробітника за певний період.
// Обмеження: період не може перевищувати 7 днів.
$stats = Binotel::stats()
    ->listOfCallsByInternalNumberForPeriod(
        internalNumber: '904',
        from: now()->subDays(5)->timestamp,
        to: now()->timestamp
    );

// Вхідні та вихідні дзвінки протягом дня.
$stats = Binotel::stats()
    ->listOfCallsPerDay(
        dayInTimestamp: now()->timestamp
    );

// Вхідні та вихідні дзвінки за певний період.
// Обмеження: не більше 24 годин.
$stats = Binotel::stats()
    ->listOfCallsForPeriod(
        from: now()->startOfDay()->timestamp,
        to: now()->endOfDay()->timestamp
    );

// Втрачені дзвінки за сьогодні.
$stats = Binotel::stats()
    ->listOfLostCallsForToday();

// Дзвінки які онлайн.
$stats = Binotel::stats()
    ->onlineCalls();

// Вхідні та вихідні дзвінки за номером телефону.
$stats = Binotel::stats()
    ->historyByExternalNumber(
        externalNumbers: ['0443334023'], // масив або строка
    );

// Вхідні та вихідні дзвінки за ідентифікатором клієнта.
$stats = Binotel::stats()
    ->historyByCustomerId(
        customerId: ['8916611'], // масив або строка
    );

// Вхідні та вихідні дзвінки Недавні дзвінки за внутрішнім номером співробітник.
// Обмеження: дзвінки за останні 2 тижні, не більше 50 дзвінків.
$stats = Binotel::stats()
    ->recentCallsByInternalNumber(
        internalNumber: '904'
    );

// Дані про дзвінок за ідентифікатором дзвінка.
$stats = Binotel::stats()
    ->callDetails(
        generalCallId: ['2255713', '2256039', '2252553']
    );

// Посилання на запис розмови.
$stats = Binotel::stats()
    ->callRecord(
        generalCallId: '12501059'
    );
```

### Отримання списку клієнтів

```php
use Toxageek\BinotelLaravel\Facades\Binotel;

// Вибір усіх клієнтів.
$clients = Binotel::customers()->list();

// Вибір клієнтів за ідентифікатором клієнта.
$clients = Binotel::customers()
    ->takeById(
        customerId: ['6611']
    );

// Вибір клієнтів за міткою.
$clients = Binotel::customers()
    ->takeByLabel(
        labelId: 18274
    );

// Пошук клієнтів за ім'ям або номером телефону.
$clients = Binotel::customers()
    ->search(
        subject: 'Генадій'
    );

// Створення клієнта.
$clients = Binotel::customers()
    ->create(
        name: 'New client',
        numbers: ['0970003322'],
        description: 'Інформація про клієнта!',
        email: 'new.client@gmail.com',
        assignedToEmployeeByInternalNumber: '904', // або assignedToEmployeeById: '8916611'
        labels: [18274]
    );

// Редагування клієнта.
$clients = Binotel::customers()
    ->update(
        id: '51813101',
        name: 'New name',
        numbers: ['0970003322', '0939990099'],
        description: 'Нова інформація про клієнта!',
        email: 'change.client@gmail.com',
        assignedToEmployeeByInternalNumber: '902', // або assignedToEmployeeById: '8916612'
        labels: [18273]
    );

// Видалення клієнта.
$clients = Binotel::customers()
    ->delete(
        customerId: [51813101]
    );

// Вибір усіх позначок.
$clients = Binotel::customers()->listOfLabels();
```

### Отримання дзвінків

```php
use Toxageek\BinotelLaravel\Facades\Binotel;

// Створення двостороннього дзвінка. Внутрішню лінію із зовнішнім телефонним номером.
$calls = Binotel::calls()
    ->internalNumberToExternalNumber(
        internalNumber: '904',
        externalNumber: '0443334023'
    );
    
// Створення двостороннього дзвінка. Зовнішній номер із зовнішнім телефонним номером.
$calls = Binotel::calls()
    ->externalNumberToExternalNumber(
        externalNumber1: '0970002233',
        externalNumber2: '0443334333',
        pbxNumber: '0443334023'
    );
    
// Створення двостороннього дзвінка. Зовнішній номер із зовнішнім телефонним номером.
$calls = Binotel::calls()
    ->externalNumberToIncomingCall(
        externalNumber: '0968487126',
        pbxNumber: 'CB_0800330683',
        pbxNumberInExternalCall: '0443339283'
    );

// Переадресація дзвінка за участю.
$calls = Binotel::calls()
    ->attendedCallTransfer(
        generalCallId: '22661563',
        externalNumber: '912'
    );

// Примусове завершення дзвінка.
$calls = Binotel::calls()
    ->hangupCall(
        generalCallId: '22661563'
    );

// Дзвінок із відтворенням голосового файлу.
$calls = Binotel::calls()
    ->callWithAnnouncement(
        externalNumber: '0443334023',
        voiceFileId: '4'
    );

// Дзвінок із голосовим меню.
$calls = Binotel::calls()
    ->callWithInteractiveVoiceResponse(
        externalNumber: '0443334023',
        ivrName: 'confirmation-call'
    );
```

### Отримання налаштувань

```php
use Toxageek\BinotelLaravel\Facades\Binotel;

// Вибір усіх працівників.
$settings = Binotel::settings()->listOfEmployees();

// Вибір всіх сценаріїв обробки вхідних дзвінків.
$settings = Binotel::settings()->listOfRoutes();

// Вибір усіх голосових повідомлень.
$settings = Binotel::settings()->listOfVoiceFiles();
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

