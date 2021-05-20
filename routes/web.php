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

Route::view('/', 'index')->name('login')->middleware('guest');
Route::post('/sing-in', [PageController::class, 'singin'])->name('sing-in');
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function(){
        Route::get('', [PageController::class, 'dashboard'])->name('dashboard');
        Route::view('/users', 'user.index')->name('user-index')->middleware('permission:user_read');
        Route::view('/role', 'permission-rol.index', ['option' => false])->name('rol-index');;
        Route::view('/permission', 'permission-rol.index', ['option' => true])->name('permission-index');
        Route::view('/students', 'student.index')->name('student-index');
        Route::view('/students/mass-creation', 'student.mass-creation')->name('student-mass-creation');
        Route::view('/category', 'department.index')->name('department-index');
        Route::view('/program', 'program.index')->name('program-index');
        Route::view('/course', 'course.index')->name('course-index');
        Route::view('/group', 'group.index')->name('group-index');
        Route::view('/role-moodle', 'rol_moodle.index')->name('rol-moodle-index');
        Route::view('/enrollment', 'enrollment.index')->name('enrollment-index');
        Route::view('/enrollment/mass-creation', 'enrollment.mass-creation')->name('enrollment-mass-creation');

    });
});
