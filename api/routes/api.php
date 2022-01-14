<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::group(['prefix' => '/'], function () {
    Route::post('login', 'Api\ApiAuthController@login')->name('login');
    Route::post('register', 'Api\ApiAuthController@register');
    Route::post('forgotpassword', 'Api\ApiAuthController@forgotPassword');
    Route::post('resetpassword', 'Api\ApiAuthController@resetPassword');
});

Route::post('/logout', ['as' => 'api.logout', 'uses' => 'Api\ApiAuthController@logout']);
Route::middleware(['auth.api', 'cors'])->group(function () {
Route::post('/users/change-password',
    ['as' => 'api.users.change-password', 'uses' => 'Api\ApiAccountController@changePassword']);

// Product
Route::group(['prefix' => 'product', 'module' => 'PRODUCT'], function () {
    Route::get('/', ['as' => 'api.product', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiProductController@index']);
    Route::get('/download', ['as' => 'api.product.download', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiProductController@download']);
    Route::get('/{id}', ['as' => 'api.product.get_detail', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiProductController@show']);
    Route::post('/', ['as' => 'api.product.get_detail', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiProductController@store']);
    Route::post('/upload', ['as' => 'api.product.get_detail', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiProductController@uploadImage']);
    Route::delete('/{id}', ['as' => 'api.product.get_detail', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiProductController@destroy']);
    Route::post('/get-code', ['as' => 'api.product.get_code', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiProductController@productCode']);
    Route::post('/validate-code', ['as' => 'api.product.validate_code', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiProductController@validateCode']);
    Route::delete('/image/{id}', ['as' => 'api.product.image', 'accessLevel' => 'DELETE-IMAGE', 'uses' => 'Api\ApiProductController@deleteImage']);
});  

// Bank
Route::group(['prefix' => 'bank', 'module' => 'BANK'], function () {
    Route::get('/', ['as' => 'api.bank.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiBankController@index']);
    Route::get('/{id}', ['as' => 'api.bank.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiBankController@show']);
    Route::post('/', ['as' => 'api.bank.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiBankController@store']);
    Route::delete('/{id}', ['as' => 'api.bank.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiBankController@destroy']);
});

// Category
Route::group(['prefix' => 'category', 'module' => 'CATEGORIES'], function () {
    Route::get('/', ['as' => 'api.category.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiCategoryController@index']);
    Route::get('/{id}', ['as' => 'api.category.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiCategoryController@show']);
    Route::post('/', ['as' => 'api.category.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiCategoryController@store']);
    Route::delete('/{id}', ['as' => 'api.category.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiCategoryController@destroy']);
});

// Users
Route::group(['prefix' => 'users', 'module' => 'USERS'], function () {
    Route::get('/', ['as' => 'api.users.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiUserController@index']);
    Route::get('/me', ['as' => 'api.users.me', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiAccountController@show']);
    Route::get('/{id}', ['as' => 'api.users.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiUserController@show']);
    Route::post('/', ['as' => 'api.users.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiUserController@store']);
    Route::post('/change-password', ['as' => 'api.users.changepassword', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiUserController@changePassword']);
    Route::delete('/{id}', ['as' => 'api.users.delete', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiUserController@destroy']);
    Route::post('/confirmation-password', ['as' => 'api.users.confirmpw', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiUserController@validationPassword']);
});

// Permission
Route::group(['prefix' => 'permission', 'module' => 'PERMISSION'], function () {
    Route::get('/', ['as' => 'api.users.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiPermissionController@index']);
    Route::post('/set-permission', ['as' => 'api.users.index', 'accessLevel' => 'SET-PERMISSION', 'uses' => 'Api\ApiPermissionController@setPermission']);
    Route::get('/get-permission/{id}', ['as' => 'api.users.index', 'accessLevel' => 'GET-PERMISSION', 'uses' => 'Api\ApiPermissionController@getPermission']);
    Route::post('/delete-permission', ['as' => 'api.users.delete-byuserid', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiPermissionController@destroyPermission']);
    Route::delete('/{id}', ['as' => 'api.users.index', 'BYPASS' => 'DELETE', 'uses' => 'Api\ApiPermissionController@destroy']);
});

// Zone
Route::group(['prefix' => 'zone', 'module' => 'ZONE'], function () {
    Route::get('/', ['as' => 'api.zone.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiZoneController@index']);
    Route::get('/{id}', ['as' => 'api.zone.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiZoneController@show']);
    Route::post('/', ['as' => 'api.zone.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiZoneController@store']);
    Route::delete('/{id}', ['as' => 'api.zone.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiZoneController@destroy']);
});

// Partner
Route::group(['prefix' => 'partner', 'module' => 'PARTNER'], function () {
    Route::get('/', ['as' => 'api.partner.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiPartnerController@index']);
    Route::get('/last', ['as' => 'api.partner.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiPartnerController@lastId']);
    Route::get('/{id}', ['as' => 'api.partner.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiPartnerController@show']);
    Route::post('/', ['as' => 'api.partner.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiPartnerController@store']);
    Route::delete('/{id}', ['as' => 'api.partner.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiPartnerController@destroy']);
    Route::post('/import', ['as' => 'api.partner.index', 'accessLevel' => 'IMPORT', 'uses' => 'Api\ApiPartnerController@import']);
});

// Wilayah
Route::group(['prefix' => 'wilayah', 'module' => 'DOMAIN'], function () {
    Route::get('/provinsi', ['as' => 'api.partner.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiWilayahController@provinsi']);
    Route::get('/kabupaten/{kode}', ['as' => 'api.partner.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiWilayahController@kabupaten']);
    Route::get('/kecamatan/{kode}', ['as' => 'api.partner.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiWilayahController@kecamatan']);
});

// WareHouse
Route::group(['prefix' => 'warehouse', 'module' => 'WAREHOUSE'], function () {
    Route::get('/', ['as' => 'api.warehouse.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiWareHouseController@index']);
    Route::get('/{id}', ['as' => 'api.warehouse.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiWareHouseController@show']);
    Route::post('/', ['as' => 'api.warehouse.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiWareHouseController@store']);
    Route::delete('/{id}', ['as' => 'api.warehouse.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiWareHouseController@destroy']);
});

// Company
Route::group(['prefix' => 'company', 'module' => 'COMPANY'], function () {
    Route::get('/', ['as' => 'api.company.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiCompanyController@index']);
    Route::get('/{id}', ['as' => 'api.company.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiCompanyController@show']);
    Route::post('/', ['as' => 'api.company.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiCompanyController@store']);
    Route::post('/upload', ['as' => 'api.company.index', 'accessLevel' => 'UPLOAD', 'uses' => 'Api\ApiCompanyController@uploadImage']);
});

// Product Package
Route::group(['prefix' => 'package', 'module' => 'PRODUCT-PACKAGE'], function () {
    Route::get('/', ['as' => 'api.package.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiProductPackageController@index']);
    Route::get('/{id}', ['as' => 'api.package.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiProductPackageController@show']);
    Route::post('/', ['as' => 'api.package.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiProductPackageController@store']);
    Route::delete('/{id}', ['as' => 'api.package.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiProductPackageController@destroy']);

    Route::group(['prefix' => 'item'], function () {
        Route::get('/', 'Api\ApiProductItemController@index');
        Route::get('/{id}', 'Api\ApiProductItemController@show');
        Route::post('/', 'Api\ApiProductItemController@store');
        Route::delete('/{id}', 'Api\ApiProductItemController@destroy');
    });
});

// Stock
Route::group(['prefix' => 'stock', 'module' => 'STOCK'], function () {
    Route::get('/', ['as' => 'api.stock.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiStockController@index']);
    Route::get('/all', ['as' => 'api.stock.all', 'accessLevel' => 'ALL', 'uses' => 'Api\ApiStockController@all']);
    Route::get('/warehouse', ['as' => 'api.stock.all', 'accessLevel' => 'ALL', 'uses' => 'Api\ApiStockController@warehouse']);
    Route::get('/{id}', ['as' => 'api.stock.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiStockController@show']);
    Route::post('/', ['as' => 'api.stock.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiStockController@store']);
    Route::delete('/{id}', ['as' => 'api.stock.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiStockController@destroy']);
});

// Stock check
Route::group(['prefix' => 'stock-check', 'module' => 'STOCK-CHECK'], function () {
    Route::get('/adjustment', ['as' => 'api.stock-item.adjustment', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockCheckController@getAdjustment']);
    Route::get('/active', ['as' => 'api.stock-check.active', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockCheckController@active']);
    Route::get('/active-stock', ['as' => 'api.stock-check.active-stock', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockCheckController@activeStock']);
    Route::get('/export', ['as' => 'api.stock-check.export', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiStockCheckController@export']);
    Route::get('/', ['as' => 'api.stock-check.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiStockCheckController@index']);
    Route::get('/{id}', ['as' => 'api.stock-check.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiStockCheckController@show']);
    Route::post('/', ['as' => 'api.stock-check.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiStockCheckController@store']);
    Route::delete('/{id}', ['as' => 'api.stock-check.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiStockCheckController@destroy']);
});


// Stock Item
Route::group(['prefix' => 'stock-item', 'module' => 'STOCK-ITEM'], function () {
    Route::get('/', ['as' => 'api.stock-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockItemController@index']);
    Route::get('/{id}', ['as' => 'api.stock-item.show', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockItemController@show']);
    Route::post('/', ['as' => 'api.stock-item.store', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockItemController@store']);
    Route::get('/product/{id}', ['as' => 'api.stock-item.product', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockItemController@product']);
    Route::delete('/{id}', ['as' => 'api.stock-item.destroy', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiStockItemController@destroy']);
});

// Sales Order
Route::group(['prefix' => 'sales-order', 'module' => 'SALES-ORDER'], function () {
    Route::get('/get-total', ['as' => 'api.sales-order.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiSalesOrderController@getTotal']);
    Route::get('/', ['as' => 'api.sales-order.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiSalesOrderController@index']);
    Route::get('/status', ['as' => 'api.sales-order.status', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderController@checkSO']);
    Route::get('/number', ['as' => 'api.sales-order.orderNumber', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderController@orderNumber']);
    Route::get('/export', ['as' => 'api.sales-order.export', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiSalesOrderController@export']);
    Route::get('/{id}', ['as' => 'api.sales-order.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiSalesOrderController@show']);
    Route::delete('/{id}', ['as' => 'api.sales-order.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiSalesOrderController@destroy']);
    Route::post('/', ['as' => 'api.sales-order.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiSalesOrderController@store']);
    Route::post('/upload', ['as' => 'api.sales-order.uploadImage', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiSalesOrderController@uploadImage']);
    Route::post('/check', ['as' => 'api.sales-order.check', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderController@check']);
});

// Order Item
Route::group(['prefix' => 'order-item', 'module' => 'ORDER-ITEM'], function () {
    Route::get('/', ['as' => 'api.order-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderItemController@index']);
    Route::get('/{id}', ['as' => 'api.order-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderItemController@show']);
    Route::post('/', ['as' => 'api.order-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderItemController@store']);
    Route::delete('/{id}', ['as' => 'api.order-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesOrderItemController@destroy']);
});

// Purchase Order
Route::group(['prefix' => 'purchase-order', 'module' => 'PURCHASE-ORDER'], function () {
    Route::get('/print/{id}', ['as' => 'api.purchase-order.print', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiPurchaseOrderController@print']);
    Route::get('/item/{id}', ['as' => 'api.purchase-order.item', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiPurchaseOrderController@item']);
    Route::get('/', ['as' => 'api.purchase-order.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiPurchaseOrderController@index']);
    Route::get('/number', ['as' => 'api.purchase-order.orderNumber', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiPurchaseOrderController@orderNumber']);
    Route::get('/{id}', ['as' => 'api.purchase-order.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiPurchaseOrderController@show']);
    Route::post('/', ['as' => 'api.purchase-order.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiPurchaseOrderController@store']);
    Route::delete('/{id}', ['as' => 'api.purchase-order.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiPurchaseOrderController@destroy']);
    Route::post('/upload', ['as' => 'api.purchase-order.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiPurchaseOrderController@uploadImage']);
});

// Invoice
Route::group(['prefix' => 'invoice', 'module' => 'INVOICE'], function () {
    Route::get('/get-total', ['as' => 'api.invoice.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@getTotal']);

    Route::get('/payment/{id}', ['as' => 'api.invoice.payment', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@payment']);
    Route::get('/new-edit', ['as' => 'api.invoice.getNewEdit', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@getNewEdit']);
    Route::get('/new-edit/{id}', ['as' => 'api.invoice.updateNewEdit', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@updateNewEdit']);
    Route::get('/request', ['as' => 'api.invoice.request', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@getRequest']);
    Route::post('/cancel', ['as' => 'api.invoice.cancel', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@cancel']);
    Route::post('/request-cancel', ['as' => 'api.invoice.requestCancel', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@requestCancel']);
    Route::post('/rounding', ['as' => 'api.invoice.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@rounding']);
    Route::post('/request-edit', ['as' => 'api.invoice.requestEdit', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@requestEdit']);
    Route::post('/update-print', ['as' => 'api.invoice.updatePrint', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@updatePrint']);
    Route::get('/export', ['as' => 'api.invoice.export', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@export']);
    Route::get('/', ['as' => 'api.invoice.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiInvoiceController@index']);
    Route::get('/pdf/{id}', ['as' => 'api.invoice.index', 'accessLevel' => 'view-pdf', 'uses' => 'Api\ApiInvoiceController@createPdf']);
    Route::get('/download/{id}', ['as' => 'api.invoice.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@download']);
    Route::get('/{id}', ['as' => 'api.invoice.index', 'accessLevel' => 'ACCESS,VIEW', 'uses' => 'Api\ApiInvoiceController@show']);
    Route::post('/', ['as' => 'api.invoice.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceController@store']);
});

// Invoice Item
Route::group(['prefix' => 'invoice-item', 'module' => 'INVOICE-ITEM'], function () {
    Route::post('/update', ['as' => 'api.invoice-item.update', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoiceItemController@update']);
    Route::get('/', ['as' => 'api.invoice-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoiceItemController@index']);
    Route::get('/{id}', ['as' => 'api.invoice-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoiceItemController@show']);
    Route::post('/', ['as' => 'api.invoice-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoiceItemController@store']);
    Route::delete('/{id}', ['as' => 'api.invoice-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoiceItemController@destroy']);
});

// Invoice Return
Route::group(['prefix' => 'invoice-return', 'module' => 'INVOICE-RETURN'], function () {
    Route::get('/{id}/items', ['as' => 'api.invoice-return.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiInvoiceReturnController@items']);
    Route::get('/print/{id}', ['as' => 'api.invoice-return.index', 'accessLevel' => 'print-pdf', 'uses' => 'Api\ApiInvoiceReturnController@print']);
    Route::get('/', ['as' => 'api.invoice-return.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceReturnController@index']);
    Route::post('/', ['as' => 'api.invoice-return.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiInvoiceReturnController@store']);
    Route::get('/pdf/{id}', ['as' => 'api.invoice-return.pdf', 'accessLevel' => 'PDF', 'uses' => 'Api\ApiInvoiceReturnController@createPdf']);
    Route::get('/download/{id}', ['as' => 'api.invoice-return.download', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiInvoiceReturnController@download']);
    Route::get('/{id}', ['as' => 'api.invoice-return.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiInvoiceReturnController@show']);
    Route::post('/finish-return', ['as' => 'api.invoice-return.finish-return', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiInvoiceReturnController@finishReturn']);
    Route::delete('/{id}', ['as' => 'api.invoice-return.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiInvoiceReturnController@destroy']);
});

Route::group(['prefix' => 'return-item', 'module' => 'RETURN-ITEM'], function () {
    Route::get('/get-item/{id}',  ['as' => 'api.return-item.get-item', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoiceReturnItemController@getItem']);
    Route::post('/', ['as' => 'api.return-item.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiInvoiceReturnItemController@store']);
});

//Purchase Invoice

Route::group(['prefix' => 'purchase-invoice', 'module' => 'PURCHASE-INVOICE'], function () {
    Route::get('/', ['as' => 'api.purchase-invoice.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiPurchaseInvoiceController@index']);
    Route::get('/pdf/{id}', ['as' => 'api.purchase-invoice.index', 'accessLevel' => 'PDF', 'uses' => 'Api\ApiPurchaseInvoiceController@createPdf']);
    Route::get('/items/{id}', ['as' => 'api.purchase-invoice.items', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiPurchaseInvoiceController@items']);
    Route::get('/download/{id}', ['as' => 'api.purchase-invoice.index', 'accessLevel' => 'DOWNLOAD', 'uses' => 'Api\ApiPurchaseInvoiceController@download']);
    Route::get('/invoice-number', ['as' => 'api.purchase-invoice.invoiceNumber', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiPurchaseInvoiceController@invoiceNumber']);
    Route::get('/{id}', ['as' => 'api.purchase-invoice.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiPurchaseInvoiceController@show']);
    Route::post('/', ['as' => 'api.purchase-invoice.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiPurchaseInvoiceController@store']);
    Route::delete('/{id}', ['as' => 'api.purchase-invoice.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiPurchaseInvoiceController@destroy']);
}); 

// Invoice Item
Route::group(['prefix' => 'purchase-item', 'module' => 'PURCHASE-ITEM'], function () {
    Route::get('/', ['as' => 'api.purchase-item.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiPurchaseInvoiceItemController@index']);
});

//Commission
Route::group(['prefix' => 'commission', 'module' => 'COMMISSION'], function () {
    Route::get('/', ['as' => 'api.commission.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiCommissionController@index']);
    Route::get('/{id}', ['as' => 'api.commission.index', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiCommissionController@show']);
    Route::get('/export/{id}', ['as' => 'api.commission.index', 'accessLevel' => 'EXPORT', 'uses' => 'Api\ApiCommissionController@createPdf']);
    Route::post('/', ['as' => 'api.commission.index', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiCommissionController@store']);
    Route::delete('/{id}', ['as' => 'api.commission.index', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiCommissionController@destroy']);
});

//Invoice Payment
Route::group(['prefix' => 'invoice-payment', 'module' => 'INVOICE-PAYMENT'], function () {
    Route::get('/giro-month-due', ['as' => 'api.invoice-payment.return', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@getGiroDueDateMonth']);
    Route::get('/return/{id}', ['as' => 'api.invoice-payment.return', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@getReturn']);
    Route::delete('/return/{id}', ['as' => 'api.invoice-payment.return', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@deleteReturn']);
    Route::get('/number', ['as' => 'api.invoice-payment.number', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@orderNumber']);
    Route::get('/', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@index']);
    Route::get('/export', ['as' => 'api.invoice-payment.export', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@export']);
    Route::get('/{id}', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@show']);
    Route::delete('/{id}', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@destroy']);
    Route::post('/giro', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@giro']);
    Route::post('/', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePaymentController@store']);
    Route::get('/pdf/{id}', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'view-pdf', 'uses' => 'Api\ApiInvoicePaymentController@createPdf']);
    Route::get('/download/{id}', ['as' => 'api.invoice-payment.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiInvoicePaymentController@download']);
   
});

//Invoice Piece
Route::group(['prefix' => 'invoice-piece', 'module' => 'INVOICE-PIECE'], function () {
    Route::get('/', ['as' => 'api.invoice-piece.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePieceController@index']);
    Route::get('/{id}', ['as' => 'api.invoice-piece.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePieceController@show']);
    Route::delete('/{id}', ['as' => 'api.invoice-piece.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePieceController@destroy']);
    Route::post('/', ['as' => 'api.invoice-piece.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiInvoicePieceController@store']);
});

//Sales Route
Route::group(['prefix' => 'sales-route', 'module' => 'SALES-ROUTE'], function () {
    Route::get('/', ['as' => 'api.sales-route.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesRouteController@index']);
    Route::get('/{id}', ['as' => 'api.sales-route.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesRouteController@show']);
    Route::delete('/{id}', ['as' => 'api.sales-route.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesRouteController@destroy']);
    Route::post('/', ['as' => 'api.sales-route.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiSalesRouteController@store']);
});

Route::group(['prefix' => 'log-activity', 'module' => 'LOG-ACTIVITY'], function () {
    Route::get('/', ['as' => 'api.log-activity.index', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiLogController@index']);
});

//Mutation
Route::group(['prefix' => 'mutation', 'module' => 'MUTATION'], function () {
    Route::get('/', ['as' => 'api.mutation.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiMutationController@index']);
    Route::get('/{id}', ['as' => 'api.mutation.show', 'accessLevel' => 'VIEW', 'uses' => 'Api\ApiMutationController@show']);
    Route::post('/accepted', ['as' => 'api.mutation.accepted', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiMutationController@accepted']);
    Route::post('/', ['as' => 'api.mutation.store', 'accessLevel' => 'CREATE', 'uses' => 'Api\ApiMutationController@store']);
    Route::delete('/{id}', ['as' => 'api.mutation.destroy', 'accessLevel' => 'DELETE', 'uses' => 'Api\ApiMutationController@destroy']);
});

Route::group(['prefix' => 'notification', 'module' => 'NOTIFICATION'], function () {
    Route::get('/badge', ['as' => 'api.notification.badge', 'accessLevel' => 'BYPASS', 'uses' => 'Api\ApiNotificationController@badge']);
});

//Roles
Route::group(['prefix' => 'roles', 'module' => 'ROLES'], function () {
    Route::get('/', ['as' => 'api.roles.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiRolesController@index']);
});

//Finance
Route::group(['prefix' => 'finance', 'module' => 'FINANCE'], function () {
    Route::get('/', ['as' => 'api.finance.index', 'accessLevel' => 'ACCESS', 'uses' => 'Api\ApiFinanceController@index']);
});

});
