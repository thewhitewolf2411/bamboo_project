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

Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
//user

Route::get('/', 'PagesController@index')->name('index');
Route::get('/setpage/{parameter}', [
    'as'=>'setpage',
    'uses'=>'CustomerController@setPage'
]);


Route::get('/products/{category}', 'CustomerController@customerCategoryView')->name('customerproducts');



//admin
Route::get('/admin', 'PagesController@admin')->name('admin');
Route::get('/admin/sales', 'AdminController@sales')->name('adminsales');
Route::get('/admin/customers', 'AdminController@customers')->name('admincustomers');
Route::get('/admin/products', 'AdminController@products')->name('adminsproducts');
Route::get('/admin/category/{category}', 'AdminController@showCategory');
Route::get('/admin/search', 'AdminController@search')->name('adminsearch');
Route::get('/admin/reports', 'AdminController@reports')->name('adminreports');
Route::get('/admin/options', 'AdminController@options')->name('adminsoptions');

//admin post route
Route::post('/addCategory', 'AdminController@addCategory');
Route::post('/addProduct', 'AdminController@addProduct');

Route::get('/admin/addcategory', 'AdminController@addCategoryPage')->name('addCategoryPage');
Route::get('/admin/products/addproduct/{id}', 'AdminController@addProductPage')->name('addProductPage');

//portal
Route::get('/portal', 'PagesController@portal')->name('portal');
