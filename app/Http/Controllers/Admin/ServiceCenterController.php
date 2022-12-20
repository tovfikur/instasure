<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ServiceCenterDetails;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServiceCenterController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:service-center-list', ['only' => ['index']]);
        $this->middleware('permission:service-center-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-center-edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $serviceCenters = ServiceCenterDetails::latest()->get();
        return view('backend.admin.service_center.index', compact('serviceCenters'));
    }

    public function create()
    {
        return view('backend.admin.service_center.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password' => 'required|min:6',
            'service_center_name' => 'required|max:42',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',
            'address' => 'required',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_type = 'service_center';
        $user->password = Hash::make($request->password);

        try {
            if ($user->save()) {
                $serviceCenter = new ServiceCenterDetails();
                $serviceCenter->user_id = $user->id;
                $serviceCenter->parent_id = $request->parent_id;
                $serviceCenter->brand_id = implode(',', $request->brand_id);
                $serviceCenter->service_center_name = $request->service_center_name;
                $serviceCenter->division_id = $request->division_id;
                $serviceCenter->district_id = $request->district_id;
                $serviceCenter->upazila_id = $request->upazila_id;
                $serviceCenter->contact_person_name = $request->contact_person_name;
                $serviceCenter->contact_person_email = $request->contact_person_email;
                $serviceCenter->contact_person_phone = $request->contact_person_phone;
                $serviceCenter->address = $request->address;

                $logo = $request->file('logo');
                if (isset($logo)) {
                    $logName = imageUpload($logo, 'uploads/service-center-logo/photo/', 0);
                }
                $serviceCenter->logo = $logName;


                if ($serviceCenter->save()) {
                    Toastr::success('Data saved successfully', 'Success');
                    return back();
                }
            } else {
                Toastr::error('Something went wrong!', 'Error');
                return back();
            }
        } catch (\Exception $e) {
            $user = User::findOrFail($user->id);
            $user->delete();
            Toastr::error('Something went wrong! Please try again', 'Error');
            //return back();
            return $e->getMessage();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $serviceCenter = ServiceCenterDetails::find($id);
        return view('backend.admin.service_center.edit', compact('serviceCenter'));
    }

    public function update(Request $request, $id)
    {
        $serviceCenter = ServiceCenterDetails::find($id);
        $user = User::find($serviceCenter->user_id);

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,' . $user->id,
            'service_center_name' => 'required|max:42',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',
            'address' => 'required',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($user->save()) {
            $serviceCenter = ServiceCenterDetails::find($id);
            $serviceCenter->user_id = $user->id;
            $serviceCenter->service_center_name = $request->service_center_name;
            $serviceCenter->division_id = $request->division_id;
            $serviceCenter->district_id = $request->district_id;
            $serviceCenter->upazila_id = $request->upazila_id;
            $serviceCenter->contact_person_name = $request->contact_person_name;
            $serviceCenter->contact_person_email = $request->contact_person_email;
            $serviceCenter->contact_person_phone = $request->contact_person_phone;
            $serviceCenter->address = $request->address;

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                if (isset($logo)) {
                    $logName = imageUpload($logo, 'uploads/service-center-logo/photo/', 0);
                }
                $serviceCenter->logo = $logName;
            }

            if ($serviceCenter->save()) {
                Toastr::success('Data updated successfully', 'Success');
                return redirect()->route('admin.service-center.index');
            }
        } else {
            Toastr::error('Something went wrong!', 'Error');
            return back();
        }
    }

    public function destroy($id)
    {
        //
    }
}
