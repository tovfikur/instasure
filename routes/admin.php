<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/login', 'Admin\AuthController@ShowLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\AuthController@LoginCheck')->name('admin.login.check');
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('roles', 'RoleController');
    Route::resource('parts', 'PartsController');
    Route::get('parts/upload/excel', 'PartsController@upload_excel')->name('parts.upload_excel');
    Route::post('parts/upload/excel', 'PartsController@upload_excel_post')->name('parts.upload_excel.post');
    Route::get('parts/list/ajax', 'PartsController@parts_list_ajax')->name('parts_list_ajax');
    Route::get('parts/{part}/delete', 'PartsController@delete')->name('parts_delete');
    Route::post('parts/get/brand_wise_model/ajax', 'PartsController@get_brand_wise_model_ajax')->name('parts.get_brand_wise_model_ajax');

    Route::post('/roles/permission', 'RoleController@create_permission');
    Route::resource('staffs', 'StaffController');

    Route::resource('categories', 'CategoryController');
    Route::resource('device-categories', 'DeviceCategoryController');
    Route::resource('device-subcategories', 'DeviceSubcategoryController');
    Route::resource('brands', 'BrandController');
    Route::post('brands/status-update', 'BrandController@updateStatus')->name('brands.status-update');
    Route::resource('device-models', 'DeviceModelController');
    Route::post('device-model/status-update', 'DeviceModelController@updateStatus')->name('device-model.status-update');
    Route::resource('insurance-types', 'InsuranceTypeController');
    Route::get('insurance-types/status-change/{insuranceType}', 'InsuranceTypeController@change_status')->name('insurance-types.change_status');
    Route::resource('insurance-packages', 'InsurancePackageController');
    Route::resource('parent-dealers', 'ParentDealerController');
    Route::get('parent-dealers/child-dealers/{id}', 'ParentDealerController@childDealerList')->name('parent-dealers.child-dealers');
    Route::post('parent-dealers/child-dealer-update', 'ParentDealerController@childDealerUpdate')->name('parent-dealers.child-dealer-update');
    Route::get('parent-dealers/brand-mapping/{dealer}', 'ParentDealerController@parent_dealers_brand_mapping')->name('parent_dealers_brand_mapping');
    Route::post('parent-dealers/brand-mapping', 'ParentDealerController@parent_dealers_brand_mapping_store')->name('parent_dealers_brand_mapping_store');

    Route::resource('child-dealers', 'ChildDealerController');
    Route::get('parent-dealer/withdraw-history', 'ParentDealerController@withdrawHistory')->name('parent-dealers.withdraw-history');
    Route::get('child-dealer/withdraw-history', 'ChildDealerController@withdrawHistory')->name('child-dealers.withdraw-history');
    Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');
    Route::post('categories/is_home', 'CategoryController@updateIsHome')->name('categories.is_home');
    Route::post('device_subcategories', 'InsurancePackageController@getDeviceSubcategories')->name('device_subcategories');
    Route::post('device_models', 'InsurancePackageController@getDeviceModels')->name('device_models');
    Route::post('package/status/change', 'InsurancePackageController@packageStatusChange')->name('package.status.change');
    Route::get('parentDealer/wise/child/{id}', 'InsurancePackageController@parentDealerWiseChild')->name('parent_dealer_wise_child');
    Route::post('device_insurance_type', 'InsurancePackageController@getDeviceInsuranceType')->name('device_insurance_type');
    Route::post('device_insurance_type_edit', 'InsurancePackageController@editDeviceInsuranceType')->name('device_insurance_type_edit');


    Route::resource('imei-data', 'ImeiDataController');
    Route::post('imei-data/get/parent/wise/child-dealer/ajax', 'ImeiDataController@get_parent_wise_child_dealer_ajax')->name('get_parent_wise_child_dealer_ajax');
    Route::get('imei-data/get/imei-data/list/ajax', 'ImeiDataController@get_imei_data_list_ajax')->name('get_imei_data_list_ajax');
    Route::get('imei-data/excel/download', 'ImeiDataController@download')->name('imei_data.download');
    Route::post('imei-data/excel/download', 'ImeiDataController@download_process')->name('imei_data.download_process');
    Route::get('imei-data/excel/upload/bulk', 'ImeiDataController@upload')->name('imei_data.upload');
    Route::post('imei-data/excel/upload/bulk', 'ImeiDataController@upload_process')->name('imei_data.upload_process');
    Route::get('imei-data/change/status/{imei}', 'ImeiDataController@change_status')->name('imei_data.change_status');
    Route::resource('insurance-discount', 'InsuranceDiscountController');
    Route::post('insurance-discount/status-update', 'InsuranceDiscountController@statusUpdate')->name('insurance-discount.status-update');
    Route::resource('promo-codes', 'PromoCodeController');
    Route::post('promo-codes/status-update', 'PromoCodeController@statusUpdate')->name('promo-codes.status-update');
    Route::resource('service-center', 'ServiceCenterController');

    ## Device Insurance routes
    Route::get('device-insurance-sales', 'DeviceInsuranceController@index')->name('device-insurance-sales');
    Route::get('device-insurance-sales/commission-details/{id}', 'DeviceInsuranceController@commission')->name('device-sale-commission');

    ## Travel Insurance routes
    Route::get('travel-insurance-orders', 'TravelInsuranceController@travel_insurance_orders')->name('travel_insurance_orders');
    Route::get('travel-insurance-orders/edit/{travelInsOrder}', 'TravelInsuranceController@edit')->name('travel_insurance_orders.edit');
    Route::put('travel-insurance-orders/edit/{travelInsOrder}', 'TravelInsuranceController@update')->name('travel_insurance_orders.update');
    Route::get('travel-insurance-orders/download_traveller_info/{travelInsOrder}', 'TravelInsuranceController@download_traveller_info')->name('travel_insurance_orders.download_traveller_info');

    Route::get('travel-insurance-orders/ajax-datatable', 'TravelInsuranceController@ajax_datatable')->name('travel_insurance_orders.ajax_datatable');

    Route::resource('travel-ins-plans-categories', 'TravelInsPlansCategoryController');
    Route::resource('travel-ins-plans-charts', 'TravelInsPlansChartController');
    Route::resource('policy-providers', 'PolicyProvidersController');
    //Route::resource('service-center','ServiceCenterController');

    //Business Settings
    Route::get('business/settings', 'BusinessController@index')->name('business.index');
    Route::post('business/settings/update', 'BusinessController@businessSettingsUpdate')->name('business.settings.update');

    //Sliders
    Route::resource('sliders', 'SliderController');
    //claim management.......
    Route::get('claim-management/claim-list', 'ClaimManageController@claimList')->name('insurance-claim.list');
    Route::get('/claim-details/{id}', 'ClaimManageController@ClaimDetails')->name('insurance-claim.details');
    Route::get('/claim-management/device-claim-request', 'ClaimManageController@deviceInsuranceRequests')->name('claim-management.device-claim-request');
    Route::get('/claim-management/device-lost-claim-request', 'ClaimManageController@deviceLostClaimRequests')->name('claim-management.device-lost-claim-request');
    Route::get('/claim-management/device-lost-claim-done/{id}', 'ClaimManageController@deviceLostClaimServiceDone')->name('claim-management.device-lost-claim-done');
    Route::get('/claim-requests/details/{id}', 'ClaimManageController@claimRequestDetails')->name('claim-requests-details');
    Route::post('/claim-payment-status-change', 'ClaimManageController@ClaimStatusChange')->name('claim-payment-status-change');
    Route::post('/claim-status-change', 'ClaimManageController@StatusChange')->name('claim-status-change');
    Route::post('/claim-request-status-change', 'ClaimManageController@ClaimRequestStatusChange')->name('claim-request-status-change');
    Route::get('/claim-invoice-print/{id}', 'ClaimManageController@ClaimInvoicePrint')->name('claim-invoice-print');

    //Blogs
    Route::resource('blogs', 'BlogController');
    Route::post('blog/status', 'BlogController@updateStatus')->name('blog.status');
    Route::resource('blog-categories', 'BlogCategoryController');
    Route::get('blog-categories/ajax/index', 'BlogCategoryController@index_ajax')->name('blog-categories.ajax');
    Route::get('blog-categories/{blogCategory}/delete', 'BlogCategoryController@delete')->name('blog-categories.delete');

    //Partners
    Route::resource('partners', 'PartnerController');

    Route::resource('profile', 'ProfileController');
    Route::put('password/update/{id}', 'ProfileController@updatePassword')->name('password.update');

    //Pages Settings
    Route::get('pages/settings', 'PageController@index')->name('pages.index');
    Route::post('page/data/update', 'PageController@pageDataUpdate');
    Route::post('page/editor/show', 'PageController@editorShow')->name('pages.editor.show');

    //performance
    Route::get('/config-cache', 'SystemOptimize@ConfigCache')->name('config.cache');
    Route::get('/clear-cache', 'SystemOptimize@CacheClear')->name('cache.clear');
    Route::get('/view-cache', 'SystemOptimize@ViewCache')->name('view.cache');
    Route::get('/view-clear', 'SystemOptimize@ViewClear')->name('view.clear');
    Route::get('/route-cache', 'SystemOptimize@RouteCache')->name('route.cache');
    Route::get('/route-clear', 'SystemOptimize@RouteClear')->name('route.clear');
    Route::get('/site-optimize', 'SystemOptimize@Settings')->name('site.optimize');


    ### Withdraw Payment Request ###
    Route::get('/service-charge-withdraw-request', 'PaymentRequestToAdminController@index')->name('withdraw_payment_request_from_parent_dealer');

    Route::get('/service-charge-withdraw-request/details-list-view/{id}', 'PaymentRequestToAdminController@view')->name('serviceChargeWithdrawRequestDetails');

    Route::get('/service-charge-withdraw-request/details-list-view/{paymentId}/claim-details/{claimId}', 'PaymentRequestToAdminController@claimDetails')->name('claimDetails');


    Route::get('/service-charge-withdraw-request/details-list-view/{paymentId}/claim-status-change/{claimId}', 'PaymentRequestToAdminController@claimStatusChange')->name('claimStatusChange');

    Route::post('/service-charge-withdraw-request/details-list-view/{paymentId}/claim-status-change/{claimId}', 'PaymentRequestToAdminController@claimStatusChangeProcess')->name('claimStatusChangeProcess');

    Route::get('/service-charge-withdraw-request/details-list-view/{paymentId}/claim-make-settlement/{claimId}', 'PaymentRequestToAdminController@claimMakeSettlement')->name('claimMakeSettlement');

    Route::get('/service-charge-withdraw-request/{status?}', 'PaymentRequestToAdminController@index_ajax')->name('withdraw_payment_request_from_parent_dealer_ajax');

    Route::get('/service-charge-withdraw-request/status-modal/{payment_request_admin}', 'PaymentRequestToAdminController@status_modal')->name('withdraw_payment_request_from_parent_dealer_status_modal');

    Route::post('/service-charge-withdraw-request/status-update/{payment_request_admin}', 'PaymentRequestToAdminController@status_update')->name('withdraw_payment_request_from_parent_dealer_status_update');

    Route::get('/service-charge-withdraw-request/details/{payment_request}', 'PaymentRequestToAdminController@details')->name('withdraw_payment_request_from_parent_dealer_details');

    Route::post('/service-charge-withdraw-request/partial/payment/by-admin/{device_claim}', 'PaymentRequestToAdminController@partial_payment_by_admin')->name('partial_payment_by_admin');

    Route::post('/service-charge-withdraw-request/partial/payment/by-admin/settlement-form-with-service-center/{device_claim}', 'PaymentRequestToAdminController@partial_payment_by_admin_with_settlement_form')->name('partial_payment_by_admin_with_settlement_form');

    Route::post('/service-charge-withdraw-request/partial/payment/by-admin/settlement-form-with-service-center/updaing/{device_claim}', 'PaymentRequestToAdminController@partial_payment_by_admin_with_settlement_form_updaing')->name('partial_payment_by_admin_with_settlement_form_updaing');

    Route::post('/service-charge-withdraw-request/reject-individual-claim/{payment_request_to_admin}', 'PaymentRequestToAdminController@reject_individual_claim')->name('reject_individual_claim');

    ## Users list, password change, view details routes ##
    Route::get('/users', 'DashboardController@users')->name('users');
    Route::get('/users/ajax', 'DashboardController@users_ajax')->name('users_ajax');
    Route::get('/users/{user}', 'DashboardController@user_details')->name('user_details');
    Route::get('/users/{user}/change-password', 'DashboardController@change_password')->name('change_password');
    Route::post('/users/{user}/change-password', 'DashboardController@change_password_ajax')->name('change_password_ajax');


    ## Collection center routes ##
    Route::resource('collection-center', 'CollectionCenterController');
    Route::get('collection-center/datatable/ajax', 'CollectionCenterController@collection_center_datatable')->name('collection_center_datatable');
    Route::get('collection-center/change_status/{collection_center}', 'CollectionCenterController@change_status')->name('collection-center.change_status');

    ## Commission Withdraw Request ##
    Route::get('commission-withdraw-request', 'PaymentRequestToAdminController@commission_withdraw_request')->name(('commission_withdraw_request'));
    Route::get('commission-withdraw-request-ajax', 'PaymentRequestToAdminController@commission_withdraw_request_ajax')->name(('commission_withdraw_request_ajax'));
    Route::get('commission-withdraw-request-edit/{insuranceWithdrawRequest}', 'PaymentRequestToAdminController@commission_withdraw_request_edit')->name(('commission_withdraw_request_edit'));
    Route::post('commission-withdraw-request-edit/{insuranceWithdrawRequest}', 'PaymentRequestToAdminController@commission_withdraw_request_update')->name(('commission_withdraw_request_update'));


    ## Parent Due Balance ##
    Route::get('parent-due-balance', 'PaymentRequestToAdminController@parent_due_balance')->name(('parent_due_balance'));
    Route::get('parent-due-balance-ajax', 'PaymentRequestToAdminController@parent_due_balance_ajax')->name(('parent_due_balance_ajax'));
    Route::get('due-balance-collection', 'PaymentRequestToAdminController@due_balance_collection')->name(('due_balance_collection'));
    Route::get('due-balance-collection-ajax', 'PaymentRequestToAdminController@due_balance_collection_ajax')->name(('due_balance_collection_ajax'));
    Route::get('due-balance-collection-create', 'PaymentRequestToAdminController@due_balance_collection_create')->name(('due_balance_collection_create'));
    Route::post('due-balance-collection-store', 'PaymentRequestToAdminController@due_balance_collection_store')->name(('due_balance_collection_store'));

    ## Reports ##

    Route::group(['as' => 'reports.', 'prefix' => 'reports'], function () {
        Route::get('device-insurance-sales', 'AdminReportsController@device_insurance_sales')->name(('device_insurance_sales'));
        Route::post('device-insurance-sales', 'AdminReportsController@device_insurance_sales_download')->name(('device_insurance_sales_download'));
        Route::get('mobile-diagnosis-report', 'AdminReportsController@mobile_diagnosis_report')->name(('mobile_diagnosis_report'));
        Route::get('mobile_diagnosis_report_ajax', 'AdminReportsController@mobile_diagnosis_report_ajax')->name(('mobile_diagnosis_report_ajax'));
        Route::get('mobile-diagnosis-report-edit/{id}', 'AdminReportsController@mobile_diagnosis_report_edit')->name(('mobile_diagnosis_report_edit'));
        Route::post('mobile-diagnosis-report-edit/{model}', 'AdminReportsController@mobile_diagnosis_report_update')->name(('mobile_diagnosis_report_update'));
    });
});
