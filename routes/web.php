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

Route::get('/portal', 'Portal\PortalController@portal')->name('portal');
Route::get('/portal/seeddatapage', 'Portal\PortalController@seedDataPage')->name('seedDataPage');
Route::post('/portal/seeddata', 'Portal\PortalController@seedData')->name('seedData');

//customer-care
Route::get('/portal/customer-care', 'Portal\CustomerCareController@showCustomerCare')->name('customerCare');
Route::get('/portal/customer-care/trade-in/all/{search?}', 'Portal\CustomerCareController@showTradeIn')->name('tradeIn');
Route::get('/portal/customer-care/trade-in/{id}', 'Portal\CustomerCareController@showTradeInDetails')->name('tradeInDetails');
Route::get('/portal/customer-care/trade-in/{id}/details', 'Portal\CustomerCareController@showMoreTradeInDetails')->name('tradeInDetails');
Route::post('/portal/customer-care/trade-in/printlabel', 'Portal\CustomerCareController@PrintTradeInLabel')->name('tradeInLabel');
Route::post('/portal/customer-care/trade-in/printlabelbulk', 'Portal\CustomerCareController@PrintTradeInLabelBulk')->name('tradeInLabel');

// audit notes
Route::post('/portal/customer-care/trade-in/addauditnote', 'Portal\CustomerCareController@addAuditNote')->name('addAuditNote');
Route::post('/portal/customer-care/trade-in/updateauditnote', 'Portal\CustomerCareController@updateAuditNote')->name('updateAuditNote');
Route::post('/portal/customer-care/trade-in/deleteauditnote', 'Portal\CustomerCareController@deleteAuditNote')->name('deleteAuditNote');


Route::get('/portal/customer-care/trade-out', 'Portal\CustomerCareController@showTradeOut')->name('tradeOut');
Route::get('/portal/customer-care/trade-out/{id}', 'Portal\CustomerCareController@showTradeOutDetails')->name('tradeOutDetails');
Route::post('/portal/customer-care/tradein/deletetradein', 'Portal\CustomerCareController@deleteTradeInFromSystem');
Route::get('/deleteorder/{id}', 'Portal\CustomerCareController@deleteTradeIn');
Route::get('/totesting/{id}', 'Portal\CustomerCareController@returnToTesting');

Route::get('/portal/customer-care/destroy-device', 'Portal\CustomerCareController@showDestroyDevice')->name('destroyDevice');
Route::get('/portal/customer-care/trade-pack/{search?}', 'Portal\CustomerCareController@showTradePack')->name('tradePack');
Route::post('/portal/customer-care/trade-in/setassent', 'Portal\CustomerCareController@setTradePackAsSent')->name('tradePack');
Route::get('/portal/customer-care/seller', 'Portal\CustomerCareController@showSeller')->name('seller');
Route::get('/portal/customer-care/seller/{id}', 'Portal\CustomerCareController@showSellerDetails');
Route::get('/portal/customer-care/seller/disable/{id}', 'Portal\CustomerCareController@disableSellerAccount');
Route::get('/portal/customer-care/seller/enable/{id}', 'Portal\CustomerCareController@enableSellerAccount');
Route::get('/portal/customer-care/seller/delete/{id}', 'Portal\CustomerCareController@deleteUserAccount');
Route::get('/portal/customer-care/createorder', 'Portal\CustomerCareController@createOrder');
Route::get('/portal/customer-care/trade-pack/markforreprint/{id}', 'Portal\CustomerCareController@markForReprint');
Route::get('/portal/customer-care/order-managment/{search?}', 'Portal\CustomerCareController@showOrderManagment');
Route::post('/portal/customer-care/printdevicelabel', 'Portal\CustomerCareController@printDeviceLabel');
Route::post('/portal/customer-care/sendtodespatch', 'Portal\CustomerCareController@sendToDespatch')->name('sendToDespatch');

Route::get('/toreceive/{barcode}', 'Portal\CustomerCareController@sendDeviceBackToReceive');
Route::get('/totest/{barcode}', 'Portal\CustomerCareController@sendDeviceBackToTest');
Route::get('/cancel/{barcode}', 'Portal\CustomerCareController@cancelOrder');

