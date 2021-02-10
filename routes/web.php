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
Route::get('/', 'Customer\PagesController@index')->name('index');
Route::get('/setpage/{parameter}', [
    'as'=>'setpage',
    'uses'=>'Customer\CustomerController@setPage'
]);

//Route::get('/password/reset', 'PagesController@showPaswordResetPage')->name('password.request');

//Footer pages
Route::get('/environment', 'Customer\PagesController@showEnvironmentPage');
Route::get('/charity', 'Customer\PagesController@showCharityPage');
Route::get('/privacy', 'Customer\PagesController@showPrivacyPage');
Route::get('/terms', 'Customer\PagesController@showTermsPage');
Route::get('/map', 'Customer\PagesController@showMapPage');
Route::get('/cookies', 'Customer\PagesController@showCookiesPage');
Route::get('/slavery', 'Customer\PagesController@showSlaveryPage');
Route::get('/corporate', 'Customer\PagesController@showCorporatePage');

//User profile
Route::get('/userprofile', 'Customer\CustomerController@showProfile');
Route::get('/userprofile/{id}', 'Customer\CustomerController@showOrderDetails');
Route::get('/userprofile/show/wishlist', 'Customer\CustomerController@showWishlist');
Route::get('/userprofile/deleteorder/{id}', 'Customer\CustomerController@deleteOrder');

Route::get('/products/{category}', 'Customer\CustomerController@customerCategoryView')->name('customerproducts');
Route::get('/product/{product}', 'Customer\CustomerController@showProduct')->name('showproduct');
Route::get('/cart', 'Customer\CustomerController@showCart')->name('showcart');

//shopping
Route::get('/shop', 'Customer\ShopController@showShopView');
Route::get('/shop/let','Customer\ShopController@showLetView');
Route::get('/shop/why', 'Customer\ShopController@showWhyView');

Route::get('/shop/category/{category}', 'Customer\ShopController@showShop');
Route::get('/shop/compare/', 'Customer\ShopController@showComparePage');
Route::get('/shop/item/{id}', 'Customer\ShopController@showItem');
Route::get('/shop/allitems', 'Customer\ShopController@showAllItems');

Route::post('/shop/choosephone', 'Customer\ShopController@choosePhone');

Route::post('/getproductdata', 'Customer\ShopController@getProductData');

//selling
Route::get('/sell', 'Customer\SellController@showSellView');
Route::get('/sell/why','Customer\SellController@showSellWhy');
Route::get('/sell/shop/{parameter}', 'Customer\SellController@showSellShop');
Route::get('/sell/shop/item/{parameter}', 'Customer\SellController@showSellItem');

Route::post('/sell/shop/item/addtocart','Customer\SellController@addSellItemToCart');

Route::post('/cart/sell', 'Customer\SellController@sellItems');
Route::post('/cart/buy', 'Customer\SellController@buyItems');

Route::post('/cart/printtradein', 'Customer\SellController@generateTradeInHTML');

Route::post('/sell/searchproducts','Customer\SellController@searchAvalibleProducts');


//User post Route
Route::post('/addtocart', 'Customer\CustomerController@addProductToCart')->name('addproducttocart');
Route::get('/removefromcart/{parameter}', 'Customer\CustomerController@removeFromCart')->name('removefromcart');
Route::post('/checkoutcart', 'Customer\CustomerController@sheckoutcart')->name('sheckoutcart');

Route::post('/addtowishlist', 'Customer\CustomerController@addProductToWishList')->name('addproducttowishlist');
Route::post('/removefromwislist', 'Customer\CustomerController@removeFromWishList')->name('removeproductfromwishlist');

//user change profile details
Route::post('/userprofile/changename', 'Customer\CustomerController@changeName');
Route::post('/userprofile/accountdetails', 'Customer\CustomerController@changeAccountDetails')->middleware('auth');

//Portal get Route

