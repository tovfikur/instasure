<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:brand-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
        $this->middleware('permission:brand-status-update', ['only' => ['updateStatus']]);
    }
    public function index()
    {
        $brands = Brand::all();
        return view('backend.admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.admin.brands.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,name',
        ]);

        $brand = new Brand;
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->status = 1;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $image = $request->file('logo');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //            resize image for hospital and upload
            $proImage = Image::make($image)->resize(120, 80)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/brands/' . $imagename, $proImage);
        } else {
            $imagename = "default.png";
        }
        $brand->logo = $imagename;
        $brand->save();
        Toastr::success('Brand Created Successfully');
        return redirect()->route('admin.brands.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('backend.admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands,name,' . $id,
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $image = $request->file('logo');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (Storage::disk('public')->exists('uploads/brands/' . $brand->logo)) {
                Storage::disk('public')->delete('uploads/brands/' . $brand->logo);
            }
            //            resize image for hospital and upload
            $proImage = Image::make($image)->resize(120, 80)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/brands/' . $imagename, $proImage);
        } else {
            $imagename = $brand->logo;
        }
        $brand->logo = $imagename;
        $brand->save();
        Toastr::success('Brand updated successfully', 'Success');
        return redirect()->route('admin.brands.index');
    }

    //    public function destroy($id)
    //    {
    //        $brand = Brand::find($id);
    //        if(Storage::disk('public')->exists('uploads/brands/'.$brand->logo))
    //        {
    //            Storage::disk('public')->delete('uploads/brands/'.$brand->logo);
    //        }
    //        $brand->delete();
    //        Toastr::success('Brand deleted successfully','Success');
    //        return back();
    //    }

    public function updateStatus(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $brand->status = $request->status;
        if ($brand->save()) {
            return 1;
        }
        return 0;
    }
}
