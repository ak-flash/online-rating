<?php

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

Route::get('/', function () {
    return view('home', ['student' => session('student')]);
})->name('home');



Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/department/{id}', \App\Http\Livewire\DepartmentSettings::class)->name('department.settings');

        Route::get('/journals', \App\Http\Livewire\Journals::class)
            ->name('journals');

        Route::get('/journal/{journal}', \App\Http\Livewire\StudyClasses::class)
            ->name('study_classes');

        Route::get('/disciplines', \App\Http\Livewire\Disciplines::class)
            ->name('disciplines');

        Route::get('/discipline/{discipline}', \App\Http\Livewire\Topics::class)
            ->name('topics');

        Route::get('/students', \App\Http\Livewire\Students::class)
            ->name('students');

        Route::get('/users', \App\Http\Livewire\Users::class)->name('users');

        Route::middleware('role:admin')->group(function () {
            Route::get('/departments', \App\Http\Livewire\Departments::class)->name('departments');

            Route::get('/logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
        });

});

Route::prefix('student')
    ->middleware('student')
    ->group(function () {

        Route::get('/login', \App\Http\Livewire\StudentLogin::class)
            ->name('student.login')
            ->withoutMiddleware('student');

        Route::get('/dashboard', \App\Http\Livewire\StudentDashboard::class)
            ->name('student.dashboard');

        Route::get('/settings', \App\Http\Livewire\StudentDashboard::class)
            ->name('student.settings');

        Route::get('/logout', [\App\Models\Student::class, 'logout'])
            ->name('student.logout');
    });

require __DIR__.'/auth.php';
