#!/bin/bash
set -e 

echo "Update .env 'php artisan migrate --env=production"
php artisan migrate --env=production

echo "Migrating database 'php artisan migrate --force'..."
php artisan migrate --force

echo "Database seeding 'php artisan db:seed'..."
php artisan db:seed
