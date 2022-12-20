<?php
$page_heading = 'Edit Insurance Category';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('backend.admin.categories.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.categories.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">
            <div class="row">
                <div class="col-8 offset-2">

                    <!-- form start -->
                    <form role="form" action="<?php echo e(route('admin.categories.update', $category->id)); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="<?php echo e($category->name); ?>" required>
                            </div>
                            <img src="<?php echo e(asset('uploads/categories/' . $category->icon)); ?>" width="80" height="50" alt="">
                            <div class="form-group">
                                <label for="email">Brand Logo <small>(size: 120 * 80 pixel)</small></label>
                                <input type="file" class="form-control" name="icon" id="logo">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="3"><?php echo e($category->description); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title"
                                    value="<?php echo e($category->meta_title); ?>">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description</label>
                                <textarea name="meta_description" id="meta_desc" class="form-control"
                                    rows="3"><?php echo e($category->meta_description); ?></textarea>
                            </div>



                            <!-- This section Developed by Tovfikur -->

                            <!-- start -->
                            <div class="form-group">
                                <div class="row">
                                <div class="col">
                                    <label for="vat">Vat</label>
                                    <input type="number" class="form-control" name="vat" id="vat"
                                    value="<?php echo e($category->vat); ?>" placeholder="Enter vat for this category">
                                    </div>
                                    <div class="col-3">
                                    <label for="inputState">Vat type</label>
                                    <select name="vat_type" class="form-control" id="vat_type">
                                        <option value="1" selected>Percentage</option>
                                        <option value="0">Flat</option>
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                <div class="col">
                                    <label for="service">Service Charge</label>
                                    <input type="number" class="form-control" name="service" id="service"
                                    value="<?php echo e($category->service); ?>" placeholder="Enter service charge for this category">
                                    </div>
                                    <div class="col-3">
                                    <label for="service_type">Service Charge type</label>
                                    <select name="service_type" class="form-control" id="service_type">
                                        <option value="1" selected>Percentage</option>
                                        <option value="0">Flat</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end -->




                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "<?php echo e(route('admin.ckeditor.upload', ['_token' => csrf_token()])); ?>",
            filebrowserUploadMethod: 'form'
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/categories/edit.blade.php ENDPATH**/ ?>