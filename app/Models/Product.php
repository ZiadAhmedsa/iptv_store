<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected static function booted()
    {
        $clearCache = function () {
            \Illuminate\Support\Facades\Cache::forget('home_categories_with_products');
            \Illuminate\Support\Facades\Cache::forget('home_featured_products');
            \Illuminate\Support\Facades\Cache::forget('home_best_selling_products');
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }

    protected $fillable = [
        'category_id',
        'name',
        'name_ar',
        'name_en',
        'slug',
        'description',
        'description_ar',
        'description_en',
        'price',
        'discount_price',
        'stock',
        'is_active',
        'target_audience',
        'customization_type',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'stock' => 'integer',
        'is_active' => 'boolean',
    ];

    public function getHasDiscountAttribute(): bool
    {
        return $this->discount_price !== null && $this->discount_price > 0 && $this->discount_price < $this->price;
    }

    public function getEffectivePriceAttribute(): float
    {
        return $this->has_discount ? (float) $this->discount_price : (float) $this->price;
    }

    public function getDiscountPercentageAttribute(): int
    {
        if (!$this->has_discount)
            return 0;
        return (int) round((($this->price - $this->discount_price) / $this->price) * 100);
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

    public function getImageAttribute(): ?string
    {
        return $this->primary_image_url;
    }

    public function getImageUrlAttribute(): ?string
    {
        $image = $this->primary_image_url;

        if (!$image) {
            return asset('images/no-image.png');
        }

        // If it's already a full URL
        if (preg_match('/^(https?:)?\/\//', $image)) {
            return $image;
        }

        // Clean path and ensure it doesn't double 'storage/'
        $path = ltrim($image, '/');
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, 8);
        }

        // Check if file exists in the storage/app/public directory
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        // Fallback to direct asset link
        return asset('storage/' . $path);
    }

    public function getFullImageUrlAttribute(): ?string
    {
        return $this->image_url;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $baseSlug = Str::slug($product->name_en ?? $product->name_ar ?? 'product');
            
            // If slug is still empty after slugify (Arabic/Non-latin), use a generic base
            if (empty($baseSlug)) {
                $baseSlug = 'product';
            }

            $slug = $baseSlug;
            $count = 2;

            // Ensure uniqueness
            while (static::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count;
                $count++;
            }

            $product->slug = $slug;
        });

        static::updating(function ($product) {
            // Only update slug if name changed and it's not manually set
            if ($product->isDirty(['name_ar', 'name_en']) && !$product->isDirty('slug')) {
                $baseSlug = Str::slug($product->name_en ?? $product->name_ar ?? 'product');
                if (empty($baseSlug)) $baseSlug = 'product';
                
                $slug = $baseSlug;
                $count = 2;

                while (static::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $baseSlug . '-' . $count;
                    $count++;
                }
                $product->slug = $slug;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPrimaryImageUrlAttribute(): ?string
    {
        $images = $this->relationLoaded('images') ? $this->images : null;

        $primary = $images
            ? $images->firstWhere('is_primary', true)
            : $this->images()->where('is_primary', true)->first();

        if ($primary) {
            return $primary->image_url;
        }

        $first = $images ? $images->first() : $this->images()->first();
        return $first ? $first->image_url : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}
