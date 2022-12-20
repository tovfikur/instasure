<?php
//filter products published
use App\User;
use Mailjet\Client;
use App\Model\Dealer;
use Mailjet\Resources;
//Category model added by Tovfikur
use App\Model\Category;
use App\Helpers\UserInfo;
use App\Model\Withdrawal;
use App\Model\Transaction;
use App\Model\OfferRequest;
use App\Model\SpecialistDr;
use App\Model\BusinessSetting;
use App\Model\DeviceInsurance;
use Illuminate\Support\Carbon;
use App\Model\VerificationCode;
use App\Model\HomeServiceReview;
use App\Model\DeliveryManRequest;
use App\Model\HomeServiceRequest;
use App\Model\TelemedicineReview;
use App\Model\TelemedicineRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


function send_mailjet_mail1($receiver_email, $receiver_name, $sender_email, $sender_name, $subject, $message)
{
    $mj = new Client('0cacc75aa30ce36a6200678d176f0de8', '6085b476e4d0ce9817c0933cf773cf80', true, ['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => $sender_email,
                    'Name' => $sender_name,
                ],
                'To' => [
                    [
                        'Email' => $receiver_email,
                        'Name' => $receiver_name,
                    ]
                ],
                'Subject' => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ]
        ]
    ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
}


/**
 * @param $futureDate valid date
 * @return Mixed [string,boolean]
 */
if (!function_exists('custom_errors_bag')) {
    function custom_errors_bag($errors)
    {
        return call_user_func_array('array_merge', $errors);
    }
}


/**
 * @param $futureDate valid date
 * @return Mixed [string,boolean]
 */
if (!function_exists('is_expired')) {
    function is_expired($futureDate)
    {
        $carbonNow = Carbon::now();
        if ($futureDate > $carbonNow) {
            return $carbonNow->diffInMinutes($futureDate);
        }
        return false;
    }
}


/**
 * @param $path Mixed [string,array]
 * @return $path Mixed [string,array]
 */
if (!function_exists('img_absolute_path_custom')) {
    function img_absolute_path_custom($path = null)
    {
        if (is_array($path)) {
            $path_list = [];
            foreach ($path as $item) {
                $path_list[] =  asset('/') . $item;
            }
            $path = $path_list;
        } else {
            $path = asset('/') . $path;
        }
        return $path;
    }
}


/**
 * @param $str String value
 * @return String
 */
if (!function_exists('str_remove_dashes_custom')) {
    function str_remove_dashes_custom($str)
    {
        $str = str_replace('-', ' ', $str);
        $str = str_replace('_', ' ', $str);
        $str = str_replace('  ', ' ', $str);
        return $str;
    }
}

/**
 * Remove dashes, white spaces
 * @param string $str
 * @return string $str
 */
if (!function_exists('remove_white_spaces_dashes')) {
    function remove_white_spaces_dashes($str)
    {
        $str = trim($str);
        $str = str_replace(' ', '_', $str);
        $str = str_replace('-', '_', $str);
        $str = str_replace('  ', '_', $str);
        return strtolower($str);
    }
}

## Date format ##
if (!function_exists('date_format_custom')) {
    function date_format_custom($date, $format = 'F d, Y')
    {
        return date($format, strtotime($date));
    }
}
## substrings ##
if (!function_exists('substrings')) {
    function substrings($str, $length = 50)
    {
        $str = substr($str, 0, $length);
        $str = substr($str, 0, strrpos($str, ' '));
        return $str;
    }
}

//unique phone number check
if (!function_exists('phoneNumberCheck')) {
    function phoneNumberCheck($phone)
    {
        $user = User::where('phone', $phone)->first();
        return 10;
        if (!empty($user)) {
            return response()->json([
                'message' => 'Phone number already exist rocky vai :P!!',
            ], 401);
        }
    }
}

