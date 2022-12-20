<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form
                    action="{{ route('parentDealer.child_commission_withdraw_request_update', $insuranceWithdrawRequest) }}"
                    id="edit_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Commission Withdraw Request Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.modal-header -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @php
                                        $child = $insuranceWithdrawRequest->user->dealer;
                                        $child_dealer_name = $child->com_org_inst_name;
                                        $dealer_balance = $child->dealer_balance;
                                    @endphp
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Child Dealer Name: </b>

                                            <a class="d-inline-block">
                                                {{ $child_dealer_name }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->

                                        <li class="list-group-item">
                                            <b>Commission Balance:</b>
                                            <a class="d-inline-block">
                                                {{ $dealer_balance }}
                                                {{ config('settings.currency') }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->


                                        <li class="list-group-item">
                                            <b>Status: </b>
                                            <a class="d-inline-block">
                                                @php
                                                    $status = strtolower($insuranceWithdrawRequest->status);
                                                @endphp

                                                <span
                                                    class="badge @if ($status == 'paid') badge-success @else badge-warning @endif ">
                                                    {{ ucfirst($status) }}
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->


                                        <li class="list-group-item">
                                            <b>Withdraw Amount: </b>
                                            <a class="d-inline-block">
                                                {{ $insuranceWithdrawRequest->amount }}
                                                {{ config('settings.currency') }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->

                                        <li class="list-group-item">
                                            <b>Withdraw Date: </b>
                                            <a class="d-inline-block">
                                                {{ date_format_custom($insuranceWithdrawRequest->created_at, 'd M, Y') }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->

                                        <li class="list-group-item">
                                            <b>Status Note: </b>
                                            <a class="d-inline-block">
                                                {{ ucfirst(strip_tags($insuranceWithdrawRequest->message)) }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->

                                        <li class="list-group-item">
                                            <b>Banking Details: </b>
                                            <a class="d-inline-block">
                                                {{ $insuranceWithdrawRequest->account_details() }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->

                                    </ul>
                                    <!-- /.list-group  -->

                                </div>
                                <!-- /.col -->
                                <div class="col-md-5 offset-md-1">

                                    @csrf
                                    @method('post')


                                    @isset($insuranceWithdrawRequest->paid_date)
                                        <div class="form-group">
                                            <label for="status">Paid on:</label>
                                            <input class="form-control" type="text"
                                                value="{{ date_format_custom($insuranceWithdrawRequest->paid_date, 'd M, Y') }}"
                                                readonly />
                                        </div>
                                        <!-- /form-group  -->
                                    @endisset
                                    @php
                                        $status = strtolower($insuranceWithdrawRequest->status);
                                    @endphp
                                    <div class="form-group">
                                        <label for="status">Payment Status:</label>
                                        <select class="form-control" name="status" id="status">
                                            @if ($status == 'pending')
                                                <option value="pending"
                                                    @if ($status == 'pending') selected @endif>
                                                    Pending</option>
                                            @endif
                                            <option value="paid" @if ($status == 'paid') selected @endif>
                                                Paid</option>

                                        </select>
                                    </div>
                                    <!-- /form-group  -->


                                    <div class="form-group">
                                        <label for="message">Note:</label>
                                        <textarea class="form-control" id="message" name="message" placeholder="Write note">{{ $insuranceWithdrawRequest->message }}</textarea>
                                    </div>
                                    <!-- /form-group  -->


                                    <div class="form-group">
                                        <button type="Submit" class="btn btn-info btn-block">
                                            Save
                                        </button>
                                    </div>
                                    <!-- /form-group  -->


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
