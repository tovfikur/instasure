@extends('backend.layouts.master')
@section("title","Travel Plan Chart List")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Travel Plan Chart List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Travel Plan Chart List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Travel Plan Chart Lists</h3>
                        <div class="float-right">
                            <a href="{{route('admin.travel-ins-plans-charts.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Travel Plan Title</th>
                                <th>Policy Provider</th>
                                <th>Age Band</th>
                                <th>Period Days</th>
                                <th>Insurance Price</th>
                                <th>Validate Till</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($TIPCharts as $key => $TIPChart)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$TIPChart->travelInsPlansCategory->plan_title}}</td>
                                    <td>{{$TIPChart->policyProvider->company_name}}</td>
                                    <td>{{$TIPChart->age_from}} - {{$TIPChart->age_to}}</td>
                                    <td>{{$TIPChart->period_from}} - {{$TIPChart->period_to}}</td>
                                    <td>{{$TIPChart->ins_price}}</td>
                                    <td>{{date('d/m/Y',strtotime($TIPChart->validate_till))}}</td>
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.travel-ins-plans-charts.edit',$TIPChart->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Travel Plan Title</th>
                                <th>Policy Provider</th>
                                <th>Age Band</th>
                                <th>Period Days</th>
                                <th>Insurance Price</th>
                                <th>Validate Till</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')

@endpush
