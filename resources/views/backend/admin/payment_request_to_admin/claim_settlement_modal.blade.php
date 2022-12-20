<div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make Settlement With Service Center</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.claimStatusChangeProcess', [$paymentRequestToAdminId, $deviceClaim]) }}"
                    method="POST">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="amount_will_pay_ins_provider">Provider pay amount</label>
                        <input class="form-control" type="text" name="amount_will_pay_ins_provider"
                            id="amount_will_pay_ins_provider"
                            value="{{ $deviceClaim->amount_will_pay_ins_provider . ' ' . config('settings.currency') }}"
                            readonly />
                    </div>
                    <div class="form-group">
                        <label for="settlement_amount">Settlement amount</label>
                        <input class="form-control" type="number" name="settlement_amount" id="settlement_amount"
                            step="any" />
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="approved" selected>Approved
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Payment Note</label>
                        <textarea class="form-control" name="message" id="message" rows="2" placeholder="Write your message"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
