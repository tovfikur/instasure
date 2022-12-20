<div class="modal fade modal_window" id="parts_edit_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">Edit parts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form" class="mt-2" id="parts_edit_form"
                    action="{{ route('admin.parts.update', $parts) }}">
                    @csrf
                    @method('put')
                    <div class="form-group row">
                        <label for="parts_name" class="col-md-4 col-form-label">Parts Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="parts_name" name="parts_name"
                                placeholder="Parts name" value="{{ $parts->parts_name }}" required />

                            <small id="name_help_block" class="form-text text-danger d-none ">
                                Parts name required
                            </small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="parts_price" class="col-md-4 col-form-label">Parts price</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" id="parts_price" name="parts_price"
                                placeholder="Parts price" value="{{ $parts->parts_price }}" required step="any" />
                            <small id="parts_price_help_block" class="form-text text-danger d-none">
                                Parts price required, must be unique and max length 60 characters
                            </small>
                        </div>
                    </div>


                    @if (isset($brands) && count($brands))
                        <div class="form-group row">
                            <label for="brand_id" class="col-md-4 col-form-label">
                                Brand Name
                            </label>
                            <div class="col-md-8">
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    <option value="0" selected disabled>Select Brand</option>
                                    @foreach ($brands as $brand)
                                        @if ($brand->model_count)
                                            <option value="{{ $brand->id }}"
                                                @if ($parts->brand_id == $brand->id) selected @endif>
                                                {{ $brand->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div id="brand_wise_model_list">
                        @if (isset($models) && count($models))
                            <div class="form-group row">
                                <label for="model_id" class="col-md-4 col-form-label">
                                    Model Name
                                </label>
                                <div class="col-md-8">
                                    <select name="model_id" id="model_id" class="form-control" required>

                                        @foreach ($models as $model)
                                            <option value="{{ $model->id }}"
                                                @if ($parts->model_id == $model->id) selected @endif>
                                                {{ $model->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if (isset($parent_dealers) && count($parent_dealers))
                        <div class="form-group row">
                            <label for="parent_dealer_id" class="col-md-4 col-form-label">
                                Parent Dealer
                            </label>
                            <div class="col-md-8">
                                <select name="parent_dealer_id" id="parent_dealer_id" class="form-control" required>
                                    <option value="0" selected disabled>Select Parent Dealer</option>
                                    @foreach ($parent_dealers as $dealer)
                                        <option value="{{ $dealer->id }}"
                                            @if ($parts->parent_dealer_id == $dealer->id) selected @endif>
                                            {{ $dealer->com_org_inst_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label">Status</label>
                        <div class="col-md-8">
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" @if ($parts->status == 1) selected @endif>Active</option>
                                <option value="0" @if ($parts->status != 1) selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="note" name="note" placeholder="Note"
                                value="{{ $parts->note }}" />

                            <small id="name_help_block" class="form-text text-danger d-none ">
                                Parts name required
                            </small>
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
