<?php

namespace LMS\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use LMS\Billings\Models\Billing;
use LMS\Billings\Models\Card;
use LMS\Billings\Models\Plan;
use LMS\Courses\Models\Course;
use LMS\Lessons\Models\Lesson;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'last_seen',
        'password',
        'phone_number',
        'document_number',
        'birthdate',
        'plan_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        return $this->getFirstMediaUrl() ?: 'https://placehold.it/300x300';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user-avatar');
    }

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function seen()
    {
        $this->update(['last_seen' => Carbon::now()]);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'author_id');
    }

    public function enrollments(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'course_users',
            'user_id',
            'course_id'
        );
    }

    public function watched(): BelongsToMany
    {
        return $this->belongsToMany(
            Lesson::class,
            'user_watched_lessons',
            'user_id',
            'lesson_id'
        )->withPivot(['course_id', 'watched_at']);
    }

    public function card(): HasOne
    {
        return $this->hasOne(Card::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(Billing::class);
    }

}
