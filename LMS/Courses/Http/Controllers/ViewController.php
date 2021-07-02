<?php


namespace LMS\Courses\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ViewController extends Controller
{
    public function viewCourses(): View
    {
        return view('courses::courses');
    }

    public function viewCreateCourse(): View
    {
        return view('courses::newCourse');
    }
}
