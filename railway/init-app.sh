#!/bin/bash
set -e

echo "=== Caching config and routes ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Starting server on port $PORT ==="
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}