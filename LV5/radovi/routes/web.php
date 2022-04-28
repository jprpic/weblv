<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'role' => Auth()->user()->role_id,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.'
    ], function(){
        Route::get('/roles', [AdminController::class, 'roles'])->name('roles');
        Route::post('/roles/{id}', [AdminController::class, 'changeRole'])->name('changeRole');
    });

    Route::group([
        'prefix' => 'teacher',
        'as' => 'teacher.'
    ],function(){

    });

    Route::group([
       'prefix' => 'student',
       'as' => 'student.'
    ], function(){
        Route::get('/tasks',[StudentController::class, 'index'])->name('tasks.index');
        Route::post('/store/{id}', [StudentController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/{id}', [StudentController::class, 'show'])->name('tasks.show');
        Route::delete('/tasks/{id}',[StudentController::class, 'destroy'])->name('tasks.destroy');
    });
});


require __DIR__.'/auth.php';
