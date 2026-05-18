FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . .

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]