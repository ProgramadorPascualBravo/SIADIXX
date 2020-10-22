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
Route::get('/restore', function () {
    $faker = Faker\Factory::create();

    for ($i=0; $i <50; $i++) {
        $user = new \App\User();
        $user->name             = $faker->name;
        $user->last_name        = $faker->lastName;
        $user->username         = $faker->email;
        $user->password         = \Illuminate\Support\Facades\Hash::make('123456789');
        $user->department_id    = $faker->randomDigit;
        $user->save();
    }
});
Route::get('/', [PageController::class, 'index'])->name('login');
Route::post('/sing-in', [PageController::class, 'singin'])->name('sing-in');
Route::get('/logout', [PageController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/dashboard')->group(function(){
        Route::get('', [PageController::class, 'dashboard'])->name('dashboard');
        Route::prefix('/users')->group(function () {
            Route::get('', [PageController::class, 'user'])->name('user-index');
            Route::post('/create', [UserController::class, 'store'])->name('user-create');
        });
        Route::prefix('/department')->group(function (){
            Route::get('', [PageController::class, 'department'])->name('department-index');
        });
    });
});
