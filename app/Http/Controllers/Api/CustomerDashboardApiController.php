<?php

namespace App\Http\Controllers\Api;

use App\User;
use DateTime;
use Carbon\Carbon;
use App\Model\Brand;
use App\Model\Dealer;
use App\Model\Division;
use App\Model\ImeiData;
use App\Model\DeviceClaim;
use App\Model\DeviceModel;
use Illuminate\Support\Str;
use App\Model\InsuranceType;
use Illuminate\Http\Request;
use App\Model\InsurancePrice;
use App\Model\PolicyProvider;
use App\Model\TravelInsOrder;
use App\Services\UserService;
use App\Model\BusinessSetting;
use App\Model\DeviceInsurance;
use App\Model\MobileDiagnosis;
use App\Model\InsurancePackage;
use App\Model\DeviceSubcategory;
use App\Model\InsuranceDiscount;
use App\Model\DeviceClaimRequest;
use App\Services\FirebaseService;
use App\Model\TravelInsPlansChart;
use App\Model\ServiceCenterDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Model\DeviceInsuranceDetails;
use App\Model\TravelInsPlansCategory;
use App\Model\ParentChildDealerPackage;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CustomerProfileResource;
use App\Http\Requests\Api\CustomerProfileUpdateRequest;
use App\Http\Requests\Api\TravelInsurancePlanChartRequest;
use App\Http\Requests\Api\MobileDiagnosisReportStoreRequest;
use App\Http\Requests\Api\TravelInsuranceOrderCreateRequest;
use App\Http\Resources\DeviceInsuranceResource;
use App\Http\Resources\DeviceSupportTicketsCollection;

class CustomerDashboardApiController extends ApiController
{
    use FirebaseService;
    /**
     * Customer dashboard
     * @return Illuminate\Http\Response json
     */

