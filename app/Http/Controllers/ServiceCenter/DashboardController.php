<?php

namespace App\Http\Controllers\ServiceCenter;


use App\Model\DeviceClaim;
use App\Model\DeviceClaimRequest;
use App\Model\ServiceCenterDetails;
use App\Http\Controllers\Controller;
use App\Model\ClaimPaymentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $auth_id  = Auth::id();
        $serviceCenter = ServiceCenterDetails::where('user_id', $auth_id)->first();
        $totalPendingReq = DeviceClaimRequest::where('sc_user_id', $auth_id)->where('status', 'pending')->count();
        $totalAcceptedReq = DeviceClaimRequest::where('sc_user_id', $auth_id)->where('status', 'accept')->count();
        $totalCanceledReq = DeviceClaimRequest::where('sc_user_id', $auth_id)->where('status', 'canceled')->count();
        $totalCompletedReq = DeviceClaimRequest::where('sc_user_id', $auth_id)->where('status', 'Claim Done')->count();

        $totalDeviceClaimProcessing = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'On Processing')->count();
        $totalDeviceClaimOnDelivered = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'On Delivered')->count();
        $totalDeviceClaimDelivered = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'Delivered')->count();
        $totalDeviceClaimComplete = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'Complete')->count();
        $totalDeviceClaimCancel = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'cancel')->count();
        $totalDeviceClaimClaimToPay = DeviceClaim::where('service_center_id', $serviceCenter->id)->where('status', 'Claim to pay')->count();

        $totalClaimPaymentRequest = ClaimPaymentRequest::where('service_center_id', $serviceCenter->id)->count();
        $totalClaimPaymentRequestPending = ClaimPaymentRequest::where('service_center_id', $serviceCenter->id)->where('status', 'pending')->count();
        $totalClaimPaymentRequestProcessing = ClaimPaymentRequest::where('service_center_id', $serviceCenter->id)->where('status', 'processing')->count();
        $totalClaimPaymentRequestPaid = ClaimPaymentRequest::where('service_center_id', $serviceCenter->id)->where('status', 'paid')->count();

        ## Device claims total amounts calculation
        $total_amounts = DeviceClaim::select(
            DB::raw('count(*) As total_claims'),
            DB::raw('SUM(total_amount) As total_claimed_amount'),
            DB::raw('SUM(settlement_amount) As total_settlement_amount'),
            DB::raw('SUM(amount_will_pay_ins_provider) As total_provider_pay_amount'),
            DB::raw('SUM(user_will_pay) As total_customer_pay_amount'),
        )
            ->where('service_center_id', $serviceCenter->id)
            ->first();

        $total_device_price = DB::table('device_claims')->select('device_insurance_id','device_value')
        ->distinct('device_insurance_id')
        ->get();

        $total_device_price = collect($total_device_price)->sum('device_value');


        return view('backend.service_center.dashboard', compact(
            'totalAcceptedReq',
            'totalPendingReq',
            'totalCanceledReq',
            'totalCompletedReq',
            'totalDeviceClaimProcessing',
            'totalDeviceClaimOnDelivered',
            'totalDeviceClaimDelivered',
            'totalDeviceClaimComplete',
            'totalDeviceClaimCancel',
            'totalDeviceClaimClaimToPay',
            'total_amounts',
            'total_device_price',
            'totalClaimPaymentRequestPending',
            'totalClaimPaymentRequest',
            'totalClaimPaymentRequestProcessing',
            'totalClaimPaymentRequestPaid',

        ));
    }
}
