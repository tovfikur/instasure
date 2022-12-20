<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\DeviceModel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeviceModelController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:device-model-list', ['only' => ['index']]);
        $this->middleware('permission:device-model-details', ['only' => ['show']]);
        $this->middleware('permission:device-model-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:device-model-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:device-model-delete', ['only' => ['destroy']]);
        $this->middleware('permission:device-model-update-status', ['only' => ['updateStatus']]);
    }
    public function index()
    {
        $deviceModels = DeviceModel::latest()->get();
        return view('backend.admin.device_models.index', compact('deviceModels'));
    }

    public function create()
    {
        return view('backend.admin.device_models.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'brand_id' => 'required',
        ]);
        $deviceModel = new DeviceModel();
        $deviceModel->brand_id = $request->brand_id;
        $deviceModel->name = $request->name;
        $deviceModel->slug = Str::slug($request->name) . '-' . Str::random(5);
        $deviceModel->description = $request->description;
        $deviceModel->save();
        Toastr::success('Device Model inserted successfully');
        return redirect()->route('admin.device-models.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $deviceModel = DeviceModel::find($id);
        return view('backend.admin.device_models.edit', compact('deviceModel'));
    }

    public function update(Request $request, $id)
    {
        $deviceModel = DeviceModel::find($id);
        $deviceModel->brand_id = $request->brand_id;
        $deviceModel->name = $request->name;
        $deviceModel->slug = Str::slug($request->name) . '-' . Str::random(5);
        $deviceModel->description = $request->description;
        $deviceModel->save();
        Toastr::success('Device Model updated successfully');
        return redirect()->route('admin.device-models.index');
    }

    public function destroy($id)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $deviceModel = DeviceModel::findOrFail($request->id);
        $deviceModel->status = $request->status;
        if ($deviceModel->save()) {
            return 1;
        }
        return 0;
    }
}
