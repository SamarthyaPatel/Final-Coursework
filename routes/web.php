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

    Route::get('/user-profile/create', [ProfileController::class, 'createProfile'])->name('createProfile');
    
    Route::get('/user-profile/{id}', [ProfileController::class, 'displayProfile'])->name('getProfile');
    
    Route::post('/user-profile', [ProfileController::class, 'storeProfile'])->name('storeProfile');

    Route::get('/user-profile/edit/{id}', [ProfileController::class, 'editProfile'])->name('editProfile');

    Route::post('/user-profile/{id}', [ProfileController::class, 'updateProfile'])->name('profile_update');

    Route::post('/', [PostController::class, 'store'])->name('store');

    Route::get('/board', [PostController::class, 'getBoard'])->name('board');

    Route::get('/board/tag/{id}', [PostController::class, 'getTag'])->name('tag');

    Route::post('/{id}', [CommentController::class, 'store'])->name('comment');

    Route::post('/{id}', [CommentController::class, 'edit'])->name('update-comment');

    Route::get('/show/{id}', [PostController::class, 'show'])->name('show');

    Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');

    Route::post('/update/{id}', [PostController::class, 'update'])->name('post_update');

    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
    
});


Route::get('/email/sending/{id}', [NotificationController::class, 'store'])->name('send-notification');

require __DIR__.'/auth.php';
