<?php


namespace LMS\Courses\Repositories;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $data['cover_path'] = Storage::disk('public')->put('courses_covers/', $data['cover']);
        return $this->model->create($data);
    }
}
