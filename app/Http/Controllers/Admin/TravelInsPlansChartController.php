<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\TravelInsPlansChart;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TravelInsPlansChartController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:travel-ins-plans-charts-list', ['only' => ['index']]);
        $this->middleware('permission:travel-ins-plans-charts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:travel-ins-plans-charts-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $TIPCharts = TravelInsPlansChart::latest()->get();
        return view('backend.admin.travel_ins_plans_charts.index', compact('TIPCharts'));
    }

    public function create()
    {
        return view('backend.admin.travel_ins_plans_charts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'travel_ins_plans_category_id' => 'required',
            'age_from' => 'required',
            'age_to' => 'required',
            'period_from' => 'required',
            'period_to' => 'required',
            'ins_price' => 'required',
        ]);
        $TIPChart = new TravelInsPlansChart();
        $TIPChart->travel_ins_plans_category_id = $request->travel_ins_plans_category_id;
        $TIPChart->policy_provider_id = $request->policy_provider_id;
        $TIPChart->age_from = $request->age_from;
        $TIPChart->age_to = $request->age_to;
        $TIPChart->period_from = $request->period_from;
        $TIPChart->period_to = $request->period_to;
        $TIPChart->ins_price = $request->ins_price;
        $TIPChart->validate_till = $request->validate_till;
        $TIPChart->save();
        Toastr::success('Travel Ins Plans Chart inserted successfully');
        return redirect()->route('admin.travel-ins-plans-charts.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $TIPChart = TravelInsPlansChart::find($id);
        return view('backend.admin.travel_ins_plans_charts.edit', compact('TIPChart'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'travel_ins_plans_category_id' => 'required',
            'age_from' => 'required',
            'age_to' => 'required',
            'period_from' => 'required',
            'period_to' => 'required',
            'ins_price' => 'required',
        ]);
        $TIPChart = TravelInsPlansChart::find($id);
        $TIPChart->travel_ins_plans_category_id = $request->travel_ins_plans_category_id;
        $TIPChart->policy_provider_id = $request->policy_provider_id;
        $TIPChart->age_from = $request->age_from;
        $TIPChart->age_to = $request->age_to;
        $TIPChart->period_from = $request->period_from;
        $TIPChart->period_to = $request->period_to;
        $TIPChart->ins_price = $request->ins_price;
        $TIPChart->validate_till = $request->validate_till;
        $TIPChart->save();
        Toastr::success('Travel Ins Plans Chart updated successfully');
        return redirect()->route('admin.travel-ins-plans-charts.index');
    }

    public function destroy($id)
    {
        //
    }
}
