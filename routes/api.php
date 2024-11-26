<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/posts', [PostController::class, 'posts']);

// route users

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'getUser']);

Route::get('/user/{id}', [AuthController::class, 'show']);
Route::put('/user/{id}', [AuthController::class, 'update']);
Route::delete('/user/{id}', [AuthController::class, 'destroy']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route untuk mendapatkan profil pengguna berdasarkan id_user
Route::get('/profile/{id}', [AuthController::class, 'profile']);

// Route admin
Route::post('/admin/register', [AdminController::class, 'store']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout']);

//route web
Route::post('/scrape', [ScrapingController::class, 'scrapeProduct']);

