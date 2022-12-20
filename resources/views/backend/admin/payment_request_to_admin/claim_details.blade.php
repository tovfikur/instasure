<div class="modal fade" id="claimDetailsModal" tabindex="-1" aria-labelledby="statusModel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Claim information on service charge withdraw request
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-sm-4">
                            <!-- Customer imformations -->
                            <h3 class="card-title">
                                Basic imformations
                            </h3>
                            <hr>
                            <ul class="list-group">
                                <li>
                                    <strong>Customer Name: </strong>
                                    {{ $deviceClaim->user->name }}
                                </li>
                                <li>
                                    <strong>Customer Phone: </strong>
                                    {{ $deviceClaim->user->phone }}
                                </li>
                                <li>
                                    <strong>Customer Email: </strong>
                                    {{ $deviceClaim->user->email }}
                                </li>
                                <li>
                                    <strong>Claimed At: </strong>
                                    {{ dateFormat($deviceClaim->created_at) }}
                                </li>
                                <li>
                                    <strong>Claim Status: </strong>
                                    <span class="badge badge-info"> {{ $deviceClaim->status }}</span>
                                </li>
                            </ul>
                            <!-- Emd Customer imformations -->
                        </div>
                        <div class="col-sm-4">
                            <!-- Claim details -->
                            <h3 class="card-title">
                                Claim details
                            </h3>
                            <hr>
                            <ul class="list-group">
                                <li>
                                    <strong>Claim ID: </strong>
                                    {{ $deviceClaim->claim_id }}

                                </li>
                                <li>
                                    <strong>Device Price: </strong>
                                    {{ $deviceClaim->device_value }}
                                    {{ config('settings.currency') }}
                                </li>
                                <li>
                                    <strong>Provider will pay: </strong>
                                    {{ $deviceClaim->amount_will_pay_ins_provider }}
                                    {{ config('settings.currency') }}
                                </li>
                                @if ($deviceClaim->settlement_amount != 0 && $deviceClaim->settlement_amount != $deviceClaim->amount_will_pay_ins_provider)
                                    <li>
                                        <strong>Settled amount: </strong>
                                        <span class="badge badge-primary">
                                            {{ $deviceClaim->settlement_amount }}
                                            {{ config('settings.currency') }}
                                        </span>
                                    </li>
                                @endif

                                @if ($deviceClaim->status_note)
                                    <li>
                                        <strong>Settlement note: </strong>
                                        <span class="badge badge-primary">
                                            {{ $deviceClaim->status_note }}
                                        </span>
                                    </li>
                                @endif

                                <li>
                                    <strong>Claimed On: </strong>
                                    {{ $deviceClaim->claim_on }}
                                </li>
                                <li>
                                    <strong>Payment Status: </strong>
                                    {{ $deviceClaim->status }}

                                </li>
                            </ul>
                            <!-- Emd Claim details -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <!-- Service center details -->
                            <h3 class="card-title">
                                Sevice center details
                            </h3>
                            <hr>
                            <ul class="list-group">
                                <li>
                                    <strong>Name: </strong>
                                    {{ ucwords($deviceClaim->service_center->service_center_name) }}
                                </li>
                                <li>
                                    <strong>Address: </strong>
                                    {{ ucwords($deviceClaim->service_center->address) }}
                                </li>
                                <li>
                                    <strong>Mhone: </strong>
                                    {{ ucwords($deviceClaim->service_center->contact_person_phone) }}
                                </li>
                                <li>
                                    <strong>Email: </strong>
                                    {{ strtolower($deviceClaim->service_center->contact_person_email) }}
                                </li>
                            </ul>
                            <!-- Service center details -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <h6 class="text-center bg-info p-1 mt-2">Parts Details</h6>

                    <!-- Parts details -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Parts name</th>
                                    <th scope="col">Parts Price </th>
                                    <th scope="col">Identity Number</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @foreach ($deviceClaim->device_claimed_parts as $parts)
                                    <tr>
                                        <th scope="row">{{ $serial++ }}</th>
                                        <td>{{ $parts->parts_name }}</td>
                                        <td>
                                            {{ $parts->parts_price }}
                                            {{ config('settings.currency') }}
                                        </td>
                                        <td>{{ $parts->parts_identity_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- End Parts details -->
                </div>
                <!-- /.card-body -->

            </div>
        </div>
    </div>
</div>
