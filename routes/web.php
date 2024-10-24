<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard',compact('user'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/form', [RoleController::class, 'goToPage'])->name('form');
Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign.role');
Route::post('/assign-permission', [RoleController::class, 'getPermissions'])->name('assign.permission');

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/post-form',[PostController::class,'create'])->name('post.form');
Route::post('/post-form',[PostController::class,'store'])->name('post.store');
Route::get('/post-edit/{id}',[PostController::class,'edit'])->name('post.edit');
Route::post('/post-update/{id}', [PostController::class, 'update'])->name('post.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');
