<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ImeiData;
use App\Model\Dealer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Exports\ImeiDownload;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImeiUpload;


class ImeiDataController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:imei-data-list', ['only' => ['index']]);
        $this->middleware('permission:imei-data-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:imei-data-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:imei-data-upload', ['only' => ['edit', 'upload']]);
        $this->middleware('permission:imei-data-upload-process', ['only' => ['edit', 'upload_process']]);
        $this->middleware('permission:imei-data-download', ['only' => ['edit', 'download']]);
        $this->middleware('permission:imei-data-download-process', ['only' => ['edit', 'download_process']]);
    }

    public function upload()
    {
        return view('backend.admin.imei_datas.upload');
    }
    public function upload_process(Request $request)
    {
        try {
            Excel::import(new ImeiUpload, $request->file('file'));
            Toastr::success('Added Successfully');
        } catch (\Throwable $th) {
            // dd($th);
            $errorMessage = "Invalid query";
            if (isset($th->errorInfo[2])) {
                $errorMessage = $th->errorInfo[2];
            }
            Toastr::error($errorMessage);
        }
        return redirect()->back();
    }

    public function download()
    {
        $parent_dealers = Dealer::where('user_type', 'parent_dealer')->get();
        return view('backend.admin.imei_datas.download', compact('parent_dealers'));
    }

    public function download_process(Request $request)
    {

        $sample_data = [10000000, 20000000, $request->child_dealer_id, 1];
        $headings = [
            'IMEI 1',
            'IMEI 2',
            'PARENT ID',
            'STATUS',
            'IS USED'
        ];
        return Excel::download(new ImeiDownload($sample_data, $headings), 'imei-sample-data.xlsx');
    }
    public function index()
    {
        $imeiDatas = ImeiData::with(['dealer.parent'])->get();
        return view('backend.admin.imei_datas.index', ['imeiDatas' => $imeiDatas]);
    }

    /**
     * Get imei data list using ajax call
     * @return response
     */

    public function get_imei_data_list_ajax()
    {
        return ImeiData::get_imei_data_list_ajax();
    }

    /**
     * Get parent dealer wise child dealer
     * @return response
     * @param Request $request
     */

    public function get_parent_wise_child_dealer_ajax(Request $request)
    {
        $child_dealers = Dealer::where(['user_type' => 'child_dealer'])->where('parent_id', '=', $request->id)->get();
        return view('backend.admin.imei_datas.child_dealers', compact('child_dealers'));
    }

    public function create()
    {
        $parent_dealers = Dealer::where('user_type', 'parent_dealer')->get();

        return view('backend.admin.imei_datas.create', compact('parent_dealers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'imei_1' => 'required|unique:imei_datas,imei_1',
            'imei_2' => 'required|unique:imei_datas,imei_2',
            'parent_id' => 'required',
            'child_dealer_id' => 'required',
        ]);
        $imeiData = new ImeiData();

        $imeiData->imei_1 = $request->imei_1;
        $imeiData->imei_2 = $request->imei_2;
        $imeiData->parent_id = $request->child_dealer_id;
        $imeiData->status = 1;
        try {
            $imeiData->save();
            Toastr::success('Created successfully');
        } catch (\Throwable $th) {
            $errorMessage = "Invalid query";
            Toastr::error($errorMessage);
        }



        return redirect()->back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $imeiData = ImeiData::with(['dealer.parent'])->where('id', $id)->first();

        if (!$imeiData) {
            Toastr::error('Invalid request');
            return redirect()->route('admin.imei-data.index');
        }
        $parent_dealers = Dealer::where('user_type', 'parent_dealer')->get();
        $child_dealers = Dealer::where('user_type', 'child_dealer')->where('parent_id', $imeiData->dealer->parent->id)->get();

        return view('backend.admin.imei_datas.edit', compact('imeiData', 'parent_dealers', 'child_dealers'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'imei_1' => 'required|unique:imei_datas,imei_1,' . $id,
            'imei_2' => 'required|unique:imei_datas,imei_2,' . $id,
        ]);

        $imeiData = ImeiData::find($id);
        if ($request->imei_1 == $request->imei_2) {
            Toastr::error('Both IMEI Data should be unique');
            return redirect()->back();
        }
        $imeiData->imei_1 = $request->imei_1;
        $imeiData->imei_2 = $request->imei_2;
        $imeiData->parent_id = $request->child_dealer_id;
        $imeiData->save();
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
    public function change_status(ImeiData $imei)
    {
        $imei->status = $imei->status == 1 ? 0 : 1;
        $imei->save();
        return back();
    }
}
