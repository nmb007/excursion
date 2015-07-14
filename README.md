Yii 2 Basic Project Template | Excursion
========================================

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-basic/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-basic/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Clone the project in your local working directory and execute the following command

```php
composer update
```

After executing the above command you should have the vendor directory with yii core and extensions included

Now you should make a virtual host which will point to /basic/web directory and then you can access
application through the following URL
~~~
http://localhost/basic/
~~~


CONFIGURATION
-------------

### Environment

Copy the 'config/environment-default.php' file and rename the copied file to 'environment.php' and then Edit the environment
changes accordingly in this file, for example:

** For DEV environment **

```php
defined('YII_ENV') or define('YII_ENV', 'dev');
```
** For Prod environment **

```php
defined('YII_ENV') or define('YII_ENV', 'prod');
```

### Database


Create a database with the name of your choice

Copy the 'config/db-default.php' file and rename the copied file to 'db.php' and then Edit database
changes accordingly in this file, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

** Migrations **

To apply all migrations, execute the following command

```php
./yii migrate/up


**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.
