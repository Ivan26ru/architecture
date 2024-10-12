#!/bin/bash
#выполняется при создании образа
composer install

# Нужен для laravel
sudo chown -R www-data:www-data /var/www/storage
sudo chown -R www-data:www-data /var/www/bootstrap/cache

php artisan key:generate
exec "${@-php-fpm}"
