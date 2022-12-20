<?php

namespace App\Services;


trait SmsService
{

    /**
     * Send SMS Using SMS API
     * @param $mobile_number 11 digit number starting form 01
     * @param $message message should be bengali language combined with english
     */

    public static function  send_sms($mobile_number, $message)
    {

        $url = config('sms.SMS_API_URL');
        $data = [
            "api_key" =>  config('sms.SMS_API_KEY'),
            "senderid" => config('sms.SMS_API_SENDER_ID'),
            "type" => "text/unicode",
            "contacts" => '+88' . $mobile_number,
            "msg" => str_replace('+', ' ', ($message))
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
