<?php

namespace LMS\Lessons\Repositories;

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
        }

        if (!$belongsTo) {
            throw new \Exception('deu merda');
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


        dispatch(new AzureStreamingEncode($model));
        return $model;
    }

    private function checkVideoCanBeEncoded($model): void
    {
        if (!in_array($model->getStatus(), ['waiting', 'done'])) {
            throw new \Exception('aaaaaaaaaaaaaaa');
        }
    }

}
