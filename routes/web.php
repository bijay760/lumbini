<?php

use App\Http\Controllers\Admin\Plots\PlotsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\LandParcel\LandParcelController;
use App\Http\Controllers\Admin\Properties\PropertiesController;
use App\Http\Controllers\Admin\Login\AdminLoginController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;

// SEO-Friendly Public Routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about-us');
Route::get('/our-projects', [PageController::class, 'projects'])->name('projects');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');
Route::get('/land-register', [PageController::class, 'landRegister'])->name('land-register');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');

// Additional SEO-friendly routes
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/properties-for-sale', [PageController::class, 'propertiesForSale'])->name('properties-for-sale');
Route::get('/properties-for-rent', [PageController::class, 'propertiesForRent'])->name('properties-for-rent');
Route::get('/investment-opportunities', [PageController::class, 'investments'])->name('investments');

// Property Registration Routes
Route::post('/buy-sale', [PropertyController::class, 'store'])->name('properties.store');
Route::Post('/store', [ContactController::class, 'store'])->name('contact.store');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

// SEO Routes
Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('robots.txt', function () {
    return response()->view('seo.robots')->header('Content-Type', 'text/plain');
})->name('robots');
Route::get('manifest.json', function () {
    return response()->file(public_path('manifest.json'));
})->name('manifest');




// admin routes

Route::middleware('check.whitelist')->group(function () {
    Route::get('/admin', [AdminLoginController::class, 'index'])->name('admin.login_form');
    Route::POST('/admin-login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::prefix('admin')->middleware('admin.auth')->group(function () {
        // Dashboard Related Routes
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Buy-sale Related Routes
        Route::get('buy-sale', [PropertiesController::class, 'index'])->name('admin.buy-sale');
        Route::get('buy-sale/create', [PropertiesController::class, 'create'])->name('admin.buy-sale.create');
        Route::POST('buy-sale/store', [PropertiesController::class, 'store'])->name('admin.buy-sale.store');
        Route::DELETE('buy-sale/delete/{id}', [PropertiesController::class, 'delete'])->name('admin.buy-sale.delete');
        Route::get('buy-sale/edit/{id}', [PropertiesController::class, 'edit'])->name('admin.buy-sale.edit');
        Route::post('buy-sale/update/{id}', [PropertiesController::class, 'update'])->name('admin.buy-sale.update');

        //Property related Routes
        Route::get('properties', [LandParcelController::class, 'index'])->name('admin.properties');
        Route::get('properties/view/{id}', [LandParcelController::class, 'view'])->name('admin.properties.view');
        Route::get('properties/plotting/{id}', [LandParcelController::class, 'plotting'])->name('admin.properties.plotting');
        Route::post('properties/plotting/store/{id}', [LandParcelController::class, 'plottingStore'])->name('admin.properties.plotting.store');
        Route::get('properties/create', [LandParcelController::class, 'create'])->name('admin.properties.create');
        Route::Post('properties/store', [LandParcelController::class, 'store'])->name('admin.properties.store');
        Route::DELETE('properties/delete/{id}', [LandParcelController::class, 'delete'])->name('admin.properties.delete');
        Route::DELETE('properties/sub/delete/{id}', [LandParcelController::class, 'sub_delete'])->name('admin.properties.sub.delete');
        Route::DELETE('properties/delete-document/{id}', [LandParcelController::class, 'deleteDocument'])->name('admin.properties.deleteDocument');
        Route::get('properties/edit/{id}', [LandParcelController::class, 'edit'])->name('admin.properties.edit');
        Route::get('properties/sub/edit/{id}', [LandParcelController::class, 'sub_edit'])->name('admin.properties.sub.edit');
        Route::post('properties/update/{id}', [LandParcelController::class, 'update'])->name('admin.properties.update');
        Route::post('properties/sub/update/{id}', [LandParcelController::class, 'sub_update'])->name('admin.properties.sub.update');
        Route::get('properties/merge', [LandParcelController::class, 'merge'])->name('admin.properties.merge');
        Route::POST('properties/mergeStore', [LandParcelController::class, 'mergeStore'])->name('admin.properties.mergeStore');
        Route::get('properties/child-properties/{id}', [LandParcelController::class, 'child_properties'])->name('admin.properties.child_properties');


        // Plots relalated routes
        Route::get('plots', [PlotsController::class, 'index'])->name('admin.plots');
        Route::get('plots/create', [PlotsController::class, 'create'])->name('admin.plots.create');
        Route::post('plots/store', [PlotsController::class, 'store'])->name('admin.plots.store');
        Route::post('plots/update/{id}', [PlotsController::class, 'update'])->name('admin.plots.update');
        Route::get('plots/edit/{id}', [PlotsController::class, 'edit'])->name('admin.plots.edit');
        Route::delete('plots/delete/{id}', [PlotsController::class, 'destroy'])->name('admin.plots.destroy');
        Route::get('plots/view/{id}', [PlotsController::class, 'viewSale'])->name('admin.plots.view');
        Route::get('plots/sell/{id}', [PlotsController::class, 'sell'])->name('admin.plots.sell');
        Route::post('plots/sell/store/{id}', [PlotsController::class, 'sellStore'])->name('admin.plots.sell.store');
        Route::get('plots/payment/{id}', [PlotsController::class, 'payment'])->name('admin.plots.payment');
        Route::post('plots/payment/store/{id}', [PlotsController::class, 'paymentStore'])->name('admin.plots.payment.store');
    });
});


Route::fallback(function () {
    return view('404');
});
