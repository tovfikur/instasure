@php
$page_heading = 'Insurance Claim Edit';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.service_center.insurance_claim.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->

    <!-- Main content -->
    <section class="content">
        <livewire:service-center.claim-form-parts-edit-component :deviceClaim="$deviceClaim" :deviceClaimedParts="$deviceClaimedParts" :deviceInsuranceDetails="$deviceInsuranceDetails"
            :deviceInsurance="$deviceInsurance" :deviceInfo="$deviceInfo" />

    </section>
@stop
@push('js')
    <script>
        window.addEventListener('item_exist', function() {
            alert("Item already exist");
        })
    </script>
@endpush
