LightPHP is a light PHP micro framework that helps you quickly write simple yet powerful APIs
## Installation

It's recommended that you use [Composer](https://getcomposer.org/) to install LightPHP.

```bash
$ composer require ratnadeep/LightPHP "*"
```

This will install LightPHP and all required dependencies. LightPHP requires PHP 7.0.0 or newer.

## Usage

Create an index.php file with the following contents:

```php
<?php

use LightPHP\API;

include '../vendor/autoload.php';

$app = new Api();

$app->run();
```
## Tests

To execute the test suite, you'll need phpunit.

```bash
$ phpunit
```
