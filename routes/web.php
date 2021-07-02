<?php

use Illuminate\Support\Facades\Route;
use LMS\Auth\Http\Controllers\AuthController;
use LMS\Auth\Http\Controllers\ViewController;
use LMS\Auth\Http\Controllers\ViewController as AdminViewController;
use LMS\Courses\Http\Controllers\CoursesController;
use LMS\Courses\Http\Controllers\ViewController as CoursesViewController;

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
    Route::post('/', [CoursesController::class, 'postCourse'])->name('post-book');
});
