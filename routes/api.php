<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

## Register Routes

Route::post('/register', 'Api\AuthApiController@register');

Route::post('/opt_verification', 'Api\AuthApiController@opt_verification');

Route::post('/login', 'Api\AuthApiController@login');
Route::post('/phone_number_check', 'Api\AuthApiController@phone_number_check');
Route::post('/reset_password', 'Api\AuthApiController@reset_password');

Route::get('/firebase/test', 'Api\FirebaseController@showAll');


Route::middleware('auth:api')->group(function () {

    ## Customer routes

    Route::post('/logout', 'Api\AuthApiController@logout');

    Route::get('/customer_dashboard', 'Api\CustomerDashboardApiController@customer_dashboard');

    Route::get('/customer_profile', 'Api\CustomerDashboardApiController@customer_profile');

    Route::post('/customer_profile_update', 'Api\CustomerDashboardApiController@customer_profile_update');

    Route::post('/customer_password_update', 'Api\CustomerDashboardApiController@customer_password_update');

    Route::get('/travel_insurance_purchase_history', 'Api\CustomerDashboardApiController@travel_insurance_purchase_history');

    Route::get('/travel_insurance_purchase_details/{id}', 'Api\CustomerDashboardApiController@travel_insurance_purchase_details');

    Route::get('/travel_insurance_policy_certificate/{id}', 'Api\CustomerDashboardApiController@travel_insurance_policy_certificate');

    Route::get('/travel_insurance_invoice/{id}', 'Api\CustomerDashboardApiController@travel_insurance_invoice');

    Route::get('/device_insurance_history', 'Api\CustomerDashboardApiController@device_insurance_history');

    Route::get('/device_insurance_details/{id}', 'Api\CustomerDashboardApiController@device_insurance_details');

    Route::get('/device_insurance_support_history', 'Api\CustomerDashboardApiController@device_insurance_support_history');

    Route::post('/device_insurance_support_request_form', 'Api\CustomerDashboardApiController@device_insurance_support_request_form');

    Route::post('/device_insurance_support_request_store', 'Api\CustomerDashboardApiController@device_insurance_support_request_store');

    Route::post('/device_insurance_support_request_store_for_lost', 'Api\CustomerDashboardApiController@device_insurance_support_request_store');

    Route::post('get_district_by_division', 'AddressController@getDistrict')->name('get_district_by_division');

    Route::post('get_upazila_by_district', 'AddressController@getUpazila')->name('get_upazila_by_district');

    Route::post('/get_service_center', 'Api\CustomerDashboardApiController@get_service_center')->name('user.get_service_center');

    Route::get('/device_insurance_claim_history', 'Api\CustomerDashboardApiController@device_insurance_claim_history');

    Route::get('/device_claim_details/{id}', 'Api\CustomerDashboardApiController@device_claim_details');

    Route::get('/device_claim_details_download/{id}', 'Api\CustomerDashboardApiController@device_claim_details_download');

    Route::post('/get_travel_ins_plan_category', 'Api\CustomerDashboardApiController@get_travel_ins_plan_category');

    Route::post('/get_travel_inc_plan_chart_with_provider', 'Api\CustomerDashboardApiController@get_travel_inc_plan_chart_with_provider');

    Route::post('/travel_insurance_order_create', 'Api\CustomerDashboardApiController@travel_insurance_order_create');

    Route::post('/pay_now', 'Api\CustomerDashboardApiController@pay_now');

    Route::post('/mobile_diagnosis_report_store', 'Api\CustomerDashboardApiController@mobile_diagnosis_report_store');

    Route::get('/mobile_diagnosis_report_list', 'Api\CustomerDashboardApiController@mobile_diagnosis_report_list');

    Route::get('/mobile_diagnosis_report_details/{serialNumber}', 'Api\CustomerDashboardApiController@mobile_diagnosis_report_details');

    Route::get('/get_device_insurance_package/{mobileDiagnosisId}', 'Api\CustomerDashboardApiController@get_device_insurance_package');

    Route::post('/purchase_device_insurance_package/{mobileDiagnosisId}', 'Api\CustomerDashboardApiController@purchase_device_insurance_package');

    Route::get('/get_device_insurance_purchase_details/{deviceInsurance}', 'Api\CustomerDashboardApiController@get_device_insurance_purchase_details');

    Route::get('/pay_now_for_device_insurance_purchase/{deviceInsurance}', 'Api\CustomerDashboardApiController@pay_now_for_device_insurance_purchase');

    Route::post('/aamarpay_success_response', 'Frontend\PaymentController@aamrPaySuccess');

    // Route::post('/aamarpay_cancle_response', 'Frontend\PaymentController@aamrPaycancel');





    ## Child dealer routes

    Route::group(['prefix' => 'child_dealer'], function () {
        Route::get('/dashboard', 'Api\ChildDealerApiController@dashboard');

        Route::get('/profile', 'Api\ChildDealerApiController@profile');

        Route::get('/parent_profile', 'Api\ChildDealerApiController@parent_profile');

        #### Device Insurance Sale Routes
        Route::get('/device_insurance_list', 'Api\ChildDealerApiController@device_insurance_list');

        Route::get('/device_insurance_details/{id}', 'Api\ChildDealerApiController@device_insurance_details');

        Route::post('/get_customer_info', 'Api\ChildDealerApiController@get_customer_info');

        Route::get('/device_insurance_create_form/{customer}', 'Api\ChildDealerApiController@device_insurance_create_form');

        Route::get('/get_brand_wise_models/{brand}', 'Api\ChildDealerApiController@get_brand_wise_models');

        Route::post('/get_device_insurance_package', 'Api\ChildDealerApiController@get_device_insurance_package');

        Route::post('/sale_device_insurance', 'Api\ChildDealerApiController@sale_device_insurance');

        Route::get('/get_device_insurance_sale_details/{deviceInsurance}', 'Api\ChildDealerApiController@get_device_insurance_sale_details');

        Route::get('/pay_now_for_device_insurance_sale/{deviceInsurance}', 'Api\ChildDealerApiController@pay_now_for_device_insurance_sale');


        #### Customer routes
        Route::post('/add_new_customer', 'Api\ChildDealerApiController@add_new_customer');
        Route::post('/store_new_csutomer', 'Api\ChildDealerApiController@store_new_csutomer');


        #### Device Insurance Commission Routes
        Route::get('/device_insurance_commission_log', 'Api\ChildDealerApiController@device_insurance_commission_log');

        Route::get('/commission_withdraw_request_list', 'Api\ChildDealerApiController@commission_withdraw_request_list');

        Route::get('/commission_withdraw_request_edit/{insuranceWithdrawRequest}', 'Api\ChildDealerApiController@commission_withdraw_request_edit');

        Route::post('/commission_withdraw_request_update/{insuranceWithdrawRequest}', 'Api\ChildDealerApiController@commission_withdraw_request_update');

        Route::post('/make_a_child_commission_withdraw_request', 'Api\ChildDealerApiController@make_a_child_commission_withdraw_request');

        Route::post('/make_a_child_commission_withdraw_request', 'Api\ChildDealerApiController@make_a_child_commission_withdraw_request');
    });

    ## Parent dealer routes

    Route::group(['prefix' => 'parent_dealer'], function () {
        Route::get('/dashboard', 'Api\ParentDealerApiController@dashboard');

        Route::get('/profile', 'Api\ParentDealerApiController@profile');

        Route::get('/child_dealer_list', 'Api\ParentDealerApiController@child_dealer_list');

        Route::get('/child_dealer_details/{id}', 'Api\ParentDealerApiController@child_dealer_details');

        Route::get('/insurance_package_list', 'Api\ParentDealerApiController@insurance_package_list');

        Route::get('/insurance_package_details/{id}', 'Api\ParentDealerApiController@insurance_package_details');

        Route::get('/device_sale_commission_log_of_parent', 'Api\ParentDealerApiController@device_sale_commission_log_of_parent');

        Route::get('/device_insurance_details/{id}', 'Api\ParentDealerApiController@device_insurance_details');

        Route::get('/device_insurance_invoice/{id}', 'Api\ParentDealerApiController@device_insurance_invoice');

        Route::get('/device_insurance_policy_certificate/{id}', 'Api\ParentDealerApiController@device_insurance_policy_certificate');

        #### Child commission withdraw request

        Route::get('/child_commission_withdraw_request', 'Api\ParentDealerApiController@child_commission_withdraw_request');

        Route::get('/child_commission_withdraw_request_edit/{id}', 'Api\ParentDealerApiController@child_commission_withdraw_request_edit');

        Route::post('/child_commission_withdraw_request_update', 'Api\ParentDealerApiController@child_commission_withdraw_request_update');

        #### Parent commission withdraw request

        Route::get('/parent_commission_withdraw_request_list', 'Api\ParentDealerApiController@parent_commission_withdraw_request_list')->name('parent_commission_withdraw_request_list');

        Route::post('/parent_commission_make_withdraw_request', 'Api\ParentDealerApiController@parent_commission_make_withdraw_request')->name('parent_commission_make_withdraw_request');

        Route::get('/parent_commission_withdraw_request_edit/{insuranceWithdrawRequest}', 'Api\ParentDealerApiController@parent_commission_withdraw_request_edit')->name('parent_commission_withdraw_request_edit');

        Route::post('/parent_commission_withdraw_request_update/{insuranceWithdrawRequest}', 'Api\ParentDealerApiController@parent_commission_withdraw_request_update')->name('parent_commission_withdraw_request_update');

        ## Service Center Withdraw Request Routes
        Route::get('/srvice_center_withdraw_request', 'Api\ParentDealerApiController@srvice_center_withdraw_request');

        Route::get('/srvice_center_withdraw_request_details/{claimPaymentRequest}', 'Api\ParentDealerApiController@srvice_center_withdraw_request_details');

        Route::post('/srvice_center_withdraw_request_status_change/{claimPaymentRequest}', 'Api\ParentDealerApiController@srvice_center_withdraw_request_status_change');

        Route::post('/payment_request_to_admin', 'Api\ParentDealerApiController@payment_request_to_admin');
    });
});
