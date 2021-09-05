<?php

namespace LMS\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use LMS\Billings\Models\Card;
use LMS\Courses\Models\Course;
use LMS\Lessons\Models\Lesson;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = Hash::make($value);
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
}
