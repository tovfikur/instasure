<?php

use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\HomeController@index')->name('index');
Route::get('/insurance/details/{slug}', 'Frontend\HomeController@insuranceDetails')->name('insurance.details');
Route::get('/about-us', 'Frontend\HomeController@about')->name('about');
Route::get('/partner-program', 'Frontend\HomeController@partnerProgram')->name('partner-program');
Route::get('/mobile-phone-protection', 'Frontend\HomeController@mobilePhoneProtection')->name('mobile-phone-protection');
Route::get('/health-insurance', 'Frontend\HomeController@healthInsurance')->name('health-insurance');
Route::get('/life-insurance', 'Frontend\HomeController@lifeInsurance')->name('life-insurance');
Route::get('/agriculture-insurance', 'Frontend\HomeController@agricultureInsurance')->name('agriculture-insurance');
Route::get('/car-insurance', 'Frontend\HomeController@carInsurance')->name('car-insurance');
Route::get('/home-insurance', 'Frontend\HomeController@homeInsurance')->name('home-insurance');
Route::get('/international-travel-insurance', 'Frontend\HomeController@internationalTravelInsurance')->name('international-travel-insurance');
Route::get('/fag', 'Frontend\HomeController@fag')->name('faq');
Route::get('/privacy-policy', 'Frontend\HomeController@privacyPolicy')->name('privacy-policy');
Route::get('/terms-and-condition', 'Frontend\HomeController@termsAndCondition')->name('terms-and-condition');
Route::get('/contact-us', 'Frontend\HomeController@contactUs')->name('contact-us');
Route::post('/contact-us', 'Frontend\HomeController@contact_us_send_email')->name('contact_us_send_email');
Route::get('/claim-form', 'Frontend\HomeController@claimForm')->name('claim-form');
Route::get('/login', 'Frontend\AuthController@login')->name('login');
Route::get('/dealer/register', 'ParentDealer\AuthController@register');
Route::post('/dealer/register/store', 'ParentDealer\AuthController@regDataStore')->name('dealer.register.store');
Route::get('/dashboard', 'Frontend\HomeController@dashboard')->name('user.dashboard');
Route::get('/profile', 'Frontend\HomeController@profile')->name('user.profile');
Route::post('/profile-update', 'Frontend\HomeController@profileUpdate')->name('user.profile-update');
Route::get('/insurance/claim/history', 'Frontend\HomeController@insuranceClaimHistory')->name('user.insuranceClaimHistory');
Route::get('/insurance/{type?}', 'Frontend\HomeController@insuranceType')->name('user.insuranceType');
Route::get('/insurance/purchase/history', 'Frontend\HomeController@insurancePurchaseHistory')->name('user.insurance.purchase.history');
Route::get('/insurance/purchase/details/{id}', 'Frontend\HomeController@insurancePurchaseDetails')->name('user.insurance.purchase.details');
Route::get('/delete-unpaid-travel-insurance/{id}', 'Frontend\HomeController@delete_unpaid_travel_insurance')->name('user.delete_unpaid_travel_insurance');



Route::get('/otp-verification', 'Frontend\HomeController@otpVerification');
Route::post('/registration', 'Frontend\AuthController@register')->name('user.register');
Route::get('/get-verification-code/{id}', 'Frontend\VerificationController@getVerificationCode')->name('get-verification-code');
Route::post('/get-verification-code-store', 'Frontend\VerificationController@verification')->name('get-verification-code.store');

Auth::routes();

