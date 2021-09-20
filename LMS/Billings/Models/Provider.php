<?php

namespace LMS\Billings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'billing_providers';

    protected $fillable = [
        'name',
        'image',
        'active'
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

    public function turnOn()
    {
        $this->update(['active' => true]);
    }

    public function turnOff()
    {
        $this->update(['active' => false]);
    }
}
