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
Route::group(['prefix' => 'admin'], function () {
	Route::post('login', [\App\Http\Controllers\admin\LoginController::class, 'store']);
});

Route::group(['middleware' => ['auth:api']], function () {
	Route::resource('/post', \App\Http\Controllers\Post\PostController::class)->except('create');
	Route::resource('/comment', \App\Http\Controllers\Comment\CommentController::class)->except('create', 'edit');
	Route::get('/all-posts', [\App\Http\Controllers\Post\PostController::class, 'allPosts']);
	Route::get('/users', [\App\Http\Controllers\User\UserController::class, 'getUsersData']);
	Route::get('/post/{post?}/{lang?}', [\App\Http\Controllers\Post\PostController::class, 'show']);
	Route::post('/reply-comment', [\App\Http\Controllers\ReplyComment\ReplyCommentController::class, 'store']);
	Route::get('/block/user/{id?}', [\App\Http\Controllers\admin\AdminPrivilegeController::class, 'blockUser']);
	Route::post('moderator/create', [\App\Http\Controllers\admin\AdminPrivilegeController::class, 'createModerator']);
	Route::post('/search', [\App\Http\Controllers\SearchController::class, 'store']);
});


