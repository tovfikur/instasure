<?php

namespace App\Http\Controllers\ServiceCenter;

use PDF;

use App\User;
use App\Model\DeviceClaim;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Model\DeviceInsurance;
use App\Model\DeviceClaimedPart;
use App\Mail\InvoiceEmailManager;
use App\Model\DeviceClaimRequest;
use App\Model\ClaimPaymentRequest;
use App\Model\ServiceCenterDetails;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Model\DeviceInsuranceDetails;
use App\Model\ClaimPaymentRequestDetails;

class InsuranceClaimController extends Controller
{
    public function claimRequests()
    {
        $requests = DeviceClaimRequest::where('sc_user_id', Auth::id())->latest()->get();
        return view('backend.service_center.insurance_claim.claim_requests', compact('requests'));
    }

    /**
     * Policy serarch form
     * @return View view
     */
    public function policySearch()
    {
        return view('backend.service_center.insurance_claim.policy_search');
    }

    /**
     * Policy serarch submit
     * @param \Illuminate\Http\Request $request
     * @return View view
     */
    public function policySearchSubmit(Request $request)
    {
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->first();
        $insurance = DeviceInsurance::with(['device_claims', 'parent.brands'])->where('status', 'completed')->where('parent_dealer_id', $serviceCenter->parent_id)->where('policy_number', $request->search_value)->orWhere('imei_one', $request->search_value)->first();

        if (!$insurance) {
            Toastr::warning('No match found');
            return redirect()->back();
        }
        ## Retrive parent brands
        $brandMatch = false;
        $insuranceBrand =  strtolower(json_decode($insurance->device_info)->brand_name);
        foreach ($insurance->parent->brands as $brand) {
            if (strtolower($brand->name) ==  $insuranceBrand) {
                $brandMatch = true;
            }
        }

        if (!$insurance ||  $brandMatch == false) {
            Toastr::warning('No match found');
            return redirect()->back();
        }

        $details = DeviceInsuranceDetails::where('device_insurance_id', $insurance->id)->where('claim_status', 1)->get();
        $lostCheck = DeviceInsuranceDetails::where('device_insurance_id', $insurance->id)->where('parts_type', 'Lost')->where('claim_status', 1)->first();

        return view('backend.service_center.insurance_claim.device_insurance_details', compact('insurance', 'details', 'lostCheck'));
    }

    /**
     * Insurance claim form
     * @param DeviceInsurance $id
     * @return response view
     */
    public function insuranceClaimForm($id)
    {
        $insurance = DeviceInsurance::find($id);
        if (!$insurance) {
            Toastr::error('Invalid request');
            return redirect()->route('serviceCenter.policy-search');
        }
        $details = DeviceInsuranceDetails::where('device_insurance_id', $insurance->id)->where('parts_type', '!=', 'Lost')->where('claim_status', 1)->get();

        return view('backend.service_center.insurance_claim.claim_form', compact('insurance', 'details'));
    }

    /**
     * Insurance claim form
     * @param DeviceInsurance $id
     * @return response view
     */
    public function insuranceClaimEdit($id)
    {

        $service_center = ServiceCenterDetails::where('user_id', Auth::id())->first();
        $deviceClaim = DeviceClaim::where('service_center_id', $service_center->id)->where('status_admin', '<>', 'approved')->find($id);

        if (!$deviceClaim) {
            Toastr::error('Invalid request');
            return redirect()->route('serviceCenter.insurance-claim.list');
        }

        $deviceClaimedPartsList = DeviceClaimedPart::where('device_claim_id', $deviceClaim->id)->get()->toArray();
        $deviceClaimedParts = [];
        foreach ($deviceClaimedPartsList as $parts) {
            $deviceClaimedParts[strtolower($parts['parts_name'])] = $parts;
        }


        $deviceInsurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
        // $deviceInsuranceDetails = DeviceInsuranceDetails::where('device_insurance_id', $deviceInsurance->id)->where('parts_type', '!=', 'Lost')->where('claim_status', 1)->get();
        $deviceInsuranceDetails = DeviceInsuranceDetails::where('device_insurance_id', $deviceInsurance->id)->where('parts_type', '!=', 'Lost')->get();


        $deviceInfo = json_decode($deviceInsurance->device_info);

        return view('backend.service_center.insurance_claim.claim_form_edit', compact('deviceClaim', 'deviceClaimedParts', 'deviceInsurance', 'deviceInsuranceDetails', 'deviceInfo'));
    }


