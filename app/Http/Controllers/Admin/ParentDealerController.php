<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\BusinessSetting;
use App\Model\Category;
use App\Model\Dealer;
use App\Model\ParentBrand;
use App\Model\ParentChildDealer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentDealerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:parent-dealer-list', ['only' => ['index']]);
        $this->middleware('permission:parent-dealer-details', ['only' => ['show']]);
        $this->middleware('permission:parent-dealer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:parent-dealer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:parent-dealer-child-dealer-list', ['only' => ['childDealerList']]);
        $this->middleware('permission:parent-dealer-child-dealer-update', ['only' => ['childDealerUpdate']]);
        $this->middleware('permission:parent-dealer-withdraw-history', ['only' => ['withdrawHistory']]);
    }
    public function index()
    {
        $parentDealers = Dealer::with('brand')->where('parent_id', null)->latest()->get();
        return view('backend.admin.parent_dealers.index', compact('parentDealers'));
    }

    public function create()
    {
        $categories = Category::all();
        $business_settings = BusinessSetting::all();
        $brands = Brand::where('status', 1)->get();
        return view('backend.admin.parent_dealers.create', compact('categories', 'business_settings', 'brands'));
    }

    /**
     * Store new dealer
     * @param \Illuminate\Http\Request $request
     * @return Redirect back
     */

    public function store(Request $request)
    {

        $user_type = "parent_dealer";

        ## Validate incoming request
        $this->validate($request, [
            'name'                              => 'required',
            'phone'                             => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password'                          => 'required|min:6',
            'com_org_inst_name'                 => 'required|max:42',
            'category_id'                       => 'required',
            'contact_person_name'               => 'required',
            'contact_person_email'              => 'required',
            'contact_person_phone'              => 'required',
            'commission_type'                   => 'required',
            'commission_amount'                 => 'required',
            'is_api'                            => 'required',
            'dealer_type'                       => 'required',
            'bin'                               => 'required',
            'com_address'                       => 'required',
            'city'                              => 'required',
            'area'                              => 'required',
            'logo'                              => 'required',
        ]);


        try {
            ## Create new user
            $user                               = new User();
            $user->name                         = $request->name;
            $user->phone                        = $request->phone;
            $user->user_type                    = $user_type;
            $user->email                        = $request->contact_person_email;
            $user->password                     = bcrypt($request->password);

            if ($user->save()) {
                ## Create new dealer
                $pd                             = new Dealer();
                $pd->user_id                    = $user->id;
                $pd->user_type                  =  $user_type;
                $pd->com_org_inst_name          = $request->com_org_inst_name;
                $pd->category_id                = $request->category_id;
                $pd->contact_person_name        = $request->contact_person_name;
                $pd->contact_person_email       = $request->contact_person_email;
                $pd->contact_person_phone       = $request->contact_person_phone;
                $pd->commission_type            = $request->commission_type;
                $pd->commission_amount          = $request->commission_amount;
                $pd->is_api                     = $request->is_api;
                $pd->dealer_type                = $request->dealer_type;
                $pd->com_address                = $request->com_address;
                $pd->city                       = $request->city;
                $pd->area                       = $request->area;
                $pd->bin                        = $request->bin;
                $pd->etin                       = $request->etin;
                $pd->agreement_status           = 'pending';
                $pd->app_submit_date_time       =  Carbon::now()->format('Y-m-d H:i:s');
                $pd->insert_by_id               =  Auth::id();
                $pd->imei_check                 =  $request->imei_check;
                $pd->active                     = $request->active;

                ## Insert logo
                $logo                           = $request->file('logo');
                if (isset($logo)) {
                    $logoName                   = imageUpload($logo, 'uploads/dealer-logo/photo/', 0);
                    $pd->logo                   = $logoName;
                }

                ## Insert trade license
                $treadLicense                   = $request->file('tread_license');
                if (isset($treadLicense)) {
                    $treadLicenseName           = imageUpload($logo, 'uploads/tread_license/photo/', 0);
                    $pd->tread_license          = $treadLicenseName;
                }

                ## Insert other business id's
                $other_business_id              = $request->other_business_id;
                if (isset($other_business_id)) {
                    $attachments                = array();
                    foreach ($other_business_id as $image) {
                        if (isset($image)) {
                            $imagename          = imageUpload($image, 'uploads/other_business_id/', 0);
                        } else {
                            $imagename          = "default.png";
                        }
                        array_push($attachments, $imagename);
                    }
                    $pd->other_business_id      = json_encode($attachments);
                }

                ## Insert NID
                $nids                           = $request->nid;
                if (isset($nids)) {
                    $attachments2               = array();
                    foreach ($nids as $image) {
                        if (isset($image)) {
                            $imagename          = imageUpload($image, 'uploads/nid/', 0);
                        } else {
                            $imagename          = "default.png";
                        }
                        array_push($attachments2, $imagename);
                    }
                    $pd->nid                    = json_encode($attachments2);
                }

                ## Save dealer
                if ($pd->save()) {
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
            return $e->getMessage();
        }
    }

    /**
     * Show details
     * @param \App\Model\Dealer $id
     * @return View view
     */
    public function show($id)
    {
        $dealerDetails = Dealer::find($id);

        if (!$dealerDetails) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('admin.parent-dealers.index');
        }
        return view('backend.admin.parent_dealers.show', compact('dealerDetails'));
    }
    /**
     * Edit item
     * @param \App\Model\Dealer $id
     * @return View view
     */
    public function edit($id)
    {
        $dealerDetails = Dealer::find($id);

        if (!$dealerDetails) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('admin.parent-dealers.index');
        }
        $categories = Category::all();
        $business_settings = BusinessSetting::all();
        $brands = Brand::where('status', 1)->get();
        return view('backend.admin.parent_dealers.edit', compact('dealerDetails', 'categories', 'business_settings', 'brands'));
    }

    /**
     * Update item
     * @param \Illuminate\Http\Request $request
     * @param \App\Model\Dealer $id
     * @return Redirect back
     */
    public function update(Request $request, $id)
    {
        $parentDealer = Dealer::find($id);
        $user = User::find($parentDealer->user_id);
        $user_type = "parent_dealer";
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
        $user->user_type = $user_type;
        if ($request->password) {
            $user->password =  Hash::make($request->password);
        }
        if ($user->save()) {
            $pd = Dealer::find($id);
            $pd->user_id = $user->id;
            $pd->user_type =  $user_type;
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
            $pd->imei_check = $request->imei_check;
            $pd->active = $request->active;
            //next 2line added by Tovfikur 21/12/22
            $pd->terms_and_condition = $request->terms_and_condition;
            $pd->signature = $request->signature;
            //end Tovfiur
            $pd->agreement_status = 'pending';
            $pd->app_submit_date_time =  Carbon::now()->format('Y-m-d H:i:s');
            $pd->insert_by_id =  Auth::id();
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
                return back();
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
    public function childDealerList($id)
    {
        $parentDealer = Dealer::find($id);
        $packageChilds = DB::table("parent_child_dealers")
            ->where("parent_dealer_id", $parentDealer->id)
            ->pluck('child_dealer_id', 'child_dealer_id')
            ->all();
        return view('backend.admin.parent_dealers.child_list', compact('parentDealer', 'packageChilds'));
    }

    public function childDealerUpdate(Request $request)
    {
        $parentDealer = Dealer::find($request->parent_id);

        if (!empty($request->child_id)) {
            ParentChildDealer::where('parent_dealer_id', $parentDealer->id)->delete();
            foreach ($request->child_id as $child_id) {
                $parentChildDealer = new ParentChildDealer();
                $parentChildDealer->parent_dealer_id = $request->parent_id;
                $parentChildDealer->child_dealer_id = $child_id;
                $parentChildDealer->save();
            }
        } else {
            Toastr::warning('Please select at least one Child Dealer!');
            return back();
        }
        Toastr::success('Child Dealer Selected Successfully');
        return redirect()->back();
    }

    public function withdrawHistory()
    {
        $requests = DB::table('insurance_withdraw_requests')
            ->join('users', 'insurance_withdraw_requests.user_id', '=', 'users.id')
            ->where('users.user_type', '=', 'parent_dealer')
            ->select('insurance_withdraw_requests.*')
            ->orderBy('insurance_withdraw_requests.created_at', 'DESC')
            ->get();
        return view('backend.admin.parent_dealers.withdraw_request', compact('requests'));
    }


    /**
     * Parent delaer brand mapping modal
     * @param \App\Model\Dealer $dealer
     */
    public function parent_dealers_brand_mapping($dealer)
    {
        $parentDealer = Dealer::with('brands')->find($dealer);
        $brands = Brand::where(['status' => 1])->orderBy('name', 'asc')->get();
        $dealerBrands = [];

        foreach ($parentDealer->brands as $key => $brand) {
            $dealerBrands[] = $brand->id;
        }

        return view('backend.admin.parent_dealers.brand_mapping_modal', compact('parentDealer', 'brands', 'dealerBrands'));
    }
    /**
     * Parent delaer brand mapping modal
     * @param \Illuminate\Http\Request $dealer
     */
    public function parent_dealers_brand_mapping_store(Request $request)
    {

        $brands = $request->brands;
        try {
            $dealer = Dealer::find($request->dealer_id);
            $dealer->brands()->sync($brands);
            return response()->json(['success' => true, 'message' => 'Successful']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }
}
