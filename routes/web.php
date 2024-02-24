<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;

Route::controller(LoginController::class)->group(function() {
    Route::get('/', 'index')->name('login.index');
    Route::post('/api/login', 'store')->name('login.store');
    Route::get('/api/logout', 'destroy')->name('login.destroy');
});

Route::get('/api/users', [UserController::class,'index'])-> name('users.index');
Route::get('/api/users/create', [UserController::class,'create'])-> name('users.create');
Route::post('/api/users', [UserController::class,'store'])-> name('users.store');
Route::get('/api/users/{user}/edit', [UserController::class,'edit'])-> name('users.edit');
Route::put('/api/users/{user}', [UserController::class,'update'])-> name('users.update');
Route::delete('/api/users/{user}', [UserController::class,'destroy'])-> name('users.destroy');

Route::get('/api/posts', [PostController::class,'index'])-> name('posts.index');
Route::get('/api/posts/create', [PostController::class,'create'])-> name('posts.create');
Route::post('/api/posts', [PostController::class,'store'])-> name('posts.store');
Route::get('/api/posts/{post}/edit', [PostController::class,'edit'])-> name('posts.edit');
Route::put('/api/posts/{post}', [PostController::class,'update'])-> name('posts.update');
Route::delete('/api/posts/{post}', [PostController::class,'destroy'])-> name('posts.destroy');

Route::get('/api/tags/create/{post}', [TagController::class,'create'])-> name('tags.create');
Route::get('/api/tags/{post}', [TagController::class,'index'])-> name('tags.index');
Route::post('/api/tags/{post}', [TagController::class,'store'])-> name('tags.store');
Route::get('/api/tags/{tag}/{post}/edit', [TagController::class,'edit'])-> name('tags.edit');
Route::any('/api/tags/{tag}/{post}', [TagController::class,'update'])-> name('tags.update');
Route::delete('/api/tags/{tag}/{post}', [TagController::class,'destroy'])-> name('tags.destroy');
Route::any('/api/tags/join/{tag}/{post}', [TagController::class,'joinPost'])-> name('tags.joinPost');
Route::any('/api/tags/destroy/join/{tag}/{post}', [TagController::class,'destroyJoinPost'])-> name('tags.destroyJoinPost');