Route::get('/portal', 'Portal\PortalController@portal')->name('portal');
Route::get('/portal/seeddatapage', 'Portal\PortalController@seedDataPage')->name('seedDataPage');
Route::post('/portal/seeddata', 'Portal\PortalController@seedData')->name('seedData');

//customer-care
Route::get('/portal/customer-care', 'Portal\CustomerCareController@showCustomerCare')->name('customerCare')->middleware('auth');
Route::get('/portal/customer-care/trade-in/all/{search?}', 'Portal\CustomerCareController@showTradeIn')->name('tradeIn')->middleware('auth');
Route::get('/portal/customer-care/trade-in/{id}', 'Portal\CustomerCareController@showTradeInDetails')->name('tradeInDetails')->middleware('auth');
Route::get('/portal/customer-care/trade-in/{id}/details', 'Portal\CustomerCareController@showMoreTradeInDetails')->name('tradeInDetails')->middleware('auth');
Route::post('/portal/customer-care/trade-in/printlabel', 'Portal\CustomerCareController@PrintTradeInLabel')->name('tradeInLabel')->middleware('auth');
Route::post('/portal/customer-care/trade-in/printlabelbulk', 'Portal\CustomerCareController@PrintTradeInLabelBulk')->name('tradeInLabel')->middleware('auth');

// audit notes
Route::post('/portal/customer-care/trade-in/addauditnote', 'Portal\CustomerCareController@addAuditNote')->name('addAuditNote')->middleware('auth');
Route::post('/portal/customer-care/trade-in/updateauditnote', 'Portal\CustomerCareController@updateAuditNote')->name('updateAuditNote')->middleware('auth');
Route::post('/portal/customer-care/trade-in/deleteauditnote', 'Portal\CustomerCareController@deleteAuditNote')->name('deleteAuditNote')->middleware('auth');


Route::get('/portal/customer-care/trade-out', 'Portal\CustomerCareController@showTradeOut')->name('tradeOut')->middleware('auth');
Route::get('/portal/customer-care/trade-out/{id}', 'Portal\CustomerCareController@showTradeOutDetails')->name('tradeOutDetails')->middleware('auth');
Route::post('/portal/customer-care/tradein/deletetradein', 'Portal\CustomerCareController@deleteTradeInFromSystem')->middleware('auth');
Route::get('/deleteorder/{id}', 'Portal\CustomerCareController@deleteTradeIn')->middleware('auth');
Route::get('/totesting/{id}', 'Portal\CustomerCareController@returnToTesting')->middleware('auth');

Route::get('/portal/customer-care/destroy-device', 'Portal\CustomerCareController@showDestroyDevice')->name('destroyDevice')->middleware('auth');
Route::get('/portal/customer-care/trade-pack/{search?}', 'Portal\CustomerCareController@showTradePack')->name('tradePack')->middleware('auth');
Route::post('/portal/customer-care/trade-in/setassent', 'Portal\CustomerCareController@setTradePackAsSent')->name('tradePack')->middleware('auth');
Route::get('/portal/customer-care/seller', 'Portal\CustomerCareController@showSeller')->name('seller')->middleware('auth');
Route::get('/portal/customer-care/seller/{id}', 'Portal\CustomerCareController@showSellerDetails')->middleware('auth');
Route::get('/portal/customer-care/seller/disable/{id}', 'Portal\CustomerCareController@disableSellerAccount')->middleware('auth');
Route::get('/portal/customer-care/seller/enable/{id}', 'Portal\CustomerCareController@enableSellerAccount')->middleware('auth');
Route::get('/portal/customer-care/seller/delete/{id}', 'Portal\CustomerCareController@deleteUserAccount')->middleware('auth');
Route::get('/portal/customer-care/createorder', 'Portal\CustomerCareController@createOrder')->middleware('auth');
Route::get('/portal/customer-care/trade-pack/markforreprint/{id}', 'Portal\CustomerCareController@markForReprint')->middleware('auth');
Route::get('/portal/customer-care/order-managment/{search?}', 'Portal\CustomerCareController@showOrderManagment')->middleware('auth');
Route::post('/portal/customer-care/printdevicelabel', 'Portal\CustomerCareController@printDeviceLabel')->middleware('auth');
Route::post('/portal/customer-care/sendtodespatch', 'Portal\CustomerCareController@sendToDespatch')->name('sendToDespatch')->middleware('auth');

