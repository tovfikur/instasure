<div class="modal fade" id="changeStatusModal" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw_payment_request_from_parent_dealer_status_update', $id) }}"
                    method="POST">
                    @csrf
                    @method('post')
                    @if ($payment_request_admin->status != 'paid')
                        <div class="form-group">
                            <label for="status">Select Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" @if ($status == 'pending') selected @endif>Pending
                                </option>
                                <option value="paid" @if ($status == 'paid') selected @endif>Paid</option>
                            </select>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="paid" @if ($status == 'paid') selected @endif>Paid</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="5" placeholder="Write your message"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
