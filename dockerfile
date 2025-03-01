FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el código fuente de la aplicación
COPY . /var/www/html

# Configurar Apache y permisos
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Instalar las dependencias de Composer
RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generar la APP_KEY de Laravel
RUN php artisan key:generate

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
