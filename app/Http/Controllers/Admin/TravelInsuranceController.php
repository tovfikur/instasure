<?php

namespace App\Http\Controllers\Admin;

use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Exports\ImeiDownload;
use App\Model\TravelInsOrder;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TravelInsuranceOrderInfoExport;


class TravelInsuranceController extends Controller
{
    use SmsService;
    function __construct()
    {
        $this->middleware('permission:travel-insurance-orders', ['only' => ['travel_insurance_orders', 'ajax_datatable']]);
    }

    /**
     * Get list of resources
     * @return \Illuminate\Http\Response table
     */
    public function travel_insurance_orders()
    {
        $tarvelInsurances = TravelInsOrder::latest()->get();
        return view('backend.admin.travel_insurance.index', compact('tarvelInsurances'));
    }

    /**
     * Edit single resource
     * @return \Illuminate\Http\Response table
     */
    public function edit($travelInsOrder)
    {
        $model = TravelInsOrder::with(['policy_provider'])->find($travelInsOrder);
        ## Handle exception
        if (!$model) {
            Toastr::error('Invalid Request');
            return redirect()->route('admin.travel_insurance_orders');
        }
        return view('backend.admin.travel_insurance.edit', compact('model'));
    }

    /**
     * Update single resource
     * @return \Illuminate\Http\Response table
     */
    public function update(Request $request, TravelInsOrder $travelInsOrder)
    {
        $request->validate([
            'policy_certificate'    => ['sometimes', 'nullable', 'file', 'mimes:pdf'],
            'status'                => ['required'],
            'policy_number'         => ['sometimes', 'nullable', 'max:50', 'min:5'],
        ]);

        try {
            if ($request->hasFile('policy_certificate')) {
                $upload_path = "uploads/policy_certificates";
                ## Delete if already exist
                if (!empty($travelInsOrder->policy_certificate)) {

                    $file_path = public_path('/') . $travelInsOrder->policy_certificate;
                    $file_path = format_image_upload_path($file_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                ## Uploading process to store policy cetificate
                $file_to_upload = $request->file('policy_certificate');
                $filenameWithExt = $file_to_upload->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $file_to_upload->getClientOriginalExtension();
                $fileNameToStore = remove_white_spaces_dashes($filename . '-' . time() . '_' . $travelInsOrder->id . '.' . $extension);

                $path = $file_to_upload->move(public_path($upload_path), $fileNameToStore);

                ## Save policy certificate
                $travelInsOrder->policy_certificate = $upload_path . '/' . $fileNameToStore;
            }

            ## Update order info
            if (count($request->all())) {
                $travelInsOrder->status         = $request->status;
                // next line added by Tovfikur
                $travelInsOrder->payment_status = $request->payment_status;
                $travelInsOrder->policy_number  = $request->policy_number;
                $travelInsOrder->save();

                ## Send mobile sms when order is processing
                if (strtolower($request->status) == 'processing') {
                    SmsService::send_sms($travelInsOrder->phone, config('sms.SMS_TRAVEL_INSURANCE_ORDER_PROCESSING'));
                }
                Toastr::success('Updated Successfully');
            } else {
                Toastr::info('Nothing to update');
            }

            return back();
        } catch (\Throwable $th) {
            ## Error response
            Toastr::error($th->getMessage());
            return back();
        }
    }

    /**
     * Get list of resources using ajax call on model
     * @return \Illuminate\Http\Response ajax_datatablse
     */
    public function ajax_datatable()
    {
        return TravelInsOrder::ajax_datatable();
    }


    /**
     * Download or export traveller info on excel file
     * @return void
     */
    public function download_traveller_info($travelInsOrder)
    {
        $travelInsOrder = TravelInsOrder::find($travelInsOrder);
        ## Handle exception
        if (!$travelInsOrder) {
            Toastr::error('Invalid Request');
            return redirect()->route('admin.travel_insurance_orders');
        }

        return Excel::download(new TravelInsuranceOrderInfoExport($travelInsOrder), 'travel-insurance-order-info.xlsx');
    }
}
