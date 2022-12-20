@extends('backend.layouts.master')
@section("title","Edit Travel Ins Order")
@push('css')
    <style>
        select + .select2-container {
            z-index: 300;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Travel Ins Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('childDealer.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Travel Ins Order</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12   ">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Edit Travel Ins Order</h3>
                        <div class="float-right">
                            <a href="{{route('childDealer.travel-ins-order.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('childDealer.travel-ins-order.update',$travelInsOrder->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="full_name">Customer <small class="text-danger">(required)</small></label>
                                    <select name="user_id" id="user_id" class="form-control demo-select2" required>
                                        <option>Select</option>
                                        @foreach(\App\User::where('user_type','customer')->latest()->get() as $user)
                                            <option value="{{$user->id}}" {{$travelInsOrder->user_id == $user->id? 'selected':''}}>{{$user->name}} ({{$user->phone}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle" style="margin-top: 35px"></i></a>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="full_name">Full Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ $travelInsOrder->full_name }}" name="full_name" id="full_name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone <small class="text-danger">(required & should be unique)</small></label>
                                    <input type="text" class="form-control" name="phone" value="{{ $travelInsOrder->phone }}" id="name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">Email<small class="text-danger">(required)</small></label>
                                    <input type="email" class="form-control" name="email" value="{{$travelInsOrder->email }}" id="email" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of Birth <small class="text-danger">(required)</small></label>
                                    <input type="date" class="form-control" name="dob" value="{{ $travelInsOrder->dob }}" id="dob" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passport_number">Passport Number <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ $travelInsOrder->passport_number }}" name="passport_number" id="passport_number" placeholder="Enter Passport Number" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="passport_expire_till">Passport Expire Till <small class="text-danger">(required)</small></label>
                                    <input type="date" class="form-control" name="passport_expire_till" value="{{ $travelInsOrder->passport_expire_till }}" id="passport_expire_till" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="commission_type">Country type<small class="text-danger">(required)</small></label>
                                    <select name="" id="country_type" class="form-control demo-select2" required onchange="getPlanTitle()">
                                        <option>Select</option>
                                        <option value="Non Schengen" {{$travelInsOrder->travelInsPlansCategory->country_type == 'Non Schengen'? 'selected':'' }}>Non Schengen</option>
                                        <option value="Schengen" {{$travelInsOrder->travelInsPlansCategory->country_type == 'Schengen'? 'selected':'' }}>Schengen</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passport_number">Plan Title</label>
                                    <select name="plan_category_id" id="plan_category_name" class="form-control demo-select2" >
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="flight_number">Flight Number</label>
                                    <input type="text" name="flight_number" id="flight_number" class="form-control" value="{{ $travelInsOrder->passport_expire_till }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="flight_date">Flight Date</label>
                                    <input type="date" name="flight_date" id="flight_date" value="{{ $travelInsOrder->flight_date }}" class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" name="return_date" id="return_date" value="{{ $travelInsOrder->return_date }}" class="form-control" required>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="{{route('childDealer.customer-insert')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">Full Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Full Name" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone">Phone <small class="text-danger">(required & should be unique)</small></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="name" placeholder="Enter phone" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Enter Email">
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                {{--                <div class="modal-footer">--}}
                {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--                    <button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(document).ready(function () {
            $('.demo-select2').select2();
            getPlanTitle();
        });
        function getPlanTitle(){
            var country_type = $('#country_type').val();
            $.post('{{ route('get-plan-category') }}', {
                _token: '{{ csrf_token() }}',
                country_type: country_type
            }, function (data) {
                $('#plan_category_name').html(null);
                for (var i = 0; i < data.length; i++) {
                    console.log(data[i].plan_title)
                    $('#plan_category_name').append($('<option>', {
                        value: data[i].id,
                        text: data[i].plan_title + ' ('+ data[i].county_details + ')'
                    }));
                }
                $("#plan_category_name > option").each(function() {
                    if(this.value == '{{$travelInsOrder->travel_ins_plans_category_id}}'){
                        $("#plan_category_name").val(this.value).change();
                    }
                });
            });
        }
    </script>
@endpush
