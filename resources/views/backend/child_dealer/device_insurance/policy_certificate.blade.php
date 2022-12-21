<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Policy Certificate</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

    <style>
    th {
        font-weight: bold;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px
    }

    .footer {
        display: flex;
        flex-direction: column;
        color: #555;
        font-size: 14px;
        background: #dddddd;
        padding: 10px;

    }

    /* added by Tovfikur 21/12/22 */
    .signature_box {
        height: 20px;
        border-bottom: 2px solid #020202;
    }

    .signature_text {
        text-align: center;
    }

    .demo {
        border: 2px solid #000;
        border-collapse: collapse;
        padding: 5px;
        margin: 50px;
    }

    .demo th {
        border: 2px solid #000;
        padding: 5px;
        background: #F0F0F0;
    }

    .demo td {
        border: 2px solid #000;
        padding: 5px;
    }

    .condition {
        display: flex;
        flex-direction: column;
    }
    /* End Tovfikur  */
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section style="padding: 20px 80px 80px 80px">
            <div class="logo">
                <img src="{{ asset('frontend/logo-instasure-2.png') }}" alt="logo">
            </div>
            <h2 class="text-center" style="text-transform: uppercase">Policy Certificate</h2>
            <p class="text-center"><b>POLICY ID: {{ $deviceInsurance->policy_number }}</b></p>

            @php
            $device_info = json_decode($deviceInsurance->device_info);
            $customer_info = json_decode($deviceInsurance->customer_info);
            @endphp
            <!-- Device Info -->
            <table class="table table-bordered" style="margin-top: 50px;">
                <tbody>
                    <tr class="text-center">
                        <td width="25%">
                            <h6>
                                <strong>
                                    {{ strtoupper($customer_info->inc_exc_type) }}
                                </strong>
                            </h6>
                            {{ $customer_info->number }}
                        </td>
                        <td width="20%">
                            <h6><strong>Activation Date</strong></h6>
                            {{ date_format_custom($deviceInsurance->created_at, ' F d, Y') }}
                        </td>
                        <td width="20%">
                            <h6><strong>Valid Upto</strong></h6>
                            {{ dateFormat(insExpireDate($deviceInsurance)) }}
                        </td>
                        <td width="35%">
                            <h6><strong>Cooling Period</strong></h6>
                            {{ dateFormat(claimWillActiveDate($deviceInsurance)) }}
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td>
                            <h6><strong>Customer Name</strong></h6>
                            {{ $customer_info->name }}

                        </td>
                        <td>
                            <h6><strong>Phone</strong></h6>
                            {{ $customer_info->customer_phone }}

                        </td>
                        <td>
                            <h6><strong>Brand Name</strong></h6>
                            {{ $device_info->brand_name }}

                        </td>
                        <td>
                            <h6><strong>Model Name</strong></h6>
                            {{ $device_info->model_name }}
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td>
                            <h6><strong>IMEI Number</strong></h6>
                            {{ $device_info->imei_one }}

                        </td>
                        <td>
                            <h6><strong>Insured Amount</strong></h6>
                            {{ $device_info->device_price }}
                            {{ config('settings.currency') }}

                        </td>
                        <td>
                            <h6><strong>Paid</strong></h6>
                            {{ $deviceInsurance->grand_total }}
                            {{ config('settings.currency') }}

                        </td>
                        <td>
                            <h6><strong>Insurance Type</strong></h6>
                            @php
                            $insurance_types = json_decode($deviceInsurance->insurance_type_value);
                            $insurance_infos = array_map(function ($item) {
                            if (strtolower($item->parts_type) == 'lost') {
                            $item->parts_type = 'Theft';
                            }
                            return $item->parts_type;
                            }, $insurance_types);
                            echo implode(', ', $insurance_infos);
                            @endphp
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- End: Device Info -->

            @if($parentDealer->terms_and_condition == 1)
            <div class='row' style="text-align: justify;">
                <h1 class='col-12' style="text-align:center; padding: 4rem;">
                    Terms and Conditions
                </h1>
                <div class="col-12 condition">
                    <p>
                        <b>কি কি শর্ত জানা দরকার?</b><br>
                        <b>যে কোনো ইনসুয়ারেল এর জন্যঃ</b> ৩০ দিনের কুলিং পিরিয়ড আছে, যার মানে আপনি সুরক্ষা কেনার প্রথম
                        ৩০
                        দিনের মধ্যে কোনো দাবি করতে পারবেন না সেবা নিতে অবশ্যই Original NID এবং যে Sim Card দিয়ে
                        রেজিট্রেশন করেছেন সেই Sim Card টি সংগে আনবেন। ৩০ দিনের পর কোনো দাবি পেশ করলে, সার্ভিস সেন্টার এর
                        যা বিল হবে তার উপরে স্ক্রীন সুরক্ষা র ক্ষেত্রে ১০% টাকা আপনাকে দিতে হবে। বাকি ৯০% টাকা সার্ভিস
                        সেন্টার InstaSure থেকে নিয়ে নিবে। ফোন নষ্ট হইলে আপনাকে দিতে হবে ২০% টাকা আর বাকি ৮০% টাকা দিবে
                        instasure ।  ক্রয়ের তারিখ থেকে ৩৬৫ দিনের মেয়াদ থাকবে সর্বোচ্চ দাবির মান আপনার হ্যান্ডসেট
                        মূল্যের সমান। আপনি একাধিকবার দাবি করতে পারেন যতক্ষণ না সেই মানটি অতিক্রম করা হয়। ক্রিন সুরক্ষা
                        বা ক্ষতি দাবি করার জন্য আপনাকে ব্রান্ড পরিষেবা কেন্দ্রে যেতে হবে, অথবা আমাদের সাথে যোগাযোগ করতে
                        হবে।
                        <br>
                        <br>
                        যদি কাছাকাছি কোনো সার্ভিস সেন্টার না থাকে, তাইলে আপনি ফোন টি আপনার কাছের আমাদের লজিস্টিকস
                        পার্টনার এর কালেকশন সেন্টার এ জমা দিতে হবে।  আমরা ফোন টি ঢাকায় আমাদের সার্ভিস সেন্টার এ পরীক্ষা
                        করে ঠিক করতে কত টাকা লাগবে তা আপনাকে জানাবো।  স্ক্রিন এর সমস্যা হইলে ১০% বা নষ্ট হইলে টোটাল
                        খরচের ২০% আমাদের কে  বিকাশ করলে , আমরা ফোন টি ঠিক করে আবার একই কালেকশন সেন্টার এ পাঠিয়ে দিবো। 
                        আপনি ওখান থেকে ফোন টি সংগ্রহ করে নিবেন।  এই ক্ষেত্রে সর্বোচ্চ ৭ দিন লাগতে পারে যদি সব পার্টস
                        পাওয়া যায়।
                        <br>
                        <br>
                        <b>সেট চুরি হলেঃ</b> আপনাকে আপনার আাকাউন্ট থেকে বা পরিষেবা কেন্দ্রের মাধ্যমে আমাদের প্লাটফর্মে
                        এফআইআর
                        কপি, সিম প্রতিস্থাপন কপি, এনআইডি কপি এবং মোবাইল ফোন কেনার রসিদ আপলোড করতে হবে। এছাড়াও আপনাকে
                        মূল এফআইআর কপি এবং বাকি ফটোকপি কুরিয়ারের মাধ্যমে InstaSure অফিসে পাঠাতে হবে। সাধারণ দাবি
                        নিস্পত্তির সময় হল ১৫ কার্যদিবস৷ দাবি অনুমোদিত হলে, নিম্নরূপ অবমুল্যায়িত মানের উপর ভিত্তি করে
                        আপনার আকাউন্টে ব্যাংক ট্রান্সফারের মাধ্যমে পেমেন্ট পাবেন।

                    </p>
                    <table class="demo">
                        <thead>
                            <tr>
                                <th>বীমা ক্রয়ের দিন থেকে বীমাকৃত ডিভাইসের বয়স</th>
                                <th>অবমূল্যায়িত মূল্য</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>০ থেকে ৩০ দিন</td>
                                <td>প্রথম ৩০ দিন সেবা পাওয়ার যোগ্য নয়</td>
                            </tr>
                            <tr>
                                <td>৩১ থেকে ৯০ দিন</td>
                                <td>বীমাকৃত মূল্যের ৯০%</td>
                            </tr>
                            <tr>
                                <td>৯১ থেকে ১৮০ দিন</td>
                                <td>বীমাকৃত মূল্যের ৮০%</td>
                            </tr>
                            <tr>
                                <td>১৮১ থেকে ২৭০ দিন</td>
                                <td>বীমাকৃত মূল্যের ৭০%</td>
                            </tr>
                            <tr>
                                <td>২৭১ থেকে ৩৬৫ দিন</td>
                                <td>বীমাকৃত মূল্যের ৬০%</td>
                            </tr>
                        <tbody>
                    </table>
                    <p>

                        আমি কোথায় সাহায্য পেতে পারি বা InstaSure সম্পর্কে আরও জানতে পারি?
                        আপনি অফিসের সময় আমাদের কল করতে পারেন +৮৮০ ৯৬০৬ ২৫ ২৫ ২৫ অথবা আমাদের ফেসবুক পেজ এ নক করতে পারেন
                        অথবা আমাদের ওয়েবসাইট দেখুনঃ www.instasure.xyz বা আমাদের ইমেইল করুনঃ hello@instasure.xyz

                    </p>
                </div>
                <div class='col-3 col-md-3 col-sm-6 row' style="padding: 5.5rem;">
                    <div class='col-12 signature_box'></div><br>
                    <div class='col-12 signature_text'>Customer Signature</div>
                </div>
            </div>

            @endif


            <div class="footer">
                <p>
                    To verify informations of this certificate, please contact +880960-6252525,
                    2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh
                </p>

                <p>
                    Buying this insurance I confirm that I have read and agreed to the Terms and conditions
                    available at - https://instasure.xyz/terms-and-condition
                </p>

            </div>
            <!-- /.footer -->
            <p style="font-size: 9px; color: #707070; margin-top: 5px;">
                This document is computer generated and does not require the signature or
                the Company's stamp in order to be considered valid.

            </p>

        </section>
        <!-- /.content -->

    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
    window.addEventListener("load", window.print());
    </script>
</body>

</html>