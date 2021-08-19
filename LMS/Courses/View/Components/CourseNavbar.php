<?php

namespace LMS\Courses\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use LMS\Courses\Models\Course;

class CourseNavbar extends Component
{
    private Course $course;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }


    public function render(): View
    {
        return view('components.course-navbar');
    }
}
