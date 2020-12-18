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
Route::get('/login', '\App\Http\Controllers\Auth\LoginController@login')->name('login');

//User get Route
Route::get('/', 'PagesController@index')->name('index');
Route::get('/setpage/{parameter}', [
    'as'=>'setpage',
    'uses'=>'CustomerController@setPage'
]);

//Footer pages
Route::get('/environment', 'PagesController@showEnvironmentPage');
Route::get('/charity', 'PagesController@showCharityPage');
Route::get('/privacy', 'PagesController@showPrivacyPage');
Route::get('/terms', 'PagesController@showTermsPage');
Route::get('/map', 'PagesController@showMapPage');
Route::get('/cookies', 'PagesController@showCookiesPage');
Route::get('/slavery', 'PagesController@showSlaveryPage');
Route::get('/corporate', 'PagesController@showCorporatePage');

//User profile
Route::get('/userprofile', 'CustomerController@showProfile');
Route::get('/userprofile/{id}', 'CustomerController@showOrderDetails');
Route::get('/userprofile/show/wishlist', 'CustomerController@showWishlist');
Route::get('/userprofile/deleteorder/{id}', 'CustomerController@deleteOrder');

Route::get('/products/{category}', 'CustomerController@customerCategoryView')->name('customerproducts');
Route::get('/product/{product}', 'CustomerController@showProduct')->name('showproduct');
Route::get('/cart', 'CustomerController@showCart')->name('showcart');

//shopping
Route::get('/shop', 'ShopController@showShopView');
Route::get('/shop/let','ShopController@showLetView');
Route::get('/shop/why', 'ShopController@showWhyView');

Route::get('/shop/category/{category}', 'ShopController@showShop');
Route::get('/shop/compare/', 'ShopController@showComparePage');
Route::get('/shop/item/{id}', 'ShopController@showItem');
Route::get('/shop/allitems', 'ShopController@showAllItems');

Route::post('/shop/choosephone', 'ShopController@choosePhone');


//selling
Route::get('/sell', 'SellController@showSellView');
Route::get('/sell/why','SellController@showSellWhy');
Route::get('/sell/shop/{parameter}', 'SellController@showSellShop');
Route::get('/sell/shop/item/{parameter}', 'SellController@showSellItem');

Route::post('/sell/shop/item/addtocart','SellController@addSellItemToCart');

Route::post('/cart/sell', 'SellController@sellItems');
Route::post('/cart/buy', 'SellController@buyItems');

Route::post('/cart/printtradein', 'SellController@generateTradeInHTML');

Route::post('/sell/searchproducts','SellController@searchAvalibleProducts');


//User post Route
Route::post('/addtocart', 'CustomerController@addProductToCart')->name('addproducttocart');
Route::get('/removefromcart/{parameter}', 'CustomerController@removeFromCart')->name('removefromcart');
Route::post('/checkoutcart', 'CustomerController@sheckoutcart')->name('sheckoutcart');

Route::post('/addtowishlist', 'CustomerController@addProductToWishList')->name('addproducttowishlist');
Route::post('/removefromwislist', 'CustomerController@removeFromWishList')->name('removeproductfromwishlist');

//user change profile details
Route::post('/userprofile/changename', 'CustomerController@changeName');

//Admin post route
Route::post('/addCategory', 'AdminController@addCategory')->middleware('auth');
Route::post('/addProduct', 'AdminController@addProduct')->middleware('auth');

//Portal get Route

Route::get('/portal', 'PortalController@portal')->name('portal')->middleware('auth');

//customer-care
Route::get('/portal/customer-care', 'PortalController@showCustomerCare')->name('customerCare')->middleware('auth');
Route::get('/portal/customer-care/trade-in/all/{search?}', 'PortalController@showTradeIn')->name('tradeIn')->middleware('auth');
Route::get('/portal/customer-care/trade-in/{id}', 'PortalController@showTradeInDetails')->name('tradeInDetails')->middleware('auth');
Route::get('/portal/customer-care/trade-in/{id}/details', 'PortalController@showMoreTradeInDetails')->name('tradeInDetails')->middleware('auth');
Route::post('/portal/customer-care/trade-in/printlabel', 'PortalController@PrintTradeInLabel')->name('tradeInLabel')->middleware('auth');
Route::post('/portal/customer-care/trade-in/printlabelbulk', 'PortalController@PrintTradeInLabelBulk')->name('tradeInLabel')->middleware('auth');

Route::get('/portal/customer-care/trade-out', 'PortalController@showTradeOut')->name('tradeOut')->middleware('auth');
Route::get('/portal/customer-care/trade-out/{id}', 'PortalController@showTradeOutDetails')->name('tradeOutDetails')->middleware('auth');
Route::post('/portal/customer-care/tradein/deletetradein', 'PortalController@deleteTradeInFromSystem')->middleware('auth');
Route::get('/deleteorder/{id}', 'PortalController@deleteTradeIn')->middleware('auth');
Route::get('/totesting/{id}', 'PortalController@returnToTesting')->middleware('auth');

