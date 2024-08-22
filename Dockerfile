FROM php:8.2-fpm

# Установка необходимых PHP расширений
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Установка Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Копирование проекта
WORKDIR /var/www/html
COPY . .

# Установка зависимостей
RUN composer install

## Выполняем миграции
#RUN php yii migrate --migrationPath=@app/migrations --interactive=0

# Настройки прав доступа
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
