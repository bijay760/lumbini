<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::Post('/store',[ContactController::class,'store'])->name('contact.store');

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/our-projects', function () {
    return view('projects');
})->name('projects');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/Booking', function () {
    return view('Booking');
})->name('Booking');
Route::get('/land-register', function () {
    return view('land-register');
})->name('land-register');
Route::get('/blog', function () {
    return view('blog');
})->name('blog');


Route::fallback(function () {
    return view('404');
});