Route::get('/portal/ecommerence/order-management{search?}', 'Portal\EcommerenceController@showEcommerenceOrderManagement');
Route::get('/portal/ecommerence/customer-accounts', 'Portal\EcommerenceController@showEcommerenceCustomerAccounts');
Route::get('/portal/ecommerence/order-status{search?}', 'Portal\EcommerenceController@showEcommerenceOrderStatus');
Route::get('/portal/ecommerence/create-order', 'Portal\EcommerenceController@showEcommerenceCreateOrder');

Route::post('/portal/ecommerence/setAsSent', 'Portal\CustomerCareController@setTradeoutAsSent');

//categories, brands
Route::get('/portal/categories', 'Portal\ProductController@showCategories')->name('showCategories');
Route::get('/portal/categories/add', 'Portal\ProductController@showAddCategoryView');
Route::get('/portal/categories/edit/{id}', 'Portal\ProductController@ShowEditCategoryView');
Route::post('/portal/category/editcategory', 'Portal\ProductController@editCategory');
Route::get('/portal/categories/delete/{id}', 'Portal\ProductController@deleteCategory');
Route::post('/portal/category/addcategory','Portal\ProductController@addCategory');

Route::get('/portal/brands/add', 'Portal\ProductController@showAddBrandsView');
Route::get('/portal/brands/delete/{id}', 'Portal\ProductController@deleteBrands');
Route::post('/portal/brands/addbrabnd','Portal\ProductController@addBrand');

//products
Route::get('/portal/product', 'Portal\ProductController@showProductsPage');
Route::get('/portal/product/selling-products', 'Portal\ProductController@showSellingProductsPage');
Route::get('/portal/product/removesellingproductoption/{id}', 'Portal\ProductController@showSellingProductOption');
Route::get('/portal/product/buying-products', 'Portal\ProductController@showBuyingProductsPage');

Route::get('/portal/product/addbuyingproduct', 'Portal\ProductController@showAddBuyingProductPage');
Route::post('/portal/product/addbuyingproduct/add', 'Portal\ProductController@addBuyingProduct');

Route::get('portal/product/addsellingproduct', 'Portal\ProductController@showAddSellingProductPage');
Route::post('/portal/product/addsellingproduct/add', 'Portal\ProductController@addSellingProduct');

Route::get('/portal/product/removebuyingproduct/{id}', 'Portal\ProductController@removeBuyingProduct');
Route::get('/portal/product/removesellingproduct/{id}', 'Portal\ProductController@removeSellingProduct');

Route::get('/portal/product/editsbuyingproduct/{id}', 'Portal\ProductController@showEditBuyingProductPage');
Route::get('/portal/product/editsellingproduct/{id}', 'Portal\ProductController@showEditSellingProductPage');
Route::post('/portal/product/editsellingproduct/edit', 'Portal\ProductController@saveEditedSellingProduct');
Route::post('/portal/product/editbuyingproduct/edit', 'Portal\ProductController@saveEditedBuyingProduct');

//quarantine
Route::get('/portal/quarantine', 'Portal\QuarantineController@showQuarantinePage');
Route::get('/portal/quarantine/quarantine-overview', 'Portal\QuarantineController@showQuarantineOverviewPage');
Route::get('/portal/quarantine/quarantine-bins', 'Portal\QuarantineController@showQuarantineBinsPage');
Route::get('/portal/quarantine/quarantine-bins/create', 'Portal\QuarantineController@addNewQuarantineBin');
Route::get('/portal/quarantine/quarantine-bins/bin/', 'Portal\QuarantineController@showBinView');
Route::get('/portal/quarantine-bins/printlabel/{id}', 'Portal\QuarantineController@printBinLabel');

