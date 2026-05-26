<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreeSubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'host',
        'username',
        'password',
        'description',
        'duration_days',
        'assigned_email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function userSubscriptions()
    {
        return $this->hasMany(UserFreeSubscription::class);
    }
}
