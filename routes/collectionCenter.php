<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Collection Center Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['as' => 'collection_center.', 'prefix' => 'collection-center', 'namespace' => 'CollectionCenter', 'middleware' => ['auth', 'IsCollectionCenter']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'DashboardController@profile')->name('profile');
    Route::put('/profile', 'DashboardController@update_profile')->name('update_profile');

    ## Device collectin routes ##
    Route::resource('device-collection', DeviceCollectionController::class);
    Route::get('device/collection/datatable', 'DeviceCollectionController@datatable')->name('device_collection_datatable');
    Route::post('device-collection/find/device-insurance', 'DeviceCollectionController@find_device_insurance')->name('find_device_insurance');
});
