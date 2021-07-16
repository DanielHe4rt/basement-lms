<?php


namespace LMS\Courses\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use LMS\Auth\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\MediaCollection;

class Course extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $table = 'courses';

    protected $fillable = [
        'author_id',
        'status_id',
        'course_level_id',
        'title',
        'subtitle',
        'description',
        'paid',
        'published_at',
    ];

    protected $casts = [
        'paid' => 'bool',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('courses-covers');
    }

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
