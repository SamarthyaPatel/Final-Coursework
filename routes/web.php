<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\NotificationController;

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
    return view('welcome');
});

Route::get('/posts', function () {
    return view('layouts.basic');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('posts')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('index');

    Route::get('/create', [PostController::class, 'create'])->name('create');

    Route::post('/', [PostController::class, 'store'])->name('store');

    Route::post('/{id}', [CommentController::class, 'store'])->name('comment');

    Route::get('/show/{id}', [PostController::class, 'show'])->name('show');

    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');

    Route::delete('/{id}', [CommentController::class, 'destroy'])->name('comment-delete');

    Route::get('/{id}', [ListController::class, 'list'])->name('list');

    
});


Route::get('/email/sending/{id}', [NotificationController::class, 'store'])->name('send-notification');

require __DIR__.'/auth.php';
