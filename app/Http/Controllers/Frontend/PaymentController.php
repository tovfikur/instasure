<?php

namespace App\Http\Controllers\Frontend;

use App\Model\ImeiData;
use App\Services\SmsService;
use Illuminate\Http\Request;
// log added by Tovfikur
use Illuminate\Support\Facades\Log;
use App\Model\TravelInsOrder;
use App\Model\DeviceInsurance;
use App\Http\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeviceInsurancePurchaseEmail;


class PaymentController extends Controller
{
    use ResponseTrait;
    use SmsService;
    public function payNow(Request $request)
    {
        amarPayPaymentGateway($request->travel_ins_orders, $request->order_id);
    }
// pay with cash added by Tovfikur
    public function PaywithCash(Request $request, $slug)
    {
        $request->id = $slug;
        return view('frontend.pages.check_payment')->with('request', $request);
    }
    //pay with cash added by Tovfikur
    public function PaywithCashFormUpdate(Request $request, $slug)
    {
        // CashAndCheckPayment($request->travel_ins_orders, $request->order_id);

        ## Travel insurance response after order process
        $request->id = $slug;
        try {
            if ($request->paytype == "travel") {
                $order                      = TravelInsOrder::find($request->id);
                $order->payment_method      = $request->method;
                $order->payment_status      = 'unpaid';
                $order->bank_name           = $request->bank_name;
                $order->issue_date          = $request->date;
                $order->check_number        = $request->number;
                $order->payment_details     = json_encode($request->all());
                $order->save();
                Toastr::success('Payment successfully Received');
                return redirect()->route('user.insurance.purchase.details', encrypt($order->id));
            } elseif($request->paytype == "device") {

                //COPY AND PASTE FROM aamrPaySuccess CONTROLLER

           ## Device insurance response after order process

           $order = DeviceInsurance::find($request->id);

           if (!empty($order)) {
               deviceInsuranceCommissionsDisbursed($order->id);
               $order->payment_method  = $request->method;
               $order->payment_status  = 'unpaid';
               $order->bank_name           = $request->bank_name;
               $order->issue_date          = $request->date;
               $order->check_number        = $request->number;
               $order->payment_details = json_encode($request->all());
               $order->save();

               try {
                   ## Find IMEI Data and set is used true
                   $imeiUsed               = ImeiData::where('imei_1', $order->imei_one)->where('is_used', '<', 1)->first();
                   if (empty($imeiUsed)) {
                       $this->set_err_code(400);
                       throw new \Exception("Your device is already insured");
                   }
                   $imeiUsed->is_used      = 1;
                   $imeiUsed->save();
               } catch (\Throwable $th) {
                   ## Fail response
                   return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
               }


               ## Find & updated order and customer informations
               $order                  = DeviceInsurance::find($order->id);
               $customer               = json_decode($order->customer_info);
               $customer_email         = $customer->customer_email;
               $customer_phone         = $customer->customer_phone;
               $startDate              = date_format_custom($order->created_at, 'F d, Y');
               $endDate                = dateFormat(insExpireDate($order));
               $policy_number          = $order->policy_number;


               if (!empty($customer_phone) && !empty($policy_number) && !empty($startDate) && !empty($endDate)) {
                   ## Send sms to customer email of order confirmation
                   $smsText = "আপনার পলিসি নং {$policy_number} মেয়াদ {$startDate} থেকে {$endDate} - instasure.xyz";
                   $this->send_sms($customer_phone, $smsText);

                   ## Send email to customer email account
                   if (!empty($customer_email)) {
                       // Mail::to($customer_email)->send(new DeviceInsurancePurchaseEmail($policy_number, $startDate, $endDate));
                   }
               }


               ## Success response fOr mobile app
               ## Success response fOr mobile app
               if ($request->opt_c == 'api') {
                   return route('travel_insurance_purchase_history', ['messaage' => 'success']);
               }

               Toastr::success('Payment successfully Received.');
           } else {
               Toastr::error('Order not found');
               return back();
           }

           return redirect()->route('childDealer.device-insurance.order', encrypt($order->id));
            }
            else {
                Toastr::error('Something error in your payment information please check again');
            }
        } catch (\Throwable $th) {
            Log::emergency($th);
            Toastr::error('Something error in your payment information please check again');
            return view('frontend.pages.check_payment')->with('request', $request);
        }
    }
 