    public function protectionCheck($id)
    {
        $details = DeviceInsuranceDetails::find($id);
        return response()->json(['response' => $details]);
    }
    public function claimSubmit(Request $request)
    {
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->first();
        $deviceInsurance = DeviceInsurance::find($request->device_insurance_id);
        $deviceClaim = new DeviceClaim();
        $deviceClaim->user_id = $deviceInsurance->user_id;
        $deviceClaim->device_insurance_id = $request->device_insurance_id;
        $deviceClaim->service_center_id = $serviceCenter->id;
        if ($deviceInsurance->customer_will_pay_charge == 1) {
            $deviceClaim->amount_will_pay_ins_provider = $request->total_amount - userWillPay($request->total_amount);
            $deviceClaim->user_will_pay = userWillPay($request->total_amount);
        } else {
            $deviceClaim->amount_will_pay_ins_provider = $request->total_amount;
            $deviceClaim->user_will_pay = 0;
        }

        $deviceClaim->device_value = $request->device_value;
        $deviceClaim->total_amount = $request->total_amount;
        $deviceClaim->status = 'pending';
        $deviceClaim->claim_id = 'CL-' . mt_rand(111111, 999999);
        $attachments = array();
        $images = $request->file('document');
        if (isset($images)) {
            foreach ($images as $image) {
                if (isset($image)) {
                    $imagename = imageUpload($image, '/uploads/claim/document/', 0);
                } else {
                    $imagename = [];
                }
                array_push($attachments, $imagename);
            }
            $deviceClaim->document = json_encode($attachments);
        }
        if ($deviceClaim->save()) {
            if ($request->parts_name) {
                for ($i = 0; $i < count($request->parts_name); $i++) {
                    $deviceClaimParts = new DeviceClaimedPart();
                    $deviceClaimParts->device_claim_id = $deviceClaim->id;
                    $deviceClaimParts->device_insurance_id = $deviceInsurance->id;
                    $deviceClaimParts->parts_name = $request->parts_name[$i];
                    $deviceClaimParts->parts_identity_number = $request->parts_identity_number[$i];
                    $deviceClaimParts->parts_price = $request->parts_price[$i];
                    $deviceClaimParts->parts_details = $request->parts_details[$i];
                    $deviceClaimParts->status = 'pending';
                    $deviceClaimParts->save();
                }
            }
        }
        $details = DeviceInsuranceDetails::find($request->deviceInsuranceDetails_id);
        if ($details->parts_type == 'Screen Protection') {
            if ($details->protection_times_for > 0) {
                $details->protection_times_for = $details->protection_times_for - 1;
                $details->save();
                if ($details->protection_times_for == 0) {
                    $details->claim_status = 0;
                    $details->save();
                }
            }
        } elseif ($details->parts_type == 'Damage') {
            if ($details->claim_amount > 0) {
                $details->claim_amount = $details->claim_amount - $request->total_amount;
                $details->save();
                if ($details->claim_amount == 0) {
                    $details->claim_status = 0;
                    $details->save();
                }
            }
        }
        $deviceClaimUpdate =  DeviceClaim::find($deviceClaim->id);
        $deviceClaimUpdate->claim_on = $details->parts_type;
        $deviceClaimUpdate->save();
        Toastr::success('Claim Successfully applied! Please wait until approval!');

        return redirect()->route('serviceCenter.insurance-claim.details', $deviceClaim->id);
    }
    /**
     * Device insurace claim details
     * @param DeviceClaim $id
     * @return response view
     */
    public function ClaimDetails($id)
    {
        $service_center = ServiceCenterDetails::where('user_id', Auth::id())->first();

        $deviceClaim = DeviceClaim::where('service_center_id', $service_center->id)->find($id);

        if (!$deviceClaim) {
            Toastr::error('Invalid request');
            return redirect()->route('serviceCenter.insurance-claim.list');
        }
        $deviceClaimDetails = DeviceClaimedPart::where('device_claim_id', $deviceClaim->id)->get();
        $claim_on  = $deviceClaim->claim_on;
        $insurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
        $details = DeviceInsuranceDetails::where('device_insurance_id', $insurance->id)->where('parts_type', $claim_on)->first();

        return view('backend.service_center.insurance_claim.claim_details', compact('deviceClaim', 'deviceClaimDetails', 'insurance', 'details'));
    }
    /**
     * Claim list
     */
    public function claimList()
    {
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->pluck('id')->first();
        $deviceClaims = DeviceClaim::with(['device_insurance'])->where('service_center_id', $serviceCenter)->where('status', 'pending')->orWhere('status', 'cancel')->latest()->get();
        return view('backend.service_center.insurance_claim.claim_list', compact('serviceCenter', 'deviceClaims'));
    }

