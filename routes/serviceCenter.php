<?php

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'serviceCenter.', 'prefix' => 'serviceCenter', 'namespace' => 'ServiceCenter', 'middleware' => ['auth', 'serviceCenter']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/policy-search', 'InsuranceClaimController@policySearch')->name('policy-search');
    Route::post('/policy-search/device-insurance-details', 'InsuranceClaimController@policySearchSubmit')->name('policy-search-submit');

    ## Insurance claim form
    Route::get('/insurance-claim-form/{id}', 'InsuranceClaimController@insuranceClaimForm')->name('insurance-claim-form');


    Route::post('/insurance-claim-form/submit', 'InsuranceClaimController@claimSubmit')->name('insurance-claim-form.claimSubmit');



    Route::get('/insurance-lost-claim-form/{id}', 'InsuranceClaimController@insuranceLostClaimForm')->name('insurance-lost-claim-form');
    Route::post('/insurance-lost-claim-form/submit', 'InsuranceClaimController@lostClaimSubmit')->name('insurance-lost-claim-form.claimSubmit');
    Route::get('/insurance-protection_check/{id}', 'InsuranceClaimController@protectionCheck')->name('insurance-claim-form.protection_check');

    Route::get('/claim-list', 'InsuranceClaimController@ClaimList')->name('insurance-claim.list');
    Route::get('/claim-list/{id}', 'InsuranceClaimController@ClaimDetails')->name('insurance-claim.details');

    Route::get('/claim-list/{id}/edit', 'InsuranceClaimController@insuranceClaimEdit')->name('insuranceClaimEdit');

    Route::get('/claim-on-processing', 'InsuranceClaimController@claimOnProcessingList')->name('insurance-claim.list.processing');
    Route::get('/claim-on-delivered', 'InsuranceClaimController@claimOnDeliveredList')->name('insurance-claim.list.on-delivered');


    Route::get('/claim-delivered', 'InsuranceClaimController@claimDelivered')->name('insurance-claim.list.delivered');


    Route::post('/claim/requestToPaymentFromParent', 'InsuranceClaimController@requestToPaymentFromParent')->name('insurance-claim.requestToPaymentFromParent');

    Route::get('/claim/claim-payment-request-list', 'InsuranceClaimController@claimPaymentRequestList')->name('insurance-claim.claimPaymentRequestList');

    Route::get('/claim/claim-payment-request-list/{id}', 'InsuranceClaimController@claimPaymentRequestDetails')->name('insurance-claim.claimPaymentRequestDetails');

    Route::get('/claim-requests', 'InsuranceClaimController@claimRequests')->name('claim-requests');
    Route::get('/claim-requests/details/{id}', 'InsuranceClaimController@claimRequestDetails')->name('claim-requests-details');
    Route::post('/claim-payment-status-change', 'InsuranceClaimController@ClaimStatusChange')->name('claim-payment-status-change');
    Route::post('/claim-status-change', 'InsuranceClaimController@StatusChange')->name('claim-status-change');
    Route::post('/claim-request-status-change', 'InsuranceClaimController@ClaimRequestStatusChange')->name('claim-request-status-change');
    Route::get('/claim-invoice-print/{id}', 'InsuranceClaimController@ClaimInvoicePrint')->name('claim-invoice-print');
});
