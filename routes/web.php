<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TestMongoController;
// use App\Http\Controllers\Store;
// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::group([
    'middleware'=> ['role:admin', 'auth'],
    'as'=>'admin.',
    'prefix'=>'admin',
    'namespace'=> App\Http\Controllers\Admin::class
], function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/stores', 'AdminController@stores')->name('stores');
    Route::get('/orders', 'AdminController@orders')->name('orders');
    Route::get('/customers', 'AdminController@customers')->name('customers');
    Route::get('/settings', 'AdminController@settings')->name('settings');
    Route::get('/statistics', 'AdminController@statistics')->name('statistics');
});

Route::group([
    // 'middleware'=> ['role:customer', 'auth'],
    // 'as'=>'customer.',
    // 'prefix'=>'customer',
    'namespace'=> App\Http\Controllers\Emporium::class
], function () {
    Route::get('/', 'EmporiumController@index')->name('home');
    // Route::get('/dashboard', 'CustomerController@dashboard')->name('dashboard');
    // Route::get('/orders', 'CustomerController@orders')->name('orders');
    // Route::get('/settings', 'CustomerController@settings')->name('settings');
    // Route::get('/statistics', 'CustomerController@statistics')->name('statistics');
});
Route::get('/test',  [TestMongoController::class, 'store']);
Route::get('/store/dashboard',  [TestMongoController::class, 'store']);
Route::group([
    // 'middleware'=> ['role:store', 'auth'],
    'middleware'=> ['role:store', 'auth'],
    'as'=>'store.',
    'prefix'=>'store',
    'namespace'=> App\Http\Controllers\Store::class
], function () {
    Route::get('/', 'StoreController@index')->name('index');
    Route::get('/dashboard', 'StoreController@dashboard')->name('dashboard');
    Route::get('/products', 'StoreController@products')->name('products');
    Route::get('/orders', 'StoreController@orders')->name('orders');
    Route::get('/customers', 'StoreController@customers')->name('customers');
    Route::get('/settings', 'StoreController@settings')->name('settings');
    Route::get('/statistics', 'StoreController@statistics')->name('statistics');
    Route::group([
        'as'=>'product.',
        'prefix'=>'product',
    ],function(){
        Route::post('/product/create', 'ProductController@create')->name('create');
        Route::get('/product/{product}', 'ProductController@show')->name('show');
    });
    // Route::get('/product/create', 'ProductController@create')->name('product.create');
    // Route::get('/product/{id}', 'ProductController@show')->name('product.show');

});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
