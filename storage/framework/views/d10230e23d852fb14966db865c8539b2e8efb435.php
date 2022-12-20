<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?php echo e(route('admin.reports.mobile_diagnosis_report_update', $model)); ?>" id="edit_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Mobile Diagnosis Report Item Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.modal-header -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="text-muted">Customer & Device Info</small>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Customer Name: </b>

                                            <a class="d-inline-block">
                                                <?php echo e($model->customer->name); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Customer Phone: </b>

                                            <a class="d-inline-block">
                                                <?php echo e($model->customer->phone); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <?php if($model->customer->email): ?>
                                            <li class="list-group-item">
                                                <b>Customer Email: </b>

                                                <a class="d-inline-block">
                                                    <?php echo e($model->customer->email); ?>

                                                </a>
                                            </li>
                                            <!-- /.list-group-item -->
                                        <?php endif; ?>


                                        <li class="list-group-item">
                                            <b>Brand Name: </b>

                                            <a class="d-inline-block">
                                                <?php echo e(ucwords($model->model->brand->name)); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Model Name: </b>

                                            <a class="d-inline-block">
                                                <?php echo e(ucfirst($model->model->name)); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->


                                        <li class="list-group-item">
                                            <b>Serial: </b>

                                            <a class="d-inline-block">
                                                <?php echo e($model->serial_number); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>IMEI 1: </b>

                                            <a class="d-inline-block">
                                                <?php if(!empty($model->imei_data_id)): ?>
                                                    <?php echo e($model->imei->imei_1); ?>

                                                <?php else: ?>
                                                    <del>Not set</del>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Device Price: </b>

                                            <a class="d-inline-block">
                                                <?php echo e($model->price); ?>

                                                <?php echo e(config('settings.currency')); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Note: </b>

                                            <a class="d-inline-block">
                                                <?php echo e(ucfirst($model->note)); ?>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                    </ul>
                                    <!-- /.list-group  -->

                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <small class="text-muted">Parts List Status</small>
                                    <ul class="list-group">

                                        <li class="list-group-item">
                                            <b>Motherboard: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->motherboard_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->motherboard_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Battery Health: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->battery_health_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->battery_health_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Front Camera: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->front_camera_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->front_camera_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Back Camera: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->back_camera_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->back_camera_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->


                                        <li class="list-group-item">
                                            <b>Microphone: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->microphone_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->microphone_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>RAM: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->ram_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->ram_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>ROM: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->rom_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->rom_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Display Screen: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->display_screen_status == 1): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php if($model->display_screen_status == 1): ?>
                                                        Ok
                                                    <?php else: ?>
                                                        Not Ok
                                                    <?php endif; ?>
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <!--  Validiy Period -->
                                        <?php if(empty($model->validity_period)): ?>
                                            <li class="list-group-item">
                                                <b>
                                                    Validiy Period:
                                                </b>
                                                <a class="d-inline-block">
                                                    <del>Not set</del>
                                                </a>
                                            </li>
                                            <!-- /.list-group-item -->
                                        <?php else: ?>
                                            <li class="list-group-item">
                                                <?php
                                                    $validFor = is_expired($model->validity_period);
                                                ?>
                                                <b>
                                                    <?php echo e($validFor ? 'Valid For:' : ' Validiy Period:'); ?>

                                                </b>
                                                <a class="d-inline-block">
                                                    <span
                                                        class="badge <?php echo e($validFor ? 'badge-success' : 'badge-danger'); ?>">
                                                        <?php echo e($validFor ? $validFor . ' Minutes' : 'Expired'); ?>

                                                    </span>
                                                </a>
                                            </li>
                                            <!-- /.list-group-item -->
                                        <?php endif; ?>
                                        <!--  End: Validiy Period -->


                                        <li class="list-group-item">
                                            <b>Report Status: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge <?php if($model->status == 'pending'): ?> badge-warning <?php elseif($model->status == 'approved'): ?>  badge-success <?php else: ?> badge-danger <?php endif; ?>">
                                                    <?php echo e(ucfirst($model->status)); ?></span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->


                                    </ul>
                                    <!-- /.list-group  -->

                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <small class="text-muted">Modify Diagnosis Status</small>

                                    <div class="diagnosis_images">

                                        <?php if(!empty($model->invoice_image)): ?>
                                            <figure>
                                                <img src="<?php echo e($model->_invoice_image_path); ?>"
                                                    alt="imei_image_<?php echo e($model->id); ?>" />
                                                <figcaption>Invoice image</figcaption>
                                                <a href="<?php echo e(url($model->_invoice_image_path)); ?>" class="icon"
                                                    title="View Invoice Image" target="_blank">
                                                    <i class="fa fa-eye "></i>
                                                </a>
                                            </figure>
                                            <!-- /figure  -->
                                        <?php endif; ?>
                                        <?php if(!empty($model->_device_images_path)): ?>
                                            <?php $__currentLoopData = $model->_device_images_path; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $device_image_path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <figure>
                                                    <img src="<?php echo e($device_image_path); ?>"
                                                        alt="imei_image_<?php echo e(++$key); ?>" />
                                                    <figcaption>Device image - <?php echo e($key); ?></figcaption>
                                                    <a href="<?php echo e(url($device_image_path)); ?>" class="icon"
                                                        title="View Device Image" target="_blank">
                                                        <i class="fa fa-eye "></i>
                                                    </a>
                                                </figure>
                                                <!-- /figure  -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php if(!empty($model->imei_image)): ?>
                                            <figure>
                                                <img src="<?php echo e($model->_imei_image_path); ?>"
                                                    alt="imei_image_<?php echo e($model->id); ?>" />
                                                <figcaption>IMEI image</figcaption>
                                                <a href="<?php echo e(url($model->_imei_image_path)); ?>" class="icon"
                                                    title="View IMEI Image" target="_blank">
                                                    <i class="fa fa-eye "></i>
                                                </a>
                                            </figure>
                                            <!-- /figure  -->
                                        <?php endif; ?>
                                    </div>
                                    <!-- /.diagnosis_images  -->


                                    <?php if(empty($model->validity_period) || ($validFor = is_expired($model->validity_period))): ?>

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('post'); ?>

                                        <?php if(empty($model->imei_data_id)): ?>
                                            <div class="form-group">
                                                <input class="form-control" id="imei_1" name="imei_1"
                                                    placeholder="IMEI 1" required autofocus />
                                            </div>
                                            <!-- /form-group  -->


                                            <div class="form-group">
                                                <input class="form-control" id="imei_2" name="imei_2"
                                                    placeholder="IMEI 2" />
                                            </div>
                                            <!-- /form-group  -->
                                        <?php endif; ?>


                                        <div class="form-group">
                                            <label for="status">Change Status:</label>
                                            <select class="form-control" name="status" id="status">
                                                <?php if($model->status == 'pending'): ?>
                                                    <option value="pending"
                                                        <?php if($model->status == 'pending'): ?> selected <?php endif; ?>>
                                                        Pending
                                                    </option>
                                                <?php endif; ?>
                                                <option value="approved"
                                                    <?php if($model->status == 'approved'): ?> selected <?php endif; ?>>
                                                    Approved
                                                </option>
                                                <?php if($model->status != 'approved'): ?>
                                                    <option value="denied"
                                                        <?php if($model->status == 'denied'): ?> selected <?php endif; ?>>
                                                        Denied
                                                    </option>
                                                <?php endif; ?>

                                            </select>
                                        </div>


                                        <!-- /form-group  -->
                                        <div class="form-group">
                                            <label for="dealer_id">Commission Received By:</label>
                                            <select class="form-control" name="dealer_id" id="dealer_id">
                                                <?php $__currentLoopData = $childDealers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childDealer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($childDealer->id); ?>"
                                                        <?php if($model->dealer_id == $childDealer->id): ?> selected <?php endif; ?>>
                                                        <?php echo e(ucwords($childDealer->com_org_inst_name)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </select>
                                        </div>
                                        <!-- /form-group  -->


                                        <div class="form-group">
                                            <label for="note">Note:</label>
                                            <textarea class="form-control" id="note" name="note" placeholder="Write note" rows="2"><?php echo e($model->note); ?></textarea>
                                        </div>
                                        <!-- /form-group  -->


                                        <div class="form-group">
                                            <button type="Submit" class="btn btn-info btn-block">
                                                Save
                                            </button>
                                        </div>
                                        <!-- /form-group  -->
                                    <?php else: ?>
                                        <div class="alert alert-warning" role="alert">
                                            <h4>Report Expired</h4>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                    </div>
                </form>
                <!-- /form -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/reports/mobile_diagnosis_report/edit.blade.php ENDPATH**/ ?>