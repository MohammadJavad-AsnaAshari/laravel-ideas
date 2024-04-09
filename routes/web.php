<?php

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

Route::group(['prefix' => '/ideas'], function () {
    Route::get('/', [IdeaController::class, 'index'])->name('idea.index');
    Route::get('/create', [IdeaController::class, 'create'])->name('idea.create');
    Route::post('/', [IdeaController::class, 'store'])->name('idea.store');
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('idea.show');
    Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit');
    Route::put('/{idea}', [IdeaController::class, 'update'])->name('idea.update');
    Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy');
});
