<div class="modal fade" id="modal_brand_mapping">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Brand Mapping With Parent Dealer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->
                <form action="{{ route('admin.parent_dealers_brand_mapping_store') }}" method="post"
                    id="form_brand_mapping">
                    <input type="hidden" name="dealer_id" value="{{ $parentDealer->id }}">

                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h5 class="card-title text-center">
                                Parent:
                                <strong>
                                    '{{ ucwords($parentDealer->com_org_inst_name) }}'
                                </strong>
                            </h5>
                        </div>
                        <div class="card-body">


                            <fieldset>
                                <legend>Brand List</legend>
                                <div class="row">
                                    @foreach ($brands as $key => $brand)
                                        <div class="col col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $brand->id }}" id="brand_{{ $key }}"
                                                    name="brands[]" @if (in_array($brand->id, $dealerBrands)) checked @endif />
                                                <label class="form-check-label" for="brand_{{ $key }}">
                                                    {{ ucwords($brand->name) }}
                                                </label>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    @endforeach
                                </div>
                                <!-- /.row -->
                            </fieldset>
                            <!-- fieldset -->


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-danger mr-2" data-dismiss="modal" aria-label="Close">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary mr-2">
                            Save
                        </button>
                    </div>
                    <!-- /.d-flex -->
                </form>
                <!-- form -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
