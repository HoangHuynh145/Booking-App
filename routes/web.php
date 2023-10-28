<?php

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

Route::get('/hotel-listing', function () {
    return view('hotel-listing');
});

Route::get('/booking/{id}', function () {
    return view('booking');
});

Route::get('/place/{id}', function () {
    return view('hotel-detail');
});

require __DIR__.'/auth.php';