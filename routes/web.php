<?php

use Illuminate\Support\Facades\Route;

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
Route::resource('products', '\App\Http\Controllers\ProductsController')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
