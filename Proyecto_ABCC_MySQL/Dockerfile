FROM php:8.2-cli

WORKDIR /app

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto
COPY . .

# Crear .env vacío para que artisan funcione durante el build
RUN cp .env.example .env

# Instalar dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Generar APP_KEY
RUN php artisan key:generate --force

# Eliminar .env para que en runtime use las variables de entorno de Render
RUN rm .env

EXPOSE 10000

# Al arrancar: crear .env desde variables de entorno de Render, luego servir
CMD bash -c "echo APP_NAME=Laravel > .env \
    && echo APP_ENV=${APP_ENV} >> .env \
    && echo APP_KEY=${APP_KEY} >> .env \
    && echo APP_DEBUG=${APP_DEBUG} >> .env \
    && echo APP_URL=${APP_URL} >> .env \
    && echo DB_CONNECTION=${DB_CONNECTION} >> .env \
    && echo DB_HOST=${DB_HOST} >> .env \
    && echo DB_PORT=${DB_PORT} >> .env \
    && echo DB_DATABASE=${DB_DATABASE} >> .env \
    && echo DB_USERNAME=${DB_USERNAME} >> .env \
    && echo DB_PASSWORD=${DB_PASSWORD} >> .env \
    && echo SESSION_DRIVER=cookie >> .env \
    && echo CACHE_DRIVER=file >> .env \
    && echo QUEUE_CONNECTION=sync >> .env \
    && php artisan config:clear \
    && php artisan serve --host=0.0.0.0 --port=10000"