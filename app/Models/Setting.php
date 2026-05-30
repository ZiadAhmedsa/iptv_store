<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /**
     * Get a setting value with caching (loads all settings at once).
     */
    public static function get($key, $default = null)
    {
        $settings = Cache::remember('app_settings_all', 600, function () {
            return self::pluck('value', 'key')->toArray();
        });

        return $settings[$key] ?? $default;
    }

    /**
     * Set a setting value and clear the cache.
     */
    public static function set($key, $value, $group = 'general')
    {
        Cache::forget('app_settings_all');
        return self::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
    }
}