    public function claimOnProcessingList()
    {
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->pluck('id')->first();
        $deviceClaims = DeviceClaim::where('service_center_id', $serviceCenter)->where('status', 'On Processing')->latest()->get();
        return view('backend.service_center.insurance_claim.claim_on_processing_list', compact('serviceCenter', 'deviceClaims'));
    }
    public function claimOnDeliveredList()
    {
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->pluck('id')->first();
        $deviceClaims = DeviceClaim::where('service_center_id', $serviceCenter)->where('status', 'On Delivered')->latest()->get();
        return view('backend.service_center.insurance_claim.claim_on_delivered_list', compact('serviceCenter', 'deviceClaims'));
    }

    public function claimDelivered(Request $request)
    {

        $page = $request->page;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->pluck('id')->first();
        $deviceClaimsObj = DeviceClaim::where('service_center_id', $serviceCenter)->where('status', 'Delivered');
        if ($request->search != null) {
            $deviceClaimsObj->where('claim_id', 'LIKE', '%' . $request->search . '%');
        }
        if ($dateFrom != null) {
            $deviceClaimsObj->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo != null) {
            $deviceClaimsObj->whereDate('created_at', '<=', $dateTo);
        }

        $deviceClaims = $deviceClaimsObj->latest()->get();

        return view('backend.service_center.insurance_claim.delivered_claim_list', compact('serviceCenter', 'deviceClaims'));
    }

    public function ClaimStatusChange(Request $request)
    {
        $claim  = DeviceClaim::find($request->claim_id);
        $claim->payment_status = $request->payment_status;
        $claim->payment_details = $request->payment_details;
        $claim->save();
        if ($request->ajax()) {
            Toastr::success('Payment successful');
            return response()->json(['success' => true, 'redirect_to' => route('serviceCenter.insurance-claim.list'), 'message' => 'Paid successfully']);
        }

        Toastr::success('Payment Status Success changed!');
        return back();
    }
    /**
     * Change claim status
     * @param Request $request
     */
    public function StatusChange(Request $request)
    {

        $claim  = DeviceClaim::with(['user', 'device_insurance'])->find($request->claim_id);
        $claim->status = $request->status;
        $claim->status_note = $request->status_note;
        try {

            $claim->save();
            ## Send sms on mobile
            $message = config('sms.SMS_API_FAILED');
            $status = strtolower($request->status);
            if ($status == 'on processing') {
                $message =  config('sms.SMS_API_CLAIM_PROCESSING');
            } elseif ($status == 'on delivered') {
                $message =  config('sms.SMS_API_CLAIM_READY_TO_DELIVER');
            } elseif ($status == 'delivered') {
                $message =  config('sms.SMS_API_CLAIM_DELIVERED');
            } elseif ($status == 'cancel') {
                $message =  config('sms.SMS_API_CLAIM_CANCELED');

                ## Update device insurace claimable amount and claimed amount
                if ($claim->device_insurance->claimed_amount > 0) {
                    $claim->device_insurance->claimed_amount -= $claim->total_amount;
                }
                if ($claim->device_insurance->claimable_amount < $claim->device_value) {
                    $claim->device_insurance->claimable_amount += $claim->total_amount;
                }

                $claim->device_insurance->save();
                $sms_output  = SmsService::send_sms($claim->user->phone, $message);
                Toastr::error('Claim canceled and sms sent to ' . $claim->user->phone);
                return back();
            } else {
                $message =  config('sms.SMS_API_FAILED');
            }
            $sms_output  = SmsService::send_sms($claim->user->phone, $message);
            Toastr::success('Claim status updated successfully and sms sent to ' . $claim->user->phone);
            return back();
        } catch (\Throwable $e) {
            Toastr::error('Something went wrong ' . $e->getMessage());
            return back();
        }
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
        return response()->json(['response' => $response]);
    }
    public function insuranceLostClaimForm($id)
    {
        $insurance = DeviceInsurance::find($id);
        $details = DeviceInsuranceDetails::where('device_insurance_id', $insurance->id)->where('parts_type', 'Lost')->where('claim_status', 1)->get();
        return view('backend.service_center.insurance_claim.lost_claim_form', compact('insurance', 'details'));
    }
    public function lostClaimSubmit(Request $request)
    {
        $claimRequest = new DeviceClaimRequest();
        $claimRequest->user_id = $request->user_id;
        $claimRequest->device_insurance_id = $request->device_insurance_id;
        $claimRequest->claim_note = $request->claim_note;
        $claimRequest->claim_type = "Lost";
        $claimRequest->sc_user_id = Auth::id();
        $attachments = array();
        $images = $request->file('document');
        if (isset($images)) {
            foreach ($images as $image) {
                if (isset($image)) {
                    $imagename = imageUpload($image, 'uploads/claim/document/', 0);
                } else {
                    $imagename = [];
                }
                array_push($attachments, $imagename);
            }
            $claimRequest->document = json_encode($attachments);
        }
        $claimRequest->save();
        Toastr::success('Request successfully sent');
        return redirect()->route('serviceCenter.claim-requests');
    }

