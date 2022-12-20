<div class="modal fade" id="settlement_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Settlement Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    action="{{ route('admin.partial_payment_by_admin_with_settlement_form_updaing', $device_claim->id) }}"
                    method="POST" class="mt-2" id="edit_form" data-device_claim_id="{{ $device_claim->id }}">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="status" class="col-md-4">Service Center</label>
                        <div class="col-md-8">
                            <input type="text" readonly class="form-control"
                                value="{{ $service_center->service_center_name }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-md-4">Claim ID</label>
                        <div class="col-md-8">
                            <input type="text" readonly class="form-control"
                                value="{{ $device_claim->claim_id }}" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-4" for="status">Device value</label>
                        <div class="col-md-8">
                            <input type="text" readonly class="form-control"
                                value="{{ $device_claim->device_value }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4" for="status">Provider will pay</label>
                        <div class="col-md-8">
                            <input type="text" readonly class="form-control"
                                value="{{ $device_claim->amount_will_pay_ins_provider }}" />
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-4" for="settlement_amount">Settlement Amount</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="settlement_amount" id="settlement_amount"
                                step="any" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4" for="status_note">Message</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="status_note" id="status_note" rows="2"
                                placeholder="Write your message"></textarea>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="btn_store" ">Save</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
