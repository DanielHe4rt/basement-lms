<?php


namespace LMS\Modules\Repositories;


use Illuminate\Validation\UnauthorizedException;
use LMS\Courses\Models\Course;
use LMS\Modules\Models\Module;

class ModuleRepository
{
    private Module $model;

    public function __construct()
    {
        $this->model = new Module();
    }

    public function createModule(Course $course, array $payload)
    {
        $lastModule = $course->modules()
            ->orderByDesc('order')
            ->first();

        $payload['order'] = $lastModule ? $lastModule->order++ : 0;
        $payload['course_id'] = $course->id;

        return $this->model->create($payload);
    }

    public function deleteModule(Course $course, Module $module): bool
    {
        if ($module->course_id != $course->id) {
            throw new UnauthorizedException('Este módulo não pertence a esse curso.');
        }

        $module->delete();
        return $this->reorderModules($course, $module->order);
    }

    private function reorderModules(Course $course, int $lastOrder): bool
    {
        $modules = $course->modules()
            ->where('order', '>=', $lastOrder)
            ->orderBy('order')
            ->get();

        foreach ($modules as $module) {
            $module->decrement('order');
        }
        return true;
    }


}
