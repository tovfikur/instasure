@extends('frontend.layouts.app')
@section('title', 'Insurance Purchase Details')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap4.css') }}">
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
                        <h2>Insurance Purchase Details</h2>
                        <ul>
                            <li><a href="">Home</a></li>
                            <li>Insurance Purchase Details</li>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 pb-3">
                            <div class="events-details-header">
                                <a href="{{ route('user.insurance.purchase.history') }}" class="back-all-events"
                                    target="_blank"><i class="flaticon-left-chevron"></i> Back To All Events</a>
                                <h3>{{ $travelOrder->travel_insurance_category_title }}</h3>
                                @if ($travelOrder->status == 'completed' && $travelOrder->payment_status == 'paid')
                                    <h6>Policy Number: {{ $travelOrder->policy_number }}</h6>
                                @endif
                                <ul class="events-info-meta">
                                    <li>
                                        <i
                                            class="flaticon-timetable"></i>{{ date('d F Y', strtotime($travelOrder->created_at)) }}
                                    </li>
                                    {{-- <li><i class="far fa-clock"></i> 10.00AM - 10.00PM</li> --}}
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 tab quote-list-tab">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Travellar Details</h5>

                                    <ul>
                                        <li><span>Name:</span> {{ $travelOrder->full_name }}</li>
                                        <li><span>Phone:</span> {{ $travelOrder->phone }}</li>
                                        <li><span>Email:</span> {{ $travelOrder->email }}</li>
                                        <li>
                                            <span>Age:</span>
                                            @if ($travelOrder->age < 1)
                                                .5 Year
                                            @else
                                                {{ round($travelOrder->age) }} Years
                                            @endif

                                        </li>
                                        <li>
                                            <span>
                                                DOB:</span>
                                            {{ date_format_custom($travelOrder->dob, 'd M, Y') }}

                                        </li>
                                        <li>
                                            <span>Policy no:</span>
                                            @if (!empty($travelOrder->policy_number))
                                                {{ $travelOrder->policy_number }}
                                            @else
                                                <del>Not issued yet</del>
                                            @endif
                                        </li>

                                    </ul>
                                </section>
                            </aside>
                        </div>
                        <div class="col-lg-5 col-md-4 tab quote-list-tab">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Flight Details</h5>

                                    <ul>
                                        <li><span>Passport Number:</span> {{ $travelOrder->passport_number }}</li>
                                        <li>
                                            <span>Passport Expiry Date:</span>
                                            {{ date('d F Y', strtotime($travelOrder->passport_expire_till)) }}
                                        </li>
                                        <li><span>Flight Number:</span> {{ $travelOrder->flight_number }}</li>
                                        <li>
                                            <span>Flight Date:</span>
                                            {{ date('d F Y', strtotime($travelOrder->flight_date)) }}
                                        </li>
                                        <li>
                                            <span>Return Date:</span>
                                            {{ date('d F Y', strtotime($travelOrder->return_date)) }}
                                        </li>
                                        <li>
                                            <span>Total Stay:</span>
                                            {{ $travelOrder->total_date }} Days
                                        </li>
                                        <li>
                                            <span>Policy Provider:</span>
                                            {{ ucwords($travelOrder->policy_provider->company_name) }}
                                        </li>

                                    </ul>
                                </section>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-md-3 tab quote-list-tab">
                            <aside class="widget-area" id="secondary">
                                <section class="widget widget_events_details">
                                    <h5 class="widget-title">Price Evaluation</h5>
                                    <ul>
                                        <li><span>Insurance Price:</span> {{ $travelOrder->ins_price }} Tk</li>
                                        <li>
                                            <span>Total Vat ({{ $travelOrder->vat_percentage }})%:</span>
                                            {{ $travelOrder->total_vat }}
                                            Tk
                                        </li>
                                        <li>
                                            <span>Total Service Charge ({{ $travelOrder->service_amount }})%:</span>
                                            {{ $travelOrder->service_total_amount }}
                                            Tk
                                        </li>
                                        <li><span>Grand Total:</span> {{ $travelOrder->grand_total }} Tk</li>
                                        <!-- Next line added by Tovfikur -->
                                        <li><span>Payment Method:</span> {{ $travelOrder->payment_method }}</li>
                                        <li><span>Payment Status:</span> {{ ucfirst($travelOrder->payment_status) }}</li>

                                        <li>
                                            <span>Order Status:</span>
                                            <span class="badge bg-info">
                                                {{ ucfirst($travelOrder->status) }}
                                            </span>

                                        </li>

                                    </ul>
                                </section>
                            </aside>
                        </div>
                        @if ($travelOrder->payment_status == 'paid')
                            <div class="text-center pt-3 row">
                                <div class="col-md-4">
                                    <a href="{{ route('invoice', $travelOrder->id) }}"
                                        class="default-btn mt-4 w-100">Download
                                        Invoice
                                    </a>
                                </div>
                                @if (!empty($travelOrder->policy_number))
                                    <div class="col-md-4">
                                        <a href="{{ $travelOrder->_policy_certificate_path }}"
                                            class="default-btn mt-4 w-100" target="_blank">Download Policy </a>
                                    </div>

                                    <div class="col-md-4">
                                        <a href="#" class="default-btn mt-4 w-100" onclick="claimRequest()">Claim

                                        </a>
                                    </div>
                                @endif
                            </div>
                        @elseif ($travelOrder->status == 'pending' && $travelOrder->payment_status == 'unpaid')
                            <div class="text-center pl-2  row">
                                <div class="col-md-6 col-lg-6">
                                    <a type="submit"
                                        href="{{ route('user.delete_unpaid_travel_insurance', encrypt($travelOrder->id)) }}"
                                        onclick="return confirm('Order will be deleted. Are you sure?')"
                                        class="default-btn mt-4 w-100">Cancel<span></span></a>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="default-btn mt-4 w-100">Pay Now</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('paynow.aamrpay') }}" method="post">
                    @csrf
                    <input type="hidden" name="travel_ins_orders" value="travel_ins_orders">
                    <input type="hidden" name="order_id" value="{{ encrypt($travelOrder->id) }}">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="pay-image text-center">
                                <img src="{{ asset('frontend/assets/images/aamrpay.png') }}" alt="aamr-pay">
                            </div>
                            <input type="checkbox" class="mt-3" name="payment_terms" checked="checked" required>
                            i accept <a class="text-info" href="#">payment</a> and <a class="text-info"
                                href="#">return</a>
                            policy.
                            <div class="text-center">
                                <button type="submit" class="default-btn mt-4 w-100">Pay Now<span></span>
                                </button>
                            </div>

                            {{-- <div class="modal-footer"> --}}
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                            {{-- </div> --}}

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Events Details Area -->
@stop
@push('js')
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        //sweet alert
        function claimRequest() {
            let description = `{!! $travelOrder->policy_provider->claim_info !!}` || `
                <p style="line-height: 18px;">In the event of Illness or Accident abroad which may lead to Hospital treatment or Curtailment of your trip</p>
                <h5 style="text-decoration:underline; font-size: 12px; color: #555;">Please Contact</h5>
                <h2 style="text-decoration:underline;     font-size: 18px;    color: #555;">INTANA GLOBAL</h2>
                <p style="line-height: 18px;">Sussex House, Perrymount Road, Haywards Heath, West Sussex RH 16 1 DN
                <b>Telephone:</b> +44(0) 207 902 7405
                <b>Email:</b> ops@intana-global.com</p>
                <blockquote style="    font-size: 10px;    line-height: 15px;    padding: 10px !important;    margin: 0;">
                    NB : (1) To avoid reverse charge calls, the claimant and/or someone calling on his/her behalf over above telephone/fax be requested to give his/her telephone number so that the INTANA GLOBAL can immediately call back asking for other particulars. (2) INTANA GLOBAL is acting as Third Party Administrators/Assistance provider to render services in respect of claims to the Overseas Mediclaim Policy holders. In the event of a claim, please apply to INTANA GLOBAL for a Claim Form. When completed, please submit direct to INTANA GLOBAL together with the Insurance Certificate and relevant documentation.
                    </blockquote></div>`;
            swal({
                title: 'Claims Important Information',
                html: `<div><h6 style="color: #3aade1;">WHAT TO DO IN THE CASE OF A MEDICAL EMERGENCY</h6> ${description}
                `,
                type: 'info',
                showCancelButton: false,
                // confirmButtonColor: '#3085d6',
                // cancelButtonColor: '#d33',
                // confirmButtonText: 'OK',
                // cancelButtonText: 'No, cancel!',
                // confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true,
                showCloseButton: true,
                showConfirmButton: false,
            }).then((result) => {
                if (result.value) {
                    result.dismiss === swal.DismissReason.cancel;
                } else if (

                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your Data is save :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
