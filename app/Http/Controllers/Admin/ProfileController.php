<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:profile-list', ['only' => ['index']]);
        $this->middleware('permission:profile-update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:profile-update-password', ['only' => ['updatePassword']]);
    }
    public function index()
    {
        return view('backend.admin.profile.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' =>  'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone,' . $id,
            'email' =>  'required|email|unique:users,email,' . $id,
        ]);

        $user =  User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar_original')) {
            $user->avatar_original = $request->avatar_original->store('uploads/profile');
        }
        $user->save();
        Toastr::success('Admin Profile Updated Successfully', 'Success');
        return redirect()->back();
    }
    public function updatePassword(Request $request, $id)
    {

        $this->validate($request, [
            'password' =>  'required|confirmed|min:6',
        ]);

        $user =  User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        Toastr::success('Admin Password Updated Successfully', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
