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

Route::group(['prefix' => 'moderator'], function () {
	Route::post('login', [\App\Http\Controllers\Moderator\LoginController::class, 'store']);
});

Route::group(['middleware' => ['auth:api']], function () {
	Route::resource('/post', \App\Http\Controllers\Post\PostController::class)->except('create', 'edit');
	Route::post('/post/{post}', [\App\Http\Controllers\Post\PostController::class, 'update']);
	Route::get('/post-show/{id}', [\App\Http\Controllers\Post\PostController::class, 'postShow']);
	Route::get('/all-posts', [\App\Http\Controllers\Post\PostController::class, 'allPosts']);
	Route::get('/get-post/{id}', [\App\Http\Controllers\Post\PostController::class, 'getPost']);
	Route::get('/post/{post?}/{lang?}', [\App\Http\Controllers\Post\PostController::class, 'show']);
	Route::get('/comment/{id?}', [\App\Http\Controllers\Comment\CommentController::class, 'index']);
	Route::delete('/comment-delete/{id?}', [\App\Http\Controllers\Comment\CommentController::class, 'delete']);
	Route::delete('/comment-reply-delete/{id?}', [\App\Http\Controllers\Comment\CommentController::class, 'commentReplyDelete']);
	Route::post('/comment', [\App\Http\Controllers\Comment\CommentController::class, 'store']);
	Route::post('/reply-comment', [\App\Http\Controllers\ReplyComment\ReplyCommentController::class, 'store']);
});


