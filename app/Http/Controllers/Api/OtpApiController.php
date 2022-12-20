<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Helpers\UserInfo;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\VerificationCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\CustomerRegistrationRequest;

class OtpApiController extends ApiController
{
    /**
     * Register customer
     * @parem Illuminate\Http\Request $request
     * @return Illuminate\Http\Response json
     */
    public function register(CustomerRegistrationRequest $request)
    {

        ## Create new user instance
        $userReg = new User();
        $userReg->name = $request->name;

        if ($request->email) {
            $userReg->email = $request->email ?? null;
        }
        $userReg->phone = $request->phone;
        $userReg->password = bcrypt($request->password);
        $userReg->user_type = 'customer';
        $userReg->banned = 1;
        $userReg->save();

        if (!empty($userReg)) {
            //for mobile verification
            // mobileVerification($userReg);
            ## Send OTP on mobile

            $success['token'] = $userReg->createToken('instasure')->accessToken;
            $success['details'] = $userReg;
            return response()->json(['success' => true, 'response' => $success]);
        } else {
            return response()->json(['success' => false, 'response' => 'Something went wrong!'], $this->get_error_code());
        }
    }
}
