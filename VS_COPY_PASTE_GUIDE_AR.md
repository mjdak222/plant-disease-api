# نسخ جاهز للتعديل في VS Code (Plant Disease API)

هذا الملف يعطيك **Copy/Paste مباشر** للملفات الأساسية التي تم تعديلها.

> بعد اللصق في VS Code: احفظ الملفات ثم نفّذ أوامر التنظيف والتشغيل الموجودة في آخر الملف.

---

## 1) `config/services.php`

انسخ الملف بهذا الشكل (أو تأكد أن بلوك `fastapi` موجود داخل `return [ ... ]` قبل `];`):

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'fastapi' => [
        'base_url' => env('FASTAPI_BASE_URL', 'http://127.0.0.1:8001'),
        'timeout_seconds' => (int) env('FASTAPI_TIMEOUT_SECONDS', 20),
        'retry_times' => (int) env('FASTAPI_RETRY_TIMES', 2),
        'retry_sleep_ms' => (int) env('FASTAPI_RETRY_SLEEP_MS', 250),
        'verify_ssl' => filter_var(env('FASTAPI_VERIFY_SSL', true), FILTER_VALIDATE_BOOL),
    ],

];
```

---

## 2) `.env` (أو `.env.example` كمرجع)

أضف/تأكد من هذه القيم:

```env
SESSION_DRIVER=file

FASTAPI_BASE_URL=http://127.0.0.1:8001
FASTAPI_TIMEOUT_SECONDS=20
FASTAPI_RETRY_TIMES=2
FASTAPI_RETRY_SLEEP_MS=250
FASTAPI_VERIFY_SSL=true
```

> ملاحظة: `SESSION_DRIVER=file` يقلل مشاكل فشل الجلسات عند انقطاع اتصال PostgreSQL SSL.

---

## 3) `config/session.php`

تأكد من هذا السطر:

```php
'driver' => env('SESSION_DRIVER', 'file'),
```

---

## 4) `app/Http/Controllers/FastApiController.php`

تأكد أن الاتصال بـ FastAPI يستخدم `config/services.php` وليس URL ثابت:

```php
$baseUrl = rtrim(config('services.fastapi.base_url'), '/');
$response = Http::timeout(config('services.fastapi.timeout_seconds'))
    ->retry(
        config('services.fastapi.retry_times'),
        config('services.fastapi.retry_sleep_ms')
    )
    ->withOptions(['verify' => config('services.fastapi.verify_ssl')])
    ->attach('file', file_get_contents($image), $image->getClientOriginalName())
    ->post("{$baseUrl}/predict");
```

---

## 5) `app/Http/Controllers/PostController.php`

تأكد أن `user_id` من المستخدم الموثق فقط:

```php
'user_id' => $request->user()->id,
```

---

## 6) `routes/api.php`

تأكد أن كتابة الأمراض داخل `auth:sanctum`:

```php
Route::get('/diseases', [DiseaseController::class, 'index']);
Route::get('/diseases/name/{name}', [DiseaseController::class, 'showByName']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/diseases', [DiseaseController::class, 'store']);
    Route::put('/diseases/{disease}', [DiseaseController::class, 'update']);
    Route::delete('/diseases/{disease}', [DiseaseController::class, 'destroy']);
});
```

---

## أوامر بعد التعديل (Terminal داخل VS Code)

```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
php -l config/services.php
php -l config/session.php
```

لو عندك vendor جاهز:

```bash
php artisan test
```

---

## إذا ما زال يظهر خطأ SSL sessions

- تأكد أن `.env` الحقيقي فيه `SESSION_DRIVER=file`.
- نفّذ `php artisan config:clear`.
- أعد تشغيل السيرفر (`php artisan serve` أو Docker container).
- لو تريد ترجع لاحقًا لـ DB sessions، غيّر فقط `SESSION_DRIVER=database` بعد استقرار اتصال PostgreSQL.
