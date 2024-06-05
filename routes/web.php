<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\UserController;
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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{lang}', function ($lang) {
    app()->setLocale($lang);
    session()->put('locale', $lang);

    return redirect()->back()->with('success', "Your language updated to $lang");
})->name('lang');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

Route::resource('ideas', IdeaController::class)
    ->only(['store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'store.last.url']);
Route::resource('ideas', IdeaController::class)->only(['index', 'show']);
Route::resource('idea.comments', CommentController::class)
    ->only('store')
    ->middleware(['auth', 'store.last.url']);

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])
    ->middleware('auth')
    ->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])
    ->middleware('auth')
    ->name('ideas.unlike');

Route::resource('users', UserController::class)
    ->only(['show', 'edit', 'update'])
    ->middleware('auth');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])
    ->middleware('auth')
    ->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])
    ->middleware('auth')
    ->name('users.unfollow');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::get('/terms', function() {
   return view('terms');
})->name('terms');
