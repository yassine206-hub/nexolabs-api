FROM php:8.2-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Apache config
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]