//unique email check
if (!function_exists('emailCheck')) {
    function emailCheck($email)
    {
        $user = User::where('email', $email)->first();
        if (!empty($user)) {
            return response()->json([
                'message' => 'Email already exist rocky vai :P!!',
            ], 401);
        }
    }
}

/**
 * Upload image using intervention package
 * @param $image parameter should be valid image stream
 * @param $path parameter should be valid string path
 * @param $size parameter should image size of array
 * @param $quality parameter should quality of the image 0 to 100, default 90
 * @param $format parameter should image format, default jpg
 *  */
if (!function_exists('imageUpload')) {
    function imageUpload(object $image, string $path, $size, int $quality = 90, string $format = 'jpg')
    {
        create_dir_if_doesnot_exit($path);
        $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
        $extension = $image->getClientOriginalExtension();
        $imagename = $currentDate . '-' . uniqid() . '.' . $format;
        $path = format_image_upload_path(public_path('/') . $path . '/' . $imagename);

        if ($size == 0) {
            Image::make($image)->save($path, $quality, $format);
        } else {
            Image::make($image)->resize($size)->save($path, $quality, $format);
        }
        return $imagename;
    }
}
/**
 * This function witll format upload path on any type of images
 * @param $path parameter should be valid string path
 *  */
if (!function_exists('format_image_upload_path')) {
    function format_image_upload_path($path)
    {
        $path = str_replace('\\', '/',  $path);
        $path = str_replace('///', '/', $path);
        $path = str_replace('//', '/', $path);
        $path = str_replace('\/', '/', $path);
        return $path;
    }
}

/**
 * Create directory if does not exist
 * @param string $path
 * @return boolean true | fasle
 */
if (!function_exists('create_dir_if_doesnot_exit')) {
    function create_dir_if_doesnot_exit($path)
    {
        if (!File::exists($path)) {
            File::makeDirectory($path);
        }
        return;
    }
}


//image upload
if (!function_exists('imageUploadAndUpdate')) {
    function imageUploadAndUpdate($image, $path, $size, $prevImage)
    {

        $currentDate = \Illuminate\Support\Carbon::now()->toDateString();
        $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

        //delete old image.....
        if ($prevImage != 'default.png') {
            if (Storage::disk('public')->exists($path . $prevImage)) {
                Storage::disk('public')->delete($path . $prevImage);
            }
        }
        if ($size == 0) {
            $proImage = Image::make($image)->save($image->getClientOriginalExtension());
        } else {
            $proImage = Image::make($image)->resize($size)->save($image->getClientOriginalExtension());
        }
        Storage::disk('public')->put($path . $imagename, $proImage);
        return $imagename;
    }
}

//otp send after registration
if (!function_exists('mobileVerification')) {
    function mobileVerification($userReg)
    {

        $verification = VerificationCode::where('phone', $userReg->phone)->first();
        if (!empty($verification)) {
            $verification->delete();
        }
        $verCode = new VerificationCode();
        $verCode->phone = $userReg->phone;
        $verCode->code = mt_rand(1111, 9999);
        $verCode->status = 0;
        $verCode->save();

        $text = $verCode->code . " is your One-Time Password (OTP) for Doctor Pathao. Enjoy with Doctor Pathao ";
        UserInfo::smsAPI("88" . $verCode->phone, $text);
        return 200;
    }
}

if (!function_exists('getBusinessSettingValue')) {
    function getBusinessSettingValue($type)
    {
        return BusinessSetting::where('type', $type)->first()->value;
    }
}

//This function made by Tovfikur
function vat_recognizer($cat = '')
{
    try {
        if($cat != ''){
            return Category::where('name', $cat)->first()->getOriginal('vat');
        } else {
            throw new Exception('Category is empty');
        }
    } catch (\Throwable $th) {
        return BusinessSetting::where('type', 'vat')->first()->value;
    }
}




