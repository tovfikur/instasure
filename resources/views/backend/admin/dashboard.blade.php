@php
$page_heading = 'Dashboard - Admin';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@section('content')
    @includeIf('backend.admin.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-body table-responsive">
                    <div class="row">
                        @if ($parentDueBalance)
                            <div class="col-md-4 col-lg-3">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>
                                            {{ $parentDueBalance }}
                                            {{ config('settings.currency') }}
                                        </h3>
                                        <p>Parent Due Balance Total Pending</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        @endif
                        @if ($dueBalanceCollection)
                            <div class="col-md-4 col-lg-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>
                                            {{ $dueBalanceCollection }}
                                            {{ config('settings.currency') }}
                                        </h3>
                                        <p>Parent Due Balance Total Collection </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        @endif
                        @if (isset($counts) && count($counts))
                            @foreach ($counts as $title => $counter)
                                <div class="col-md-4 col-lg-3">
                                    <div class="small-box {{ $styles[$loop->index]['bg'] }}">
                                        <div class="inner">
                                            <h3>{{ $counter }}</h3>
                                            <p>{{ ucwords(str_remove_dashes_custom($title)) }}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="{{ $styles[$loop->index]['icon'] }}"></i>
                                        </div>
                                        {{-- <a href="#" class="small-box-footer">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </a> --}}
                                    </div>
                                </div>
                                <!-- /.col -->
                            @endforeach
                        @endif
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@stop