Route::post('/portal/quarantine/export-csv', 'Portal\QuarantineController@exportCsv');
Route::post('/portal/quarantine/allocate-to-tray', 'Portal\QuarantineController@allocateToTray');
Route::post('/portal/quarantine/return-to-customer', 'Portal\QuarantineController@returnToCustomer');
Route::post('/portal/quarantine/mark-devices-return-to-customer', 'Portal\QuarantineController@markDevicesToReturnToCustomer');
Route::post('/portal/quarantine/reallocate-devices-to-trays', 'Portal\QuarantineController@allocateConfirmedDevices');
Route::post('/portal/quarantine/addQuarantineStatus', 'Portal\QuarantineController@addQuarantineStatus');
Route::post('/portal/quarantine/removeQuarantineStatus', 'Portal\QuarantineController@removeQuarantineStatus');
Route::post('/portal/quarantine/addquarantinebin', 'Portal\QuarantineController@addQuarantineBin');
Route::get('/portal/quarantine-bins/delete/{id}', 'Portal\QuarantineController@deleteQuarantineBin');
Route::post('/portal/quarantine-bins/{binname}/allocatedevice', 'Portal\QuarantineController@showPopupAddDeviceToBin');
Route::post('/portal/quarantine-bins/bin/checkAddingDevicesToBin', 'Portal\QuarantineController@checkAddingDevicesToBin');
Route::post('/portal/quarantine/add-devices-to-bin-form', 'Portal\QuarantineController@addDevicesToBin');

//testing
Route::get('/portal/testing', 'Portal\TestingController@showTestingPage');
Route::get('/portal/testing/receive', 'Portal\TestingController@showReceiveTradeIn');
Route::get('/portal/testing/find', 'Portal\TestingController@showFindTradeIn');

Route::get('/portal/testing/find/test', 'Portal\TestingController@find');
Route::get('/portal/testing/receiveorder', 'Portal\TestingController@receive');
Route::get('/portal/testing/receive/{id}','Portal\TestingController@testItem');
Route::get('/portal/testing/receive/quarantine/{id}', 'Portal\TestingController@showOlderOrderPage');
Route::post('/portal/testing/receive/senddevicetouarantine', 'Portal\TestingController@sendReceivingDeviceToQuarantine');
Route::get('/portal/testing/checkforimei/{id}', 'Portal\TestingController@showCheckForImeiPage');
Route::get('/portal/testing/checkimei/{id}', 'Portal\TestingController@showCheckImeiPage');
Route::get('/portal/testing/checkimeiresult/{id}', 'Portal\TestingController@showCheckImeiReultPage');
Route::get('/portal/testing/result/{id}','Portal\TestingController@showReceivingResultPage');

// Route::post('/portal/testing/receive/checkdevicestatus', 'Portal\TestingController@checkDeviceStatus')->middleware('auth');
// Route::post('/portal/testing/receive/settradeinstatus', 'Portal\TestingController@setTradeInStatus')->middleware('auth');
// Route::post('/portal/testing/receive/devicemissing', 'Portal\TestingController@isDeviceMissing')->middleware('auth');
// Route::post('/portal/testing/receive/devicecorrect', 'Portal\TestingController@isDeviceCorrect')->middleware('auth');
// Route::post('/portal/testing/receive/deviceimeivisibility', 'Portal\TestingController@deviceImeiVisibility')->middleware('auth');
// Route::post('/portal/testing/receive/checkimei', 'Portal\TestingController@checkimei')->middleware('auth');
// Route::post('/portal/testing/receive/usercheckimei', 'Portal\TestingController@userCheckImei')->middleware('auth');
// Route::post('/portal/testing/receive/printnewlabel', 'Portal\TestingController@printNewLabel')->middleware('auth');
// Route::post('/portal/testing/receive/sendtotray', 'Portal\TestingController@sendtotray')->middleware('auth');
// Route::post('/portal/receiving/printnewlabel' , 'Portal\TestingController@downloadSingleFile')->middleware('auth');

// Route::get('/portal/testing/checkforserial/{id}', 'Portal\TestingController@showCheckForSerialPage')->middleware('auth');
// Route::post('/portal/testing/receive/deviceserialvisibility', 'Portal\TestingController@deviceSerialVisibility')->middleware('auth');

// Route::post('/portal/testing/getDeviceData', 'Portal\TestingController@getDeviceData')->middleware('auth');

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

