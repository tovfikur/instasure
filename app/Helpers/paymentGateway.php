<?php

use App\Model\DeviceInsurance;
use App\Model\TravelInsOrder;
use Illuminate\Http\Request;


// CashAndCheckPayment added by Tovfikur

if (!function_exists('amarPayPaymentGateway')) {
    function amarPayPaymentGateway($modeType, $id, $aamarPay = TRUE , $isApi = false)
    {


        $obj = null;
        $modelName = null;
        if ($modeType == 'travel_ins_orders') {
            $obj = TravelInsOrder::find(decrypt($id));
            $modelName = 'TravelInsOrder';
        } elseif ($modeType == 'device_insurance') {
            $obj = DeviceInsurance::find($id);
            $customerInfo = json_decode($obj->customer_info);
            $obj['full_name'] = $customerInfo->customer_name;
            $obj['email'] = $customerInfo->customer_email;
            $obj['phone'] = $customerInfo->customer_phone;
            $modelName =  'DeviceInsurance';
        }
// // try catch added by Tovfikur
//         try {
//             if($aamarPay){
//                 CashAndCheckPayment($modeType, $id, $obj, $modelName);
                
//             }
//         } catch (\Throwable $th) {
//             amarPayPaymentGateway($modeType, $id, $aamarPay = TRUE , $isApi = false);
//         }

        $url = config('payment.AMARPAY_API_URL'); // live url https://secure.aamarpay.com/request.php
        $storId = config('payment.AMARPAY_API_STORE_ID');
        $signatureKey = config('payment.AMARPAY_API_SIGNATURE_KEY');
        $baseUrl = config('payment.AMARPAY_API_BASE_URL');
        $fields = array(
            'store_id' => $storId, //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
            'amount' => $obj->grand_total, //transaction amount
            'payment_type' => 'VISA', //no need to change
            'currency' => 'BDT',  //currenct will be USD/BDT
            //'tran_id' => $obj->invoice_code, //transaction id must be unique from your end
            'tran_id' => mt_rand(11111111, 99999999), //transaction id must be unique from your end
            'cus_name' => $obj->full_name,  //customer name
            'cus_email' => $obj->email ?? 'staritltd@gmail.com', //customer email address
            'cus_add1' => !empty($obj->user) ? $obj->user->address : 'Kallyanpur, Dhaka',  //customer address
            'cus_add2' => !empty($obj->user) ? $obj->user->address : 'Kallyanpur, Dhaka', //customer address
            'cus_city' => 'Dhaka',  //customer city
            'cus_state' => 'Dhaka',  //state
            'cus_postcode' => '1206', //postcode or zipcode
            'cus_country' => 'Bangladesh',  //country
            'cus_phone' => $obj->phone, //customer phone number
            'desc' => 'payment description',
            'success_url' => route('aamrpay.success'), //your success route
            'fail_url' => route('aamrpay.fail'), //your fail route
            'cancel_url' => route('aamrpay.cancel'), //your cancel url
            'opt_a' => $modelName,  //optional paramter
            'opt_b' => $obj->id,
            'opt_c' => $isApi ? 'api' : 'web',
            'signature_key' => $signatureKey
            //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key
        );

        $fields_string = http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
        curl_close($ch);
        $url_forward = $baseUrl . $url_forward;
        $payment_url = substr_replace($url_forward, '/', strrpos($url_forward, '//'), 2);

        // dd($payment_url, $url, $storId, $baseUrl, $signatureKey);


        if ($isApi) {
            return $payment_url;
        }

        redirect_to_merchant($payment_url);
    }

    if (!function_exists('redirect_to_merchant')) {
        function redirect_to_merchant($url)
        {

?>
            <html xmlns="http://www.w3.org/1999/xhtml">

            <head>
                <script type="text/javascript">
                    function closethisasap() {
                        document.forms["redirectpost"].submit();
                    }
                </script>
            </head>

            <body onLoad="closethisasap();">

                <form name="redirectpost" method="post" action="<?php echo $url; ?>"></form>
                <!-- for live url https://secure.aamarpay.com -->
            </body>

            </html>
<?php
            exit;
        }
    }
}
?>
