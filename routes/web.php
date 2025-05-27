<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::Post('/store',[ContactController::class,'store'])->name('contact.store');

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


Route::fallback(function () {
    return view('404');
});

