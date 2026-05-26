<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFreeSubscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'free_subscription_plan_id',
        'category_name',
        'mac_address',
        'device_id',
        'claimed_at',
        'expires_at',
        'status',
    ];

    protected $casts = [
        'claimed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(FreeSubscriptionPlan::class, 'free_subscription_plan_id');
    }
}
