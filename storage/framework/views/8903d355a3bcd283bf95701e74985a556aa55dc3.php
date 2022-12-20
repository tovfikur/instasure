<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="mt-1 text-secondary">
                    <?php echo e($page_heading); ?>

                </h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right mt-1">

                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.insurance-types.create')); ?>" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('admin.insurance-types.index')); ?>" class="btn btn-info btn-sm">
                            <i class="fa fa-th-list mr-1"></i>
                            All
                        </a>
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/insurance_types/breadcrumb.blade.php ENDPATH**/ ?>