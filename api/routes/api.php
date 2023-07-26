<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::get('/admin/posts', [AdminPostController::class, 'index']);
Route::post('/admin/posts', [AdminPostController::class, 'create']);
Route::get('/admin/posts/{post:uuid}/edit', [AdminPostController::class, 'edit']);
Route::patch('/admin/posts/{post:uuid}', [AdminPostController::class, 'update']);