    public function customer_dashboard()
    {
        $auth_id = Auth::id();
        $data['total_mediclaim_order']          = TravelInsOrder::where('user_id', $auth_id)->count();
        $data['total_device_order']             = DeviceInsurance::where('user_id', $auth_id)->count();
        $data['total_device_claim']             = DeviceClaim::where('user_id', $auth_id)->count();
        $data['total_device_service_request']   = DeviceClaimRequest::where('user_id', $auth_id)->count();

        ## Success response
        return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $data], $this->get_success_code());
    }


    /**
     * Customer details
     * @return Illuminate\Http\Response json
     */

    public function customer_profile()
    {
        $user = new CustomerProfileResource(Auth::user());

        ## Success response
        return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => ($user)], $this->get_success_code());
    }

    /**
     * Customer profile update
     * @param App\Http\Requests\Api\CustomerProfileUpdateRequest
     * @return Illuminate\Http\Response json
     */

    public function customer_profile_update(CustomerProfileUpdateRequest $request, UserService $user_service)
    {
        $user = Auth::user();
        $user = $user_service->update($request, $user);

        if ($user) {
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => new CustomerProfileResource($user)], $this->get_success_code());
        }
    }


    /**
     * Customer password update
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */
    public function customer_password_update(Request $request)
    {
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->new_password, $hashedPassword)) {
                if ($request->confirm_password == $request->new_password) {
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return response()->json(['success' => true, 'response' => 'Password Updated Successfully'], $this->get_success_code());
                } else {
                    return response()->json(['success' => false, 'response' => 'New password does not match with confirm password.'], $this->get_error_code(404));
                }
            } else {
                return response()->json(['success' => false, 'response' => 'New password cannot be the same as old password.'], $this->get_error_code(404));
            }
        } else {
            return response()->json(['success' => false, 'response' => 'Current password not match.'], 404);
        }
    }


    /**
     * Travel insurance purchase history
     * @param App\Http\Requests\Api\CustomerProfileUpdateRequest
     * @return Illuminate\Http\Response json
     */

    public function travel_insurance_purchase_history()
    {
        $travel_orders = TravelInsOrder::where('user_id', Auth::id())->latest()->paginate(6);
        if ($travel_orders) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travel_orders], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message()], $this->get_error_code(401));
        }
    }


    /**
     * Get travel insurance quotation
     * @param App\Http\Requests\Api\CustomerProfileUpdateRequest
     * @return Illuminate\Http\Response json
     */

    public function get_travel_insurance_quotation(CustomerProfileUpdateRequest $request, UserService $user_service)
    {
        $user = Auth::user();
        $user = $user_service->update($request, $user);
        if ($user) {
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => new CustomerProfileResource($user)], $this->get_success_code());
        }
    }

    /**
     * Travel Insurance purchase details
     * @param TravelInsOrder $id
     * @return Illuminate\Http\Response json
     */

    public function travel_insurance_purchase_details($id)
    {
        return $this->get_travel_insurance_purchase_details($id);
    }

    /**
     * Travel Insurance certificate download on pdf
     * @param TravelInsOrder $id
     * @return \Illuminate\Http\Response json
     */

    public function travel_insurance_policy_certificate($id)
    {
        try {
            $travelInsOrder = TravelInsOrder::find($id);

            ## Exception handling
            if (!$travelInsOrder) {
                $this->set_err_code(400);
                throw new \Exception("Insurance not found");
            }
            if (!empty($travelInsOrder->policy_certificate_path)) {
                ## Success response
                return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travelInsOrder->policy_certificate_path], $this->get_success_code());
            }
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }


    /**
     * Travel Insurance invoice download on pdf
     * @param TravelInsOrder $id
     * @return \Illuminate\Http\Response json
     */

    public function travel_insurance_invoice($id)
    {
        $travelInsOrder = TravelInsOrder::find($id);
        ## Compnay default address
        $defaultAddress = BusinessSetting::select('value')->where('type', 'default_address')->first();

        if ($travelInsOrder) {
            ## Assign default address
            $travelInsOrder['default_address'] = $defaultAddress->value;

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travelInsOrder], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }


        return $this->get_travel_insurance_purchase_details($id);
    }

    /**
     * Get Travel Insurance purchase details
     * @param TravelInsOrder $id
     * @return Illuminate\Http\Response json
     */

    public function get_travel_insurance_purchase_details($id)
    {
        $travelInsOrder = TravelInsOrder::find($id);

        if ($travelInsOrder) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travelInsOrder], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Device insurance history
     * @return Illuminate\Http\Response json
     */
    public function device_insurance_history()
    {
        $deviceInsurances = DeviceInsurance::where('user_id', Auth::id())->latest()->paginate(100);

        if ($deviceInsurances) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurances], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Device insurance details
     * @return Illuminate\Http\Response json
     */
    public function device_insurance_details($id)
    {
        try {
            ## Find device insureace
            $deviceInsurance = DeviceInsurance::with(['device_insurace_details'])->find($id);

            ## Exception handling for device insurance
            if (!$deviceInsurance) {
                $this->set_err_code(400);
                throw new \Exception("Insurance not found");
            }

            ## Find device claim request against a device insurance by customer
            $deviceClaimRequestCount = DeviceClaimRequest::where('device_insurance_id', $deviceInsurance->id)
                ->where('status', 'pending')
                ->count();

            ## Is claim applicable for this time

            $isClaimApplicable = dayCountCheckForClaim($deviceInsurance) >= $deviceInsurance->created_at->daysInMonth &&
                dayCountCheckForClaim($deviceInsurance) <= 365;

            if ($deviceClaimRequestCount) {
                $deviceInsurance->_claimOption = 'Request Pending';
            } elseif ($isClaimApplicable) {
                $deviceInsurance->_claimOption = 'Make Claim';
            } else {
                $deviceInsurance->_claimOption = dateFormat(claimWillActiveDate($deviceInsurance));
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurance], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }



    /**
     * Device insurance history
     * @return Illuminate\Http\Response json
     */
    public function device_insurance_support_history()
    {
        try {
            $deviceClaimRequest = DeviceClaimRequest::with(['service_center', 'deviceInsurance'])->where('user_id', Auth::id())->paginate(10);

            ## Device claim request not found exception handling
            if (empty($deviceClaimRequest)) {
                $this->set_err_code(400);
                throw new \Exception("Device support tickets not found");
            }

            ## Trasformation of device claim requests using resource class
            return new DeviceSupportTicketsCollection($deviceClaimRequest);

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceClaimRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Device insurance make support request form by customer
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_support_request_form(Request $request)
    {
        $deviceInsurance = DeviceInsurance::find($request->device_insurance_id);

        $claimType = $request->claim_type;
        $deviceInsurance->_claimType = $claimType;
        if (strtolower($claimType)  != 'lost') {
            $deviceInsurance->_divisions = Division::all();
        }

        if ($deviceInsurance) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceInsurance], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(201));
        }
    }

    /**
     * Device insurance make support request by customer
     * @return \Illuminate\Http\Response json
     */
    public function get_service_center(Request $request)
    {
        try {
            $deviceInsurance    = DeviceInsurance::find($request->device_insurance_id);
            ## Find device insurance
            if (!$deviceInsurance) {
                $this->set_err_code(400);
                throw new \Exception("No device insurance found");
            }
            $deviceInsurance    = new DeviceInsuranceResource($deviceInsurance);
            $serviceCenters     = ServiceCenterDetails::where('division_id', $request->division_id)
                ->where('district_id', $request->district_id)
                ->where('upazila_id', $request->upazila_id)
                ->latest()
                ->get();
            $defaultAddress     = BusinessSetting::where('type', 'default_address')->first();
            if ($serviceCenters->count()) {
                ## Success response
                return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => ["serviceCenters" => $serviceCenters, 'deviceInsurance' => $deviceInsurance]], $this->get_success_code());
            } else if ($defaultAddress) {
                return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => ['defaultAddress' => $defaultAddress, 'deviceInsurance' => $deviceInsurance]], $this->get_success_code());
            } else {
                ## Fail response
                return response()->json(['success' => false, 'code' => $this->get_error_code(200), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(201));
            }
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Device insurance make support request store by customer
     * @return \Illuminate\Http\Response json
     */
    public function device_insurance_support_request_store(Request $request)
    {
        $deviceClaimRequest = new DeviceClaimRequest();
        if (strtolower($request->claim_type) != 'theft') {
            $this->validate($request, [
                'sc_user_id' => 'required',
                'pick_up_status' => 'required',
                'device_insurance_id' => 'required',
                'claim_type' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'device_insurance_id' => 'required',
                'claim_type' => 'required',
                'claim_note' => 'required|max:500',
                'document' => ['required', 'array'],
                'document.*' => ['image', 'mimes:png,jpg,jpeg,gif', 'max:4096'],
            ]);
        }

        try {
            if (strtolower($request->claim_type) == 'theft') {
                ## Store images
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
                    $deviceClaimRequest->document = json_encode($attachments);
                }
            }
            $deviceInsurance                              = DeviceInsurance::find($request->device_insurance_id);

            ## Exception handle for device insurance
            if (empty($deviceInsurance)) {
                $this->set_err_code(400);
                throw new \Exception("Device insurance not found");
            }
            $deviceClaimRequest->user_id                  = Auth::id();
            $deviceClaimRequest->device_insurance_id      = $request->device_insurance_id;
            $deviceClaimRequest->claim_type               = $request->claim_type;
            $deviceClaimRequest->sc_user_id               = $request->sc_user_id;
            $deviceClaimRequest->pick_up_status           = $request->pick_up_status;
            $deviceClaimRequest->claim_note               = $request->claim_note;
            $deviceClaimRequest->save();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceClaimRequest], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(400), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(400));
        }
    }




    /**
     * Device insurance history
     * @return Illuminate\Http\Response json
     */
    public function device_insurance_claim_history()
    {
        $deviceClaim = DeviceClaim::where('user_id', Auth::id())->latest()->paginate(6);

        if ($deviceClaim) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceClaim], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Device insurance history
     * @param DeviceClaim $id
     * @return Illuminate\Http\Response json
     */
    public function device_claim_details($id)
    {

        $deviceClaim = DeviceClaim::with(['device_insurance', 'service_center', 'device_claimed_parts'])->find($id);

        if ($deviceClaim) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceClaim], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Device insurance claim details download
     * @param DeviceClaim $id
     * @return Illuminate\Http\Response json
     */
    public function device_claim_details_download($id)
    {

        $deviceClaim = DeviceClaim::with(['device_insurance', 'service_center', 'device_claimed_parts'])->find($id);

        if ($deviceClaim) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $deviceClaim], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Travel insurance get plan category
     * @param Request $request
     * @return Illuminate\Http\Response json
     */
    public function get_travel_ins_plan_category(Request $request)
    {

        $travelInsPlansCategory = TravelInsPlansCategory::where('country_type', $request->country_type)->latest()->get();
        if (count($travelInsPlansCategory)) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travelInsPlansCategory], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Travel insurance get plan category
     * @param Request $request
     * @return Illuminate\Http\Response json
     */

    public function get_travel_inc_plan_chart_with_provider(TravelInsurancePlanChartRequest $request)
    {

        $dateOfBirth = $request->dob;
        $today = date("Y-m-d");
        $date_difference = date_diff(date_create($dateOfBirth), date_create($today));

        ## Calculate age
        $years = $date_difference->days / 365;
        $age = (float) number_format($years, 2);

        ## Calcualte total days to travel
        $flight_date = new DateTime($request->flight_date);
        $return_date = new DateTime($request->return_date);
        $travel_date_difference = $flight_date->diff($return_date);
        $total_days = (int) $travel_date_difference->format('%d') + 1;

        if ($travel_date_difference->invert) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message('Return date must be larger than flight date')], $this->get_error_code(201));
        }

        ## Find travel insurance plan category
        $travelInsPlansCategory = TravelInsPlansCategory::find($request->plan_category_id);

        ## Find travel ins plan chart
        $travelPlanCharts = TravelInsPlansChart::with('policyProvider')->where('travel_ins_plans_category_id', $travelInsPlansCategory->id)
            ->where('age_from', '<=', $age)
            ->where('age_to', '>=', $age)
            ->where('period_from', '<=', $total_days)
            ->where('period_to', '>=', $total_days)
            ->get()->toArray();

        ## Set travel total days on every travel ins plans chart
        $travelPlanCharts = array_map(function ($item) use ($total_days, $age) {
            $item['travel_days'] = $total_days;
            $item['age'] = $age;
            return $item;
        }, $travelPlanCharts);

        if (count($travelPlanCharts) && $travelInsPlansCategory) {
            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travelPlanCharts], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Invalid Request')], $this->get_error_code(401));
        }
    }

    /**
     * Travel insurance order create
     * @param \Illuminate\Http\TravelInsuranceOrderCreateRequest $request
     * @return \Illuminate\Http\Response json
     */

    public function travel_insurance_order_create(Request $request)
    {

        try {
            $travelCategory = TravelInsPlansCategory::find($request->plan_category_id);
            $travelPlanChart = TravelInsPlansChart::find($request->plan_chart_id);
            $policyProvider = PolicyProvider::find($travelPlanChart->policy_provider_id);

            ## Exception handling
            if (empty($travelPlanChart)) {
                throw new \Exception("TravelInsPlansCategory not found");
            } elseif (empty($travelPlanChart)) {
                throw new \Exception("TravelInsPlansChart not found");
            } elseif (empty($policyProvider)) {
                throw new \Exception("PolicyProvider not found");
            } else {
                $ins_price = $travelPlanChart->ins_price;
                $totalVat = calculatedVatResult($ins_price, 'Device Insurance');
                $totalServiceCharge = calculatedServiceChargeResult($ins_price, 'Device Insurance');
                $grandTotal = $ins_price + $totalVat + $totalServiceCharge;
            }

            ## Travel insurance order create
            $travelInsOrder = new TravelInsOrder();
            $travelInsOrder->user_id = Auth::id();
            $travelInsOrder->travel_insurance_category_title = $travelCategory->country_type . ' ' . $travelCategory->plan_title . ' (' . $travelCategory->county_details . ')';
            $travelInsOrder->travel_ins_plans_category_id = $request->plan_category_id;
            $travelInsOrder->full_name = $request->full_name;
            $travelInsOrder->phone = $request->phone;
            $travelInsOrder->email = $request->email;
            $travelInsOrder->dob = $request->dob;
            $travelInsOrder->age = $request->age;
            $travelInsOrder->passport_number = $request->passport_number;
            $travelInsOrder->passport_expire_till = $request->passport_expire_till;

            // if ($policyProvider->is_api == 1) {
            //     $travelInsOrder->policy_number = mt_rand(111111, 999999);
            // } else {
            //     $travelInsOrder->policy_number =  'DNS' . mt_rand(111111, 999999);;
            // }
            $travelInsOrder->policy_number =  null;

            $travelInsOrder->ins_price = $ins_price;
            $travelInsOrder->travel_ins_plans_charts_id = $travelPlanChart->id;
            $travelInsOrder->insurance_provider_id = $travelPlanChart->policy_provider_id;
            $travelInsOrder->vat_percentage = vat();
            $travelInsOrder->total_vat = $totalVat;
            $travelInsOrder->service_amount = serviceCharge();
            $travelInsOrder->service_total_amount = $totalServiceCharge;
            $travelInsOrder->grand_total = round($grandTotal);
            $travelInsOrder->flight_number = $request->flight_number;
            $travelInsOrder->flight_date = $request->flight_date;
            $travelInsOrder->return_date = $request->return_date;
            $travelInsOrder->total_date = $request->total_days;
            $travelInsOrder->invoice_code = date('Ymd-his');
            $travelInsOrder->shipping_address =  $request->shipping_address;
            $travelInsOrder->save();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $travelInsOrder], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(201), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code(201));
        }
    }

    /**
     * Travel insurance order payment
     * @param Request $request
     * @return Illuminate\Http\Response json
     */

    public function pay_now(Request $request)
    {
        $order_type = "travel_ins_orders";

        try {
            $order = TravelInsOrder::find(($request->order_id));
            ## Exception handling
            if (empty($order)) {
                $this->set_err_code(400);
                throw new \Exception("Order not found");
            }

            ## Return payment url
            return amarPayPaymentGateway($order_type, encrypt($request->order_id), true);
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Customer old mobile diagnosis
     * @param \App\Http\Requests\Api\MobileDiagnosisReportStoreRequest $request
     * @return \Illuminate\Http\Response json
     */
    public function mobile_diagnosis_report_store(Request $request)
    {
        $table_name = 'device_info';
        try {
            $auth_id                        = Auth::id();
            $firstChildDealer = Dealer::where(['user_type' => 'child_dealer'])->first();

            ## Exception handling

            if (strtolower(auth()->user()->user_type) != 'customer') {
                $this->set_err_code(400);
                throw new \Exception("Please login as customer");
            }

            ## Find or create brand
            $brand                          = Brand::firstOrNew(
                ['name'                     => $request->brand_name],
                [
                    'slug'                  => Str::slug($request->brand_name, '-'),
                    'status'                => 1,
                    'meta_title'            => $request->brand_name,
                    'meta_description'      => $request->brand_name,
                ]
            );
            $brand->save();

            ## Find or create device model
            $deviceModel                    = DeviceModel::firstOrNew(
                ['name'                     => $request->brand_model_name],
                [
                    'brand_id'              => $brand->id,
                    'slug'                  => Str::slug($request->brand_model_name, '-'),
                    'status'                => 1,
                    'description'           => $request->brand_model_name,
                ]
            );
            $deviceModel->save();

            ## Store mobile diagnosis report

            $mobileDiagnosis                           = MobileDiagnosis::where(['serial_number' => $request->device_serial_number])->first();
            if (!$mobileDiagnosis) {
                $mobileDiagnosis                       = new MobileDiagnosis();
            }

            ## Assign attribute values
            $mobileDiagnosis->user_id                  = $auth_id;
            $mobileDiagnosis->dealer_id                = $firstChildDealer->id;
            $mobileDiagnosis->brand_id                 = $brand->id;
            $mobileDiagnosis->device_model_id          = $deviceModel->id;
            $mobileDiagnosis->imei_data_id             = 0;
            $mobileDiagnosis->validity_period          = null;
            $mobileDiagnosis->serial_number            = $request->device_serial_number;
            $mobileDiagnosis->price                    = $request->device_price;
            $mobileDiagnosis->motherboard_status       = $request->motherboard_status;
            $mobileDiagnosis->battery_health_status    = $request->battery_health_status;
            $mobileDiagnosis->front_camera_status      = $request->front_camera_status;
            $mobileDiagnosis->back_camera_status       = $request->back_camera_status;
            $mobileDiagnosis->microphone_status        = $request->microphone_status;
            $mobileDiagnosis->ram_status               = $request->ram_status;
            $mobileDiagnosis->rom_status               = $request->rom_status;
            $mobileDiagnosis->display_screen_status    = $request->display_screen_status;
            $mobileDiagnosis->status                   = 'pending';
            $mobileDiagnosis->is_active                = 0;
            $mobileDiagnosis->note                     = $request->note;

            ## Upload invoice image
            if (!empty($request->hasFile('invoice_image'))) {
                $path = 'uploads/mobile_diagnosis/invoice_images';

                ### Delete existing image
                if (!empty($mobileDiagnosis->invoice_image)) {
                    $image_path = public_path('/') . $mobileDiagnosis->invoice_image;
                    $image_path = format_image_upload_path($image_path);
                    $this->delete_file($image_path);
                }
                ### Upload process
                $image_name = imageUpload($request->invoice_image, $path, 0, 30, 'webp');
                $mobileDiagnosis->invoice_image = $path . '/' . $image_name;
            }

            ## Upload device images
            if (!empty($request->hasFile('device_images'))) {
                $path = 'uploads/mobile_diagnosis/device_images';

                ### Delete existing image
                if (!empty($mobileDiagnosis->device_images)) {
                    foreach (json_decode($mobileDiagnosis->device_images) as $image) {
                        $image_path = public_path('/') . $image;
                        $image_path = format_image_upload_path($image_path);
                        $this->delete_file($image_path);
                    }
                }

                ### Upload process
                $device_images = [];
                foreach ($request->device_images as $image) {
                    $image_name = imageUpload($image, $path, 0, 30, 'webp');
                    $image_path = $path . '/' . $image_name;
                    array_push($device_images, $image_path);
                }
                $mobileDiagnosis->device_images = json_encode($device_images);
            }


            ## Upload imei image
            if (!empty($request->hasFile('imei_image'))) {
                $path = 'uploads/mobile_diagnosis/imei_images';

                ### Delete existing image
                if (!empty($mobileDiagnosis->imei_image)) {
                    $image_path = public_path('/') . $mobileDiagnosis->imei_image;
                    $image_path = format_image_upload_path($image_path);
                    $this->delete_file($image_path);
                }

                ### Upload process
                $image_name = imageUpload($request->imei_image, $path, 0, 30, 'webp');
                $mobileDiagnosis->imei_image = $path . '/' . $image_name;
            }


            ## Save diagnosis report
            if ($mobileDiagnosis->save()) {
                $device_info = $mobileDiagnosis->only(['id', 'user_id', 'serial_number', 'price', 'status']);
                FirebaseService::create_or_update($table_name, $device_info);
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $mobileDiagnosis], $this->get_success_code());
        } catch (\Throwable $th) {

            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }


    /**
     * Delete file if exist
     * @param \Illuminate\Support\Facades\File $image_path
     * @return boolean true|false
     */
    public function delete_file($image_path)
    {
        if (File::exists($image_path)) {
            File::delete($image_path);
            return true;
        }
        return false;
    }

    /**
     * Customer old mobile diagnosis report list
     * @return \Illuminate\Http\Response json
     */
    public function mobile_diagnosis_report_list()
    {
        try {
            $authId = auth()->id();

            ## Exception handling

            if (strtolower(auth()->user()->user_type) != 'customer') {
                $this->set_err_code(400);
                throw new \Exception("Please login as customer");
            }
            ## List of all reports for a customer
            $mobileDiagnosisDetails = MobileDiagnosis::with(['model', 'brand'])->where(['user_id' => $authId])->latest()->get();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $mobileDiagnosisDetails], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Customer old mobile diagnosis report single details
     * @param \App\Model\MobileDiagnosis $serialNumber
     * @return \Illuminate\Http\Response json
     */
    public function mobile_diagnosis_report_details($serialNumber)
    {
        try {
            $authId = auth()->id();

            ## Exception handling
            if (strtolower(auth()->user()->user_type) != 'customer') {
                $this->set_err_code(400);
                throw new \Exception("Please login as customer");
            }

            ## Customer mobile diagnosis report single details
            $mobileDiagnosisDetails = MobileDiagnosis::with(['model', 'brand'])->where(['user_id' => $authId, 'serial_number' => $serialNumber])->first();

            ## Exception handling
            if (empty($mobileDiagnosisDetails)) {
                $this->set_err_code(400);
                throw new \Exception("Mobile diagnosis report details not found");
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $mobileDiagnosisDetails], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Get device insurance package details for customer old devices
     * @param \App\Model\MobileDiagnosis $mobileDiagnosisId
     * @return \Illuminate\Http\Response json
     */
    public function get_device_insurance_package($mobileDiagnosisId)
    {
        try {
            ## Find mobile diagnosis report
            $mobileDiagnosis        = MobileDiagnosis::find($mobileDiagnosisId);

            ## Checking is mobile diagnosis exist
            if (!$mobileDiagnosis) {
                $this->set_err_code(400);
                throw new \Exception("Diagnosis report not found");
            }

            ## Checking expire time
            if (!$mobileDiagnosis->_valid_for && $mobileDiagnosis->status == 'approved') {
                $this->set_err_code(400);
                throw new \Exception("Diagnosis report expired");
            } elseif ($mobileDiagnosis->status == 'pending') {
                $this->set_err_code(400);
                throw new \Exception("Please wait for admin approval");
            }



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
                ->where('insurance_packages.brand_id', $mobileDiagnosis->brand_id)
                ->where('insurance_packages.device_model_id',  $mobileDiagnosis->device_model_id)
                ->where('insurance_packages.date_from', "<=", $date)
                ->where('insurance_packages.date_to', ">=", $date)
                ->where('parent_child_dealer_packages.child_id', $mobileDiagnosis->dealer_id)
                ->where('insurance_packages.status', 1)
                ->latest()->first();

            if (empty($insurancePackage)) {
                ## Find insurance package matching on brand, model & all parent child
                $insurancePackage   = InsurancePackage::where('device_subcategory_id', $deviceSubcategoryId)
                    ->select('insurance_packages.*')
                    ->where('insurance_packages.brand_id', $mobileDiagnosis->brand_id)
                    ->where('insurance_packages.device_model_id',  $mobileDiagnosis->device_model_id)
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
                        $insuranceTypeNames[$insTypeName]['price'] = appliedOnHandsetValueCalculation($mobileDiagnosis->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_two);
                        $insuranceTypeNames[$insTypeName]['insurance_price_id'] = $insurancePrice->id;
                    } else {
                        ## Excluded package type
                        $insuranceTypeNames[$insTypeName]['price'] = incPackBtExcItems($mobileDiagnosis->price, $insurancePrice->value, $insurancePrice->type);
                        $insuranceTypeNames[$insTypeName]['insurance_price_id'] = $insurancePrice->id;
                    }
                }

                ## For Screen protection insurance price calculations
                if ($insurancePrice->insuranceType->check_inc_type == 1) {

                    if ($insurancePrice->include_type == 'excluded') {
                        ## Excluded package type
                        $insuranceTypeNames[$insTypeName]['type'] = 'excluded';
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][1] = appliedOnHandsetValueCalculation($mobileDiagnosis->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_one);
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][2] = appliedOnHandsetValueCalculation($mobileDiagnosis->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_two);
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][0] = 0;
                    } else {
                        ## Excluded package type
                        $insuranceTypeNames[$insTypeName]['type'] = 'included';
                        $insuranceTypeNames[$insTypeName]['protection_times_for'][1] = appliedOnHandsetValueCalculation($mobileDiagnosis->price, $insurancePrice->value, $insurancePrice->type,  $insurancePrice->applied_value_two);
                        $insuranceTypeNames[$insTypeName]['insurance_price_id'] = $insurancePrice->id;
                    }
                }
            }
            $data = [
                'device_price'          => $mobileDiagnosis->price,
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
     * Purchase device insurance package for customer old devices
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\MobileDiagnosis $mobileDiagnosisId
     * @return \Illuminate\Http\Response json
     */
    public function purchase_device_insurance_package(Request $request, $mobileDiagnosisId)
    {


        $request->validate([
            "package_id" => ['required'],
            "email" => ['sometimes', 'nullable', 'email'],
            "customer_id_type" => ['required', 'in:nid,passport'],
            "customer_id_number" => ['required']

        ]);

        ## Creating a new instance of DeviceInsurance
        $DeviceInsurance = new DeviceInsurance();
        $auth_user = Auth::user();
        try {

            ## Find mobile diagnosis
            $mobileDiagnosis = MobileDiagnosis::with(['brand', 'model', 'imei', 'customer'])->where('status', 'approved')->find($mobileDiagnosisId);

            ## Checking is mobile diagnosis exist
            if (!$mobileDiagnosis) {
                $this->set_err_code(400);
                throw new \Exception("Diagnosis report not found");
            }

            if (!$mobileDiagnosis->_valid_for) {
                $this->set_err_code(400);
                throw new \Exception("Mobile Diagnosis Report Expired");
            }

            ## Find parent and child dealer
            $childDealer = Dealer::where('id', $mobileDiagnosis->dealer_id)->first();
            $parentDealer = Dealer::find($childDealer->parent_id);

            ## Find insurance package
            $package = InsurancePackage::find($request->package_id);
            $isChildInPackage = ParentChildDealerPackage::where('package_id', $request->package_id)
                ->where('child_id', $childDealer->id)->latest()->first();
            $isParentInPackage = ParentChildDealerPackage::where('package_id', $request->package_id)
                ->where('parent_id', $parentDealer->id)->latest()->first();



            ## Set Customer info for device insurance
            $customerInfo['name']                       = $auth_user->name;
            $customerInfo['customer_name']              = $auth_user->name;
            $customerInfo['customer_phone']             = $auth_user->phone;
            $customerInfo['customer_email']             = $request->email ?? $auth_user->email;
            $customerInfo['inc_exc_type']               = $request->customer_id_type;
            $customerInfo['number']                     = $request->customer_id_number;
            $DeviceInsurance->customer_info             = json_encode($customerInfo);

            ## Find Brand & Model
            $brand                                      = Brand::find($mobileDiagnosis->brand_id);
            $model                                      = DeviceModel::find($mobileDiagnosis->device_model_id);

            ## Set device info for device insurance
            $deviceInfo['brand_id']                     = $brand->id;
            $deviceInfo['device_model_id']              = $model->id;
            $deviceInfo['brand_name']                   = $brand->name;
            $deviceInfo['model_name']                   = $model->name;
            $deviceInfo['device_price']                 = $mobileDiagnosis->price;
            $deviceInfo['device_name']                  = $model->name . ' ' . $brand->name;
            $deviceInfo['imei_one']                     = $mobileDiagnosis->imei->imei_1;
            $deviceInfo['imei_two']                     = $mobileDiagnosis->imei->imei_2;
            $DeviceInsurance->device_info               = json_encode($deviceInfo);

            ## Device insurance other attribute values
            $DeviceInsurance->user_id                   = $auth_user->id;
            $DeviceInsurance->imei_one                  = $mobileDiagnosis->imei->imei_1;
            $DeviceInsurance->imei_two                  = $mobileDiagnosis->imei->imei_2;
            $DeviceInsurance->customer_will_pay_charge  = $package->customer_will_pay_charge;
            $DeviceInsurance->parent_dealer_id          = $parentDealer->id;
            $DeviceInsurance->child_dealer_id           = $childDealer->id;
            $DeviceInsurance->package_type              = $package->inc_exc_type;
            $DeviceInsurance->package_id                = $package->id;
            $DeviceInsurance->invoice_code              = mt_rand(111111, 999999);

            ## Initial values for commissins and price
            $totalBalance                               = 0;
            $totalAmountForCal                          = 0;
            $childCommissionForInclude                  = 0;
            $parentCommission                           = 0;
            $childDCommission                           = 0;
            $includedAmount                             = 0;
            $otherDealerCommissionAmount                = 0;

            ## Calculations for screen protection
            $deviceArr = [];

            ## Calculations for damange and theft
            if (!empty($request->insurance_price_id)) {

                foreach ($request->insurance_price_id as $pId) {
                    $insPrice = InsurancePrice::find($pId);
                    $insDevice =  InsuranceType::find($insPrice->insurance_type_id);

                    ## Screen protection should not be calculated when ins type is damage
                    if (is_array($request->insurance_price_id) && count($request->insurance_price_id) == 1 &&  strtolower($insDevice->name) == 'theft') {

                        if (isset($request->protection_times_price)) {
                            $totalBalance += $request->protection_times_price;
                            if ($request->protection_times_for > 0) {
                                $DeviceInsurance->protection_times_for = $request->protection_times_for;
                                array_push($deviceArr, ['parts_type' => 'Screen Protection', 'price' => $request->protection_times_price, 'ins_type' => 'excluded']);
                                $totalAmountForCal +=  $request->protection_times_price;
                            }
                        }
                    }

                    ### Price calculation for included type
                    if ($insPrice->include_type == 'included') {
                        $totalBalance -= InsurancePriceCalculation($insPrice->id, $mobileDiagnosis->price);
                        $includedAmount += InsurancePriceCalculation($insPrice->id, $mobileDiagnosis->price);
                    }
                    ### Price calculation for not included type

                    $totalBalance += InsurancePriceCalculation($insPrice->id, $mobileDiagnosis->price);

                    $totalAmountForCal += InsurancePriceCalculation($insPrice->id, $mobileDiagnosis->price);
                    array_push($deviceArr, ['parts_type' => $insDevice->name, 'price' => InsurancePriceCalculation($insPrice->id, $mobileDiagnosis->price), 'ins_type' => $insPrice->include_type]);
                }
            } else {

                if (isset($request->protection_times_price)) {
                    if ($request->protection_times_for > 0) {
                        $DeviceInsurance->protection_times_for = $request->protection_times_for;
                        array_push($deviceArr, ['parts_type' => 'Screen Protection', 'price' => $request->protection_times_price, 'ins_type' => 'excluded']);
                        $totalAmountForCal +=  $request->protection_times_price;
                    }
                }
            }



            ## Insurance discount calculations
            $date       =    date('Y-m-d');
            $time       =    date('H:i:s');
            $discount   = InsuranceDiscount::where('device_subcategory_id', 1)
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
                $discount = InsuranceDiscount::where('device_subcategory_id', 1)
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
            $DeviceInsurance->total_vat = calculatedVatResult($totalBalance, 'Device Insurance');
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
            $DeviceInsurance->claimable_amount = $mobileDiagnosis->price;
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
                $insDetails->claim_amount =  $mobileDiagnosis->price;
                $insDetails->save();
            }

            ## Insert or update imei data

            $imeiUsed = ImeiData::where(['imei_1' => $mobileDiagnosis->imei->imei_1, 'status' => 1, 'is_used' => 1])->first();
            if ($imeiUsed) {
                throw new \Exception('You are already insured');
            }
            $imeiExist = ImeiData::where(['imei_1' => $mobileDiagnosis->imei->imei_1, 'status' => 1, 'is_used' => 0])->first();
            if (empty($imeiExist)) {
                $imeiExist          = new ImeiData();
            }

            $imeiExist->imei_1       = $mobileDiagnosis->imei->imei_1;
            $imeiExist->imei_2       = $mobileDiagnosis->imei->imei_2;
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
     * Get device insurance purchase details
     * @param \App\Model\DeviceInsurance $deviceInsurance
     * @return \Illuminate\Http\Response json
     */
    public function get_device_insurance_purchase_details($deviceInsurance)
    {
        try {
            $auth_id = Auth::id();

            ## Get device insurance details
            $deviceInsurance = DeviceInsurance::where(['user_id' => $auth_id])->with(['package.policy_provider'])->find($deviceInsurance);

            ## Exception handling for device insurance
            if (!$deviceInsurance) {
                $this->set_err_code(400);
                throw new \Exception("Insurance not found");
            }

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
    public function pay_now_for_device_insurance_purchase($deviceInsurance)
    {
        try {
            ## Find device insurance
            $deviceInsurance =  DeviceInsurance::find($deviceInsurance);
            if (!$deviceInsurance) {
                $this->set_err_code(400);
                throw new \Exception("Please buy insurance first");
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
}
