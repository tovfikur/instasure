@extends('backend.layouts.master')
@section('title', 'Add Part')
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.parts.breadcrumb', ['page_heading' => 'Upload Parts'])
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data" class="mt-2" id="parts_upload_form"
                        action="{{ route('admin.parts.upload_excel.post') }}">
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
    </section>

@stop
@push('js')
@endpush
