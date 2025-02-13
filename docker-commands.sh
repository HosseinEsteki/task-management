#!/bin/bash

# Build and start containers
docker-compose up -d --build

# Install dependencies
docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app npm run dev

# Run migrations
docker-compose exec app php artisan migrate

# Generate application key
docker-compose exec app php artisan key:generate

# Clear cache
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear
