<?php


namespace LMS\Courses\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use LMS\Auth\Models\User;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courses';

    protected $fillable = [
        'author_id',
        'status_id',
        'course_level_id',
        'title',
        'subtitle',
        'description',
        'cover_path',
        'paid',
        'published_at',
    ];

    protected $casts = [
        'paid' => 'bool',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
