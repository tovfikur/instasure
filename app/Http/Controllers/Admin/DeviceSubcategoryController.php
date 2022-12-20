<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeviceSubcategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceSubcategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:device-subcategory-list', ['only' => ['index']]);
        $this->middleware('permission:device-subcategory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:device-subcategory-edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $deviceSubcategories = DeviceSubcategory::latest()->get();
        return view('backend.admin.device_subcategories.index', compact('deviceSubcategories'));
    }

    public function create()
    {
        return view('backend.admin.device_subcategories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'device_category_id' => 'required',
        ]);
        $deviceSubcategory = new DeviceSubcategory();
        $deviceSubcategory->device_category_id = $request->device_category_id;
        $deviceSubcategory->name = $request->name;
        $deviceSubcategory->slug = Str::slug($request->name) . '-' . Str::random(5);
        $deviceSubcategory->meta_title = $request->meta_title;
        $deviceSubcategory->meta_description = $request->meta_description;
        $deviceSubcategory->save();
        Toastr::success('Device Subcategory inserted successfully');
        return redirect()->route('admin.device-subcategories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $deviceSubcategory = DeviceSubcategory::find($id);
        return view('backend.admin.device_subcategories.edit', compact('deviceSubcategory'));
    }

    public function update(Request $request, $id)
    {
        $deviceSubcategory = DeviceSubcategory::find($id);
        $deviceSubcategory->device_category_id = $request->device_category_id;
        $deviceSubcategory->name = $request->name;
        $deviceSubcategory->slug = Str::slug($request->name) . '-' . Str::random(5);
        $deviceSubcategory->meta_title = $request->meta_title;
        $deviceSubcategory->meta_description = $request->meta_description;
        $deviceSubcategory->save();
        Toastr::success('Device Subcategory updated successfully');
        return redirect()->route('admin.device-subcategories.index');
    }

    public function destroy($id)
    {
        //
    }
}
