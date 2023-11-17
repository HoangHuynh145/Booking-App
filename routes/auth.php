<?php

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\WishlistsController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Client\ProfileController;
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

Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
    Route::get('/login', [AuthenticationController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login');
    Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register');
});

Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('logout', [AuthenticationController::class, 'destroy'])->name('logout');
    Route::resource('user', ProfileController::class);
    Route::get('orders', [ProfileController::class, 'userOrders'])->name('profile.orders');
    Route::resource('wishlist', WishlistsController::class);
});
