<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChildDealerInfoCollections;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Dealer;
use App\Model\DeviceCategory;
use App\Model\DeviceModel;
use App\Model\DeviceSubcategory;
use App\Model\InsurancePackage;
use App\Model\InsurancePrice;
use App\Model\InsuranceType;
use App\Model\ParentChildDealer;
use App\Model\ParentChildDealerPackage;
use App\Model\PolicyProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class InsurancePackageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:insurance-package-list', ['only' => ['index']]);
        $this->middleware('permission:insurance-package-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:insurance-package-details', ['only' => ['show']]);
        $this->middleware('permission:insurance-package-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:insurance-package-device-sub-categories', ['only' => ['getDeviceSubcategories']]);
        $this->middleware('permission:insurance-package-device-models', ['only' => ['getDeviceModels']]);
        $this->middleware('permission:insurance-package-device-insurance-type', ['only' => ['getDeviceInsuranceType']]);
        $this->middleware('permission:insurance-package-device-insurance-type-edit', ['only' => ['editDeviceInsuranceType']]);
        $this->middleware('permission:insurance-package-status-change', ['only' => ['packageStatusChange']]);
    }
    public function index()
    {
        $insurancePackages = InsurancePackage::latest()->get();
        return view('backend.admin.insurance_packages.index', compact('insurancePackages'));
    }

    public function parentDealerWiseChild($id)
    {
        $childs = Dealer::where(['parent_id' => $id, 'user_type' => 'child_dealer'])->get();

        if (!empty($childs)) {
            $childDealers = new ChildDealerInfoCollections($childs);
            return response()->json(['response' => $childDealers], 200);
        }
    }

    public function create()
    {
        $parents                = Dealer::where('user_type', 'parent_dealer')->get();
        $policyProvider         = PolicyProvider::get();
        $insurance_categories   =  Category::get();
        $device_categories      =  DeviceCategory::get();
        $brands                 =  Brand::get();
        return view('backend.admin.insurance_packages.create', compact('parents', 'policyProvider', 'insurance_categories', 'device_categories', 'brands'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $insurancePackage = new InsurancePackage();
        $this->validate($request, [
            'package_name' => 'required',
            'device_category_id' => 'required',
            'device_subcategory_id' => 'required',
            'inc_exc_type' => 'required',
            'choice_no' => 'required',
        ]);
        if ($request->brand_model == 'single') {
            $this->validate($request, [
                'brand_id' => 'required',
                'device_model_id' => 'required',
            ]);
            $insurancePackage->brand_id = $request->brand_id;
            $insurancePackage->device_model_id = $request->device_model_id;
        }
        if ($request->inc_exc_type == 'included' && $request->parent_type == 'all') {
            Toastr::warning('Please select parent and child.');
            return back();
        }

        $insurancePackage->package_name = $request->package_name;
        $insurancePackage->device_category_id = $request->device_category_id;
        $insurancePackage->device_subcategory_id = $request->device_subcategory_id;
        $insurancePackage->insurance_category_id = $request->insurance_category_id;
        $insurancePackage->inc_exc_type = $request->inc_exc_type;
        $insurancePackage->date_from = $request->date_from;
        $insurancePackage->date_to = $request->date_to;
        $insurancePackage->time_from = $request->time_from;
        $insurancePackage->time_to = $request->time_to;
        $insurancePackage->customer_will_pay_charge = $request->customer_will_pay_charge;
        $insurancePackage->parent_id = $request->parent_type == 'selected' ? $request->parent_id : 0;
        $insurancePackage->insurance_provider_id = $request->insurance_provider_id;
        $insurancePackage->insurance_provider_cost = $request->insurance_provider_cost;
        $insurancePackage->insurance_provider_cost_type = $request->insurance_provider_cost_type;
        $insurancePackage->parent_dealer_commission = $request->parent_dealer_commission;
        $insurancePackage->parent_dealer_commission_type = $request->parent_dealer_commission_type;
        $insurancePackage->child_dealer_commission = $request->child_dealer_commission;
        $insurancePackage->child_dealer_commission_type = $request->child_dealer_commission_type;
        $insurancePackage->other_dealer_commission = $request->other_dealer_commission;
        $insurancePackage->other_dealer_commission_type = $request->other_dealer_commission_type;
        //$insurancePackage->insurance_type_id = json_encode($request->insurance_type_id);
        $insurancePackage->save();
        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $no) {
                $str = 'choice_options_' . $no;
                $type = 'price_type_' . $no;
                $incExcType = 'include_type_' . $no;
                $appliedValueOne = 'applied_value_one_' . $no;
                $appliedValueTwo = 'applied_value_two_' . $no;
                //dd($appliedValueTwo);
                $insurancePrice = new InsurancePrice();
                $insurancePrice->insurance_type_id = $no;
                $insurancePrice->insurance_package_id = $insurancePackage->id;
                $insurancePrice->type = $request[$type];
                $insurancePrice->value = $request[$str];
                $insurancePrice->include_type = $request[$incExcType];
                $insurancePrice->applied_value_one = $request[$appliedValueOne];
                $insurancePrice->applied_value_two = $request[$appliedValueTwo];
                $insurancePrice->save();
            }
        }
        if ($request->parent_type == 'selected' && !empty($insurancePackage)) {

            foreach ($request->child_id as $cId) {
                $pcpObj = new ParentChildDealerPackage();
                $pcpObj->package_id = $insurancePackage->id;
                $pcpObj->parent_id = $request->parent_id;
                $pcpObj->child_id = $cId;
                $pcpObj->save();
            }
        }
        Toastr::success('Insurance Package created successfully');
        return redirect()->route('admin.insurance-packages.index');
    }

    public function show($id)
    {
        $package = InsurancePackage::find($id);
        $insurancePrices = InsurancePrice::where('insurance_package_id', $package->id)->get();
        $parentDetails = ParentChildDealerPackage::where('package_id', $package->id)->get();
        return view('backend.admin.insurance_packages.show', compact('insurancePrices', 'package', 'parentDetails'));
    }

    public function edit($id)
    {
        $insurancePackage = InsurancePackage::find($id);
        return view('backend.admin.insurance_packages.edit', compact('insurancePackage'));
    }

    public function update(Request $request, $id)
    {
        $insurancePackage = InsurancePackage::find($id);
        $insurancePackage->device_category_id = $request->device_category_id;
        $insurancePackage->device_subcategory_id = $request->device_subcategory_id;
        $insurancePackage->brand_id = $request->brand_id;
        $insurancePackage->device_model_id = $request->device_model_id;
        $insurancePackage->type = $request->type;
        $insurancePackage->insurance_type_id = json_encode($request->insurance_type_id);
        $insurancePackage->save();

        if ($request->has('choice_no')) {
            foreach ($request->choice_no as $no) {
                $str = 'choice_options_' . $no;
                $type = 'price_type_' . $no;
                $check = InsurancePrice::where('insurance_package_id', $insurancePackage->id)->where('insurance_type_id', $no)->first();
                if (empty($check)) {
                    $insurancePrice = new InsurancePrice();
                    $insurancePrice->insurance_type_id = $no;
                    $insurancePrice->insurance_package_id = $insurancePackage->id;
                    $check->type = $request[$type];
                    $insurancePrice->value = $request[$str];
                    $insurancePrice->save();
                } else {
                    $check->insurance_type_id = $no;
                    $check->insurance_package_id = $insurancePackage->id;
                    $check->type = $request[$type];
                    $check->value = $request[$str];
                    $check->save();
                }
            }
        }
        Toastr::success('Insurance Package updated successfully');
        return redirect()->route('admin.insurance-packages.index');
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

    public function getDeviceInsuranceType(Request $request)
    {
        $insuranceTypes = InsuranceType::where(['device_subcategory_id' => $request->device_subcategory_id, 'status' => 1])->orderBy('set_priority', 'ASC')->get();

        return view('backend.admin.insurance_packages.insurance_prices', compact('insuranceTypes'));
        //        return $insuranceTypes;
    }

    public function editDeviceInsuranceType(Request $request)
    {
        $insurancePackage = InsurancePackage::find($request->insurance_package_id);
        $insuranceTypes = InsuranceType::where('device_subcategory_id', $request->device_subcategory_id)->get();
        return view('backend.admin.insurance_packages.insurance_prices_edit', compact('insuranceTypes', 'insurancePackage'));
    }

    public function packageStatusChange(Request $request)
    {
        $package = InsurancePackage::findOrFail($request->id);
        $package->status = $request->status;
        if ($package->save()) {
            return 1;
        }
        return 0;
    }
}
