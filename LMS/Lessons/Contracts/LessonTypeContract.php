<?php

namespace LMS\Lessons\Contracts;

use LMS\Lessons\Models\Lesson;

interface LessonTypeContract
{
    public function handle(Lesson $lesson, array $payload): Lesson;
}
