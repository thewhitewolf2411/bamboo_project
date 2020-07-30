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

Route::post('/shop/choosephone', 'ShopController@choosePhone');

//selling
Route::get('/sell', 'SellController@showSellView');
Route::get('/sell/why','SellController@showSellWhy');


//User post Route
Route::post('/addtocart/{id}', 'CustomerController@addProductToCart')->name('addproducttocart');
Route::post('/removefromcart', 'CustomerController@removeFromCart')->name('removefromcart');
Route::post('/checkoutcart', 'CustomerController@sheckoutcart')->name('sheckoutcart');

//Admin get Route
Route::get('/admin', 'PagesController@admin')->name('admin')->middleware('auth');
Route::get('/admin/sales', 'AdminController@sales')->name('adminsales')->middleware('auth');
Route::get('/admin/customers', 'AdminController@customers')->name('admincustomers')->middleware('auth');
Route::get('/admin/products', 'AdminController@products')->name('adminsproducts');
Route::get('/admin/category/{category}', 'AdminController@showCategory')->middleware('auth');
Route::get('/admin/search', 'AdminController@search')->name('adminsearch')->middleware('auth');
Route::get('/admin/reports', 'AdminController@reports')->name('adminreports')->middleware('auth');
Route::get('/admin/options', 'AdminController@options')->name('adminsoptions');
Route::get('/admin/addcategory', 'AdminController@addCategoryPage')->name('addCategoryPage')->middleware('auth');
Route::get('/admin/products/addproduct/{id}', 'AdminController@addProductPage')->name('addProductPage')->middleware('auth');

//Admin post route
Route::post('/addCategory', 'AdminController@addCategory')->middleware('auth');
Route::post('/addProduct', 'AdminController@addProduct')->middleware('auth');

//Portal get Route
Route::get('/portal', 'PagesController@portal')->name('portal')->middleware('auth');

//Warehouse Administration Console
Route::get('/portal/adminconsole/adduser', 'PortalAdminConsoleController@showAdminConsoleAddUser')->middleware('auth');
Route::get('/portal/adminconsole/usermanagment', 'PortalAdminConsoleController@showAdminConsoleUserManagment');
Route::get('/portal/adminconsole/usermanagment/view/{id}', 'PortalAdminConsoleController@showAdminConsoleUserManagmentView');
Route::get('/portal/adminconsole/reports', 'PortalAdminConsoleController@showAdminConsoleReportsAndStatistics');
Route::get('/portal/adminconsole/reports/stuckdevicereport', 'PortalAdminConsoleController@showAdminConsoleStuckDevices');
Route::get('/portal/adminconsole/reports/onlineuserreport', 'PortalAdminConsoleController@showAdminConsoleOnlineUser');

Route::post('/portal/adminconsole/adduser/add', 'PortalAdminConsoleController@showAdminConsoleAdd');
Route::post('/portal/adminconsole/adduser/change', 'PortalAdminConsoleController@showAdminConsoleChange');

