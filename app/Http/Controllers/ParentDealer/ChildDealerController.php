<?php

namespace App\Http\Controllers\ParentDealer;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Dealer;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ChildDealerController extends Controller
{
    public function index()
    {
        $parent = Dealer::where('user_id', Auth::id())->first();
        $childDealers = Dealer::where('parent_id', $parent->id)->latest()->get();
        return view('backend.parent_dealer.child_dealers.index', compact('childDealers'));
    }


    public function create()
    {
        $categories = Category::all();
        $parent = Dealer::where('user_id', Auth::id())->first();
        return view('backend.parent_dealer.child_dealers.create', compact('categories', 'parent'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            //'email' =>  'required|email|unique:users,email',
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
        ]);
        $user_type = "child_dealer";
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_type = $user_type;
        $user->password = Hash::make($request->password);
        $user->email = $request->contact_person_email;
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
                $logo = $request->file('logo');
                ## Upload logo
                if (isset($logo)) {
                    $logName = imageUpload($logo, 'uploads/dealer-logo/photo/', 0);
                    $pd->logo = $logName;
                }
                ## Upload trade license
                $treadLicense = $request->file('tread_license');
                if (isset($treadLicense)) {
                    $treadLicenseName = imageUpload($logo, 'uploads/tread_license/photo/', 0);
                    $pd->tread_license = $treadLicenseName;
                }
                ## Upload other business id
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
                ## Upload nid
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
                    Toastr::success('Inserted successfully', 'Success');
                    return back();
                }
            } else {
                Toastr::error('Something went wrong!', 'Error');
                return back();
            }
        } catch (\Exception $e) {
            $user = User::findOrFail($user->id);
            $user->delete();
            Toastr::error('Data insert failed', 'Error');
            return back();
            // return $e->getMessage();
        }
    }

    public function show($id)
    {

        $dealerDetails = Dealer::with('user')->find($id);
        if (!$dealerDetails) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('parentDealer.child-dealers.index');
        }
        return view('backend.parent_dealer.child_dealers.show', compact('dealerDetails'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $parent = Dealer::where('user_id', Auth::id())->first();
        $dealerDetails = Dealer::find($id);
        return view('backend.parent_dealer.child_dealers.edit', compact('categories', 'parent', 'dealerDetails'));
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
        $user->user_type = 'child_dealer';
        if ($user->save()) {
            $pd = Dealer::find($id);
            $pd->user_id = $user->id;
            $pd->dealer_type = $request->dealer_type;
            $pd->parent_id = $request->parent_id;
            $pd->user_type =  'child_dealer';
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
                return redirect()->route('parentDealer.child-dealers.index');
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
