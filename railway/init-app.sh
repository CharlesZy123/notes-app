#!/bin/bash
set -e

echo "=== Caching config and routes ==="
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Starting nginx ==="
nginx -g "daemon off;"