//show vat
if (!function_exists('vat')) {
    function vat($cat = '')
    {
        // next line replaced by Tovfikur
        return vat_recognizer($cat);
    }
}
//vat calculation
if (!function_exists('calculatedVatResult')) {
    function calculatedVatResult($amount, $cat = '')
    {
        
        //next line replaced by Tovfikur
        $vat = vat_recognizer($cat);
        $result = ($amount * $vat) / 100;
        return number_format($result, 2, '.', '');

    }
}
// calculated vat with amount
if (!function_exists('calculatedAmountWithVat')) {
    function calculatedAmountWithVat($amount, $cat = '')
    {
        //next line replaced by Tovfikur
        $vat = vat_recognizer($cat);
        $result = ($amount * $vat) / 100;
        $total = $amount + $result;
        return number_format($total, 2, '.', '');
    }
}


//This function made by Tovfikur
function serviceCharge_recognizer($cat = '')
{
    try {
        if($cat != ''){
            return Category::where('name', $cat)->first()->getOriginal('service');
        } else {
            throw new Exception('Category is empty');
        }
    } catch (\Throwable $th) {
        return BusinessSetting::where('type', 'service_charge')->first()->value;
    }
}


//show service charge
if (!function_exists('serviceCharge')) {
    function serviceCharge($cat = '')
    {
        //next line replaced by Tovfikur
        return serviceCharge_recognizer($cat);
    }
}
//service charge calculation
if (!function_exists('calculatedServiceChargeResult')) {
    function calculatedServiceChargeResult($amount, $cat = '')
    {
        $serviceCharge = serviceCharge_recognizer($cat);
        $result = ($amount * $serviceCharge) / 100;
        return number_format($result, 2, '.', '');
    }
}

//show Child Dealer Commission
if (!function_exists('childDealerCommission')) {
    function childDealerCommission()
    {
        return BusinessSetting::where('type', 'child_dealer_commission')->first()->value;
    }
}
//Child Dealer Commission calculation
if (!function_exists('calculatedChildDealerCommission')) {
    function calculatedChildDealerCommission($amount)
    {
        $childDealer = Dealer::where('user_id', Auth::id())->first();
        if ($childDealer->commission_type == 'flat') {
            $result = $amount + $childDealer->commission_amount;
        } else {
            $result = ($amount * $childDealer->commission_amount) / 100;
        }
        return number_format($result, 2, '.', '');
    }
}
if (!function_exists('calculatedParentDealerCommission')) {
    function calculatedParentDealerCommission($amount)
    {
        $childDealer = Dealer::where('user_id', Auth::id())->first();
        $parentDealer = Dealer::where('id', $childDealer->parent_id)->first();
        if ($parentDealer->commission_type == 'flat') {
            $result = $amount + $parentDealer->commission_amount;
        } else {
            $result = ($amount * $parentDealer->commission_amount) / 100;
        }
        return number_format($result, 2, '.', '');
    }
}



//unique code generator.....
if (!function_exists('getTrx')) {
    function getTrx($length = 12)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}



if (!function_exists('GetDistance')) {
    function GetDistance($url)
    {
        //$api ="https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/90.39534587,23.86448886/90.3673,23.8340";
        //$api = "https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=".urlencode($sms_text)."&mobile_no=".$receiver_number."&User_Email=info@priyojon.com";
        //dd($api);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
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
            $distance = json_decode($response);
            return $distance->Distance;
        }
    }
}
if (!function_exists('GetAddress')) {
    function GetAddress($long, $lat)
    {
        //$api ="https://barikoi.xyz/v1/api/distance/MjMzNTpTWlBLSkRHUTRZ/90.39534587,23.86448886/90.3673,23.8340";
        //$api = "https://71bulksms.com/sms_api/bulk_sms_sender.php?api_key=16630227328497042020/04/0406:34:27amPriyojon&sender_id=188&message=".urlencode($sms_text)."&mobile_no=".$receiver_number."&User_Email=info@priyojon.com";
        $api = "https://barikoi.xyz/v1/api/search/reverse/MjMzNTpTWlBLSkRHUTRZ/geocode?longitude=$long&latitude=$lat";
        //        dd($api);
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
            $address = json_decode($response);
            return $address->place->address;
        }
    }
}


