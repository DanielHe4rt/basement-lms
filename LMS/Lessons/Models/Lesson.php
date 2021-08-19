<?php

namespace LMS\Lessons\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    public $primaryKey = false;

    protected $table = 'course_module_lessons';

    protected $fillable = [
        'type_id',
        'title',
        'description',
        'content',
        'duration'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
