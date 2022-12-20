<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\InsuranceType;
use App\Model\DeviceSubcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpseclib\Crypt\Random;

class InsuranceTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:insurance-type-list', ['only' => ['index']]);
        $this->middleware('permission:insurance-type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:insurance-type-edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $insuranceTypes = InsuranceType::with('deviceSubcategory')->get();
        return view('backend.admin.insurance_types.index', compact('insuranceTypes'));
    }

    public function create()
    {
        $data['deviceSubcategories'] = DeviceSubcategory::all();
        $data['count'] = InsuranceType::count() + 1;
        return view('backend.admin.insurance_types.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $insuranceType = new InsuranceType();
        $insuranceType->device_subcategory_id = $request->device_subcategory_id;
        $insuranceType->name = $request->name;
        $insuranceType->check_inc_type = $request->check_inc_type;
        $insuranceType->set_priority = $request->set_priority ? $request->set_priority : InsuranceType::count() + 1;
        $insuranceType->slug = Str::slug($request->name . '-' . Str::random(5));
        $insuranceType->save();
        Toastr::success('Inserted successfully');
        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $insuranceType = InsuranceType::find($id);
        if (!$insuranceType) {
            Toastr::error('Invalid request');
            return redirect()->route('admin.insurance-types.index');
        }
        $deviceSubcategories = DeviceSubcategory::get();
        return view('backend.admin.insurance_types.edit', compact('insuranceType', 'deviceSubcategories'));
    }

    public function update(Request $request, $id)
    {
        $insuranceType = InsuranceType::find($id);
        $insuranceType->device_subcategory_id = $request->device_subcategory_id;
        $insuranceType->name = $request->name;
        $insuranceType->set_priority = $request->set_priority ? $request->set_priority : InsuranceType::count() + 1;
        $insuranceType->check_inc_type = $request->check_inc_type;
        $insuranceType->slug = Str::slug($request->name . '-' . Str::random(5));
        $insuranceType->save();
        Toastr::success('Updated successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
    /**
     * Change status
     */
    public function change_status(InsuranceType $insuranceType)
    {
        $insuranceType->status = $insuranceType->status == 1 ? 0 : 1;
        $insuranceType->save();
        return back();
    }
}