Route::get('/toreceive/{barcode}', 'Portal\CustomerCareController@sendDeviceBackToReceive');
Route::get('/totest/{barcode}', 'Portal\CustomerCareController@sendDeviceBackToTest');
Route::get('/cancel/{barcode}', 'Portal\CustomerCareController@cancelOrder');

Route::get('/portal/ecommerence/order-management{search?}', 'Portal\EcommerenceController@showEcommerenceOrderManagement');
Route::get('/portal/ecommerence/customer-accounts', 'Portal\EcommerenceController@showEcommerenceCustomerAccounts');
Route::get('/portal/ecommerence/order-status{search?}', 'Portal\EcommerenceController@showEcommerenceOrderStatus');
Route::get('/portal/ecommerence/create-order', 'Portal\EcommerenceController@showEcommerenceCreateOrder');

Route::post('/portal/ecommerence/setAsSent', 'Portal\CustomerCareController@setTradeoutAsSent');

//categories, brands
Route::get('/portal/categories', 'Portal\ProductController@showCategories')->name('showCategories')->middleware('auth');
Route::get('/portal/categories/add', 'Portal\ProductController@showAddCategoryView')->middleware('auth');
Route::get('/portal/categories/edit/{id}', 'Portal\ProductController@ShowEditCategoryView')->middleware('auth');
Route::post('/portal/category/editcategory', 'Portal\ProductController@editCategory')->middleware('auth');
Route::get('/portal/categories/delete/{id}', 'Portal\ProductController@deleteCategory')->middleware('auth');
Route::post('/portal/category/addcategory','Portal\ProductController@addCategory')->middleware('auth');

Route::get('/portal/brands/add', 'Portal\ProductController@showAddBrandsView')->middleware('auth');
Route::get('/portal/brands/delete/{id}', 'Portal\ProductController@deleteBrands')->middleware('auth');
Route::post('/portal/brands/addbrabnd','Portal\ProductController@addBrand')->middleware('auth');

//products
Route::get('/portal/product', 'Portal\ProductController@showProductsPage')->middleware('auth');
Route::get('/portal/product/selling-products', 'Portal\ProductController@showSellingProductsPage')->middleware('auth');
Route::get('/portal/product/removesellingproductoption/{id}', 'Portal\ProductController@showSellingProductOption')->middleware('auth');
Route::get('/portal/product/buying-products', 'Portal\ProductController@showBuyingProductsPage')->middleware('auth');

Route::get('/portal/product/addbuyingproduct', 'Portal\ProductController@showAddBuyingProductPage')->middleware('auth');
Route::post('/portal/product/addbuyingproduct/add', 'Portal\ProductController@addBuyingProduct')->middleware('auth');

Route::get('portal/product/addsellingproduct', 'Portal\ProductController@showAddSellingProductPage')->middleware('auth');
Route::post('/portal/product/addsellingproduct/add', 'Portal\ProductController@addSellingProduct')->middleware('auth');

Route::get('/portal/product/removebuyingproduct/{id}', 'Portal\ProductController@removeBuyingProduct')->middleware('auth');
Route::get('/portal/product/removesellingproduct/{id}', 'Portal\ProductController@removeSellingProduct')->middleware('auth');

Route::get('/portal/product/editsbuyingproduct/{id}', 'Portal\ProductController@showEditBuyingProductPage')->middleware('auth');
Route::get('/portal/product/editsellingproduct/{id}', 'Portal\ProductController@showEditSellingProductPage')->middleware('auth');
Route::post('/portal/product/editsellingproduct/edit', 'Portal\ProductController@saveEditedSellingProduct')->middleware('auth');
Route::post('/portal/product/editbuyingproduct/edit', 'Portal\ProductController@saveEditedBuyingProduct')->middleware('auth');

