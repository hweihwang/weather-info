FROM composer:latest AS vendor

COPY /api/composer.json /app/

RUN composer install --prefer-dist --no-dev -o --no-scripts --ignore-platform-reqs --no-interaction --no-plugins

FROM php:8.2.3-cli-alpine3.17

RUN apk add --no-cache \
    php81-dev \
    g++ make \
    bash nano \
    && pecl install openswoole-22.0.0 redis-5.3.7 \
    && docker-php-ext-enable openswoole redis \
    && docker-php-ext-install pdo pdo_mysql \
    && apk del g++ make \
    && rm -rf /tmp/*

COPY /api/ /var/www/html/

COPY --from=vendor /app/vendor/ /var/www/html/vendor/

COPY --from=vendor /usr/bin/composer /usr/local/bin/composer

COPY /docker/app/php.ini /usr/local/etc/php/php.ini

COPY /docker/app/entrypoint.sh /entrypoint.sh

WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache storage \
    && cp .env.dist .env \
    && composer dump-autoload -o \
    && php artisan config:cache \
    && php artisan key:generate \
    && php artisan optimize \
    && php artisan event:cache \
    && php artisan route:cache \
    && php artisan octane:install --server=swoole \
    && chmod +x /entrypoint.sh \
    && rm -rf .env.dist composer.lock /usr/local/bin/composer

EXPOSE 9000

ENTRYPOINT ["/entrypoint.sh"]
