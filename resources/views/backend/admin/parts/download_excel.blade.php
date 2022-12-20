@extends('backend.layouts.master')
@section('title', 'Download Parts')
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.parts.breadcrumb', ['page_heading' => 'Download Parts'])
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <!-- form start -->
                    <form method="post" enctype="multipart/form-data" class="mt-2" id="parts_download_form"
                        action="{{ route('admin.parts.download_excel.post') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">

                                    <div class="form-group row">
                                        <label for="parts_name" class="col-sm-4 col-form-label">Parts Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="parts_name" id="parts_name"
                                                placeholder="Ex: camera" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->


                                    <div class="form-group row">
                                        <label for="parts_price" class="col-sm-4 col-form-label">Parts Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="parts_price" id="parts_price"
                                                placeholder="Ex: 3000" required>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <label for="brand_id" class="col-sm-4 col-form-label">Select Brand</label>
                                        <div class="col-sm-8">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="0" selected disabled>Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    @if ($brand->model_count)
                                                        <option value="{{ $brand->id }}">
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div id="brand_wise_model_list"></div>

                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <label for="parent_dealer_id" class="col-sm-4 col-form-label">Select Parent
                                            Dealer</label>
                                        <div class="col-sm-8">
                                            <select name="parent_dealer_id" id="parent_dealer_id" class="form-control">
                                                <option value="0" selected disabled>Select Parent Dealer</option>
                                                @foreach ($parent_dealers as $parentDealer)
                                                    <option value="{{ $parentDealer->id }}">
                                                        {{ $parentDealer->com_org_inst_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <label for="note" class="col-sm-4 col-form-label">Parts Note</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="note" id="note"
                                                placeholder="Ex: front camera">
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <div class="form-group row">
                                        <label for="save" class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-8">
                                            <button type="submit" class="btn btn-primary" id="save">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
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
