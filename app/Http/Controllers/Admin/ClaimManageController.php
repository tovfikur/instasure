<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeviceClaim;
use App\Model\DeviceClaimedPart;
use App\Model\DeviceClaimRequest;
use App\Model\DeviceInsurance;
use App\Model\DeviceInsuranceDetails;
use App\Model\ServiceCenterDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimManageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:claim-list', ['only' => ['claimList']]);
        $this->middleware('permission:claim-details', ['only' => ['ClaimDetails']]);
        $this->middleware('permission:claim-device-insurance-request', ['only' => ['deviceInsuranceRequests']]);
        $this->middleware('permission:claim-status-change', ['only' => ['StatusChange']]);
        $this->middleware('permission:claim-request-status-change', ['only' => ['ClaimRequestStatusChange']]);
        $this->middleware('permission:claim-invoice-print', ['only' => ['ClaimInvoicePrint']]);
        $this->middleware('permission:claim-request-details', ['only' => ['claimRequestDetails']]);
        $this->middleware('permission:claim-device-lost-service-done', ['only' => ['deviceLostClaimServiceDone']]);
    }

    public function claimList()
    {
        $deviceClaims = DeviceClaim::latest()->get();
        return view('backend.admin.insurance_claim.claim_list', compact('deviceClaims'));
    }
    public function ClaimDetails($id)
    {
        $deviceClaim = DeviceClaim::find($id);
        $deviceClaimDetails = DeviceClaimedPart::where('device_claim_id', $deviceClaim->id)->get();
        $insurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
        $details = DeviceInsuranceDetails::where('device_insurance_id', $insurance->id)->where('claim_status', 1)->get();
        return view('backend.admin.insurance_claim.claim_details', compact('deviceClaim', 'deviceClaimDetails', 'insurance', 'details'));
    }
    public function deviceInsuranceRequests()
    {
        $claimRequests = DeviceClaimRequest::where('claim_type', '!=', 'Lost')->latest()->get();
        return view('backend.admin.insurance_claim.claim_request_list', compact('claimRequests'));
    }
    public function StatusChange(Request $request)
    {
        $claim  = DeviceClaim::find($request->claim_id);
        $claim->status_admin = $request->status;
        if ($request->status_note) {
            $claim->status_note = $request->status_note;
        }
        $claim->save();
        Toastr::success('Successfull');
        return back();
    }
    public function ClaimRequestStatusChange(Request $request)
    {
        $claim  = DeviceClaimRequest::find($request->request_id);
        $claim->status = $request->status;
        $claim->status_note = $request->status_note;
        $claim->save();
        Toastr::success('Status Success changed!');
        return back();
    }
    public function ClaimInvoicePrint($id)
    {
        $deviceClaim = DeviceClaim::find($id);
        $serviceCenter = ServiceCenterDetails::find($deviceClaim->service_center_id);
        $deviceInsurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
        return view('backend.service_center.insurance_claim.claim_invoice', compact('deviceInsurance', 'serviceCenter', 'deviceClaim'));
    }

    public function claimRequestDetails($id)
    {
        $requestsClaim = DeviceClaimRequest::find($id);
        $deviceInfo = json_decode($requestsClaim->deviceInsurance->device_info);
        $response = array();
        $response['customer_name'] = $requestsClaim->user->name;
        $response['customer_phone'] = $requestsClaim->user->phone;
        $response['device_name'] = $deviceInfo->device_name;
        $response['brand_name'] = $deviceInfo->brand_name;
        $response['model_name'] = $deviceInfo->model_name;
        $response['device_price'] = $deviceInfo->device_price;
        $response['pick_up_status'] = $requestsClaim->pick_up_status;
        $response['status'] = $requestsClaim->status;
        $response['status_note'] = $requestsClaim->status_note;
        $response['claim_note'] = $requestsClaim->claim_note;
        $response['documents'] = json_decode($requestsClaim->document);
        return response()->json(['response' => $response]);
    }
    public function deviceLostClaimRequests()
    {
        $claimRequests = DeviceClaimRequest::where('claim_type', 'Lost')->latest()->get();
        return view('backend.admin.insurance_claim.lost_claim_request_list', compact('claimRequests'));
    }

    public function deviceLostClaimServiceDone($id)
    {
        $request = DeviceClaimRequest::find($id);
        $details = DeviceInsuranceDetails::where('device_insurance_id', $request->device_insurance_id)->where('parts_type', 'Lost')->first();
        // dd($details);
        if (!empty($details)) {
            $details->claim_status = 0;
            $details->claim_amount = 0;
            $details->save();
            $request->status = 'Claim Done';
            $request->save();
            return response()->json(['response' => 1]);
        } else {
            return response()->json(['response' => 0]);
        }
    }
}
