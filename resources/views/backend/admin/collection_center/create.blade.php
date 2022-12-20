@php
$page_heading = 'Create New Collection Center';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.admin.collection_center.breadcrumb', ['page_heading' => $page_heading])
    <!-- End: Breadcrumb -->
    <!-- Main content -->
    <section class="content">

        <div class="card card-info card-outline">

            <!-- form start -->
            <form role="form" action="{{ route('admin.collection-center.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="center_name">
                                    <i class="fa fa-building mr-1 text-secondary"></i>
                                    Collection Center Name
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" name="center_name"
                                    value="{{ old('center_name') }}" id="center_name"
                                    placeholder="Ex: ABC Collection Center" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="name">
                                    <i class="fa fa-user mr-1 text-secondary"></i>
                                    User Name (Credential)
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name"
                                    placeholder="Ex: Sakil Mahmud" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="phone">
                                    <i class="fa fa-mobile mr-1 text-secondary"></i>
                                    Phone (Credential & Unique)
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}"
                                    id="name" placeholder="Ex: 01720092787" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="password">
                                    <i class="fa fa-key mr-1 text-secondary"></i>
                                    Password
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="******" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="address">
                                    <i class="fa fa-address-card mr-1 text-secondary"></i>
                                    Address
                                    <sup title="Required" class="text-danger">*</sup>

                                </label>
                                <textarea type="text" class="form-control" name="address" rows="1"
                                    placeholder="Enter Address">{{ old('address') }}</textarea>
                            </div>
                            <!-- /.form-group -->

                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">


                            <div class="form-group">
                                <label for="contact_person_name">
                                    <i class="fa fa-male mr-1 text-secondary"></i>
                                    Contact Person Name
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" name="contact_person_name"
                                    value="{{ old('contact_person_name') }}" id="contact_person_name"
                                    placeholder="Ex: Mister Ashik" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="contact_person_phone">
                                    <i class="fa fa-phone mr-1 text-secondary"></i>
                                    Contact Person Phone
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <input type="number" class="form-control" name="contact_person_phone"
                                    value="{{ old('contact_person_phone') }}" id="contact_person_phone"
                                    placeholder="Ex: 01720092787" required>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="contact_person_email">
                                    <i class="fa fa-envelope mr-1 text-secondary"></i>
                                    Contact Person Email
                                </label>
                                <input type="text" class="form-control" name="contact_person_email"
                                    value="{{ old('contact_person_email') }}" id="contact_person_email"
                                    placeholder="Contact Person Email" required>
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label for="parent_id">
                                    <i class="fa fa-archive mr-1 text-secondary"></i>
                                    Parent Dealer
                                </label>
                                <select name="parent_id" id="parent_id" class="form-control ">
                                    <option value="0">Select</option>
                                    @foreach ($dealers as $dealer)
                                        <option value="{{ $dealer->id }}">{{ $dealer->com_org_inst_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="email">
                                    <i class="fa fa-picture-o mr-1 text-secondary"></i>
                                    Logo

                                </label>
                                <input type="file" class="form-control" name="logo" id="logo">
                            </div>
                            <!-- /.form-group -->


                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">


                            <div class="form-group">
                                <label for="division_id">
                                    <i class="fa fa-location-arrow mr-1 text-secondary"></i>
                                    Division
                                    <sup title="Required" class="text-danger">*</sup>
                                </label>
                                <select name="division_id" id="division_id" class="form-control ">
                                    <option>Select</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="district_id">
                                    <i class="fa fa-thumb-tack mr-1 text-secondary"></i>
                                    District
                                    <sup title="Required" class="text-danger">*</sup>

                                </label>
                                <select name="district_id" id="district_id" class="form-control ">

                                </select>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label for="upazila_id">
                                    <i class="fa fa-map-marker mr-1 text-secondary"></i>
                                    Upazila
                                    <sup title="Required" class="text-danger">*</sup>

                                </label>
                                <select name="upazila_id" id="upazila_id" class="form-control ">

                                </select>
                            </div>
                            <!-- /.form-group -->


                            <div class="form-group">
                                <div class="small-box bg-secondary">
                                    <div class="inner">
                                        <button type="reset" class="btn btn-warning mr-1">
                                            <i class="fa fa-refresh mr-2"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-download mr-2"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.form-group -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.card-body -->

            </form>
            <!-- /form -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

@stop
@push('js')
    <script>
        $('#division_id').on('change', function() {
            get_district();
        });
        $('#district_id').on('change', function() {
            get_upazila_by_district();
        });

        function get_district() {
            var division_id = $('#division_id').val();

            $.post('{{ route('get_district_by_division') }}', {
                _token: '{{ csrf_token() }}',
                division_id: division_id
            }, function(data) {
                $('#district_id').html(null);

                for (var i = 0; i < data.length; i++) {
                    $('#district_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $('.').select2();
                get_upazila_by_district();
            });
        }

        function get_upazila_by_district() {
            var district_id = $('#district_id').val();

            $.post('{{ route('get_upazila_by_district') }}', {
                _token: '{{ csrf_token() }}',
                district_id: district_id
            }, function(data) {
                $('#upazila_id').html(null);
                $('#upazila_id').append($('<option>', {
                    value: null,
                    text: null
                }));

                for (var i = 0; i < data.length; i++) {
                    $('#upazila_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));

                }
                $('.').select2();
            });
        }
    </script>
@endpush
