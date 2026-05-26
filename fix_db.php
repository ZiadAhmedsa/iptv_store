<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

try {
    echo "1. Adding is_featured column to products table...\n";
    if (!Schema::hasColumn('products', 'is_featured')) {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('is_active');
        });
        echo "Done.\n";
    } else {
        echo "Column already exists.\n";
    }

    echo "2. Clearing cache and config...\n";
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    echo "Done.\n";

    echo "3. Verifying hashing driver...\n";
    echo "Current driver: " . config('hashing.driver') . "\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
