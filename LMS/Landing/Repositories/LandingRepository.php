<?php

namespace LMS\Landing\Repositories;

use Illuminate\Support\Facades\DB;
use LMS\Courses\Models\Course;
use LMS\User\Models\User;

class LandingRepository
{
    public function retrieveData(): array
    {
        return [
            'achievements' => [
                'students' => $this->getStudents(),
                'contentHours' => $this->getCourseTotalTime(),
                'watchedLessons' => $this->getTotalWatchedLessons()
            ],
            'courses' => [
                'free' => $this->getFreeCourseInformation(),
                'paid' => $this->getPaidCourseInformation()
            ]
        ];
    }

    private function getFreeCourseInformation(): array
    {
        $model = new Course();
        $courseTime = 0;
        foreach ($model->where('paid', false)->get() as $value) {
            $courseTime += $value->duration;
        }

        return [
            'count' => $model->where('paid', false)->count(),
            'time' => gmdate('H:i:s', $courseTime),
            'support' => false
        ];
    }

    private function getPaidCourseInformation(): array
    {
        $model = new Course();
        $courseTime = 0;
        foreach ($model->where('paid', true)->get() as $value) {
            $courseTime += $value->duration;
        }

        return [
            'count' => $model->where('paid', true)->count(),
            'time' => gmdate('H:i:s', $courseTime),
            'support' => true
        ];
    }

    private function getStudents(): int
    {
        return User::count();
    }

    private function getCourseTotalTime(): string
    {
        $model = new Course();
        $courseTime = 0;

        foreach ($model->where('paid', true)->get() as $value) {
            $courseTime += $value->duration;
        }

        return gmdate('H', $courseTime);
    }

    private function getTotalWatchedLessons(): int
    {
        return DB::table('user_watched_lessons')->count();
    }
}
