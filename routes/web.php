<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStudentAuth;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;

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
})->name('home');;

Route::prefix('student')
    ->middleware(CheckStudentAuth::class)
    ->group(function () {

    Route::get('/login', \App\Http\Livewire\StudentLogin::class)
        ->name('student.login')
        ->withoutMiddleware(CheckStudentAuth::class);

    Route::get('/dashboard', \App\Http\Livewire\StudentDashboard::class)
        ->name('student.dashboard');

    Route::get('/settings', \App\Http\Livewire\StudentDashboard::class)
        ->name('student.settings');

    Route::get('/logout', [\App\Models\Student::class, 'logout'])
        ->name('student.logout');
});

Route::get('/kafedra/create', [TeamController::class, 'create'])
    ->middleware('role:moderator')
    ->name('teams.create');

Route::get('/kafedra/{team}', [TeamController::class, 'show'])
    ->name('teams.show');

Route::put('/current-kafedra', [CurrentTeamController::class, 'update'])
    ->name('current-team.update');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware('role:admin');

/*Route::fallback(function () {
    //
});*/
