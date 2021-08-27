<?php

use Illuminate\Support\Facades\Route;
use LMS\Auth\Http\Controllers\AuthController;
use LMS\Auth\Http\Controllers\ViewController as AdminViewController;
use LMS\Courses\Http\Controllers\CoursesController;
use LMS\Courses\Http\Controllers\LevelController;
use LMS\Courses\Http\Controllers\ViewController as CoursesViewController;
use LMS\Lessons\Http\Controllers\LessonsController;
use LMS\Modules\Http\Controllers\ModulesController;
use LMS\Modules\Http\Controllers\ViewController as ModulesViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('lms.dashboard');
})->name('dashboard')->middleware('auth');


Route::get('/login', [AdminViewController::class, 'viewLogin'])->name('login');
Route::get('/register', [AdminViewController::class, 'viewRegister'])->name('register');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth-register');
    Route::post('/login', [AuthController::class, 'postAuthenticate'])->name('auth-login');
    Route::get('/logout', [AuthController::class, 'getLogout'])->name('auth-logout')->middleware('auth');
});


Route::prefix('instructor/courses')->group(function () {
    Route::get('/', [CoursesViewController::class, 'viewCourses'])->name('instructor-courses');
    Route::get('/new', [CoursesViewController::class, 'viewCreateCourse'])->name('instructor-courses-new');
    Route::prefix('/{course}')->group(function () {
        Route::prefix('/manage')->group(function() {
            Route::get('/', [CoursesViewController::class, 'viewCourseManagement'])->name('instructor-course-manage');
        });


        Route::prefix('/curriculum')->group(function() {
            Route::get('/', [ModulesViewController::class, 'viewCourseModulesPage'])->name('instructor-course-curriculum');
            Route::post('/modules', [ModulesController::class, 'postCourseModule'])->name('instructor-course-module-new');
            Route::delete('/modules/{module}', [ModulesController::class, 'deleteCourseModule'])->name('instructor-course-module-delete');

            Route::prefix('/{module}/lessons')->group(function() {
                Route::post('/', [LessonsController::class, 'postLesson'])->name('instructor-course-lesson-new');
                Route::post('/{lesson}/uploadVideo', [LessonsController::class, 'postLessonVideo'])->name('instructor-course-lesson-video-upload');
                Route::put('/{lesson}', [LessonsController::class, 'putLesson'])->name('instructor-course-lesson-update');
            });
        });

    });

    Route::post('/', [CoursesController::class, 'postCourse'])->name('instructor-courses-create');
    Route::delete('/{course}', [CoursesController::class, 'deleteCourse'])->name('instructor-courses-delete');

    Route::prefix('levels')->group(function () {
        Route::get('/', [LevelController::class, 'getLevels'])->name('get-course-levels');
    });
});
