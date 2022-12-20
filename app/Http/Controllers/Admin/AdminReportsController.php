<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Model\Dealer;
use App\Model\ImeiData;
use Illuminate\Http\Request;
use App\Model\DeviceInsurance;
use App\Model\MobileDiagnosis;
use App\Services\FirebaseService;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminSalesReportExport;


class AdminReportsController extends Controller
{
    /**
     * Constructor method
     */
    function __construct()
    {
        // $this->middleware('permission:payment-request-to-admin-list', ['only' => ['index', 'index_ajax']]);
        // $this->middleware('permission:payment-request-to-admin-details', ['only' => ['details']]);
        // $this->middleware('permission:payment-request-to-admin-update-status', ['only' => ['status_update', 'status_modal']]);
    }

    /**
     * Device insurance sales report filter form
     * @return \Illuminate\Http\Response
     */
    public function device_insurance_sales(Request $request)
    {

        $deviceInsurance = DeviceInsurance::with('childDealer')->select('child_dealer_id')->groupBy('child_dealer_id')->get();

        return view('backend.admin.reports.device_insurance_sale', compact('deviceInsurance'));
    }


    /**
     * Device insurance sales report download process
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function device_insurance_sales_download(Request $request)
    {

        $start_date                 = $request->start_date . ' 00:00:01';
        $end_date                   = $request->end_date . ' 23:59:59';
        $child_dealer_id            = $request->child_dealer_id;

        try {
            return Excel::download(new AdminSalesReportExport($start_date, $end_date, $child_dealer_id), 'admin_sales_report.xlsx');
            Toastr::success('Successful');
        } catch (\Throwable $th) {
            Toastr::error('Something went wrong');
        }
        return back();
    }


    /**
     * Mobile diagnosis report list
     * @return \Illuminate\Http\Response view
     */
    public function mobile_diagnosis_report()
    {
        $mobileDiagnosis = MobileDiagnosis::get();

        return view('backend.admin.reports.mobile_diagnosis_report.index', compact('mobileDiagnosis'));
    }

    /**
     * Mobile diagnosis report list using ajax call
     * @return \Illuminate\Http\Response view
     */

    public function mobile_diagnosis_report_ajax()
    {
        return MobileDiagnosis::mobile_diagnosis_report_ajax();
    }


    /**
     * Mobile diagnosis report item edit
     * @return \Illuminate\Http\Response view
     */

    public function mobile_diagnosis_report_edit($id)
    {
        $mobileDiagnosis        = MobileDiagnosis::with(['customer', 'model.brand', 'imei'])->find($id);
        $childDealers           = Dealer::where(['user_type' => 'child_dealer', 'active' => 1])->get();
        $data['model']          = $mobileDiagnosis;
        $data['childDealers']   = $childDealers;

        return view('backend.admin.reports.mobile_diagnosis_report.edit', $data);
    }


    /**
     * Mobile diagnosis report item update
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\MobileDiagnosis $model
     * @return \Illuminate\Http\Response json
     */

    public function mobile_diagnosis_report_update(Request $request, MobileDiagnosis $model)
    {

        try {
            $table_name = 'device_info';

            ## Find or create IMEI data
            if (isset($request->imei_1)) {
                $imeiData                       = ImeiData::firstOrNew(
                    ['imei_1'                   => $request->imei_1],
                    [
                        'imei_2'                => $request->imei_2,
                        'parent_id'             => 0,
                        'is_used'               => 0,
                        'status'                => 1
                    ]
                );
                $imeiData->save();
                $model->imei_data_id            = $imeiData->id;
            }

            ## Update MobileDiagnosis
            $model->status                      = $request->status;
            $model->note                        = $request->note;
            $model->dealer_id                   = $request->dealer_id;
            if ($request->status == 'approved') {
                $model->validity_period         = Carbon::now()->addMinutes(60);
            }
            if ($model->save()) {

                ## Update to firebase
                $device_info = $model->only(['id', 'user_id', 'serial_number', 'price', 'status', 'validity_period']);
                FirebaseService::create_or_update($table_name, $device_info);
            }

            ## Success response
            return response()->json(['success' => true, 'message' => "Updated successfully"]);
        } catch (\Throwable $th) {
            ## Failed response
            return response()->json(['success' => false, 'message' => "Update failed"]);
        }
    }
}
