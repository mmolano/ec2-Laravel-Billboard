<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\SessionAuthMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\BodyTable;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// LOGGED OUT

Route::group([
    'middleware' => RedirectIfAuthenticated::class
], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    
    Route::group([
        'prefix' => 'register'
    ], function () {
        Route::get('/', [RegisterController::class, 'index'])->name('register');
        Route::post('/', [RegisterController::class, 'register'])->name('register.submit');
    });
});

// LOGGED IN

Route::group([
    'middleware' => SessionAuthMiddleware::class
], function () {
    Route::get('/dashboard', function () {
        return view('_app');
    })->name('dashboard');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::group([
        'prefix' => 'post'
    ], function () {
        Route::post('/', [PostController::class, 'store'])->name('post');
        Route::get('/{id}', [PostController::class, 'show'])->name('post.show');
        Route::delete('/{id}/delete', [PostController::class, 'delete'])->name('post.delete');
        Route::put('/{id}/edit', [PostController::class, 'update'])->name('post.update');
    });

    Route::group([
        'prefix' => 'comment'
    ], function () {
        Route::post('/', [CommentController::class, 'store'])->name('comment');
        Route::delete('/{id}/delete', [CommentController::class, 'delete'])->name('comment.delete');
        Route::put('/{id}/edit', [CommentController::class, 'update'])->name('comment.update');
    });
});