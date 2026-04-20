<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/games/{game}', [HomeController::class, 'show'])->name('games.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::get('/register', fn () => view('auth.register'))->name('register');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/games/{game}/buy', [App\Http\Controllers\CheckoutController::class, 'buy'])->name('games.buy');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

    Route::middleware('role:company')->prefix('company')->name('company.')->group(function () {
        Route::get('/dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
        Route::get('/games/create', [GameController::class, 'create'])->name('games.create');

        Route::post('/games', [GameController::class, 'store'])->name('games.store');

        Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
    });

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/games/validate', [AdminController::class, 'create'])->name('games.validate');

        Route::post('/games/{game}/approve', [AdminController::class, 'approve'])->name('games.approve');
        Route::post('/games/{game}/reject', [AdminController::class, 'reject'])->name('games.reject');

        Route::patch('/admin/games/{game}/approve', [App\Http\Controllers\AdminController::class, 'approve'])->name('admin.games.approve');
        Route::patch('/admin/games/{game}/reject', [App\Http\Controllers\AdminController::class, 'reject'])->name('admin.games.reject');

    });
    Route::get('/admin/queue', [AdminController::class, 'queue'])->name('admin.queue');

    Route::get('/company/games/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.games.create');
    Route::post('/company/games', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.games.store');
});
