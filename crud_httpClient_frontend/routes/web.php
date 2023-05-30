<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('logout', [UserController::class, 'logout']);
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register']);
Route::get('home', [UserController::class, 'showHomeForm'])->name('home');
Route::get('home2', [UserController::class, 'showHome2Form'])->name('home2');
Route::get('index', [PostController::class, 'index'])->name('index');
Route::get('store', [PostController::class, 'store'])->name('store');
Route::get('test', [PostController::class, 'test'])->name('test');
Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('show');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
Route::get('create', [PostController::class, 'showStoreForm'])->name('create');
Route::post('store', [PostController::class, 'store'])->name('store');

Route::get('/', function () {
    return view('home');
});
