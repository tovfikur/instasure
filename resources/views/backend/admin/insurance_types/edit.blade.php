@php
$page_heading = 'Edit Insurance Types';
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
                    <form role="form" action="{{ route('admin.insurance-types.update', $insuranceType->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <select class="form-control" name="name" id="name" required>
                                            <option value="Screen Protection"
                                                @if ($insuranceType->name == 'Screen Protection') selected @endif>Screen Protection</option>
                                            <option value="Damage" @if ($insuranceType->name == 'Damage') selected @endif>Damage
                                            </option>
                                            <option value="Theft" @if ($insuranceType->name == 'Theft') selected @endif>Theft
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="device_subcategory_id">Device Subcategory</label>
                                        <select class=" form-control demo-select2" name="device_subcategory_id"
                                            id="device_subcategory_id" required>
                                            @foreach ($deviceSubcategories as $deviceSubcategory)
                                                <option value="{{ $deviceSubcategory->id }}"
                                                    {{ $insuranceType->device_subcategory_id == $deviceSubcategory->id ? 'selected' : '' }}>
                                                    {{ ucfirst($deviceSubcategory->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="set_priority">Set Priority</label>
                                        <input type="text" class="form-control" name="set_priority" id="set_priority"
                                            value="{{ $insuranceType->set_priority }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="check_inc_type" title="Required">Check Inc Type <sup
                                                class="text-danger">*</sup></label>
                                        <select class=" form-control" name="check_inc_type" id="check_inc_type" required>
                                            <option value="1" @if ($insuranceType->check_inc_type == 1) selected @endif>True
                                            </option>
                                            <option value="0" @if ($insuranceType->check_inc_type == 0) selected @endif>False
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
