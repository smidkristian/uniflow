<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostVoteController;
use App\Http\Controllers\ResponseController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->group( function () {

    // POSTS

    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::get('/create-post', [PostController::class, 'create'])->name('create-post');
    Route::get('/post/{id}', [PostController::class, 'view'])->name('post-detail');

    Route::post('/store-post', [PostController::class, 'store'])->name('store-post');

    // RESPONSES

    Route::post('/store-response', [ResponseController::class, 'store'])->name('store-response');

    // VOTES

    Route::post('/post-vote', [PostController::class, 'vote'])->name('post-vote');
    Route::post('/delete-post-vote', [PostVoteController::class, 'delete'])->name('delete-post-vote');

});

