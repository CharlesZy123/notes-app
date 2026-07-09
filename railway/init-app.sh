#!/bin/bash
set -e

echo "=== Clearing old cached config ==="
php artisan config:clear

echo "=== Running migrations ==="
php artisan migrate --force

echo "=== Starting server ==="
php artisan serve --host=0.0.0.0 --port=$PORT