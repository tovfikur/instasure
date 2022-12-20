<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-1">
            <div class="col-sm-6">
                <h5 class="mt-1 text-secondary">
                    <?php echo e($page_heading); ?>

                </h5>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a
                            href="<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer', ['status' => 'all'])); ?>">
                            <span class="badge badge-secondary">All</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer')); ?>">
                            <span class="badge badge-warning">Pending</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a
                            href="<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer', ['status' => 'paid'])); ?>">
                            <span class="badge badge-success">Paid</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a
                            href="<?php echo e(route('admin.withdraw_payment_request_from_parent_dealer', ['status' => 'rejected'])); ?>">
                            <span class="badge badge-danger">Rejected</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>
<?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/payment_request_to_admin/breadcrumb.blade.php ENDPATH**/ ?>