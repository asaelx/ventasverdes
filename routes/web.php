<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function(){

    // Auth
    Auth::routes();

    Route::group(['middleware' => 'auth'], function(){
        // Dashboard
        Route::get('/', 'DashboardController@index');

        // Pages
        Route::resource('pages', 'PageController');

        // Menus
        Route::resource('menus', 'MenuController');

        // Orders
        Route::resource('orders', 'OrderController');

        // Products
        Route::resource('products', 'ProductController');

        // Questions
        Route::resource('questions', 'QuestionController');
        Route::post('questions/answer/{question}', 'QuestionController@answer');

        // Reviews
        Route::resource('reviews', 'ReviewController');

        // Cart
        Route::resource('carts', 'CartController');

        // Categories
        Route::get('categories/search', 'CategoryController@search');
        Route::resource('categories', 'CategoryController');

        // Boxes
        Route::resource('boxes', 'BoxController');

        // Characteristics
        Route::resource('characteristics', 'CharacteristicController');

        // Addresses
        Route::resource('addresses', 'AddressController');

        // Sellers
        Route::resource('sellers', 'SellerController');

        // Settings
        Route::resource('settings', 'SettingController');
    });

});

// Home
Route::get('/', 'StoreController@index');

// Search
Route::get('busqueda', 'SearchController@search');

// Product
Route::get('producto/{product}', 'ProductController@displayProduct');

// Addresses
Route::get('addresses/getCountries', 'AddressController@getCountries');
Route::get('addresses/getStates/{country}', 'AddressController@getStates');
Route::get('addresses/getCities/{state}', 'AddressController@getCities');

// Cart
Route::get('carrito', 'StoreController@showCart');
Route::patch('carrito/{cart}', 'StoreController@updateCart');
Route::post('carrito/agregar', 'StoreController@storeCart');
Route::delete('carrito/{quantity}', 'StoreController@destroyItem');

// Payment Page
Route::get('pago', 'StoreController@showCheckout');
Route::post('pago/shipping', 'StoreController@continueToShipping');
Route::post('pago/pay', 'StoreController@placeOrder');
Route::get('gracias', 'StoreController@showThankyou');
