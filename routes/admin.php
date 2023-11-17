<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Admin\DashboardController;

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'management', 'middleware' => ['checkUserRole']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('blocks', BlocksController::class);
    Route::resource('hotels', HotelsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('typeRooms', TypeRoomController::class);
    Route::resource('paymentInformation', PaymentInformationController::class);
});
