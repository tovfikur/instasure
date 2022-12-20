@php
$page_heading = 'Edit Insurance Category';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.categories.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="row">
                <div class="col-8 offset-2">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.categories.update', $category->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $category->name }}" required>
                            </div>
                            <img src="{{ asset('uploads/categories/' . $category->icon) }}" width="80" height="50" alt="">
                            <div class="form-group">
                                <label for="email">Brand Logo <small>(size: 120 * 80 pixel)</small></label>
                                <input type="file" class="form-control" name="icon" id="logo">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title"
                                    value="{{ $category->meta_title }}">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description</label>
                                <textarea name="meta_description" id="meta_desc" class="form-control"
                                    rows="3">{{ $category->meta_description }}</textarea>
                            </div>



                            <!-- This section Developed by Tovfikur -->

                            <!-- start -->
                            <div class="form-group">
                                <div class="row">
                                <div class="col">
                                    <label for="vat">Vat</label>
                                    <input type="number" class="form-control" name="vat" id="vat"
                                    value="{{ $category->vat }}" placeholder="Enter vat for this category">
                                    </div>
                                    <div class="col-3">
                                    <label for="inputState">Vat type</label>
                                    <select name="vat_type" class="form-control" id="vat_type">
                                        <option value="1" selected>Percentage</option>
                                        <option value="0">Flat</option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                <div class="col">
                                    <label for="service">Service Charge</label>
                                    <input type="number" class="form-control" name="service" id="service"
                                    value="{{ $category->service }}" placeholder="Enter service charge for this category">
                                    </div>
                                    <div class="col-3">
                                    <label for="service_type">Service Charge type</label>
                                    <select name="service_type" class="form-control" id="service_type">
                                        <option value="1" selected>Percentage</option>
                                        <option value="0">Flat</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end -->




                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('admin.ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
