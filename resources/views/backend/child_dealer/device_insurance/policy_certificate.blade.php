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
