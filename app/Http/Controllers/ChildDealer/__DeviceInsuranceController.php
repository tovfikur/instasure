<?php

namespace App\Http\Controllers\ChildDealer;

use App\User;
use App\Model\Brand;
use App\Model\Dealer;
use App\Model\ImeiData;
use App\Model\DeviceModel;
use App\Model\InsuranceType;
use Illuminate\Http\Request;
use App\Model\InsurancePrice;
use App\Model\DeviceInsurance;
use App\Model\InsurancePackage;
use App\Model\DeviceSubcategory;
use App\Model\InsuranceDiscount;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Model\DeviceInsuranceDetails;
use App\Model\ParentChildDealerPackage;
use Illuminate\Support\Facades\Session;
use App\Mail\DeviceInsurancePurchaseEmail;

class DeviceInsuranceController extends Controller
{

    public function index()
    {
        $childDealer = Dealer::where('user_id', Auth::id())->first();

        $deviceInsurances = DeviceInsurance::where('child_dealer_id', $childDealer->id)->latest()->get();

        Session::put('type', 'device_insurance');
        return view('backend.child_dealer.device_insurance.index', compact('deviceInsurances'));
    }

    public function create($id)
    {
        $user = User::find(($id));
        if (!$user) {
            Toastr::error('Invalid request');
            return redirect()->route('childDealer.select-customer');
        }
        $deviceSubcategories = DeviceSubcategory::where(['status' => 1])->where('name', 'like', '%Mobile%')->where('name', 'like', '%phone%')->first()->id;

        ## Find child dealer brands inherited from parent dealer ##
        $brands = [];
        $child_dealer = Dealer::with(['parent.brands'])->where('user_id', Auth::id())->first();
        $imei_check = $child_dealer->parent->imei_check;

        foreach ($child_dealer->parent->brands as $brand) {
            $brands[$brand->id] = $brand->name;
        }
        ## End: Find child dealer brands inherited from parent dealer ##

        return view('backend.child_dealer.device_insurance.create', compact('user', 'deviceSubcategories', 'brands', 'imei_check'));
    }

