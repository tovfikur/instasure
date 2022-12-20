<form wire:submit.prevent="claimSubmit" method="post" enctype="multipart/form-data">
    <div class="card card-info card-outline">
        @if (count($deviceInsuranceDetails))
            <div class="card-body">
                @csrf
                <!-- Start: Parts details -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="images" class="col-md-4">Images</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control" wire:model="images" id="images" multiple>
                                <small class="form-text text-muted">
                                    Upload Images of Damaged Phone
                                </small>
                            </div>
                        </div>
                        <!-- /.form-group  -->

                        <div class="form-group row">
                            <label for="protection_type" class="col-md-4">Choose Insurance Type</label>
                            <div class="col-md-8">
                                <select wire:model="deviceInsuranceDetails_id" name="deviceInsuranceDetails_id"
                                    id="protection_type" class="form-control form-control-md">
                                    @foreach ($deviceInsuranceDetails as $data)
                                        <option value="{{ $data['id'] }}"> {{ $data['parts_type'] }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- @if ($protection_times_for)
                                    <small class="form-text text-muted">
                                        Screen Protection Available For '<b>{{ $protection_times_for }}</b>' Times
                                    </small>
                                @endif --}}
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
                        </div>
                        <!-- /.form-group  -->

                        <div class="form-group row">
                            <label for="brands" class="col-md-4">Brand</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="{{ $brand_name }}" readonly />
                                <small class="form-text text-muted">
                                    Brand can't be changed
                                </small>
                            </div>
                        </div>
                        <!-- /.form-group  -->

                        <div class="form-group row">
                            <label for="brands" class="col-md-4">Model</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="{{ $model_name }}" readonly />
                                <small class="form-text text-muted">
                                    Model can't be changed
                                </small>
                            </div>
                        </div>
                        <!-- /.form-group  -->


                    </div>
                    <!-- /.col  -->

                    <div class="col-md-5 offset-md-1">

                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea wire:model.debounce.500ms="status_note" class="form-control" id="comments" rows="1"></textarea>
                        </div>
                        <!-- /.form-group  -->

                        @isset($parts)
                            @if (count($parts))
                                <!-- when parts avaiable -->
                                <div class="form-group">
                                    <label for="parts">
                                        Available Parts list
                                        @if ($partsError)
                                            {{ $partsError }}
                                        @endif

                                    </label>
                                    <select wire:model="selectedPartsId" id="parts" class="form-control form-control-md"
                                        required>

                                        @foreach ($parts as $data)
                                            <option value="{{ strtolower($data->parts_name) }}"
                                                data-id="{{ $data->id }}">
                                                {{ $data->parts_name }}</option>
                                        @endforeach
                                    </select>

                                    <button class="btn btn-outline-primary btn-md form-control mt-3" type="button"
                                        wire:click="addNew">Add</button>

                                </div>
                                <!-- /.form-group  -->
                            @endif
                        @endisset
                    </div>
                    <!-- /.col  -->
                </div>
                <!-- /.row  -->

                <div class="card card-info card-outline">

                    <div class="card-body">
                        @if (count($selected_parts_list))
                            @foreach ($selected_parts_list as $key => $item)
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="parts_name">Spare Parts Names</label>
                                        <input type="text" class="form-control" value="{{ $item['parts_name'] }}"
                                            readonly>
                                    </div>
                                    <!-- /.col -->
                                    <div class="form-group col-md-2">
                                        <label for="parts_price">Spare Parts Price</label>
                                        <input type="number" class="form-control" value="{{ $item['parts_price'] }}"
                                            readonly>
                                    </div>
                                    <!-- /.col -->
                                    <div class="form-group col-md-3">
                                        <label for="full_name">Spare Parts Serial No</label>
                                        <input type="text" class="form-control"
                                            wire:model.debounce.500ms="selected_parts_list.{{ $key }}.parts_identity_number" />
                                    </div>
                                    <!-- /.col -->
                                    <div class="form-group col-md-3">
                                        <label for="full_name">Spare Parts Serial Details</label>
                                        <input type="text" class="form-control"
                                            wire:model.debounce.500ms="selected_parts_list.{{ $key }}.parts_details">
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-1" style="margin-top: 34px">
                                        <a wire:click.prevent="removeItem('{{ $key }}')"
                                            class="btn btn-sm btn-danger text-white" title="Delete Item">
                                            <i class=" fa fa-times"></i>
                                        </a>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            @endforeach
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
