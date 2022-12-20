<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Travel Policy Certificate</title>
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
        }

        .footer img {
            width: 150px;
            border-bottom: 1px solid #555;
            padding-bottom: 12px;
        }

        .footer .authorization_text {
            font-weight: 700;
            text-transform: capitalize;
            font-size: 14px;
            margin-top: 50px;
        }

        .footer .footer_text {
            color: #555;
            font-size: 14px;
            text-align: left;
            background: #dddddd;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20%;
            padding: 20px;
        }

        .footer .footer_text .left {
            flex: 1 1 40%;
        }

        .footer .footer_text .right {
            flex: 1 1 40%;
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
            <p class="text-center"><b>ID: {{ $travelInsOrder->policy_number }}</b></p>


            <!-- Insurance details -->
            <table class="table table-bordered" style="margin-top: 50px;">
                <thead>
                    <tr>
                        <th>Insurance Number</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Date of Birth</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $travelInsOrder->policy_number }} </td>
                        <td>{{ ucwords($travelInsOrder->full_name) }} </td>
                        <td>{{ $travelInsOrder->phone }} </td>
                        <td>{{ $travelInsOrder->dob }} </td>

                    </tr>
                </tbody>
            </table>
            <!-- End: Insurance details -->


            <!-- Insurance details -->
            <table class="table table-bordered" style="margin-top: 50px;">
                <thead>
                    <tr>
                        <th>Flight Number</th>
                        <th>Total Days</th>
                        <th>Flight Date</th>
                        <th>Return Date</th>
                        <th>Paid Amoun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $travelInsOrder->flight_number }} </td>
                        <td>{{ $travelInsOrder->total_date }} </td>
                        <td>{{ date_format_custom($travelInsOrder->flight_date, ' F d, Y') }} </td>
                        <td>{{ date_format_custom($travelInsOrder->return_date, ' F d, Y') }} </td>
                        <td>{{ $travelInsOrder->grand_total }} {{ config('settings.currency') }}</td>

                    </tr>
                </tbody>
            </table>
            <!-- End: Insurance details -->

            <h3 style="font-size: 16px; padding: 17px 0;">
                Travel Type:
                <small>{{ ucwords($travelInsOrder->travel_insurance_category_title) }}</small>
            </h3>


            <div class="footer">
                <div class="footer_text">
                    <div class="left">
                        To verify informations of this certificate, please contact +880960-6252525
                        <address>
                            2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh
                        </address>
                    </div>
                    <div class="right">
                        Buying this insurance I confirm that I have read and agreed to the Terms and conditions
                        available at - https://instasure.xyz/terms-and-condition
                    </div>

                </div>
                <p style="font-size: 9px; color: #707070; margin-top: 5px;">
                    This document is computer generated and does not require the signature or
                    the Company's stamp in order to be considered valid.

                </p>
            </div>
            <!-- /.footer -->

        </section>
        <!-- /.content -->

    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
