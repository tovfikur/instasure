@extends('backend.layouts.master')
@section("title","Travel Ins Order List")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Travel Ins Order List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('childDealer.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Travel Ins Order List</li>
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
                        <h3 class="card-title float-left">Travel Ins Order Lists</h3>
                        <div class="float-right">
                            <a href="{{route('childDealer.select-customer')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Travel Plan Title</th>
                                <th>Insurance Price</th>
                                <th>Vat (%)</th>
                                <th>Service Charge (%)</th>
                                <th>Total Price</th>
                                <th>Total Day</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($travelOrders as $key => $travelOrder)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$travelOrder->full_name}}</td>
                                    <td>{{$travelOrder->phone}}</td>
                                    <td>{{$travelOrder->travel_insurance_category_title}}</td>
                                    <td>{{$travelOrder->ins_price}}</td>
                                    <td>{{$travelOrder->total_vat}}</td>
                                    <td>{{$travelOrder->service_total_amount}}</td>
                                    <td>{{$travelOrder->grand_total}}</td>
                                    <td>{{$travelOrder->total_date}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="bg-dark dropdown-item" href="{{route('childDealer.travel-ins-order.show',$travelOrder->id)}}">
                                                    <i class="fa fa-eye text-success"></i> Details
                                                </a>
                                                <a class="bg-dark dropdown-item" href="{{route('childDealer.travel-ins-order.edit',$travelOrder->id)}}">
                                                    <i class="fa fa-edit text-info"></i> Edit
                                                </a>
                                                <a class="bg-dark dropdown-item" href="{{route('invoice',$travelOrder->id)}}">
                                                    <i class="fa fa-print text-primary"></i> Invoice
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Travel Plan Title</th>
                                <th>Insurance Price</th>
                                <th>Vat (%)</th>
                                <th>Service Charge (%)</th>
                                <th>Total Price</th>
                                <th>Total Day</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
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
