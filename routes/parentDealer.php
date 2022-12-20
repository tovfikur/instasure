<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'parentDealer.', 'prefix' => 'parentDealer', 'namespace' => 'ParentDealer', 'middleware' => ['auth', 'parentDealer']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::get('/profile', 'DashboardController@profile')->name('profile');

    Route::resource('child-dealers', 'ChildDealerController');
    Route::get('/insurance-packages', 'DeviceInsuranceController@insurancePackage')->name('insurance-packages');
    Route::get('/insurance-packages/show/{id}', 'DeviceInsuranceController@insurancePackageShow')->name('insurance-packages.show');
    Route::post('insurance-packages/child-dealer-update', 'DeviceInsuranceController@childDealerUpdate')->name('insurance-packages.child-dealer-update');
    Route::get('device-sale-commission-log', 'DeviceInsuranceController@deviceInsSaleHistory')->name('deviceInsSaleHistory');
    Route::get('device-insurance/order/{id}', 'DeviceInsuranceController@getDeviceOrderDetails')->name('device-insurance.order');

    ## Service Charge Withdraw Request ##
    Route::get('/device-insurance/withdraw-request/{status?}', 'WithdrawRequestController@index')->name('device-insurance.withdraw-request');
    Route::get('/device-insurance/withdraw-request/ajax/{from?}/{to?}/{clain_id?}/{status?}', 'WithdrawRequestController@ajaxWithdrawRequest')->name('device-insurance.withdraw-request.ajax');
    Route::post('withdraw-request/store', 'WithdrawRequestController@requestStore')->name('withdraw-request.store');

    Route::get('/device-insurance/withdraw-request/details/{id}', 'WithdrawRequestController@withdraw_request_details')->name('device-insurance.withdraw-request.withdraw_request_details');

    Route::get('/device-insurance/withdraw-request/{id}/change-request-status', 'WithdrawRequestController@change_request_status')->name('device-insurance.withdraw-request.change_request_status');
    Route::post('/device-insurance/withdraw-request/{claim_request}/change-request-status', 'WithdrawRequestController@change_request_status_update')->name('device-insurance.withdraw-request.change_request_status_update');

    Route::post('/device-insurance/withdraw-request/advance-search', 'WithdrawRequestController@advance_search')->name('device-insurance.withdraw-request.advance_search');

    Route::post('/device-insurance/withdraw-request/to-admin-by-ajax', 'WithdrawRequestController@payment_request_to_admin_ajax')->name('device_insurance_withdraw_request_to_admin_using_ajax_by_parent_dealer');

    Route::get('/device-insurance/payment-request-to-admin', 'WithdrawRequestController@payment_request_to_admin_list')->name('device_insurance_withdraw_request_to_admin_list');

    Route::get('/device-insurance/payment-request-to-admin/{payment_request}', 'WithdrawRequestController@payment_request_to_admin_details')->name('device_insurance_withdraw_request_to_admin_details');

    Route::get('/device-insurance/payment-request-to-admin/list-ajax/{status?}', 'WithdrawRequestController@payment_request_to_admin_list_ajax')->name('device_insurance_withdraw_request_to_admin_list_ajax');

    ## Commission withdraw request

    Route::get('/commission-withdraw-request', 'DeviceInsuranceController@commission_withdraw_request')->name('commission_withdraw_request');

    Route::post('/commission-withdraw-request-store', 'DeviceInsuranceController@commission_withdraw_request_store')->name('commission_withdraw_request_store');

    Route::get('commission-withdraw-request-edit/{insuranceWithdrawRequest}', 'DeviceInsuranceController@commission_withdraw_request_edit')->name(('commission_withdraw_request_edit'));

    Route::post('commission-withdraw-request-update/{insuranceWithdrawRequest}', 'DeviceInsuranceController@commission_withdraw_request_update')->name(('commission_withdraw_request_update'));

    Route::get('/child-commission-withdraw-request', 'DeviceInsuranceController@child_commission_withdraw_request')->name('child_commission_withdraw_request');

    Route::get('child-commission-withdraw-request-edit/{insuranceWithdrawRequest}', 'DeviceInsuranceController@child_commission_withdraw_request_edit')->name(('child_commission_withdraw_request_edit'));

    Route::post('child-commission-withdraw-request-update/{insuranceWithdrawRequest}', 'DeviceInsuranceController@child_commission_withdraw_request_update')->name(('child_commission_withdraw_request_update'));

    Route::get('child-commission-withdraw-request-ajax/{type?}', 'DeviceInsuranceController@child_commission_withdraw_request_ajax')->name(('child_commission_withdraw_request_ajax'));
});
