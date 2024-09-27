<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/conference', function () {
    return view('conference');
})->name('conference');

Route::get('/conference', [ConferenceController::class, 'index'])->name('conference');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create')->middleware('auth');
Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store')->middleware('auth');

Route::resource('rooms', RoomController::class)->middleware('auth');


require __DIR__.'/auth.php';
