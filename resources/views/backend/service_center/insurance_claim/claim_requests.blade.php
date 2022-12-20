@php
$page_heading = 'Device Support Request List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <!-- Breadcrumb -->
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
                            <a href="{{ route('serviceCenter.policy-search') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Make Claim
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('serviceCenter.claim-requests') }}" class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                List
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

    <!-- End: Breadcrumb -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#Id</th>
                                    <th>Customer Name</th>
                                    <th>Device Name</th>
                                    <th>Device Brand</th>
                                    <th>Device Model</th>
                                    <th>Price</th>
                                    <th>Claim Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $key => $request)
                                    @php
                                        $device_info = json_decode($request->deviceInsurance->device_info);
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $device_info->device_name }}</td>
                                        <td>{{ $device_info->brand_name }}</td>
                                        <td>{{ $device_info->model_name }}</td>
                                        <td>{{ $device_info->device_price }}</td>
                                        <td>{{ $request->claim_type }}</td>
                                        <td>{{ $request->status }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="bg-dark dropdown-item"
                                                        href="{{ route('serviceCenter.insurance-claim-form', $request->device_insurance_id) }}">
                                                        <i class="fa fa-file-code-o text-danger"></i> Make Claim
                                                    </a>
                                                    <a class="bg-dark dropdown-item" href="#"
                                                        onclick="StatusChange('{{ $request->id }}')">
                                                        <i class="fa fa-stream text-info"></i> Status
                                                    </a>
                                                    <a class="bg-dark dropdown-item" href="#"
                                                        onclick="requestDetails('{{ $request->id }}')">
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
                        <form action="{{ route('serviceCenter.claim-request-status-change') }}" method="post"
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
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

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
            $.ajax({
                type: "get",
                url: "/serviceCenter/claim-requests/details/" + id,
                success: function(data) {
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
