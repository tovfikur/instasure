<?php

/**
 * Created by PhpStorm.
 * User: ashiq
 * Date: 11/11/2019
 * Time: 3:08 PM
 */

namespace App\Helpers;

use App\Model\FlashDeal;
use App\Model\FlashDealProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;
use Auth;
use Session;
use Carbon\Carbon;
// use App\Helpers\UserInfo;
use Intervention\Image\ImageManagerStatic as Image;

class UserInfo
{
    public function __construct()
    {
    }
    public static function  smsAPI($receiver_number, $sms_text)
    {

        $url = env('SMS_API_URL');
        $data = [
            "api_key" =>  env('SMS_API_KEY'),
            "senderid" => env('SMS_API_SENDER_ID'),
            "type" => "text/unicode",
            "contacts" => $receiver_number,
            "msg" => str_replace('+', ' ', ($sms_text))
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
            return "sms sent";
        }
    }

    public static function send_sms($receiver_number, $sms_text)
    {
        //dd("https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=[".$sms_text."]&mobile_no=[".$receiver_number."]&User_Email=info@priyojon.com");
        //        $api = "https://api.mobireach.com.bd/SendTextMessage?Username=taxman&Password=Abcd@2020&From=TaxManBD&To=".$receiver_number."&Message=". urlencode($sms_text);
        //        $api ="http://isms.zaman-it.com/smsapi?api_key=C20000365d831ca2c90451.06457950&type=text&contacts=".$receiver_number."&senderid=8809612451614&msg=".urlencode($sms_text);

        $api = "http://portal.metrotel.com.bd/smsapi?api_key=C2001118615978b3b5b880.40771009&type=text&contacts=" . $receiver_number . "&senderid=8809612441392&msg=" . urlencode($sms_text);

        //dd($api);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));

        //dd($curl);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
