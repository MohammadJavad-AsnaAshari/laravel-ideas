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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['prefix' => '/ideas', 'as' => 'idea.'], function () {
    Route::get('/', [IdeaController::class, 'index'])->name('index');
    Route::get('/create', [IdeaController::class, 'create'])->name('create');
    Route::post('/', [IdeaController::class, 'store'])->name('store');
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth', 'store.last.url']], function () {
        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
        Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');

        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});
