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

    public function getFullAddress(): string
    {
        $fullAddress = $this->street . ', ' . $this->number . ', ' . $this->neighborhood;
        if($this->complement){
            $fullAddress = $this->street. ' , ' .$this->number. ' , ' .$this->neighborhood. ' , ' .$this->complement;
        }
        return $fullAddress;
    }

    public function getCityAndState(): string
    {
        return $this->city . ' / ' . $this->state;
    }
}
