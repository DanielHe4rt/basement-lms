<?php


namespace LMS\Courses\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    protected $table = 'course_levels';

    protected $fillable = [
        'name',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