//quarantine
Route::get('/portal/quarantine', 'Portal\QuarantineController@showQuarantinePage')->middleware('auth');
Route::get('/portal/quarantine/quarantine-overview', 'Portal\QuarantineController@showQuarantineOverviewPage')->middleware('auth');
Route::get('/portal/quarantine/quarantine-bins', 'Portal\QuarantineController@showQuarantineBinsPage')->middleware('auth');
Route::get('/portal/quarantine/quarantine-bins/create', 'Portal\QuarantineController@addNewQuarantineBin')->middleware('auth');
Route::get('/portal/quarantine/quarantine-bins/bin/', 'Portal\QuarantineController@showBinView');
Route::get('/portal/quarantine-bins/printlabel/{id}', 'Portal\QuarantineController@printBinLabel');

Route::post('/portal/quarantine/export-csv', 'Portal\QuarantineController@exportCsv')->middleware('auth');
Route::post('/portal/quarantine/allocate-to-tray', 'Portal\QuarantineController@allocateToTray')->middleware('auth');
Route::post('/portal/quarantine/return-to-customer', 'Portal\QuarantineController@returnToCustomer')->middleware('auth');
Route::post('/portal/quarantine/mark-devices-return-to-customer', 'Portal\QuarantineController@markDevicesToReturnToCustomer')->middleware('auth');
Route::post('/portal/quarantine/reallocate-devices-to-trays', 'Portal\QuarantineController@allocateConfirmedDevices')->middleware('auth');
Route::post('/portal/quarantine/addQuarantineStatus', 'Portal\QuarantineController@addQuarantineStatus')->middleware('auth');
Route::post('/portal/quarantine/removeQuarantineStatus', 'Portal\QuarantineController@removeQuarantineStatus')->middleware('auth');
Route::post('/portal/quarantine/addquarantinebin', 'Portal\QuarantineController@addQuarantineBin')->middleware('auth');
Route::get('/portal/quarantine-bins/delete/{id}', 'Portal\QuarantineController@deleteQuarantineBin')->middleware('auth');
Route::post('/portal/quarantine-bins/{binname}/allocatedevice', 'Portal\QuarantineController@showPopupAddDeviceToBin')->middleware('auth');
Route::post('/portal/quarantine-bins/bin/checkAddingDevicesToBin', 'Portal\QuarantineController@checkAddingDevicesToBin')->middleware('auth');
Route::post('/portal/quarantine/add-devices-to-bin-form', 'Portal\QuarantineController@addDevicesToBin')->middleware('auth');

//testing
Route::get('/portal/testing', 'Portal\TestingController@showTestingPage')->middleware('auth');
Route::get('/portal/testing/receive', 'Portal\TestingController@showReceiveTradeIn')->middleware('auth');
Route::get('/portal/testing/find', 'Portal\TestingController@showFindTradeIn')->middleware('auth');

Route::get('/portal/testing/find/test', 'Portal\TestingController@find')->middleware('auth');
Route::get('/portal/testing/receiveorder', 'Portal\TestingController@receive')->middleware('auth');
Route::get('/portal/testing/receive/{id}','Portal\TestingController@testItem')->middleware('auth');
Route::get('/portal/testing/receive/quarantine/{id}', 'Portal\TestingController@showOlderOrderPage')->middleware('auth');
Route::post('/portal/testing/receive/senddevicetouarantine', 'Portal\TestingController@sendReceivingDeviceToQuarantine')->middleware('auth');
Route::get('/portal/testing/checkforimei/{id}', 'Portal\TestingController@showCheckForImeiPage')->middleware('auth');
Route::get('/portal/testing/checkimei/{id}', 'Portal\TestingController@showCheckImeiPage')->middleware('auth');
Route::get('/portal/testing/checkimeiresult/{id}', 'Portal\TestingController@showCheckImeiReultPage')->middleware('auth');
Route::get('/portal/testing/result/{id}','Portal\TestingController@showReceivingResultPage');

