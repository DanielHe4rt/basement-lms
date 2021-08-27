<?php

namespace LMS\Lessons\Repositories\Types;

use LMS\Lessons\Contracts\LessonTypeContract;
use LMS\Lessons\Models\Lesson;

class ArticleRepository implements LessonTypeContract
{

    public function handle(Lesson $lesson, array $payload): Lesson
    {
        $lesson->update(['content' => $payload['content']]);
        return $lesson;
    }
}
