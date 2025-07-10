# Etapa base con PHP 8.2 y FPM
FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos de la app
COPY . .

# Instalar dependencias del proyecto Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear archivo .env físico (vacío)
RUN touch .env

# Dar permisos antes de ejecutar Artisan
RUN chmod -R 775 storage bootstrap/cache

# Ejecutar comandos de Laravel
RUN php artisan key:generate && \
    php artisan migrate --force && \
    php artisan db:seed --force

# Exponer puerto
EXPOSE 8000

# Iniciar servidor laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
