<?php

namespace App\Http\Controllers\CollectionCenter;

use App\Http\Controllers\Controller;
use App\Model\DeviceCollection;
use App\Model\DeviceInsurance;
use App\User;
use Illuminate\Http\Request;

class DeviceCollectionController extends Controller
{
    /**
     * Display all device collections
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.collection_center.device_collection.index');
    }
    /**
     * Device collections datatable using ajax call
     * @return response datatable
     */

    public function datatable()
    {
        return DeviceCollection::datatable();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.collection_center.device_collection.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Find device insurance
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find_device_insurance(Request $request)
    {
        // $user = User::withCount(['device_insurance'])->where(['phone' => $request->search_value])->first();
        // if ($request->search_type == 'policy') {
        //     $device_insurance = DeviceInsurance::where(['policy_number' => $request->search_value])->first();
        // } elseif ($request->search_type == 'imei') {
        //     $device_insurance = DeviceInsurance::where(['imei_one' => $request->search_value])->first();
        // } else {
        //     $user = User::withCount(['device_insurance'])->where(['phone' => $request->search_value])->first();
        // }
        return response()->json(['data' =>  $request['search_value']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceCollection  $deviceCollection
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceCollection $deviceCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceCollection  $deviceCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceCollection $deviceCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceCollection  $deviceCollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceCollection $deviceCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceCollection  $deviceCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceCollection $deviceCollection)
    {
        //
    }
}
