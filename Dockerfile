# Etapa base con PHP 8.2 y FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar todos los archivos del proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear el archivo .env y ejecutar comandos clave
RUN php artisan key:generate && \
    php artisan migrate --force

# Dar permisos necesarios
RUN chmod -R 775 storage bootstrap/cache

# Exponer puerto 8000 para Render
EXPOSE 8000

# Iniciar el servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
