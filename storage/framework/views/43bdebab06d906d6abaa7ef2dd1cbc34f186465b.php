<?php $__env->startSection('title', 'Mediclaim Insurance Quote Form '); ?>
<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css"
        integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        @media  only screen and (max-width: 767px) {
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
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Start Page Title Area -->
    <div class="page-title-area page-title-bg1">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-title-content">
                        <h2>Mediclaim Insurance Quote Form </h2>
                        <ul>
                            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li>Mediclaim Insurance Quote Form</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Pricing Area -->
    <section class="pricing-area ptb-20 pb-70">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-12">
                    <!-- Sidebar -->
                    <?php echo $__env->make('frontend.partials.customer_dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- End: Sidebar -->
                </div>
                <!-- /.col -->

                <div class="col-lg-9 col-md-9 col-sm-12 ">
                    <div class="single-pricing-box">
                        <div class="pt-4">
                            <h3 class="text-center">Mediclaim insurance quote form </h3>
                        </div>

                        <div class="tab_content m-4 row">
                            <div class="tabs_item col-lg-12 col-md-12 col-sm-12" id="mainDiv">
                                <p class="text-secondary">Please fillup all mendetory fields</p>
                                <form id="choice_form" method="post"
                                    action="<?php echo e(route('insurance.quotation.calculation')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="full_name" class="c-form-label">Full Name
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="text" name="full_name" value="<?php echo e(Auth::user()->name); ?>"
                                                    class="form-control" placeholder="Your full name" required>
                                            </div>
                                            <!-- /.form-group  -->

                                            <div class="form-group mb-2">
                                                <label for="phone" class="c-form-label">Phone
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="number" name="phone" value="<?php echo e(Auth::user()->phone); ?>"
                                                    class="form-control" placeholder="Your phone" required>
                                            </div>
                                            <!-- /.form-group  -->

                                            <div class="form-group mb-2">
                                                <label for="email" class="c-form-label">Email
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="email" name="email" value="<?php echo e(Auth::user()->email); ?>"
                                                    class="form-control" placeholder="Your Email" required>
                                            </div>
                                            <!-- /.form-group  -->

                                            <div class="form-group mb-2">
                                                <label for="dob" class="c-form-label">Date of Birth
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="text" name="dob" id="dob" class="form-control"
                                                    value="<?php echo e(date_format_custom(Auth::user()->dob, 'm/d/Y')); ?>"
                                                    onchange="getInsurancePriceHistory()" required>
                                            </div>
                                            <!-- /.form-group  -->

                                            <div class="form-group mb-2">
                                                <label for="flight_number" class="c-form-label">Flight Number
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="text" name="flight_number" id="flight_number"
                                                    class="form-control" placeholder="Enter Flight Number" required>
                                            </div>
                                            <!-- /.form-group  -->
                                        </div>
                                        <!-- /.col  -->

                                        <div class="col-md-6">
                                            <div class="form-group mb-2">
                                                <label for="passport_number" class="c-form-label">Passport
                                                    Number
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="text" name="passport_number" id="passport_number"
                                                    value="<?php echo e(Auth::user()->passport_number); ?>" class="form-control"
                                                    placeholder="Your passport number" required>
                                            </div>
                                            <!-- /.form-group  -->
                                            <div class="form-group mb-2">
                                                <label for="passport_expire_till" class="c-form-label">Passport Expire
                                                    Till
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <input type="text" name="passport_expire_till" id="passport_expire_till"
                                                    value="<?php echo e(date_format_custom(Auth::user()->passport_expire_till, 'm/d/Y')); ?>"
                                                    class="form-control" onchange="getInsurancePriceHistory()" required>
                                            </div>
                                            <!-- /.form-group  -->

                                            <div class="form-group mb-2">
                                                <label for="country_type" class="c-form-label">Plan Country Type
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <select name="" id="country_type" class="form-control" required
                                                    onchange="getPlanTitle()">
                                                    <option>Select</option>
                                                    <option value="Non Schengen">Non Schengen</option>
                                                    <option value="Schengen">Schengen</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group  -->
                                            <div class="form-group mb-2">
                                                <label for="passport_number" class="c-form-label">Plan Title
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <select name="plan_category_id" id="plan_category_name"
                                                    class="form-control">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group  -->
                                            <div class="row">
                                                <div class="form-group col-lg-6 mb-2">
                                                    <label for="flight_date" class="c-form-label">Flight Date
                                                        <sup class="text-danger" title="Required">*</sup></label>
                                                    <input type="text" name="flight_date" id="flight_date"
                                                        class="form-control" onchange="getInsurancePriceHistory()"
                                                        required>
                                                </div>
                                                <!-- /.form-group  -->

                                                <div class="form-group col-lg-6 mb-2">
                                                    <label for="return_date" class="c-form-label">Return Date
                                                        <sup class="text-danger" title="Required">*</sup></label>
                                                    <input type="text" name="return_date" id="return_date"
                                                        class="form-control" onchange="getInsurancePriceHistory()"
                                                        required>
                                                </div>
                                                <!-- /.form-group  -->

                                            </div>
                                            <!-- /.row  -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <label for="shipping_address" class="c-form-label">Shipping Address
                                                    <sup class="text-danger" title="Required">*</sup></label>
                                                <textarea class="form-control" name="shipping_address" id="shipping_address" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="" id="insurance_price"></div>

                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Pricing Area -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script>
        /* Date pickers */
        $("#dob").datepicker({
            maxDate: -1
        });
        $("#passport_expire_till").datepicker({
            minDate: 15
        });
        $("#flight_date").datepicker({
            minDate: 0
        });
        $("#return_date").datepicker({
            minDate: 0
        });
    </script>
    <script>
        function getPlanTitle() {
            var country_type = $('#country_type').val();
            $.post('<?php echo e(route('get-plan-category')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                country_type: country_type
            }, function(data) {

                $('#plan_category_name').html(null);
                for (var i = 0; i < data.length; i++) {

                    $('#plan_category_name').append($('<option>', {
                        value: data[i].id,
                        text: data[i].plan_title + ' (' + data[i].county_details + ')'
                    }));
                }
            });

        }


        function getInsurancePriceHistory() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const form_data = $('#choice_form').serialize();

            $.ajax({
                type: "POST",
                url: '<?php echo e(route('insurance.provider.data')); ?>',
                data: form_data,
                success: function(data) {

                    if (data.length > 1) {
                        $('#insurance_price').html(data);
                    } else {
                        toastr.warning('Please check all input fields again');
                    }
                }
            });

        }

        $("#choice_form").on("submit", function(event) {
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '<?php echo e(route('insurance.quotation.calculation')); ?>',
                data: $('#choice_form').serialize(),
                success: function(data) {

                    $('#mainDiv').empty();
                    $('#mainDiv').html(data);

                }
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/frontend/pages/medical_insurance_quatation_form.blade.php ENDPATH**/ ?>