<?php


namespace LMS\Courses\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LMS\Courses\Models\Course;

class ViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewCourses(): View
    {
        $courses = Auth::user()->courses ?? [];
        return view('courses::courses', compact('courses'));
    }

    public function viewCreateCourse(): View
    {
        return view('courses::newCourse');
    }

    public function viewCourseManagement(Course $course): View
    {
        return view('courses::manageCourse', compact('course'));
    }
}
