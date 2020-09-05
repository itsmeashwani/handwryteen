<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home1');


Route::middleware(['auth.shopify'])->group(function () {

    Route::get('/', 'ShopifyTriggerController@index')->name('home');
    Route::post('/triggers', 'ShopifyTriggerController@store')->name('triggers.store');
    Route::delete('/triggers/{id}', 'ShopifyTriggerController@destroy')->name('triggers.destroy');
    Route::put('/triggers/{id}', 'ShopifyTriggerController@update')->name('triggers.update');

    Route::post('handwrytten/login', 'HandwryttenApiController@login')->name('handwrytten.login');
    Route::post('handwrytten/logout/{id}', 'HandwryttenApiController@logout')->name('handwrytten.logout');

    Route::get('/configuration', 'HandwryttenApiController@config');

    // Route::post('ajaxRequest', 'HandwryttenApiController@cardData');
    Route::post('ajaxRequest', 'HandwryttenApiController@cardData')->name('ajaxRequest.post');

    // Route::get('/', function () {
    //     $shop = Auth::user();
    //     $shopApi = $shop->api()->rest('GET', '/admin/shop.json');
    //     // dd($shop);
    //     return view('welcome', compact('shopApi'));
    // })->name('home');
    
    // Route::view('customers', 'customers');
    // Route::view('products', 'products');
    // Route::view('settings', 'settings');
    // Route::resource('triggers', 'ShopifyTriggerController');
});
