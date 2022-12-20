<?php

namespace App\Http\Controllers\ChildDealer;

use App\Model\Dealer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Model\InsuranceWithdrawRequest;
use App\Services\InsuranceWithdrawRequestService;

class WithdrawRequestController extends Controller
{
    /**
     * Commission withdraw request list
     * @return view
     */
    public function index()
    {
        $childDealer = Dealer::where('user_id', Auth::id())->first();
        $commission_withdraw_requests = InsuranceWithdrawRequest::where('user_id', Auth::id())->latest()->get();
        $due_amount = $childDealer->dealer_balance;
        $paid_by_parent = InsuranceWithdrawRequest::where('status', '=', 'paid')->where('user_id', Auth::id())->sum('amount');
        $received_amount = InsuranceWithdrawRequest::where('status', '=', 'received')->where('user_id', Auth::id())->sum('amount');
        $pending_amount = InsuranceWithdrawRequest::where('status', '=', 'pending')->where('user_id', Auth::id())->sum('amount');
        $paid_amount = $paid_by_parent +  $received_amount;
        $total_amount = $paid_amount +  $pending_amount;

        return view('backend.child_dealer.withdraw_request.index', compact('childDealer', 'due_amount', 'paid_by_parent', 'received_amount', 'pending_amount', 'paid_amount', 'total_amount'));
    }


    /**
     * Device insurance sale commissin withdraw request by child to parent using ajax
     * @param string activity_type
     */
    public function commission_withdraw_request_ajax($activity_type = 'child_to_parent')
    {
        return InsuranceWithdrawRequest::commission_withdraw_request_ajax($activity_type);
    }


    /**
     * Child commission withdraw request update modal display
     * @param InsuranceWithdrawRequest
     * @return View view
     */
    public function commission_withdraw_request_edit(InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {
        return view('backend.child_dealer.withdraw_request.commission_withdraw_request_edit_modal', compact('insuranceWithdrawRequest'));
    }

    /**
     * Child commission withdraw request status update
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\InsuranceWithdrawRequest $insuranceWithdrawRequest
     * @return View view
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
     * Store commission withdraw request
     * @param Request $request
     * @return back
     */
    public function requestStore(Request $request, InsuranceWithdrawRequestService $commission_withdraw_requests)
    {
        ## Request validation
        $this->validate($request, [
            'amount' => ['required', 'min:1', 'numeric'],
            'type' => ['required'],
            'bank_name' => 'required_if:type,bank_info',
            'acc_holder_name' => 'required_if:type,bank_info',
            'account_number' => 'required_if:type,bank_info',
            'provider_name' => 'required_if:type,mob_banking',
            'phone' => 'required_if:type,mob_banking',
        ]);

        $childDealer = Dealer::with(['parent'])->where('user_id', Auth::id())->first();
        if ($childDealer->dealer_balance < $request->amount) {
            Toastr::warning('Insufficient Balance');
            return back();
        }

        ## New Insurance commission withdraw request
        if ($commission_withdraw_requests->create($request, $childDealer->user_id, $childDealer->parent->user_id)) {
            $childDealer->dealer_balance   -= $request->amount;
            $childDealer->save();
            ## Find & update parent dealer balance
            $childDealer->parent->dealer_balance += $request->amount;
            $childDealer->parent->save();
            Toastr::success("Request Inserted Successfully", "Success");
            return back();
        } else {
            Toastr::success("Something went wrong", "Error");
            return back();
        }
    }
}
