@extends('frontend.layouts.app')
@section('title', 'Device Insurance Claim')
@push('css')
    <style>
        .single-pricing-box .pricing-header.bg2 {
            background-image: url(https://t4.ftcdn.net/jpg/01/19/11/55/360_F_119115529_mEnw3lGpLdlDkfLgRcVSbFRuVl6sMDty.jpg);
        }

        .ptb-100 {
            padding-top: 25px;
            padding-bottom: 100px;
        }

        .single-pricing-box {
            padding-bottom: 19px;
        }

        .single-pricing-box .pricing-header {
            background-color: #002e5b;
            border-radius: 5px 5px 0 0;
            position: relative;
            z-index: 1;
            overflow: hidden;
            padding-top: 25px;
            padding-bottom: 25px;
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        @media only screen and (max-width: 767px) {
            .page-title-area {
                height: -14%;
                padding-top: 214px;
                padding-bottom: 32px;
            }
        }

        .src-image {
            display: none;
        }

        .card2 {
            overflow: hidden;
            position: relative;
            text-align: center;
            padding: 0;
            color: #fff;

        }

        .card2 .header-bg {
            /* This stretches the canvas across the entire hero unit */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            border-bottom: 1px #FFF solid;
            /* This positions the canvas under the text */
            z-index: 1;
        }

        .card2 .avatar {
            position: relative;
            z-index: 100;
        }

        .card2 .avatar img {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            border: 5px solid rgba(0, 0, 30, 0.8);
        }

        #hoverMe {
            border-bottom: 1px dashed #e5e5e5;
            text-align: left;
            padding: 13px 20px 11px;
            font-size: 14px;
            font-weight: 600;
            color: #002e5b;

        }

        #hoverMe:hover {
            background-color: #ebebeb;
            color: #002e5b;
            border-left: 3px solid #002e5b;

        }

        .services-box .content {
            padding: 14px;
            border-radius: 0 0 5px 5px;
        }

        .services-box .content h3 {
            margin-bottom: 0px;
            position: relative;
            text-transform: uppercase;
            font-size: 18px;
            font-weight: 900;
        }

        .services-box {
            margin-bottom: 15px;
            border-radius: 5px;
            transition: 0.5s;
            background-color: #ffffff;
            box-shadow: 9.899px 9.899px 30px 0 rgb(0 0 0 / 10%);
        }

        .quote-list-tab {
            margin-left: 15px;
            background-color: #ffffff;
            box-shadow: 0 10px 30px rgb(0 0 0 / 7%);
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Device Insurance Claim</h2>
                        <ul>
                            <li><a href="">Home</a></li>
                            <li>Device Insurance Claim</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->
    <!-- Start Events Details Area -->
    <section class="events-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 ">
                    @include('frontend.partials.customer_dashboard_sidebar')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 ">
                    @if (strtolower($claimType) == 'theft')
                        <h4 class="text-center">Claim Request</h4>
                        <form action="{{ route('user.insurance-claim-request.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $deviceInsurance->id }}" class="form-control"
                                name="device_insurance_id">
                            <input type="hidden" value="theft" class="form-control" name="claim_type">
                            <div class="form-group mb-2">
                                <label for="claim_type" class="c-form-label text-bold">Claim For</label>
                                <input type="text" value="{{ $claimType }}" class="form-control" name="claim_type"
                                    readonly>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="full_name">Upload FIR Copy</label>
                                    <input type="file" class="form-control" name="document[]">
                                </div>
                                <div class="col-md-3" style="margin-top: 30px">
                                    <a class="btn btn-sm btn-info text-white" id="add"><i
                                            class=" fa fa-plus-circle"></i> Add More</a>
                                </div>
                            </div>
                            <div id="more_field"></div>
                            <div class="form-group mb-2">
                                <label for="claim_note" class="c-form-label text-bold">Claim Note</label>
                                <textarea name="claim_note" id="claim_note" class="form-control" rows="4" placeholder="ex: Screen Protection."></textarea>
                            </div>
                            <button type="submit" class="default-btn mt-4 w-100">Submit</button>
                        </form>
                    @else
                        <h4 class="text-center">Search Location</h4>
                        <form id="submit-form" method="get">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="division_id" class="c-form-label text-bold">Division</label>
                                        <select name="division_id" id="division_id" class="form-control">
                                            <option>Select</option>
                                            @foreach (\App\Model\Division::all() as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="district_id" class="c-form-label text-bold">District</label>
                                        <select name="district_id" id="district_id" class="form-control">
                                            <option>Select</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <label for="upazila_id" class="c-form-label text-bold">Upazila</label>
                                        <select name="upazila_id" id="upazila_id" class="form-control ">
                                            <option>Select</option>

                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="default-btn mt-4 w-100" onclick="getServiceCenter()">Search
                                    Service & Collection Center
                                </button>
                            </div>
                        </form>
                        <div class="mt-5" id="search_result">
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </section>
    <!-- End Events Details Area -->
@stop
@push('js')
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;

                $('#more_field').append(`
                                <div class="row" id="row_${i}">
                                    <div class="form-group col-md-8">
                                        <label for="full_name">Upload FIR Copy</label>
                                        <input type="file" class="form-control" name="document[]">
                                    </div>
                                    <div class="col-md-3" style="margin-top: 30px;">
                                    <a class="btn btn-sm btn-danger text-white remove" id="${i}"><i class=" fa fa-minus-circle"></i> Cancel<a>
                                </div></div>`);
            });
            $(document).on('click', '.remove', function() {
                var button_id = $(this).attr("id");
                $('#row_' + button_id + '').remove();
            });

        });
        $('#division_id').on('change', function() {
            get_district()
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
                get_upazila_by_district();
            });
        }

        function get_upazila_by_district() {
            var district_id = $('#district_id').val();
            //console.log(category_id)
            $.post('{{ route('get_upazila_by_district') }}', {
                _token: '{{ csrf_token() }}',
                district_id: district_id
            }, function(data) {
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
            });
        }

        function getServiceCenter() {
            var division_id = $('#division_id').val();
            var district_id = $('#district_id').val();
            var upazila_id = $('#upazila_id').val();
            var device_insurance_id = {{ $deviceInsurance->id }};
            $.get('{{ route('user.get-service-center') }}', {
                division_id: division_id,
                district_id: district_id,
                upazila_id: upazila_id,
                device_insurance_id: device_insurance_id,
            }, function(data) {
                $('#search_result').html(data);

            });

        }
    </script>
@endpush
