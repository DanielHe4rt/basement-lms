<?php


namespace LMS\Courses\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{

    protected $table = 'course_status';

    protected $fillable = [
        'name'
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
