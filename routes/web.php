<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
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

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => '/ideas'], function () {
    Route::get('/', [IdeaController::class, 'index'])->name('idea.index');
    Route::get('/create', [IdeaController::class, 'create'])->name('idea.create');
    Route::post('/', [IdeaController::class, 'store'])->name('idea.store');
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('idea.show');
    Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit')
        ->middleware('auth');
    Route::put('/{idea}', [IdeaController::class, 'update'])->name('idea.update')
        ->middleware('auth');
    Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy')
        ->middleware('auth');

    Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('idea.comments.store')
        ->middleware('auth');
});
