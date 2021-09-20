<?php


namespace LMS\Modules\Http\Controllers;


use App\Http\Controllers\Controller;
use LMS\Courses\Models\Course;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewCourseModulesPage(Course $course)
    {
        return view('modules::modules', compact('course'));
    }
}