Route::get('/portal/customer-care/destroy-device', 'PortalController@showDestroyDevice')->name('destroyDevice')->middleware('auth');
Route::get('/portal/customer-care/trade-pack/{search?}', 'PortalController@showTradePack')->name('tradePack')->middleware('auth');
Route::post('/portal/customer-care/trade-in/setassent', 'PortalController@setTradePackAsSent')->name('tradePack')->middleware('auth');
Route::get('/portal/customer-care/seller', 'PortalController@showSeller')->name('seller')->middleware('auth');
Route::get('/portal/customer-care/seller/{id}', 'PortalController@showSellerDetails')->middleware('auth');
Route::get('/portal/customer-care/seller/disable/{id}', 'PortalController@disableSellerAccount')->middleware('auth');
Route::get('/portal/customer-care/seller/enable/{id}', 'PortalController@enableSellerAccount')->middleware('auth');
Route::get('/portal/customer-care/createorder', 'PortalController@createOrder')->middleware('auth');
Route::get('/portal/customer-care/trade-pack/markforreprint/{id}', 'PortalController@markForReprint')->middleware('auth');
Route::get('/portal/customer-care/order-managment/{search?}', 'PortalController@showOrderManagment')->middleware('auth');

Route::get('/toreceive/{barcode}', 'PortalController@sendDeviceBackToReceive');
Route::get('/totest/{barcode}', 'PortalController@sendDeviceBackToTest');
Route::get('/cancel/{barcode}', 'PortalController@cancelOrder');

Route::get('/portal/ecommerence/order-management{search?}', 'PortalController@showEcommerenceOrderManagement');
Route::get('/portal/ecommerence/customer-accounts', 'PortalController@showEcommerenceCustomerAccounts');
Route::get('/portal/ecommerence/order-status{search?}', 'PortalController@showEcommerenceOrderStatus');
Route::get('/portal/ecommerence/create-order', 'PortalController@showEcommerenceCreateOrder');

Route::post('/portal/ecommerence/setAsSent', 'PortalController@setTradeoutAsSent');

//categories, brands
Route::get('/portal/categories', 'PortalController@showCategories')->name('showCategories')->middleware('auth');
Route::get('/portal/categories/add', 'PortalController@showAddCategoryView')->middleware('auth');
Route::get('/portal/categories/edit/{id}', 'PortalController@ShowEditCategoryView')->middleware('auth');
Route::post('/portal/category/editcategory', 'PortalController@editCategory')->middleware('auth');
Route::get('/portal/categories/delete/{id}', 'PortalController@deleteCategory')->middleware('auth');
Route::post('/portal/category/addcategory','PortalController@addCategory')->middleware('auth');

Route::get('/portal/brands/add', 'PortalController@showAddBrandsView')->middleware('auth');
Route::get('/portal/brands/delete/{id}', 'PortalController@deleteBrands')->middleware('auth');
Route::post('/portal/brands/addbrabnd','PortalController@addBrand')->middleware('auth');

//products
Route::get('/portal/product', 'PortalController@showProductsPage')->middleware('auth');
Route::get('/portal/product/selling-products', 'PortalController@showSellingProductsPage')->middleware('auth');
Route::get('/portal/product/removesellingproductoption/{id}', 'PortalController@showSellingProductOption')->middleware('auth');
Route::get('/portal/product/buying-products', 'PortalController@showBuyingProductsPage')->middleware('auth');

Route::get('/portal/product/addbuyingproduct', 'PortalController@showAddBuyingProductPage')->middleware('auth');
Route::post('/portal/product/addbuyingproduct/add', 'PortalController@addBuyingProduct')->middleware('auth');

Route::get('portal/product/addsellingproduct', 'PortalController@showAddSellingProductPage')->middleware('auth');
Route::post('/portal/product/addsellingproduct/add', 'PortalController@addSellingProduct')->middleware('auth');

Route::get('/portal/product/removebuyingproduct/{id}', 'PortalController@removeBuyingProduct')->middleware('auth');
Route::get('/portal/product/removesellingproduct/{id}', 'PortalController@removeSellingProduct')->middleware('auth');

Route::get('/portal/product/editsbuyingproduct/{id}', 'PortalController@showEditBuyingProductPage')->middleware('auth');
Route::get('/portal/product/editsellingproduct/{id}', 'PortalController@showEditSellingProductPage')->middleware('auth');
Route::post('/portal/product/editsellingproduct/edit', 'PortalController@saveEditedSellingProduct')->middleware('auth');
Route::post('/portal/product/editbuyingproduct/edit', 'PortalController@saveEditedBuyingProduct')->middleware('auth');

