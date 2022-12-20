<form wire:submit.prevent="claimSubmit" method="post" enctype="multipart/form-data">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title float-left">Insurance Claim Form</h3>
        </div>
        <!-- /.card-header -->
        @if (count($details))
            <div class="card-body">
                @csrf
                <!-- Start: Parts details -->

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="images">Images</label>
                        <input type="file" class="form-control" wire:model="images" id="images" multiple required>
                        <small class="form-text text-muted">
                            Upload Images of Damaged Phone
                        </small>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="protection_type">Choose Insurance Type</label>
                        <select wire:model="deviceInsuranceDetails_id" name="deviceInsuranceDetails_id"
                            id="protection_type" class="form-control form-control-md">
                            @foreach ($details as $data)
                                <option value="{{ $data['id'] }}"> {{ $data['parts_type'] }}
                                </option>
                            @endforeach
                        </select>
                        @if ($protection_times_for)
                            <small class="form-text text-muted">
                                Screen Protection Available For '<b>{{ $protection_times_for }}</b>' Times
                            </small>
                        @endif
                        @if ($claim_amount)
                            <small class="form-text text-muted">
                                You Can Claim For '<b>{{ $claim_amount }}</b>' Taka
                            </small>
                        @endif
                        @if ($insuranceTypeError)
                            <small class="form-text text-danger">
                                Please Choose Insurance Type
                            </small>
                        @endif
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brands">Brand</label>
                        <input class="form-control" type="text" value="{{ $brand_name }}" readonly />
                        <small class="form-text text-muted">
                            Brand can't be changed
                        </small>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brands">Model</label>
                        <input class="form-control" type="text" value="{{ $model_name }}" readonly />
                        <small class="form-text text-muted">
                            Model can't be changed
                        </small>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="comments">Comments</label>
                        <textarea wire:model.debounce.500ms="status_note" class="form-control" id="comments" rows="1"></textarea>

                    </div>


                    @isset($parts)
                        @if (count($parts))
                            <!-- when parts avaiable -->
                            <div class="form-group col-md-6">
                                <div class="card card-success card-outline">
                                    <h5 class="card-header">All available parts</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="parts">Parts list
                                                    @if ($partsError)
                                                        {{ $partsError }}
                                                    @endif

                                                </label>
                                                <select wire:model="selectedPartsId" id="parts"
                                                    class="form-control form-control-md" required>

                                                    @foreach ($parts as $data)
                                                        <option value="{{ $data->id }}" data-id="{{ $data->id }}">
                                                            {{ $data->parts_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <button class="btn btn-outline-primary btn-md form-control" type="button"
                                                    wire:click="addNew">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->



                            </div>
                            <div class="form-group col-md-6">
                                <div class="card card-primary card-outline">
                                    <h5 class="card-header">Do you need new parts?</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="parts">
                                                    New parts name
                                                    @if ($new_parts_name_error)
                                                        <span class="text-danger ml-1">{{ $new_parts_name_error }}</span>
                                                    @endif

                                                </label>
                                                <input class="form-control" type="text"
                                                    wire:model.debounce.500ms="new_parts_name"
                                                    value="{{ $new_parts_name }}"
                                                    placeholder="Please add your new parts name" />
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-12">
                                                <label for="parts">Parts note</label>
                                                <input class="form-control" type="text" wire:model.debounce.500ms="note"
                                                    value="{{ $note }}" placeholder="Write your comments" />
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-12 mt-2">
                                                <button class="btn btn-secondary btn-md form-control" type="button"
                                                    wire:click="new_parts_request_to_admin">New Parts Request to
                                                    Admin</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.form-group -->
                            <!-- End:when parts avaiable -->
                        @else
                            <div class="form-group col-md-5">
                                <label for="parts">
                                    New parts name
                                    @if ($new_parts_name_error)
                                        <span class="text-danger ml-1">{{ $new_parts_name_error }}</span>
                                    @endif
                                </label>
                                <input class="form-control" type="text" wire:model.debounce.500ms="new_parts_name"
                                    value="{{ $new_parts_name }}" placeholder="Please add your new parts name" />
                            </div>
                            <div class="form-group col-md-5">
                                <label for="parts">Parts note</label>
                                <input class="form-control" type="text" wire:model.debounce.500ms="note"
                                    value="{{ $note }}" placeholder="Please write your comment" />
                            </div>
                            @if ($new_parts_name)
                                <div class="form-group col-md-2">
                                    <button class="btn btn-outline-primary btn-md form-control" type="button"
                                        wire:click="new_parts_request_to_admin" style="margin-top:32px;">Request to
                                        Admin</button>
                                </div>
                            @endif
                        @endif
                    @endisset


                </div>

                @if (count($selected_parts_list))
                    @foreach ($selected_parts_list as $key => $item)
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="parts_name">Spare Parts Names</label>
                                <input type="text" class="form-control" value="{{ $item['parts_name'] }}" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="parts_price">Spare Parts Price</label>
                                <input type="number" class="form-control" value="{{ $item['parts_price'] }}"
                                    readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="full_name">Spare Parts Serial No</label>
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="selected_parts_list.{{ $key }}.parts_identity_number" />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="full_name">Spare Parts Serial Details</label>
                                <input type="text" class="form-control"
                                    wire:model.debounce.500ms="selected_parts_list.{{ $key }}.parts_details">
                            </div>
                            <div class="col-md-1" style="margin-top: 34px">
                                <a wire:click.prevent="removeItem({{ $key }})"
                                    class="btn btn-sm btn-danger text-white" title="Delete Item">
                                    <i class=" fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
                <!-- End: Parts details -->
            </div>

            <!-- /.card-body -->
            <div class="card-footer">

                <span class="h4">
                    Total Amount:
                    <span class="badge badge-info">
                        {{ $totalAmount }}
                    </span>
                </span>

                <button class="btn btn-primary mt-2 pull-right" type="submit">Apply</button>
            </div>
            <!-- /.card-footer -->
        @else
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    You are not eligible for this service
                </div>
            </div>
        @endif
    </div>
    <!-- /.card -->
</form>
<!-- /form-->
