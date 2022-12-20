<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TravelInsPlansCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TravelInsPlansCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:travel-ins-plans-categories-list', ['only' => ['index']]);
        $this->middleware('permission:travel-ins-plans-categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:travel-ins-plans-categories-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $TIPCategories = TravelInsPlansCategory::latest()->get();
        return view('backend.admin.travel_ins_plans_categories.index', compact('TIPCategories'));
    }

    public function create()
    {
        return view('backend.admin.travel_ins_plans_categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'plan_title' => 'required',
            'county_details' => 'required',
            'country_type' => 'required',
        ]);
        $TIPCategory = new TravelInsPlansCategory();
        $TIPCategory->plan_title = $request->plan_title;
        $TIPCategory->county_details = $request->county_details;
        $TIPCategory->country_type = $request->country_type;
        $TIPCategory->save();
        Toastr::success('Travel Ins Plans Category inserted successfully');
        return redirect()->route('admin.travel-ins-plans-categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $TIPCategory = TravelInsPlansCategory::find($id);
        return view('backend.admin.travel_ins_plans_categories.edit', compact('TIPCategory'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'plan_title' => 'required',
            'county_details' => 'required',
            'country_type' => 'required',
        ]);
        $TIPCategory = TravelInsPlansCategory::find($id);
        $TIPCategory->plan_title = $request->plan_title;
        $TIPCategory->county_details = $request->county_details;
        $TIPCategory->country_type = $request->country_type;
        $TIPCategory->save();
        Toastr::success('Travel Ins Plans Category updated successfully');
        return redirect()->route('admin.travel-ins-plans-categories.index');
    }

    public function destroy($id)
    {
        //
    }
}