//quarantine
Route::get('/portal/quarantine', 'PortalController@showQuarantinePage')->middleware('auth');
Route::get('/portal/quarantine/awaiting-response', 'PortalController@showAwaitingResponse')->middleware('auth');
Route::get('/portal/quarantine/return', 'PortalController@showQuarantineReturn')->middleware('auth');
Route::get('/portal/quarantine/retest', 'PortalController@showQuarantineRetest')->middleware('auth');
Route::get('/portal/quarantine/stock', 'PortalController@showQuarantineStock')->middleware('auth');

Route::post('/portal/quarantine/markdevicetoreturn', 'PortalController@markDeviceToReturn')->middleware('auth');
Route::post('/portal/quarantine/markdevicetoretest', 'PortalController@markDeviceToRetest')->middleware('auth');

//testing
Route::get('/portal/testing', 'PortalController@showTestingPage')->middleware('auth');
Route::get('/portal/testing/receive', 'PortalController@showReceiveTradeIn')->middleware('auth');
Route::get('/portal/testing/find', 'PortalController@showFindTradeIn')->middleware('auth');

Route::get('/portal/testing/find/test', 'PortalController@find')->middleware('auth');
Route::get('/portal/testing/receiveorder', 'PortalController@receive')->middleware('auth');
Route::get('/portal/testing/receive/{id}','PortalController@testItem')->middleware('auth');
Route::get('/portal/testing/receive/quarantine/{id}', 'PortalController@showOlderOrderPage')->middleware('auth');
Route::post('/portal/testing/receive/senddevicetouarantine', 'PortalController@sendReceivingDeviceToQuarantine')->middleware('auth');
Route::get('/portal/testing/checkforimei/{id}', 'PortalController@showCheckForImeiPage')->middleware('auth');
Route::get('/portal/testing/checkimei/{id}', 'PortalController@showCheckImeiPage')->middleware('auth');
Route::get('/portal/testing/checkimeiresult/{id}', 'PortalController@showCheckImeiReultPage')->middleware('auth');
Route::get('/portal/testing/result/{id}','PortalController@showReceivingResultPage');

Route::post('/portal/testing/receive/checkdevicestatus', 'PortalController@checkDeviceStatus')->middleware('auth');
Route::post('/portal/testing/receive/settradeinstatus', 'PortalController@setTradeInStatus')->middleware('auth');
Route::post('/portal/testing/receive/devicemissing', 'PortalController@isDeviceMissing')->middleware('auth');
Route::post('/portal/testing/receive/devicecorrect', 'PortalController@isDeviceCorrect')->middleware('auth');
Route::post('/portal/testing/receive/deviceimeivisibility', 'PortalController@deviceImeiVisibility')->middleware('auth');
Route::post('/portal/testing/receive/checkimei', 'PortalController@checkimei')->middleware('auth');
Route::post('/portal/testing/receive/usercheckimei', 'PortalController@userCheckImei')->middleware('auth');
Route::post('/portal/testing/receive/printnewlabel', 'PortalController@printNewLabel')->middleware('auth');
Route::post('/portal/testing/receive/sendtotray', 'PortalController@sendtotray')->middleware('auth');
Route::post('/portal/receiving/printnewlabel' , 'PortalController@downloadSingleFile')->middleware('auth');

//payments
Route::get('/portal/payments', 'PortalController@showPaymentPage')->middleware('auth');
Route::get('/portal/payments/awaiting', 'PortalController@showPaymentAwaitingPage')->middleware('auth');
Route::get('/portal/payments/pending', 'PortalController@showPaymentPendingPage')->middleware('auth');
Route::get('/portal/payments/completed', 'PortalController@showPaymentCompletedPage')->middleware('auth');
Route::get('/portal/payments/reports', 'PortalController@showPaymentReportsPage')->middleware('auth');

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
Route::get('/portal/settings/product-options','PortalController@showSettingsProductOptionsPage')->middleware('auth');
Route::get('/portal/settings/product-options/selling-colours','PortalController@showSellingColourPage')->middleware('auth');
Route::get('/portal/settings/conditions/selling-networks','PortalController@showSellingNetworksPage')->middleware('auth');
Route::get('/portal/settings/testing-questions/selling-memory','PortalController@showSellingMemoryPage')->middleware('auth');
Route::get('/portal/settings/colours/add', 'PortalController@addColourPage')->middleware('auth');
Route::get('/portal/settings/networks/add', 'PortalController@addNetworkPage')->middleware('auth');
Route::get('/portal/settings/memories/add', 'PortalController@addMemoryPage')->middleware('auth');
Route::post('/portal/settings/productoptions/addcolour', 'PortalController@addColour')->middleware('auth');
Route::post('/portal/settings/productoptions/addnetwork', 'PortalController@addNetwork')->middleware('auth');
Route::post('/portal/settings/productoptions/addmemory', 'PortalController@addMemory')->middleware('auth');

