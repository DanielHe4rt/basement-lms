<?php

namespace LMS\Lessons\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LMS\Lessons\Enums\LessonTypes;
use LMS\Lessons\Enums\UploadStatus;
use LMS\Modules\Models\Module;
use LMS\User\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Lesson extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $incrementing = false;

    protected $table = 'course_module_lessons';

    protected $fillable = [
        'id',
        'module_id',
        'type_id',
        'title',
        'description',
        'content',
        'duration'
    ];

    protected $appends = [
        'video'
    ];

    public function getVideoAttribute()
    {
        return $this->attributes['type_id'] == LessonTypes::VIDEO
            ? json_decode($this->attributes['content'] ?? [], true)
            : [];
    }

    public function getDurationAttribute()
    {
        return substr($this->attributes['duration'], 3, 6);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->extractVideoFrameAtSecond(0)
            ->performOnCollections('default');
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function initVideoStream()
    {
        $videoAttr = [
            'streamingUrls' => [],
            'info' => [
                'status' => UploadStatus::WAITING,
                'percent' => 0
            ]
        ];
        $this->update(['content' => json_encode($videoAttr)]);
    }

    public function setInfo(string $key, string $value): void
    {
        $videoAttr = json_decode($this->attributes['content'], true);
        $videoAttr['info'][$key] = $value;

        $this->update(['content' => json_encode($videoAttr)]);
    }

    public function getInfo(string $key): mixed
    {
        $videoAttr = json_decode($this->attributes['content'], true);
        return $videoAttr['info'][$key];
    }

    public function setStreamingUrls(array $urls): void
    {
        $videoAttr = json_decode($this->attributes['content'], true);
        $videoAttr['streamingUrls'] = $urls;
        $this->update(['content' => json_encode($videoAttr)]);
    }

    public function getStatus(): string
    {
        $videoAttr = json_decode($this->attributes['content'], true);
        return $videoAttr['info']['status'];
    }

    public function getStreamingUrl($type = 'Hls')
    {
        $videoAttr = json_decode($this->attributes['content'], true);

        return collect($videoAttr['streamingUrls'])
            ->first(fn($types) => $types['protocol'] == $type);
    }

    public function whoWatched()
    {
        return $this->belongsToMany(
            User::class,
            'user_watched_lessons',
            'lesson_id',
            'user_id'
        )->withPivot(['course_id', 'watched_at']);
    }
}
