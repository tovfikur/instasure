<?php

namespace App\Http\Controllers\Api;

use App\Model\Dealer;
use Illuminate\Http\Request;
use App\Model\InsurancePrice;
use App\Model\BusinessSetting;
use App\Model\DeviceInsurance;
use App\Model\InsurancePackage;
use App\Model\ClaimPaymentRequest;
use Illuminate\Support\Facades\DB;
use App\Model\PaymentRequestToAdmin;
use Illuminate\Support\Facades\Auth;
use App\Model\InsuranceWithdrawRequest;
use App\Model\ParentChildDealerPackage;
use App\Model\PaymentRequestToAdminDetail;
use App\Services\InsuranceWithdrawRequestService;

class ParentDealerApiController extends ApiController
{
    /**
     * Parent dealer dashboard
     * @return \Illuminate\Http\Response
     */

    public function dashboard()
    {
        $auth_id = Auth::id();
        try {
            $parentDealer               = Dealer::where('user_id', $auth_id)->first();
            $deviceInsSale              = DeviceInsurance::where('parent_dealer_id', $parentDealer->id)->where('status', 'completed');
            $data['totalInsSale']       = $deviceInsSale->count();
            $data['totalEarn']          = $deviceInsSale->sum('child_dealer_commission');
            $data['dealerBalance']      = $parentDealer->dealer_balance;
            $data['dueBalance']         = $parentDealer->due_balance;
            $data['childDealers']       = Dealer::where('parent_id', $parentDealer->id)->count();
            $data['paid_by_admin']      = InsuranceWithdrawRequest::where('status', '=', 'paid')->where('parent_id', $auth_id)->where('user_id', '==', 0)->sum('amount');
            $data['received_amount']    = InsuranceWithdrawRequest::where('status', '=', 'received')->where('parent_id', $auth_id)->where('user_id', '==', 0)->sum('amount');
            $data['pending_amount']     = InsuranceWithdrawRequest::where('status', '=', 'pending')->where('parent_id', $auth_id)->where('user_id', '==', 0)->sum('amount');
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message('Something went wrong')], $this->get_error_code(201));
        }
    }

    /**
     * Child dealer list
     * @return \Illuminate\Http\Response json
     */
    public function child_dealer_list()
    {
        try {
            $parent = Dealer::where('user_id', Auth::id())->first();
            $childDealers = Dealer::where('parent_id', $parent->id)->latest()->paginate(5);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $childDealers], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message('Something went wrong')], $this->get_error_code(201));
        }
    }


    /**
     * Child dealer list
     * @return \Illuminate\Http\Response json
     */
    public function child_dealer_details($id)
    {
        try {
            $dealerDetails = Dealer::find($id);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $dealerDetails], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message('Something went wrong')], $this->get_error_code(201));
        }
    }


    /**
     * Insurance package list
     * @return \Illuminate\Http\Response json
     */
    public function insurance_package_list()
    {
        try {
            $parentDealer = Dealer::where('user_id', Auth::id())->first();
            $insurancePackages = InsurancePackage::where('status', 1)->where('parent_id', 0)->orWhere('parent_id', $parentDealer->id)->get();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $insurancePackages], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message('Something went wrong')], $this->get_error_code(201));
        }
    }

    /**
     * Insurance package details
     * @return \Illuminate\Http\Response json
     */
    public function insurance_package_details($id)
    {

        try {
            $package = InsurancePackage::find($id);

            ## Exception handling
            if (!$package) {
                throw new \Exception("Insurance Package Not Found");
            }
            $insurancePrices = InsurancePrice::where('insurance_package_id', $package->id)->get();
            ## Exception handling
            if (empty($insurancePrices)) {
                throw new \Exception("Invalid query");
            }
            $packageChilds = DB::table("parent_child_dealer_packages")
                ->where("parent_child_dealer_packages.package_id", $package->id)
                ->pluck('parent_child_dealer_packages.child_id', 'parent_child_dealer_packages.child_id')
                ->all();
            $parentDetails = ParentChildDealerPackage::where('package_id', $package->id)->where('parent_id', $package->parent_id)->get();

            ## Making data array
            $data = [
                'insurancePackageDetails' => $package,
                'insurancePrices' => $insurancePrices,
                'packageChilds' => $packageChilds,
                'parentDetails' => $parentDetails,
            ];
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }



    /**
     * Device sale commission log of parent
     * @return \Illuminate\Http\Response json
     */
    public function device_sale_commission_log_of_parent()
    {
        try {
            $parentDealer = Dealer::where('user_id', Auth::id())->first();
            ## Exception handling
            if (!$parentDealer) {
                throw new \Exception("Please login as parent dealer");
            }
            $deviceInsurances = DeviceInsurance::where('parent_dealer_id', $parentDealer->id)->where('status', 'completed')->latest()->get();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurances], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Device Insurance  Order Details
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_details($id)
    {
        try {
            $deviceInsurance = DeviceInsurance::find($id);

            ## Exception handling
            if (!$deviceInsurance) {
                throw new \Exception("Device Insurance Not Found");
            }
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurance], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Device Insurance Policy Invoice
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_invoice($id)
    {
        try {
            $deviceInsurance = DeviceInsurance::with('childDealer.user')->find($id);

            ## Exception handling
            if (!$deviceInsurance) {
                throw new \Exception("Device Insurance Not Found");
            }
            $default_address = BusinessSetting::where('type', 'default_address')->first();

            if (!empty($default_address)) {
                $deviceInsurance->_default_address = $default_address->value;
            } else {
                $deviceInsurance->_default_address = "Address : House#67 (1st Floor), Road#17, Block# C, Banani, Dhaka-1213. Phone : 02-9820580-1. Cell-Phone : 01915828248. Email : info@instasure.com";
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurance], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Device Insurance Invoice Print
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_policy_certificate($id)
    {
        try {
            $deviceInsurance = DeviceInsurance::find($id);
            if (!$deviceInsurance) {
                throw new \Exception("Device Insurance Not Found");
            } else {
                $deviceInsurance->_activation_date = date_format_custom($deviceInsurance->created_at, ' F d, Y');
                $deviceInsurance->_expire_date = dateFormat(insExpireDate($deviceInsurance));
                $deviceInsurance->_cooling_period = dateFormat(claimWillActiveDate($deviceInsurance));
            }
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurance], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Child commission withdraw request
     * @return \Illuminate\Http\Response json
     */
    public function child_commission_withdraw_request()
    {
        try {
            $auth_id = Auth::id();
            $dealer = Dealer::where('user_id', $auth_id)->first();
            $data['due_amount'] = InsuranceWithdrawRequest::due_amount();
            $data['paid_amount'] = InsuranceWithdrawRequest::paid_amount();

            $data['insuranceWithdrawRequests'] = InsuranceWithdrawRequest::with(['user.dealer', 'parent.dealer'])->where('parent_id', $auth_id)->where('user_id', '!=', 0)->orderBy('id', 'desc')->get();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Child commission withdraw request edit
     * @return \Illuminate\Http\Response json
     */
    public function child_commission_withdraw_request_edit($id)
    {
        try {
            $insuranceWithdrawRequest = InsuranceWithdrawRequest::with('user.dealer')->find($id);

            ## Exception handling
            if (!$insuranceWithdrawRequest) {
                throw new \Exception("Insurance Withdraw Request Not Found");
            } else {
                $child = $insuranceWithdrawRequest->user->dealer;
                $insuranceWithdrawRequest->child_dealer_name = $child->com_org_inst_name;
                $insuranceWithdrawRequest->dealer_balance = $child->dealer_balance;
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $insuranceWithdrawRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Child commission withdraw request update
     * @return \Illuminate\Http\Response json
     */
    public function child_commission_withdraw_request_update(Request $request)
    {
        $request->validate([
            'status' => ['required', 'in:pending,paid']
        ]);

        try {
            $insuranceWithdrawRequest = InsuranceWithdrawRequest::find($request->id);
            ## Exception handling
            if (!$insuranceWithdrawRequest) {
                throw new \Exception("Request ID Not Found");
            } elseif ($insuranceWithdrawRequest->paid_date != null && strtolower($insuranceWithdrawRequest->status) == 'paid') {
                $insuranceWithdrawRequest->message = strip_tags($request->message) ?? $insuranceWithdrawRequest->message;
                $insuranceWithdrawRequest->save();
                $insuranceWithdrawRequest->_notify = "Already paid, status can't be changed";
            } else {
                $insuranceWithdrawRequest->status = $request->status;
                $insuranceWithdrawRequest->message = strip_tags($request->message) ?? $insuranceWithdrawRequest->message;
                if ($request->status == 'paid') {
                    $insuranceWithdrawRequest->paid_date = now();
                }
                $insuranceWithdrawRequest->save();
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $insuranceWithdrawRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Parent commission withdraw request list
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function parent_commission_withdraw_request_list(Request $request)
    {
        ## Parent Dealer auth ID
        $auth_id = Auth::id();
        try {
            $parentDealer = Dealer::where('user_id', $auth_id)->where('parent_id', null)->first();
            ## Exception handling
            if (!$parentDealer) {
                throw new \Exception("Parent dealer only can access");
            }
            $due_amount = $parentDealer->dealer_balance;
            $paid_by_admin = InsuranceWithdrawRequest::where('status', '=', 'paid')->where('parent_id', $auth_id)->where('user_id', '==', 0)->sum('amount');
            $received_amount = InsuranceWithdrawRequest::where('status', '=', 'received')->where('parent_id', $auth_id)->where('user_id', '==', 0)->sum('amount');
            $pending_amount = InsuranceWithdrawRequest::where('status', '=', 'pending')->where('parent_id', $auth_id)->where('user_id', '==', 0)->sum('amount');
            $paid_amount = $paid_by_admin +  $received_amount;
            $total_amount = $paid_amount +  $pending_amount;

            ## InsuranceWithdrawRequest list
            $insuranceWithdrawRequestList = InsuranceWithdrawRequest::where('parent_id', $auth_id)->where('user_id', 0)->latest()->get();

            ## Data as response
            $data = [
                'receivableAmountToAdmin'       => $due_amount,
                'receivedAmountByAdmin'         => $received_amount,
                'pendingAmountAToAdmin'         => $pending_amount,
                'paidAmountByAdmin'             => $paid_amount,
                'totalAmount'                   => $total_amount,
                'insuranceWithdrawRequestList'  => $insuranceWithdrawRequestList
            ];

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Parent commission make withdraw request
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\InsuranceWithdrawRequestService $commission_withdraw_requests
     * @return \Illuminate\Http\Response json
     */
    public function parent_commission_make_withdraw_request(Request $request, InsuranceWithdrawRequestService $commission_withdraw_requests)
    {
        ## Request validation
        $this->validate($request, [
            'amount'                => ['required', 'min:1', 'numeric'],
            'type'                  => ['required'],
            'bank_name'             => ['required_if:type,bank_info'],
            'acc_holder_name'       => ['required_if:type,bank_info'],
            'account_number'        => ['required_if:type,bank_info'],
            'branch_name'           => ['required_if:type,bank_info'],
            'provider_name'         => ['required_if:type,mob_banking'],
            'phone'                 => ['required_if:type,mob_banking'],
        ]);


        ## Parent Dealer auth ID
        $auth_id = Auth::id();
        try {
            $parentDealer = Dealer::where('user_id', $auth_id)->first();

            ## Exception handling
            if ($parentDealer->dealer_balance < $request->amount) {
                throw new \Exception("Insufficient Balance");
            }

            ## New Insurance commission withdraw request
            if ($commission_withdraw_requests = $commission_withdraw_requests->create($request, 0, $parentDealer->user_id)) {
                $parentDealer->dealer_balance -= $request->amount;
                $parentDealer->save();
                ## Success response
                return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $commission_withdraw_requests], $this->get_success_code());
            }
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Parent commission withdraw request edit
     * @param \App\Services\InsuranceWithdrawRequest $insuranceWithdrawRequest
     * @return \Illuminate\Http\Response json
     */
    public function parent_commission_withdraw_request_edit($insuranceWithdrawRequest)
    {
        $insuranceWithdrawRequest  = InsuranceWithdrawRequest::find($insuranceWithdrawRequest);

        try {
            ## Exception handling
            if (!$insuranceWithdrawRequest) {
                throw new \Exception("Request ID Not Found");
            }
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $insuranceWithdrawRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }



    /**
     * Parent commission withdraw request update
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\InsuranceWithdrawRequest $insuranceWithdrawRequest
     * @return \Illuminate\Http\Response json
     */
    public function parent_commission_withdraw_request_update(Request $request, $insuranceWithdrawRequest)
    {
        try {
            $insuranceWithdrawRequest  = InsuranceWithdrawRequest::find($insuranceWithdrawRequest);
            ## Exception handling
            if (!$insuranceWithdrawRequest) {
                throw new \Exception("Request ID Not Found");
            } else if (strtolower($insuranceWithdrawRequest->status) != 'paid' && strtolower($insuranceWithdrawRequest->status) != 'received') {
                throw new \Exception("Admin didn't pay yet");
            } else {
                $insuranceWithdrawRequest->status = $request->status;
                $insuranceWithdrawRequest->message = strip_tags($request->message) ?? $insuranceWithdrawRequest->message;
                $insuranceWithdrawRequest->save();
            }
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $insuranceWithdrawRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Parent commission withdraw request update
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\InsuranceWithdrawRequest $insuranceWithdrawRequest
     * @return \Illuminate\Http\Response json
     */
    public function profile()
    {
        try {
            $dealerDetails = Dealer::where('user_id', Auth::id())->with(['user'])->withCount('child_dealers')->first();
            ## Exception handling
            if (!$dealerDetails) {
                throw new \Exception("You are not logged in");
            }
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $dealerDetails], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Check is parent dealer , else through forbidden exception
     * @return \Illuminate\Http\Response void
     */
    private function isParentDealer()
    {
        if (Auth::user()->user_type != 'parent_dealer') {
            $this->set_err_code(403);
            throw new \Exception("Please login as parent dealer");
        }
    }

    /**
     * Service center withdraw request list of resources
     * @return \Illuminate\Http\Response json
     */
    public function srvice_center_withdraw_request()
    {
        try {
            ## Check is logged is as parent dealer
            $this->isParentDealer();

            ## Find parent dealer
            $parentDealer = Dealer::where(['user_id' => Auth::id()])->first();

            ## Find Claim Payment Request list
            $claimPaymentRequestList = ClaimPaymentRequest::where('parent_dealer_id', $parentDealer->id)->get();

            ## Exception handling
            if (!$claimPaymentRequestList->count()) {
                $this->set_err_code(400);
                throw new \Exception("Claim payment request not found");
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $claimPaymentRequestList], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }


    /**
     *  Service center withdraw request single resource
     * @param \App\Model\ClaimPaymentRequest $claimPaymentRequest
     * @return \Illuminate\Http\Response json
     */
    public function srvice_center_withdraw_request_details($claimPaymentRequest)
    {
        try {
            ## Check is logged is as parent dealer
            $this->isParentDealer();


            ## Find parent dealer
            $parentDealer = Dealer::where(['user_id' => Auth::id()])->first();

            ## Find claim payment request item
            $claimPaymentRequest =  ClaimPaymentRequest::with(['claim_payment_request_details.device_claims.user', 'claim_payment_request_details.device_claims.device_claimed_parts'])->where('id', $claimPaymentRequest)->where('parent_dealer_id', $parentDealer->id)->first();
            ## Exception handling
            if (!$claimPaymentRequest) {
                $this->set_err_code(400);
                throw new \Exception("Claim payment request not found");
            }

            $claim_payment_request_details = $claimPaymentRequest->claim_payment_request_details;

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $claim_payment_request_details], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     *  Service center withdraw request status change
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\ClaimPaymentRequest $claimPaymentRequest
     * @return \Illuminate\Http\Response json
     */
    public function srvice_center_withdraw_request_status_change(Request $request, $claimPaymentRequest)
    {
        try {
            ## Check is logged is as parent dealer
            $this->isParentDealer();

            ## Find parent dealer
            $parentDealer = Dealer::where(['user_id' => Auth::id()])->first();

            ## Find claim payment request item
            $claimPaymentRequest =  ClaimPaymentRequest::where(['parent_dealer_id' => $parentDealer->id, 'id' => $claimPaymentRequest])->first();

            ## Claim payment request not found exception
            if (!$claimPaymentRequest) {
                $this->set_err_code(400);
                throw new \Exception("Claim payment request not found");
            }

            ## Change claim request status
            $claimPaymentRequest->status = $request->status;
            $claimPaymentRequest->save();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => "Status updated successfully"], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }



    /**
     * Payment request to admin from parent dealer
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function payment_request_to_admin(Request $request)
    {

        try {
            ## Check is logged is as parent dealer
            $this->isParentDealer();

            ## Find parent dealer
            $parentDealer = Dealer::where(['user_id' => Auth::id()])->first();

            ## Calculate grand total of list of ClaimPaymentRequest
            $grand_total = ClaimPaymentRequest::whereIn('id', $request->claim_payment_request_ids)->where(['parent_dealer_id' => $parentDealer->id])->sum('total_amount');

            $inputs_payemnt_requst_to_admin['grand_total']      = $grand_total;
            $inputs_payemnt_requst_to_admin['requests_id']      = 'PRTA-' . mt_rand(11111111, 99999999);
            $inputs_payemnt_requst_to_admin['status']           = 'pending';

            ## Create new PaymentRequestToAdmin
            $new_payemnt_request_to_admin = PaymentRequestToAdmin::create($inputs_payemnt_requst_to_admin);

            ## PaymentRequestToAdmin not found exception
            if (!$new_payemnt_request_to_admin) {
                $this->set_err_code(400);
                throw new \Exception("Payment request to admin not found");
            }

            ## Crate list of PaymentRequestToAdminDetail
            foreach ($request->claim_payment_request_ids as $id) {
                PaymentRequestToAdminDetail::create(['payment_request_to_admin_id' => $new_payemnt_request_to_admin->id, 'claim_payment_request_id' => $id]);
            }

            ## Update list of ClaimPaymentRequest
            ClaimPaymentRequest::whereIn('id', $request->claim_payment_request_ids)->update(['status' => 'processing']);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $new_payemnt_request_to_admin], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }
}
