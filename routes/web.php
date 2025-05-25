<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/land-bookings', function () {
    return view('land-bookings');
})->name('land.booking');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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
