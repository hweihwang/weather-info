#!/bin/sh

php artisan migrate

php artisan optimize

php artisan event:cache

php artisan config:cache

php artisan route:cache

php artisan db:seed

php artisan octane:start --server=swoole --host=0.0.0.0 --port=9000 --max-requests=1000