<?php

use Illuminate\Support\Facades\Route;
use LMS\Auth\Http\Controllers\AuthController;
use LMS\Auth\Http\Controllers\ViewController as AdminViewController;
use LMS\Billings\Http\Controllers\Billings\BillingsController;
use LMS\Billings\Http\Controllers\Billings\ViewController as BillingsViewController;
use LMS\Billings\Http\Controllers\Cards\CardController;
use LMS\Billings\Http\Controllers\Cards\ViewController as CardsViewController;
use LMS\Billings\Http\Controllers\Plans\PlansController;
use LMS\Billings\Http\Controllers\Plans\ViewController as PlansViewController;
use LMS\Billings\Http\Controllers\Providers\ProvidersController;
use LMS\Billings\Http\Controllers\Providers\ViewController as ProviderViewController;
use LMS\Billings\Http\Controllers\Subscriptions\SubscriptionController;
use LMS\Billings\Http\Controllers\Subscriptions\ViewController as SubscriptionViewController;
use LMS\Courses\Http\Controllers\CoursesController;
use LMS\Courses\Http\Controllers\LevelController;
use LMS\Courses\Http\Controllers\ViewController as CoursesViewController;
use LMS\Landing\Http\Controllers\ViewController as LandingViewController;
use LMS\Lessons\Http\Controllers\LessonsController;
use LMS\Modules\Http\Controllers\ModulesController;
use LMS\Modules\Http\Controllers\ViewController as ModulesViewController;
use LMS\User\Http\Controllers\MeController;

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

Route::get('/', [LandingViewController::class, 'viewLandingPage'])->name('landing');

Route::get('/dashboard', function () {
    return view('lms.dashboard');
})->name('dashboard')->middleware('auth');

Route::prefix('courses')
    ->middleware('auth')
    ->group(function () {
        Route::get('/{slug}', [CoursesViewController::class, 'viewCourse'])->name('course-preview');
        Route::post('/{course}/join', [CoursesController::class, 'postEnrollment'])->name('course-join');
        Route::get('/{slug}/learn', [CoursesViewController::class, 'viewCourseLessonRedirect'])->name('course-lesson-redirect');
        Route::get('/{slug}/learn/lessons/{lesson}', [CoursesViewController::class, 'viewCourseLesson'])->name('course-lesson');
        Route::put('/{slug}/learn/lessons/{lesson}', [LessonsController::class, 'putLessonStatus'])->name('course-lesson-watched');
    });


Route::get('/login', [AdminViewController::class, 'viewLogin'])->name('login');
Route::get('/register', [AdminViewController::class, 'viewRegister'])->name('register');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth-register');
    Route::post('/login', [AuthController::class, 'postAuthenticate'])->name('auth-login');
    Route::get('/logout', [AuthController::class, 'getLogout'])->name('auth-logout')->middleware('auth');
});

Route::get('/billings', [BillingsViewController::class, 'viewBillings'])->name('billings-invoices');

Route::prefix('subscriptions')->middleware('auth')->group(function () {
    Route::get('/', [SubscriptionViewController::class, 'viewSubscriptions'])->name('billings-subscriptions-view');

    Route::prefix('/payments')->group(function () {
        Route::post('/', [BillingsController::class, 'postBilling'])->name('billings-payments-create');
    });

    Route::prefix('/providers')->group(function () {
        Route::get('/', [ProviderViewController::class, 'viewProviders'])->name('billings-providers-list');
        Route::put('/{provider}', [ProvidersController::class, 'putProvider'])->name('billings-providers-update');
    });

    Route::prefix('/plans')->group(function () {
        Route::get('/', [PlansViewController::class, 'viewPlans'])->name('billings-plans-list');
        Route::post('/', [PlansController::class, 'postPlan'])->name('billings-plans-create');
    });

    Route::prefix('/cards')->group(function () {
        Route::get('/', [CardsViewController::class, 'viewCard'])->name('billings-card-view');
        Route::post('/', [CardController::class, 'postCard'])->name('billings-card-create');
        Route::delete('/', [CardController::class, 'deleteCard'])->name('billings-card-delete');
    });
});

Route::prefix('users/me')->middleware('auth')->group(function () {
    Route::put('/', [MeController::class, 'putMe'])->name('users-me-update');
});

Route::prefix('instructor/courses')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [CoursesViewController::class, 'viewCourses'])->name('instructor-courses');
    Route::get('/new', [CoursesViewController::class, 'viewCreateCourse'])->name('instructor-courses-new');
    Route::prefix('/{course}')->group(function () {
        Route::prefix('/manage')->group(function () {
            Route::get('/', [CoursesViewController::class, 'viewCourseManagement'])->name('instructor-course-manage');
        });

        Route::prefix('/curriculum')->group(function () {
            Route::get('/', [ModulesViewController::class, 'viewCourseModulesPage'])->name('instructor-course-curriculum');
            Route::post('/modules', [ModulesController::class, 'postCourseModule'])->name('instructor-course-module-new');
            Route::get('/{module}', [ModulesController::class, 'getCourseModule'])->name('instructor-course-module-get');
            Route::put('/{module}', [ModulesController::class, 'putCourseModule'])->name('instructor-course-module-update');
            Route::delete('/modules/{module}', [ModulesController::class, 'deleteCourseModule'])->name('instructor-course-module-delete');

            Route::prefix('/{module}/lessons')->group(function () {
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


Route::post('payments/{provider}/' . config('paymentProviders.secret'), [BillingsController::class, 'getCallback'])->name('billing-callbacks');
