<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeviceClaimRequest;
use App\Model\DeviceInsurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceInsuranceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:device-insurance-sale-list', ['only' => ['index']]);
        $this->middleware('permission:device-insurance-sale-commission', ['only' => ['commission']]);
    }
    public function index()
    {
        $deviceInsurances = DeviceInsurance::with(['parent'])->latest()->get();
        return view('backend.admin.device_insurance_sale.index', compact('deviceInsurances'));
    }
    public function commission($id)
    {
        $deviceOrderDetails = DeviceInsurance::find($id);
        return view('backend.admin.device_insurance_sale.commission_details', compact('deviceOrderDetails'));
    }
}
