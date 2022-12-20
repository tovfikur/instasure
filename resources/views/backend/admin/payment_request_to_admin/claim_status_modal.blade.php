<div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Manage Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.claimStatusChangeProcess', [$paymentRequestToAdminId, $deviceClaim]) }}"
                    method="POST">
                    @csrf
                    @method('post')
                    @if ($deviceClaim->payment_status_admin == 'pending')
                        @php
                            $status = $deviceClaim->payment_status_admin;
                        @endphp
                        <div class="form-group">
                            <label for="status">Select Payment Status</label>
                            <select name="status" id="status" class="form-control">
                                {{-- <option value="paid" @if ($status == 'paid') selected @endif>
                                    Paid
                                </option> --}}
                                <option value="approved" @if ($status == 'approved') selected @endif>
                                    Approved
                                </option>
                                <option value="rejected" @if ($status == 'rejected') selected @endif>
                                    Rejected
                                </option>
                                <option value="pending" @if ($status == 'pending') selected @endif>
                                    Pending
                                </option>
                            </select>
                        </div>
                    @elseif($deviceClaim->payment_status_admin == 'rejected')
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="rejected" selected>Rejected
                                </option>
                            </select>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="approved" selected>Approved
                                </option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="message">Payment Note</label>
                        <textarea class="form-control" name="message" id="message" rows="5" placeholder="Write your message"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
