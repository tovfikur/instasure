@php
$page_heading = 'Parent Dealer Information';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="mt-1 text-secondary">
                        {{ $page_heading }}
                    </h5>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($parent->logo)
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/dealer-logo/photo/' . $parent->logo) }}"
                                        alt="Admin profile picture" width="300" height="300">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $parent->com_org_inst_name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">

                                <li class="list-group-item">
                                    <b>Auth Type:</b>
                                    <a class="float-right">{{ ucwords(str_remove_dashes_custom($parent->user_type)) }}</a>
                                </li>


                                <li class="list-group-item">
                                    <b>Dealer Type:</b>
                                    <a class="float-right">{{ $parent->dealer_type }}</a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card  card-info card-outline">
                        <div class="card-header p-2">
                            <h4>{{ $parent->com_org_inst_name }}</h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content row">
                                <div class="col-md-8 offset-2" style="border: 1px solid #ddd; max-height:500px">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Contact Person Name: </b> <a
                                                class="float-right">{{ $parent->contact_person_name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Phone:</b> <a
                                                class="float-right badge badge-warning">{{ $parent->contact_person_phone }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Email:</b> <a
                                                class="float-right">{{ $parent->contact_person_email }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Category:</b> <a class="float-right">{{ $parent->category->name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>City:</b> <a class="float-right ">{{ ucwords($parent->city) }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Area:</b> <a class="float-right">{{ ucwords($parent->area) }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address:</b> <a class="float-right">{{ ucfirst($parent->com_address) }}</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop
