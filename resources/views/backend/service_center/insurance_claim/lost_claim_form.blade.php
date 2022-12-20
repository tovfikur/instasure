@extends('backend.layouts.master')
@section("title","Lost Claim Form")
@push('css')


@endpush
@section('content')
    @php
        $customerInfo = json_decode($insurance->customer_info);
        $deviceInfo = json_decode($insurance->device_info);
        $insTypeValue = json_decode($insurance->insurance_type_value)
    @endphp
{{--    {{userWillPay(3000)}}--}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Lost Claim Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Lost Claim Form</h3>
                        <div class="float-right">

                        </div>
                    </div>
                    <p class="pl-2 pb-0 mb-0 bg-info">Device Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th>Policy No.</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Available Service</th>
                            <th>Validity</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$insurance->policy_number}}</td>
                            <td>{{$deviceInfo->brand_name}}</td>
                            <td>{{$deviceInfo->model_name}}</td>
                            <td>
                                @foreach($insTypeValue as $data)
                                    @php
                                        $resultstr[] = $data->parts_type
                                    @endphp
                                @endforeach

                                {{implode(",",$resultstr)}}
                                @if ( $insTypeValue[0]->parts_type == "Screen Protection")
                                    <div>
                                        Screen Protection For: <span class="badge badge-primary">Two Times</span>
                                    </div>

                                @else
                                    @if ($insurance->protection_times_for != null)
                                        <div>
                                            Screen Protection <span
                                                class="badge badge-primary">{{ $insurance->protection_times_for}}</span>
                                        </div>
                                    @endif

                                @endif
                            </td>
                            <td>365</td>
                            <td>{{$deviceInfo->device_price}}.tk</td>

                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                        <tr style="background-color: #17a2b8!important">
                            <th class="text-center">
                                Protection Type
                            </th>
                            <th class="text-center">
                                Insurance Amount
                            </th>
                            <th class="text-center">
                                Insurance Type
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($insTypeValue as $key => $data)
                            <tr>
                                <td>
                                    {{$data->parts_type}}
                                    <input type="hidden" name="insuranceType_name[]" value="{{$data->parts_type}}">
                                </td>

                                <td>{{$data->price}}</td>
                                {{--                                <td>{{ucfirst($data->ins_type)}}</td>--}}

                                <td>
                                    {{ucfirst($data->ins_type)}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form id="form_id" role="form" action="{{route('serviceCenter.insurance-lost-claim-form.claimSubmit')}}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="device_insurance_id" value="{{$insurance->id}}">
                        <input type="hidden" name="device_value" value="{{$deviceInfo->device_price}}">
                        <input type="hidden" name="user_id" value="{{$insurance->user_id}}">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="full_name">Upload FIR Copy</label>
                                    <input type="file" class="form-control" name="document[]">
                                </div>
                                <div class="col-md-1" style="margin-top: 40px">
                                    <a class="btn btn-sm btn-info text-white" id="add"><i
                                            class=" fa fa-plus-circle"></i> Add More</a>
                                </div>
                            </div>
                            <div id="more_field"></div>
                            <div class="form-group mb-2">
                                <label for="claim_note" class="c-form-label text-bold">Claim Note</label>
                                <textarea name="claim_note" id="claim_note" class="form-control" rows="4"
                                          placeholder="ex: i lost my phone form there."></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success default-btn mt-4 w-25" >Submit</button>
                            </div>
                        </div>
                    </form>
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
    <script>
        $(document).ready(function () {
            var i = 1;
            var j = 1;
            $('#add').click(function () {
                i++;

                $('#more_field').append(`
                                <div class="row" id="row_${i}">
                                    <div class="form-group col-md-6">
                                        <label for="full_name">Upload FIR Copy</label>
                                        <input type="file" class="form-control" name="document[]">
                                    </div>
                                    <div class="col-md-1" style="margin-top: 40px;">
                                    <a class="btn btn-sm btn-danger text-white remove" id="${i}"><i class=" fa fa-minus-circle"></i> Cancel<a>
                                </div></div>`);
            });
            $(document).on('click', '.remove', function () {
                var button_id = $(this).attr("id");
                $('#row_' + button_id + '').remove();
            });
//parts area start...............


        });


    </script>
@endpush
