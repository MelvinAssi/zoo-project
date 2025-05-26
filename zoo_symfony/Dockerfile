FROM php:8.2-fpm

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git unzip zip libpq-dev libonig-dev libzip-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_pgsql zip intl opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

CMD ["php-fpm"]