<?php

namespace LMS\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $table = 'user_address';

    protected $fillable = [
        'user_id',
        'street',
        'number',
        'neighborhood',
        'complement',
        'city',
        'state',
        'zip_code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
