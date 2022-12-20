@extends('backend.layouts.master')
@section('title', 'Add New Post')
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        Add New Post
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.blogs.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title"
                                            placeholder="Enter Blog Title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                                    </div>


                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                    <div class="form-group">
                                        @if (count($blog_categories))
                                            <label for="category">Category</label>
                                            <select class="custom-select custom-select-md" name="category" id="category">
                                                <option selected disabled>Please select category</option>
                                                @foreach ($blog_categories as $category)
                                                    <option value="{{ $category->id }}">{{ ucwords($category->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Please create at least one category</strong>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Post Type</label>
                                        <select class="custom-select custom-select-md" name="type" id="type">
                                            <option value="blog" selected>Blog</option>
                                            <option value="press">Press Release</option>

                                        </select>

                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="active" name="status" class="custom-control-input" value="1"
                                            checked>
                                        <label class="custom-control-label" for="active">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="inactive" name="status" class="custom-control-input"
                                            value="0">
                                        <label class="custom-control-label" for="inactive">Inactive</label>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </form>
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
        CKEDITOR.replace('description');
    </script>
@endpush
