#!/bin/bash

echo "🚀 Starting Production Deployment / Optimization Process..."

# 1. Install Dependencies (Production without dev tools)
echo "📦 Installing composer dependencies..."
composer install --optimize-autoloader --no-dev

# 2. Clear All Caches
echo "🧹 Clearing old caches..."
php artisan optimize:clear

# 3. Cache Configuration & Routes for Maximum Speed
echo "⚡ Caching Configuration, Routes, and Views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Run Migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 5. Set Correct Permissions (Optional, depends on Linux server setup)
echo "🔒 Setting permissions..."
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# 6. Restart Octane or Queue workers (Uncomment if using Octane)
# echo "🔄 Restarting Octane server..."
# php artisan octane:reload
# php artisan queue:restart

echo "✅ Deployment optimizations completed successfully!"
