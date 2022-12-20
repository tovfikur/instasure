<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Model\Dealer;
use App\Model\Message;
use App\Model\DeviceClaim;
use Illuminate\Http\Request;
use App\Model\ClaimPaymentRequest;
use App\Model\DueBalanceCollection;
use App\Model\ServiceCenterDetails;
use App\Http\Controllers\Controller;
use App\Model\PaymentRequestToAdmin;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Model\InsuranceWithdrawRequest;
use Illuminate\Support\Facades\Storage;
use App\Model\PaymentRequestToAdminDetail;
use App\Http\Requests\DueBalanceCollectionStoreRequest;


class PaymentRequestToAdminController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:payment-request-to-admin-list', ['only' => ['index', 'index_ajax']]);
        $this->middleware('permission:payment-request-to-admin-details', ['only' => ['details']]);
        $this->middleware('permission:payment-request-to-admin-update-status', ['only' => ['status_update', 'status_modal']]);
    }

    /**
     * payment request to admin list display
     *
     */
    public function index(Request $request)
    {

        $status = $request->status ?? 'pending';
        return view('backend.admin.payment_request_to_admin.index', compact('status'));
    }


    /**
     * payment request to admin list display     *
     * Return response list of payment request to admin by ajax to datatables
     */
    public function index_ajax($status)
    {

        return PaymentRequestToAdmin::payment_request_to_admin_ajax($status);
    }

    /**
     * Parent dealer withdraw request status
     *
     */
    public function status_modal(PaymentRequestToAdmin $payment_request_admin)
    {
        $id = $payment_request_admin->id;
        $status = $payment_request_admin->status;
        return view('backend.admin.payment_request_to_admin.status_modal', compact('id', 'status', 'payment_request_admin'));
    }

    /**
     * Parent dealer withdraw request status udpate
     *
     */
    public function status_update(Request $request, PaymentRequestToAdmin $payment_request_admin)
    {
        $payment_request_admin =  PaymentRequestToAdmin::with(['payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.device_claimed_parts', 'payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.user'])->where('id', $payment_request_admin->id)->first();
        $payment_request_admin->status = $request->status;
        $payment_request_admin->save();

        ## Create and update status
        foreach ($payment_request_admin->payment_request_to_admin_details as $details) {
            if ($request->status == 'paid') {
                $details->claim_payment_requests()->update(['status' => 'paid']);
                foreach ($payment_request_admin->payment_request_to_admin_details as  $payment_request_to_admin_details) {
                    foreach ($payment_request_to_admin_details->claim_payment_requests->claim_payment_request_details as $claim_payment_request_details) {

                        $claim_payment_request_details->device_claims->settlement_amount = $claim_payment_request_details->device_claims->settlement_amount ? $claim_payment_request_details->device_claims->settlement_amount :
                            $claim_payment_request_details->device_claims->amount_will_pay_ins_provider;

                        $claim_payment_request_details->device_claims->status = 'paid';
                        $claim_payment_request_details->device_claims->save();
                    }
                }
                // dd('done');
            } else {
                $details->claim_payment_requests()->update(['status' => 'processing']);
            }
        }
        if ($request->message != false) {
            $payment_request_admin->message()->create(['message' => $request->message]);
        }
        return redirect()->back();
    }

    /**
     * Parent dealer withdraw request details
     *
     */
    public function details(Request $request, PaymentRequestToAdmin $payment_request)
    {

        $payment_request_to_admin = PaymentRequestToAdmin::with(['payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.device_claimed_parts', 'payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.user'])->where('id', $payment_request->id)->first();
        $settlement_amount = 0;
        if (!$payment_request_to_admin) {
            Toastr::error('Invalid request');
            return redirect()->route('admin.withdraw_payment_request_from_parent_dealer');
        }

        foreach ($payment_request_to_admin->payment_request_to_admin_details as  $payment_request_to_admin_details) {
            foreach ($payment_request_to_admin_details->claim_payment_requests->claim_payment_request_details as $claim_payment_request_details) {
                $settlement_amount += $claim_payment_request_details->device_claims->settlement_amount;
            }
        }

        return view('backend.admin.payment_request_to_admin.details', compact('payment_request_to_admin', 'settlement_amount'));
    }


    /**
     * Admin can partially pay for individual device claims
     * @param Request $request
     * @param DeviceClaim $device_claim
     * @return Response json
     */
    public function partial_payment_by_admin(Request $request, DeviceClaim $device_claim)
    {
        $device_claim->settlement_amount = $request->settlement_amount;
        $device_claim->status = 'approved';
        try {
            $device_claim->save();
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Approved']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'status' => 201, 'message' => 'Failed']);
        }
    }

    /**
     * Admin can partially pay for individual device claims
     * @param DeviceClaim $device_claim
     * @return Response view
     */
    public function partial_payment_by_admin_with_settlement_form(DeviceClaim $device_claim)
    {

        $service_center = ServiceCenterDetails::find($device_claim->service_center_id);
        return view('backend.admin.payment_request_to_admin.partial_payment_by_admin_with_settlement_form', compact('device_claim', 'service_center'));
    }
    /**
     * Admin can partially pay service center for individual device claims with sattlement
     * @param DeviceClaim $device_claim
     * @return Response json
     */
    public function partial_payment_by_admin_with_settlement_form_updaing(Request $request, DeviceClaim $device_claim)
    {

        $device_claim->settlement_amount        = $request->settlement_amount;
        $device_claim->status_note              = $request->status_note;
        try {
            $device_claim->save();
            return response()->json(['success' => true, 'message' => 'Successful']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Faild or query error']);
        }
    }
    /**
     * Admin can reject individual claim with message
     * @param Request $request
     * @param DeviceClaim $device_claim
     * @return Response modalView
     */
    public function reject_individual_claim(Request $request, PaymentRequestToAdmin $payment_request_to_admin)
    {
        $device_claim_id = $request->device_claim_id;
        $claim_payment_request_id = $request->claim_payment_request_id;

        $payment_request_to_admin = PaymentRequestToAdmin::with(['payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims'])->find($payment_request_to_admin->id);

        try {
            $payment_request_to_admin->status = 'rejected';
            $payment_request_to_admin->save();

            ## Find device claim and update status to rejected

            $device_claim = DeviceClaim::find($device_claim_id);
            $device_claim->status = "rejected";
            $device_claim->save();

            ## Find claim payment request and update status to rejected

            $claim_payment_request = ClaimPaymentRequest::find($claim_payment_request_id);
            $claim_payment_request->status = "rejected";
            $claim_payment_request->save();

            ## Add new message

            $payment_request_to_admin->message()->save(new Message(['message' => 'rejected']));

            return response()->json(['success' => true, 'message' => 'Claim rejection successful']);
        } catch (\Throwable $th) {

            return response()->json(['success' => false, 'message' => 'Faild or query error']);
        }
    }

    /**
     * payment request to admin list display
     * @param Request $request
     * @return view
     */
    public function commission_withdraw_request(Request $request)
    {

        $commission_withdraw_requests = InsuranceWithdrawRequest::latest()->get();
        return view('backend.admin.commission_withdraw_request.index');
    }

    /**
     * payment request to admin list display
     * @return response datatable
     */
    public function commission_withdraw_request_ajax()
    {
        return InsuranceWithdrawRequest::commission_withdraw_request_ajax('admin');
    }

    /**
     * payment request to admin list display
     *
     */
    public function commission_withdraw_request_edit(InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {

        return view('backend.admin.commission_withdraw_request.edit_modal', compact('insuranceWithdrawRequest'));
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
     * Parent due balance
     * @param Request $request
     * @return view
     */
    public function parent_due_balance(Request $request)
    {

        return view('backend.admin.parent_due_balance.index');
    }

    /**
     * Parent due balance list using ajax call
     * @return response datatable
     */
    public function parent_due_balance_ajax()
    {
        return Dealer::parent_due_balance_ajax();
    }

    /**
     * Parent due balance collection datatable
     * @return response datatable
     */
    public function due_balance_collection()
    {
        return view('backend.admin.due_balance_collection.index');
    }


    /**
     * Parent due balance collection list using ajax call
     * @return response datatable
     */
    public function due_balance_collection_ajax()
    {
        return DueBalanceCollection::due_balance_collection_ajax();
    }

    /**
     * Parent due balance collection list using ajax call
     * @return response datatable
     */
    public function due_balance_collection_create()
    {
        $dealers = Dealer::where('due_balance', '>', 0)->orderBy('com_org_inst_name', 'asc')->get();
        return view('backend.admin.due_balance_collection.create', compact('dealers'));
    }

    /**
     * Parent due balance collection store
     * @param DueBalanceCollectionStoreRequest $request
     * @return response datatable
     */
    public function due_balance_collection_store(DueBalanceCollectionStoreRequest $request)
    {
        ## Find dealer
        $dealer = Dealer::find($request->dealer_id);

        if ($request->collected_amount > $dealer->due_balance) {
            return response()->json(['success' => false, 'message' => 'Collected amount is greter than due balance']);
        }

        ## Create new DueBalanceCollection
        $dueBalanceCollection                           = new DueBalanceCollection();
        $dueBalanceCollection->dealer_id                = $request->dealer_id;
        $dueBalanceCollection->collected_amount         = $request->collected_amount;
        $dueBalanceCollection->previous_due_balance     = $dealer->due_balance;
        $dueBalanceCollection->current_due_balance      = $dealer->due_balance - $request->collected_amount;
        $dueBalanceCollection->collection_date          = $request->collection_date;
        $dueBalanceCollection->note                     = $request->note;

        ## Upload document
        if ($request->file('document')) {
            $imagename = "";
            $image = $request->file('document');
            if (isset($image)) {
                ## make unique name for image
                $currentDate = Carbon::now()->toDateString();
                $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                ## Resize image and upload
                $proImage = Image::make($image)->save($image->getClientOriginalExtension());
                Storage::disk('public')->put('uploads/due_balance_collection_document/' . $imagename, $proImage);
            }
            $dueBalanceCollection->document = $imagename;
        }
        if ($dueBalanceCollection->save()) {
            ## Update dealer current due balance
            $dealer->due_balance = $dueBalanceCollection->current_due_balance;
            $dealer->save();

            return response()->json(['success' => true, 'message' => 'Successful']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong!']);
        }

        return view('backend.admin.due_balance_collection.create', compact('dealers'));
    }

    /**
     * Parent dealer withdraw request details
     * @param PaymentRequestToAdmin $id
     *
     */
    public function view(Request $request, $id)
    {

        $payment_request_to_admin = PaymentRequestToAdmin::with([
            'payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.device_claimed_parts', 'payment_request_to_admin_details.claim_payment_requests.claim_payment_request_details.device_claims.user',
            'payment_request_to_admin_details.claim_payment_requests.service_center'
        ])->where('id', $id)->first();

        $settlement_amount = 0;
        if (!$payment_request_to_admin) {
            Toastr::error('Invalid request');
            return redirect()->route('admin.withdraw_payment_request_from_parent_dealer');
        }

        return view('backend.admin.payment_request_to_admin.view', compact('payment_request_to_admin'));
    }

    /**
     * service center payemtn request and claim details
     * @param PaymentRequestToAdmin $paymentId
     * @param DeviceClaim $claimId
     * @return response view
     */
    public function claimDetails($paymentId, $claimId)
    {
        $deviceClaim = DeviceClaim::with(['device_claimed_parts', 'user', 'service_center'])->find($claimId);

        return view('backend.admin.payment_request_to_admin.claim_details', compact('deviceClaim'));
    }

    /**
     * Claim status chagne on admin panel servi ce charge request
     * @param PaymentRequestToAdmin $paymentId
     * @param DeviceClaim $claimId
     * @return response view
     */
    public function claimStatusChange($paymentRequestToAdminId, $deviceClaimId)
    {
        $deviceClaim = DeviceClaim::with(['device_claimed_parts', 'user', 'service_center'])->find($deviceClaimId);
        return view('backend.admin.payment_request_to_admin.claim_status_modal', compact('deviceClaim', 'paymentRequestToAdminId'));
    }

    /**
     * Parent dealer withdraw request status udpate
     * @param Request $request
     * @param PaymentRequestToAdmin $paymentId
     * @param DeviceClaim $claimId
     * @return response view
     */
    public function claimStatusChangeProcess(Request $request, $paymentRequestToAdminId, $deviceClaimId)
    {
        $deviceClaim = DeviceClaim::find($deviceClaimId);
        $deviceClaim->payment_status_admin = $request->status;
        if ($request->status == 'approved') {
            $deviceClaim->settlement_amount = isset($request->settlement_amount) &&  $request->settlement_amount != 0 ? $request->settlement_amount : $deviceClaim->amount_will_pay_ins_provider;
        }
        if ($request->message) {
            $deviceClaim->payment_details = $request->message;
        }

        ## Update claim payment request status rejected when individual claim rejected
        if ($request->status == 'rejected') {
            $claimPaymentRequest = ClaimPaymentRequest::whereHas('claim_payment_request_details', function ($q) use ($deviceClaimId) {
                $q->where('claim_id', $deviceClaimId);
            })->first();
            $claimPaymentRequest->status = 'rejected';
            $claimPaymentRequest->save();

            ## Update payment request to admin status rejected when individual claim rejected

            $paymentRequestToAdmin = PaymentRequestToAdmin::whereHas('payment_request_to_admin_details', function ($q) use ($claimPaymentRequest) {
                $q->where('claim_payment_request_id', $claimPaymentRequest->id);
            })->first();
            $paymentRequestToAdmin->status = 'rejected';
            $paymentRequestToAdmin->save();
        }

        ## Save device claim
        if ($deviceClaim->save()) {
            Toastr::success('Status updated succesfully');
            return redirect()->back();
        } else {
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }


    /**
     * Parent dealer withdraw request status udpate
     * @param Request $request
     * @param PaymentRequestToAdmin $paymentId
     * @param DeviceClaim $claimId
     * @return response view
     */
    public function claimMakeSettlement($paymentRequestToAdminId, $deviceClaimId)
    {
        $deviceClaim = DeviceClaim::with(['device_claimed_parts', 'user', 'service_center'])->find($deviceClaimId);
        return view('backend.admin.payment_request_to_admin.claim_settlement_modal', compact('deviceClaim', 'paymentRequestToAdminId'));
    }
}
