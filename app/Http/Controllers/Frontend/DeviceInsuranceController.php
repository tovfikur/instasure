<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\DeviceClaim;
use App\Model\DeviceClaimRequest;
use App\Model\DeviceInsurance;
use App\Model\DeviceInsuranceDetails;
use App\Model\ServiceCenterDetails;
use PDF;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceInsuranceController extends Controller
{
    public function deviceInsuranceHistory()
    {
        $deviceInsurances = DeviceInsurance::where('user_id', Auth::id())->latest()->paginate(6);
        return view('frontend.pages.device_insurance_history', compact('deviceInsurances'));
    }
    /**
     * Device insurace details on customer panel
     * @param DeviceInsurance $id
     * @return View
     */

    public function deviceInsuranceDetails($id)
    {
        $deviceInsurance = DeviceInsurance::find(decrypt($id));
        $deviceInsuranceDetails = DeviceInsuranceDetails::where('device_insurance_id', $deviceInsurance->id)->where('claim_status', 1)->get();
        return view('frontend.pages.device_insurance_details', compact('deviceInsurance', 'deviceInsuranceDetails'));
    }

    public function deviceInsClaim(Request $request)
    {

        $deviceInsurance = DeviceInsurance::find($request->device_insurance_id);
        $serviceCenters = [];
        $claimType = $request->claim_type;
        return view('frontend.pages.device_insurance_claim_form', compact('deviceInsurance', 'serviceCenters', 'claimType'));
    }

    public function deviceInsClaimDetails($id)
    {
        try {
            $deviceClaim = DeviceClaim::find(decrypt($id));
            ## Device claim exception
            if (!$deviceClaim) {
                Toastr::error('Device claim not found');
                return back();
            }
            $serviceCenter = ServiceCenterDetails::find($deviceClaim->service_center_id);
            ## Service center exception
            if (!$serviceCenter) {
                Toastr::error('Service center not found');
                return back();
            }
            $deviceInsurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
            ## Device insurance exception
            if (!$deviceInsurance) {
                Toastr::error('Device insurance not found');
                return back();
            }

            return view('frontend.pages.insurance_claim_details', compact('deviceClaim', 'serviceCenter', 'deviceInsurance'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
            return back();
        }
    }

    public function deviceInsClaimDetailsPrint($id)
    {
        $deviceClaim = DeviceClaim::find(decrypt($id));
        $serviceCenter = ServiceCenterDetails::find($deviceClaim->service_center_id);
        $deviceInsurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
        return view('frontend.pages.claim_invoice_print', compact('deviceClaim', 'serviceCenter', 'deviceInsurance'));
    }
    public function deviceInsClaimDetailsDownload($id)
    {

        $deviceClaim = DeviceClaim::find(decrypt($id));
        $serviceCenter = ServiceCenterDetails::find($deviceClaim->service_center_id);

        $deviceInsurance = DeviceInsurance::find($deviceClaim->device_insurance_id);
        if (!$deviceInsurance) {
            Toastr::error('Invalid request');
            return redirect()->route('user.insuranceClaimHistory');
        }
        return view('frontend.pages.claim_invoice_download', compact('deviceClaim', 'serviceCenter', 'deviceInsurance'));
    }

    public function getServiceCenter(Request $request)
    {
        $deviceInsurance = DeviceInsurance::find($request->device_insurance_id);
        $serviceCenters = ServiceCenterDetails::where('division_id', $request->division_id)
            ->where('district_id', $request->district_id)
            ->where('upazila_id', $request->upazila_id)
            ->latest()
            ->get();
        $default_address = BusinessSetting::where('type', 'default_address')->first();
        return view('frontend.pages.service_center_list', compact('serviceCenters', 'deviceInsurance', 'default_address'));
    }

    public function insuranceClaimRequestStore(Request $request)
    {

        $claimRequest = new DeviceClaimRequest();
        if (strtolower($request->claim_type) != 'theft') {
            $this->validate($request, [
                'sc_user_id' => 'required',
                'pick_up_status' => 'required',
            ]);
        }
        if (strtolower($request->claim_type) == 'theft') {
            $this->validate($request, [
                'device_insurance_id' => 'required',
                'claim_type' => 'required',
                'claim_note' => 'required|max:500',
                'document' => ['required', 'array'],
                'document.*' => ['image', 'mimes:png,jpg,jpeg', 'max:4096'],
            ]);

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
        }

        $claimRequest->user_id = Auth::id();
        $claimRequest->device_insurance_id = $request->device_insurance_id;
        $claimRequest->sc_user_id = $request->sc_user_id;
        $claimRequest->pick_up_status = $request->pick_up_status;
        $claimRequest->claim_note = $request->claim_note;
        $claimRequest->claim_type = $request->claim_type;
        $claimRequest->save();
        Toastr::success('Request successfully send');

        return redirect()->route('user.dashboard');
    }

    /**
     * Customer device insurance service request
     * @return View
     */

    public function support_tickets()
    {
        $claimRequests = DeviceClaimRequest::with(['service_center', 'deviceInsurance'])->where('user_id', Auth::id())->latest()->get();
        return view('frontend.pages.device_insurance_claim_requests', compact('claimRequests'));
    }
}
