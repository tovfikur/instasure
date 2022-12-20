<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Partner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:partners-list', ['only' => ['index']]);
        $this->middleware('permission:partners-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:partners-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $partners = Partner::latest()->get();
        return view('backend.admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('backend.admin.partners.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
        ]);

        $partner = new Partner();
        $partner->name = $request->name;
        $image = $request->file('image');
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $proImage = Image::make($image)->resize(145, 80)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/partners/' . $imagename, $proImage);
        } else {
            $imagename = "default.png";
        }
        $partner->image = $imagename;
        $partner->save();
        Toastr::success('Partner Inserted Successfully');
        return redirect()->route('admin.partners.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $partner = Partner::find($id);
        return view('backend.admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::find($id);
        $partner->name = $request->name;
        $image = $request->file('image');
        if (isset($image)) {
            if (Storage::disk('public')->exists('uploads/partners/' . $partner->icon)) {
                Storage::disk('public')->delete('uploads/partners/' . $partner->icon);
            }
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $proImage = Image::make($image)->resize(145, 80)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/partners/' . $imagename, $proImage);
        } else {
            $imagename = $partner->image;
        }
        $partner->image = $imagename;
        $partner->save();

        Toastr::success('Partner Updated Successfully');
        return redirect()->route('admin.partners.index');
    }

    public function destroy($id)
    {
        //
    }
}
