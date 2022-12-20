<?php
$page_heading = 'Sale Device Insurance';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
    <style>
        select+.select2-container {
            z-index: 300;
        }

        .test {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: inherit;
            height: inherit;
        }

        .test:before {
            content: "X";
            display: flex;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(220 53 69 / 95%);
            align-items: center;
            justify-content: center;
            color: #ffffffb8;
            font-size: 40px;

        }

        .fa-xs {
            font-size: 6px !important;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <?php if ($__env->exists('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End:Breadcrumb -->

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form id="form_id" role="form" action="<?php echo e(route('childDealer.device-insurance.getInsPrice')); ?>"
                        method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($deviceSubcategories); ?>" name="device_subcategory_id">
                        <input type="hidden" value="<?php echo e($user->id); ?>" name="user_id">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="full_name">Customer
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="text" id="full_name" class="form-control" name="name"
                                        value="<?php echo e($user->name); ?>" readonly>

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="customer_name">Contact Person Name
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="text" class="form-control"
                                        value="<?php echo e(old('customer_name') ? old('customer_name') : $user->name); ?>"
                                        name="customer_name" id="customer_name" placeholder="Enter Full Name" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="customer_phone">Contact Person Phone
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="text" class="form-control" name="customer_phone"
                                        value="<?php echo e(old('customer_phone') ? old('customer_phone') : $user->phone); ?>"
                                        id="customer_phone" placeholder="Enter phone" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="customer_email">Contact Person Email
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="email" class="form-control" name="customer_email"
                                        value="<?php echo e(old('customer_email') ? old('customer_email') : $user->email); ?>"
                                        id="customer_email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inc_exc_type">Select NID / Passport Number
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <select class="form-control" name="inc_exc_type" id="inc_exc_type" required>
                                        <option value="nid">NID Number</option>
                                        <option value="passport">Passport Number</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="number">Submit Number
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="text" class="form-control" name="number" value="<?php echo e(old('number')); ?>"
                                        id="number" placeholder="Enter Selected Number" required>
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="brand_id">Device Brand
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <select class="form-control" name="brand_id" id="brand_id" required>
                                        <option value="0" selected disabled>Select Brand</option>
                                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($id); ?>"><?php echo e($brand); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-4">
                                    <label for="device_model_id">Device Model
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <select class="form-control" name="device_model_id" id="device_model_id">
                                        <option value="0" selected disabled>Select</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="device_price">Device Price
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="number" class="form-control" name="device_price"
                                        value="<?php echo e(old('device_price')); ?>" id="device_price"
                                        placeholder="Enter Device Price" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="battery_number">Battery Number
                                    </label>
                                    <input type="text" class="form-control" name="battery_number"
                                        value="<?php echo e(old('battery_number')); ?>" id="battery_number"
                                        placeholder="Enter Battery Number">
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="imei_one">IMEI One <?php if($imei_check == 0): ?>
                                            (<span class="text-muted"> Checking off but required</span>)
                                        <?php endif; ?>
                                        <sup class="text-danger" title="Required">
                                            <i class="fa fa-star fa-xs"></i>
                                        </sup>
                                    </label>
                                    <input type="number" class="form-control" name="imei_one"
                                        value="<?php echo e(old('imei_one')); ?>" id="imei_one" placeholder="Enter IMEI One"
                                        data-imei_check="<?php echo e($imei_check); ?>" minlength="15" maxlength="25" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="imei_two">IMEI Two</label>
                                    <input type="number" class="form-control" name="imei_two"
                                        value="<?php echo e(old('imei_two')); ?>" id="imei_two" placeholder="Enter IMEI Two"
                                        data-imei_check="<?php echo e($imei_check); ?>" maxlength="25" minlength="15">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-10"></div>
                                <div class="col-2 text-right">
                                    <button type="button" id="getPackage" class="btn btn-warning btn-sm ">Get
                                        Package
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 ashiq" id="insurance_price"></div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div id="submitBtn" class="card-footer text-right" style="display: none;">
                            <button type="submit" class="btn btn-primary">Next <i
                                    class="fa fa-arrow-circle-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
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
                    <form role="form" action="<?php echo e(route('childDealer.customer-insert')); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">Full Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="<?php echo e(old('name')); ?>"
                                        name="name" id="name" placeholder="Enter Full Name" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone">Phone <small class="text-danger">(required & should be
                                            unique)</small></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="<?php echo e(old('phone')); ?>" id="name" placeholder="Enter phone" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="<?php echo e(old('email')); ?>" id="email" placeholder="Enter Email">
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        function check_required_fields() {
            let full_name = $('#full_name').val();
            let customer_phone = $('#customer_phone').val();
            let inc_exc_type = $('#inc_exc_type').val();
            let number = $('#number').val();
            let brand_id = $('#brand_id').val();
            let device_model_id = $('#device_model_id').val();
            let device_price = $('#device_price').val() > 0 ? $('#device_price').val() : false;
            let battery_number = $('#battery_number').val();
            let imei_one = $('#imei_one').val();
            let imei_two = $('#imei_two').val();


            if (
                full_name && customer_phone && inc_exc_type && number && brand_id && device_model_id && device_price &&
                imei_one
            ) {
                let error = false;
                // console.log(full_name, customer_phone, inc_exc_type, number, brand_id, device_model_id,
                //     device_price, battery_number, imei_one);
                if (!(imei_one.length >= 15 && imei_one.length <= 25)) {
                    error = true;
                    toastr.error('IMEI one character lenght must be between 15 to 25');
                }

                if (imei_two.length > 0) {
                    if (!(imei_two.length >= 15 && imei_two.length <= 25)) {
                        error = true;
                        toastr.error('IMEI two character lenght must be between 15 to 25');
                    }
                }
                if (error) {
                    return false;
                }
                return true;

            } else {

                toastr.error('Fillup all required fields please');
                return false;
            }

        }
        $(document).ready(function() {
            $('.demo-select2').select2();
        });
        $('#device_category_id').on('change', function() {
            getDeviceSubcategory();
        });
        $('#brand_id').on('change', function() {
            getDeviceModel();
        });


        function getDeviceSubcategory() {
            var device_category_id = $('#device_category_id').val();
            $.post('<?php echo e(route('childDealer.device_subcategories')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                device_category_id: device_category_id
            }, function(data) {
                $('#device_subcategory_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#device_subcategory_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                getDeviceModel();
                $('.demo-select2').select2();
            });
        }

        function getDeviceModel() {
            var brand_id = $('#brand_id').val();
            $.post('<?php echo e(route('childDealer.device_models')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                brand_id: brand_id
            }, function(data) {
                $('#device_model_id').html(null);
                for (var i = 0; i < data.length; i++) {
                    $('#device_model_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $('.demo-select2').select2();
                //getInsurancePriceHistory();
            });
        }

        /* Get package details */
        $(function() {
            $('#getPackage').click(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (check_required_fields()) {
                    $.ajax({
                        type: "POST",
                        url: "/childDealer/get/device-insurance/package",
                        data: $('#form_id').serialize(),
                        success: function(data) {

                            $('#submitBtn').show();
                            $('#form_id option:not(:selected)').prop('disabled', true);
                            let sr = 1;
                            $(this).find('option:not(:selected)').prop('disabled', true);

                            $("#form_id").each(function() {
                                let el = $(this).find(':input').prop('readonly', true);
                            });
                            $('#insurance_price').html(data);
                        }
                    }).done(function() {

                    });
                }

            });
        });

        /* Imei one check required when parent has true flag */
        $('#imei_one').on('blur', function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let imei_check = $(this).data('imei_check');

            if (imei_check) {
                if ($(this).val()) {
                    $.ajax({
                        type: "get",
                        url: "/childDealer/device-insurance/imei-one/check/" + $(this).val(),
                        data: $('#form_id').serialize(),
                        success: function(data) {

                            if (data.response == 1) {
                                toastr.success('This IMEI Successfully Checked!');
                                $('#getPackage').removeClass('d-none');
                            } else {
                                toastr.error('Your entered IMEI does not exist!')
                                $('#imei_one').val('');
                            }

                        }
                    })
                }
            } else {
                $('#getPackage').removeClass('d-none');
            }

        });

        /* Imei check */
        $('#imei_two').on('blur', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let imei_check = $(this).data('imei_check');

            if (imei_check) {
                if ($(this).val()) {
                    $.ajax({
                        type: "get",
                        url: "/childDealer/device-insurance/imei-two/check/" + $(this).val(),
                        data: $('#form_id').serialize(),
                        success: function(data) {
                            //alert(data.response)
                            if (data.response == 1) {
                                toastr.success('This IMEI Successfully Checked!')
                            } else {
                                toastr.error('Your entered IMEI does not exist!')
                                $('#imei_two').val('')
                            }
                        }
                    })
                }
            }

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/device_insurance/create.blade.php ENDPATH**/ ?>