Route::post('/portal/testing/receive/checkdevicestatus', 'Portal\TestingController@checkDeviceStatus')->middleware('auth');
Route::post('/portal/testing/receive/settradeinstatus', 'Portal\TestingController@setTradeInStatus')->middleware('auth');
Route::post('/portal/testing/receive/devicemissing', 'Portal\TestingController@isDeviceMissing')->middleware('auth');
Route::post('/portal/testing/receive/devicecorrect', 'Portal\TestingController@isDeviceCorrect')->middleware('auth');
Route::post('/portal/testing/receive/deviceimeivisibility', 'Portal\TestingController@deviceImeiVisibility')->middleware('auth');
Route::post('/portal/testing/receive/checkimei', 'Portal\TestingController@checkimei')->middleware('auth');
Route::post('/portal/testing/receive/usercheckimei', 'Portal\TestingController@userCheckImei')->middleware('auth');
Route::post('/portal/testing/receive/printnewlabel', 'Portal\TestingController@printNewLabel')->middleware('auth');
Route::post('/portal/testing/receive/sendtotray', 'Portal\TestingController@sendtotray')->middleware('auth');
Route::post('/portal/receiving/printnewlabel' , 'Portal\TestingController@downloadSingleFile')->middleware('auth');

Route::get('/portal/testing/checkforserial/{id}', 'Portal\TestingController@showCheckForSerialPage')->middleware('auth');
Route::post('/portal/testing/receive/deviceserialvisibility', 'Portal\TestingController@deviceSerialVisibility')->middleware('auth');

Route::post('/portal/testing/getDeviceData', 'Portal\TestingController@getDeviceData')->middleware('auth');

// Route::post('/portal/testing/getDeviceNetworkData', 'Portal\TestingController@getDeviceNetworkData')->middleware('auth');

//payments
Route::group(['prefix' => 'portal/payments'], function () {
    Route::get('/', 'Portal\PaymentsController@showPaymentPage')->middleware('auth');

    Route::get('/awaiting', 'Portal\PaymentsController@showAwaitingPayments')->middleware('auth');
    Route::get('/awaiting/search/{barcode}', 'Portal\PaymentsController@searchForTradeins')->middleware('auth');
    Route::get('/awaiting/batchsearch', 'Portal\PaymentsController@searchForDevices')->middleware('auth');

    Route::post('/awaiting/createbatch', 'Portal\PaymentsController@createBatch')->middleware('auth');

    Route::get('/submit', 'Portal\PaymentsController@showSubmitPayments')->middleware('auth');
    Route::post('/submit/export/csv', 'Portal\PaymentsController@exportCSV')->name('exportBatchesCSV')->middleware('auth');
    Route::get('/submit/downloadcsv', 'Portal\PaymentsController@downloadCSV')->name('getBatchCSV')->middleware('auth');

    Route::get('/confirm', 'Portal\PaymentsController@showConfirmPayments')->middleware('auth');
    Route::post('/confirm/marksuccess', 'Portal\PaymentsController@markAsSuccessful')->name('markAsSuccess')->middleware('auth');
    Route::post('/confirm/markfailed', 'Portal\PaymentsController@markAsFailed')->name('markAsFailed')->middleware('auth');

    Route::get('/failed', 'Portal\PaymentsController@showFailedPayments')->middleware('auth');
    Route::post('/failed/createbatch', 'Portal\PaymentsController@createFailedBatch')->middleware('auth');

});


//reports
Route::get('/portal/reports', 'Portal\ReportsController@showReportsPage')->middleware('auth');

