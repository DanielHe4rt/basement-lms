<?php

namespace LMS\Dashboard\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use LMS\Courses\Models\Course;

class DashboardHero extends Component
{
    private Course $course;
    private string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $hero)
    {
        $this->course = $hero['course'];
        $this->type = $hero['type'];
    }

    public function render(): View
    {
        return view('dashboard::components.dashboard-hero', [
            'course' => $this->course,
            'type' => $this->type
        ]);
    }
}
