<?php

namespace App\Http\Controllers\Api;

use App\Helpers\UserInfo;
use App\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Model\VerificationCode;
use Illuminate\Support\Facades\Auth;
use App\Services\VerificationCodeService;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\CustomerLoginRequest;
use App\Http\Requests\Api\CustomerRegistrationRequest;
use App\Http\Requests\Api\CustomerOtpVerificationRequest;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends ApiController
{

    use SmsService;

    /**
     * Register customer
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response json
     */

    public function register(CustomerRegistrationRequest $request, VerificationCodeService $verification_service, UserService $user_service)
    {

        ## Create new user
        $userReg                    = $user_service->create($request);

        ## Check verification code exist for current customer
        $verification_code          = VerificationCode::where('phone', $request->phone)->first();
        if ($verification_code) {
            $verification_code      = $verification_service->update_code($verification_code);
        } else {
            ## Create new verification code
            $verification_code      = $verification_service->create($request->phone);
        }

        ## Send mobile sms
        $sms_text                   = $verification_code->code . config('sms.CUSTOMER_REGISTRATION_OTP_SMS');
        $sms_sent                   = $this->send_sms($userReg->phone, $sms_text);

        if (!empty($userReg)) {
            ## Token generate
            $success['token']       = $userReg->createToken('instasure')->accessToken;
            $success['result']      = $userReg;

            ## Success response
            return response()->json(['success' => true, 'sms_sent' => $sms_sent, 'code' => $this->get_success_code(), 'data' => $success], $this->get_success_code());
        } else {
            ## Error response
            return response()->json(['success' => false, 'sms_sent' => $sms_sent, 'code' => $this->get_error_code(), 'data' => $this->get_success_message()], $this->get_error_code());
        }
    }

    /**
     * Customer OPT verification
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response json
     */
    public function opt_verification(CustomerOtpVerificationRequest $request, VerificationCodeService $verification_service)
    {
        ## Find verification code if exist
        $verification_code              = VerificationCode::where('code', $request->code)->where('phone', $request->phone)->where('status', 0)->first();
        $sms_sent                       = false;

        if (isset($verification_code)) {
            $verification_code = $verification_service->update_status($verification_code);

            ## Update customer
            $user                       = User::where('phone', $request->phone)->first();
            $user->verification_code    = $request->code;
            $user->banned               = 0;
            $user->save();

            ## Send mobile sms
            // $sms_text                   = config('sms.CUSTOMER_REGISTRATION_CONFIRMATION_SMS');
            // $sms_sent                   = $this->send_sms($user->phone, $sms_text);

            ## Success response
            return response()->json(['success' => true, 'sms_sent' => $sms_sent, 'code' => $this->get_success_code(), 'data' => $this->get_success_message()], $this->get_success_code());
        } else {
            ## Fail response
            return response()->json(['success' => false, 'sms_sent' => $sms_sent, 'code' => $this->get_error_code(401), 'data' => $this->get_error_message('Verification code did not match')], $this->get_error_code(401));
        }
    }

    /**
     * Login customer
     * @param \Illuminate\Http\CustomerLoginRequest $request
     * @return \Illuminate\Http\Response json
     */

    public function login(CustomerLoginRequest $request)
    {
        ## Credentials to check and login customer
        $credentials = [
            'phone' => $request->phone,
            'password' => $request->password,
            'banned' => 0

        ];
        ## Attempt to login
        try {
            $user = null;
            $success = [];
            if (Auth::attempt($credentials)) {
                ## Get authenticated user
                $user = User::find(Auth::id());
                $success['token'] = $user->createToken('instasure')->accessToken;
                $success['result'] = $user;
            } else {
                ## Exception handling
                $this->set_err_code(400);
                throw new \Exception("Invalid credentials");
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'user_type' => $user->user_type, 'data' => $success], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_error_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_error_code());
        }
    }


    /**
     * Customer logout
     * @return Illuminate\Http\Response json
     */

    public function logout(Request $request)
    {
        if (Auth::check()) {
            ## Delete all oauth access tokesn related to loggedin user
            Auth::user()->access_tokens()->delete();

            ## Remove api token
            Auth::user()->token()->revoke();

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $this->get_success_message("Successfully logged out")], $this->get_success_code());
        } else {
            ## Failed response
            return response()->json(['success' => false, 'code' => $this->get_error_code(), 'data' => $this->get_error_message("You are not logged in")], $this->get_error_code());
        }
    }

    /**
     * Customer phone number check to reset passowrd
     * @param \Illuminate\Http\Request $request
     * @param \App\Services\VerificationCodeService $verification_service
     * @return \Illuminate\Http\Response json
     */

    public function phone_number_check(Request $request, VerificationCodeService $verification_service)
    {
        $this->validate($request, [
            'phone' => ['required', 'size:11']
        ]);
        try {
            $user = User::where('phone', $request->phone)->first();
            $sms_sent = false;
            ## Exception handling
            if (empty($user)) {
                $this->set_err_code(400);
                throw new \Exception("You are not registered in our system");
            } elseif ($user->user_type != 'customer') {
                $this->set_err_code(400);
                throw new \Exception("You are not a customer");
            } else {
                $verification_code          = VerificationCode::where('phone', $request->phone)->first();
                if ($verification_code) {
                    $verification_code      = $verification_service->update_code($verification_code);
                } else {
                    ## Create new verification code
                    $verification_code      = $verification_service->create($request->phone);
                }

                ## Send mobile sms
                $sms_text                   = $verification_code->code . config('sms.CUSTOMER_REGISTRATION_OTP_SMS');
                $this->send_sms($user->phone, $sms_text);
                $sms_sent                   = 'OPT sent to your mobile, please cehck and verify';
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => $sms_sent], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }

    /**
     * Customer reset passowrd
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response json
     */

    public function reset_password(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'confirmed'],
            'password_confirmation' => 'required',
        ]);
        try {
            $user = User::where('phone', $request->phone)->first();

            ## Exception handling
            if (empty($user)) {
                $this->set_err_code(400);
                throw new \Exception("Please register as acustomer first");
            } elseif ($user->user_type != 'customer') {
                $this->set_err_code(400);
                throw new \Exception("You are not a customer");
            } else {
                $user->password     = Hash::make($request->password);
                $user->save();
            }

            ## Success response
            return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => 'Your password reset successful'], $this->get_success_code());
        } catch (\Throwable $th) {
            ## Fail response
            return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
        }
    }
}
