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
Route::get('/userprofile/wishlist', 'CustomerController@showWishlist');

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
Route::post('/addtocart', 'CustomerController@addProductToCart')->name('addproducttocart');
Route::post('/removefromcart', 'CustomerController@removeFromCart')->name('removefromcart');
Route::post('/checkoutcart', 'CustomerController@sheckoutcart')->name('sheckoutcart');

Route::post('/addtowishlist', 'CustomerController@addProductToWishList')->name('addproducttowishlist');
Route::post('/removefromwislist', 'CustomerController@removeFromWishList')->name('removeproductfromwishlist');

//Admin post route
Route::post('/addCategory', 'AdminController@addCategory')->middleware('auth');
Route::post('/addProduct', 'AdminController@addProduct')->middleware('auth');

//Portal get Route

Route::get('/portal', 'PortalController@portal')->name('portal')->middleware('auth');

//customer-care
Route::get('/portal/customer-care', 'PortalController@showCustomerCare')->name('customerCare')->middleware('auth');
Route::get('/portal/customer-care/trade-in', 'PortalController@showTradeIn')->name('tradeIn')->middleware('auth');
Route::get('/portal/customer-care/destroy-device', 'PortalController@showDestroyDevice')->name('destroyDevice')->middleware('auth');
Route::get('/portal/customer-care/trade-pack', 'PortalController@showTradePack')->name('tradePack')->middleware('auth');
Route::get('/portal/customer-care/seller', 'PortalController@showSeller')->name('seller')->middleware('auth');
//categories, brands
Route::get('/portal/categories', 'PortalController@showCategories')->name('showCategories')->middleware('auth');
Route::get('/portal/categories/add', 'PortalController@showAddCategoryView')->middleware('auth');
Route::get('/portal/categories/edit/{id}', 'PortalController@ShowEditCategoryView')->middleware('auth');
Route::get('/portal/categories/delete/{id}', 'PortalController@deleteCategory')->middleware('auth');
Route::post('/portal/category/addcategory','PortalController@addCategory')->middleware('auth');

Route::get('/portal/brands/add', 'PortalController@showAddBrandsView')->middleware('auth');
Route::get('/portal/brands/edit/{id}', 'PortalController@ShowEditBrandsView')->middleware('auth');
Route::get('/portal/brands/delete/{id}', 'PortalController@deleteBrands')->middleware('auth');
Route::post('/portal/brands/addbrabnd','PortalController@addBrand')->middleware('auth');

//products
Route::get('/portal/product', 'PortalController@showProductsPage')->middleware('auth');
Route::get('/portal/product/delete/{id}', 'PortalController@deleteProduct')->middleware('auth');
Route::get('/portal/product/edit/{id}', 'PortalController@showEditProductPage')->middleware('auth');
Route::get('/portal/product/add','PortalController@showAddProductView')->middleware('auth');
Route::post('/portal/product/addproduct','PortalController@addProduct')->middleware('auth');

//quarantine
Route::get('/portal/quarantine', 'PortalController@showQuarantinePage')->middleware('auth');
Route::get('/portal/quarantine/awaiting-response', 'PortalController@showAwaitingResponse')->middleware('auth');
Route::get('/portal/quarantine/return', 'PortalController@showQuarantineReturn')->middleware('auth');
Route::get('/portal/quarantine/retest', 'PortalController@showQuarantineRetest')->middleware('auth');
Route::get('/portal/quarantine/stock', 'PortalController@showQuarantineStock')->middleware('auth');
Route::get('/portal/quarantine/manual', 'PortalController@showQuarantineManual')->middleware('auth');

//testing
Route::get('/portal/testing', 'PortalController@showTestingPage')->middleware('auth');
Route::get('/portal/testing/receive', 'PortalController@showReceiveTradeIn')->middleware('auth');
Route::get('/portal/testing/find', 'PortalController@showFindTradeIn')->middleware('auth');

Route::post('/portal/testing/find/find', 'PortalController@find')->middleware('auth');
Route::post('/portal/testing/receive/receive', 'PortalController@receive')->middleware('auth');

//payments
Route::get('/portal/payments', 'PortalController@showPaymentPage')->middleware('auth');

//reports
Route::get('/portal/reports', 'PortalController@showReportsPage')->middleware('auth');

//feeds
Route::get('/portal/feeds', 'PortalController@showFeedsPage')->middleware('auth');
Route::get('/portal/feeds/export-import', 'PortalController@showExportImportPage')->middleware('auth');
Route::get('/portal/feeds/summary', 'PortalController@showFeedsSummaryPage')->middleware('auth');
Route::get('/portal/feeds/external', 'PortalController@showFeedsExternalPage')->middleware('auth');

Route::post('/portal/feeds/export-import/export', 'PortalController@feedsExport');
Route::post('/portal/feeds/export-import/import', 'PortalController@feedsImport');

//users
Route::get('/portal/user', 'PortalController@showUsersPage')->middleware('auth');
Route::get('/portal/user/add', 'PortalController@showAddUserPage')->middleware('auth');
Route::get('/portal/user/edit/{id}', 'PortalController@editUser')->middleware('auth');
Route::get('/portal/user/delete/{id}', 'PortalController@deleteUser')->middleware('auth');

Route::post('/portal/user/adduser', 'PortalController@addUser')->middleware('auth');
Route::post('/portal/user/search', 'PortalController@searchUser')->middleware('auth');

//settings
Route::get('/portal/settings','PortalController@showSettingsPage')->middleware('auth');

//cms
Route::get('/portal/cms', 'PortalController@showCmsPage')->middleware('auth');