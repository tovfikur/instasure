@php
$page_heading = 'Child Dealer List';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    @includeIf('backend.parent_dealer.child_dealers.breadcrumb', ['page_heading' => $page_heading])

    <section class="content">
        <div class="card card-info card-outline">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Logo</th>
                            <th>C.P.Name</th>
                            <th>C.P.Phone</th>
                            <th>Company</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($childDealers as $key => $childDealer)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset('uploads/dealer-logo/photo/' . $childDealer->logo) }}" width="30"
                                        height="20" alt=""></td>
                                <td>{{ $childDealer->contact_person_name }}</td>
                                <td>{{ $childDealer->contact_person_phone }}</td>
                                <td>{{ $childDealer->com_org_inst_name }}</td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="bg-dark dropdown-item"
                                                href="{{ route('parentDealer.child-dealers.show', $childDealer->id) }}">
                                                <i class="fa fa-eye text-success"></i> Details
                                            </a>
                                            <a class="bg-dark dropdown-item"
                                                href="{{ route('parentDealer.child-dealers.edit', $childDealer->id) }}">
                                                <i class="fa fa-edit text-info"></i> Edit
                                            </a>
                                            {{-- <a class="bg-dark dropdown-item" href="#"> --}}
                                            {{-- <i class="fa fa-users text-warning"></i> My Sub Dealers --}}
                                            {{-- </a> --}}

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
        <!-- /.card -->
    </section>
    <!-- /.content -->

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

        //sweet alert
        function deleteCategory(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
