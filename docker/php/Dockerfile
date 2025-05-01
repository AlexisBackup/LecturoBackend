FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libonig-dev libzip-dev zip curl libpq-dev \
    && docker-php-ext-install intl pdo pdo_mysql zip opcache

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/php/php.ini /usr/local/etc/php

# Set working directory
WORKDIR /var/www/html