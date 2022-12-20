<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PromoCode;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:promo-code-list', ['only' => ['index']]);
        $this->middleware('permission:promo-code-details', ['only' => ['show']]);
        $this->middleware('permission:promo-code-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:promo-code-update-status', ['only' => ['statusUpdate']]);
    }
    public function index()
    {
        $promoCodes = PromoCode::latest()->get();
        return view('backend.admin.promo_codes.index', compact('promoCodes'));
    }

    public function create()
    {
        return view('backend.admin.promo_codes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'device_category_id' => 'required',
            'device_subcategory_id' => 'required',
            'inc_exc_type' => 'required',
        ]);
        $promoCode = new PromoCode();
        $promoCode->code = $request->code;
        $promoCode->device_category_id = $request->device_category_id;
        $promoCode->device_subcategory_id = $request->device_subcategory_id;
        if ($request->brand_model == 'single') {
            $this->validate($request, [
                'brand_id' => 'required',
                'device_model_id' => 'required',
            ]);
            $promoCode->device_brand_id = $request->brand_id;
            $promoCode->device_model_id = $request->device_model_id;
        }
        $promoCode->inc_exc_type = $request->inc_exc_type;
        $promoCode->date_from = $request->date_from;
        $promoCode->date_to = $request->date_to;
        $promoCode->time_from = $request->time_from;
        $promoCode->time_to = $request->time_to;
        $promoCode->discount_type = $request->discount_type;
        $promoCode->discount_price = $request->discount_price;
        $promoCode->parent_id = $request->parent_type == 'selected' ? $request->parent_id : 0;
        $promoCode->save();
        Toastr::success('Promo Code Inserted Successfully');
        return redirect()->route('admin.promo-codes.index');
    }

    public function show($id)
    {
        $promoCode = PromoCode::find(decrypt($id));
        return view('backend.admin.promo_codes.show', compact('promoCode'));
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
        $promoCode = PromoCode::find($request->id);
        $promoCode->status = $request->status;
        if ($promoCode->save()) {
            return 1;
        }
        return 0;
    }
}
