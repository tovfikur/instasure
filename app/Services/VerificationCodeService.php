<?php

namespace App\Services;

use App\Model\VerificationCode;

class VerificationCodeService
{
    /**
     * Create new verification code
     * @param $mobile_number
     * @return VerificationCode $verification_code
     */
    public function create($mobile_number)
    {
        $verification_code = new VerificationCode();
        $verification_code->phone = $mobile_number;
        $verification_code->code = $this->get_code();
        $verification_code->status = 0;
        $verification_code->save();
        return $verification_code;
    }

    /**
     * Create new verification code
     * @param $mobile_number
     * @return VerificationCode $verification_code
     */
    public function update_code($verification_code)
    {
        $verification_code->status = 0;
        $verification_code->code = $this->get_code();
        $verification_code->save();
        return $verification_code;
    }
    /**
     * Update verification code status
     * @param $verification_code
     * @return VerificationCode $verification_code
     */
    public function update_status($verification_code)
    {
        $verification_code->status = 1;
        $verification_code->save();
        return $verification_code;
    }

    /**
     * Generate random code
     * @return 4 digit random number
     */

    private function get_code()
    {
        return mt_rand(1111, 9999);
    }
}
