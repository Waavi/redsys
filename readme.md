# RedSys online POS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/waavi/redsys.svg?style=flat-square)](https://packagist.org/packages/waavi/redsys)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/Waavi/redsys/master.svg?style=flat-square)](https://travis-ci.org/Waavi/redsys)
[![Total Downloads](https://img.shields.io/packagist/dt/waavi/redsys.svg?style=flat-square)](https://packagist.org/packages/waavi/redsys)

WAAVI is a web development studio based in Madrid, Spain. You can learn more about us at [waavi.com](http://waavi.com)

## Installation

You may install the package via composer

    composer require waavi/redsys 1.x

Add the service provider:

```php
// config/app.php

'providers' => [
    ...
    \Waavi\Redsys\RedsysServiceProvider::class,
];
```

To enable the Redsys facade:

```php
// config/app.php

'aliases' => [
    ...
   'Redsys' => \Waavi\Redsys\Facades\Redsys::class,
];
```

Publish the config file

    php artisan vendor:publish --provider="Waavi\Redsys\ResponseCacheServiceProvider"