<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index'])->name('login')->middleware('guest');
Route::post('/sing-in', [PageController::class, 'singin'])->name('sing-in');
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function(){
        Route::get('', [PageController::class, 'dashboard'])->name('dashboard');
        Route::prefix('/users')->group(function () {
            Route::get('', [PageController::class, 'user'])->name('user-index');
        });
        Route::prefix('/students')->group(function () {
           Route::get('', [PageController::class, 'student'])->name('student-index');
           Route::get('/mass-creation', [PageController::class, 'studentMassCreation'])->name('student-mass-creation');
        });
        Route::prefix('/department')->group(function (){
            Route::get('', [PageController::class, 'department'])->name('department-index');
        });
        Route::prefix('/program')->group(function () {
            Route::get('', [PageController::class, 'program'])->name('program-index');
        });
        Route::prefix('/course')->group(function () {
            Route::get('', [PageController::class, 'course'])->name('course-index');
        });
        Route::prefix('/group')->group(function(){
            Route::get('', [PageController::class, 'group'])->name('group-index');
        });
        Route::prefix('/rol-moodle')->group(function(){
            Route::get('', [PageController::class, 'rol_moodle'])->name('rol-moodle-index');
        });
        Route::prefix('/enrollment')->group(function(){
            Route::get('', [PageController::class, 'enrollment'])->name('enrollment-index');
            Route::get('/mass-creation', [PageController::class, 'enrollmentMassCreation'])->name('enrollment-mass-creation');
        });
    });
});
