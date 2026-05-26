<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$tables = [
    'users',
    'categories',
    'products',
    'orders',
    'order_items',
    'codes',
    'product_images',
    'settings',
    'banners',
    'guides'
];

echo "--- Bakri Store Database Check ---\n";
foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        $count = DB::table($table)->count();
        echo "[OK] Table '$table' exists. Count: $count\n";
    } else {
        echo "[ERROR] Table '$table' is MISSING!\n";
    }
}

$siteName = \App\Models\Setting::get('site_name');
echo "\nSite Name from Settings: " . ($siteName ?: "NOT SET") . "\n";

if (DB::table('categories')->count() == 0) {
    echo "\n[WARNING] No categories found. Home API might return empty arrays.\n";
}

echo "\nRecommendation: If errors found, run 'php artisan migrate --seed'\n";
