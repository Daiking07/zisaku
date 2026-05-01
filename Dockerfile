FROM php:7.4-cli

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]