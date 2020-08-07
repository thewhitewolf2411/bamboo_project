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

//Auth Route
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//User get Route
Route::get('/', 'PagesController@index')->name('index');
Route::get('/setpage/{parameter}', [
    'as'=>'setpage',
    'uses'=>'CustomerController@setPage'
]);

Route::get('/userprofile', 'CustomerController@showProfile');

Route::get('/products/{category}', 'CustomerController@customerCategoryView')->name('customerproducts');
Route::get('/product/{product}', 'CustomerController@showProduct')->name('showproduct');
Route::get('/cart', 'CustomerController@showCart')->name('showcart');

//shopping
Route::get('/shop', 'ShopController@showShopView');
Route::get('/shop/let','ShopController@showLetView');
Route::get('/shop/why', 'ShopController@showWhyView');

Route::get('/shop/category/{category}', 'ShopController@showShop');
Route::get('/shop/item/{id}', 'ShopController@showItem');
Route::get('/shop/allitems', 'ShopController@showAllItems');

Route::post('/shop/choosephone', 'ShopController@choosePhone');

//selling
Route::get('/sell', 'SellController@showSellView');
Route::get('/sell/why','SellController@showSellWhy');


//User post Route
Route::post('/addtocart/{id}', 'CustomerController@addProductToCart')->name('addproducttocart');
Route::post('/removefromcart', 'CustomerController@removeFromCart')->name('removefromcart');
Route::post('/checkoutcart', 'CustomerController@sheckoutcart')->name('sheckoutcart');


//Admin post route
Route::post('/addCategory', 'AdminController@addCategory')->middleware('auth');
Route::post('/addProduct', 'AdminController@addProduct')->middleware('auth');

//Portal get Route
Route::get('/portal', 'PagesController@portal')->name('portal')->middleware('auth');
Route::get('/portal/customer-care', 'PortalController@showCustomerCare')->name('customerCare')->middleware('auth');
Route::get('/portal/customer-care/trade-in', 'PortalController@showTradeIn')->name('tradeIn')->middleware('auth');
Route::get('/portal/customer-care/destroy-device', 'PortalController@showDestroyDevice')->name('destroyDevice')->middleware('auth');
Route::get('/portal/customer-care/trade-pack', 'PortalController@showTradePack')->name('tradePack')->middleware('auth');
Route::get('/portal/customer-care/seller', 'PortalController@showSeller')->name('seller')->middleware('auth');

Route::get('/portal/categories', 'PortalController@showCategories')->name('showCategories')->middleware('auth');
Route::get('/portal/categories/add', 'PortalController@showAddCategoryView')->middleware('auth');
Route::get('/portal/categories/edit/{id}', 'PortalController@ShowEditCategoryView')->middleware('auth');
Route::get('/portal/categories/delete/{id}', 'PortalController@deleteCategory')->middleware('auth');
Route::post('/portal/category/addcategory','PortalController@addCategory')->middleware('auth');

Route::get('/portal/brands/add', 'PortalController@showAddBrandsView')->middleware('auth');
Route::get('/portal/brands/edit/{id}', 'PortalController@ShowEditBrandsView')->middleware('auth');
Route::get('/portal/brands/delete/{id}', 'PortalController@deleteBrands')->middleware('auth');
Route::post('/portal/brands/addbrabnd','PortalController@addBrand')->middleware('auth');

Route::get('/portal/product', 'PortalController@showProductsPage')->middleware('auth');
Route::get('/portal/product/delete/{id}', 'PortalController@deleteProduct')->middleware('auth');
Route::get('/portal/product/edit/{id}', 'PortalController@showEditProductPage')->middleware('auth');
Route::get('/portal/product/add','PortalController@showAddProductView')->middleware('auth');
Route::post('/portal/product/addproduct','PortalController@addProduct')->middleware('auth');