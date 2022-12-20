<?php
$page_heading = 'Edit Child Dealer';
?>

<?php $__env->startSection('title', $page_heading); ?>
<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <?php if ($__env->exists('backend.admin.child_dealers.breadcrumb', ['page_heading' => $page_heading])) echo $__env->make('backend.admin.child_dealers.breadcrumb', ['page_heading' => $page_heading], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12   ">
                <!-- general form elements -->
                <div class="card card-info card-outline">

                    <!-- form start -->
                    <form role="form" action="<?php echo e(route('admin.child-dealers.update', $dealerDetails->id)); ?>" method="post"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="name">Name <small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" value="<?php echo e($dealerDetails->user->name); ?>"
                                        name="name" id="name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">Phone <small class="text-danger">(required & should be
                                            unique)</small></label>
                                    <input type="text" class="form-control" name="phone"
                                        value="<?php echo e($dealerDetails->user->phone); ?>" id="name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="password">Password<small class="text-danger">(required)</small></label>
                                    <input type="password" class="form-control" name="password" value=""
                                        id="password">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="phone">Company/Industry Name <small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="com_org_inst_name"
                                        value="<?php echo e($dealerDetails->com_org_inst_name); ?>" id="com_org_inst_name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="email">Category<small class="text-danger">(required)</small></label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"
                                                <?php echo e($dealerDetails->category_id == $category->id ? 'selected' : ''); ?>>
                                                <?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="phone">BIN<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="bin"
                                        value="<?php echo e($dealerDetails->bin); ?>" id="bin" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="etin">eTIN<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="etin"
                                        value="<?php echo e($dealerDetails->etin); ?>" id="etin" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact_person_name">Contact Person Name<small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_name"
                                        value="<?php echo e($dealerDetails->contact_person_name); ?>" id="contact_person_name" required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="contact_person_phone">Contact Person Phone<small
                                            class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="contact_person_phone"
                                        value="<?php echo e($dealerDetails->contact_person_phone); ?>" id="contact_person_phone"
                                        required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contact_person_email">Contact Person Email<small
                                            class="text-danger">(required)</small></label>
                                    <input type="email" class="form-control" name="contact_person_email"
                                        value="<?php echo e($dealerDetails->contact_person_email); ?>" id="contact_person_email"
                                        required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="commission_type">Commission Type<small
                                            class="text-danger">(required)</small></label>
                                    <select name="commission_type" id="commission_type" class="form-control">
                                        <option value="flat"
                                            <?php echo e($dealerDetails->commission_type == 'flat' ? 'selected' : ''); ?>>Flat
                                        </option>
                                        <option value="percentage"
                                            <?php echo e($dealerDetails->commission_type == 'percentage' ? 'selected' : ''); ?>>
                                            Percentage</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="commission_amount">Commission Amount<small
                                            class="text-danger">(required)</small></label>
                                    <input type="number" step="0.01" class="form-control" name="commission_amount"
                                        value="<?php echo e($dealerDetails->commission_amount); ?>" id="com_org_inst_name" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="is_api">Is API <small class="text-danger">(required)</small></label>
                                    <select name="is_api" id="" class="form-control">
                                        <option value="0" <?php echo e($dealerDetails->is_api == 0 ? 'selected' : ''); ?>>False
                                        </option>
                                        <option value="1" <?php echo e($dealerDetails->is_api == 1 ? 'selected' : ''); ?>>True
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="dealer_type">Dealer Type<small
                                            class="text-danger">(required)</small></label>
                                    <select name="dealer_type" id="" class="form-control">
                                        <option value="prepaid"
                                            <?php echo e($dealerDetails->dealer_type == 'prepaid' ? 'selected' : ''); ?>>Prepaid
                                        </option>
                                        <option value="postpaid"
                                            <?php echo e($dealerDetails->dealer_type == 'postpaid' ? 'selected' : ''); ?>>Post Paid
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="city">City<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="city"
                                        value="<?php echo e($dealerDetails->city); ?>" id="city" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="area">Area<small class="text-danger">(required)</small></label>
                                    <input type="text" class="form-control" name="area"
                                        value="<?php echo e($dealerDetails->area); ?>" id="area" placeholder="Enter Area"
                                        required>
                                </div>

                                <div class="form-group col-md-3">
                                    <?php if($dealerDetails->tread_license): ?>
                                        <img src="<?php echo e(asset('uploads/tread_license/photo/' . $dealerDetails->tread_license)); ?>"
                                            height="80" width="80">
                                    <?php endif; ?>
                                    <label for="tread_license">Tread License <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="tread_license" id="tread_license">
                                </div>

                                <div class="form-group col-md-3">
                                    <?php if($dealerDetails->logo): ?>
                                        <img src="<?php echo e(asset('uploads/dealer-logo/photo/' . $dealerDetails->logo)); ?>"
                                            height="80" width="80"><br>
                                    <?php endif; ?>
                                    <label for="logo">Logo <small class="text-danger">(size: 300 * 300
                                            pixel)</small></label>
                                    <input type="file" class="form-control" name="logo" id="logo">
                                </div>
                                <div class="form-group col-md-3">
                                    <?php if($dealerDetails->other_business_id): ?>
                                        <div class="row">
                                            <?php $__currentLoopData = json_decode($dealerDetails->other_business_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-4">
                                                    <img src="<?php echo e(asset('uploads/other_business_id/' . $id)); ?>"
                                                        height="80" width="80"><br>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <label for="other_business_id">Other Business ID <small
                                            class="text-danger">(Multiple)</small></label>
                                    <input type="file" class="form-control" name="other_business_id[]"
                                        id="other_business_id" multiple>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php if($dealerDetails->nid): ?>
                                        <div class="row">
                                            <?php $__currentLoopData = json_decode($dealerDetails->nid); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-4">
                                                    <img src="<?php echo e(asset('uploads/nid/' . $nid)); ?>" height="80"
                                                        width="80"><br>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <label for="nid">NID <small class="text-danger">(Back & Front
                                            part.)</small></label>
                                    <input type="file" class="form-control" name="nid[]" id="nid" multiple>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="parent_id">Parent Dealers<small
                                            class="text-danger">(required)</small></label>
                                    <select name="parent_id" id="parent_id" class="form-control">
                                        <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($parent->id); ?>"
                                                <?php echo e($dealerDetails->parent_id == $parent->id ? 'selected' : ''); ?>>
                                                <?php echo e($parent->com_org_inst_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="can_sale_old_device">Can Sale Old Device<small
                                            class="text-danger ml-1">(Required)</small></label>
                                    <select name="can_sale_old_device" id="can_sale_old_device" class="form-control">
                                        <option value="0" <?php if($dealerDetails->can_sale_old_device == 0): ?> selected <?php endif; ?>>No
                                        </option>
                                        <option value="1" <?php if($dealerDetails->can_sale_old_device == 1): ?> selected <?php endif; ?>>Yes
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="com_address">Business Address</label>
                                    <textarea name="com_address" id="com_address" class="form-control" rows="1"><?php echo $dealerDetails->com_address; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>

                            <a href="<?php echo e(route('admin.child-dealers.show', $dealerDetails->id)); ?>"
                                class="pull-right btn btn-dark btn-sm" title="View">
                                <i class="fa fa-eye" aria-hidden="true"></i> View Details
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/child_dealers/edit.blade.php ENDPATH**/ ?>