if (!function_exists('userObj')) {
    function userObj($id)
    {
        return User::find($id);
    }
}
if (!function_exists('myChildDealerCount')) {
    function myChildDealerCount($id)
    {
        return Dealer::where('parent_id', $id)->count();
    }
}
if (!function_exists('getPolicyNumber')) {
    function getPolicyNumber($api)
    {

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
            return json_decode($response);
        }
    }
}
if (!function_exists('DamageAndOtherValueCalculation')) {
    function DamageAndOtherValueCalculation($type, $value, $handSetAmount)
    {
        if ($type == 'percentage') {
            return $handSetAmount * $value / 100;
        } else {
            return $value;
        }
    }
}
if (!function_exists('ScreenProtectionValueCalculation')) {
    function ScreenProtectionValueCalculation($type, $value, $handSetAmount, $appliedValue)
    {
        $updatedAmount = $handSetAmount * $appliedValue / 100;
        if ($type == 'percentage') {
            return $updatedAmount * $value / 100;
        } else {
            return $value;
        }
    }
}
if (!function_exists('InsurancePriceCalculation')) {
    function InsurancePriceCalculation($id, $handSetAmount)
    {
        $insPrice = \App\Model\InsurancePrice::find($id);
        if ($insPrice->include_type == 'included') {
            $updatedAmount = $handSetAmount * $insPrice->applied_value_two / 100;
            if ($insPrice->type == 'percentage') {
                return $updatedAmount * $insPrice->value / 100;
            } else {
                return $insPrice->value;
            }
        } else {
            if ($insPrice->applied_value_two > 0) {
                $updatedAmount = $handSetAmount * $insPrice->applied_value_two / 100;
                if ($insPrice->type == 'percentage') {
                    return $updatedAmount * $insPrice->value / 100;
                } else {
                    return $insPrice->value;
                }
            } else {
                if ($insPrice->type == 'percentage') {
                    return $handSetAmount * $insPrice->value / 100;
                } else {
                    return $insPrice->value;
                }
            }
        }
    }
}


if (!function_exists('commissionCalculation')) {
    function commissionCalculation($amount, $value, $percentageType)
    {
        if ($percentageType == 'percentage') {
            return $amount * $value / 100;
        } else {
            return $value;
        }
    }
}


if (!function_exists('appliedOnHandsetValueCalculation')) {
    function appliedOnHandsetValueCalculation($amount, $percentValue, $percentageType, $appliedHandSetAmount)
    {
        $updatedAmount = $amount * $appliedHandSetAmount / 100;
        if ($percentageType == 'percentage') {
            return $updatedAmount * $percentValue  / 100;
        } else {
            return $percentValue;
        }
    }
}

if (!function_exists('incPackBtExcItems')) {
    function incPackBtExcItems($amount, $percentValue, $percentageType)
    {
        if ($percentageType == 'percentage') {
            return $amount * $percentValue  / 100;
        } else {
            return $percentValue;
        }
    }
}

