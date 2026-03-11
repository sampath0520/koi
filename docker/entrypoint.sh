#!/bin/sh
set -e

# Wait for MySQL connection (extra safety beyond healthcheck)
echo "⏳  Waiting for MySQL..."
until php -r "new PDO('mysql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" 2>/dev/null; do
    sleep 2
done
echo "✅  MySQL is ready."

# Ensure storage dirs exist
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/bootstrap/cache

# Set permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "🔑  Generating APP_KEY..."
    php artisan key:generate --force
fi

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# Seed admin user (idempotent — uses updateOrCreate)
echo "🌱  Seeding admin user..."
php artisan db:seed --force

# Create storage symlink
echo "🔗  Creating storage link..."
php artisan storage:link --force || true

# Cache config & routes for production performance
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

echo "🚀  Laravel is ready!"

exec "$@"
