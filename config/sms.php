<?php

return [

    'SMS_API_URL' => env('SMS_API_URL', 'http://smsc.dsl.com.bd/smsapi'),
    'SMS_API_KEY' => env('SMS_API_KEY', 'C200113762652a5391f3f1.74072766'),
    'SMS_API_SENDER_ID' => env('SMS_API_SENDER_ID', '8809601001861'),
    "CUSTOMER_REGISTRATION_OTP_SMS" => env("CUSTOMER_REGISTRATION_OTP_SMS", " - ইনস্টাশিওর ও.টি.পি"),
    "CUSTOMER_REGISTRATION_CONFIRMATION_SMS" => "আপনার  একাউন্ট ভেরিফিকেশন সম্পন্ন হয়েছে - ইনস্টাশিওর",
    "SMS_API_CLAIM_ACCEPTED" => "আপনার ইন্সুরেন্স ক্লেইম গ্রহণ করা হয়েছে - ইনস্টাশিওর",
    "SMS_API_CLAIM_UPDATED" => "আপনার ইন্সুরেন্স ক্লেইম সংশোধন করা হয়েছে - ইনস্টাশিওর",
    "SMS_API_CLAIM_PROCESSING" => "আপনার ডিভাইজ টি সংস্কার করা হচ্ছে - ইনস্টাশিওর",
    "SMS_API_CLAIM_REPAIRED" => "আপনার ডিভাইজ টি সংস্কার করা হয়েছে - ইনস্টাশিওর",
    "SMS_API_CLAIM_READY_TO_DELIVER" => "আপনার ডিভাইজ টি ডেলিভারী করার জন্য আমরা প্রস্তুত। আসার পূর্বে আমাদের সাথে যোগাযোগ করে আসুন - ইনস্টাশিওর",
    "SMS_API_CLAIM_DELIVERED" => "আমাদের সাথে থাকার জন্য ধন্যবাদ - ইনস্টাশিওর",
    "SMS_API_CLAIM_CANCELED" => "আপনার ইন্সুরেন্স ক্লেইম বাতিল করা হয়েছে - ইনস্টাশিওর",
    "SMS_API_FAILED" => "আমাদের সাথে থাকার জন্য ধন্যবাদ - ইনস্টাশিওর",
    "CUSTOMER_REGISTERED_MAIL_SUBJECT" => "Instasure account",
    "CUSTOMER_DEVICE_INSURANCE_MAIL_SUBJECT" => "Instasure Policy Certificate",
    "SMS_TRAVEL_INSURANCE_ORDER_PROCESSING" => env("SMS_TRAVEL_INSURANCE_ORDER_PROCESSING", "আপনার ট্রাভেল ইন্স্যুরেন্স অর্ডারটি প্রসেসিং এ আছে - ইনস্টাশিওর")

];
