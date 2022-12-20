@php
$page_heading = 'Report - Device Insurance Sale';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        {{ $page_heading }}
                    </h5>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)">
                                <span class="badge badge-secondary">All</span>
                            </a>
                        </li>
                        <!-- /.breadcrumb-item -->

                    </ol>
                    <!-- /.breadcrumb -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <form class="needs-validation" method="post"
                            action="{{ route('admin.reports.device_insurance_sales_download') }}">
                            @csrf
                            @method('post')
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        value="{{ date('M/d/Y') }}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- /.col -->

                                <div class="col-md-4 mb-3">
                                    <label for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="Mark"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- /.col -->

                                <div class="col-md-4 mb-3">
                                    <label for="child_dealer_id">Sales Center</label>
                                    <select class="custom-select" id="child_dealer_id" name="child_dealer_id" required>
                                        <option selected value="0">All</option>
                                        @foreach ($deviceInsurance as $deviceInsuranceSingle)
                                            <option value="{{ $deviceInsuranceSingle->child_dealer_id }}">
                                                {{ ucwords($deviceInsuranceSingle->childDealer->com_org_inst_name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.form-row -->
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Filter</button>
                            </div>
                            <!-- /.form-group -->
                        </form>
                        <!-- /form -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@stop
@push('js')
    <script>
        $("#child_dealer_id").select2().select2('val', '0');
    </script>
@endpush
