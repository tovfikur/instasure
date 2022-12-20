@php
$page_heading = 'Insurance Types List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    @includeIf('backend.admin.insurance_types.breadcrumb', ['page_heading' => $page_heading])

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Device Subcategory Name</th>
                                    <th>Priority</th>
                                    <th>Check Ins Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insuranceTypes as $key => $insuranceType)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucfirst($insuranceType->name) }}</td>
                                        <td>{{ ucfirst($insuranceType->deviceSubcategory->name) }}</td>
                                        <td>{{ $insuranceType->set_priority }}</td>
                                        <td>{{ $insuranceType->check_inc_type }}</td>
                                        <td>

                                            <span title="Click to change status"
                                                class="badge  @if ($insuranceType->status) badge-success @else badge-danger @endif">
                                                <a class="text-light"
                                                    href="{{ route('admin.insurance-types.change_status', $insuranceType->id) }}">
                                                    @if ($insuranceType->status)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </a>
                                            </span>

                                        </td>
                                        <td>
                                            <a class="btn btn-info waves-effect"
                                                href="{{ route('admin.insurance-types.edit', $insuranceType->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
    </script>
@endpush
