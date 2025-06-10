# Dockerfile
FROM php:8.2-apache

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala dependencias de SQLSRV
RUN apt-get update && ACCEPT_EULA=Y apt-get install -y gnupg2 unixodbc-dev
RUN pecl install pdo_sqlsrv sqlsrv && docker-php-ext-enable pdo_sqlsrv sqlsrv

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia el proyecto
COPY . /var/www/html

WORKDIR /var/www/html

# Instala dependencias
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Habilita Apache Rewrite
RUN a2enmod rewrite
COPY ./vhost.conf /etc/apache2/sites-available/000-default.conf

