<div class="modal fade modal_window" id="create_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">Collection Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->

                <form method="post" enctype="multipart/form-data" class="mt-2" id="create_form"
                    action="{{ route('admin.due_balance_collection_store') }}">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="dealer_id" class="col-md-4 col-form-label">
                            Dealer
                        </label>
                        <div class="col-md-8">
                            <select name="dealer_id" id="dealer_id" class="form-control select2" style="width: 100%;"
                                required>
                                <option selected disabled>Select Dealer</option>
                                @if (isset($dealers) && count($dealers))
                                    @foreach ($dealers as $dealer)
                                        <option value="{{ $dealer->id }}">{{ $dealer->com_org_inst_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group row">
                        <label for="collected_amount" class="col-md-4 col-form-label">Collected Amount</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="collected_amount" name="collected_amount"
                                min="1" step="any" />
                        </div>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group row">
                        <label for="collection_date" class="col-md-4 col-form-label">Collection Date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" id="collection_date" name="collection_date" />
                        </div>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group row">
                        <label for="document" class="col-md-4 col-form-label">Document</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" id="document" name="document" />
                        </div>
                    </div>
                    <!-- /.form-group -->


                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                    </div>
                    <!-- /.form-group -->


                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="btn_store" ">Save</button>
                    </div>
                    <!-- /.modal -->
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
