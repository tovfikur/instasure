<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:business-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:business-edit', ['only' => ['businessSettingsUpdate']]);
    }
    public function index()
    {

        $vat = BusinessSetting::where('type', 'vat')->first();
        $commissionType = BusinessSetting::where('type', 'commission_type')->first();
        $serviceCharge = BusinessSetting::where('type', 'service_charge')->first();
        $parentDealerCommission = BusinessSetting::where('type', 'parent_dealer_commission')->first();
        $childDealerCommission = BusinessSetting::where('type', 'child_dealer_commission')->first();
        $default_address = BusinessSetting::where('type', 'default_address')->first();
        $collection_center_commission = BusinessSetting::where('type', 'collection_center_commission')->first();

        return view('backend.admin.business.index', compact(
            'vat',
            'serviceCharge',
            'commissionType',
            'parentDealerCommission',
            'childDealerCommission',
            'default_address',
            'collection_center_commission'
        ));
    }

    public function businessSettingsUpdate(Request $request)
    {
        $firstOrderValue = BusinessSetting::find($request->id);
        $firstOrderValue->value = $request->value;
        $firstOrderValue->save();
        if (!empty($firstOrderValue)) {
            return 1;
        } else {
            return 0;
        }
    }
}
