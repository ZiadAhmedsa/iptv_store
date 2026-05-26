<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuideStep extends Model
{
    protected $fillable = ['guide_id', 'image_path', 'description', 'sort_order'];
    protected $appends = [];

    public function getFullImageUrlAttribute()
    {
        if (!$this->image_path) return null;
        if (str_starts_with($this->image_path, 'http')) return $this->image_path;
        
        $path = $this->image_path;
        // Check if it's already in uploads
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }
        
        return asset('storage/' . $path);
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
