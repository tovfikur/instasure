@extends('backend.layouts.master')
@section("title","Edit Device Category")
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1>Add Device Category</h1>--}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Device Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Edit Device Category</h3>
                        <div class="float-right">
                            <a href="{{route('admin.device-categories.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.device-categories.update',$deviceCategory->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$deviceCategory->name}}" required>
                            </div>
                            <div class="form-group">
                                <img src="{{asset('uploads/device_categories/'.$deviceCategory->icon)}}" width="50" height="50" alt=""><br>
                                <label for="icon">Icon <small>(size: 300 * 300 pixel)</small></label>
                                <input type="file" class="form-control" name="icon" id="logo" >
                            </div>
                            <div class="form-group">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$deviceCategory->meta_title}}">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control"  rows="3">{!! $deviceCategory->meta_description !!}</textarea>
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

@endpush
