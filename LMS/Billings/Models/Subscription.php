<?php

namespace LMS\Billings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;
    public $table = 'billing_plan_subscriptions';

    protected $fillable = [
        'plan_id',
        'data',
        'price',
    ];

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }
}
