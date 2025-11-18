# Imagen de PHP con extensiones requeridas
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libonig-dev libxml2-dev zip

# Extensiones necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring zip

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Setear carpeta de trabajo
WORKDIR /var/www/html

# Copiar proyecto al contenedor
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Optimizar Laravel
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Exponer puerto
EXPOSE 80

# Ejecutar Laravel con servidor embebido
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
