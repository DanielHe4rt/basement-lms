<?php

namespace LMS\Landing\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use LMS\Courses\Models\Course;
use LMS\User\Models\User;

class LandingRepository
{

    private $courseModel;

    public function __construct(Course $courseModel)
    {
        $this->courseModel = $courseModel;
    }

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
        return $this->getCourseInformationByPaidAttribute(false);
    }

    private function getPaidCourseInformation(): array
    {
        return $this->getCourseInformationByPaidAttribute(true);
    }

    private function getCourseInformationByPaidAttribute(bool $paid): array
    {
        $where = [
            'paid' => $paid
        ];

        $courses = $this->getCoursesWhere($where);
        $courseTime = $this->getCoursesTotalTime($courses);

        return [
            'count' => $courses->count(),
            'time' => gmdate('H:i:s', $courseTime),
            'support' => $paid
        ];
    }

    private function getStudents(): int
    {
        return User::count();
    }

    private function getCourseTotalTime(): string
    {
        $where = [
            'paid' => true
        ];

        $courses = $this->getCoursesWhere($where);
        $courseTime = $this->getCoursesTotalTime($courses);

        return gmdate('H', $courseTime);
    }

    private function getTotalWatchedLessons(): int
    {
        return DB::table('user_watched_lessons')->count();
    }

    private function getCoursesWhere(array $where) : Collection
    {
        return $this->courseModel->where($where)->get();
    }

    private function getCoursesTotalTime(Collection $courses): int
    {
        $result = 0;
        foreach ($courses as $course) {
            $result += $course->duration;
        }
        return $result;
    }
}
