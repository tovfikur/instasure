@extends('backend.layouts.master')
@section("title","Claim List")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Claim Request List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('childDealer.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Claim Request List</li>
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
                        <h3 class="card-title float-left">Claim Request List</h3>
                        <div class="float-right">
{{--                            <a href="{{route('childDealer.select-customer')}}">--}}
{{--                                <button class="btn btn-success">--}}
{{--                                    <i class="fa fa-plus-circle"></i>--}}
{{--                                    Create Sale--}}
{{--                                </button>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Service Center Name</th>
                                <th>Service Center Address</th>
                                <th>Device Name</th>
                                <th>Device Brand</th>
                                <th>Device Model</th>
                                <th>Claim For</th>
                                <th>Claim Note</th>
                                <th>Status Note</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($claimRequests as $key => $claimRequest)
                                @php
                                    $serviceCenter = \App\Model\ServiceCenterDetails::where('user_id',$claimRequest->sc_user_id)->first();
                                     $device_info = json_decode($claimRequest->deviceInsurance->device_info)
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{!empty($serviceCenter) ? $serviceCenter->service_center_name : "Instasure"}}</td>
                                    <td>{{! empty($serviceCenter) ? $serviceCenter->address : 'Instasure Address.'}}</td>
                                    <td>{{$device_info->device_name}}</td>
                                    <td>{{$device_info->brand_name}}</td>
                                    <td>{{$device_info->model_name}}</td>
                                    <td>{{$claimRequest->claim_type}}</td>
                                    <td>{{$claimRequest->claim_note}}</td>
                                    <td>{{$claimRequest->status_note}}</td>
                                    <td>
                                        @if($claimRequest->status == 'completed')
                                            <span class="bg bg-success">{{$claimRequest->status}}</span>
                                        @elseif($claimRequest->status == 'canceled')
                                            <span class="bg bg-danger">{{$claimRequest->status}}</span>
                                        @else
                                            <span class="bg bg-warning">{{$claimRequest->status}}</span>
                                        @endif
                                    </td>

                                    <td>{{dateTimeFormat($claimRequest->created_at)}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
{{--                                                <a class="bg-dark dropdown-item"--}}
{{--                                                   href="{{route('serviceCenter.insurance-claim-form',$claimRequest->device_insurance_id)}}">--}}
{{--                                                    <i class="fa fa-file-code-o text-danger"></i> Make Claim--}}
{{--                                                </a>--}}
                                                <a class="bg-dark dropdown-item" href="#"
                                                   onclick="StatusChange('{{$claimRequest->id}}')">
                                                    <i class="fa fa-stream text-info"></i> Status
                                                </a>
                                                <a class="bg-dark dropdown-item" href="#"
                                                   onclick="requestDetails('{{$claimRequest->id}}')">
                                                    <i class="fa fa-eye text-primary"></i> Details
                                                </a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="statusModel" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Status Manage</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('admin.claim-request-status-change')}}" method="post"
                              enctype="multipart/form">
                            @csrf
                            <input type="hidden" name="request_id" id="request_id" class="form-control">
                            <div class="form-group">
                                <label for="">Select Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="accept">Accept</option>
                                    <option value="canceled">Canceled</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""> Note</label>
                                <textarea class="form-control" name="status_note" id="status_note" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailsModel" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Request Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="" id="detailsContent"></div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        function StatusChange(id) {
            $('#request_id').val(id)
            $('#statusModel').modal('show');
        }

        function requestDetails(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax
            ({
                type: "get",
                url: "/admin/claim-requests/details/" + id,
                success: function (data) {
                    console.log(data.response)
                    $('#detailsModel').modal('show');
                    $('#detailsContent').html(`<ul class="list-group">
                              <li class="list-group-item">Customer Name: ${data.response.customer_name}</li>
                              <li class="list-group-item">Customer Phone: ${data.response.customer_phone}</li>
                              <li class="list-group-item">Device Name:  ${data.response.device_name}</li>
                              <li class="list-group-item">Device Brand: ${data.response.brand_name}</li>
                              <li class="list-group-item">Model Name: ${data.response.model_name}</li>
                              <li class="list-group-item">Device Price: ${data.response.device_price}</li>
                              <li class="list-group-item">Status: ${data.response.status}</li>
                              <li class="list-group-item">Pickup Status: ${data.response.pick_up_status}</li>
                              <li class="list-group-item">Status: ${data.response.status}</li>
                              <li class="list-group-item">Status Note: ${data.response.status_note}</li>
                              <li class="list-group-item">Claim Note: ${data.response.claim_note}</li>
                            </ul>`)
                }
            })


        }
    </script>
@endpush
