@php
$page_heading = 'Device Insurance Price History';
@endphp
@extends('backend.layouts.master')
@section('title', 'Device Insurance Price History')
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        {{ $page_heading }}
                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right mt-1">
                        <li class="breadcrumb-item">
                            <a href="{{ route('parentDealer.deviceInsSaleHistory') }}" class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                My Commission Log
                            </a>
                        </li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="row">
                <div class="col-12">

                    <p class="pl-2 pb-0 mb-0 bg-info">Customer Information</p>
                    @php
                        $customerInfo = json_decode($deviceOrderDetails->customer_info);
                        $deviceInfo = json_decode($deviceOrderDetails->device_info);
                        $insTypeValue = json_decode($deviceOrderDetails->insurance_type_value);
                    @endphp
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr style="">
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $customerInfo->customer_name }}</td>
                                <td>{{ $customerInfo->customer_phone }}</td>
                                <td>{{ $customerInfo->customer_email ? $customerInfo->customer_email : 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-info">Device Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>

                                <th>Device Brand</th>
                                <th>Device Model</th>
                                <th>Device Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $deviceInfo->brand_name }}</td>
                                <td>{{ $deviceInfo->model_name }}</td>
                                <td>{{ $deviceInfo->device_price }}.tk</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-info">Insurance Price Information</p>
                    <table class="table table-bordered mt-3 mb-0">
                        <thead>
                            <tr style="">
                                <th>Insurance Type</th>
                                <th>Price</th>
                                <th>Insurance Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($insTypeValue) --}}
                            @foreach ($insTypeValue as $key => $data)
                                <tr>
                                    <td>{{ $data->parts_type }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ ucfirst($data->ins_type) }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <table class="table table-bordered mt-0 pt-0">
                                <tr>

                                    <td>Sub Total Price</td>
                                    <td>{{ $deviceOrderDetails->sub_total }}.tk</td>

                                </tr>
                                <tr>
                                    <td>Total Vat</td>
                                    <td>{{ $deviceOrderDetails->total_vat }}.tk</td>
                                </tr>
                                <tr>

                                    <td>Total Price</td>
                                    <td>{{ $deviceOrderDetails->grand_total }}.tk</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        $(function() {
            $('#disbursed').click(function() {
                //alert($(this).val());
                // $("#child").empty();
                $(document).ajaxSend(function() {
                    $("#overlay").fadeIn(300);
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "get",
                    url: "/childDealer/device-insurance/disbursed/now/{{ encrypt($deviceOrderDetails->id) }}",
                    success: function(data) {
                        if (data.response == 1) {
                            toastr.success('Commission Successfully Disbursed!', 'Success')
                            $('#disbursedDiv').empty();
                            $('#disbursedDiv').html(
                                `<h3 class="badge badge-success">Disbursed Completed</h3>`);
                        } else {
                            toastr.error('Something went wrong!', 'Error')
                        }
                        console.log(data.response);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $("#overlay").fadeOut(300);
                    }, 500);
                });
            });
        });
    </script>
@endpush
