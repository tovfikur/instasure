@extends('backend.layouts.master')
@section("title","Travel Ins Order Details")
@push('css')
<style>
    table td{
        font-weight: bold;
    }
</style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Travel Ins Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-header">
                        <h3 class="card-title float-left">Travel Ins Order Details</h3>
                        <div class="float-right">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped dataTable">
                            <tbody>
                            <tr>
                                <th width="40%">Customer Name</th>
                                <td>{{$travelInsOrder->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Contact Person Name</th>
                                <td>{{$travelInsOrder->full_name}}</td>
                            </tr>
                            <tr>
                                <th>Contact Person Phone </th>
                                <td>{{$travelInsOrder->phone}}</td>
                            </tr>
                            <tr>
                                <th>Contact Person Age </th>
                                <td>{{$travelInsOrder->age}} Years</td>
                            </tr>
                            <tr>
                                <th>Travel Ins Title </th>
                                <td>{{$travelInsOrder->travel_insurance_category_title}}</td>
                            </tr>
                            <tr>
                                <th>Passport Number </th>
                                <td>{{$travelInsOrder->passport_number}}</td>
                            </tr>
                            <tr>
                                <th>Passport Expiry Date </th>
                                <td>{{date('j/m/Y',strtotime($travelInsOrder->passport_expire_till))}}</td>
                            </tr>
                            <tr>
                                <th>Flight Number</th>
                                <td>{{$travelInsOrder->flight_number}}</td>
                            </tr>
                            <tr>
                                <th>Flight Date</th>
                                <td>{{date('j/m/Y',strtotime($travelInsOrder->flight_date))}}</td>
                            </tr>
                            <tr>
                                <th>Return Date</th>
                                <td>{{date('j/m/Y',strtotime($travelInsOrder->return_date))}}</td>
                            </tr>
                            <tr>
                                <th>Total Day</th>
                                <td>{{$travelInsOrder->total_date}} Days</td>
                            </tr>
                            <tr>
                                <th>Insurance Price </th>
                                <td>{{number_format($travelInsOrder->ins_price, 2, '.', '')}}</td>
                            </tr>
                            <tr>
                                <th>Total Vat ({{$travelInsOrder->vat_percentage}})% </th>
                                <td>{{number_format($travelInsOrder->total_vat, 2, '.', '')}}</td>
                            </tr>
                            <tr>
                                <th>Total Service Charge ({{$travelInsOrder->service_amount}})% </th>
                                <td>{{number_format($travelInsOrder->service_total_amount, 2, '.', '')}}</td>
                            </tr>
                            <tr>
                                <th>Grand Total Ins price </th>
                                <td>{{number_format($travelInsOrder->grand_total, 2, '.', '')}}</td>
                            </tr>
                            <tr>
                                <th>Parent Dealer Commission </th>
                                <td>{{number_format($travelInsOrder->parent_dealer_commission, 2, '.', '')}}</td>
                            </tr>
                            <tr>
                                <th>Child Dealer Commission </th>
                                <td>{{number_format($travelInsOrder->child_dealer_commission, 2, '.', '')}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
