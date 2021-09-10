<?php

namespace LMS\Lessons\Repositories;

use Carbon\Carbon;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\Auth;
use LMS\Courses\Models\Course;
use LMS\Lessons\Contracts\LessonTypeContract;
use LMS\Lessons\Enums\LessonTypes;
use LMS\Lessons\Jobs\AzureStreamingEncode;
use LMS\Lessons\Models\Lesson;
use LMS\Lessons\Repositories\Types\ArticleRepository;
use Ramsey\Uuid\Uuid;

class LessonRepository
{
    private Lesson $model;

    public function __construct()
    {
        $this->model = new Lesson();
    }

    public function createLesson(array $payload)
    {
        $this->belongsTo($payload);
        $payload['id'] = Uuid::uuid4()->toString();
        if ($payload['type_id'] != LessonTypes::VIDEO) {
            return $this->model->create($payload);
        }

        $model = $this->model->create($payload);
        $model->initVideoStream();
        return $model;
    }

    public function updateLesson(array $payload): Lesson
    {
        $this->belongsTo($payload, true);
        $model = $this->model->find($payload['lesson_id']);
        $updater = $this->getRepository($model->type_id);

        return $updater->handle($model, $payload);
    }

    private function belongsTo(array $payload, bool $includesLesson = false): void
    {
        $belongsTo = Course::find($payload['course_id'])
            ->modules()
            ->find($payload['module_id']);
        if ($includesLesson) {
            $belongsTo = $belongsTo->lessons()
                ->find($payload['lesson_id']);

            if (!$belongsTo) {
                throw new \Exception('Essa lição não pertence à esse módulo');
            }
        }

        if (!$belongsTo) {
            throw new \Exception('Esse módulo não pertence à esse curso.');
        }
    }

    private function getRepository(int $lessonType): LessonTypeContract
    {
        return match ($lessonType) {
            LessonTypes::ARTICLE => new ArticleRepository()
        };
    }

    public function uploadVideo(array $payload)
    {
        $this->belongsTo($payload, true);
        $model = $this->model->find($payload['lesson_id']);

        $this->checkVideoCanBeEncoded($model);

        $model->clearMediaCollection();
        $model->addMediaFromRequest('video')
            ->toMediaCollection();

        $this->setVideoDuration($model);

        dispatch(new AzureStreamingEncode($model));
        return $model;
    }

    private function checkVideoCanBeEncoded($model): void
    {
        if (!in_array($model->getStatus(), ['waiting', 'done'])) {
            throw new \Exception('O arquivo ainda está sendo processado. Aguarde finalizar para executar outra ação.');
        }
    }

    private function setVideoDuration($model): void
    {
        try {
            $duration = FFProbe::create()
                ->format($model->getFirstMediaPath())
                ->get('duration');
            $model->update(['duration' => gmdate('H:i:s', $duration)]);
        } catch (\Exception) {
            // TODO: implementar logger
        }
    }

    public function handleWatchedLesson(array $payload)
    {
        $user = Auth::user();
        $lesson = $this->model->find($payload['lesson_id']);
        $alreadyWatched = $user->watched()->find($lesson);

        return $alreadyWatched
            ? $user->watched()->detach($lesson)
            : $user->watched()->attach($lesson, [
                'course_id' => $lesson->module->course_id,
                'watched_at' => Carbon::now()
            ]);
    }

}
