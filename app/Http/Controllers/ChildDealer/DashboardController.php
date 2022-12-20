<?php

namespace App\Http\Controllers\ChildDealer;


use App\User;
use App\Model\Dealer;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Model\DeviceInsurance;
use App\Model\VerificationCode;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerRegisteredFromChildEmail;

class DashboardController extends Controller
{
    use SmsService;
    public function index()
    {

        $childDealer = Dealer::where('user_id', Auth::id())->first();
        $deviceInsurance = DeviceInsurance::where('child_dealer_id', $childDealer->id)->where('status', 'completed');
        $totalInsSale = $deviceInsurance->count();
        $totalEarn = $deviceInsurance->sum('child_dealer_commission');
        return view('backend.child_dealer.dashboard', compact('childDealer', 'totalInsSale', 'totalEarn'));
    }

    /**
     * Customer otp verification process and create new user
     * @param  $phone;
     * @return response view
     */

    public function customerOtpVerificationProcess(Request $request)
    {
        ## Request validation
        $this->validate($request, [
            'phone' => ['required'],
            'code' => ['required', 'size:4'],
            'name' => ['required'],
            'email' => ['sometimes',  'nullable', 'email'],
        ]);

        try {
            $verificationCode = VerificationCode::where('phone', $request->phone)->where('code', $request->code)->first();
            ## Create new user
            $user = new User();
            if (!empty($verificationCode)) {
                ## Update verificationCode
                $verificationCode->status = 1;
                $verificationCode->save();

                $user->name = $request->name;
                if (isset($request->email)) {
                    $user->email = $request->email ?? null;
                }
                $user->phone = $request->phone;
                $user->password = Hash::make('123456');
                $user->user_type = 'customer';
                $user->banned = 0;
                $user->verification_code = $request->code;
                $user->save();

                ## Verification successfull sms to mobile number
                $smsText = "আপনার অ্যাকাউন্ট {$user->phone} & পাসওয়ার্ড 123456. প্লিজ ভিজিট instasure.xyz";

                ## Send sms to customer mobile number
                $sms_response = strtolower($this->send_sms($request->phone, $smsText));
                if (strpos($sms_response, "sms submitted") >= 0) {
                    ## Send email to customer email account
                    $user = $user->toArray();
                    if (!empty($user['email'])) {
                        Mail::to($user['email'])->queue(new CustomerRegisteredFromChildEmail($user['phone']));
                    }
                    Toastr::success("Verification successful");
                    return redirect()->route('childDealer.device-insurances.create', $user['id']);
                }
            } else {

                $request->session()->flash('invalidOtpMessage', 'Verification code mismatched');
                return redirect()->back();
            }
        } catch (\Throwable $th) {

            Toastr::error($th->getMessage());
            return redirect()->route('childDealer.select-customer');
        }
    }


    /**
     * Customer otp verification
     * @param  $phone;
     * @return response view
     */

    public function customerOtpVerification($phone)
    {
        $otpMessage = session('verifyOtpMsg');
        $invalidOtpMessage = session('invalidOtpMessage');

        try {
            $verificationCode = VerificationCode::where('phone', $phone)->first();
            if (!empty($verificationCode)) {
                if ($otpMessage) {
                    Toastr::warning($otpMessage);
                } elseif ($invalidOtpMessage) {
                    Toastr::warning($invalidOtpMessage);
                }
            } else {
                return redirect()->route('childDealer.select-customer');
            }
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
        }
        return view('backend.child_dealer.device_insurance.customer_otp_verification', compact('verificationCode'));
    }


    /**
     * Create new customer on child dealer
     * @param \Illuminate\Http\Request $request;
     * @return response redirect
     */
    public function customerInsert(Request $request)
    {

        $this->validate($request, [

            'phone' => 'required|max:11|regex:/(01)[0-9]{9}/|unique:users,phone'

        ]);


        try {

            $otp = mt_rand(1000, 9999);
            $smsText =  $otp . config('sms.CUSTOMER_REGISTRATION_OTP_SMS');
            $verificationCode = VerificationCode::where('phone', $request->phone)->first();
            if (empty($verificationCode)) {
                ## Create new verification code
                $verificationCode = new VerificationCode();
                $verificationCode->phone = $request->phone;
            }
            $verificationCode->code = $otp;
            $verificationCode->status = 0;
            $verificationCode->save();

            ## Send sms
            if (!empty($this->send_sms($request->phone, $smsText))) {

                $redirectTo = route('childDealer.customerOtpVerification', $verificationCode->phone);

                ## Set session data for next request
                $request->session()->flash('verifyOtpMsg', 'Please Verify Your OTP');
                return response()->json(['success' => true, 'redirectTo' => $redirectTo]);
            };
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
            return response()->json(['success' => false, 'redirectTo' => route('childDealer.device-insurance')]);
        }
    }
}
