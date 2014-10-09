# Yii Cleanapp

**Warning!** Currently this project is unsing non-stable version of yii (1.1.16-dev) to allow autoloading non-namespaced classes via composer.

Yii web application

## Features

* [Composer](https://getcomposer.org/) attached.
* Using composer classmap to autoload components and models.
* Preconfigured .htaccess and .gitignore files.
* Git ignored file main-local.php to store private application config.
* Custom migration template with variable to copy/paste SQL query.
* Console config uses main config to avoid code duplication.
* Preconfigured frendly urls.
* YII_DEBUG is enabled when client IP is 127.0.0.1.
* Full/Zero error reporting depending on YII_DEBUG.
* Fake CApplication class with phpdoc comments describing components for editor autocomplete function.
* DB schema caching enabled with cache flushing after "migrate" command ([description in Russian](http://codesex.org/component/content/article/4-php-scripts/50-yii-framework-schema-cache)).
* ClientScript package "jquery" is connected to public CDN's ([Google](https://developers.google.com/speed/libraries/devguide), [Yandex](http://api.yandex.ru/jslibs/), [Media Temple](http://code.jquery.com/)).
* Automatic assets minifying + gzip conpression.
* Ability to automatically publish CClientSctipt css/js files as assets.
* .htaccess to send headers for caching of all assets for 1 year by default with mod_expires.
* ConsoleCommand converts unnamed shell arguments to action params.
* [Blueprint CSS framework](http://www.blueprintcss.org/) replaced with [Bootstrap 3](http://getbootstrap.com/).
* [PHPUnit](http://phpunit.de/) with all Yii dependencies installed via composer.
* 3 new file log routes: error.log, error404.log and warning.log. Error404.log also contains referer information.

And lot of small changes.

## Included shell scripts

* *protected/init.sh* -
	* Fixes file/directory permissions (like "runtime" and "assets").
	* Creates local config file if not created.
	* Downloads composer.phar if not exists or runs composer self-update if exists.
	* Runs composer install (`composer install --no-dev --optimize-autoloader` if called like `protected/init.sh prod`).
* *protected/phpunit.sh* - runs phpunit tests. This script can be launched from anywhere but takes "phpunit.xml" file from "protected/tests/" directory. If you want to run specific tests directory or file you can pass it's path as first argument.
* *protected/live-commit.sh* - commits all changed files and adds current datetime to commit message.