Route::get('/portal/settings/conditions','PortalController@showSettingsConditionsPage')->middleware('auth');
Route::get('/portal/settings/conditions/add','PortalController@showSettingsAddConditionsPage')->middleware('auth');
Route::post('/portal/settings/conditions/addcondition','PortalController@addCondition')->middleware('auth');

Route::get('/portal/settings/testing-questions','PortalController@showSettingsTestingQuestionsPage')->middleware('auth');
Route::get('/portal/settings/testing-questions/{id}', 'PortalController@showCategoryQuestionsPage')->middleware('auth');
Route::get('/portal/settings/testing-questions/{id}/addquestion', 'PortalController@showCategoryAddQuestionPage')->middleware('auth');

Route::get('/portal/settings/websites','PortalController@showSettingsWebsitesPage')->middleware('auth');
Route::get('/portal/settings/websites/add','PortalController@showAddWebsitePage')->middleware('auth');
Route::post('/portal/settings/websites/addwebsite', 'PortalController@addWebsite')->middleware('auth');
Route::get('/portal/settings/websites/deletewebsite/{id}', 'PortalController@deleteWebsite')->middleware('auth');

Route::get('/portal/settings/stores','PortalController@showSettingsStoresPage')->middleware('auth');
Route::get('/portal/settings/stores/add', 'PortalController@showAddStorePage')->middleware('auth');
Route::post('/portal/settings/stores/addstore', 'PortalController@addStore')->middleware('auth');
Route::get('/portal/settings/stores/deletestore/{id}', 'PortalController@deleteStore')->middleware('auth');

Route::get('/portal/settings/payments-options','PortalController@showSettingsPaymentsOptionsPage')->middleware('auth');
Route::get('/portal/settings/delivery-options','PortalController@showSettingsDeliveryOptionsPage')->middleware('auth');
Route::get('/portal/settings/checkout-options','PortalController@showSettingsCheckoutOptionsPage')->middleware('auth');
Route::get('/portal/settings/promotional-codes','PortalController@showSettingsPromotionalCodesPage')->middleware('auth');
Route::get('/portal/settings/brands','PortalController@showSettingsBrandsPage')->middleware('auth');
Route::get('/portal/brands/edit/{id?}', 'PortalController@showAddBrandsView')->middleware('auth');
Route::post('portal/brands/editbrabnd', 'PortalController@editBrand')->middleware('auth');
Route::get('/portal/settings/barcode-id','PortalController@showSettingsBarcodeIdPage')->middleware('auth');

//cms
Route::get('/portal/cms', 'PortalController@showCmsPage')->middleware('auth');

//Trays
Route::get('/portal/trays', 'PortalController@showTraysPage')->middleware('auth');
Route::get('/portal/trays/create', 'PortalController@showAddTrayPage')->middleware('auth');
Route::post('/portal/trays/createtray', 'PortalController@addTray')->middleware('auth');

Route::get('/portal/trays/tray/', 'PortalController@showTrayPage')->middleware('auth');
Route::get('/portal/trays/tray/printlabel/{id}', 'PortalController@printTrayLabel')->middleware('auth');

Route::get('/portal/trays/delete/{id}', 'PortalController@deleteTray')->middleware('auth');

Route::post('/portal/trays/tray/addtotrolley', 'PortalController@addTrayToTrolley')->middleware('auth');

//Trolleys
Route::get('/portal/trolleys', 'PortalController@showTrolleysPage')->middleware('auth');
Route::get('/portal/trolleys/create', 'PortalController@showAddTrolleyPage')->middleware('auth');
Route::post('/portal/trolleys/createtrolley', 'PortalController@addTrolley')->middleware('auth');

Route::get('/portal/trolleys/trolley/', 'PortalController@showTrolleyPage')->middleware('auth');
Route::get('/portal/trolleys/trolley/printlabel/{id}', 'PortalController@printTrolleyLabel')->middleware('auth');

Route::get('/portal/trolleys/delete/{id}', 'PortalController@deleteTrolley')->middleware('auth');


//Boxes
Route::get('/portal/boxes', 'PortalController@showBoxesPage')->middleware('auth');
Route::get('/portal/boxes/create', 'PortalController@showAddBoxPage')->middleware('auth');
Route::get('/portal/boxes/box', 'PortalController@showBoxPage')->middleware('auth');
Route::post('/portal/boxes/createbox', 'PortalController@addBox')->middleware('auth');
Route::get('/portal/boxes/delete/{id}', 'PortalController@removeBox')->middleware('auth');

Route::get('/portal/boxes/addtobox/{boxname}', 'PortalController@showAddDeviceToBoxPage')->middleware('auth');