<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status Manage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    action="{{ route('parentDealer.device-insurance.withdraw-request.change_request_status', $id) }}"
                    method="post" enctype="multipart/form">
                    @csrf
                    <div class="form-group">
                        <label for="">Select Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="processing">On processing</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
