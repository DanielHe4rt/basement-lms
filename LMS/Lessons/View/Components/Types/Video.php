<?php

namespace LMS\Lessons\View\Components\Types;

use Illuminate\View\Component;
use LMS\Lessons\Models\Lesson;
use LMS\Modules\Models\Module;

class Video extends Component
{
    private Lesson $lesson;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('lessons::components.types.video');
    }
}
