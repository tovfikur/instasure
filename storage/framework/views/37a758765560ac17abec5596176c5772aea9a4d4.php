<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Policy Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('backend/dist/css/adminlte.min.css')); ?>">

    <!-- Google Font: Source Sans Pro -->
    
    <style>
        th {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <h3 class="text-center" style="text-transform: uppercase">Policy Invoice</h3>
                        
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info mt-5" style="background-color: #f3f3f3">
                <div class="col-sm-3 col-md-5 invoice-col ">
                    <b> Company Info</b>
                    <address>
                        <strong>Instasure</strong><br>
                        <b>Address :</b> House#67 (1st Floor), Road#17, Block# C, Banani, Dhaka-1213<br>
                        <b>Phone :</b> 02-9820580-1<br>
                        <b>Cell-Phone :</b> 01915828248<br>
                        <b>Email :</b> info@instasure.com<br>
                    </address>
                </div>
                <!-- /.col -->

                <!-- /.col -->
                <!-- /.col -->
                <div class="col-sm- 4 col-md-4 invoice-col">
                    <b>Dealer Info</b>
                    <address>
                        <b>Name:</b>
                        <?php echo e($deviceInsurance->child_dealer_id ? $deviceInsurance->childDealer->com_org_inst_name : ''); ?><br>
                        <b>Phone:</b> <?php echo e($deviceInsurance->childDealer->user->phone); ?><br>
                        <b>Email:</b> <?php echo e($deviceInsurance->childDealer->user->email); ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-md-3 invoice-col ">
                    <b>Invoice Number: </b> <?php echo e($deviceInsurance->invoice_code); ?><br>
                    <br>
                    <b>Date:</b> <?php echo e(date('d/m/Y', strtotime($deviceInsurance->created_at))); ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row mt-5">
                <div class="col-12 table-responsive">
                    <p class="pl-2 pb-0 mb-0 bg-secondary">Customer Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <?php
                                $customer_info = json_decode($deviceInsurance->customer_info);
                            ?>
                            <tr style="">
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Customer Email</th>
                                <th><?php echo e($customer_info->inc_exc_type == 'nid' ? 'Customer NID Number' : 'Customer Passport Number'); ?>

                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><?php echo e($customer_info->customer_name); ?></td>
                                <td><?php echo e($customer_info->customer_phone); ?></td>
                                <td><?php echo e($customer_info->customer_email); ?></td>
                                <td><?php echo e($customer_info->number); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-secondary">Device Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Device Name</th>
                                <th>Device Brand</th>
                                <th>Device Model</th>
                                <th>Device Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $device_info = json_decode($deviceInsurance->device_info);
                            ?>
                            <tr>
                                <td><?php echo e($device_info->device_name); ?></td>
                                <td><?php echo e($device_info->brand_name); ?></td>
                                <td><?php echo e($device_info->model_name); ?></td>
                                <td><?php echo e($device_info->device_price); ?> <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="pl-2 pb-0 mb-0 bg-secondary">Insurance Price Information</p>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr style="">
                                <th>Insurance Type</th>
                                <th>Price</th>
                                <th>Insurance Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $insurance_infos = json_decode($deviceInsurance->insurance_type_value);
                            ?>
                            <?php $__currentLoopData = $insurance_infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insurance_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($insurance_info->parts_type); ?></td>
                                    <td><?php echo e($insurance_info->price); ?> <?php echo e(config('settings.currency')); ?></td>
                                    <td><?php echo e($insurance_info->ins_type); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">

                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td><?php echo e($deviceInsurance->sub_total); ?> <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                            <tr>
                                <th>VAT%:</th>
                                <td> <?php echo e($deviceInsurance->total_vat); ?> <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td><?php echo e($deviceInsurance->grand_total); ?> <?php echo e(config('settings.currency')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
<?php /**PATH /var/www/html/instaweb/resources/views/backend/child_dealer/device_insurance/policy_invoice.blade.php ENDPATH**/ ?>