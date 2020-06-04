# Laravel Podio Logger

## Description

This package makes it easy to log your messages to a Podio app of your choice.

## Requirements

* php >= 7.2
* Laravel >= 5.8

## Installation instructions

1. Install using composer:

`composer require thinckx/laravel-podio-logger`

2. In `config/logging.php`, add the `podio` logging channel to the `channel` key:

```
'podio' => [
    'driver'        => 'monolog',
    'level'         => env('LOG_LEVEL', ''),
    'client_id'     => env('PODIO_LOG_CLIENT_ID', ''),
    'client_secret' => env('PODIO_LOG_CLIENT_SECRET', ''),
    'app_id'        => env('PODIO_LOG_APP_ID', ''),
    'app_token'     => env('PODIO_LOG_APP_TOKEN', ''),
    'handler'       => ThomasInckx\PodioLogger\PodioLoggerHandler::class,
    'app_name'      => env('APP_NAME', ''),
    'keys'          => [
        'level'     =>  'your-podio-app-level-field-name-or-id',
        'message'   =>  'your-podio-app-message-field-name-or-id',
        'app_name'  =>  'your-podio-app-appname-field-name-or-id'
    ]
]
```

3. Also in `config/logging.php`, add the `podio` channel to the `channels` array:

```
'stack' => [
    'driver' => 'stack',
    'channels' => ['podio', 'single'],
],
```

4. Don't forget to complete the `.env` file with the relevant info (see 2)

