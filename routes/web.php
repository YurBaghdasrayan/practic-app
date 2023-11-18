<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth::routes(['verify' => true]);


Route::middleware(['guest'])->group(function () {
	Route::get('/registration', [\App\Http\Controllers\RegisterController::class, 'index']);
	Route::post('/store', [\App\Http\Controllers\RegisterController::class, 'store']);
	Route::post('/login-store-users', [\App\Http\Controllers\LoginController::class, 'store']);
	
	Route::group(['prefix' => 'admin'], function () {
		Route::get('/login', [\App\Http\Controllers\admin\LoginController::class, 'index']);
		Route::post('/login-store', [\App\Http\Controllers\admin\LoginController::class, 'store'])->name('admin.login.store');
	});
	Route::group(['prefix' => 'moderator'], function () {
		Route::get('/login', [\App\Http\Controllers\Moderator\ModeratorController::class, 'login']);
		Route::post('/login-store', [\App\Http\Controllers\Moderator\ModeratorController::class, 'store'])->name('moderator.login.store');
	});
});

Route::get('/verify/{token}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('users.verify');

Route::middleware(['admin'])->group(function () {
	Route::group(['prefix' => 'admin'], function () {
		Route::resource('/home', \App\Http\Controllers\admin\HomeController::class);
		Route::get('/users-posts', [\App\Http\Controllers\admin\AdminPrivilege::class, 'usersPost'])->name('admin.users.posts');
		Route::get('/users-list', [\App\Http\Controllers\admin\AdminPrivilege::class, 'usersList'])->name('admin.users.list');
		Route::get('/users-comments/{id?}', [\App\Http\Controllers\admin\AdminPrivilege::class, 'usersComments'])->name('admin.users.comments');
		Route::get('/delete/{id?}', [\App\Http\Controllers\admin\AdminPrivilege::class, 'destroy'])->name('admin.posts.delete');
		Route::get('/block-user/{id?}', [\App\Http\Controllers\admin\AdminPrivilege::class, 'blockUser'])->name('admin.block.user');
		Route::get('/delete-comment/{id?}', [\App\Http\Controllers\admin\AdminPrivilege::class, 'destroyComment'])->name('admin.delete.comment');
	});
});

Route::middleware(['moderator'])->group(function () {
	Route::group(['prefix' => 'moderator'], function () {
		Route::get('/home-moderator', [\App\Http\Controllers\Moderator\ModeratorController::class, 'index'])->name('home');
		Route::get('/delete/{id?}', [\App\Http\Controllers\Moderator\ModeratorController::class, 'destroy'])->name('delete');
		Route::get('/delete-comment/{id?}', [\App\Http\Controllers\Moderator\ModeratorController::class, 'destroyComment'])->name('delete.comment');
		Route::get('/users-posts', [\App\Http\Controllers\Moderator\ModeratorController::class, 'usersPost'])->name('users.posts');
		Route::get('/users-comments/{id?}', [\App\Http\Controllers\Moderator\ModeratorController::class, 'usersComments'])->name('users.comments');
		Route::get('/moderator-create', [\App\Http\Controllers\Moderator\ModeratorController::class, 'create'])->name('moderator.create');
		Route::post('/user-create', [\App\Http\Controllers\Moderator\ModeratorController::class, 'createUser'])->name('user.create');
	});
});

Route::get('/logout-moderator', [\App\Http\Controllers\Moderator\ModeratorController::class, 'logout'])->name('logout.moderator');
Route::get('/logout-admin', [\App\Http\Controllers\admin\LoginController::class, 'logout'])->name('logout');