    /**
     * Claim payment request to parent from service center against claim list
     * @param \Illuminate\Http\Request $request
     * @return null
     */

    public function requestToPaymentFromParent(Request $request)
    {
        try {
            if ($request->select_action_type != null && isset($request->claim_ids)) {
                ## Find service center details
                $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->first();

                ## Create and save new claim payment request
                $claimPaymentRequest = new ClaimPaymentRequest();
                $claimPaymentRequest->parent_dealer_id = $serviceCenter->parent_id;
                $claimPaymentRequest->service_center_id = $serviceCenter->id;
                $claimPaymentRequest->requestId = 'CPRTP-' . mt_rand(11111111, 99999999);
                $claimPaymentRequest->save();
                $total = 0;

                ## Loop through all selected claims
                foreach ($request->claim_ids as $cliamId) {
                    ## Find device claim
                    $claim = DeviceClaim::find($cliamId);

                    ## Create new claim payment request details and save
                    $claimPaymentRequestDetails = new ClaimPaymentRequestDetails();
                    $claimPaymentRequestDetails->claim_id = $cliamId;
                    $claimPaymentRequestDetails->claim_payment_requests_id = $claimPaymentRequest->id;
                    $claimPaymentRequestDetails->save();

                    ## Calcualte total amount will be paid by insurance provider
                    $total += $claim->amount_will_pay_ins_provider;

                    ## Change claim status and update
                    $claim->status = 'claim to pay';
                    $claim->save();
                }

                ## Find claim payment request and update total amount
                $claimPaymentRequestUpdate = ClaimPaymentRequest::find($claimPaymentRequest->id);
                $claimPaymentRequestUpdate->total_amount = $total;
                $claimPaymentRequestUpdate->save();
                Toastr::success('Your request successfully sent!');
                return back();
            } else {
                Toastr::warning('Please select an action type and claims');
                return back();
            }
        } catch (\Throwable $th) {
            Toastr::warning($th->getMessage());
            return back();
        }
    }

    public function claimPaymentRequestList()
    {
        $serviceCenter = ServiceCenterDetails::where('user_id', Auth::id())->first();
        // $claimPaymentRequest =  ClaimPaymentRequest::where('service_center_id', $serviceCenter->id)->where('status', 'pending')->latest()->get();
        $claimPaymentRequest =  ClaimPaymentRequest::where('service_center_id', $serviceCenter->id)->get();
        return view('backend.service_center.insurance_claim.claim_requests_to_payment', compact('claimPaymentRequest'));
    }
    public function claimPaymentRequestDetails($id)
    {
        $claimPaymentRequest =  ClaimPaymentRequest::with([
            'claim_payment_request_details.device_claims.user',
            'claim_payment_request_details.device_claims.device_insurance',
            'claim_payment_request_details.device_claims.device_claimed_parts'
        ])->where('id', $id)->first();
        if (!$claimPaymentRequest) {
            Toastr::error('Invalid request');
            return redirect()->route('serviceCenter.insurance-claim.claimPaymentRequestList');
        }

        $claim_payment_request_details = $claimPaymentRequest->claim_payment_request_details;

        $final_settlement_amount = 0;

        foreach ($claim_payment_request_details as  $claim_payment_request_detail_item) {
            $final_settlement_amount += $claim_payment_request_detail_item->device_claims->settlement_amount;
        }

        return view('backend.service_center.insurance_claim.claim_requests_to_payment_details', compact('claim_payment_request_details', 'claimPaymentRequest', 'final_settlement_amount'));
    }
}
