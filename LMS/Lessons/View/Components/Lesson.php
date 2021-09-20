<?php

namespace LMS\Lessons\View\Components;

use Illuminate\View\Component;
use LMS\Modules\Models\Module;

class Lesson extends Component
{
    private Module $module;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lesson');
    }
}
