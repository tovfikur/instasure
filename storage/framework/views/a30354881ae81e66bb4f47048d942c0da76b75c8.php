<div class="modal fade" id="view_details_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->

                <div class="card">
                    <div class="card-body">

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>User type: </b>
                                <a class="float-right">
                                    <?php echo e(ucwords(str_remove_dashes_custom($user->user_type))); ?>

                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Full name: </b>
                                <a class="float-right"><?php echo e($user->name); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone: </b>
                                <a class="float-right"><?php echo e($user->phone); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email: </b>
                                <a class="float-right"><?php echo e($user->email); ?></a>
                            </li>

                            <li class="list-group-item">
                                <b>Joined at: </b>
                                <a class="float-right"><?php echo e($user->created_at); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Address: </b>
                                <a class="float-right"><?php echo e($user->address); ?></a>
                            </li>

                        </ul>

                        <!-- /.list-group -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php /**PATH /var/www/html/instaweb/resources/views/backend/admin/users/user_details_modal.blade.php ENDPATH**/ ?>