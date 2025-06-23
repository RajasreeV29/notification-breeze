<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PackageController;


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

Route::middleware('auth')->group(function () {
Route::resource('resident',ResidentController::class);
});

Route::middleware('auth')->group(function () {
Route::resource('packages',PackageController::class);
});

Route::post('/notifications/mark-as-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAsRead');

Route::post('/upload-image', function () {
    Auth::user()->upload->markAsRead();
    return back();})->name('image.upload');


require __DIR__.'/auth.php';
