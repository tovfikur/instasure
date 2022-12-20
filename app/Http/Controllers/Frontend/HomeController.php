<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Model\Blog;
use App\Model\Page;

use App\Model\Slider;
use App\Model\Category;
use App\Model\DeviceClaim;
use App\Model\BlogCategory;
use Illuminate\Http\Request;
use App\Model\PolicyProvider;
use App\Model\TravelInsOrder;
use App\Model\DeviceInsurance;
use App\Model\DeviceClaimRequest;
use App\Model\TravelInsPlansChart;
use App\Model\ServiceCenterDetails;
use App\Http\Controllers\Controller;
use App\Mail\ContactUsEmail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Model\TravelInsPlansCategory;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::all();
        return view('frontend.index', $data);
    }
    public function dashboard()
    {
        $totalMediclaimOrder = TravelInsOrder::where('user_id', Auth::id())->count();
        $totalDeviceOrder = DeviceInsurance::where('user_id', Auth::id())->count();
        $totalDeviceClaim = DeviceClaim::where('user_id', Auth::id())->count();
        $totalDeviceClaimReq = DeviceClaimRequest::where('user_id', Auth::id())->count();
        //dd($totalDeviceClaim);
        return view('frontend.pages.dashboard', compact(
            'totalMediclaimOrder',
            'totalDeviceOrder',
            'totalDeviceClaim',
            'totalDeviceClaimReq'
        ));
    }
    public function profile()
    {
        return view('frontend.pages.profile');
    }
    public function profileUpdate(Request $request)
    {

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->passport_number = $request->passport_number;
        $user->passport_expire_till = $request->passport_expire_till;

        if ($request->hasFile('avatar_original')) {
            $user->avatar_original = $request->avatar_original->store('uploads/profile');
        }

        $passportImages = array();
        if ($request->hasFile('passport')) {
            foreach ($request->passport as $key => $passport) {
                $path = $passport->store('uploads/passport');
                array_push($passportImages, $path);
            }
            $user->passport = json_encode($passportImages);
        }
        $nidImages = array();
        if ($request->hasFile('nid')) {
            foreach ($request->nid as $key => $nid) {
                $path = $nid->store('uploads/nid');
                array_push($nidImages, $path);
            }
            $user->nid = json_encode($nidImages);
        }
        if ($request->hasFile('driving_licence')) {
            $user->driving_licence = $request->driving_licence->store('uploads/driving_licence');
        }
        if ($request->hasFile('birth_certificate')) {
            $user->birth_certificate = $request->birth_certificate->store('uploads/birth_certificate');
        }
        $user->save();
        Toastr::success('Profile update successfully done');
        return back();
    }
    public function about()
    {
        return view('frontend.pages.about');
    }
    public function otpVerification()
    {
        return view('frontend.pages.verification');
    }
    public function insurancePurchaseHistory()
    {
        $travelOrders = TravelInsOrder::where('user_id', Auth::id())->latest()->paginate(6);
        return view('frontend.pages.insurance_purchase_history', compact('travelOrders'));
    }
    /**
     * Travel insurance order details
     * @param \App\Model\TravelInsOrder $id
     * @return \Illuminate\Http\Response view
     */
    public function insurancePurchaseDetails($id)
    {
        $travelOrder = TravelInsOrder::with('policy_provider')->find(decrypt($id));
        return view('frontend.pages.insurance_purchase_details', compact('travelOrder'));
    }

    /**
     * Delete unpaid Travel insurance order details
     * @param \App\Model\TravelInsOrder $id
     * @return void
     */
    public function delete_unpaid_travel_insurance($id)
    {

        $travelOrder = TravelInsOrder::with('policy_provider')->find(decrypt($id));
        if (!$travelOrder) {
            Toastr::error('Invalid request');
            return redirect()->route('user.insurance.purchase.history');
        }
        $travelOrder->delete();
        Toastr::error('Order deleted successfully');
        return redirect()->route('user.insurance.purchase.history');
    }


    public function insuranceClaimHistory()
    {
        $deviceClaim = DeviceClaim::where('user_id', Auth::id())->latest()->paginate(6);
        return view('frontend.pages.insurance_claim_history', compact('deviceClaim'));
    }
    public function deviceInsuranceClaimDetails($id)
    {
        $deviceClaim = DeviceClaim::where('user_id', Auth::id())->latest()->get();
        return view('frontend.pages.insurance_claim_history', compact('deviceClaim'));
    }
    public function insuranceDetails($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('frontend.pages.insurance_details', compact('category'));
    }

    public function insuranceQuatationForm()
    {
        return view('frontend.pages.medical_insurance_quatation_form');
    }
    public function getPlanCategory(Request $request)
    {

        $planCategory = TravelInsPlansCategory::where('country_type', $request->country_type)->get();
        return $planCategory;
    }

    public function getProviderWithData(Request $request)
    {
        ## Calculate traveller age
        $dateOfBirth = date_format_custom($request->dob, 'Y-m-d');
        $today = date("Y-m-d");
        $date_of_birth_difference_obj = date_diff(date_create($dateOfBirth), date_create($today));
        $years = $date_of_birth_difference_obj->days / 365;
        $age = 0;
        if ($dateOfBirth < $today) {
            $age = (float) number_format($years, 2);
        }
        // dd(date_format_custom($dateOfBirth, 'Y-m-d'), $today);
        // dd($dateOfBirth, $today, $date_of_birth_difference_obj, $age);

        ## Passport expire days
        $passport_expire_till = $request->passport_expire_till;
        $passport_expire_days = 0;
        if (date_format_custom($passport_expire_till, 'Y-m-d') < $today) {
            $passport_expire_days_calculation = date_diff(date_create($passport_expire_till), date_create($today));
            if ($passport_expire_days_calculation->days > 14) {
                $age = 0;
            }
            $passport_expire_days = $passport_expire_days_calculation->days;
        }
        // dd($years, $age);

        ## Calculate total visit days
        $total_date = 0;
        if ($request->flight_date < $request->return_date) {
            $total_date = date_diff(date_create($request->flight_date), date_create($request->return_date))->format('%d');
        }

        // dd($request->all(), [$age, $total_date]);

        if ($age > 0) {
            $travelCategory = TravelInsPlansCategory::find($request->plan_category_id);
            $travelPlanCharts = TravelInsPlansChart::where('travel_ins_plans_category_id', $travelCategory->id)
                ->where('age_from', '<=', $age)
                ->where('age_to', '>=', $age)
                ->where('period_from', '<=', $total_date)
                ->where('period_to', '>=', $total_date)
                ->get();

            return view('frontend.partials.insurance_provider_info', compact('travelPlanCharts', 'age', 'total_date'));
        }
    }



    public function insuranceQuatationCalculation(Request $request)
    {

        $travelCategory = TravelInsPlansCategory::find($request->plan_category_id);
        $travelPlanChart = TravelInsPlansChart::find($request->package_id);
        $policyProvider = PolicyProvider::find($travelPlanChart->policy_provider_id);
        if (empty($travelPlanChart->ins_price)) {
            Toastr::error('Your criteria does not match the price');
            return back();
        }

        $ins_price = $travelPlanChart->ins_price;

        $totalVat = calculatedVatResult($ins_price, 'Travel Medical Insurance');
        $totalServiceCharge = calculatedServiceChargeResult($ins_price, 'Travel Medical Insurance');
        $grandTotal = $ins_price + $totalVat + $totalServiceCharge;

        $travelInsOrder = new TravelInsOrder();
        $travelInsOrder->user_id = Auth::id();
        $travelInsOrder->travel_insurance_category_title = $travelCategory->country_type . ' ' . $travelCategory->plan_title . ' (' . $travelCategory->county_details . ')';
        $travelInsOrder->travel_ins_plans_category_id = $request->plan_category_id;
        $travelInsOrder->full_name = $request->full_name;
        $travelInsOrder->phone = $request->phone;
        $travelInsOrder->email = $request->email;
        $travelInsOrder->dob = date_format_custom($request->dob, 'Y-m-d');
        $travelInsOrder->age = $request->age;
        $travelInsOrder->passport_number = $request->passport_number;
        $travelInsOrder->passport_expire_till = date_format_custom($request->passport_expire_till, 'Y-m-d');
        if ($policyProvider->is_api == 1) {
            Toastr::success('Please wait we are collecting your policy number form your desire  provider');
            //$travelInsOrder->policy_number = getPolicyNumber($policyProvider->api_url);
            // $travelInsOrder->policy_number = mt_rand(111111, 999999);
        } else {
            // $travelInsOrder->policy_number =  'DNS' . mt_rand(111111, 999999);;
        }

        $travelInsOrder->ins_price = $ins_price;
        $travelInsOrder->travel_ins_plans_charts_id = $travelPlanChart->id;
        $travelInsOrder->insurance_provider_id = $travelPlanChart->policy_provider_id;


        $travelInsOrder->vat_percentage = vat('Travel Medical Insurance');
        $travelInsOrder->total_vat = $totalVat;
        $travelInsOrder->service_amount = serviceCharge('Travel Medical Insurance');
        $travelInsOrder->service_total_amount = $totalServiceCharge;
        $travelInsOrder->grand_total = $grandTotal;
        $travelInsOrder->flight_number = $request->flight_number;
        $travelInsOrder->flight_date = date_format_custom($request->flight_date, 'Y-m-d');
        $travelInsOrder->return_date = date_format_custom($request->return_date, 'Y-m-d');
        $travelInsOrder->total_date = $request->total_date;
        $travelInsOrder->shipping_address = $request->shipping_address;
        $travelInsOrder->invoice_code = date('Ymd-his');
        $travelInsOrder->save();
        return view('frontend.partials.insurance_payment', compact('travelInsOrder'));
        //return response()->json(['response' => $travelInsOrder], 201);
        //return $travelInsOrder;
    }
    public function insuranceQuotationDetails($id)
    {
        $travelInsOrder = TravelInsOrder::find(decrypt($id));
        return view('frontend.pages.medical_insurance_quotation_details', compact('travelInsOrder'));
    }

    public function travelInsCertificate($id)
    {
        $travelInsOrder = TravelInsOrder::find(decrypt($id));
        return view('frontend.pages.travel_policy_certificate', compact('travelInsOrder'));
    }

    public function fag()
    {
        $page = Page::where('type', 'faq')->first();
        return view('frontend.pages.faq', compact('page'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('type', 'privacy_policy')->first();
        return view('frontend.pages.privacy_policy', compact('page'));
    }

    public function termsAndCondition()
    {
        $page = Page::where('type', 'terms_and_condition')->first();
        return view('frontend.pages.terms_and_condition', compact('page'));
    }

    public function contactUs()
    {
        return view('frontend.pages.contact_us');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function contact_us_send_email_backup(Request $request)
    {
        ## Validate incoming request
        $request->validate([
            "name" => ['required'],
            "email" => ['required', 'email'],
            "phone_number" => ['required', 'regex:/(01)[0-9]{9}/', 'size:11'],
            "message" => ['required', 'min:5'],
            "g-recaptcha-response" => ['required'],
            "business_name" => 'required_if:type,partner'
        ], [
            'g-recaptcha-response.required'    => "Please check I'm not robot checkbox",
            'name.required'    => "Full name required",
            'email.required'    => "Email required",
            'phone_number.required'    => "11 digit mobile number required",
            'business_name.required_if'    => "Business name required",
        ]);


        if (isset($request->type) && $request->type == 'partner') {
            Mail::to(config('settings.email_receiver'))->send(new ContactUsEmail($request->only(['name', 'email', 'phone_number',  'business_name', 'message']), 'partner'));
            ## Success response for partner program
            Toastr::success('Thanks for being with us, we will come back you soon');
            return back();
        }
        ## Send email
        Mail::to(config('settings.email_receiver'))->send(new ContactUsEmail($request->only(['name', 'email', 'phone_number', 'message'])));

        ## Success response
        Toastr::success('Thanks for being with us, we will come back you soon');
        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function contact_us_send_email(Request $request)
    {
        ## Validate incoming request
        $request->validate([
            "name" => ['required'],
            "email" => ['required', 'email'],
            "phone_number" => ['required', 'regex:/(01)[0-9]{9}/', 'size:11'],
            "message" => ['required', 'min:5'],
            "g-recaptcha-response" => ['required'],
            "business_name" => 'required_if:type,partner'
        ], [
            'g-recaptcha-response.required'    => "Please check I'm not robot checkbox",
            'name.required'    => "Full name required",
            'email.required'    => "Email required",
            'phone_number.required'    => "11 digit mobile number required",
            'business_name.required_if'    => "Business name required",
        ]);

        try {

            $email_sender = config('settings.email_sender');
            $email_receiver = config('settings.email_receiver');
            ## Define subject for contact us page
            $subject = 'Visitors Query Through Contact Page - ' . config('app.name');

            ## Get inputs
            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone_number;
            $message = $request->message;
            $business_name = $request->business_name;
            $email_template = '

            <p><strong>Query Details</strong></p>

            <div>
                <p>
                    <strong>Name</strong>
                    <span>' . $name . '</span>
                </p>
                <p>
                    <strong>Email</strong>
                    <span>' . $email . '</span>
                </p>
                <p>
                    <strong>Mobile Number</strong>
                    <span>' . $phone . '</span>
                </p>
                <p>
                    <strong>Message</strong>
                    <span>' . $message . '</span>
                </p>

            </div>';
            ## Define subject for partner program
            if (isset($request->type) && $request->type == 'partner') {
                $subject = 'Visitors Query Through Partner Program - ' . config('app.name');
                $email_template = '

            <p><strong>Query Details</strong></p>

            <div>
                <p>
                    <strong>Name</strong>
                    <span>' . $name . '</span>
                </p>
                <p>
                    <strong>Email</strong>
                    <span>' . $email . '</span>
                </p>
                <p>
                    <strong>Mobile Number</strong>
                    <span>' . $phone . '</span>
                </p>
                <p>
                    <strong>Bbusiness Name</strong>
                    <span>' . $business_name . '</span>
                </p>
                 <p>
                    <strong>Message</strong>
                    <span>' . $message . '</span>
                </p>

            </div>';
            }

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= 'From: ' . $email_sender . "\r\n";

            if (mail($email_receiver, $subject, $email_template, $headers)) {
                Toastr::success('Email Sent Successfully', 'Success');
            } else {
                throw new \Exception("Email not sent");
            }
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
        }
        return redirect()->back();
    }

    public function claimForm()
    {
        return view('frontend.pages.claim_form');
    }

    public function partnerProgram()
    {
        return view('frontend.pages.partner_program');
    }

    public function mobilePhoneProtection()
    {
        return view('frontend.pages.mobile_phone_protection');
    }

    public function internationalTravelInsurance()
    {
        return view('frontend.pages.international_travel_insurance');
    }

    public function healthInsurance()
    {
        return view('frontend.pages.health_insurance');
    }
    public function lifeInsurance()
    {
        return view('frontend.pages.life_insurance');
    }
    public function agricultureInsurance()
    {
        return view('frontend.pages.agriculture_insurance');
    }
    public function carInsurance()
    {
        return view('frontend.pages.car_insurance');
    }
    public function homeInsurance()
    {
        return view('frontend.pages.home_insurance');
    }
    /**
     * Blogs
     * @return collection
     */
    public function blogs(Request $request)
    {
        $category_slug = $request->category;
        $type = 'blog';
        $posts = $this->get_posts($type, $category_slug);
        return view('frontend.pages.posts', compact('posts', 'type'));
    }
    public function insuranceType($type = null)
    {

        return config('database.connections.mysql.database');
    }
    /**
     * Blog details
     * @return single blog post
     */
    public function blog_details($slug)
    {
        $type = 'blog';
        $post = Blog::with('category')->where(['slug' => $slug, 'status' => true])->first();

        ## reload code

        session(['javascript' => true]);

        $posts = $this->get_posts($type);
        if ($post) {
            return view('frontend.pages.post_details', compact('post', 'posts', 'type'));
        } else {
            return view('frontend.404');
        }
    }
    /**
     * Blogs
     * @return collection
     */
    public function press_releases(Request $request)
    {
        $category_slug = $request->category;
        $type = 'press';
        $posts = $this->get_posts($type, $category_slug);
        return view('frontend.pages.posts', compact('posts', 'type'));
    }
    /**
     * Blog details
     * @return single blog post
     */
    public function press_release_details($slug)
    {
        $type = 'press';
        $post = Blog::with('category')->where('slug', $slug)->first();
        $posts = $this->get_posts('press');
        if ($post) {
            return view('frontend.pages.post_details', compact('post', 'posts', 'type'));
        } else {
            return view('frontend.404');
        }
    }

    /**
     * Get all post depending on type
     * @return collection
     */
    private function get_posts($type = 'blog', $category_slug = 0)
    {
        $per_page = 4;
        $posts = Blog::with('category')->where(['type' => $type, 'status' => true])->orderBy('id', 'desc')->paginate($per_page);

        $category = BlogCategory::where('slug', $category_slug)->first();
        if ($category) {
            $posts = Blog::with('category')->where(['type' => $type, 'status' => true, 'blog_category_id' => $category->id])->orderBy('id', 'desc')->paginate($per_page);
        }


        return $posts;
    }
}
