<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'name_en',
        'slug',
        'description',
        'image',
        'customization_enabled',
        'sort_order',
    ];

    protected $casts = [
        'customization_enabled' => 'boolean',
    ];

    protected $appends = ['full_image_url'];

    public function getFullImageUrlAttribute()
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        
        $path = $this->image;
        // In this model, getImageAttribute already handles categories/ -> uploads/categories/
        // But we want to be safe
        if (str_starts_with($path, 'categories/')) {
            $path = 'uploads/' . $path;
        }
        
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }
        
        return asset('storage/' . $path);
    }

    public function getNameArAttribute(): ?string
    {
        return $this->attributes['name_ar'] ?? $this->attributes['name'] ?? null;
    }

    public function getNameEnAttribute(): ?string
    {
        return $this->attributes['name_en'] ?? $this->attributes['name'] ?? null;
    }

    public function getDescriptionArAttribute(): ?string
    {
        return $this->attributes['description_ar'] ?? $this->attributes['description'] ?? null;
    }

    public function getDescriptionEnAttribute(): ?string
    {
        return $this->attributes['description_en'] ?? $this->attributes['description'] ?? null;
    }

    public function getImageAttribute($value)
    {
        if ($value && str_starts_with($value, 'categories/')) {
            return str_replace('categories/', 'uploads/categories/', $value);
        }
        return $value;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name_ar ?? $category->name);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function allProducts()
    {
        // Without parent/children hierarchy, return only products directly under this category
        return $this->products();
    }
}
