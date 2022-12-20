<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\PolicyProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PolicyProvidersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:policy-providers-list', ['only' => ['index']]);
        $this->middleware('permission:policy-providers-details', ['only' => ['show']]);
        $this->middleware('permission:policy-providers-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:policy-providers-edit', ['only' => ['edit', 'update']]);
    }
    public function index()
    {
        $policyProviders = PolicyProvider::latest()->get();
        return view('backend.admin.policy_providers.index', compact('policyProviders'));
    }

    public function create()
    {
        return view('backend.admin.policy_providers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'contact_person_name'   => 'required',
            'contact_person_phone'  => 'required',
            'contact_person_email'  => 'required',
            'claim_info'            => 'required',
            'is_api'                => 'required',
        ]);
        $policyProvider = new PolicyProvider();
        $policyProvider->contact_person_name = $request->contact_person_name;
        $policyProvider->company_name = $request->company_name;
        $policyProvider->contact_person_phone = $request->contact_person_phone;
        $policyProvider->contact_person_email = $request->contact_person_email;
        $policyProvider->is_api = $request->is_api;
        $policyProvider->api_url = $request->api_url;
        $policyProvider->api_key = $request->api_key;
        $policyProvider->api_secret = $request->api_secret;
        $policyProvider->status = 1;
        $policyProvider->claim_info = $request->claim_info;
        ## Generate code for policy provider ##
        $count_policy_providers = PolicyProvider::count() + 1;
        $policyProvider->code = $count_policy_providers < 10 ? '0' . $count_policy_providers  : $count_policy_providers;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            if (isset($logo)) {
                $logoName = imageUpload($logo, 'uploads/policy_provider/logo/', 0);
                $policyProvider->logo = $logoName;
            }
        } else {
            $policyProvider->logo = '';
        }
        if ($request->hasFile('template_img')) {
            $templateImg = $request->file('template_img');
            if (isset($templateImg)) {
                $templateImgName = imageUpload($logo, 'uploads/policy_provider/template_img/', 0);
                $policyProvider->template_img = $templateImgName;
            }
        } else {
            $policyProvider->template_img = '';
        }
        $policyProvider->save();
        Toastr::success('Created successfully');
        return redirect()->back();
    }

    public function show($id)
    {
        $policyProvider = PolicyProvider::find($id);
        if (!$policyProvider) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('admin.policy-providers.index');
        }
        return view('backend.admin.policy_providers.show', compact('policyProvider'));
    }

    public function edit($id)
    {
        $policyProvider = PolicyProvider::find($id);
        if (!$policyProvider) {
            Toastr::error('Requestd item not found', 'Invalid Request');
            return redirect()->route('admin.policy-providers.index');
        }
        return view('backend.admin.policy_providers.edit', compact('policyProvider'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',
            'contact_person_email' => 'required',
            'is_api' => 'required',
        ]);
        $policyProvider = PolicyProvider::find($id);
        $policyProvider->contact_person_name = $request->contact_person_name;
        $policyProvider->company_name = $request->company_name;
        $policyProvider->contact_person_phone = $request->contact_person_phone;
        $policyProvider->contact_person_email = $request->contact_person_email;
        $policyProvider->is_api = $request->is_api;
        $policyProvider->api_url = $request->api_url;
        $policyProvider->api_key = $request->api_key;
        $policyProvider->api_secret = $request->api_secret;
        $policyProvider->status = $request->status;
        $policyProvider->claim_info = $request->claim_info;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            if (isset($logo)) {
                $logoName = imageUpload($logo, 'uploads/policy_provider/logo/', 0);
            }
            $policyProvider->logo = $logoName;
        }
        if ($request->hasFile('template_img')) {
            $templateImg = $request->file('template_img');
            if (isset($templateImg)) {
                $templateImgName = imageUpload($templateImg, 'uploads/policy_provider/template_img/', 0);
            }
            $policyProvider->template_img = $templateImgName;
        }
        $policyProvider->save();
        Toastr::success('Updated successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
