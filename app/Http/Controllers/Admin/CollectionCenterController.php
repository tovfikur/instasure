<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\CollectionCenter;
use App\Model\Dealer;
use App\Model\District;
use App\Model\Division;
use App\Model\Upazila;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CollectionCenterController extends Controller
{

    /**
     * Constructor method
     */
    function __construct()
    {
        $this->middleware('permission:collection-center-list', ['only' => ['index']]);
        $this->middleware('permission:collection-center-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:collection-center-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:collection-center-change-status', ['only' => ['change_status']]);
    }

    /**
     * Collection center list
     * @return response datatable
     */

    public function index()
    {
        return view('backend.admin.collection_center.index');
    }

    /**
     * Collection center datatable using ajax call
     * @return response datatable
     */

    public function collection_center_datatable()
    {
        return CollectionCenter::collection_center_datatable();
    }

    /**
     * Create collection center form
     * @return view form
     */

    public function create()
    {
        $dealers                        = Dealer::where('parent_id', null)->get();
        $divisions                      = Division::get();
        return view('backend.admin.collection_center.create', compact('dealers', 'divisions'));
    }

    /**
     * Store collection center data and user data
     * @param Request $request
     * @return null
     */

    public function store(Request $request)
    {
        ## Validate request data ##
        $this->validate($request, [
            'name'                                          => 'required',
            'phone'                                         => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password'                                      => 'required|min:6',
            'center_name'                                   => 'required|max:100',
            'contact_person_name'                           => 'required',
            'contact_person_phone'                          => 'required',
            'address'                                       => 'required',
            'division_id'                                   => 'required',
            'district_id'                                   => 'required',
            'upazila_id'                                    => 'required',
        ]);

        try {
            ## Selete collection_center_commission from business_settings ##
            $collection_center_commission                   = BusinessSetting::where(['type' => 'collection_center_commission'])->first();

            ## Create new user ##
            $user                                           = new User();
            $user->name                                     = $request->name;
            $user->phone                                    = $request->phone;
            $user->user_type                                = 'collection_center';
            $user->email                                    = $request->contact_person_email ?? null;
            $user->password                                 = Hash::make($request->password);

            if ($user->save()) {

                ## Create new collection center ##
                $collection_center                          = new CollectionCenter();
                $collection_center->user_id                 = $user->id;
                $collection_center->parent_id               = $request->parent_id;
                $collection_center->division_id             = $request->division_id;
                $collection_center->district_id             = $request->district_id;
                $collection_center->upazila_id              = $request->upazila_id;
                $collection_center->center_name             = $request->center_name;
                $collection_center->contact_person_name     = $request->contact_person_name;
                $collection_center->contact_person_phone    = $request->contact_person_phone;
                $collection_center->contact_person_email    = $request->contact_person_email;
                $collection_center->address                 = $request->address;
                $collection_center->commission_value        = $collection_center_commission->value;

                $logo = $request->file('logo');
                if (isset($logo)) {
                    ## Upload logo/image to server  ##
                    $logName                                = imageUpload($logo, 'uploads/collection-center/', 0);
                    $collection_center->logo                = $logName;
                }


                if ($collection_center->save()) {
                    Toastr::success('Created successfully');
                    return back();
                }
            } else {
                Toastr::error('Faild: Please fillup all required fields');
                return back();
            }
        } catch (\Exception $e) {
            $user = User::findOrFail($user->id);
            $user->delete();
            dd($e->getMessage());
            Toastr::error('Something went wrong! Please try again', 'Error');
            return back();
        }
    }

    /**
     * View collection center details
     * @param CollectionCenter $collection_center
     * @return view
     */

    public function show(CollectionCenter $collection_center)
    {
        $collection_center = CollectionCenter::with(['user', 'division', 'district', 'upazila'])->find($collection_center->id);

        return view('backend.admin.collection_center.show', compact('collection_center'));
    }

    /**
     * View collection center details with edit form
     * @param $collection_center
     * @return view
     */

    public function edit($collection_center)
    {
        $collection_center              = CollectionCenter::with(['user'])->find($collection_center);
        $dealers                        = Dealer::where('parent_id', null)->get();
        $divisions                      = Division::get();
        $districts                      = District::where('division_id', $collection_center->division_id)->get();
        $upazilas                       = Upazila::where('district_id', $collection_center->district_id)->get();
        return view('backend.admin.collection_center.edit', compact('collection_center', 'divisions', 'districts', 'upazilas', 'dealers'));
    }

    /**
     * Update collection center details
     * @param Request $collection_center
     * @param $id
     * @return back with alert message
     */

    public function update(Request $request, $id)
    {
        $collection_center = CollectionCenter::with(['user'])->find($id);
        $user = User::find($collection_center->user_id);

        ## Validate incoming request data ##
        $this->validate($request, [
            'name'                                      => 'required',
            'phone'                                     => [
                'required',
                'regex:/(01)[0-9]{9}/',
                Rule::unique('users')->ignore($user->id, 'id')
            ],
            'password'                                      => 'nullable|min:6',
            'center_name'                                   => 'required|max:100',
            'contact_person_name'                           => 'required',
            'contact_person_phone'                          => 'required',
            'address'                                       => 'required',
            'division_id'                                   => 'required',
            'district_id'                                   => 'required',
            'upazila_id'                                    => 'required',
        ]);

        try {
            ## Update user ##
            $user->name                                     = $request->name ?? $user->name;
            $user->phone                                    = $request->phone ?? $user->phone;
            $user->email                                    = $request->contact_person_email ?? $user->email;
            if ($request->password) {
                $user->password                             = Hash::make($request->password);
            }

            if ($user->save()) {
                ## Update collection center ##
                $collection_center->parent_id               = $request->parent_id;
                $collection_center->division_id             = $request->division_id;
                $collection_center->district_id             = $request->district_id;
                $collection_center->upazila_id              = $request->upazila_id;
                $collection_center->center_name             = $request->center_name;

                $collection_center->contact_person_name     = $request->contact_person_name;
                $collection_center->contact_person_phone    = $request->contact_person_phone;
                $collection_center->contact_person_email    = $request->contact_person_email;
                $collection_center->address                 = $request->address;

                ## Upload logo/image to server  ##
                $logo = $request->file('logo');
                if (isset($logo)) {
                    $logName                                = imageUpload($logo, 'uploads/collection-center/', 0);
                    $collection_center->logo                = $logName;
                }


                if ($collection_center->save()) {
                    Toastr::success('Updated successfully');
                    return back();
                }
            } else {
                Toastr::error('Faild: Please fillup all required fields');
                return back();
            }
        } catch (\Exception $e) {
            ## Display alert if exception occurs
            Toastr::error('Something went wrong! Please try again', 'Error');
            return back();
        }
    }
    /**
     * Change collection center status
     * @param CollectionCenter $collection_center
     * @return redirect back
     */
    public function change_status(CollectionCenter $collection_center)
    {
        $collection_center->status = $collection_center->status == 1 ? 0 : 1;
        $collection_center->save();
        Toastr::success('Status updated successfully');
        return back();
    }
}
