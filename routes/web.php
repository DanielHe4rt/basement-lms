<?php

use Illuminate\Support\Facades\Route;
use LMS\Auth\Http\Controllers\AuthController;
use LMS\Auth\Http\Controllers\ViewController;

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


Route::get('/login', [ViewController::class, 'viewLogin'])->name('login');
Route::get('/register', [ViewController::class, 'viewRegister'])->name('register');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'postRegister'])->name('auth-register');
    Route::post('/login', [AuthController::class, 'postAuthenticate'])->name('auth-login');
    Route::get('/logout', [AuthController::class, 'getLogout'])->name('auth-logout')->middleware('auth');
});
