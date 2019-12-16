#!/bin/bash

set -e

composer install --no-interaction --optimize-autoloader

php bin/console ca:cl
php bin/console doctrine:migrations:migrate
