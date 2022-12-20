<?php
$page_heading = 'Device Insurance Sale - Select Customer';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <?php if ($__env->exists('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.child_dealer.device_insurance.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                        action="<?php echo e(route('childDealer.customer-insert')); ?>">
                        <?php echo csrf_field(); ?>


                        <div class="card-body">
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <label for="mobile">Mobile Number <small class="text-danger">(Required & should be
                                            unique)</small></label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>"
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
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

            $.post('<?php echo e(route('childDealer.get_customer')); ?>', {
                phone: $('#phone').val()
            }, function(data) {
                if (data.status == false) {
                    toastr.error(data.message);
                } else {
                    toastr.success(data.message);
                    let url = '<?php echo e(route('childDealer.device-insurances.create', ':id')); ?>';
                    url = url.replace(':id', data.id);
                    location.href = url;
                }

            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/travel_ins_orders/select_customer.blade.php ENDPATH**/ ?>