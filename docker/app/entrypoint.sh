#!/bin/sh

php artisan octane:start --server=swoole --host=0.0.0.0 --port=9000 --max-requests=1000