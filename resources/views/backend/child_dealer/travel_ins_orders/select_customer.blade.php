@php
$page_heading = 'Device Insurance Sale - Select Customer';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    <!-- Breadcrumb -->
    @includeIf('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])
    <!-- End:Breadcrumb -->

    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="row">
                <div class="col-8 offset-2">

                    <!-- form start -->

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="name">Phone</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="phone" id="phone"
                                        placeholder="Enter Phone Number" required>
                                    <div class="input-group-append">
                                        <span onclick="get_customer()" class="input-group-text" id="basic-addon2"
                                            style="cursor:pointer;">Find Customer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a class="btn" data-toggle="modal" data-target="#exampleModal"><i
                                        class="fa fa-plus-circle" style="margin-top: 35px"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post" id="customer_registration"
                        action="{{ route('childDealer.customer-insert') }}">
                        @csrf


                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="mobile">Mobile Number <small class="text-danger">(Required & should be
                                            unique)</small></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}"
                                        id="mobile" placeholder="Enter Mobile Number" required>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" id="type" value="Register" name="type">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@stop
@push('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function() {

            $('#customer_registration').submit(function(e) {
                /* prevent Default functionality */
                e.preventDefault();
                /* Form data */
                let formData = {};
                formData.phone = $('#mobile').val();

                let actionurl = $(this).attr('action');

                const property = Object.getOwnPropertyNames(formData);
                const length = property.length;

                if (length >= 1) {

                    $.ajax({
                        url: actionurl,
                        type: 'post',
                        dataType: 'json',
                        data: formData,
                        success: function(json) {
                            if (json.success) {
                                location.href = json.redirectTo;
                            } else {
                                location.href = json.redirectTo;
                            }
                        },
                        error: function(ajax) {

                            const response = $.parseJSON(ajax.responseText);
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {
                                    toastr.error(value);
                                });
                            }

                        }
                    });
                }

            });

        });
    </script>
    <script>
        function get_customer(event) {

            var phone = $('#phone').val();

            $.post('{{ route('childDealer.get_customer') }}', {
                phone: $('#phone').val()
            }, function(data) {
                if (data.status == false) {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);
                    let url = '{{ route('childDealer.device-insurances.create', ':id') }}';
                    url = url.replace(':id', data.id);
                    location.href = url;
                }

            });
        }
    </script>
@endpush
