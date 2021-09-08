<?php

namespace LMS\Billings\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LMS\User\Models\User;

class Billing extends Model
{
    use HasFactory;

    protected $table = 'user_billings';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'provider_id',
        'plan_id',
        'user_id',
        'status',
        'data',
        'paid_at'
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paid(): void
    {
        $this->update(['paid_at' => Carbon::now()]);
    }

}
