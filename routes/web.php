<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('ideas', IdeaController::class)
    ->only(['store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'store.last.url']);
Route::resource('ideas', IdeaController::class)->only(['index', 'show']);
Route::resource('idea.comments', CommentController::class)
    ->only('store')
    ->middleware(['auth', 'store.last.url']);

Route::resource('users', UserController::class)
    ->only(['show', 'edit', 'update'])
    ->middleware('auth');