if (!function_exists('deviceInsuranceCommissionsDisbursed')) {
    function deviceInsuranceCommissionsDisbursed($orderId): int
    {
        $deviceInsurance = DeviceInsurance::with(['package'])->find($orderId);
        

        $policy_provider_code = (string) $deviceInsurance->package->policy_provider->code;
        // modified by Tovfikur
        try {
            $insurance_category_code = (string)  $deviceInsurance->package->insurance_category->code;
        } catch (\Throwable $th) {
            $insurance_category_code = (string)  $deviceInsurance->package->insurance_category_id;
        }

        if (!empty($deviceInsurance)) {
            $parentDealer = Dealer::find($deviceInsurance->parent_dealer_id);
            $parentDealer->dealer_balance += $deviceInsurance->parent_dealer_commission;
            $parentDealer->due_balance += $deviceInsurance->parent_will_pay_to_admin;
            $parentDealer->save();
            $childDealer = Dealer::find($deviceInsurance->child_dealer_id);
            $childDealer->dealer_balance += $deviceInsurance->child_dealer_commission;
            $childDealer->save();
            $deviceInsurance->status = 'completed';
            $deviceInsurance->policy_number = generateCustomPolicyNumber(8, $insurance_category_code, $policy_provider_code, 'I');
            $deviceInsurance->save();
            $result = 1;
        } else {
            $result = 0;
        }
        return $result;
    }
}
/** Generate custome policy number
 * @param $length Default length 8
 * @param $insuranceCategoryCode Insurance category code will come dynamically from categories table
 * @param $policyProviderCode Will come from policy provider table dynamically
 * @param $prefix Default prefix "I"
 * @return string Custome policy number
 * @author sakil.diu.cse@gmail.com
 */

function generateCustomPolicyNumber($length = 8, string $insuranceCategoryCode, string $policyProviderCode, string $prefix = "I")
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, (strlen($characters) - 1))];
    }
    $randomString = $prefix . $insuranceCategoryCode . $policyProviderCode . $randomString;
    return $randomString;
}


// if (!function_exists('deviceInsuranceCommissionsDisbursed')) {
//     function deviceInsuranceCommissionsDisbursed($orderId): int
//     {
//         $deviceInsurance = DeviceInsurance::find($orderId);
//         if (!empty($deviceInsurance)) {
//             $parentDealer = Dealer::find($deviceInsurance->parent_dealer_id);
//             $parentDealer->dealer_balance += $deviceInsurance->parent_dealer_commission;
//             $parentDealer->due_balance += $deviceInsurance->parent_will_pay_to_admin;
//             $parentDealer->save();
//             $childDealer = Dealer::find($deviceInsurance->child_dealer_id);
//             $childDealer->dealer_balance += $deviceInsurance->child_dealer_commission;
//             $childDealer->save();
//             $deviceInsurance->status = 'completed';
//             $deviceInsurance->policy_number = 'INS-' . mt_rand(111111, 999999);
//             $deviceInsurance->save();
//             $result = 1;
//         } else {
//             $result = 0;
//         }
//         return $result;
//     }
// }



if (!function_exists('insExpireDate')) {
    function insExpireDate($orderObj)
    {
        return $orderObj->created_at->addDays(364)->format('d-m-Y');
    }
}
if (!function_exists('insRemainingDays')) {
    function insRemainingDays($orderObj)
    {
        $currentDate =  Carbon::now()->format('d-m-Y');
        return Carbon::parse(insExpireDate($orderObj))->diffInDays($currentDate);
    }
}
if (!function_exists('claimWillActiveDate')) {
    function claimWillActiveDate($orderObj)
    {
        $daysInMonth = $orderObj->created_at->daysInMonth;
        return $orderObj->created_at->addDays($daysInMonth - 1)->format('d-m-Y');
    }
}
if (!function_exists('dayCountCheckForClaim')) {
    function dayCountCheckForClaim($orderObj)
    {
        $currentDate =  Carbon::now()->format('d-m-Y');
        return Carbon::parse($orderObj->created_at->format('d-m-Y'))->diffInDays($currentDate);
    }
}
if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        return date('F d, Y', strtotime($date));
        //Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
if (!function_exists('dateTimeFormat')) {
    function dateTimeFormat($date)
    {
        return date('F d, Y h:i A', strtotime($date));
        //Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}

if (!function_exists('userWillPay')) {
    function userWillPay($amount)
    {
        $result = $amount * 10 / 100;
        if ($result >= 500) {
            return 500;
        } else {
            return $result;
        }
    }
}
