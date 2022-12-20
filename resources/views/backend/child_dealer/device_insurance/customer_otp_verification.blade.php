@php
$page_heading = 'OTP Verification';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])
    <!-- End:Breadcrumb -->

    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="row">
                <div class="col-8 offset-2">

                    <!-- form start -->

                    <div class="card-body">
                        <form method="POST"
                            action="{{ route('childDealer.customerOtpVerificationProcess', $verificationCode->phone) }}">
                            @method('post')
                            @csrf
                            <div class="form-group">
                                <label for="phone">Customer Mobile Number</label>
                                <input type="number" class="form-control" name="phone" id="phone" placeholder="Phone"
                                    value="{{ $verificationCode->phone }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="code">OTP Code</label>
                                <input type="number" class="form-control" name="code" id="code"
                                    placeholder="Ex: 1234" value="{{ old('code') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Customer Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Ex: Sakil mahmud" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Customer Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Ex: example@domain.com" value="{{ old('email') }}">
                            </div>

                            <input type="submit" class="btn btn-primary" name="type" value="Verify & Sale" />


                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
@endpush
