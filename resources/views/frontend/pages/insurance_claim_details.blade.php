@extends('frontend.layouts.app')
@section('title', 'Insurance Claim Details')
@push('css')
    <style>
        .single-pricing-box .pricing-header.bg2 {
            background-image: url(https://t4.ftcdn.net/jpg/01/19/11/55/360_F_119115529_mEnw3lGpLdlDkfLgRcVSbFRuVl6sMDty.jpg);
        }

        .ptb-100 {
            padding-top: 25px;
            padding-bottom: 100px;
        }

        .single-pricing-box {
            padding-bottom: 19px;
        }

        .single-pricing-box .pricing-header {
            background-color: #002e5b;
            border-radius: 5px 5px 0 0;
            position: relative;
            z-index: 1;
            overflow: hidden;
            padding-top: 25px;
            padding-bottom: 25px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @media only screen and (max-width: 767px) {
            .page-title-area {
                height: -14%;
                padding-top: 214px;
                padding-bottom: 32px;
            }
        }

        .src-image {
            display: none;
        }

        .card2 {
            overflow: hidden;
            position: relative;
            text-align: center;
            padding: 0;
            color: #fff;

        }

        .card2 .header-bg {
            /* This stretches the canvas across the entire hero unit */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            border-bottom: 1px #FFF solid;
            /* This positions the canvas under the text */
            z-index: 1;
        }

        .card2 .avatar {
            position: relative;
            z-index: 100;
        }

        .card2 .avatar img {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(0, 0, 30, 0.8);
        }

        #hoverMe {
            border-bottom: 1px dashed #e5e5e5;
            text-align: left;
            padding: 13px 20px 11px;
            font-size: 14px;
            font-weight: 600;
            color: #002e5b;

        }

        #hoverMe:hover {
            background-color: #ebebeb;
            color: #002e5b;
            border-left: 3px solid #002e5b;

        }

        .services-box .content {
            padding: 14px;
            border-radius: 0 0 5px 5px;
        }

        .services-box .content h3 {
            margin-bottom: 0px;
            position: relative;
            text-transform: uppercase;
            font-size: 18px;
            font-weight: 900;
        }

        .services-box {
            margin-bottom: 15px;
            border-radius: 5px;
            transition: 0.5s;
            background-color: #ffffff;
            box-shadow: 9.899px 9.899px 30px 0 rgb(0 0 0 / 10%);
        }
    </style>
@endpush
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Insurance Claim History</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>Insurance Claim History</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-20 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 ">
                    @include('frontend.partials.customer_dashboard_sidebar')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="wrapper" id="DivIdToPrint">
                        <!-- Main content -->
                        <section class="invoice">
                            <!-- info row -->
                            <div class="row invoice-info  pt-3">
                                <div class="col-sm-3 col-md-5 invoice-col">
                                    <strong> Company Info</strong>
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
                                <div class="col-sm- 4 col-md-4 invoice-col">
                                    <b> Service Center Info</b>

                                    <address>
                                        <b>Name:</b> {{ $serviceCenter->service_center_name }}<br>
                                        <b>Phone:</b> {{ $serviceCenter->contact_person_phone }}<br>
                                        <b>Email:</b> {{ $serviceCenter->contact_person_email }}<br>
                                        <b>Address:</b> {{ $serviceCenter->address }}<br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-md-3 invoice-col ">
                                    <b>Invoice Number: </b> {{ $deviceClaim->claim_id }}<br>
                                    <b>Date:</b> {{ dateTimeFormat($deviceClaim->created_at) }}<br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <p class="pl-3 pb-0 mb-0 bg-secondary text-white ">Customer Information</p>
                                    <table class="table table-bordered mt-3">
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
                                    <p class="pl-2 pb-0 mb-0 bg-secondary text-white">Device Information</p>
                                    <table class="table table-bordered mt-3">
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
                                                <td>{{ ucwords($device_info->brand_name . ' ' . $device_info->model_name) }}
                                                </td>
                                                <td>{{ $device_info->brand_name }}</td>
                                                <td>{{ $device_info->model_name }}</td>
                                                <td>৳{{ $device_info->device_price }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p class="pl-2 pb-0 mb-0 bg-secondary text-white">Insurance Price Information</p>
                                    <table class="table table-bordered" id="">
                                        <thead>
                                            <tr>
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
                                                <td>৳{{ $deviceClaim->user_will_pay }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                                <h5 class="text-muted">Damaged Images</h5>
                                @foreach ($deviceClaim->document_path as $document)
                                    <div class="col-md-3">

                                        <figure
                                            style="width: 100%;  height: 100px; margin-bottom:30px; display:flex; align-items:center; justify-content:center; background: #eee;">
                                            <img src="{{ $document }}" alt="climed_device_image"
                                                style="width: 100%; height:100%; object-fit:contain" />
                                        </figure>
                                    </div>
                                @endforeach

                            </div>
                            <!-- /.row -->
                        </section>
                        <!-- /.content -->
                    </div>
                    <a target="_blank" href="{{ route('user.device-insurance-claim-print', encrypt($deviceClaim->id)) }}"
                        class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                </div>
            </div>
            <!-- ./wrapper -->
        </div>
    </section>
    <!-- End Pricing Area -->
@stop
@push('js')
    <script>
        function printDiv() {
            var divToPrint = document.getElementById('DivIdToPrint');

            var newWin = window.open('', 'Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

            newWin.document.close();

            setTimeout(function() {
                newWin.close();
            }, 10);
            //$('#btn').hide();

        }
    </script>
@endpush
