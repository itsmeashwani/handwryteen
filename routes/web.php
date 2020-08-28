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

// Route::get('/', function () {
//     $shop = Auth::user();
//     $shopApi = $shop->api()->rest('GET', '/admin/shop.json');
//     // dd($shop);
//     return view('welcome', compact('shopApi'));
// })->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home1');


Route::middleware(['auth.shopify'])->group(function () {

    Route::get('/', function () {
        $shop = Auth::user();
        $shopApi = $shop->api()->rest('GET', '/admin/shop.json');
        // dd($shop);
        return view('welcome', compact('shopApi'));
    })->name('home');
    
    Route::view('customers', 'customers');
    Route::view('products', 'products');
    Route::view('settings', 'settings');
    Route::resource('triggers', 'ShopifyTriggerController');
});
