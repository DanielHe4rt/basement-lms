<?php

namespace LMS\Billings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Plan extends Model
{
    protected $table = 'billing_plans';

    protected $fillable = [
        'provider_id',
        'name',
        'interval',
        'repeats',
        'price',
        'data'
    ];

}
