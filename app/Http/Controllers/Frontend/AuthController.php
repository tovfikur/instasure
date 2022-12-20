<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\VerificationCode;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone',
            'password' => 'required|min:6',
            // 'g-recaptcha-response' => 'required',
        ]);

        $userReg = new User();
        $userReg->name = $request->name;
        //$userReg->email = $request->email;
        $userReg->phone = $request->phone;
        $userReg->password = Hash::make($request->password);
        $userReg->user_type = 'customer';
        $userReg->banned = 1;
        $userReg->save();

        Session::put('phone', $request->phone);
        Session::put('password', $request->password);
        Session::put('user_type', 'customer');

        Toastr::success('Your registration successfully done!');
        return redirect()->route('get-verification-code', $userReg->id);
    }
}
