@extends('backend.layouts.master')
@section('title', 'Post List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        Post List
                    </h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mt-1">
                       

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Add New
                            </a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-info btn-sm">
                                <i class="fa fa-th-list mr-1"></i>
                                All
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">Id</th>
                                    <th width="25%">Post Title</th>
                                    <th width="15%">Author</th>
                                    <th width="10%">Approve</th>
                                    <th width="25%">Details</th>
                                    <th width="10%">Image</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucfirst($blog->title) }}</td>
                                        <td>{{ ucfirst($blog->author) }}</td>
                                        <td>
                                            <div class="form-group col-md-2">
                                                <label class="switch" style="margin-top:40px;">
                                                    <input onchange="update_status(this)" value="{{ $blog->id }}"
                                                        {{ $blog->status == 1 ? 'checked' : '' }} type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>

                                            <strong>Category:</strong> {{ ucwords($blog->category->name) }}
                                            <br>
                                            <strong>Post Type:</strong>
                                            {{ ucwords($blog->type) }}

                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/blogs/' . $blog->image) }}" width="80"
                                                height="40" alt="">
                                        </td>
                                        <td>
                                            <a class="btn btn-info waves-effect btn-sm"
                                                href="{{ route('admin.blogs.edit', $blog->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger waves-effect btn-sm" type="button"
                                                onclick="deleteBlog({{ $blog->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <form id="delete-form-{{ $blog->id }}"
                                                action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#Id</th>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th>Approve</th>
                                    <th>Details</th>
                                    <th>Image</th>
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
        function deleteBlog(id) {
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
        //update status
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('admin.blog.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    toastr.success('success', 'Blog Status updated successfully');
                } else {
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
