<?php


namespace LMS\Modules\Http\Controllers;


use LMS\Courses\Models\Course;

class ViewController
{
    public function viewCourseModulesPage(Course $course)
    {
        return view('modules::modules', compact('course'));
    }
}
