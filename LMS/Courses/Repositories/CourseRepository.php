<?php


namespace LMS\Courses\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use LMS\Courses\Models\Course;

class CourseRepository
{
    private Course $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Course
    {
        $data['author_id'] = Auth::id();
        $data['status_id'] = 1;
        $data['slug'] = Str::slug($data['title']);

        $model = $this->model->create($data);
        $model->addMediaFromRequest('cover')
            ->toMediaCollection();

        return $model;
    }

    public function delete(int $id): bool | null
    {
        return $this->model->destroy($id);
    }

    public function enroll(Course $course)
    {
        Auth::user()->enrollments()->attach($course, ['joined_at' => Carbon::now()]);
    }
}
