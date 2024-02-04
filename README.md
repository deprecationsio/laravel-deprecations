# deprecationsio/laravel-deprecations

deprecationsio/laravel-deprecations is a Laravel package integrating the [deprecations.io](https://deprecations.io) 
service into Laravel applications.

deprecations.io is a plug-and-play service to monitor and update your usages of deprecated features from your 
vendors, keeping your code ready for every major version to come. 

Keeping your code up-to-date was never this easy!

## Setup

deprecationsio/laravel-deprecations requires PHP 7.3+ and Laravel 8.0+.

1. Install the package using Composer:

```
composer require deprecationsio/laravel-deprecations
```

2. Enable the provider in your `config/app.php` file:

```php
// config/app.php

    // ... 
    'providers' => [
        // ...
        
        /*
         * Package Service Providers...
         */
        Deprecationsio\Laravel\DeprecationsioProvider::class,
    
        // ...
    ],
    // ...
```

3. Configure your application to use the package for deprecations in your `config/logging.php` file:

```php
// config/logging.php

    // ...
    'channels' => [
        // ...
        'deprecations' => [
            'driver' => 'deprecationsio',
            'dsn' => 'https://ingest.deprecations.io/?apikey=<your-api-key>',
        ],
    ],
    // ...
```
