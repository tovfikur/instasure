@php
$page_heading = 'Profile';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
    <style>
        .box:not(:last-child) {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .box .box_heading {
            text-transform: capitalize;
            font-size: 18px;
            font-weight: 600;
            color: #888;
            position: relative;
        }

        .box .box_heading::first-letter {
            font-size: 22px;
            color: #007bff;
        }

        .box .box_heading::after {
            content: "";
            position: absolute;
            width: 11px;
            height: 2px;
            background: #007bff;
            left: 0;
            top: 90%;
        }

        .box .logo {
            width: 100%;
            height: 50px;
            object-fit: contain;
            background: #c2c7d0;
        }

        .fa_icon {
            width: 15px;
            height: 15px;
            background: #ddd;
            text-align: center;
            font-size: 12px;
            display: inline-block;
            line-height: 11px;
            border-radius: 2px;
            padding: 2px;
        }

        .form_icon {
            width: 15px;
            height: 15px;
            text-align: center;
            font-size: 10px;
            display: inline-block;
            line-height: 15px;
            border-radius: 2px;
            color: #f8f9fa;
            background: #111;
        }
    </style>
@endpush
@section('content')

    <!-- Breadcrumb -->
    @includeIf('backend.collection_center.dashboard.breadcrumb', ['page_heading' => $user->center_name])
    <!-- End: Breadcrumb -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (!empty($user->logo))
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/collection-center') . '/' . $user->logo }}"
                                        alt="Admin profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('uploads/profile/default.png') }}" alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>

                            <p class="text-muted text-center">{{ ucwords(str_remove_dashes_custom($user->user_type)) }}
                            </p>

                            <div class="box">
                                <h3 class="box_heading">Business Informations</h3>
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-university mr-1"></i>
                                        <span class="box_title">
                                            Center Name:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ $user->center_name }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-calendar mr-1"></i>
                                        <span class="box_title">
                                            Joined At:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ date_format_custom($user->created_at, 'd M, Y') }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-blind mr-1"></i>
                                        <span class="box_title">
                                            Parent Dealer:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ ucwords($user->parent_dealer->com_org_inst_name) }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-hourglass-start mr-1"></i>
                                        <span class="box_title">
                                            Status
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        @if ($user->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </span>
                                </div>
                                <!-- /.box_item -->

                            </div>
                            <!-- /.box -->

                            <div class="box">
                                <h3 class="box_heading">Contact Person Details</h3>
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-male mr-1"></i>
                                        <span class="box_title">
                                            Name:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ $user->contact_person_name }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-phone mr-1"></i>
                                        <span class="box_title">
                                            Phone:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ $user->contact_person_phone }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-envelope mr-1"></i>
                                        <span class="box_title">
                                            Email:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ $user->contact_person_email }}
                                    </span>
                                </div>
                                <!-- /.box_item -->

                            </div>
                            <!-- /.box -->

                            <div class="box">
                                <h3 class="box_heading">Authentication Details</h3>
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-user mr-1"></i>
                                        <span class="box_title">
                                            Name:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ $user->user->name }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-mobile mr-1"></i>
                                        <span class="box_title">
                                            Phone:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ $user->user->phone }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                            </div>
                            <!-- /.box -->

                            <div class="box">
                                <h3 class="box_heading">Addresses</h3>
                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-location-arrow mr-1"></i>
                                        <span class="box_title">
                                            Address
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        {{ ucfirst($user->address) }}
                                    </span>
                                </div>
                                <!-- /.box_item -->

                                <div class="box_item">
                                    <strong class="box_title">
                                        <i class="fas fa_icon fa-map-marker mr-1"></i>
                                        <span class="box_title">
                                            Location:
                                        </span>
                                    </strong>
                                    <span class="box_content">
                                        Division: {{ $user->division->name }},
                                        District: {{ $user->district->name }},
                                        Upazila: {{ $user->upazila->name }}
                                    </span>
                                </div>
                                <!-- /.box_item -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5 class="card-title text-secondary">
                                <i class="fas fa-pencil-square-o"></i> Edit Informations
                            </h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form class="form-horizontal"
                                action="{{ route('collection_center.update_profile', $user->id) }}" method="POST"
                                id="edit_form" enctype="multipart/form-data">
                                <input type="hidden" value="{{ $user->id }}" name="collection_center_id" />
                                <input type="hidden" value="{{ $user->user->id }}" name="id" />
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-user"></i>
                                        Business User Name
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $user->user->name }}" name="name"
                                            class="form-control" id="name" required />
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-mobile"></i>
                                        Business User Phone
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="number" value="{{ $user->user->phone }}" name="phone"
                                            class="form-control" id="phone" required />
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-envelope"></i>
                                        Business User Email
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="email" value="{{ $user->user->email }}" name="email"
                                            class="form-control" id="email" />
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <label for="contact_person_name" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-male"></i>
                                        Contact Person Name
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $user->contact_person_name }}"
                                            name="contact_person_name" class="form-control" id="contact_person_name"
                                            required />
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <label for="contact_person_phone" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-phone"></i>
                                        Contact Person Phone
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $user->contact_person_phone }}"
                                            name="contact_person_phone" class="form-control" id="contact_person_phone"
                                            required />
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <label for="contact_person_email" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-envelope"></i>
                                        Contact Person Email
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" value="{{ $user->contact_person_email }}"
                                            name="contact_person_email" class="form-control" id="contact_person_email" />
                                    </div>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group row">
                                    <label for="password" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-key"></i>
                                        Password
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="password" value="{{ $user->password }}" name="password"
                                            class="form-control" id="password" />
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label">
                                        <i class="fas form_icon fa-location-arrow"></i>
                                        Address
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea name="address" class="form-control" id="address" required>{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group row">
                                    <div class="offset-sm-4 col-sm-8">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-cloud"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </form>
                            <!-- /.form -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop

@push('js')
    <!-- Scripts on page -->
    @includeIf('backend.collection_center.dashboard.scripts')
@endpush
