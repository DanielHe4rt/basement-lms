<?php

namespace LMS\Lessons\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use LMS\Modules\Models\Module;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model implements HasMedia
{
    use InteractsWithMedia;

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
        return json_decode($this->attributes['content'] ?? [], true);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function initVideoStream() {
        $videoAttr = [
            'streamingUrls' => [],
            'info' => [
                'status' => 'waiting',
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
}
