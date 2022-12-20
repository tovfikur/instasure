<?php

namespace App\Http\Controllers\Api;

use App\User;
use LDAP\Result;
use App\Model\Brand;
use App\Model\Dealer;
use App\Model\ImeiData;
use App\Model\DeviceModel;
use App\Model\InsuranceType;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Model\InsurancePrice;
use App\Model\DeviceInsurance;
use App\Model\InsurancePackage;
use App\Model\VerificationCode;
use App\Model\DeviceSubcategory;
use App\Model\InsuranceDiscount;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Model\DeviceInsuranceDetails;
use App\Model\InsuranceWithdrawRequest;
use App\Model\ParentChildDealerPackage;
use Illuminate\Support\Facades\Validator;
use App\Mail\CustomerRegisteredFromChildEmail;
use App\Http\Resources\DeviceInsuranceResource;
use App\Services\InsuranceWithdrawRequestService;
use App\Http\Requests\Api\PurchaseDeviceInsuranceRequestChild;

class ChildDealerApiController extends ApiController
{
    use SmsService;
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
            $this->child_dealer_login_check_exception();
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

    /**
     * Get device insurance package details from child dealer
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function get_device_insurance_package(Request $request)
    {
        try {
            $childDealer            = Dealer::where('user_id', Auth::id())->first();

            ## Exception handle for device sub category
            if (empty($childDealer)) {
                $this->set_err_code(400);
                throw new \Exception("Login as child dealer");
            }
            $deviceSubcategoryId    = null;
            ## Find device sub category
            $deviceSubcategory    = DeviceSubcategory::where(['status' => 1])->where('name', 'like', '%Mobile%')->where('name', 'like', '%phone%')->first();

            ## Exception handle for device sub category
            if (empty($deviceSubcategory)) {
                $this->set_err_code(400);
                throw new \Exception("Device sub category not found");
            } else {
                $deviceSubcategoryId = $deviceSubcategory->id;
            }

            ## Find insurance package matching on brand, model, childDealer

            $date                   = date('Y-m-d');

            $insurancePackage       = InsurancePackage::where('device_subcategory_id', $deviceSubcategoryId)
                ->select('insurance_packages.*')
                ->join('parent_child_dealer_packages', 'parent_child_dealer_packages.package_id', '=', 'insurance_packages.id')
                ->where('insurance_packages.brand_id', $request->brand_id)
                ->where('insurance_packages.device_model_id',  $request->device_model_id)
                ->where('insurance_packages.date_from', "<=", $date)
                ->where('insurance_packages.date_to', ">=", $date)
                ->where('parent_child_dealer_packages.child_id', $childDealer->id)
                ->where('insurance_packages.status', 1)
                ->latest()->first();

            if (empty($insurancePackage)) {
                ## Find insurance package matching on brand, model & all parent child
                $insurancePackage   = InsurancePackage::where('device_subcategory_id', $deviceSubcategoryId)
                    ->select('insurance_packages.*')
                    ->where('insurance_packages.brand_id', $request->brand_id)
                    ->where('insurance_packages.device_model_id',  $request->device_model_id)
                    ->where('insurance_packages.date_from', "<=", $date)
                    ->where('insurance_packages.date_to', ">=", $date)
                    ->where('insurance_packages.parent_id', 0)
                    ->where('insurance_packages.status', 1)
                    ->latest()->first();
                if (empty($insurancePackage)) {
                    ## Find default insurance package
                    $insurancePackage = InsurancePackage::where('device_subcategory_id', $deviceSubcategoryId)
                        ->where('brand_id', 0)
                        ->where('device_model_id', 0)
                        ->where('status', 1)
                        ->latest()->first();
                }
            }

            ## Exception handle for package
            if (empty($insurancePackage)) {
                $this->set_err_code(400);
                throw new \Exception("No package found");
            }

            $insurancePrices        = InsurancePrice::where('insurance_package_id', $insurancePackage->id)->get();

            ## Exception handle for package
            if (empty($insurancePrices)) {
                $this->set_err_code(400);
                throw new \Exception("Package price not found");
            }

            $insuranceTypeNames     = [];
            ## Loop through all Insurance Prices list
            foreach ($insurancePrices as $key => $insurancePrice) {
                $insTypeName = $insurancePrice->insuranceType->name;
                $insuranceTypeNames[$insTypeName] = [];
                ## For damage and theft insurance price calculations
                if ($insurancePrice->insuranceType->check_inc_type != 1) {
                    if ($insurancePrice->include_type == 'included') {
                        ## Included package type
                        $insuranceTypeNames[$insTypeName]['price'] = appliedOnHandsetValueCalculation($request->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_two);
                        $insuranceTypeNames[$insTypeName]['insurance_price_id'] = $insurancePrice->id;
                    } else {
                        ## Excluded package type
                        $insuranceTypeNames[$insTypeName]['price'] = incPackBtExcItems($request->price, $insurancePrice->value, $insurancePrice->type);
                        $insuranceTypeNames[$insTypeName]['insurance_price_id'] = $insurancePrice->id;
                    }
                }

                ## For Screen protection insurance price calculations
                if ($insurancePrice->insuranceType->check_inc_type == 1) {

                    if ($insurancePrice->include_type == 'excluded') {
                        ## Excluded package type
                        $insuranceTypeNames[$insTypeName]['type'] = 'excluded';
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][1] = appliedOnHandsetValueCalculation($request->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_one);
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][2] = appliedOnHandsetValueCalculation($request->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_two);
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][0] = 0;
                    } else {
                        ## Excluded package type
                        $insuranceTypeNames[$insTypeName]['type'] = 'included';
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][1] = appliedOnHandsetValueCalculation($request->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_two);
                        $insuranceTypeNames[$insTypeName]['insurance_price_id'] = $insurancePrice->id;
                    }
                }
            }
            $data = [
                'customer_id'           => $request->customer_id,
                'email'                 => $request->email,
                'inc_exc_type'          => $request->customer_id_type,
                'number'                => $request->customer_id_number,
                'device_price'          => $request->price,
                'device_price'          => $request->price,
                'imei_1'                => $request->imei_1,
                'imei_2'                => $request->imei_2,
                'package_id'            => $insurancePackage->id,
                'package_name'          => $insurancePackage->package_name,
                'insurance_type_names'  => $insuranceTypeNames
            ];

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Purchase device insurance package
     * @param \App\Http\Requests\Api\PurchaseDeviceInsuranceRequestChild $request
     * @return \Illuminate\Http\Response json
     */
    public function sale_device_insurance(PurchaseDeviceInsuranceRequestChild $request)
    {

        ## Creating a new instance of DeviceInsurance
        $DeviceInsurance = new DeviceInsurance();

        try {

            $auth_user = Auth::user();

            ## Find device sub category
            $deviceSubcategory    = DeviceSubcategory::where(['status' => 1])->where('name', 'like', '%Mobile%')->where('name', 'like', '%phone%')->first();

            ## Exception handle for device sub category
            if (empty($deviceSubcategory)) {
                $this->set_err_code(400);
                throw new \Exception("Device sub category not found");
            } else {
                $deviceSubcategoryId = $deviceSubcategory->id;
            }

            ## Find parent and child dealer
            $childDealer    = Dealer::where('user_id', Auth::id())->first();

            ## Exception handle for child dealer
            if (empty($childDealer)) {
                $this->set_err_code(400);
                throw new \Exception("Login as child dealer");
            }
            $parentDealer   = Dealer::find($childDealer->parent_id);

            ## Find insurance package
            $package            = InsurancePackage::find($request->package_id);
            $isChildInPackage   = ParentChildDealerPackage::where('package_id', $request->package_id)
                ->where('child_id', $childDealer->id)->latest()->first();
            $isParentInPackage = ParentChildDealerPackage::where('package_id', $request->package_id)
                ->where('parent_id', $parentDealer->id)->latest()->first();

            ## Find customer
            $customer = User::find($request->customer_id);
            ## Exception handle for device sub category
            if (empty($customer)) {
                $this->set_err_code(400);
                throw new \Exception("Customer not found");
            }

            ## Set Customer info for device insurance
            $customerInfo['name']                       = $customer->name;
            $customerInfo['customer_name']              = $customer->name;
            $customerInfo['customer_phone']             = $customer->phone;
            $customerInfo['customer_email']             = $request->customer_email ?? $customer->email;
            $customerInfo['inc_exc_type']               = $request->customer_id_type;
            $customerInfo['number']                     = $request->customer_id_number;
            $DeviceInsurance->customer_info             = json_encode($customerInfo);

            ## Find Brand & Model
            $brand                                      = Brand::find($request->brand_id);
            $model                                      = DeviceModel::find($request->device_model_id);

            ## Set device info for device insurance
            $deviceInfo['brand_id']                     = $brand->id;
            $deviceInfo['device_model_id']              = $model->id;
            $deviceInfo['brand_name']                   = $brand->name;
            $deviceInfo['model_name']                   = $model->name;
            $deviceInfo['device_price']                 = $request->price;
            $deviceInfo['device_name']                  = $brand->name . ' ' . $model->name;
            $deviceInfo['imei_one']                     = $request->imei_1;
            $deviceInfo['imei_two']                     = $request->imei_2;
            $DeviceInsurance->device_info               = json_encode($deviceInfo);

            ## Device insurance other attribute values
            $DeviceInsurance->user_id                   = $request->customer_id;
            $DeviceInsurance->imei_one                  = $request->imei_1;
            $DeviceInsurance->imei_two                  = $request->imei_2;
            $DeviceInsurance->customer_will_pay_charge  = $package->customer_will_pay_charge;
            $DeviceInsurance->parent_dealer_id          = $parentDealer->id;
            $DeviceInsurance->child_dealer_id           = $childDealer->id;
            $DeviceInsurance->package_type              = $package->inc_exc_type;
            $DeviceInsurance->package_id                = $package->id;
            $DeviceInsurance->invoice_code              = mt_rand(111111, 999999);

            ## Initial values for commissins and price
            $totalBalance                               = $request->protection_times_price ?? 0;
            $totalAmountForCal                          = 0;
            $childCommissionForInclude                  = 0;
            $parentCommission                           = 0;
            $childDCommission                           = 0;
            $includedAmount                             = 0;
            $otherDealerCommissionAmount                = 0;

            ## Calculations for screen protection
            $deviceArr = [];
            if (isset($request->protection_times_price)) {
                if ($request->protection_times_for > 0) {
                    $DeviceInsurance->protection_times_for = $request->protection_times_for;
                    array_push($deviceArr, ['parts_type' => 'Screen Protection', 'price' => $request->protection_times_price, 'ins_type' => 'excluded']);
                    $totalAmountForCal +=  $request->protection_times_price;
                }
            }

            ## Calculations for damange and theft
            if (!empty($request->insurance_price_id)) {
                foreach ($request->insurance_price_id as $pId) {
                    $insPrice = InsurancePrice::find($pId);
                    $insDevice =  InsuranceType::find($insPrice->insurance_type_id);
                    if ($insPrice->include_type == 'included') {
                        $totalBalance -= InsurancePriceCalculation($insPrice->id, $request->price);
                        $includedAmount += InsurancePriceCalculation($insPrice->id, $request->price);
                    }
                    $totalBalance += InsurancePriceCalculation($insPrice->id, $request->price);
                    $totalAmountForCal += InsurancePriceCalculation($insPrice->id, $request->price);
                    array_push($deviceArr, ['parts_type' => $insDevice->name, 'price' => InsurancePriceCalculation($insPrice->id, $request->price), 'ins_type' => $insPrice->include_type]);
                }
            }

            ## Insurance discount calculations
            $date       =    date('Y-m-d');
            $time       =    date('H:i:s');
            $discount   = InsuranceDiscount::where('device_subcategory_id', $deviceSubcategoryId)
                ->where('device_brand_id', $brand->id)->where('device_model_id',  $model->id)
                ->where('status', 1)
                ->where('date_from', "<=", $date)
                ->where('date_to', ">=", $date)
                ->where('time_from', "<=", $time)
                ->where('time_to', ">=", $time)
                ->where('parent_id', $childDealer->parent_id)
                ->where('inc_exc_type', $package->inc_exc_type)
                ->latest()->first();

            if (empty($discount)) {
                $discount = InsuranceDiscount::where('device_subcategory_id', $deviceSubcategoryId)
                    ->where('device_brand_id', 0)->where('device_model_id', 0)
                    ->where('date_from', "<=", $date)
                    ->where('date_to', ">=", $date)
                    ->where('time_from', "<=", $time)
                    ->where('time_to', ">=", $time)
                    ->where('inc_exc_type', $package->inc_exc_type)
                    ->where('status', 1)
                    ->latest()->first();
            }
            if ($discount && $discount->discount_type == 'percentage') {
                $total_discount = ($totalBalance * $discount->discount_price) / 100;
            } elseif ($discount && $discount->discount_type == 'flat') {
                $total_discount = $discount->discount_price;
            } else {
                $total_discount = 0;
            }

            ## Device insurance price calculations
            $DeviceInsurance->sub_total = $totalBalance;
            $DeviceInsurance->total_vat = calculatedVatResult($totalBalance, 'Device Insurance' );
            $DeviceInsurance->grand_total = $totalBalance + calculatedVatResult($totalBalance, 'Device Insurance') - $total_discount;
            $DeviceInsurance->insurance_type_value = json_encode($deviceArr);
            $DeviceInsurance->totalAmountForCal = $totalAmountForCal;
            $DeviceInsurance->includedAmount = $includedAmount;
            $DeviceInsurance->includedVatAmount = calculatedVatResult($includedAmount, 'Device Insurance');
            $DeviceInsurance->vat_pecentage = vat();
            $DeviceInsurance->total_discount = $total_discount;
            if (!empty($isChildInPackage)) {
                $total = $includedAmount;
                $childCommissionForInclude += commissionCalculation($total, $package->child_dealer_commission, $package->child_dealer_commission_type);
                $childDCommission += commissionCalculation($totalBalance, $package->parent_dealer_commission, $package->parent_dealer_commission_type);
            } else {
                $childDCommission += commissionCalculation($totalBalance, $childDealer->commission_amount, $childDealer->commission_type);
            }

            if (!empty($isParentInPackage)) {
                $parentCommission += commissionCalculation($totalBalance, $package->parent_dealer_commission, $package->parent_dealer_commission_type);
            } else {
                $parentCommission += commissionCalculation($totalBalance, $parentDealer->commission_amount, $parentDealer->commission_type);
            }
            if ($package->inc_exc_type == 'included') {
                $otherDealerCommissionAmount +=  commissionCalculation($totalBalance, $package->other_dealer_commission, $package->other_dealer_commission_type);
            } else {
                $otherDealerCommissionAmount += commissionCalculation($totalBalance, getBusinessSettingValue('other_dealer_commission'), getBusinessSettingValue('commission_type'));
            }

            $DeviceInsurance->parent_will_pay_to_admin = $includedAmount + calculatedVatResult($includedAmount, 'Device Insurance') + $childCommissionForInclude;
            $DeviceInsurance->parent_will_pay_to_child = $childCommissionForInclude;
            $DeviceInsurance->parent_dealer_commission = $parentCommission;
            $DeviceInsurance->child_dealer_commission = $childDCommission + $childCommissionForInclude;
            $DeviceInsurance->other_dealer_commission = $otherDealerCommissionAmount;
            $DeviceInsurance->instasure_amount = $totalBalance + calculatedVatResult($totalBalance, 'Device Insurance');

            ## claimable amount and claimd amount ##
            $DeviceInsurance->claimable_amount = $request->price;
            $DeviceInsurance->claimed_amount = 0;


            ## Save new or update IMEI data
            $DeviceInsurance->save();

            ## Store deviceInsuranceDetails
            foreach ($deviceArr as $key => $value) {

                $insDetails = new DeviceInsuranceDetails();
                $insDetails->device_insurance_id =  $DeviceInsurance->id;
                $insDetails->parts_type =  $value['parts_type'];
                if ($insDetails->parts_type == 'Screen Protection') {
                    if ($value['ins_type'] == 'included') {
                        $insDetails->protection_times_for = 2;
                    } else {
                        $insDetails->protection_times_for = $DeviceInsurance->protection_times_for;
                    }
                }
                $insDetails->price =  $value['price'];
                $insDetails->ins_type =  $value['ins_type'];
                $insDetails->claim_status =  1;
                $insDetails->claim_amount =  $request->price;
                $insDetails->save();
            }

            ## Insert or update imei data

            $imeiUsed = ImeiData::where(['imei_1' => $request->imei_1, 'status' => 1, 'is_used' => 1])->first();
            if ($imeiUsed) {
                throw new \Exception('You are already insured');
            }
            $imeiExist = ImeiData::where(['imei_1' => $request->imei_1, 'status' => 1, 'is_used' => 0])->first();
            if (empty($imeiExist)) {
                $imeiExist          = new ImeiData();
            }

            $imeiExist->imei_1       = $request->imei_1;
            $imeiExist->imei_2       = $request->imei_2;
            $imeiExist->parent_id    = $childDealer->id;
            $imeiExist->is_used      = 0;
            $imeiExist->status       = 1;
            $imeiExist->save();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $DeviceInsurance], $this->get_success_code());
        } catch (\Throwable $th) {

            $DeviceInsurance->delete();
            if (count($DeviceInsurance->device_insurace_details)) {
                $DeviceInsurance->device_insurace_details()->delete();
            }
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Child dealer login check
     * @return new \Exception
     */

    private function child_dealer_login_check_exception()
    {
        if (Auth::user()->user_type != 'child_dealer') {
            $this->set_err_code(400);
            throw new \Exception("Please login as child dealer");
        }
    }

    /**
     * Get device insurance purchase details
     * @param \App\Model\DeviceInsurance $deviceInsurance
     * @return \Illuminate\Http\Response json
     */
    public function get_device_insurance_sale_details($deviceInsurance)
    {

        try {
            $this->child_dealer_login_check_exception();
            ## Get device insurance details
            $deviceInsurance = DeviceInsurance::with(['package.policy_provider', 'package.insurance_category'])->find($deviceInsurance);

            ## Exception handling
            if (!$deviceInsurance) {
                $this->set_err_code(400);
                throw new \Exception("Insurance not found");
            }

            $deviceInsurance = new DeviceInsuranceResource($deviceInsurance);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurance], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Pay now for device insurance purchase
     * @param \App\Model\DeviceInsurance $deviceInsurance
     * @return \Illuminate\Http\Response json
     */
    public function pay_now_for_device_insurance_sale($deviceInsurance)
    {
        try {
            $this->child_dealer_login_check_exception();

            ## Find device insurance
            $deviceInsurance =  DeviceInsurance::find($deviceInsurance);
            if (!$deviceInsurance) {
                $this->set_err_code(400);
                throw new \Exception("No device insurance found");
            }

            ## Check imei is already used or not
            $imeiUsed = ImeiData::where('imei_1', $deviceInsurance->imei_one)->where('is_used', '>', 0)->first();
            if ($imeiUsed) {
                $this->set_err_code(400);
                throw new \Exception("Your device is already insured");
            }

            ## Aamar pay payment
            $payemnt_url = amarPayPaymentGateway('device_insurance', $deviceInsurance->id, true);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $payemnt_url], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }


    /**
     * Customer otp verification
     * @param  $phone;
     * @return response view
     */

    public function add_new_customer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'phone' => 'required|size:11|regex:/(01)[0-9]{9}/|unique:users,phone'
        ]);

        ## Check validation failure
        if ($validator->fails()) {
            $errors = custom_errors_bag($validator->errors()->toArray());
            $this->set_err_code(422);
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'message' => 'Validation Error', 'data' => $errors], $this->get_err_code());
        }

        try {
            ## Not child dealer exception
            if (Auth::user()->user_type != 'child_dealer') {
                $this->set_err_code(400);
                throw new \Exception("Login as child dealer");
            }

            ## Store verification code / OTP
            $otp = mt_rand(1000, 9999);

            $verificationCode = VerificationCode::where('phone', $request->phone)->first();
            if (empty($verificationCode)) {
                $verificationCode = new VerificationCode();
                $verificationCode->phone = $request->phone;
            }
            $verificationCode->code = $otp;
            $verificationCode->status = 0;
            $verificationCode->save();

            ## Send sms to customer mobile number containing OTP
            $smsText =  $otp . config('sms.CUSTOMER_REGISTRATION_OTP_SMS');

            $sms_response = strtolower($this->send_sms($request->phone, $smsText));
            if (strpos($sms_response, "sms submitted") < 0) {
                $this->set_err_code(400);
                throw new \Exception("SMS not sent");
            }
            $data = [
                'phone' => $request->phone,
                'message' => "OPT sent successfully, please verify"
            ];

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Customer otp verification process and create new user
     * @param  $phone;
     * @return response view
     */

    public function store_new_csutomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'     => ['required'],
            'code'      => ['required', 'size:4'],
            'name'      => ['required'],
            'email'     => ['sometimes',  'nullable', 'email'],
        ]);

        ## Check validation failure
        if ($validator->fails()) {
            $errors = custom_errors_bag($validator->errors()->toArray());
            $this->set_err_code(422);
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'message' => 'Validation Error', 'data' => $errors], $this->get_err_code());
        }

        try {
            ## Not child dealer exception
            if (Auth::user()->user_type != 'child_dealer') {
                $this->set_err_code(400);
                throw new \Exception("Login as child dealer");
            }

            $verificationCode = VerificationCode::where('phone', $request->phone)->where('code', $request->code)->first();

            ## Verification code exception handling
            if (empty($verificationCode)) {
                $this->set_err_code(400);
                throw new \Exception("Invalid OTP");
            }

            ## Update verificationCode
            $verificationCode->status = 1;
            $verificationCode->save();

            ## Store new user
            $user = new User();
            $user->name = $request->name;
            if (isset($request->email)) {
                $user->email = $request->email ?? null;
            }
            $user->phone = $request->phone;
            $user->password = bcrypt('123456');
            $user->user_type = 'customer';
            $user->banned = 0;
            $user->verification_code = $request->code;
            $user->save();

            ## Verification successfull sms to mobile number
            $smsText = "আপনার অ্যাকাউন্ট {$user->phone} & পাসওয়ার্ড 123456. প্লিজ ভিজিট instasure.xyz";

            $sms_response = strtolower($this->send_sms($request->phone, $smsText));
            if (strpos($sms_response, "sms submitted") < 0) {
                $this->set_err_code(400);
                throw new \Exception("SMS not sent");
            } else {
                ## Send email to customer email account
                $user = $user->toArray();
                if (!empty($user['email'])) {
                    Mail::to($user['email'])->queue(new CustomerRegisteredFromChildEmail($user['phone']));
                }
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $user], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }
}
