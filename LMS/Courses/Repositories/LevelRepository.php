<?php


namespace LMS\Courses\Repositories;

use Illuminate\Support\Collection;
use LMS\Courses\Models\Level;

class LevelRepository
{

    private Level $model;

    public function __construct(Level $model)
    {
        $this->model = $model;
    }
    public function getAll(): Collection
    {
        return $this->model->all();
    }
}
