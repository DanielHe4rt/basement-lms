<?php


namespace LMS\Courses\Models;


use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use LMS\Lessons\Models\Lesson;
use LMS\Modules\Models\Module;
use LMS\User\Models\User;
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
        'slug',
        'published_at',
    ];

    protected $casts = [
        'paid' => 'bool',
    ];

    protected $appends = [
        'lessonsCount',
        'lessonsWatched',
        'progress',
        'duration'
    ];

    /*
     * Get all lessons duration in seconds.
     * Hint: use gmdate() to output
     */
    public function getDurationAttribute(): int
    {
        return $this->lessons()->sum('duration');
    }


    public function getProgressAttribute() {

        return $this->lessonsWatched && $this->lessonsCount
            ?number_format(($this->lessonsWatched / $this->lessonsCount ?? 0) * 100,2)
            : 0;
    }

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
        return $this->belongsTo(Level::class, 'course_level_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }

    public function getLessonsCountAttribute(): int
    {
        return $this->lessons()->count();
    }

    public function getLessonsWatchedAttribute(): int
    {
        return Auth::check()
            ? $this->watched()->wherePivotIn('lesson_id', collect($this->lessons)->pluck('id')->toArray())->count()
            : 0;
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'course_users',
            'course_id',
            'user_id'
        )->withPivot('created_at');
    }

    public function watched(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_watched_lessons',
            'course_id',
            'user_id'
        )->withPivot(['lesson_id', 'watched_at']);
    }

}
