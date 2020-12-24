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

        Route::get('/users', function () {
            return view('dashboard');
        })->middleware('role:admin')->name('users');

        Route::get('/journals', \App\Http\Livewire\Journals::class)
            ->name('journals');

        Route::get('/disciplines', \App\Http\Livewire\Disciplines::class)
            ->name('disciplines');

        Route::get('/students', \App\Http\Livewire\Students::class)
            ->name('students');

        Route::get('/logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->middleware('role:admin')->name('logs');

});



require __DIR__.'/auth.php';
