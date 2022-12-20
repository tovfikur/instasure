@extends('backend.layouts.master')
@section('title', 'Child Dealer List')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Child Dealer List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Child Dealer List</h3>
                        {{-- <div class="float-right">
                            <a href="{{route('admin.insurance-packages.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-8 p-4 offset-2" style=" border: 1px solid #f3f3f3;">

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Parent Dealer Name:</b> <a class="ml-5">
                                        {{ $parentDealer->com_org_inst_name }}</a>
                                </li>
                            </ul>
                            <form role="form" action="{{ route('admin.parent-dealers.child-dealer-update') }}"
                                method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-12">
                                        <h5 class="text-info">child List</h5>
                                        <p class="bg-info pl-3">
                                            <input type="hidden" name="parent_id" value="{{ $parentDealer->id }}">
                                            <input type="checkbox" id="checkAll"> By a click you can select all
                                        </p>
                                        <ul class="list-group" style="max-height: 415px; overflow-y: scroll;">
                                            @php
                                                $childDealers = \App\Model\Dealer::where('user_type', 'child_dealer')->get();
                                            @endphp
                                            @foreach ($childDealers as $childDealer)
                                                <li class="list-group-item m-0 mr-2 mb-1">
                                                    <label for="" class="m-0 p-0"> </label>
                                                    <input type="checkbox" class="child_id" name="child_id[]"
                                                        id="child_id" value="{{ $childDealer->id }}"
                                                        {{ in_array($childDealer->id, $packageChilds) ? 'checked' : '' }}>
                                                    {{ $childDealer->com_org_inst_name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
