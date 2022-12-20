<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Claim Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> --}}
    <style>
        th {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="" style="margin: 0 auto; padding: 10px 5%">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <h3 class="text-center" style="text-transform: uppercase">Claim Invoice</h3>
                        {{-- <img src="{{asset('frontend/logo.png')}}" width="154px"> --}}
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row">

                <div class="col-md-12" style="background-color: #f3f3f3; padding:10px">
                    <div class="invoice-col " style="width: 33%; float: left;">
                        <b> Company Info</b>
                        <address>
                            <strong>Instasure</strong><br>
                            <b>Address :</b> House#67 (1st Floor), Road#17, Block# C, Banani, Dhaka-1213<br>
                            <b>Phone :</b> 02-9820580-1<br>
                            <b>Cell-Phone :</b> 01915828248<br>
                            <b>Email :</b> info@instasure.com<br>
                        </address>
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <!-- /.col -->
                    <div class="" style="width: 33%; float: left;padding-left: 15px;">
                        <b> Service Center Info</b>

                        <address>
                            <b>Name:</b> {{ $serviceCenter->service_center_name }}<br>
                            <b>Phone:</b> {{ $serviceCenter->contact_person_phone }}<br>
                            <b>Email:</b> {{ $serviceCenter->contact_person_email }}<br>
                            <b>Address:</b> {{ $serviceCenter->address }}<br>
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="" style="width: 30%; float: left; padding-left: 15px;">
                        <b>Invoice Number: </b> {{ $deviceClaim->claim_id }}<br>
                        <b>Date:</b> {{ dateTimeFormat($deviceClaim->created_at) }}<br>
                    </div>
                    <!-- /.col -->
                </div>
            </div>

            <!-- /.row -->

            <!-- Table row -->
            <div class="row" style="margin-top:5%;">
                <div class="col-md-12 table-responsive">
                    <p class="pb-0 mb-0 bg-secondary pl-2">Customer Information</p>
                    <table class="table table-bordered">
                        <thead>
                            @php
                                $customer_info = json_decode($deviceInsurance->customer_info);
                            @endphp
                            <tr style="">
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                                <th>{{ $customer_info->inc_exc_type == 'nid' ? 'Customer NID Number' : 'Customer Passport Number' }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $customer_info->customer_name }}</td>
                                <td>{{ $customer_info->customer_phone }}</td>
                                <td>{{ $customer_info->customer_email }}</td>
                                <td>{{ $customer_info->number }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-secondary">Device Information</p>
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Device Name</th>
                                <th>Device Brand</th>
                                <th>Device Model</th>
                                <th>Device Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $device_info = json_decode($deviceInsurance->device_info);
                            @endphp
                            <tr>
                                <td>{{ $device_info->brand_name . ' ' . $device_info->brand_name }}</td>
                                <td>{{ $device_info->brand_name }}</td>
                                <td>{{ $device_info->model_name }}</td>
                                <td>
                                    {{ $device_info->device_price }}
                                    {{ config('settings.currency') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-secondary">Insurance Price Information</p>
                    <table class="table table-bordered" id="">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    Policy Number
                                </th>
                                <th class="text-center">
                                    Status
                                </th>
                                <th class="text-center">
                                    Note
                                </th>
                                <th class="text-center">
                                    Payment Status
                                </th>

                                <th class="text-center">
                                    Payment Details.
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $deviceInsurance->policy_number }}</td>
                                <td>{{ $deviceClaim->status }}</td>
                                <td>{{ $deviceClaim->status_note }}</td>
                                <td>{{ $deviceClaim->payment_status }}</td>
                                <td>{{ $deviceClaim->payment_details }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr style="">
                                <th>Claim For</th>
                                <th>Paid Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $insurance_infos = json_decode($deviceInsurance->insurance_type_value);
                            @endphp

                            <tr>
                                <td>{{ $deviceClaim->claim_on }}</td>
                                <td>
                                    {{ $deviceClaim->user_will_pay }}
                                    {{ config('settings.currency') }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
