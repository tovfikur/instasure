<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\InsuranceDiscount;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class InsuranceDiscountController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:insurance-discount-list', ['only' => ['index']]);
        $this->middleware('permission:insurance-discount-details', ['only' => ['show']]);
        $this->middleware('permission:insurance-discount-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:insurance-discount-update-status', ['only' => ['statusUpdate']]);
    }
    public function index()
    {
        $insuranceDiscounts = InsuranceDiscount::latest()->get();
        return view('backend.admin.insurance_discount.index', compact('insuranceDiscounts'));
    }

    public function create()
    {
        return view('backend.admin.insurance_discount.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'device_category_id' => 'required',
            'device_subcategory_id' => 'required',
            'inc_exc_type' => 'required',
        ]);
        $discount = new InsuranceDiscount();
        $discount->device_category_id = $request->device_category_id;
        $discount->device_subcategory_id = $request->device_subcategory_id;
        if ($request->brand_model == 'single') {
            $this->validate($request, [
                'brand_id' => 'required',
                'device_model_id' => 'required',
            ]);
            $discount->device_brand_id = $request->brand_id;
            $discount->device_model_id = $request->device_model_id;
        }
        $discount->inc_exc_type = $request->inc_exc_type;
        $discount->date_from = $request->date_from;
        $discount->date_to = $request->date_to;
        $discount->time_from = $request->time_from;
        $discount->time_to = $request->time_to;
        $discount->discount_type = $request->discount_type;
        $discount->discount_price = $request->discount_price;
        $discount->parent_id = $request->parent_type == 'selected' ? $request->parent_id : 0;
        $discount->save();
        Toastr::success('Insurance Discount Inserted Successfully');
        return redirect()->route('admin.insurance-discount.index');
    }

    public function show($id)
    {
        $discount = InsuranceDiscount::findOrFail(decrypt($id));
        return view('backend.admin.insurance_discount.show', compact('discount'));
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
    public function statusUpdate(Request $request)
    {
        $discount = InsuranceDiscount::findOrFail($request->id);
        $discount->status = $request->status;
        if ($discount->save()) {
            return 1;
        }
        return 0;
    }
}
