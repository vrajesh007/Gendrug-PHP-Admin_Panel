FROM php:8.2-apache

RUN apt-get update && apt-get install -y --no-install-recommends unzip git && \
    docker-php-ext-install mysqli && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --optimize-autoloader || true

COPY . .

RUN chown -R www-data:www-data /var/www/html/upload

EXPOSE 80