Route::group(['middleware' => ['auth', 'user']], function () {
    Route::get('/dashboard', 'Frontend\HomeController@dashboard')->name('user.dashboard');

    Route::get('/medical/insurance/quotation', 'Frontend\HomeController@insuranceQuatationForm')->name('insurance.quotation.form');

    Route::post('/medical/insurance/quotation/calculation', 'Frontend\HomeController@insuranceQuatationCalculation')->name('insurance.quotation.calculation');

    Route::get('/medical/insurance/quotation/details/{id}', 'Frontend\HomeController@insuranceQuotationDetails')->name('insurance.quotation.details');
    Route::get('/medical/insurance/certificate/{id}', 'Frontend\HomeController@travelInsCertificate')->name('insurance.travel.certificate');


    Route::post('/get/insurance/provider/data', 'Frontend\HomeController@getProviderWithData')->name('insurance.provider.data');


    Route::get('/device-insurance/history', 'Frontend\DeviceInsuranceController@deviceInsuranceHistory')->name('user.device-insurance.history');
    Route::get('/device-insurance/details/{id}', 'Frontend\DeviceInsuranceController@deviceInsuranceDetails')->name('user.device-insurance.details');

    Route::post('/device-insurance-claim', 'Frontend\DeviceInsuranceController@deviceInsClaim')->name('user.device-insurance-claim');

    Route::get('/device-insurance-claim/details/{id}', 'Frontend\DeviceInsuranceController@deviceInsClaimDetails')->name('user.device-insurance-claim-details');
    Route::get('/device-insurance-claim/details/print/{id}', 'Frontend\DeviceInsuranceController@deviceInsClaimDetailsPrint')->name('user.device-insurance-claim-print');
    Route::get('/device-insurance-claim/details/download/{id}', 'Frontend\DeviceInsuranceController@deviceInsClaimDetailsDownload')->name('user.device-insurance-claim-download');

    Route::get('/service-center', 'Frontend\DeviceInsuranceController@getServiceCenter')->name('user.get-service-center');


    Route::post('/insurance-claim-request/store', 'Frontend\DeviceInsuranceController@insuranceClaimRequestStore')->name('user.insurance-claim-request.store');

    Route::get('/device-insurance/support-tickets', 'Frontend\DeviceInsuranceController@support_tickets')->name('user.device-insurance.claim-requests');
});
Route::post('/get-plan-category', 'Frontend\HomeController@getPlanCategory')->name('get-plan-category');
Route::get('/invoice/{id}', 'Frontend\InvoiceController@invoice')->name('invoice');
Route::get('policy-invoice/{id}', 'ChildDealer\DeviceInsuranceController@policyInvoice')->name('policy-invoice');

Route::get('policy-certificate/{id}', 'ChildDealer\DeviceInsuranceController@policyCertificate')->name('policy-certificate');

//Division/District/Upazila.....
Route::post('get_district_by_division', 'AddressController@getDistrict')->name('get_district_by_division');
Route::post('get_upazila_by_district', 'AddressController@getUpazila')->name('get_upazila_by_district');

//Next 2 route added by Tovfikur
Route::get('/pay/cash/{slug}', 'Frontend\PaymentController@PaywithCash')->name('pay.cash');
Route::post('/pay/cash/{slug}', 'Frontend\PaymentController@PaywithCashFormUpdate')->name('paynow.cash');

Route::post('/aamrpay/payment/', 'Frontend\PaymentController@payNow')->name('paynow.aamrpay');

Route::post('/aamarpay/success', 'Frontend\PaymentController@aamrPaySuccess')->name('aamrpay.success');

Route::post('/aamarpay/fail', 'Frontend\PaymentController@aamrPayFail')->name('aamrpay.fail');
Route::get('/aamarpay/cancel', 'Frontend\PaymentController@aamrPaycancel')->name('aamrpay.cancel');


### Blog Route ###
Route::get('/blogs', 'Frontend\HomeController@blogs')->name('blogs');
Route::get('/blogs/{slug}', 'Frontend\HomeController@blog_details')->name('blog.details');

### Press Release Routes ###
Route::get('/press-releases', 'Frontend\HomeController@press_releases')->name('press_releases');
Route::get('/press-releases/{slug}', 'Frontend\HomeController@press_release_details')->name('press_release.details');
