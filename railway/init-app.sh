#!/bin/bash
set -e

echo "=== Installing PHP dependencies ==="
composer install --optimize-autoloader --no-dev

echo "=== Building frontend assets ==="
npm install && npm run build

echo "=== Caching config and routes ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Starting server ==="
php artisan serve --host=0.0.0.0 --port=$PORT