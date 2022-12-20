<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\UserInfo;
use App\Http\Controllers\Controller;
use App\Model\VerificationCode;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    public function getVerificationCode($id)
    {
        $user = User::find($id);
        if (!$user) {
            Toastr::error('Invalid request', 'Error');
            return redirect()->back();
        }
        $verification = VerificationCode::where('phone', $user->phone)->first();
        if (!empty($verification)) {
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $user->phone;
        $verCode->code = mt_rand(1111, 9999);
        $verCode->status = 0;
        $verCode->save();
        $text = $verCode->code . env('CUSTOMER_REGISTRATION_OTP_SMS');
        UserInfo::smsAPI("88" . $verCode->phone, $text);
        Toastr::success('Thank you for your registration. We send a verification code in your mobile number. Please verify your phone number.', 'Success');
        return view('frontend.pages.verification', compact('verCode'));
    }
    public function verification(Request $request)
    {
        if ($request->isMethod('post')) {
            $check = VerificationCode::where('code', $request->code)->where('phone', $request->phone)->where('status', 0)->first();
            if (!empty($check)) {
                $check->status = 1;
                $check->update();
                $user = User::where('phone', $request->phone)->first();
                $user->verification_code = $request->code;
                $user->banned = 0;
                $user->save();
                ## Send mobile sms
                $text = env('CUSTOMER_REGISTRATION_CONFIRMATION_SMS');
                Toastr::success('Your phone number successfully verified.', 'Success');
                UserInfo::smsAPI("88" . $user->phone, $text);
                /*return redirect('login');*/
                $credentials = [
                    'phone' => Session::get('phone'),
                    'password' => Session::get('password'),
                    'user_type' => Session::get('user_type'),
                ];

                if (Auth::attempt($credentials)) {
                    Session::forget('phone');
                    Session::forget('password');

                    if (Session::get('user_type') == 'customer') {
                        return redirect()->route('user.dashboard');
                    }
                } else {
                    die('no auth');
                }
            } else {
                //$verCode = $request->phone;
                $verCode = VerificationCode::where('phone', $request->phone)->where('status', 0)->first();
                Toastr::error('Invalid Code', 'Error');
                return view('frontend.pages.verification', compact('verCode'));
            }
        }
    }
}
