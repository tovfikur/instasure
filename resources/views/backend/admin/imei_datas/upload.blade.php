@extends('backend.layouts.master')
@section('title', 'Upload IMEI Data')
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.imei_datas.breadcrumb', ['page_heading' => 'Upload IMEI Data'])

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <!-- form start -->
                            <form method="post" enctype="multipart/form-data" class="mt-2" id="parts_upload_form"
                                action="{{ route('admin.imei_data.upload_process') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 offset-md-2">

                                            <div class="form-group row">
                                                <label for="name" class="form-label">Upload File:</label>

                                                <input type="file" class="form-control" id="file" name="file"
                                                    placeholder="Choose SVG File" required />

                                                <small id="upload_help_block" class="form-text text-muted">
                                                    File required and must be a valid excel file
                                                </small>

                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#more_field').append(`<div class="row" id="row_${i}"><div class="col-md-5">
                                    <div class="form-group">
                                        <label for="imei_1">IMEI 1</label>
                                        <input type="text" class="form-control" name="imei_1[]" placeholder="Enter IMEI 1" required>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="imei_2">IMEI 2</label>
                                        <input type="text" class="form-control" name="imei_2[]" placeholder="Enter IMEI 2" required>
                                    </div>
                                </div>
                                <div class="col-md-1" style="margin-top: 40px">
                                    <i id="${i}" class="text-danger fa fa-minus-circle remove"></i>
                                </div></div>`);
            });
            $(document).on('click', '.remove', function() {
                var button_id = $(this).attr("id");
                $('#row_' + button_id + '').remove();
            });
        });
    </script>
@endpush