    public function getInsPrice(Request $request)
    {
        // dd($request->all());

        // $request->validate([
        //     'status' => ['required', 'in:pending,paid']
        // ]);

        $request->validate([
            "device_subcategory_id" => ['required'],
            "user_id" => ['required'],
            "name" => ['required'],
            "customer_name" => ['required'],
            "customer_phone" => ['required'],
            "customer_email" => ['sometimes', 'nullable', 'email'],
            "inc_exc_type" => ['required'],
            "number" => ['required'],
            "brand_id" => ['required'],
            "device_model_id" => ['required'],
            "device_price" => ['required'],
            "imei_one" => ['required'],
            "imei_two" => ['sometimes', 'nullable', 'min:15', 'max:25'],
            "package_id" => ['required'],
            "insuranceType_name" => ['required'],
            "device_parts_name" => ['required'],
            // "h_a_o_v" => ['required', 'min:1'],
            // "protection_times_for" => ['required'],
            // "in" => ['required', 'min:1'],
            "insurance_price_id" => ['required_if:protection_times_for,0'],

        ], [
            'insurance_price_id.required_if' => 'Select any insurance package please'
        ]);

        // dd($request->all());


        $childDealer = Dealer::where('user_id', Auth::id())->first();
        $parentDealer = Dealer::find($childDealer->parent_id);

        $package = InsurancePackage::find($request->package_id);
        $isChildInPackage = ParentChildDealerPackage::where('package_id', $request->package_id)
            ->where('child_id', $childDealer->id)->latest()->first();
        $isParentInPackage = ParentChildDealerPackage::where('package_id', $request->package_id)
            ->where('parent_id', $parentDealer->id)->latest()->first();

        $DeviceInsurance = new DeviceInsurance();

        ## Set Customer info for device insurance
        $customerInfo['name']                       = $request->name;
        $customerInfo['customer_name']              = $request->customer_name;
        $customerInfo['customer_phone']             = $request->customer_phone;
        $customerInfo['customer_email']             = $request->customer_email;
        $customerInfo['inc_exc_type']               = $request->inc_exc_type;
        $customerInfo['number']                     = $request->number;
        $DeviceInsurance->customer_info             = json_encode($customerInfo);
        ## Find Brand & Device Model
        $brand                                      = Brand::find($request->brand_id);
        $model                                      = DeviceModel::find($request->device_model_id);
        ## Set device info for device insurance
        $deviceInfo['device_model_id']              = $request->device_model_id;
        $deviceInfo['brand_id']                     = $request->brand_id;
        $deviceInfo['brand_name']                   = $brand->name;
        $deviceInfo['model_name']                   = $model->name;
        $deviceInfo['device_price']                 = $request->device_price;
        $deviceInfo['device_name']                  = $model->name . ' ' . $brand->name;
        $deviceInfo['imei_one']                     = $request->imei_one;
        $deviceInfo['imei_two']                     = $request->imei_two;
        $deviceInfo['battery_number']               = $request->battery_number;
        $DeviceInsurance->device_info               = json_encode($deviceInfo);
        $DeviceInsurance->user_id                   = $request->user_id;
        $DeviceInsurance->imei_one                  = $request->imei_one;
        $DeviceInsurance->imei_two                  = $request->imei_two;
        $DeviceInsurance->customer_will_pay_charge  = $package->customer_will_pay_charge;
        $DeviceInsurance->parent_dealer_id          = $parentDealer->id;
        $DeviceInsurance->child_dealer_id           = $childDealer->id;
        $DeviceInsurance->package_type              = $package->inc_exc_type;
        $DeviceInsurance->package_id                = $request->package_id;
        $DeviceInsurance->invoice_code              = mt_rand(111111, 999999);
        $totalBalance                               = $request->h_a_o_v ?? 0;

        $totalAmountForCal                          = 0;
        $childCommissionForInclude                  = 0;
        $parentCommission                           = 0;
        $childDCommission                           = 0;
        $includedAmount                             = 0;
        $otherDealerCommissionAmount                = 0;

        $deviceArr = [];
        if (isset($request->h_a_o_v)) {
            if ($request->protection_times_for > 0) {
                $DeviceInsurance->protection_times_for = $request->protection_times_for;
                array_push($deviceArr, ['parts_type' => $request->device_parts_name, 'price' => $request->h_a_o_v, 'ins_type' => 'excluded']);
                $totalAmountForCal +=  $request->h_a_o_v;
            }
        }
        if (!empty($request->insurance_price_id)) {
            foreach ($request->insurance_price_id as $pId) {
                $insPrice = InsurancePrice::find($pId);
                $insDevice =  InsuranceType::find($insPrice->insurance_type_id);
                if ($insPrice->include_type == 'included') {
                    $totalBalance -= InsurancePriceCalculation($insPrice->id, $request->device_price);
                    $includedAmount += InsurancePriceCalculation($insPrice->id, $request->device_price);
                }
                $totalBalance += InsurancePriceCalculation($insPrice->id, $request->device_price);
                $totalAmountForCal += InsurancePriceCalculation($insPrice->id, $request->device_price);
                array_push($deviceArr, ['parts_type' => $insDevice->name, 'price' => InsurancePriceCalculation($insPrice->id, $request->device_price), 'ins_type' => $insPrice->include_type]);
            }
        }
        $date    =    date('Y-m-d');
        $time   =    date('H:i:s');
        $discount = InsuranceDiscount::where('device_subcategory_id', 1)
            ->where('device_brand_id', $request->brand_id)->where('device_model_id',  $request->device_model_id)
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
        $DeviceInsurance->sub_total = $totalBalance;
        $DeviceInsurance->total_vat = calculatedVatResult($totalBalance, 'Device Insurance');
        $DeviceInsurance->grand_total = $totalBalance + calculatedVatResult($totalBalance, 'Device Insurance') - $total_discount;
        $DeviceInsurance->insurance_type_value = json_encode($deviceArr);
        $DeviceInsurance->totalAmountForCal = $totalAmountForCal;
        $DeviceInsurance->includedAmount = $includedAmount;
        $DeviceInsurance->includedVatAmount = calculatedVatResult($includedAmount, 'Device Insurance');
        $DeviceInsurance->vat_pecentage = vat('Device Insurance');
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
        $DeviceInsurance->claimable_amount = $request->device_price;
        $DeviceInsurance->claimed_amount = 0;

        try {
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
                $insDetails->claim_amount =  $request->device_price;
                $insDetails->save();
            }

            ## Insert or update imei data

            $imeiUsed = ImeiData::where(['imei_1' => $request->imei_one, 'status' => 1, 'is_used' => 1])->first();
            if ($imeiUsed) {
                throw new \Exception('IMEI already used');
            }
            $imeiExist = ImeiData::where(['imei_1' => $request->imei_one, 'status' => 1, 'is_used' => 0])->first();
            if (empty($imeiExist)) {
                $imeiExist          = new ImeiData();
            }

            $imeiExist->imei_1       = $request->imei_one;
            $imeiExist->imei_2       = $request->imei_two;
            $imeiExist->parent_id    = $childDealer->id;
            $imeiExist->is_used      = 0;
            $imeiExist->status       = 1;
            $imeiExist->save();

            return redirect()->route('childDealer.device-insurance.order', encrypt($DeviceInsurance->id));
        } catch (\Throwable $th) {
            $DeviceInsurance->delete();
            if (count($DeviceInsurance->device_insurace_details)) {
                $DeviceInsurance->device_insurace_details()->delete();
            }

            Toastr::error($th->getMessage());
            return redirect()->back();
        }
    }

    public function getDeviceOrderDetails($id)
    {
        $deviceOrderDetails = DeviceInsurance::with(['package.policy_provider', 'package.insurance_category'])->find((decrypt($id)));
        if (!$deviceOrderDetails) {
            Toastr::error('Invalid request');
            return redirect()->route('childDealer.device-insurance.index');
        }
        return view('backend.child_dealer.device_insurance.price_result', compact('deviceOrderDetails'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getDeviceSubcategories(Request $request)
    {
        $deviceSubcategories = DeviceSubcategory::where('device_category_id', $request->device_category_id)->get();
        return $deviceSubcategories;
    }

    public function getDeviceModels(Request $request)
    {

        $deviceModels = DeviceModel::where('brand_id', $request->brand_id)->get();
        return $deviceModels;
    }

    public function insurance_price_history(Request $request)
    {
    }

    public function getPackage(Request $request)
    {

        $childDealer        = Dealer::where('user_id', Auth::id())->first();
        $date               =    date('Y-m-d');
        $time               =    date('H:i:s');
        $device_price       = $request->device_price;
        $insurancePackage   = null;

        $insurancePackage   = InsurancePackage::where('device_subcategory_id', $request->device_subcategory_id)
            ->select('insurance_packages.*')
            ->join('parent_child_dealer_packages', 'parent_child_dealer_packages.package_id', '=', 'insurance_packages.id')
            ->where('insurance_packages.brand_id', $request->brand_id)
            ->where('insurance_packages.device_model_id',  $request->device_model_id)
            ->where('insurance_packages.date_from', "<=", $date)
            ->where('insurance_packages.date_to', ">=", $date)
            //            ->where('insurance_packages.time_from',"<=", $time)
            //            ->where('insurance_packages.time_to',">=", $time)
            ->where('parent_child_dealer_packages.child_id', $childDealer->id)
            ->where('insurance_packages.status', 1)
            ->latest()->first();
        if (empty($insurancePackage)) {

            $insurancePackage = InsurancePackage::where('device_subcategory_id', $request->device_subcategory_id)
                ->where('brand_id', 0)->where('device_model_id', 0)
                //->where('inc_exc_type',$request->inc_exc_type)
                ->where('status', 1)
                ->latest()->first();
        }



        $insurancePrices = InsurancePrice::where('insurance_package_id', $insurancePackage->id)->get();

        // dd($request->all(), $insurancePackage, $insurancePrices);

        return view('backend.child_dealer.device_insurance.insurance_price_history', compact('insurancePackage', 'device_price', 'insurancePrices'));
    }

    public function imeiCheckOne($code)
    {
        $childDealer = Dealer::where('user_id', Auth::id())->first();
        $check = ImeiData::where(['imei_1' => $code, 'status' => 1, 'is_used' => 0, 'parent_id' => $childDealer->id])->first();
        if (!empty($check)) {
            return response()->json(['response' => 1]);
        } else {
            return response()->json(['response' => 0]);
        }
    }

    public function imeiCheckTwo($code)
    {
        $check = ImeiData::where('imei_2', $code)->first();
        if (!empty($check)) {
            return response()->json(['response' => 1]);
        } else {
            return response()->json(['response' => 0]);
        }
    }
    public function payNow($orderId)
    {
        $orderId = decrypt($orderId);
        $deviceInsurance =  DeviceInsurance::find($orderId);
        $imeiUsed = ImeiData::where('imei_1', $deviceInsurance->imei_one)->where('is_used', '>', 0)->first();
        if ($imeiUsed) {
            Toastr::error('IMEI already used');
            return redirect()->back();
        }

        amarPayPaymentGateway('device_insurance', $orderId);
    }
    public function disbursed($orderId)
    {

        $deviceInsurance =  DeviceInsurance::with(['package.policy_provider', 'package.insurance_category'])->find(decrypt($orderId));

        if (!empty($deviceInsurance)) {
            $deviceInsurance->payment_method = 'disbursed';
            $deviceInsurance->payment_status = 'disbursed';
            $deviceInsurance->save();
            $result = deviceInsuranceCommissionsDisbursed(decrypt($orderId));
            return response()->json(["response" => $result], 200);
        } else {
            return response()->json(["response" => 0], 200);
        }
        //amarPayPaymentGateway('device_insurance', decrypt($id) );
    }
    public function policyInvoice($id)
    {
        $deviceInsurance = DeviceInsurance::find($id);
        return view('backend.child_dealer.device_insurance.policy_invoice', compact('deviceInsurance'));
    }
    public function policyCertificate($id)
    {
        $deviceInsurance = DeviceInsurance::find(decrypt($id));
        return view('backend.child_dealer.device_insurance.policy_certificate', compact('deviceInsurance'));
    }

    public function deviceInsSaleHistory()
    {
        $childDealer = Dealer::where('user_id', Auth::id())->first();
        $deviceInsurances = DeviceInsurance::where('child_dealer_id', $childDealer->id)->where('status', 'completed')->latest()->get();
        return view('backend.child_dealer.device_insurance.sale_history', compact('deviceInsurances'));
    }

    /**
     * Get customer details via mobile number
     * @param Request $request
     * @return Response Json
     */
    public function get_customer(Request $request)
    {
        $user = User::where(['phone' => $request->phone, 'user_type' => 'customer'])->first();

        if (empty($user)) {
            return response()->json(['status' => false, 'message' => 'No customer belongs to this phone number, please add new customer']);
        }
        return response()->json(['status' => true, 'message' => 'Customer found', 'id' => $user->id]);
    }
}
