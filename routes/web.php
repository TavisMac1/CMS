<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

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
//secure routes with auth
Route::resource('items', '\App\Http\Controllers\ItemController')->middleware('auth');
Route::resource('categories', '\App\Http\Controllers\CategoryController')->middleware('auth');
Route::resource('allorders', '\App\Http\Controllers\AllOrdersController')->middleware('auth');
Route::resource('products', '\App\Http\Controllers\ProductsController');
Route::resource('details', '\App\Http\Controllers\DetailsController');

Route::resource('shopping', '\App\Http\Controllers\CartController');
Route::resource('order', '\App\Http\Controllers\OrderController');
//Route::post('/order', [CartController::class, 'check_order'])->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/thankyou', function () {
    return view('thankyou');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
