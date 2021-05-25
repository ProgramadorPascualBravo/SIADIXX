<?php

use App\Http\Controllers\PageController;
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
        Route::view('', 'dashboard')->name('dashboard');

        Route::view('/users', 'user.index')->name('user-index')
           ->middleware('permission:user_read');

        Route::view('/role', 'permission-role.index', ['option' => false])->name('role-index');;

        Route::view('/permission', 'permission-role.index', ['option' => true])->name('permission-index');

        Route::view('/students', 'student.index')->name('student-index')
           ->middleware('permission:moodle_read');

        Route::get('/students/{id}/details', function ($id){
           return view('student.details', ['student' => \App\Student::find($id)]);
        })->name('student-detail')->middleware('permission:moodle_detail');

        Route::view('/students/mass-creation', 'student.mass-creation')->name('student-mass-creation')
           ->middleware('permission:moodle_massive');

        Route::view('/category', 'department.index')->name('department-index')
           ->middleware('permission:category_read');

        Route::view('/program', 'program.index')->name('program-index')
           ->middleware('permission:program_read');

        Route::get('/program/{id}/detail', function ($id) {
           return view('program.details', ['program' => \App\Program::find($id)]);
        })->name('program-detail')->middleware('permission:program_detail');

        Route::view('/course', 'course.index')->name('course-index')
           ->middleware('permission:course_read');

        Route::get('/course/{id}/detail', function ($id) {
          return view('course.details', ['course' => \App\Course::find($id)]);
        })->name('course-detail')->middleware('permission:course_detail');

        Route::view('/group', 'group.index')->name('group-index')
           ->middleware('permission:group_read');

        Route::get('/group/{id}/detail', function ($id) {
          return view('group.details', ['group' => \App\Group::find($id)]);
        })->name('group-detail')->middleware('permission:group_detail');


        Route::view('/role-moodle', 'rol_moodle.index')->name('role-moodle-index')
           ->middleware('permission:role_read');
        Route::view('/enrollment', 'enrollment.index')->name('enrollment-index')
           ->middleware('permission:enrollment_read');
        Route::view('/enrollment/mass-creation', 'enrollment.mass-creation')->name('enrollment-mass-creation')
           ->middleware('permission:enrollment_massive');

        Route::any('/search', function ()
        {
           return view('search.index');
        })->name('search-index')
           ->middleware('permission:search_read');

    });
});