    public function aamrPaySuccess(Request $request)
    {
        if ($request->opt_a == 'TravelInsOrder') {
            ## Travel insurance response after order process
            $order                      = TravelInsOrder::find($request->opt_b);
            // $order->status              = 'completed';
            $order->amarpay_status      = 'completed';
            $order->payment_status      = 'paid';
            $order->payment_details     = json_encode($request->all());
            $order->save();
            ## Success response fOr mobile app
            if ($request->opt_c == 'api') {
                return route('travel_insurance_purchase_history', ['messaage' => 'success']);
            }
            Toastr::success('Payment successfully Received');
            return redirect()->route('user.insurance.purchase.details', encrypt($order->id));
        } elseif ($request->opt_a == 'DeviceInsurance') {
            ## Device insurance response after order process
            $order = DeviceInsurance::find($request->opt_b);

            if (!empty($order)) {
                deviceInsuranceCommissionsDisbursed($order->id);
                $order->status          = 'completed';
                $order->payment_status  = 'paid';
                $order->payment_method  = 'aamarpay';
                $order->payment_details = json_encode($request->all());
                $order->save();

                try {
                    ## Find IMEI Data and set is used true
                    $imeiUsed               = ImeiData::where('imei_1', $order->imei_one)->where('is_used', '<', 1)->first();
                    if (empty($imeiUsed)) {
                        $this->set_err_code(400);
                        throw new \Exception("Your device is already insured");
                    }
                    $imeiUsed->is_used      = 1;
                    $imeiUsed->save();
                } catch (\Throwable $th) {
                    ## Fail response
                    return response()->json(['success' => false, 'code' => $this->get_err_code(), 'data' => $this->get_error_message($th->getMessage())], $this->get_err_code());
                }


                ## Find & updated order and customer informations
                $order                  = DeviceInsurance::find($order->id);
                $customer               = json_decode($order->customer_info);
                $customer_email         = $customer->customer_email;
                $customer_phone         = $customer->customer_phone;
                $startDate              = date_format_custom($order->created_at, 'F d, Y');
                $endDate                = dateFormat(insExpireDate($order));
                $policy_number          = $order->policy_number;


                if (!empty($customer_phone) && !empty($policy_number) && !empty($startDate) && !empty($endDate)) {
                    ## Send sms to customer email of order confirmation
                    $smsText = "আপনার পলিসি নং {$policy_number} মেয়াদ {$startDate} থেকে {$endDate} - instasure.xyz";
                    $this->send_sms($customer_phone, $smsText);

                    ## Send email to customer email account
                    if (!empty($customer_email)) {
                        // Mail::to($customer_email)->send(new DeviceInsurancePurchaseEmail($policy_number, $startDate, $endDate));
                    }
                }


                ## Success response fOr mobile app
                ## Success response fOr mobile app
                if ($request->opt_c == 'api') {
                    return route('travel_insurance_purchase_history', ['messaage' => 'success']);
                }

                Toastr::success('Payment successfully Received.');
            } else {
                Toastr::error('Order not found');
                return back();
            }

            return redirect()->route('childDealer.device-insurance.order', encrypt($order->id));
        }
    }



    public function aamrPayFail(Request $request)
    {
        // dd($request->all());
        ## Success response for Mobile App on payment failed
        // if ($request->is_api) {
        //     return response()->json(['success' => true, 'code' => $this->get_success_code(), 'data' => "Payment faild"], $this->get_success_code());
        // }

        ## Failed response for travel insurance order
        if ($request->opt_a == 'TravelInsOrder') {
            if ($request->opt_c == 'api') {
                return route('travel_insurance_purchase_history', ['messaage' => 'failed']);
            }
            Toastr::error('Travel Insurance Payment failed');
            return redirect()->route('user.insurance.purchase.details', encrypt($request->opt_b));
        } else {

            ## Failed response for device insurance order
            if ($request->opt_c == 'api') {
                return route('travel_insurance_purchase_history', ['messaage' => 'failed']);
            }
            Toastr::error('Device Insurance Payment failed');
            return redirect()->route('childDealer.device-insurance.order', encrypt($request->opt_b));
        }
    }

    public function aamrPaycancel(Request $request)
    {
        Toastr::error('Payment cancled');
        return redirect()->route('childDealer.device-insurance.order', encrypt($request->opt_b));
    }
}
