<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Child dealer routes
|--------------------------------------------------------------------------
|
*/

Route::group(['as' => 'childDealer.', 'prefix' => 'childDealer', 'namespace' => 'ChildDealer', 'middleware' => ['auth', 'childDealer']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/parent-dealer-profile', 'ProfileController@profile')->name('parent-dealer.profile');
    Route::get('/profile', 'ProfileController@my_profile')->name('profile');
    Route::resource('travel-ins-order', 'TravelInsOrderController');
    Route::resource('device-insurance', 'DeviceInsuranceController');
    Route::get('device-insurance/select/customer', 'TravelInsOrderController@selectCustomer')->name('select-customer');

    Route::post('device-insurance/get/customer', 'DeviceInsuranceController@get_customer')->name('get_customer');
    Route::get('device-insurance/order/{id}', 'DeviceInsuranceController@getDeviceOrderDetails')->name('device-insurance.order');

    Route::get('device-insurance/imei-one/check/{imei_code}', 'DeviceInsuranceController@imeiCheckOne');
    Route::get('device-insurance/imei-two/check/{imei_code}', 'DeviceInsuranceController@imeiCheckTwo');
    Route::get('device-sale-commission-log', 'DeviceInsuranceController@deviceInsSaleHistory')->name('deviceInsSaleHistory');
    Route::get('device-insurance/pay/now/{order_id}', 'DeviceInsuranceController@payNow')->name('device-insurance.paynow');
    Route::get('device-insurance/disbursed/now/{order_id}', 'DeviceInsuranceController@disbursed')->name('device-insurance.disbursed');
    Route::post('device-insurance-getInsPrice', 'DeviceInsuranceController@getInsPrice')->name('device-insurance.getInsPrice');
    Route::post('/get/device-insurance/package', 'DeviceInsuranceController@getPackage')->name('device-insurance.package');

    Route::get('/device-insurance/create/{id}', 'DeviceInsuranceController@create')->name('device-insurances.create');

    Route::post('customer-insert', 'DashboardController@customerInsert')->name('customer-insert');

    Route::get('/device-insurance/create/{user}/otp-verification', 'DashboardController@customerOtpVerification')->name('customerOtpVerification');

    Route::post('/device-insurance/create/{user}/otp-verification', 'DashboardController@customerOtpVerificationProcess')->name('customerOtpVerificationProcess');



    ## Withdraw Request
    Route::get('/commission-withdraw-request', 'WithdrawRequestController@index')->name('device-insurance.withdraw-request');

    Route::get('/commission-withdraw-request-ajax/{type?}', 'WithdrawRequestController@commission_withdraw_request_ajax')->name('commission_withdraw_request_ajax');

    Route::get('commission-withdraw-request-edit/{insuranceWithdrawRequest}', 'WithdrawRequestController@commission_withdraw_request_edit')->name(('commission_withdraw_request_edit'));

    Route::post('commission-withdraw-request-update/{insuranceWithdrawRequest}', 'WithdrawRequestController@commission_withdraw_request_update')->name(('commission_withdraw_request_update'));


    Route::post('withdraw-request/store', 'WithdrawRequestController@requestStore')->name('withdraw-request.store');

    Route::post('device_subcategories', 'DeviceInsuranceController@getDeviceSubcategories')->name('device_subcategories');
    Route::post('device_models', 'DeviceInsuranceController@getDeviceModels')->name('device_models');
    Route::post('insurance_price_history', 'DeviceInsuranceController@insurance_price_history')->name('insurance_price_history');


    Route::post('/get-otp', 'TravelInsOrderController@getOTP')->name('get-otp');

    Route::post('/otp-store', 'TravelInsOrderController@storeOTP')->name('otp-store');

    Route::get('/travel-ins-order/create/{id}', 'TravelInsOrderController@create')->name('travel-ins-orders.create');
});
