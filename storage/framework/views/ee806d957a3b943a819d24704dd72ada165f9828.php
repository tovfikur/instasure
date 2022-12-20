<?php
$page_heading = 'Add Parent dealer';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php if ($__env->exists('backend.admin.parent_dealers.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.parent_dealers.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="<?php echo e(route('admin.parent-dealers.store')); ?>" method="post"
                        enctype="multipart/form-data" autocomplete="off">
                        <?php echo csrf_field(); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="name">Credential Name <small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name"
                                        id="name" placeholder="Ex: Abdullah Ibn Omar" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="phone">Credential Phone <small class="text-danger">
                                            (unique & required)</small></label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>"
                                        id="name" placeholder="Ex: 01712345678" pattern="(01)[0-9]{9}" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="password">Credential Password<small class="text-danger">
                                            (required)</small></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Enter password" required>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="phone">Company/Industry name <small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="com_org_inst_name"
                                        value="<?php echo e(old('com_org_inst_name')); ?>" id="com_org_inst_name"
                                        placeholder="Ex: Star IT" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="email">Category<small class="text-danger"> (required)</small></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="phone">BIN<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="bin" value="<?php echo e(old('bin')); ?>"
                                        id="bin" placeholder="Ex: 0123456789123" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="etin">eTIN<small class="text-danger"> (required)</small></label>
                                    <input type="text" class="form-control" name="etin" value="<?php echo e(old('etin')); ?>"
                                        id="etin" placeholder="Ex: 54123" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="contact_person_name">Contact Person Name<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="<?php echo e(old('contact_person_name')); ?>" id="contact_person_name"
                                        placeholder="Ex: Jabir ibn Hayyan" required>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="contact_person_phone">Contact Person Phone<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_phone"
                                        value="<?php echo e(old('contact_person_phone')); ?>" id="contact_person_phone"
                                        placeholder="Ex: 01712345678" pattern="(01)[0-9]{9}" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="contact_person_email">Contact Person Email<small class="text-danger">
                                            (required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_email"
                                        value="<?php echo e(old('contact_person_email')); ?>" id="contact_person_email"
                                        placeholder="Ex: email@domain.com" required>
                                </div>
                                <!-- /.form-group -->


                                <div class="form-group col-md-3">
                                    <label for="commission_type">Commission Type<small class="text-danger">
                                            (required)</small></label>
                                    <select name="commission_type" id="commission_type" class="form-control">
                                        <option value="flat"
                                            <?php echo e(getBusinessSettingValue('commission_type') == 'flat' ? 'selected' : ''); ?>>
                                            Flat</option>
                                        <option value="percentage"
                                            <?php echo e(getBusinessSettingValue('commission_type') == 'percentage' ? 'selected' : ''); ?>>
                                            Percentage</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="commission_amount">Commission Amount<small class="text-danger">
                                            (required)</small></label>
                                    <input type="number" step="0.01" class="form-control" name="commission_amount"
                                        value="<?php echo e(getBusinessSettingValue('parent_dealer_commission')); ?>"
                                        id="com_org_inst_name" placeholder="Ex: 10" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="is_api">Is API <small class="text-danger"> (required)</small></label>
                                    <select name="is_api" id="" class="form-control">
                                        <option value="0">False</option>
                                        <option value="1">True</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="dealer_type">Parent Dealer Type<small class="text-danger">
                                            (required)</small></label>
                                    <select name="dealer_type" id="" class="form-control">
                                        <option value="prepaid">Prepaid</option>
                                        <option value="postpaid">Post Paid</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="city">City <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="city"
                                        value="<?php echo e(old('city')); ?>" id="city" placeholder="Ex: Dhaka">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="area">Area <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="area"
                                        value="<?php echo e(old('area')); ?>" id="area" placeholder="Ex: Dhanmondi">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="email">Tread License <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="tread_license" id="tread_license">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="email">Logo <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="logo" id="logo" required />
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="other_business_id">Other Business ID <small
                                            class="text-danger">(Multiple)</small></label>
                                    <input type="file" class="form-control" name="other_business_id[]"
                                        id="other_business_id" multiple>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="nid">NID <small class="text-danger">(Back & Front
                                            part.)</small></label>
                                    <input type="file" class="form-control" name="nid[]" id="nid" multiple>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="imei_check">
                                        Need IMEI Check
                                        <small class="text-danger"> (required)</small>
                                    </label>
                                    <select name="imei_check" id="imei_check" class="form-control">
                                        <option value="1" selected>Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-3">
                                    <label for="active">
                                        Is Active
                                    </label>
                                    <select name="active" id="active" class="form-control">
                                        <option value="1">Yes
                                        </option>
                                        <option value="0">No
                                        </option>
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group col-md-6">
                                    <label for="com_address">Business Address</label>
                                    <textarea name="com_address" id="com_address" class="form-control" rows="1"
                                        placeholder="Ex: 2nd Floor, House#60, Road#8&9, Block-F, Banani, Dhaka-1213 Bangladesh" required><?php echo e(old('com_address')); ?></textarea>
                                </div>
                                <!-- /.form-group -->

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                    <!-- /form -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/parent_dealers/create.blade.php ENDPATH**/ ?>