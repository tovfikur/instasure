<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('admin.reports.mobile_diagnosis_report_update', $model) }}" id="edit_form">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Mobile Diagnosis Report Item Details
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- /.modal-header -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <small class="text-muted">Customer & Device Info</small>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <b>Customer Name: </b>

                                            <a class="d-inline-block">
                                                {{ $model->customer->name }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Customer Phone: </b>

                                            <a class="d-inline-block">
                                                {{ $model->customer->phone }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        @if ($model->customer->email)
                                            <li class="list-group-item">
                                                <b>Customer Email: </b>

                                                <a class="d-inline-block">
                                                    {{ $model->customer->email }}
                                                </a>
                                            </li>
                                            <!-- /.list-group-item -->
                                        @endif


                                        <li class="list-group-item">
                                            <b>Brand Name: </b>

                                            <a class="d-inline-block">
                                                {{ ucwords($model->model->brand->name) }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Model Name: </b>

                                            <a class="d-inline-block">
                                                {{ ucfirst($model->model->name) }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->


                                        <li class="list-group-item">
                                            <b>Serial: </b>

                                            <a class="d-inline-block">
                                                {{ $model->serial_number }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>IMEI 1: </b>

                                            <a class="d-inline-block">
                                                @if (!empty($model->imei_data_id))
                                                    {{ $model->imei->imei_1 }}
                                                @else
                                                    <del>Not set</del>
                                                @endif
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Device Price: </b>

                                            <a class="d-inline-block">
                                                {{ $model->price }}
                                                {{ config('settings.currency') }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Note: </b>

                                            <a class="d-inline-block">
                                                {{ ucfirst($model->note) }}
                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                    </ul>
                                    <!-- /.list-group  -->

                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <small class="text-muted">Parts List Status</small>
                                    <ul class="list-group">

                                        <li class="list-group-item">
                                            <b>Motherboard: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->motherboard_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->motherboard_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Battery Health: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->battery_health_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->battery_health_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Front Camera: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->front_camera_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->front_camera_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Back Camera: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->back_camera_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->back_camera_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->


                                        <li class="list-group-item">
                                            <b>Microphone: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->microphone_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->microphone_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>RAM: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->ram_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->ram_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>ROM: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->rom_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->rom_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <b>Display Screen: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->display_screen_status == 1) badge-success @else badge-danger @endif">
                                                    @if ($model->display_screen_status == 1)
                                                        Ok
                                                    @else
                                                        Not Ok
                                                    @endif
                                                </span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->

                                        <!--  Validiy Period -->
                                        @if (empty($model->validity_period))
                                            <li class="list-group-item">
                                                <b>
                                                    Validiy Period:
                                                </b>
                                                <a class="d-inline-block">
                                                    <del>Not set</del>
                                                </a>
                                            </li>
                                            <!-- /.list-group-item -->
                                        @else
                                            <li class="list-group-item">
                                                @php
                                                    $validFor = is_expired($model->validity_period);
                                                @endphp
                                                <b>
                                                    {{ $validFor ? 'Valid For:' : ' Validiy Period:' }}
                                                </b>
                                                <a class="d-inline-block">
                                                    <span
                                                        class="badge {{ $validFor ? 'badge-success' : 'badge-danger' }}">
                                                        {{ $validFor ? $validFor . ' Minutes' : 'Expired' }}
                                                    </span>
                                                </a>
                                            </li>
                                            <!-- /.list-group-item -->
                                        @endif
                                        <!--  End: Validiy Period -->


                                        <li class="list-group-item">
                                            <b>Report Status: </b>

                                            <a class="d-inline-block">
                                                <span
                                                    class="badge @if ($model->status == 'pending') badge-warning @elseif ($model->status == 'approved')  badge-success @else badge-danger @endif">
                                                    {{ ucfirst($model->status) }}</span>

                                            </a>
                                        </li>
                                        <!-- /.list-group-item -->


                                    </ul>
                                    <!-- /.list-group  -->

                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <small class="text-muted">Modify Diagnosis Status</small>

                                    <div class="diagnosis_images">

                                        @if (!empty($model->invoice_image))
                                            <figure>
                                                <img src="{{ $model->_invoice_image_path }}"
                                                    alt="imei_image_{{ $model->id }}" />
                                                <figcaption>Invoice image</figcaption>
                                                <a href="{{ url($model->_invoice_image_path) }}" class="icon"
                                                    title="View Invoice Image" target="_blank">
                                                    <i class="fa fa-eye "></i>
                                                </a>
                                            </figure>
                                            <!-- /figure  -->
                                        @endif
                                        @if (!empty($model->_device_images_path))
                                            @foreach ($model->_device_images_path as $key => $device_image_path)
                                                <figure>
                                                    <img src="{{ $device_image_path }}"
                                                        alt="imei_image_{{ ++$key }}" />
                                                    <figcaption>Device image - {{ $key }}</figcaption>
                                                    <a href="{{ url($device_image_path) }}" class="icon"
                                                        title="View Device Image" target="_blank">
                                                        <i class="fa fa-eye "></i>
                                                    </a>
                                                </figure>
                                                <!-- /figure  -->
                                            @endforeach
                                        @endif
                                        @if (!empty($model->imei_image))
                                            <figure>
                                                <img src="{{ $model->_imei_image_path }}"
                                                    alt="imei_image_{{ $model->id }}" />
                                                <figcaption>IMEI image</figcaption>
                                                <a href="{{ url($model->_imei_image_path) }}" class="icon"
                                                    title="View IMEI Image" target="_blank">
                                                    <i class="fa fa-eye "></i>
                                                </a>
                                            </figure>
                                            <!-- /figure  -->
                                        @endif
                                    </div>
                                    <!-- /.diagnosis_images  -->


                                    @if (empty($model->validity_period) || ($validFor = is_expired($model->validity_period)))

                                        @csrf
                                        @method('post')

                                        @if (empty($model->imei_data_id))
                                            <div class="form-group">
                                                <input class="form-control" id="imei_1" name="imei_1"
                                                    placeholder="IMEI 1" required autofocus />
                                            </div>
                                            <!-- /form-group  -->


                                            <div class="form-group">
                                                <input class="form-control" id="imei_2" name="imei_2"
                                                    placeholder="IMEI 2" />
                                            </div>
                                            <!-- /form-group  -->
                                        @endif


                                        <div class="form-group">
                                            <label for="status">Change Status:</label>
                                            <select class="form-control" name="status" id="status">
                                                @if ($model->status == 'pending')
                                                    <option value="pending"
                                                        @if ($model->status == 'pending') selected @endif>
                                                        Pending
                                                    </option>
                                                @endif
                                                <option value="approved"
                                                    @if ($model->status == 'approved') selected @endif>
                                                    Approved
                                                </option>
                                                @if ($model->status != 'approved')
                                                    <option value="denied"
                                                        @if ($model->status == 'denied') selected @endif>
                                                        Denied
                                                    </option>
                                                @endif

                                            </select>
                                        </div>


                                        <!-- /form-group  -->
                                        <div class="form-group">
                                            <label for="dealer_id">Commission Received By:</label>
                                            <select class="form-control" name="dealer_id" id="dealer_id">
                                                @foreach ($childDealers as $childDealer)
                                                    <option value="{{ $childDealer->id }}"
                                                        @if ($model->dealer_id == $childDealer->id) selected @endif>
                                                        {{ ucwords($childDealer->com_org_inst_name) }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <!-- /form-group  -->


                                        <div class="form-group">
                                            <label for="note">Note:</label>
                                            <textarea class="form-control" id="note" name="note" placeholder="Write note" rows="2">{{ $model->note }}</textarea>
                                        </div>
                                        <!-- /form-group  -->


                                        <div class="form-group">
                                            <button type="Submit" class="btn btn-info btn-block">
                                                Save
                                            </button>
                                        </div>
                                        <!-- /form-group  -->
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            <h4>Report Expired</h4>
                                        </div>
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
