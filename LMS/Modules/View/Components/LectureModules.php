<?php

namespace App\View\Components;

use Illuminate\View\Component;
use LMS\Courses\Models\Course;
use LMS\Lessons\Models\Lesson;

class LectureModules extends Component
{
    public Course $course;
    private Lesson $lesson;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Course $course, Lesson $lesson)
    {
        $this->course = $course;
        $this->lesson = $lesson;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('modules::components.lecture-modules');
    }
}
