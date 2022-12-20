<?php

namespace App\Http\Controllers\ParentDealer;

use App\Http\Controllers\Controller;
use App\Model\ClaimPaymentRequest;
use App\Model\Dealer;
use App\Model\PaymentRequestToAdmin;
use App\Model\PaymentRequestToAdminDetail;
use App\Model\InsuranceWithdrawRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WithdrawRequestController extends Controller
{

    /**
     * Payment request made by service center
     * Return ClaimPaymentRequest list
     */
    public function index(Request $request, $status = 'pending')
    {

        $data['display_length'] = $request->display_length ?? 10;
        $data['date_from'] = $request->date_from ?? 0;
        $data['date_to'] = $request->date_to ?? 0;
        $data['claim_id'] = $request->claim_id ?? 0;
        $data['is_display_query_values'] = false;
        $data['request_status'] = $status;
        if ($data['date_from'] || $data['date_to'] || $data['claim_id']) {
            $data['is_display_query_values'] = true;
        }

        return view('backend.parent_dealer.withdraw_request.index', $data);
    }


    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxWithdrawRequest($date_from = null, $date_to = null, $claim_id = null, $request_status = '')
    {
        return ClaimPaymentRequest::ajaxWithdrawRequest($date_from, $date_to, $claim_id, $request_status);
    }



    /**
     * payment request to admin list display
     *
     */
    public function payment_request_to_admin_list(Request $request)
    {

        $status = $request->status ?? 'pending';
        return view('backend.parent_dealer.withdraw_request.payment_request_to_admin_list', compact('status'));
    }


    /**
     * payment request to admin list display
     *
     * Return response list of payment request to admin by ajax to datatables
     */
    public function payment_request_to_admin_list_ajax($status)
    {
        return PaymentRequestToAdmin::payment_request_to_admin_ajax($status, 'parent');
    }


    /**
     * Parent dealer withdraw request details
     *
     */
    public function withdraw_request_details($id)
    {
        $claimPaymentRequest =  ClaimPaymentRequest::with(['claim_payment_request_details.device_claims.user', 'claim_payment_request_details.device_claims.device_claimed_parts'])->where('id', $id)->first();
        $claim_payment_request_details = $claimPaymentRequest->claim_payment_request_details;
        return view('backend.parent_dealer.withdraw_request.withdraw_request_details', compact('claim_payment_request_details'));
    }


    /**
     * Parent dealer withdraw request status
     *
     */
    public function change_request_status($id)
    {
        return view('backend.parent_dealer.withdraw_request.change_request_status', compact('id'));
    }

    /**
     * Parent dealer withdraw request status udpate
     *
     */
    public function change_request_status_update(Request $request, ClaimPaymentRequest $claim_request)
    {
        $claim_request->status = $request->status;
        $claim_request->save();
        return redirect()->back();
    }


    /**
     * Payment request to admin from parent dealer
     * Returns response json
     */
    public function payment_request_to_admin_ajax(Request $request)
    {

        $grand_total = ClaimPaymentRequest::whereIn('id', $request->request_ids)->sum('total_amount');

        $inputs_payemnt_requst_to_admin['grand_total']      = $grand_total;
        $inputs_payemnt_requst_to_admin['requests_id']      = 'PRTA-' . mt_rand(11111111, 99999999);
        $inputs_payemnt_requst_to_admin['status']           = 'pending';

        $new_payemnt_request_to_admin = PaymentRequestToAdmin::create($inputs_payemnt_requst_to_admin);


        if ($new_payemnt_request_to_admin) {
            $this->payment_request_to_admin_details_create($new_payemnt_request_to_admin, $request->request_ids);
            ClaimPaymentRequest::whereIn('id', $request->request_ids)->update(['status' => 'processing']);
            return response()->json(['status' => 200, 'message' => 'Your payment request to admin has sent successfully']);
        }
        return response()->json(['status' => 400, 'message' => 'Invalid Request']);
    }

    /**
     * Payment request to admin from parent dealer
     * Returns new PaymentRequestToAdminDetails
     */

    private function payment_request_to_admin_details_create(PaymentRequestToAdmin $payemnt_request_to_admin, $service_center_request_ids)
    {
        foreach ($service_center_request_ids as $id) {
            PaymentRequestToAdminDetail::create(['payment_request_to_admin_id' => $payemnt_request_to_admin->id, 'claim_payment_request_id' => $id]);
        }
    }

    /**
     * Parent dealer request store
     *
     */
    public function requestStore(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required'
        ]);
        $parentDealer = Dealer::where('user_id', Auth::id())->first();
        if ($parentDealer->dealer_balance < $request->amount) {
            Toastr::warning('Insufficient Balance');
            return back();
        }
        $insuranceWithdrawRequest = new InsuranceWithdrawRequest();
        $insuranceWithdrawRequest->user_id = Auth::id();
        $insuranceWithdrawRequest->amount = $request->amount;
        $insuranceWithdrawRequest->trx = getTrx();
        if ($request->type == 'bank_info') {
            $bankInfo['type'] = $request->type;
            $bankInfo['bank_name'] = $request->bank_name;
            $bankInfo['acc_holder_name'] = $request->acc_holder_name;
            $bankInfo['account_number'] = $request->account_number;
            $bankInfo['branch_name'] = $request->branch_name;
            $bankInfo['routing_number'] = $request->routing_number;

            $insuranceWithdrawRequest->withdraw_infos = json_encode($bankInfo);
        }
        if ($request->type == 'mob_banking') {
            $MobileBanking['type'] = $request->type;
            $MobileBanking['provider_name'] = $request->provider_name;
            $MobileBanking['phone'] = $request->phone;
            $insuranceWithdrawRequest->withdraw_infos = json_encode($MobileBanking);
        }
        $insuranceWithdrawRequest->message = $request->message;
        $insuranceWithdrawRequest->save();
        $parentDealer->dealer_balance -= $request->amount;
        $parentDealer->save();
        Toastr::success("Request Inserted Successfully", "Success");
        return back();
    }
    public function payment_request_to_admin_details(Request $request, PaymentRequestToAdmin $payment_request)
    {
        $payment_request_to_admin = PaymentRequestToAdmin::with(['payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.device_claimed_parts', 'payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.user'])->where('id', $payment_request->id)->first();

        return view('backend.parent_dealer.withdraw_request.payment_request_to_admin_details', compact('payment_request_to_admin'));
    }
}
