<?php

use App\Http\Controllers\PageController;
use App\User;
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


Route::get('/email/verify/{code}', [PageController::class, 'verify'])->name('verification.verify');
Route::view('/email/notice', 'email_verified.notice')->name('verification.notice');

Route::view('/', 'index')->name('login')->middleware('guest');
Route::post('/sing-in', [PageController::class, 'singin'])->name('sing-in');
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('/dashboard')->group(function(){
        Route::get('/', function (){
           return view('dashboard');
        })->name('dashboard');
       Route::get('/logs/{egg?}', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log-index');
       Route::view('/user/{egg?}', 'user.index')->name('user-index')
           ->middleware('permission:user_read');

        Route::get('/user/{id}/details/{egg?}', function ($id){
          return view('user.details', ['user' => \App\User::find($id)]);
        })->name('user-detail')->middleware('profile:user_detail');

        //Route::get('/user/report', [PageController::class, 'reportUser'])->name('user-report')->middleware('profile:report_read');

        Route::view('/role/{egg?}', 'permission-role.index', ['option' => false, 'egg' => $egg ?? null])->name('role-index');;

        Route::view('/permission/{egg?}', 'permission-role.index', ['option' => true, 'egg' => $egg ?? null])->name('permission-index');

        Route::view('/students/{egg?}', 'student.index', ['egg' => $egg ?? null])->name('moodle-index')
           ->middleware('permission:moodle_read');

        Route::get('/students/{id}/details/{egg?}', function ($id){
           return view('student.details', ['student' => \App\Student::find($id), 'egg' => $egg ?? null]);
        })->name('moodle-detail')->middleware('permission:moodle_detail');

        Route::view('/students/mass-creation/{egg?}', 'student.mass-creation', ['egg' => $egg ?? null])->name('moodle-mass-creation')
           ->middleware('permission:moodle_massive');

        Route::get('/students/report/{egg?}', [PageController::class, 'reportStudent'])->name('moodle-report')->middleware('permission:report_read');

        Route::get('/students/report/download/{egg?}', [PageController::class, 'exportReportStudent'])->name('moodle-report-download')->middleware('permission:report_read');

        Route::view('/category/{egg?}', 'department.index',['egg' => $egg ?? null])->name('category-index')
           ->middleware('permission:category_read');

        Route::view('/program/{egg?}', 'program.index', ['egg' => $egg ?? null])->name('program-index')
           ->middleware('permission:program_read');

        Route::get('/program/{id}/detail/{egg?}', function ($id) {
           return view('program.details', ['program' => \App\Program::find($id), 'egg' => $egg ?? null]);
        })->name('program-detail')->middleware('permission:program_detail');

        Route::view('/course/{egg?}', 'course.index', ['egg' => $egg ?? null])->name('course-index')
           ->middleware('permission:course_read');

        Route::get('/course/{id}/detail/{egg?}', function ($id) {
          return view('course.details', ['course' => \App\Course::find($id), 'egg' => $egg ?? null]);
        })->name('course-detail')->middleware('permission:course_detail');

       Route::get('/course/report/{egg?}', [PageController::class, 'reportCourse'])->name('course-report')->middleware('permission:report_read');

       Route::view('/group/{egg?}', 'group.index', ['egg' => $egg ?? null])->name('group-index')
           ->middleware('permission:group_read');

        Route::get('/group/{id}/detail/{egg?}', function ($id) {
          return view('group.details', ['group' => \App\Group::find($id), 'egg' => $egg ?? null]);
        })->name('group-detail')->middleware('permission:group_detail');

       Route::get('/group/report/{egg?}', [PageController::class, 'reportUser'])->name('group-report')->middleware('permission:report_read');

       Route::view('/role-moodle/{egg?}', 'rol_moodle.index', ['egg' => $egg ?? null])->name('role-moodle-index')
           ->middleware('permission:role_moodle_read');

       Route::view('/state-enrollment/{egg?}', 'state_enrollment.index', ['egg' => $egg ?? null])->name('state-enrollment-index')
          ->middleware('permission:state_enrollment_read');

        Route::view('/enrollment/{egg?}', 'enrollment.index', ['egg' => $egg ?? null])->name('enrollment-index')
           ->middleware('permission:enrollment_read');
        Route::view('/enrollment/mass-creation/{egg?}', 'enrollment.mass-creation', ['egg' => $egg ?? null])->name('enrollment-mass-creation')
           ->middleware('permission:enrollment_massive');

       Route::get('/enrollment/report/{egg?}', [PageController::class, 'reportEnrollment'])->name('enrollment-report')->middleware('permission:report_read');

       Route::any('/search/{egg?}', function ()
        {
           return view('search.index', ['egg' => $egg ?? null]);
        })->name('search-index')
           ->middleware('permission:search_read');

    });
});