//feeds
Route::get('/portal/feeds', 'Portal\FeedsController@showFeedsPage')->middleware('auth');
Route::get('/portal/feeds/export-import', 'Portal\FeedsController@showExportImportPage')->middleware('auth');
Route::get('/portal/feeds/summary', 'Portal\FeedsController@showFeedsSummaryPage')->middleware('auth');

Route::post('/portal/feeds/export-import/export', 'Portal\FeedsController@feedsExport');
Route::post('/portal/feeds/export-import/import', 'Portal\FeedsController@feedsImport');

//users
Route::get('/portal/user', 'Portal\UsersController@showUsersPage')->middleware('auth');
Route::get('/portal/user/add', 'Portal\UsersController@showAddUserPage')->middleware('auth');
Route::get('/portal/user/edit/{id}', 'Portal\UsersController@editUser')->middleware('auth');
Route::get('/portal/user/delete/{id}', 'Portal\UsersController@deleteUser')->middleware('auth');

Route::post('/portal/user/adduser', 'Portal\UsersController@addUser')->middleware('auth');
Route::post('/portal/user/search', 'Portal\UsersController@searchUser')->middleware('auth');

//settings
Route::get('/portal/settings','Portal\SettingsController@showSettingsPage')->middleware('auth');
Route::get('/portal/settings/product-options','Portal\SettingsController@showSettingsProductOptionsPage')->middleware('auth');
Route::get('/portal/settings/product-options/selling-colours','Portal\SettingsController@showSellingColourPage')->middleware('auth');
Route::get('/portal/settings/conditions/selling-networks','Portal\SettingsController@showSellingNetworksPage')->middleware('auth');
Route::get('/portal/settings/colours/add', 'Portal\SettingsController@addColourPage')->middleware('auth');
Route::get('/portal/settings/networks/add', 'Portal\SettingsController@addNetworkPage')->middleware('auth');
Route::post('/portal/settings/productoptions/addcolour', 'Portal\SettingsController@addColour')->middleware('auth');
Route::post('/portal/settings/productoptions/addnetwork', 'Portal\SettingsController@addNetwork')->middleware('auth');

Route::get('/portal/settings/conditions','Portal\SettingsController@showSettingsConditionsPage')->middleware('auth');
Route::get('/portal/settings/conditions/add','Portal\SettingsController@showSettingsAddConditionsPage')->middleware('auth');
Route::post('/portal/settings/conditions/addcondition','Portal\SettingsController@addCondition')->middleware('auth');

Route::get('/portal/settings/testing-questions','Portal\SettingsController@showSettingsTestingQuestionsPage')->middleware('auth');
Route::get('/portal/settings/testing-questions/{id}', 'Portal\SettingsController@showCategoryQuestionsPage')->middleware('auth');
Route::get('/portal/settings/testing-questions/{id}/addquestion', 'Portal\SettingsController@showCategoryAddQuestionPage')->middleware('auth');

Route::get('/portal/settings/payments-options','Portal\SettingsController@showSettingsPaymentsOptionsPage')->middleware('auth');
Route::get('/portal/settings/delivery-options','Portal\SettingsController@showSettingsDeliveryOptionsPage')->middleware('auth');
Route::get('/portal/settings/checkout-options','Portal\SettingsController@showSettingsCheckoutOptionsPage')->middleware('auth');
Route::get('/portal/settings/promotional-codes','Portal\SettingsController@showSettingsPromotionalCodesPage')->middleware('auth');
Route::get('/portal/settings/brands','Portal\SettingsController@showSettingsBrandsPage')->middleware('auth');
Route::get('/portal/brands/edit/{id?}', 'Portal\SettingsController@showAddBrandsView')->middleware('auth');
Route::post('portal/brands/editbrabnd', 'Portal\SettingsController@editBrand')->middleware('auth');
Route::get('/portal/settings/barcode-id','Portal\SettingsController@showSettingsBarcodeIdPage')->middleware('auth');

