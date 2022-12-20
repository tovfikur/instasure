<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Model\Dealer;
use Illuminate\Http\Request;
use App\Model\DeviceInsurance;
use App\Model\DeviceModel;
use App\Model\DeviceSubcategory;
use Illuminate\Support\Facades\Auth;
use App\Model\InsuranceWithdrawRequest;
use App\Services\InsuranceWithdrawRequestService;




class ChildDealerApiController extends ApiController
{
    /**
     * Child dealer dashboard
     * @return \Illuminate\Http\Response json
     */

    public function dashboard()
    {
        try {
            $auth_id = Auth::id();
            $childDealer = Dealer::where('user_id', $auth_id)->first();
            $deviceInsurance = DeviceInsurance::where('child_dealer_id', $childDealer->id)->where('status', 'completed');
            $data['totalInsuranceSale'] = $deviceInsurance->count();
            $data['totalEarning'] = $deviceInsurance->sum('child_dealer_commission');
            $data['dealerBalance'] = $childDealer->dealer_balance;
            $data['totalWithdrawAmount'] = InsuranceWithdrawRequest::where('user_id', $auth_id)->sum('amount');
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Something went wrong')], $this->get_error_code(401));
        }
    }

    /**
     * Child dealer profile
     * @return \Illuminate\Http\Response json
     */
    public function profile()
    {
        try {
            $childDealer = Dealer::where(['user_id' => Auth::id(), 'user_type' => "child_dealer"])->first();
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $childDealer], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message('Something went wrong')], $this->get_error_code(201));
        }
    }

    /**
     * Parent dealer profile
     * @return \Illuminate\Http\Response json
     */
    public function parent_profile()
    {
        try {
            $child = Dealer::where('user_id', Auth::id())->first();
            $parent = Dealer::find($child->parent_id);
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $parent], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Device insurance list
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_list()
    {
        try {
            $childDealer = Dealer::where(['user_id' => Auth::id(), 'user_type' => "child_dealer"])->first();

            $deviceInsurances = DeviceInsurance::where('child_dealer_id', $childDealer->id)->latest()->paginate(10);

            ## Exception handling
            if (!$childDealer && empty($deviceInsurances)) {
                throw new \Exception("Nothing found");
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurances], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Device insurance details
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_details($id)
    {
        try {
            $deviceInsuranceDetails = DeviceInsurance::with(['package.policy_provider', 'package.insurance_category'])->find($id);

            ## Exception handling
            if (!$deviceInsuranceDetails) {
                throw new \Exception("Requestd Model Not Found");
            }

            $deviceInsuranceDetails->_activationDate = date_format_custom($deviceInsuranceDetails->created_at, 'F d, Y');
            $deviceInsuranceDetails->_expireDate = dateFormat(insExpireDate($deviceInsuranceDetails));
            $deviceInsuranceDetails->_remainingDays = insRemainingDays($deviceInsuranceDetails);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsuranceDetails], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Device insurance details
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_commission_log()
    {
        try {
            $childDealer = Dealer::where('user_id', Auth::id())->first();
            $deviceInsuranceList = DeviceInsurance::where('child_dealer_id', $childDealer->id)->where('status', 'completed')->latest()->get();

            ## Exception handling
            if (!$childDealer) {
                throw new \Exception("Requestd Model Not Found");
            } else if (empty($deviceInsuranceList)) {
                throw new \Exception("No Data Found");
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsuranceList], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Device insurance details
     * @return \Illuminate\Http\Response json
     */
    public function commission_withdraw_request_list()
    {
        $auth_id = Auth::id();

        try {
            $childDealer = Dealer::where('user_id', $auth_id)->first();

            ## Exception handling
            if (!$childDealer) {
                throw new \Exception("Requestd Model Not Found");
            }

            $commission_withdraw_requests = InsuranceWithdrawRequest::where('user_id', $auth_id)->latest()->get();
            $due_amount = $childDealer->dealer_balance;
            $paid_by_parent = InsuranceWithdrawRequest::where('status', '=', 'paid')->where('user_id', $auth_id)->sum('amount');
            $received_amount = InsuranceWithdrawRequest::where('status', '=', 'received')->where('user_id', $auth_id)->sum('amount');
            $pending_amount = InsuranceWithdrawRequest::where('status', '=', 'pending')->where('user_id', $auth_id)->sum('amount');
            $paid_amount = $paid_by_parent +  $received_amount;
            $total_amount = $paid_amount +  $pending_amount;

            $data = [
                'commission_available_for_withdraw' => $due_amount,
                'amount_paid_by_parent' => $paid_amount,
                'amount_received_by_child' => $received_amount,
                'amount_pending_to_parent' => $pending_amount,
                'total_withdraw_amount' => $total_amount,
                'commission_withdraw_requests_list' => $commission_withdraw_requests,
            ];


            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }


    /**
     * Child commission withdraw request edit
     * @param \App\Model\InsuranceWithdrawRequest $insuranceWithdrawRequest
     * @return \Illuminate\Http\Response json
     */
    public function commission_withdraw_request_edit($insuranceWithdrawRequest)
    {
        try {
            $insuranceWithdrawRequest = InsuranceWithdrawRequest::with(['user.dealer'])->find($insuranceWithdrawRequest);
            ## Exception handling
            if (!$insuranceWithdrawRequest) {
                throw new \Exception("Requestd Model Not Found");
            } else {
                $child = $insuranceWithdrawRequest->user->dealer;
                $insuranceWithdrawRequest->_child_dealer_name = $child->com_org_inst_name;
                $insuranceWithdrawRequest->_dealer_balance = $child->dealer_balance;
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\InsuranceWithdrawRequest $insuranceWithdrawRequest
     * @return \Illuminate\Http\Response json
     */
    public function commission_withdraw_request_update(Request $request, InsuranceWithdrawRequest $insuranceWithdrawRequest)
    {
        $request->validate([
            'status' => ['required', 'in:pending,received']
        ]);
        try {
            if (strtolower($request->status) == 'pending' && strtolower($insuranceWithdrawRequest->status) == 'paid') {
                $this->set_err_code(400);
                throw new \Exception("Parent already paid your amount, so status can't set to pending");
            } elseif (strtolower($request->status) == 'pending' && strtolower($insuranceWithdrawRequest->status) == 'received') {
                $this->set_err_code(400);
                throw new \Exception("You already received, so status can't set to pending");
            } else {
                $insuranceWithdrawRequest->status = $request->status;
                $insuranceWithdrawRequest->message = !empty($request->message) ? strip_tags($request->message) : $insuranceWithdrawRequest->message;
                $insuranceWithdrawRequest->save();
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $insuranceWithdrawRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Child commission withdraw request make
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\InsuranceWithdrawRequestService $commission_withdraw_requests
     * @return \Illuminate\Http\Response json
     */
    public function make_a_child_commission_withdraw_request(Request $request, InsuranceWithdrawRequestService $commission_withdraw_requests)
    {
        ## Request validation
        $this->validate($request, [
            'amount'                => ['required', 'min:1', 'numeric'],
            'type'                  => ['required', 'in:bank_info,mob_banking'],
            'bank_name'             => ['required_if:type,bank_info'],
            'acc_holder_name'       => ['required_if:type,bank_info'],
            'account_number'        => ['required_if:type,bank_info'],
            'branch_name'           => ['required_if:type,bank_info'],
            'provider_name'         => ['required_if:type,mob_banking'],
            'phone'                 => ['required_if:type,mob_banking'],
        ]);

        ## Dealer auth ID
        $auth_id = Auth::id();
        try {
            $childDealer = Dealer::where('user_id', $auth_id)->first();

            ## Exception handling
            if ($childDealer->dealer_balance < $request->amount) {
                $this->set_err_code(400);
                throw new \Exception("Insufficient Balance");
            }

            ## New Insurance commission withdraw request
            if ($commission_withdraw_requests = $commission_withdraw_requests->create($request, $childDealer->user_id, $childDealer->parent->user_id)) {
                $childDealer->dealer_balance -= $request->amount;
                $childDealer->save();
                ## Success response
                return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $commission_withdraw_requests], $this->get_success_code());
            }
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Get customer details via mobile number to sale device insurance
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function get_customer_info(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'starts_with:01', 'size:11']
        ]);
        try {

            $customer = User::where(['phone' => $request->phone, 'user_type' => 'customer'])->first();
            ## Exception handling
            if (!$customer) {
                $this->set_err_code(400);
                throw new \Exception("No customer belongs to this phone number, please add new customer");
            }
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $customer], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }


    /**
     * Device insurance create form
     * @param \App\Model\User $customer
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_create_form($customer)
    {
        try {
            $customer = User::find($customer);
            $dealer_auth_id = Auth::id();
            ## Exception handling
            if (Auth::user()->user_type != 'child_dealer') {
                $this->set_err_code(400);
                throw new \Exception("Please login as child dealer");
            }

            if (!$customer) {
                $this->set_err_code(400);
                throw new \Exception("No customer found");
            }
            $deviceSubcategories = DeviceSubcategory::where(['status' => 1])->where('name', 'like', '%Mobile%')->where('name', 'like', '%phone%')->first()->id;

            ## Find child dealer brands inherited from parent dealer ##
            $brands = [];
            $child_dealer = Dealer::with(['parent.brands'])->where('user_id', $dealer_auth_id)->first();

            foreach ($child_dealer->parent->brands as $brand) {
                $brands[$brand->id] = $brand->name;
            }

            ## Find brand wise models
            $first_brand_id = key($brands);
            $brand_wise_models = DeviceModel::where(['brand_id' => $first_brand_id])->get()->toArray();

            ## Passing data as json response
            $data = [
                'customer' => $customer->toArray(),
                'brands' => $brands,
                'models' => $brand_wise_models,
                'device_subcategory_id' => $deviceSubcategories
            ];


            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Device insurance create form
     * @param \App\Model\User $customer
     * @return \Illuminate\Http\Response json
     */
    public function get_brand_wise_models($brand)
    {
        try {
            $models = DeviceModel::where(['brand_id' => $brand])->get()->toArray();
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $models], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }
}
