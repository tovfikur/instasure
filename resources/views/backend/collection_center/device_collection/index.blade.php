@php
$page_heading = 'Device Collection';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@section('content')
    @includeIf('backend.collection_center.device_collection.breadcrumb', ['page_heading' => $page_heading])
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-body table-responsive">
                        <table id="datatable_index" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Price</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Dealer</th>
                                    <th>Added On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                        </table>
                        <!-- /.table -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card-->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@stop
@push('js')
    <!-- Scripts on page -->
    @includeIf('backend.collection_center.device_collection.scripts')
@endpush