//cms
Route::get('/portal/cms', 'Portal\CmsController@showCmsPage')->middleware('auth');

//Trays
Route::get('/portal/trays', 'Portal\TraysController@showTraysPage')->middleware('auth');
Route::get('/portal/trays/create', 'Portal\TraysController@showAddTrayPage')->middleware('auth');
Route::post('/portal/trays/createtray', 'Portal\TraysController@addTray')->middleware('auth');

Route::get('/portal/trays/tray/', 'Portal\TraysController@showTrayPage')->middleware('auth');
Route::get('/portal/trays/tray/printlabel/{id}', 'Portal\TraysController@printTrayLabel')->middleware('auth');

Route::get('/portal/trays/delete/{id}', 'Portal\TraysController@deleteTray')->middleware('auth');

Route::post('/portal/trays/tray/addtotrolley', 'Portal\TraysController@addTrayToTrolley')->middleware('auth');

//Trolleys
Route::get('/portal/trolleys', 'Portal\TrolleyController@showTrolleysPage')->middleware('auth');
Route::get('/portal/trolleys/create', 'Portal\TrolleyController@showAddTrolleyPage')->middleware('auth');
Route::post('/portal/trolleys/createtrolley', 'Portal\TrolleyController@addTrolley')->middleware('auth');

Route::get('/portal/trolleys/trolley/', 'Portal\TrolleyController@showTrolleyPage')->middleware('auth');
Route::get('/portal/trolleys/trolley/printlabel/{id}', 'Portal\TrolleyController@printTrolleyLabel')->middleware('auth');

Route::get('/portal/trolleys/delete/{id}', 'Portal\TrolleyController@deleteTrolley')->middleware('auth');


//Warehouse Management
Route::group(['prefix'=>'portal/warehouse-management'], function(){
    Route::get('/', 'Portal\WarehouseManagementController@showWarehouseManagementPage');
    Route::get('/box-management', 'Portal\WarehouseManagementController@showBoxManagementPage');
    
    Route::get('/getdevices', 'Portal\WarehouseManagementController@getBoxDevices');
    Route::post('/box-management/createbox', 'Portal\WarehouseManagementController@createBox');
    Route::post('/box-management/addtobox', 'Portal\WarehouseManagementController@addDeviceToBox');
    Route::post('/box-management/openbox', 'Portal\WarehouseManagementController@openBox');
    Route::post('/box-management/suspendbox', 'Portal\WarehouseManagementController@suspendBox');
    Route::post('/box-management/completebox', 'Portal\WarehouseManagementController@completeBox');
    Route::post('/box-management/printboxlabel', 'Portal\WarehouseManagementController@printBoxLabel');
    Route::post('/box-management/printboxmanifest', 'Portal\WarehouseManagementController@printBoxManifest');
    Route::post('/box-management/printboxsummary', 'Portal\WarehouseManagementController@printBoxSummary');
    Route::post('/box-management/checkboxstatusfordevice', 'Portal\WarehouseManagementController@checkBoxStatusForDevice');
    
    Route::get('/bay-overview', 'Portal\WarehouseManagementController@showBayOverviewPage');
    Route::get('/bay-overview/create', 'Portal\WarehouseManagementController@showCreateBayPage');
    Route::get('/bay-overview/bay', 'Portal\WarehouseManagementController@showBayPage');
    Route::post('/bay-overview/createbay', 'Portal\WarehouseManagementController@createBay');
    Route::post('/bay-overview/deletebay', 'Portal\WarehouseManagementController@deleteBay');
    Route::post('/bay-overview/printbay', 'Portal\WarehouseManagementController@printBay');
    Route::post('/bay-overview/bay/checkallocatebox', 'Portal\WarehouseManagementController@checkAllocateBox');
    Route::post('/bay-overview/bay/allocatebox', 'Portal\WarehouseManagementController@allocateBox');

    Route::get('/picking-despatch', 'Portal\WarehouseManagementController@showPickingDespatchPage');
});