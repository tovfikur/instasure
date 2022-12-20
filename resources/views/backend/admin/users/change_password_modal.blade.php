<div class="modal fade" id="password_change_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('admin.change_password_ajax', $user) }}" id="change_password_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change User Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.modal-header -->

                    <div class="card">
                        <div class="card-body">

                            @csrf
                            @method('post')
                            <div class="form-group row">
                                <label for="user_type" class="col-sm-4 col-form-label">User Type</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="user_type"
                                        value="{{ ucwords(str_remove_dashes_custom($user->user_type)) }}">
                                </div>
                            </div>
                            <!-- /form-group  -->

                            <div class="form-group row">
                                <label for="name" class="col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="name"
                                        value="{{ ucwords(str_remove_dashes_custom($user->name)) }}">
                                </div>
                            </div>
                            <!-- /form-group  -->

                            <div class="form-group row">
                                <label for="phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control" id="phone"
                                        value="{{ ucwords(str_remove_dashes_custom($user->phone)) }}">
                                </div>
                            </div>
                            <!-- /form-group  -->


                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">New Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <!-- /form-group  -->


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                        <button type="Submit" class="btn btn-info">
                            Save
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
