<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\ChildDealer;
use App\Model\Dealer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildDealerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:child-dealer-list', ['only' => ['index']]);
        $this->middleware('permission:child-dealer-details', ['only' => ['show']]);
        $this->middleware('permission:child-dealer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:child-dealer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:child-dealer-delete', ['only' => ['destroy']]);
        $this->middleware('permission:child-dealer-withdraw-history', ['only' => ['withdrawHistory']]);
    }
    public function index()
    {
        $childDealers = Dealer::with('parent')->where('parent_id', '!=', null)->get();
        return view('backend.admin.child_dealers.index', compact('childDealers'));
    }

    public function create()
    {
        $categories = Category::all();
        $parents = Dealer::where('parent_id', null)->get();
        return view('backend.admin.child_dealers.create', compact('categories', 'parents'));
    }

    public function store(Request $request)
    {
        $user_type = 'child_dealer';
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password' => 'required|min:6',
            'com_org_inst_name' => 'required|max:42',
            'category_id' => 'required',
            'contact_person_name' => 'required',
            'contact_person_email' => 'required',
            'contact_person_phone' => 'required',
            'commission_type' => 'required',
            'commission_amount' => 'required',
            'is_api' => 'required',
            'dealer_type' => 'required',
            'bin' => 'required',
            'com_address' => 'required',
            'city' => 'required',
            'area' => 'required',
            'logo' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_type = $user_type;
        $user->email = $request->contact_person_email;
        $user->password = Hash::make($request->password);
        try {
            if ($user->save()) {

                $pd = new Dealer();
                $pd->user_id = $user->id;
                $pd->dealer_type = $request->dealer_type;
                $pd->parent_id = $request->parent_id;
                $pd->user_type =  $user_type;
                $pd->com_org_inst_name = $request->com_org_inst_name;
                $pd->category_id = $request->category_id;
                $pd->contact_person_name = $request->contact_person_name;
                $pd->contact_person_email = $request->contact_person_email;
                $pd->contact_person_phone = $request->contact_person_phone;
                $pd->commission_type = $request->commission_type;
                $pd->commission_amount = $request->commission_amount;
                $pd->is_api = $request->is_api;
                $pd->dealer_type = $request->dealer_type;
                $pd->com_address = $request->com_address;
                $pd->city = $request->city;
                $pd->area = $request->area;
                $pd->bin = $request->bin;
                $pd->etin = $request->etin;
                $pd->agreement_status = 'pending';
                $pd->app_submit_date_time =  Carbon::now()->format('Y-m-d H:i:s');
                $pd->insert_by_id =  Auth::id();
                $pd->can_sale_old_device =  $request->can_sale_old_device;

                $logo = $request->file('logo');
                if (isset($logo)) {
                    $logoName = imageUpload($logo, 'uploads/dealer-logo/photo/', 0);
                    $pd->logo = $logoName;
                }
                $treadLicense = $request->file('tread_license');
                if (isset($treadLicense)) {
                    $treadLicenseName = imageUpload($treadLicense, 'uploads/tread_license/photo/', 0);
                    $pd->tread_license = $treadLicenseName;
                }
                $other_business_id = $request->other_business_id;
                $attachments = array();
                if (isset($other_business_id)) {
                    foreach ($other_business_id as $image) {
                        if (isset($image)) {
                            $imagename = imageUpload($image, 'uploads/other_business_id/', 0);
                        } else {
                            $imagename = "default.png";
                        }
                        array_push($attachments, $imagename);
                    }
                    $pd->other_business_id = json_encode($attachments);
                }

                $nids = $request->nid;
                $attachments2 = array();
                if (isset($nids)) {
                    foreach ($nids as $image) {
                        if (isset($image)) {
                            $imagename = imageUpload($image, 'uploads/nid/', 0);
                        } else {
                            $imagename = "default.png";
                        }
                        array_push($attachments2, $imagename);
                    }
                    $pd->nid = json_encode($attachments2);
                }

                if ($pd->save()) {
                    Toastr::success('Data saved successfully', 'Success');
                    return back();
                }
            } else {
                Toastr::error('Something went wrong!', 'Error');
                return back();
            }
        } catch (\Exception $e) {
            $user = User::find($user->id);
            $user->delete();
            Toastr::error('Something went wrong! Please try again', 'Error');
            return back();
        }
    }

    public function show($id)
    {
        $dealerDetails = Dealer::with('user')->find($id);
        if (!$dealerDetails) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('admin.child-dealers.index');
        }
        return view('backend.admin.child_dealers.show', compact('dealerDetails'));
    }

    public function edit($id)
    {
        $dealerDetails = Dealer::find($id);
        if (!$dealerDetails) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('admin.parent-dealers.index');
        }
        $categories = Category::all();
        $parents = Dealer::where('parent_id', null)->get();

        return view('backend.admin.child_dealers.edit', compact('categories', 'parents', 'dealerDetails'));
    }

    public function update(Request $request, $id)
    {
        $childDealer = Dealer::find($id);

        $user = User::find($childDealer->user_id);

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,' . $user->id,
            'com_org_inst_name' => 'required|max:42',
            'category_id' => 'required',
            'contact_person_name' => 'required',
            'contact_person_email' => 'required',
            'contact_person_phone' => 'required',
            'commission_type' => 'required',
            'commission_amount' => 'required',
            'is_api' => 'required',
            'dealer_type' => 'required',
            'bin' => 'required',
            'com_address' => 'required',
            'city' => 'required',
            'area' => 'required',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password =  Hash::make($request->password);
        }
        if ($user->save()) {
            $pd = Dealer::find($id);
            $pd->user_id = $user->id;
            $pd->dealer_type = $request->dealer_type;
            $pd->parent_id = $request->parent_id;
            $pd->com_org_inst_name = $request->com_org_inst_name;
            $pd->category_id = $request->category_id;
            $pd->contact_person_name = $request->contact_person_name;
            $pd->contact_person_email = $request->contact_person_email;
            $pd->contact_person_phone = $request->contact_person_phone;
            $pd->commission_type = $request->commission_type;
            $pd->commission_amount = $request->commission_amount;
            $pd->is_api = $request->is_api;
            $pd->dealer_type = $request->dealer_type;
            $pd->com_address = $request->com_address;
            $pd->city = $request->city;
            $pd->area = $request->area;
            $pd->bin = $request->bin;
            $pd->etin = $request->etin;
            $pd->agreement_status = 'pending';
            $pd->app_submit_date_time =  Carbon::now()->format('Y-m-d H:i:s');
            $pd->insert_by_id =  Auth::id();
            $pd->can_sale_old_device =  $request->can_sale_old_device;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                if (isset($logo)) {
                    $logName = imageUpload($logo, 'uploads/dealer-logo/photo/', 0);
                }
                $pd->logo = $logName;
            }

            if ($request->hasFile('tread_license')) {
                $treadLicense = $request->file('tread_license');
                if (isset($treadLicense)) {
                    $treadLicenseName = imageUpload($treadLicense, 'uploads/tread_license/photo/', 0);
                }
                $pd->tread_license = $treadLicenseName;
            }
            if ($request->hasFile('other_business_id')) {
                $other_business_id = $request->other_business_id;
                $attachments = array();
                if (isset($other_business_id)) {
                    foreach ($other_business_id as $image) {
                        if (isset($image)) {
                            $imagename = imageUpload($image, 'uploads/other_business_id/', 0);
                        } else {
                            $imagename = "default.png";
                        }
                        array_push($attachments, $imagename);
                    }
                    $pd->other_business_id = json_encode($attachments);
                }
            }
            if ($request->hasFile('nid')) {
                $nids = $request->nid;
                $attachments2 = array();
                if (isset($nids)) {
                    foreach ($nids as $image) {
                        if (isset($image)) {
                            $imagename = imageUpload($image, 'uploads/nid/', 0);
                        } else {
                            $imagename = "default.png";
                        }
                        array_push($attachments2, $imagename);
                    }
                    $pd->nid = json_encode($attachments2);
                }
            }


            if ($pd->save()) {
                Toastr::success('Data updated successfully', 'Success');
                return redirect()->back();
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
    public function withdrawHistory()
    {
        $requests = DB::table('insurance_withdraw_requests')
            ->join('users', 'insurance_withdraw_requests.user_id', '=', 'users.id')
            ->where('users.user_type', '=', 'child_dealer')
            ->select('insurance_withdraw_requests.*')
            ->orderBy('insurance_withdraw_requests.created_at', 'DESC')
            ->get();
        return view('backend.admin.child_dealers.withdraw_request', compact('requests'));
    }
}
