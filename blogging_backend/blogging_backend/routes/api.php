<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/userRegister', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/getUser',[AuthController::class, 'user']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/postBlog', [BlogController::class, 'create']);
Route::post('/saveImage', [ImageController::class, 'create']);
Route::get('/fetchBlogs', [BlogController::class, 'index']);