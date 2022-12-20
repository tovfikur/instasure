<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('admin.commission_withdraw_request_update', $insuranceWithdrawRequest) }}"
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
                                        $user = $insuranceWithdrawRequest->parent;
                                        $name = $user->name;
                                        $dealer = $insuranceWithdrawRequest->parent->dealer;
                                        $dealer_balance = $dealer->dealer_balance;
                                    @endphp
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Dealer Name: </b>

                                            <a class="d-inline-block">
                                                {{ $name }}
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
                                                {{ $insuranceWithdrawRequest->status }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item  -->
                                        <li class="list-group-item">
                                            <b>Parent Note: </b>
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

                                    <div class="form-group">
                                        <label for="status">Withdraw Amount:</label>
                                        <input class="form-control" type="text"
                                            value="{{ $insuranceWithdrawRequest->amount }} {{ config('settings.currency') }}"
                                            readonly />
                                    </div>
                                    <!-- /form-group  -->

                                    <div class="form-group">
                                        <label for="status">Withdraw Date:</label>
                                        <input class="form-control" type="text"
                                            value="{{ date_format_custom($insuranceWithdrawRequest->created_at, 'd M, Y') }}"
                                            readonly />
                                    </div>
                                    <!-- /form-group  -->

                                    @isset($insuranceWithdrawRequest->paid_date)
                                        <div class="form-group">
                                            <label for="status">Paid on:</label>
                                            <input class="form-control" type="text"
                                                value="{{ date_format_custom($insuranceWithdrawRequest->paid_date, 'd M, Y') }}"
                                                readonly />
                                        </div>
                                        <!-- /form-group  -->
                                    @endisset
                                    @if (strtolower($insuranceWithdrawRequest->status) == 'pending')
                                        <div class="form-group">
                                            <label for="status">Payment Status:</label>
                                            <select class="form-control" name="status" id="status">

                                                <option value="pending"
                                                    @if (strtolower($insuranceWithdrawRequest->status) == 'pending') selected @endif>
                                                    Pending</option>

                                                <option value="paid"
                                                    @if (strtolower($insuranceWithdrawRequest->status) == 'paid') selected @endif>
                                                    Paid</option>
                                            </select>
                                        </div>
                                        <!-- /form-group  -->

                                        <div class="form-group">
                                            <label for="message">Note:</label>
                                            <textarea class="form-control" id="message" name="message" placeholder="Write note"></textarea>
                                        </div>
                                        <!-- /form-group  -->


                                        <div class="form-group">
                                            <button type="Submit" class="btn btn-info btn-block">
                                                Save
                                            </button>
                                        </div>
                                        <!-- /form-group  -->
                                    @endif

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