//Administration Portal
Route::get('/portal/adminportal/sales', 'PortalAdministrationPortal@showAdminPortalSales');
Route::get('/portal/adminportal/sales/allinvoiceorders', 'PortalAdministrationPortal@showAdminPortalInvoices');
Route::get('/portal/adminportal/sales/recommendedsellingprice', 'PortalAdministrationPortal@showAdminPortalRecomendedPrices');
Route::get('/portal/adminportal/reports', 'PortalAdministrationPortal@showAdminPortalReportsAndStatistics');
Route::get('/portal/adminportal/reports/deviceinventoryreport', 'PortalAdministrationPortal@showAdminPortalReportsDeviceInventoryReport');
Route::get('/portal/adminportal/reports/stockholdingreport', 'PortalAdministrationPortal@showAdminPortalReportsStockHoldingReport');
Route::get('/portal/adminportal/reports/stuckdevicesreport', 'PortalAdministrationPortal@showAdminPortalReportsStuckDevicesReport');
Route::get('/portal/adminportal/reports/traystockholdingreport', 'PortalAdministrationPortal@showAdminPortalReportsTrayStockHoldingReport');
Route::get('/portal/adminportal/reports/tradepacksentreport', 'PortalAdministrationPortal@showAdminPortalReportsTradePackSentReport');
Route::get('/portal/adminportal/reports/currentstatusreport', 'PortalAdministrationPortal@showAdminPortalReportsCurrentStatusReport');
Route::get('/portal/adminportal/reports/purchasedunitsreport', 'PortalAdministrationPortal@showAdminPortalReportsPurchasedUnitsReport');
Route::get('/portal/adminportal/reports/deviceswithupgradedprice', 'PortalAdministrationPortal@showAdminPortalReportsDevicesWithUpgradedPriceReport');
Route::get('/portal/adminportal/usermanagment', 'PortalAdministrationPortal@showAdminPortalUserManagment');
Route::get('/portal/adminportal/usermanagment/view/{userid}', 'PortalAdministrationPortal@showAdminPortalViewUser');
Route::get('/portal/adminportal/usermanagment/adduser', 'PortalAdministrationPortal@showAdminPortalAddUser');
Route::get('/portal/adminportal/testingmanagment', 'PortalAdministrationPortal@showAdminPortalTestingManagment');
Route::get('/portal/adminportal/testingmanagment/managequestions', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManageQuestions');
Route::get('/portal/adminportal/testingmanagment/managequestions/addquestion', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManageQuestionsAddQuestion');
Route::get('/portal/adminportal/testingmanagment/managequestions/editquestion/{id}', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManageQuestionsEditQuestion');
Route::get('/portal/adminportal/testingmanagment/managedevices', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManageDevices');
Route::get('/portal/adminportal/testingmanagment/managedevices/export', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManageDevicesExport');
Route::get('/portal/adminportal/testingmanagment/managedevices/import', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManageDevicesImport');
Route::get('/portal/adminportal/testingmanagment/manageprds', 'PortalAdministrationPortal@showAdminPortalTestingManagmentManagePRDs');
Route::get('/portal/adminportal/customerpayment', 'PortalAdministrationPortal@showAdminPortalCustomerPayment');
Route::get('/portal/adminportal/customerpayment/outstandingpayments', 'PortalAdministrationPortal@showAdminPortalCustomerPaymentOutstandingPayments');
Route::get('/portal/adminportal/customerpayment/paymentreports', 'PortalAdministrationPortal@showAdminPortalCustomerPaymentPaymentReports');
Route::get('/portal/adminportal/customerpayment/failedpayments', 'PortalAdministrationPortal@showAdminPortalCustomerPaymentFailedPayments');
Route::get('/portal/adminportal/managemanufacturer', 'PortalAdministrationPortal@showAdminPortalManageManufacturer');
Route::get('/portal/adminportal/managemanufacturer/addmanufacturer', 'PortalAdministrationPortal@showAdminPortalManageManufacturerAddManufacturer');
Route::get('/portal/adminportal/managemanufacturer/addmodel', 'PortalAdministrationPortal@showAdminPortalManageManufacturerAddModel');

//Customer Care Portal
Route::get('/portal/careportal/addorder', 'PortalCustomerCare@CarePortalAddOrder');
Route::get('/portal/careportal/searchorder', 'PortalCustomerCare@CarePortalSearchOrder');

//Phone Testing Portal
Route::get('/portal/testingportal/devicetesting', 'PortalPhoneTesting@TestingPortalDeviceTesting');
Route::get('/portal/testingportal/boxmanagment', 'PortalPhoneTesting@TestingPortalBoxManagment');

//Warehouse Stock Managment Portal
Route::get('/portal/stockportal/deviceteststockmanagment', 'PortalWarehouseStockManagment@StockPortalDeviceTestStockManagment');
Route::get('/portal/stockportal/deviceteststockmanagment/stockawaitingtesting', 'PortalWarehouseStockManagment@StockPortalDeviceTestStockManagmentStockAwaitingTesting');
Route::get('/portal/stockportal/deviceteststockmanagment/stockawaitingcollection', 'PortalWarehouseStockManagment@StockPortalDeviceTestStockManagmentStockAwaitingCollection');
Route::get('/portal/stockportal/trolleymanagment', 'PortalWarehouseStockManagment@StockPortalTrolleyManagment');
Route::get('/portal/stockportal/trolleymanagment/createtrolley', 'PortalWarehouseStockManagment@StockPortalTrolleyManagmentCreateTrolley');
Route::get('/portal/stockportal/trolleymanagment/viewtrolleyreport/{id}', 'PortalWarehouseStockManagment@StockPortalTrolleyManagmentViewTrolley');
Route::get('/portal/stockportal/trayymanagment', 'PortalWarehouseStockManagment@StockPortalTrayManagment');
Route::get('/portal/stockportal/trayymanagment/createtray', 'PortalWarehouseStockManagment@StockPortalTrayManagmentCreateTray');
Route::get('/portal/stockportal/stocktransfer', 'PortalWarehouseStockManagment@StockPortalStockTransfer');
Route::get('/portal/stockportal/stocktransfer/transferboxtotray', 'PortalWarehouseStockManagment@StockPortalStockTransferBoxToTray');
Route::get('/portal/stockportal/stocktransfer/transfertraytotray', 'PortalWarehouseStockManagment@StockPortalStockTransferTrayToTray');
Route::get('/portal/stockportal/stocktransfer/transferdevicetotray', 'PortalWarehouseStockManagment@StockPortalStockTransferDeviceToTray');
Route::get('/portal/stockportal/stocktransfer/transferdevicetotesting', 'PortalWarehouseStockManagment@StockPortalStockTransferDeviceToTesting');
Route::get('/portal/stockportal/stockmanagment', 'PortalWarehouseStockManagment@StockPortalStockManagment');
Route::get('/portal/stockportal/stockmanagment/stockreport', 'PortalWarehouseStockManagment@StockPortalStockManagmentStockReport');
Route::get('/portal/stockportal/stockmanagment/missingitemsreport', 'PortalWarehouseStockManagment@StockPortalStockManagmentMissingItemsReport');
Route::get('/portal/stockportal/stockmanagment/stocktake', 'PortalWarehouseStockManagment@StockPortalStockManagmentStockTake');
Route::get('/portal/stockportal/quarantinemanagment', 'PortalWarehouseStockManagment@StockPortalQuarantineManagment');
Route::get('/portal/stockportal/quarantinemanagment/devicetomoveintoquarantine', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentDeviceToQuarantine');
Route::get('/portal/stockportal/quarantinemanagment/devicetomoveoutofquarantine', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentDeviceFromQuarantine');
Route::get('/portal/stockportal/quarantinemanagment/devicesawaitingcustomerresponse', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentDevicesCustomerResponse');
Route::get('/portal/stockportal/quarantinemanagment/returndevicestocustomer', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentReturnDeviceToCustomer');
Route::get('/portal/stockportal/quarantinemanagment/sendstolendevicestopolice', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentSendDevicesToPolice');
Route::get('/portal/stockportal/quarantinemanagment/unknowndevices', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentUnknownDevices');
Route::get('/portal/stockportal/quarantinemanagment/expireorders', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentExpireOrders');
Route::get('/portal/stockportal/quarantinemanagment/incorrectlyidentifieddevices', 'PortalWarehouseStockManagment@StockPortalQuarantineManagmentIncorrectlyIdentifiedDevices');
Route::get('/portal/stockportal/salesanddispach', 'PortalWarehouseStockManagment@StockPortalSalesandDispach');
Route::get('/portal/stockportal/devicemanagment', 'PortalWarehouseStockManagment@StockPortalDeviceManagment');

//Warehouse Receipt and Dispach Portal
Route::get('/portal/dispachportal/tradepackdispach', 'PortalWarehouseReceiptDispatch@DispachPortalTradePackDispach');
Route::get('/portal/dispachportal/deliveryreciving', 'PortalWarehouseReceiptDispatch@DispachPortalDeliveryReciving');

//Portal post Route