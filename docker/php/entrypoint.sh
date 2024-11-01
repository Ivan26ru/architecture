#!/bin/bash
#выполняется при создании образа
composer install

exec "${@-php-fpm}"
