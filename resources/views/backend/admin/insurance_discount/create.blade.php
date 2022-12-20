@extends('backend.layouts.master')
@section('title', 'Add Insurance Discount')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <style>
        .select2-container {
            width: 100% !important;
        }

    </style>
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
                        <li class="breadcrumb-item active">Add Insurance Discount</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-10 offset-1">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Add Insurance Discount</h3>
                        <div class="float-right">
                            <a href="{{ route('admin.insurance-discount.index') }}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('admin.insurance-discount.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="device_category_id">Device Category</label>
                                    <select class=" form-control demo-select2" name="device_category_id"
                                        id="device_category_id" required>
                                        <option>Select</option>
                                        @foreach (\App\Model\DeviceCategory::all() as $deviceCategory)
                                            <option value="{{ $deviceCategory->id }}">{{ $deviceCategory->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col-4">
                                    <label for="device_subcategory_id">Device Subcategory</label>
                                    <select class=" form-control demo-select2" name="device_subcategory_id"
                                        id="device_subcategory_id" required>
                                        <option>Select</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="brand_model">Select Brand, Model Scope</label>
                                    <select class=" form-control" name="brand_model" id="brand_model" required>
                                        <option value="all">All</option>
                                        <option value="single">Single</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div id="brand" class="form-group col-md-6">
                                            <label for="brand_id">Device Brand</label>
                                            <select class=" form-control demo-select2" name="brand_id" id="brand_id">
                                                <option>Select</option>
                                                @foreach (\App\Model\Brand::all() as $deviceBrand)
                                                    <option value="{{ $deviceBrand->id }}">{{ $deviceBrand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="model" class="form-group col-md-6">
                                            <label for="device_model_id">Device Model</label>
                                            <select class="form-control" name="device_model_id" id="device_model_id">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-12 card p-2 bg-secondary" id="insurance_price"> --}}
                                {{-- </div> --}}
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="inc_exc_type">Ins type</label>
                                    <select class=" form-control" name="inc_exc_type" id="inc_exc_type" required>
                                        <option value="excluded">Excluded</option>
                                        <option value="included">Included</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="parent_type">Parent</label>
                                    <select class="form-control" name="parent_type" id="parent_type" required>
                                        <option value="all">All</option>
                                        <option value="selected">Selected</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="discount_type">Discount Type</label>
                                    <select name="discount_type" id="discount_type" class="form-control">
                                        <option value="flat">Flat</option>
                                        <option value="percentage">Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" id="discount_price" name="discount_price" class="form-control"
                                        placeholder="Enter Discount Price">
                                </div>
                                <div class="form-group col-3">
                                    <label for="date_from">Date From</label>
                                    <input type="date" id="date_from" name="date_from" class="form-control">
                                </div>
                                <div class="form-group col-3">
                                    <label for="date_to">Date To</label>
                                    <input type="date" id="date_to" name="date_to" class="form-control">
                                </div>

                                <div class="form-group col-3">
                                    <label for="time_from">Time From</label>
                                    <input type="time" id="time_from" name="time_from" class="form-control">
                                </div>
                                <div class="form-group col-3">
                                    <label for="time_to">Time To</label>
                                    <input type="time" id="time_to" name="time_to" class="form-control">
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->

                        <!-- Modal -->
                        <div class="modal fade" id="parentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true" style="z-index: 999999999999999999;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-10">
                                                <h5 class="modal-title" id="exampleModalLabel">Select Parent first after
                                                    that Child</h5>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        @php
                                            $parents = \App\Model\Dealer::where('parent_id', null)->get();
                                        @endphp
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <h5 class="text-info">Parent List</h5>
                                                <ul class="list-group" style="max-height: 415px; overflow-y: scroll;">
                                                    @foreach ($parents as $parent)
                                                        <li class="list-group-item m-0 mr-2 mb-1">
                                                            <label for="" class="m-0 p-0">
                                                                <input type="radio" class="parent_id" name="parent_id"
                                                                    id="parent_id-{{ $parent->id }}"
                                                                    value="{{ $parent->id }}">
                                                                {{ $parent->com_org_inst_name }}
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="form-group col-6">
                                                <h5 class="text-info">Child List</h5>
                                                <ul id="child" class="list-group"
                                                    style="max-height: 415px; overflow-y: scroll;">
                                                </ul>
                                            </div>



                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

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
    <script src="{{ asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script>
        $('#device_category_id').on('change', function() {
            getDeviceSubcategory();
        });
        $('#brand_id').on('change', function() {
            getDeviceModel();
        });
        $('#device_subcategory_id').on('change', function() {
            getInsurancePrice();
        });

        function getDeviceSubcategory() {
            var device_category_id = $('#device_category_id').val();
            $.post('{{ route('admin.device_subcategories') }}', {
                _token: '{{ csrf_token() }}',
                device_category_id: device_category_id
            }, function(data) {
                $('#device_subcategory_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#device_subcategory_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }


            });
        }

        function getDeviceModel() {
            var brand_id = $('#brand_id').val();
            $.post('{{ route('admin.device_models') }}', {
                _token: '{{ csrf_token() }}',
                brand_id: brand_id
            }, function(data) {
                $('#device_model_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#device_model_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                    $('.demo-select2').select2();
                }
            });
        }

        $('#insurance_type_id').on('change', function() {
            $('#price_option').html(null);
            $.each($("#insurance_type_id option:selected"), function() {

                add_more_price_option($(this).val(), $(this).text());
            });
        });

        //Brand model show hide
        $(function() {
            $('#brand').hide();
            $('#model').hide();
            $('#brand_model').change(function() {
                if ($('#brand_model').val() == 'single') {
                    $("#brand").prop('required', true);
                    $("#model").prop('required', true);
                    $('#brand').show();
                    $('#model').show();
                } else {
                    $('#brand').hide();
                    $('#model').hide();
                }
            });
        });

        //for insurance type included and excluded
        $(function() {
            $('.include_type').hide();
            $('#paid_by_div').hide();
            $('#inc_exc_type').change(function() {
                if ($('#inc_exc_type').val() == 'included') {
                    $('.include_type').show();
                    $('#paid_by_div').show();
                } else {
                    $('.include_type').hide();
                    $('#paid_by_div').hide();

                }
            });
        });

        //parent dealer modal hide / show
        $(function() {
            $('#parentModal').hide();
            $('#parent_type').change(function() {
                if ($('#parent_type').val() == 'selected') {
                    $('#parentModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#parentModal').modal('show')
                } else {
                    $('#parentModal').hide();
                }
            });
        });

        //paid by  modal hide / show
        $(function() {
            $('#paidByModal').hide();
            $('#paid_by').change(function() {
                if ($('#paid_by').val() == 'parent') {
                    $('#paidByModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#paidByModal').modal('show')
                } else {
                    $('#paidByModal').hide();
                }
            });
        });

        //for insurance type included and excluded
        $(function() {

            $('.parent_id').click(function() {
                //alert($(this).val());
                $("#child").empty();
                $.ajax({
                    type: "get",
                    url: "/admin/parentDealer/wise/child/" + $(this).val(),
                    success: function(data) {
                        console.log(data);
                        data.response?.data.forEach(function(item) {
                            $("#child").append(`
                            <li class="list-group-item m-0 mr-2 mb-1">
                                <label for="child_id" class="m-0 p-0">
                                    <input type="checkbox" class="checkbox"
                                       name="child_id[]"
                                       id="child_id"
                                       value="${item.id}"> ${item.com_org_inst_name}
                                </label>
                            </li>`)
                        });
                        // data.response.map(item => item.id)
                        // console.log(data.response);
                    }
                });
            });
        });


        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#checkAll2").click(function() {
            $("input[name ='paid_by_parent_id[]']:checkbox").not(this).prop('checked', this.checked);
        });
    </script>
@endpush
