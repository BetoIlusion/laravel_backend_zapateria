FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear carpeta de trabajo
WORKDIR /var/www

# Copiar código al contenedor
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Dar permisos correctos
RUN chmod -R 775 storage bootstrap/cache

# Puerto expuesto
EXPOSE 8000

# Comando para iniciar el servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

# Exponer el puerto
EXPOSE 8000

# Comando para iniciar el servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
