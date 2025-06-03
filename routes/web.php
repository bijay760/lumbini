<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Admin\Login\AdminLoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;

// Property Registration Routes
//Route::get('/property/register', [PropertyController::class, 'create'])->name('property.register');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::Post('/store',[ContactController::class,'store'])->name('contact.store');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
Route::get('sitemap.xml', [SitemapController::class, 'index']);

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




// admin routes

Route::middleware('check.whitelist')->group(function () {
    Route::get('/admin', [AdminLoginController::class, 'index'])->name('admin.login_form');
    Route::POST('/admin-login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::middleware('admin.auth')->group(function() {
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
});


Route::fallback(function () {
    return view('404');
});

