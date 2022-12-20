@extends('backend.layouts.master')
@section("title","Add Travel Ins Order")
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
                    <h1>Add Travel Ins Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('childDealer.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Travel Ins Order</li>
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
                        <h3 class="card-title float-left">Add Travel Ins Order</h3>
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
                    <form role="form" action="{{route('childDealer.travel-ins-order.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="full_name">Customer <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}" readonly>
                                    <input type="hidden" value="{{$user->id}}" name="user_id">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="full_name">Full Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ old('full_name') }}" name="full_name" id="full_name" placeholder="Enter Full Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="name" placeholder="Enter phone" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">Email<small class="text-danger">(required)</small></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dob">Date of Birth <small class="text-danger">(required)</small></label>
                                    <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" id="dob" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="passport_number">Passport Number <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="{{ old('passport_number') }}" name="passport_number" id="passport_number" placeholder="Enter Passport Number" required>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="passport_expire_till">Passport Expire Till <small class="text-danger">(required)</small></label>
                                    <input type="date" class="form-control" name="passport_expire_till" value="{{ old('passport_expire_till') }}" id="passport_expire_till" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="commission_type">Country type<small class="text-danger">(required)</small></label>
                                    <select name="" id="country_type" class="form-control demo-select2" required onchange="getPlanTitle()">
                                        <option>Select</option>
                                        <option value="Non Schengen">Non Schengen</option>
                                        <option value="Schengen">Schengen</option>
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
                                    <input type="text" name="flight_number" id="passport_expire_till"  class="form-control" placeholder="Travels For days?" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="flight_date">Flight Date</label>
                                    <input type="date" name="flight_date" id="flight_date"  class="form-control" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="return_date">Return Date</label>
                                    <input type="date" name="return_date" id="return_date"  class="form-control" required>
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

@stop
@push('js')
    <script>
        $(document).ready(function () {
            $('.demo-select2').select2();
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
            });
        }
    </script>
@endpush
