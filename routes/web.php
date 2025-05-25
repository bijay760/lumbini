<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/land-bookings', function () {
    return view('land-bookings');
})->name('land.booking');

Route::get('/share-application', function () {
    return view('share-application');
})->name('share.application');

Route::get('/right-share', function () {
    return view('right-share');
})->name('right.share');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');

Route::get('/notice', function () {
    return view('notice');
})->name('notice');

Route::post('/holder/searchToken', function () {
    // Handle search token logic
})->name('holder.searchToken');
