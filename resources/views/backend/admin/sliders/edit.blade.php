@php
$page_heading = 'Edit Sliders';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.admin.sliders.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="row">
                <div class="col-8 offset-2">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.sliders.update', $slider->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ $slider->title }}">
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" name="content" id="content">{!! $slider->content !!}</textarea>
                            </div>
                            <div class="form-group">
                                <img src="{{ asset('/' . $slider->image) }}" width="50" height="50"> <br>
                                <label for="image">Slider Image <small>(size: 1920 * 1080 pixel)</small></label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
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
