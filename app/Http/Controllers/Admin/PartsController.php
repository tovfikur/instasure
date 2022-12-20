<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Part;
use App\Model\Dealer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Requests\PartsExcelImportRequest;
use App\Http\Requests\PartsUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PartsImport;
use App\Exports\PartsExport;
use App\Model\Brand;
use App\Model\DeviceModel;
use Illuminate\Support\Facades\Auth;

class PartsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:parts-list', ['only' => ['index', 'store']]);
        $this->middleware('permission:parts-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:parts-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:parts-delete', ['only' => ['destroy']]);
        $this->middleware('permission:parts-status-update', ['only' => ['updateStatus']]);
    }

    /**
     * Parts bulk upload modal display
     *
     * @return \Illuminate\Http\Response
     */

    public function upload_excel()
    {
        return view('backend.admin.parts.upload_excel');
    }
    /**
     * Parts bulk upload of svg type file processing
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_excel_post(PartsExcelImportRequest $request)
    {
        Excel::import(new PartsImport, $request->file('file'));
        Toastr::success('Parts Added Successfully');
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parts = Part::latest()->get();
        return view('backend.admin.parts.index', compact('parts'));
    }
    /**
     * Display a listing of the resource using ajax call
     *
     * @return \Illuminate\Http\Response
     */
    public function parts_list_ajax()
    {
        return Part::ajax();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = Brand::withCount('model')->where('status', 1)->get();
        $parentDealers  = Dealer::where('user_type', 'parent_dealer')->get();
        return view('backend.admin.parts.create', compact('parentDealers', 'brands'));
    }
    /**
     * Get brand wise models using ajax call
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function get_brand_wise_model_ajax(Request $request)
    {
        $models = DeviceModel::where(['status' => 1, 'brand_id' => $request->brand_id])->get();
        return view('backend.admin.parts.get_brand_wise_model_ajax', compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'parts_name' => 'required',
            'parts_price' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
        ]);

        if ($request->download) {
            $sample_data = $this->get_sample_data($request);
            $headings = $this->get_parts_heading();
            try {
                return Excel::download(new PartsExport($sample_data, $headings), 'parts-sample-data-downloaded.xlsx');
                Toastr::success('Parts Sample Downloaded');
            } catch (\Throwable $th) {
                Toastr::error('Query Error');
            }
            return back();
        }

        $parts_exist = Part::where(['parts_name' => $request->parts_name, 'brand_id' => $request->brand_id, 'model_id' => $request->model_id])->first();

        if ($parts_exist) {
            Toastr::error('Parts already exist with same brand & model');
            return redirect()->back()->with('parts_name', $request->parts_name)->with('parts_price', $request->parts_price)->with('note', $request->note);
        }

        $parts = new Part();
        $parts->parts_name          = $request->parts_name;
        $parts->parts_price         = $request->parts_price;
        $parts->parent_dealer_id    = $request->parent_dealer_id ?? 0;
        $parts->brand_id            = $request->brand_id;
        $parts->model_id            = $request->model_id;
        $parts->note                = $request->note;
        $parts->user_id             = Auth::id();
        $parts->save();
        Toastr::success('Parts Added Successfully');
        return back();
    }
    /**
     * Get parts heading
     *
     * @return array
     */
    private function get_parts_heading()
    {
        $headings = [
            'parts_name',
            'parts_price',
            'brand_id',
            'model_id',
            'user_id',
            'parent_dealer_id',
            'status',
            'is_used',
            'note',
        ];

        return $headings;
    }
    /**
     * Get parts sample data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private function get_sample_data($request)
    {
        $sample_data = [
            $request->parts_name,
            $request->parts_price,
            $request->brand_id,
            $request->model_id,
            Auth::id(),
            $request->parent_dealer_id,
            1,
            '0',
            $request->note
        ];
        return $sample_data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource
     * @param  Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        $parts              = Part::with('dealer')->where('id', $part->id)->first();
        $brands             = Brand::withCount('model')->where('status', 1)->get();
        $models             = DeviceModel::where(['status' => 1, 'brand_id' => $part->brand_id])->get();
        $parent_dealers     = Dealer::where('user_type', 'parent_dealer')->get();
        return view('backend.admin.parts.edit', compact('parts', 'parent_dealers', 'brands', 'models'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(PartsUpdateRequest $request, Part $part)
    {
        $this->validate($request, [
            'parts_name' => 'required',
            'parts_price' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
        ]);
        $part->parts_name           = $request->parts_name;
        $part->parts_price          = $request->parts_price;
        $part->status               = $request->status;
        $part->parent_dealer_id     = $request->parent_dealer_id ?? 0;
        $part->brand_id             = $request->brand_id;
        $part->model_id             = $request->model_id;
        $part->note                 = $request->note;
        $part->save();
        return response()->json(['success' => true, 'message' => "Updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Part  $part
     * @return \Illuminate\Http\Response
     */
    public function delete(Part $part)
    {
        $part->delete();
        return response()->json(['success' => true, 'message' => "Deleted successfully"]);
    }

    public function updateStatus(Request $request)
    {
        $brand = Part::findOrFail($request->id);
        $brand->status = $request->status;
        if ($brand->save()) {
            return 1;
        }
        return 0;
    }
}
