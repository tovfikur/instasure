<div class="modal fade" id="create_modal" tabindex="-1" aria-labelledby="create_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="device_insurance_find_form" action="{{ route('collection_center.find_device_insurance') }}"
                    method="POST">

                    <div class="modal-header pl-0 ">
                        <h5>Find Device Insurance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.modal-header -->

                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="search_type">Search Type</label>
                        <select class="form-control" id="search_type" name="search_type">
                            <option value="policy" selected>Policy Number</option>
                            <option value="imei">IMEI Number</option>
                            <option value="mobile">Customer Mobile Number</option>
                        </select>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label for="search_value">Value</label>
                        <input type="text" class="form-control" name="search_value" id="search_value" />
                    </div>
                    <!-- /.form-group -->

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                    <!-- /.modal-footer -->
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
