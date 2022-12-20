@php
$page_heading = 'Child Dealer Details';
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('uploads/dealer-logo/photo/' . $dealerDetails->logo) }}"
                                    alt="Admin profile picture" width="300" height="300">

                            </div>

                            <h3 class="profile-username text-center">{{ $dealerDetails->com_org_inst_name }}</h3>

                            <p class="text-muted text-center mb-0">Type: {{ $dealerDetails->dealer_type }}</p>
                            <p class="text-muted text-center mb-0">Current Balance: {{ $dealerDetails->dealer_balance }}
                                .tk</p>
                            <p class="text-muted text-center ">Due Balance:- {{ $dealerDetails->dealer_balance }}.tk</p>

                            <ul class="list-group list-group-unbordered mb-3">

                                <li class="list-group-item">
                                    <b>Total child Dealers</b> <a
                                        class="float-right">{{ myChildDealerCount($dealerDetails->id) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Agreement Status</b> <a
                                        class="float-right badge badge-warning">{{ $dealerDetails->agreement_status }}</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-info card-outline">
                        <div class="card-header p-2">
                            <h4>{{ $dealerDetails->com_org_inst_name }}

                            </h4>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content row">
                                <div class="col-md-6" style="border-right: 1px solid #ddd; max-height:500px">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Contact Person Name: </b> <a
                                                class="float-right">{{ $dealerDetails->contact_person_name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Phone:</b> <a
                                                class="float-right badge badge-warning">{{ $dealerDetails->contact_person_phone }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Contact Person Email:</b> <a
                                                class="float-right">{{ $dealerDetails->contact_person_email }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Category:</b> <a
                                                class="float-right">{{ $dealerDetails->category->name }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>BIN:</b> <a class="float-right">{{ $dealerDetails->bin }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>eTIN:</b> <a class="float-right">{{ $dealerDetails->etin }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Is API:</b> <a
                                                class="float-right">{{ $dealerDetails->is_api == 0 ? 'False' : 'True' }}</a>
                                        </li>
                                        @if (!empty($dealerDetails->tread_license))
                                            <li class="list-group-item">
                                                <b>Tread Licence:</b>
                                                <a class="float-right">
                                                    <img class=""
                                                        src="{{ asset('uploads/tread_license/photo/' . $dealerDetails->tread_license) }}"
                                                        alt="Tread Licence" width="40" height="40">
                                                    <a href="{{ asset('uploads/tread_license/photo/' . $dealerDetails->tread_license) }}"
                                                        download><i class="fa fa-download"></i></a>
                                                </a>
                                            </li>
                                        @endif
                                        @if (!empty($dealerDetails->nid))
                                            <li class="list-group-item">
                                                <b>NID:</b>
                                                <a class="">
                                                    @foreach (json_decode($dealerDetails->nid) as $nid)
                                                        <img class=""
                                                            src="{{ asset('uploads/nid/' . $nid) }}" alt="Tread Licence"
                                                            width="40" height="40">
                                                        <a href="{{ asset('uploads/nid/' . $nid) }}" download
                                                            class="mr-2"><i class="fa fa-download"></i></a>
                                                    @endforeach
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class=" col-md-6">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Commission Type: </b> <a
                                                class="float-right">{{ $dealerDetails->commission_type }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>City:</b> <a class="float-right ">{{ $dealerDetails->city }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Area:</b> <a class="float-right">{{ $dealerDetails->area }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Address:</b> <a
                                                class="float-right">{{ $dealerDetails->com_address }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Submit Date:</b> <a
                                                class="float-right">{{ date('d F Y H:i:s', strtotime($dealerDetails->app_submit_date_time)) }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Insert By:</b> <a
                                                class="float-right">{{ userObj($dealerDetails->insert_by_id)->name }}</a>
                                        </li>
                                        @if ($dealerDetails->app_approve_date_time != null)
                                            <li class="list-group-item">
                                                <b>Approve Date:</b> <a
                                                    class="float-right">{{ date('d F Y H:i:s', strtotime($dealerDetails->app_approve_date_time)) }}</a>
                                            </li>
                                        @endif
                                        @if (!empty($dealerDetails->nid))
                                            <li class="list-group-item">
                                                <b>NID:</b>
                                                <a class="">
                                                    @foreach (json_decode($dealerDetails->nid) as $nid)
                                                        <img class=""
                                                            src="{{ asset('uploads/nid/' . $nid) }}" alt="NID" width="40"
                                                            height="40">
                                                        <a href="{{ asset('uploads/nid/' . $nid) }}" download
                                                            class="mr-2"><i class="fa fa-download"></i></a>
                                                    @endforeach
                                                </a>
                                            </li>
                                        @endif
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
