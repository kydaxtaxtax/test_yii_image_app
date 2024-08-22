#!/bin/bash

# Останавливаем и удаляем существующие контейнеры
docker-compose down

# Строим и запускаем контейнеры
docker-compose up -d --build

# Ждем, пока контейнеры поднимутся
sleep 10

# Применяем миграции
docker exec yii2-php php yii migrate --interactive=0
