<?php

namespace App\Http\Controllers\ChildDealer;

use App\User;
use App\Helpers\UserInfo;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Model\TravelInsOrder;
use App\Model\VerificationCode;
use App\Model\TravelInsPlansChart;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Model\TravelInsPlansCategory;
use Illuminate\Support\Facades\Session;

class TravelInsOrderController extends Controller
{
    use SmsService;
    public function index()
    {
        $travelOrders = TravelInsOrder::where('user_id', Auth::id())->latest()->get();
        Session::put('type', 'medical_insurance');
        return view('backend.child_dealer.travel_ins_orders.index', compact('travelOrders'));
    }
    public function selectCustomer()
    {
        return view('backend.child_dealer.travel_ins_orders.select_customer');
    }



    public function getOTP(Request $request)
    {
        $user = User::where(['phone' => $request->phone, 'user_type' => 'customer'])->first();

        if (empty($user)) {
            return 0;
        }
        $verification = VerificationCode::where('phone', $user->phone)->first();
        if (!empty($verification)) {
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $user->phone;
        //$verCode->code = mt_rand(1111,9999);
        $verCode->code = 1234;
        $verCode->status = 0;
        $verCode->save();
        $text = $verCode->code . " - আপনার ওয়ান-টাইম পাসওয়ার্ড";
        UserInfo::smsAPI("88" . $verCode->phone, $text);
        return 1;
    }
    public function storeOTP(Request $request)
    {
        $check = VerificationCode::where('code', $request->code)->where('phone', $request->phone)->where('status', 0)->first();
        if (!empty($check)) {
            $check->status = 1;
            $check->update();
            $user = User::where('phone', $request->phone)->first();
            //$user->verification_code = $request->code;
            $user->verification_code = 1234;
            $user->banned = 0;
            $user->save();
            Toastr::success('Phone number successfully verified.', 'Success');
            $type = Session::get('type');
            if ($type == 'device_insurance') {
                return redirect()->route('childDealer.device-insurances.create', encrypt($user->id));
            }
            if ($type == 'medical_insurance') {
                return redirect()->route('childDealer.travel-ins-orders.create', encrypt($user->id));
            }
        } else {
            return back();
        }
    }

    public function create($id)
    {
        Session::put('type', 'medical_insurance');
        $user = User::find(decrypt($id));
        return view('backend.child_dealer.travel_ins_orders.create', compact('user'));
    }

    public function store(Request $request)
    {

        $dateOfBirth = $request->dob;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $age = $diff->format('%y');
        $total_date = date_diff(date_create($request->flight_date), date_create($request->return_date))->format('%d');

        $travelCategory = TravelInsPlansCategory::find($request->plan_category_id);
        $travelPlanChart = TravelInsPlansChart::where('travel_ins_plans_category_id', $travelCategory->id)
            ->where('age_from', '<=', $age)
            ->where('age_to', '>=', $age)
            ->where('period_from', '<=', $total_date)
            ->where('period_to', '>=', $total_date)
            ->first();
        $ins_price = $travelPlanChart->ins_price;
        $totalVat = calculatedVatResult($ins_price, 'Travel Medical Insurance');
        $totalServiceCharge = calculatedServiceChargeResult($ins_price, 'Travel Medical Insurance');
        $child_dealer_commission = calculatedChildDealerCommission($ins_price);
        $parent_dealer_commission = calculatedParentDealerCommission($ins_price);
        $grandTotal = $ins_price + $totalVat + $totalServiceCharge;

        $travelInsOrder = new TravelInsOrder();
        $travelInsOrder->dealer_user_id = Auth::id();
        $travelInsOrder->user_id = $request->user_id;
        $travelInsOrder->travel_insurance_category_title = $travelCategory->country_type . ' ' . $travelCategory->plan_title . ' (' . $travelCategory->county_details . ')';
        $travelInsOrder->travel_ins_plans_category_id = $request->plan_category_id;
        $travelInsOrder->full_name = $request->full_name;
        $travelInsOrder->phone = $request->phone;
        $travelInsOrder->email = $request->email;
        $travelInsOrder->dob = $request->dob;
        $travelInsOrder->age = $age;
        $travelInsOrder->passport_number = $request->passport_number;
        $travelInsOrder->passport_expire_till = $request->passport_expire_till;
        $travelInsOrder->policy_number = 'Ins-48534';
        $travelInsOrder->ins_price = $ins_price;
        $travelInsOrder->vat_percentage = vat('Travel Medical Insurance');
        $travelInsOrder->total_vat = $totalVat;
        $travelInsOrder->service_amount = serviceCharge('Travel Medical Insurance');
        $travelInsOrder->service_total_amount = $totalServiceCharge;
        $travelInsOrder->grand_total = $grandTotal;
        $travelInsOrder->flight_number = $request->flight_number;
        $travelInsOrder->flight_date = $request->flight_date;
        $travelInsOrder->return_date = $request->return_date;
        $travelInsOrder->parent_dealer_commission = $parent_dealer_commission;
        $travelInsOrder->child_dealer_commission = $child_dealer_commission;
        $travelInsOrder->total_date = $total_date;

        $travelInsOrder->save();
        Toastr::success('Order submitted successfully');
        return redirect()->route('childDealer.travel-ins-order.index');
    }

    public function show($id)
    {
        $travelInsOrder = TravelInsOrder::find($id);
        return view('backend.child_dealer.travel_ins_orders.show', compact('travelInsOrder'));
    }

    public function edit($id)
    {
        $travelInsOrder = TravelInsOrder::find($id);
        return view('backend.child_dealer.travel_ins_orders.edit', compact('travelInsOrder'));
    }

    public function update(Request $request, $id)
    {
        $dateOfBirth = $request->dob;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $age = $diff->format('%y');
        $total_date = date_diff(date_create($request->flight_date), date_create($request->return_date))->format('%d');

        $travelCategory = TravelInsPlansCategory::find($request->plan_category_id);
        $travelPlanChart = TravelInsPlansChart::where('travel_ins_plans_category_id', $travelCategory->id)
            ->where('age_from', '<=', $age)
            ->where('age_to', '>=', $age)
            ->where('period_from', '<=', $total_date)
            ->where('period_to', '>=', $total_date)
            ->first();
        $ins_price = $travelPlanChart->ins_price;
        $totalVat = calculatedVatResult($ins_price, 'Travel Medical Insurance');
        $totalServiceCharge = calculatedServiceChargeResult($ins_price, 'Travel Medical Insurance');
        $child_dealer_commission = calculatedChildDealerCommission($ins_price);
        $parent_dealer_commission = calculatedParentDealerCommission($ins_price);
        $grandTotal = $ins_price + $totalVat + $totalServiceCharge;

        $travelInsOrder = TravelInsOrder::find($id);
        $travelInsOrder->user_id = $request->user_id;
        $travelInsOrder->travel_insurance_category_title = $travelCategory->country_type . ' ' . $travelCategory->plan_title . ' (' . $travelCategory->county_details . ')';
        $travelInsOrder->travel_ins_plans_category_id = $request->plan_category_id;
        $travelInsOrder->full_name = $request->full_name;
        $travelInsOrder->phone = $request->phone;
        $travelInsOrder->email = $request->email;
        $travelInsOrder->dob = $request->dob;
        $travelInsOrder->age = $age;
        $travelInsOrder->passport_number = $request->passport_number;
        $travelInsOrder->passport_expire_till = $request->passport_expire_till;
        $travelInsOrder->policy_number = 'Ins-48534';
        $travelInsOrder->ins_price = $ins_price;
        $travelInsOrder->vat_percentage = vat('Travel Medical Insurance');
        $travelInsOrder->total_vat = $totalVat;
        $travelInsOrder->service_amount = serviceCharge('Travel Medical Insurance');
        $travelInsOrder->service_total_amount = $totalServiceCharge;
        $travelInsOrder->grand_total = $grandTotal;
        $travelInsOrder->flight_number = $request->flight_number;
        $travelInsOrder->flight_date = $request->flight_date;
        $travelInsOrder->return_date = $request->return_date;
        $travelInsOrder->parent_dealer_commission = $parent_dealer_commission;
        $travelInsOrder->child_dealer_commission = $child_dealer_commission;
        $travelInsOrder->total_date = $total_date;

        $travelInsOrder->save();
        Toastr::success('Order updated successfully');
        return redirect()->route('childDealer.travel-ins-order.index');
    }

    public function destroy($id)
    {
        //
    }
}
