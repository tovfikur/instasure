@extends('backend.layouts.master')
@section("title","Add Service Center")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Service Center</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add Service Center</li>
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
                        <h3 class="card-title float-left">Add Service Center</h3>
                        <div class="float-right">
                            <a href="{{route('admin.service-center.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.service-center.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name">Name <small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="phone">Phone <small class="text-danger"> (required & should be unique)</small></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="name" placeholder="Enter phone" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">Password<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="Enter password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="parent_id">Parent Dealer <small class="text-danger"> (required)</small></label>
                                    <select name="parent_id" id="parent_id" class="form-control demo-select2">
                                        <option>Select</option>
                                        @foreach(\App\Model\Dealer::where('parent_id',null)->get() as $dealer)
                                            <option value="{{$dealer->id}}">{{$dealer->com_org_inst_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="brand_id">Brands <small class="text-danger"> (required)</small></label>
                                    <select name="brand_id[]" id="brand_id" class="form-control demo-select2" multiple>
                                        <option>Select</option>
                                        @foreach(\App\Model\Brand::all() as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="service_center_name">Service Center Name <small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="service_center_name" value="{{ old('service_center_name') }}" id="service_center_name" placeholder="Enter Service Center Name" required>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="contact_person_name">Contact Person Name<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name" value="{{ old('contact_person_name') }}" id="contact_person_name" placeholder="Contact Person Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="contact_person_phone">Contact Person Phone<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_phone" value="{{ old('contact_person_phone') }}" id="contact_person_phone" placeholder="Contact Person Phone" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="contact_person_email">Contact Person Email<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_email" value="{{ old('contact_person_email') }}" id="contact_person_email" placeholder="Contact Person Email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="division_id">Division <small class="text-danger"> (required)</small></label>
                                    <select name="division_id" id="division_id" class="form-control demo-select2">
                                        <option>Select</option>
                                        @foreach(\App\Model\Division::all() as $divisions)
                                            <option value="{{$divisions->id}}">{{$divisions->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="district_id">District<small class="text-danger"> (required)</small></label>
                                    <select name="district_id" id="district_id" class="form-control demo-select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="upazila_id">Upazila<small class="text-danger"> (required)</small></label>
                                    <select name="upazila_id" id="upazila_id" class="form-control demo-select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="address">Address<small class="text-danger">(required)</small></label>
                                    <textarea type="text" class="form-control" name="address" value="{{ old('address') }}" rows="3" placeholder="Enter Address"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="email">logo <small class="text-danger">(size: 300 * 300 pixel)</small></label>
                                    <input type="file" class="form-control" name="logo" id="logo" >
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

@stop
@push('js')
<script>
    $('#division_id').on('change', function () {
        get_district();
    });
    $('#district_id').on('change', function () {
        get_upazila_by_district();
    });

    function get_district() {
        var division_id = $('#division_id').val();
        //console.log(category_id)
        $.post('{{ route('get_district_by_division') }}', {
            _token: '{{ csrf_token() }}',
            division_id: division_id
        }, function (data) {
            $('#district_id').html(null);

            for (var i = 0; i < data.length; i++) {
                $('#district_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $('.demo-select2').select2();
            get_upazila_by_district();
        });
    }
    function get_upazila_by_district() {
        var district_id = $('#district_id').val();
        //console.log(category_id)
        $.post('{{ route('get_upazila_by_district') }}', {
            _token: '{{ csrf_token() }}',
            district_id: district_id
        }, function (data) {
            $('#upazila_id').html(null);
            $('#upazila_id').append($('<option>', {
                value: null,
                text: null
            }));
            //console.log(data)
            for (var i = 0; i < data.length; i++) {
                $('#upazila_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));

            }
            $('.demo-select2').select2();
        });
    }


</script>
@endpush
