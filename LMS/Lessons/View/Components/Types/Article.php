<?php

namespace LMS\Lessons\View\Components\Types;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use LMS\Lessons\Models\Lesson;

class Article extends Component
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


    public function render(): View
    {
        return view('lessons::components.types.article');
    }
}
