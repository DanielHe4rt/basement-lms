<?php


namespace LMS\Courses\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use LMS\Courses\Models\Course;
use LMS\Lessons\Models\Lesson;

class ViewController extends Controller
{

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

    public function viewCourse(string $slug)
    {
        $course = Course::whereSlug($slug)->first();
        if (!$course) {
            abort(404);
        }

        return view('courses::user.landing', compact('course'));
    }

    public function viewCourseLessonRedirect(string $slug)
    {
        $course = Course::whereSlug($slug)->first();

        if (!$course) {
            abort(404);
        }

        $firstLesson = $course->modules()
            ->first()
            ->lessons()
            ->first();

        return redirect(route('course-lesson', ['slug' => $slug, 'lesson' => $firstLesson]));
    }

    public function viewCourseLesson(string $slug, Lesson $lesson)
    {
        $course = Course::whereSlug($slug)->first();
        if (!$course || $lesson->module->course->slug != $slug) {
            abort(404);
        }

        if (!Auth::user()->hasAnyRole(['admin', 'subscriber', 'free'])) {
            return redirect(route('billings-subscriptions-view'));
        }

        return view('lessons::lecture', compact(['course', 'lesson']));
    }
}
