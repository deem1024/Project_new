<?php

use Illuminate\Support\Facades\Route;
use App\Product;
use App\Category;
use App\Http\Controllers\Controller;

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

Route::get('/', function () {
    return view('welcome')
    ->with('product',Product::all())
    ->with('category',Category::all());
});

//route admin
Route::get('/admin/index','Admin\AdminController@index')->name('index');

//route category
Route::get('/admin/category/index','Admin\CategoryController@index')->name('category');
Route::post('/admin/category/create','Admin\CategoryController@create')->name('create');
Route::get('/admin/category/Edit/{id}','Admin\CategoryController@edit');
Route::post('/admin/category/Update/{id}','Admin\CategoryController@update');
Route::get('/admin/category/Delete/{id}','Admin\CategoryController@delete');

//route product
Route::get('/admin/product/index','Admin\ProductController@index')->name('product');
Route::post('/admin/product/create','Admin\ProductController@create')->name('product.c');
Route::get('/admin/product/edit/{id}','Admin\ProductController@edit');
Route::post('/admin/product/Update/{id}','Admin\ProductController@update');
Route::get('/admin/product/delete/{id}','Admin\ProductController@delete');

Auth::routes();

Route::get('/home','HomeController@index')->name('home');

