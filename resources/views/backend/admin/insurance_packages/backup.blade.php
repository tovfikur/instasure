@extends('backend.layouts.master')
@section("title","Edit Insurance Package")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--                    <h1>Add Insurance Package</h1>--}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Insurance Package</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Edit Insurance Package</h3>
                        <div class="float-right">
                            <a href="{{route('admin.insurance-packages.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.insurance-packages.update',$insurancePackage->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="device_category_id">Device Category</label>
                                    <select class=" form-control demo-select2" name="device_category_id" id="device_category_id" required>
                                        <option>Select</option>
                                        @foreach(\App\Model\DeviceCategory::all() as $deviceCategory)
                                            <option value="{{$deviceCategory->id}}" {{$insurancePackage->device_category_id == $deviceCategory->id ? 'selected':''}}>{{$deviceCategory->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-6">
                                    <label for="device_subcategory_id">Device Subcategory</label>
                                    <select class=" form-control demo-select2" name="device_subcategory_id" id="device_subcategory_id" required>
                                        <option>Select</option>

                                    </select>

                                </div>
                                <div class="form-group col-6">
                                    <label for="brand_id">Device Brand</label>
                                    <select class=" form-control demo-select2" name="brand_id" id="brand_id" required>
                                        <option>Select</option>
                                        @foreach(\App\Model\Brand::all() as $deviceBrand)
                                            <option value="{{$deviceBrand->id}}" {{$insurancePackage->brand_id == $deviceBrand->id ? 'selected':''}}>{{$deviceBrand->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-6">
                                    <label for="device_model_id">Device Model</label>
                                    <select class="form-control demo-select2" name="device_model_id" id="device_model_id" required>
                                        <option>Select</option>

                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="insurance_type_id">Insurance Type</label>
                                    <select class=" form-control demo-select2" name="insurance_type_id[]" id="insurance_type_id" data-placeholder="Choose Type" multiple required>
                                        @foreach(\App\Model\InsuranceType::all() as $insuranceType)
                                            @php
                                                $ids = json_decode($insurancePackage->insurance_type_id)
                                            @endphp
                                            @foreach($ids as $id)
                                                <option value="{{$insuranceType->id}}" {{$insuranceType->id == $id ? 'selected':''}}>{{$insuranceType->name}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <div class="price_option" id="price_option">
                                        @php
                                            $insurancePrices = \App\Model\InsurancePrice::where('insurance_package_id',$insurancePackage->id)->get();
                                        @endphp
                                        @foreach ($insurancePrices as $key => $insurancePrice)
                                            <div class="form-group row">
                                                <div class="col-lg-5">
                                                    <input type="hidden" name="choice_no[]" value="{{ $insurancePrice->insurance_type_id }}">
                                                    <input type="text" class="form-control" name="choice[]" value="{{ \App\Model\InsuranceType::find($insurancePrice->insurance_type_id)->name }}" placeholder="Choice Title" disabled>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="choice_options_{{ $insurancePrice->insurance_type_id }}" placeholder="Enter choice values" value="{{ $insurancePrice->price }}">
                                                </div>
                                                <div class="col-lg-1">
                                                    <button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="type">Dealer Type</label>
                                    <select class="form-control demo-select2" name="type" id="type" required>
                                        <option>Select</option>
                                        <option value="Included">Included</option>
                                        <option value="Excluded">Excluded</option>
                                    </select>
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
    <script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script>
        $(document).ready(function () {
            getDeviceSubcategory() ;
            getDeviceModel();
        });
        $('#device_category_id').on('change', function () {
            getDeviceSubcategory();
        });
        $('#brand_id').on('change', function () {
            getDeviceModel();
        });
        function getDeviceSubcategory(){
            var device_category_id = $('#device_category_id').val();
            $.post('{{ route('admin.device_subcategories') }}', {
                _token: '{{ csrf_token() }}',
                device_category_id: device_category_id
            }, function (data) {
                $('#device_subcategory_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#device_subcategory_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }
                $("#device_subcategory_id > option").each(function() {
                    if(this.value == '{{$insuranceType->device_subcategory_id}}'){
                        $("#device_subcategory_id").val(this.value).change();
                    }
                });

            });
        }
        function getDeviceModel(){
            var brand_id = $('#brand_id').val();
            $.post('{{ route('admin.device_models') }}', {
                _token: '{{ csrf_token() }}',
                brand_id: brand_id
            }, function (data) {
                $('#device_model_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#device_model_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }
                $("#device_model_id > option").each(function() {
                    if(this.value == '{{$insuranceType->device_model_id}}'){
                        $("#device_model_id").val(this.value).change();
                    }
                });
            });
        }
        $('#insurance_type_id').on('change', function () {
            $('#price_option').html(null);
            $.each($("#insurance_type_id option:selected"), function () {

                add_more_price_option($(this).val(), $(this).text());
            });
        });
        function add_more_price_option(i, name) {
            $('#price_option').append('<div class="form-group row"><div class="col-lg-5 "><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="{{ 'Choice Title' }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '" placeholder="{{'Enter Insurance Price' }}" ></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }
        function delete_row(em){
            $(em).closest('.form-group').remove();
        }
    </script>
@endpush
