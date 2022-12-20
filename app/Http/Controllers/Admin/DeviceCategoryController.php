<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeviceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class DeviceCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:device-category-list', ['only' => ['index']]);
        $this->middleware('permission:device-category-details', ['only' => ['show']]);
        $this->middleware('permission:device-category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:device-category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:device-category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $deviceCategories = DeviceCategory::latest()->get();
        return view('backend.admin.device_categories.index', compact('deviceCategories'));
    }

    public function create()
    {
        return view('backend.admin.device_categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $deviceCategory = new DeviceCategory();
        $deviceCategory->name = $request->name;
        $deviceCategory->slug = Str::slug($request->name);
        $deviceCategory->meta_title = $request->meta_title;
        $deviceCategory->meta_description = $request->meta_description;
        $image = $request->file('icon');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/device_categories/' . $imagename, $proImage);
        } else {
            $imagename = "default.png";
        }
        $deviceCategory->icon = $imagename;
        $deviceCategory->save();
        Toastr::success('Device Category Created Successfully');
        return redirect()->route('admin.device-categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $deviceCategory = DeviceCategory::find($id);
        if (!$deviceCategory) {
            Toastr::error('Invalid request');
            return redirect()->route('admin.device-categories.index');
        }
        return view('backend.admin.device_categories.edit', compact('deviceCategory'));
    }

    public function update(Request $request, $id)
    {
        $deviceCategory = DeviceCategory::find($id);
        $deviceCategory->name = $request->name;
        $deviceCategory->slug = Str::slug($request->name);
        $deviceCategory->meta_title = $request->meta_title;
        $deviceCategory->meta_description = $request->meta_description;
        $image = $request->file('icon');
        if (isset($image)) {
            if (Storage::disk('public')->exists('uploads/device_categories/' . $deviceCategory->icon)) {
                Storage::disk('public')->delete('uploads/device_categories/' . $deviceCategory->icon);
            }
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/device_categories/' . $imagename, $proImage);
        } else {
            $imagename = $deviceCategory->icon;
        }
        $deviceCategory->icon = $imagename;
        $deviceCategory->save();
        Toastr::success('Device Category Updated Successfully');
        return redirect()->route('admin.device-categories.index');
    }

    public function destroy($id)
    {
        //
    }
}