Route::post('/portal/testing/receive/checkdevicestatus', 'Portal\TestingController@checkDeviceStatus');
Route::post('/portal/testing/receive/settradeinstatus', 'Portal\TestingController@setTradeInStatus');
Route::post('/portal/testing/receive/devicemissing', 'Portal\TestingController@isDeviceMissing');
Route::post('/portal/testing/receive/devicecorrect', 'Portal\TestingController@isDeviceCorrect');
Route::post('/portal/testing/receive/deviceimeivisibility', 'Portal\TestingController@deviceImeiVisibility');
Route::post('/portal/testing/receive/checkimei', 'Portal\TestingController@checkimei');
Route::post('/portal/testing/receive/usercheckimei', 'Portal\TestingController@userCheckImei');
Route::post('/portal/testing/receive/printnewlabel', 'Portal\TestingController@printNewLabel');
Route::post('/portal/testing/receive/sendtotray', 'Portal\TestingController@sendtotray');
Route::post('/portal/receiving/printnewlabel' , 'Portal\TestingController@downloadSingleFile');

Route::get('/portal/testing/checkforserial/{id}', 'Portal\TestingController@showCheckForSerialPage');
Route::post('/portal/testing/receive/deviceserialvisibility', 'Portal\TestingController@deviceSerialVisibility');

Route::post('/portal/testing/getDeviceData', 'Portal\TestingController@getDeviceData');
Route::post('/portal/testing/getDeviceNetworkData', 'Portal\TestingController@getDeviceNetworkData');

//reports
Route::get('/portal/reports', 'Portal\ReportsController@showReportsPage');

//feeds
Route::get('/portal/feeds', 'Portal\FeedsController@showFeedsPage');
Route::get('/portal/feeds/export-import', 'Portal\FeedsController@showExportImportPage');
Route::get('/portal/feeds/summary', 'Portal\FeedsController@showFeedsSummaryPage');

Route::post('/portal/feeds/export-import/export', 'Portal\FeedsController@feedsExport');
Route::post('/portal/feeds/export-import/import', 'Portal\FeedsController@feedsImport');

//users
Route::get('/portal/user', 'Portal\UsersController@showUsersPage');
Route::get('/portal/user/add', 'Portal\UsersController@showAddUserPage');
Route::get('/portal/user/edit/{id}', 'Portal\UsersController@editUser');
Route::get('/portal/user/delete/{id}', 'Portal\UsersController@deleteUser');

Route::post('/portal/user/adduser', 'Portal\UsersController@addUser');
Route::post('/portal/user/search', 'Portal\UsersController@searchUser');

//settings
Route::get('/portal/settings','Portal\SettingsController@showSettingsPage');
Route::get('/portal/settings/product-options','Portal\SettingsController@showSettingsProductOptionsPage');
Route::get('/portal/settings/product-options/selling-colours','Portal\SettingsController@showSellingColourPage');
Route::get('/portal/settings/conditions/selling-networks','Portal\SettingsController@showSellingNetworksPage');
Route::get('/portal/settings/colours/add', 'Portal\SettingsController@addColourPage');
Route::get('/portal/settings/networks/add', 'Portal\SettingsController@addNetworkPage');
Route::post('/portal/settings/productoptions/addcolour', 'Portal\SettingsController@addColour');
Route::post('/portal/settings/productoptions/addnetwork', 'Portal\SettingsController@addNetwork');

Route::get('/portal/settings/conditions','Portal\SettingsController@showSettingsConditionsPage');
Route::get('/portal/settings/conditions/add','Portal\SettingsController@showSettingsAddConditionsPage');
Route::post('/portal/settings/conditions/addcondition','Portal\SettingsController@addCondition');

Route::get('/portal/settings/testing-questions','Portal\SettingsController@showSettingsTestingQuestionsPage');
Route::get('/portal/settings/testing-questions/{id}', 'Portal\SettingsController@showCategoryQuestionsPage');
Route::get('/portal/settings/testing-questions/{id}/addquestion', 'Portal\SettingsController@showCategoryAddQuestionPage');

