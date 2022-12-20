<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
<style>
    th{
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <h3 class="text-center" style="text-decoration: underline; text-transform: uppercase">Invoice</h3>
                    {{--                    <img src="{{asset('frontend/logo.png')}}" width="154px">--}}
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info mt-5" style="background-color: #f3f3f3">
            <div class="col-sm-4 col-md-4 invoice-col m-3">
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
            <div class="col-sm-4 col-md-4 invoice-col m-3">
                <b> Contact Person Info</b>
                <address>
                    <b>Name:</b> {{$travelOrder->full_name}}<br>
                    <b>Phone:</b> {{$travelOrder->phone}}<br>
                    <b>Email:</b> {{$travelOrder->email}}<br>
                    <b>Age:</b> {{$travelOrder->age}}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-md-2 invoice-col m-3">
                <b>Invoice: {{$travelOrder->policy_number}}</b><br>
                <br>
                <b>Date:</b> {{date('j-m-Y',strtotime($travelOrder->created_at))}}<br>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row mt-5">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Passport Number</th>--}}
{{--                        <th>Flight Number</th>--}}
{{--                        <th>Insurance Amount</th>--}}
{{--                        <th>Total Vat</th>--}}
{{--                        <th>Total Service Charge</th>--}}
{{--                        <th>Grand Total</th>--}}
{{--                        <th>Dealer Commission</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
                    <tr>
                        <th width="60%">Travel Plan Name</th>
                        <td class="">
                            {{$travelOrder->travel_insurance_category_title}}
                        </td>
                    </tr>
                    <tr>
                        <th>Passport Number</th>
                        <td>
                            {{$travelOrder->passport_number}}
                        </td>
                    </tr>
                    <tr>
                        <th>Passport Expiry Date</th>
                        <td>
                            {{date('d-m-Y',strtotime($travelOrder->passport_expire_till))}}
                        </td>
                    </tr>

                    <tr>
                        <th>Flight Number</th>
                        <td>
                            {{$travelOrder->flight_number}}
                        </td>
                    </tr>

                    <tr>
                        <th>Flight Date</th>
                        <td>
                            {{date('d-m-Y',strtotime($travelOrder->flight_date))}}
                        </td>
                    </tr>
                    <tr>
                        <th>Return Date</th>
                        <td>
                            {{date('d-m-Y',strtotime($travelOrder->return_date))}}
                        </td>
                    </tr>
                    <tr>
                        <th>Total Stay</th>
                        <td>
                            {{$travelOrder->total_date}} Days
                        </td>
                    </tr>
                    <tr>
                        <th>Insurance Price</th>
                        <td>
                            ৳{{number_format($travelOrder->ins_price, 2, '.', '')}}
                        </td>
                    </tr>
                    <tr>
                        <th>Total Vat ({{$travelOrder->vat_percentage}})%</th>
                        <td>
                            ৳{{number_format($travelOrder->total_vat, 2, '.', '')}}
                        </td>
                    </tr>
                    <tr>
                        <th>Total Service Charge ({{$travelOrder->service_amount}})%</th>
                        <td>
                            ৳{{number_format($travelOrder->service_total_amount, 2, '.', '')}}
                        </td>
                    </tr>
                    <tr>
                        <th>In Total Insurance Amount</th>
                        <td>
                            ৳{{number_format($travelOrder->grand_total, 2, '.', '')}}
                        </td>
                    </tr>
                    @if(Auth::user()->user_type == 'child_dealer')
                    <tr>
                        <th>Dealer Commission</th>
                        <td>৳{{number_format($travelOrder->child_dealer_commission, 2, '.', '')}}</td>
                    </tr>
                    @endif

{{--                    </tbody>--}}
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">

            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>৳{{number_format($travelOrder->ins_price, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <th>VAT ({{$travelOrder->vat_percentage}})%:</th>
                            <td>৳{{number_format($travelOrder->total_vat, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <th>Service Charge ({{$travelOrder->service_amount}})%:</th>
                            <td>৳{{number_format($travelOrder->service_total_amount, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td>৳{{number_format($travelOrder->grand_total, 2, '.', '')}}</td>
                        </tr>
                    </table>
                </div>
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
