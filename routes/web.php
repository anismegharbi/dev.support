<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModerationController;
use App\Http\Controllers\ForumController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['role:member|moderator|admin'])->group(function () {
    Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
});


Route::middleware(['role:moderator|admin'])->group(function () {
    Route::get('/moderation', [ModerationController::class, 'index'])->name('moderation.index');
});




Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index']);

