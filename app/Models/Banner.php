<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'link_url',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['full_image_url'];

    public function getFullImageUrlAttribute()
    {
        if (!$this->image_url) return null;
        if (str_starts_with($this->image_url, 'http')) return $this->image_url;
        
        $path = $this->image_url;
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }
        
        return asset('storage/' . $path);
    }
}
