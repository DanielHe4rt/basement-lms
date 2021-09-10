<?php

namespace LMS\Billings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LMS\User\Models\User;

class Card extends Model
{
    public $incrementing = false;

    protected $table = 'user_card';

    protected $fillable = [
        'id',
        'user_id',
        'provider_id',
        'card',
        'brand',
        'last_digits'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
