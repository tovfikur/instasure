@php
$page_heading = 'Add New Insurance Types';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.insurance_types.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="{{ route('admin.insurance-types.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" title="Required">Name <sup class="text-danger">*</sup></label>
                                        <select class="form-control" name="name" id="name" required>
                                            <option value="Screen Protection">Screen Protection</option>
                                            <option value="Damage">Damage</option>
                                            <option value="Theft">Theft</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="device_subcategory_id" title="Required">Device Subcategory <sup
                                                class="text-danger">*</sup></label>
                                        <select class=" form-control demo-select2" name="device_subcategory_id"
                                            id="device_subcategory_id" required>
                                            @foreach ($deviceSubcategories as $deviceSubcategory)
                                                <option value="{{ $deviceSubcategory->id }}">
                                                    {{ ucfirst($deviceSubcategory->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="set_priority" title="Required">Set Priority <sup
                                                class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="set_priority" id="set_priority"
                                            value="{{ old('set_priority') ? old('set_priority') : $count }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="check_inc_type" title="Required">Check Inc Type <sup
                                                class="text-danger">*</sup></label>
                                        <select class=" form-control" name="check_inc_type" id="check_inc_type" required>
                                            <option value="1">True</option>
                                            <option value="0" selected>False</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