Route::get('/portal/settings/payments-options','Portal\SettingsController@showSettingsPaymentsOptionsPage');
Route::get('/portal/settings/delivery-options','Portal\SettingsController@showSettingsDeliveryOptionsPage');
Route::get('/portal/settings/checkout-options','Portal\SettingsController@showSettingsCheckoutOptionsPage');
Route::get('/portal/settings/promotional-codes','Portal\SettingsController@showSettingsPromotionalCodesPage');
Route::get('/portal/settings/brands','Portal\SettingsController@showSettingsBrandsPage');
Route::get('/portal/brands/edit/{id?}', 'Portal\SettingsController@showAddBrandsView');
Route::post('portal/brands/editbrabnd', 'Portal\SettingsController@editBrand');
Route::get('/portal/settings/barcode-id','Portal\SettingsController@showSettingsBarcodeIdPage');

//cms
Route::get('/portal/cms', 'Portal\CmsController@showCmsPage');

//Trays
Route::get('/portal/trays', 'Portal\TraysController@showTraysPage');
Route::get('/portal/trays/create', 'Portal\TraysController@showAddTrayPage');
Route::post('/portal/trays/createtray', 'Portal\TraysController@addTray');

Route::get('/portal/trays/tray/', 'Portal\TraysController@showTrayPage');
Route::get('/portal/trays/tray/printlabel/{id}', 'Portal\TraysController@printTrayLabel');

Route::get('/portal/trays/delete/{id}', 'Portal\TraysController@deleteTray');

Route::post('/portal/trays/tray/addtotrolley', 'Portal\TraysController@addTrayToTrolley');

//Trolleys
Route::get('/portal/trolleys', 'Portal\TrolleyController@showTrolleysPage');
Route::get('/portal/trolleys/create', 'Portal\TrolleyController@showAddTrolleyPage');
Route::post('/portal/trolleys/createtrolley', 'Portal\TrolleyController@addTrolley');

Route::get('/portal/trolleys/trolley/', 'Portal\TrolleyController@showTrolleyPage');
Route::get('/portal/trolleys/trolley/printlabel/{id}', 'Portal\TrolleyController@printTrolleyLabel');

Route::get('/portal/trolleys/delete/{id}', 'Portal\TrolleyController@deleteTrolley');


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
    Route::get('/picking-despatch/pick-lot/{id}', 'Portal\WarehouseManagementController@showPickLotPage');
    Route::post('/picking-despatch/print-pick-note','Portal\WarehouseManagementController@printPickNote');
    Route::post('/picking-despatch/pick-lot/checkboxstatus', 'Portal\WarehouseManagementController@checkBoxStatusOfLot');
    Route::post('/picking-despatch/pick-lot/checkdevicestatus', 'Portal\WarehouseManagementController@checkDeviceStatusOfLot');

    Route::post('/picking-despatch/pick-lot/pickbox', 'Portal\WarehouseManagementController@pickBox');
    Route::post('/picking-despatch/pick-lot/pickdevice', 'Portal\WarehouseManagementController@pickDevice');

    Route::post('/picking-despatch/pick-lot/cancel-picking', 'Portal\WarehouseManagementController@cancelPickingLot');
    Route::post('/picking-despatch/pick-lot/suspend-picking', 'Portal\WarehouseManagementController@suspendPickingLot');
    Route::post('/picking-despatch/pick-lot/complete-picking', 'Portal\WarehouseManagementController@completePickingLot');
    Route::post('/picking-despatch/pick-lot/despatch-picking', 'Portal\WarehouseManagementController@despatchPickingLot');

});

Route::group(['prefix'=>'portal/sales-lot'], function(){

    Route::get('/', 'Portal\SalesLotController@showSalesLotPage');

    Route::get('/building-sales-lot', 'Portal\SalesLotController@showBuildingSalesLotPage');
    Route::post('/building-sales-lot/build-lot', 'Portal\SalesLotController@buildSalesLot');

    Route::get('/completed-sales-lots', 'Portal\SalesLotController@showCompletedSalesLotPage');
    Route::get('/completed-sales-lots/get-saleslot-content', 'Portal\SalesLotController@getSalesLotContent');
    Route::post('/completed-sales-lots/change-state', 'Portal\SalesLotController@changeSalesLotState');


});