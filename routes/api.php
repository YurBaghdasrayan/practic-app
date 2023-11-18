<?php

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


Route::post('/store', [\App\Http\Controllers\RegisterController::class, 'store']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'store']);

Route::group(['middleware' => ['auth:api']], function () {
	Route::post('/post/{post}', [\App\Http\Controllers\Post\PostController::class, 'update']);
	Route::post('/comment', [\App\Http\Controllers\Comment\CommentController::class, 'store']);
		Route::post('/reply-comment', [\App\Http\Controllers\ReplyComment\ReplyCommentController::class, 'store']);
	Route::resource('/post', \App\Http\Controllers\Post\PostController::class);
});



