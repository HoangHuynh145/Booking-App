<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HotelsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Client\BookingController;
use App\Http\Controllers\Client\DetailHotelController;
use App\Http\Controllers\Client\ListBlocksController;
use App\Http\Controllers\Client\TopPageController;
use App\Http\Controllers\Client\ListHotelController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TopPageController::class, 'index'])->name('home-page');

Route::get('/hotel-listing', [ListHotelController::class, 'index'])->name('listHotel');
Route::get('/place/{id}', [DetailHotelController::class, 'index'])->name('hotelsDetail');
Route::post('/place/{id}/rating', [DetailHotelController::class, 'updateRating'])->name('rating');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/listBlocks', [ListBlocksController::class, 'index'])->name('listBlocks');



Route::group(['prefix' => 'management'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';