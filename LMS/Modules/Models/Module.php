<?php


namespace LMS\Modules\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LMS\Courses\Models\Course;

class Module extends Model
{
    use HasFactory;
    protected $table = 'course_modules';

    protected $fillable = [
        'course_id',
        'name',
        'description',
        'order'
    ];

    public function getOrderAttribute()
    {
        return ++$this->attributes['order'];
    }

    protected $casts = [
        'order' => 'integer'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
