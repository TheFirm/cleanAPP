#!/bin/bash

protected=`dirname $0`
webroot="$protected/.."
env=${1:-"dev"}

# Setup directory permissions
chmod 777 $webroot/assets
chmod 777 $protected/runtime
chmod 777 $protected/runtime/cache
chmod 755 $protected/yiic

# Create local config file if not exits
test -f $protected/config/main-local.php || cp $protected/config/main-local.example.php $protected/config/main-local.php

# Download composer if needed
test -f $webroot/composer.phar && {
	php $webroot/composer.phar self-update
} || {
    curl -sS https://getcomposer.org/installer | php -- --install-dir=$webroot
}

# Composer install
if [ $env = "prod" ] ; then
    php $webroot/composer.phar -d=$webroot install --no-dev --optimize-autoloader
else
    php $webroot/composer.phar -d=$webroot install --dev
fi
