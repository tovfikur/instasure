<?php

namespace App\Http\Controllers\ParentDealer;

use App\Model\Dealer;
use Illuminate\Http\Request;
use App\Model\InsurancePrice;
use App\Model\DeviceInsurance;
use App\Model\InsurancePackage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Model\InsuranceWithdrawRequest;
use App\Model\ParentChildDealerPackage;
use App\Services\InsuranceWithdrawRequestService;

class DeviceInsuranceController extends Controller
{
    public function insurancePackage()
    {
        $parentDealer = Dealer::where('user_id', Auth::id())->first();
        $insurancePackages = InsurancePackage::where('status', 1)->where('parent_id', 0)->orWhere('parent_id', $parentDealer->id)->get();
        return view('backend.parent_dealer.device_insurances.insurance_packages', compact('parentDealer', 'insurancePackages'));
    }
    public function insurancePackageShow($id)
    {
        $package = InsurancePackage::find(decrypt($id));
        $insurancePrices = InsurancePrice::where('insurance_package_id', $package->id)->get();
        $packageChilds = DB::table("parent_child_dealer_packages")
            ->where("parent_child_dealer_packages.package_id", $package->id)
            ->pluck('parent_child_dealer_packages.child_id', 'parent_child_dealer_packages.child_id')
            ->all();
        $parentDetails = ParentChildDealerPackage::where('package_id', $package->id)->where('parent_id', $package->parent_id)->get();
        return view('backend.parent_dealer.device_insurances.insurance_package_details', compact('insurancePrices', 'package', 'parentDetails', 'packageChilds'));
    }
    public function childDealerUpdate(Request $request)
    {
        $package_id = $request->package_id;
        if (!empty($request->child_id)) {
            ParentChildDealerPackage::where('package_id', $package_id)->delete();
            foreach ($request->child_id as $child_id) {
                $parentChildPackage = new ParentChildDealerPackage();
                $parentChildPackage->package_id = $package_id;
                $parentChildPackage->parent_id = $request->parent_id;
                $parentChildPackage->child_id = $child_id;
                $parentChildPackage->save();
            }
        } else {
            Toastr::warning('Please select at least one Child Dealer!');
            return back();
        }
        Toastr::success('Child Dealer Selected Successfully');
        return redirect()->back();
    }
    public function deviceInsSaleHistory()
    {
        $parentDealer = Dealer::where('user_id', Auth::id())->first();
        $deviceInsurances = DeviceInsurance::where('parent_dealer_id', $parentDealer->id)->where('status', 'completed')->latest()->get();
        return view('backend.parent_dealer.device_insurances.sale_history', compact('deviceInsurances'));
    }
    public function getDeviceOrderDetails($id)
    {
        $deviceOrderDetails = DeviceInsurance::find($id);
        return view('backend.parent_dealer.device_insurances.price_result', compact('deviceOrderDetails'));
    }

    /**
     * Device insurance sale commissin withdraw request
     */
    public function commission_withdraw_request()
    {
        $dealer = Dealer::where('user_id', Auth::id())->first();
        $due_amount = $dealer->dealer_balance;
        $paid_by_admin = InsuranceWithdrawRequest::where('status', '=', 'paid')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');
        $received_amount = InsuranceWithdrawRequest::where('status', '=', 'received')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');
        $pending_amount = InsuranceWithdrawRequest::where('status', '=', 'pending')->where('parent_id', Auth::id())->where('user_id', '==', 0)->sum('amount');
        $paid_amount = $paid_by_admin +  $received_amount;
        $total_amount = $paid_amount +  $pending_amount;

        return view('backend.parent_dealer.device_insurances.commission_withdraw_request', compact('dealer', 'due_amount', 'paid_amount', 'pending_amount', 'received_amount', 'total_amount'));
    }

    /**
     * Store commission withdraw request
     * @param Request $request
     * @return back
     */
    public function commission_withdraw_request_store(Request $request, InsuranceWithdrawRequestService $commission_withdraw_requests)
    {
        ## Request validation
        $this->validate($request, [
            'amount' => ['required', 'min:1', 'numeric'],
            'type' => ['required'],
            'bank_name' => 'required_if:type,bank_info',
            'acc_holder_name' => 'required_if:type,bank_info',
            'account_number' => 'required_if:type,bank_info',
            'branch_name' => 'required_if:type,bank_info',
            'provider_name' => 'required_if:type,mob_banking',
            'phone' => 'required_if:type,mob_banking',
        ]);

        $dealer = Dealer::where('user_id', Auth::id())->first();
        if ($dealer->dealer_balance < $request->amount) {
            Toastr::warning('Insufficient Balance');
            return back();
        }

        ## New Insurance commission withdraw request
        if ($commission_withdraw_requests->create($request, 0, $dealer->user_id)) {
            $dealer->dealer_balance -= $request->amount;
            $dealer->save();
            Toastr::success("Request Inserted Successfully", "Success");
            return back();
        } else {
            Toastr::success("Something went wrong", "Error");
            return back();
        }
    }

    /**
     * payment request to admin list display
     *
     */
    public function commission_withdraw_request_edit(InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {
        return view('backend.parent_dealer.device_insurances.commission_withdraw_request_edit_modal', compact('insuranceWithdrawRequest'));
    }

    /**
     * payment request to admin list display
     *
     */
    public function commission_withdraw_request_update(Request $request, InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {
        if ($request->status) {
            $insuranceWithdrawRequest->status = $request->status;
            $insuranceWithdrawRequest->message = strip_tags($request->message) ?? $insuranceWithdrawRequest->message;
            if ($request->status == 'paid') {
                $insuranceWithdrawRequest->paid_date = now();
            }
            $insuranceWithdrawRequest->save();
            return response()->json(['success' => true, 'message' => 'Successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Faild']);
        }
    }


    /**
     * Device insurance sale commissin withdraw request by child to parent
     */
    public function child_commission_withdraw_request()
    {
        $dealer = Dealer::where('user_id', Auth::id())->first();
        $due_amount = InsuranceWithdrawRequest::due_amount();
        $paid_amount = InsuranceWithdrawRequest::paid_amount();
        return view('backend.parent_dealer.device_insurances.child_commission_withdraw_request', compact('dealer', 'due_amount', 'paid_amount'));
    }

    /**
     * Device insurance sale commissin withdraw request by child to parent  status update
     */
    public function child_commission_withdraw_request_edit(InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {
        return view('backend.parent_dealer.device_insurances.child_commission_withdraw_request_edit_modal', compact('insuranceWithdrawRequest'));
    }


    /**
     * Child commission withdraw request update on parent dealer
     *
     */
    public function child_commission_withdraw_request_update(Request $request, InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {

        if ($request->status) {
            $insuranceWithdrawRequest->status = $request->status;
            $insuranceWithdrawRequest->message = strip_tags($request->message) ?? $insuranceWithdrawRequest->message;
            if ($request->status == 'paid') {
                $insuranceWithdrawRequest->paid_date = now();
            }
            $insuranceWithdrawRequest->save();
            return response()->json(['success' => true, 'message' => 'Successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Faild']);
        }
    }


    /**
     * Device insurance sale commissin withdraw request by child to parent using ajax
     */
    public function child_commission_withdraw_request_ajax($activity_type = 'child_to_parent')
    {
        return InsuranceWithdrawRequest::commission_withdraw_request_ajax($activity_type);
    }
}
