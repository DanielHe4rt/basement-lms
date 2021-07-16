<?php


namespace LMS\Courses\Repositories;


use Illuminate\Support\Facades\Auth;
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

        $model = $this->model->create($data);
        $model->addMediaFromRequest('cover')
            ->toMediaCollection();

        return $model;
    }

    public function delete(int $id): bool | null
    {
        return $this->model->destroy($id);
    }
}
