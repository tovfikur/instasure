@php
$page_heading = 'Add New Parts';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.parts.breadcrumb', ['page_heading' => $page_heading])
    <section class="content">
        <div class="card card-info card-outline">
            <form role="form" action="{{ route('admin.parts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                            <div class="form-group row">

                                <label for="parts_name" class="col-sm-4 col-form-label">Parts Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="parts_name" id="parts_name"
                                        placeholder="Ex: camera"
                                        value="{{ !empty(session('parts_name')) ? session('parts_name') : old('parts_name') }}"
                                        required>
                                </div>
                            </div>
                            <!-- /.form-group -->


                            <div class="form-group row">
                                <label for="parts_price" class="col-sm-4 col-form-label">Parts Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="parts_price" id="parts_price"
                                        placeholder="Ex: 3000"
                                        value="{{ !empty(session('parts_price')) ? session('parts_price') : old('parts_price') }}"
                                        required>
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group row">
                                <label for="brand_id" class="col-sm-4 col-form-label">Select Brand</label>
                                <div class="col-sm-8">
                                    <select name="brand_id" id="brand_id" class="form-control" required>
                                        <option value="0" selected disabled>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            @if ($brand->model_count)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div id="brand_wise_model_list"></div>

                            <!-- /.form-group -->

                            <div class="form-group row">
                                <label for="parent_dealer_id" class="col-sm-4 col-form-label">Select Parent Dealer</label>
                                <div class="col-sm-8">
                                    <select name="parent_dealer_id" id="parent_dealer_id" class="form-control">
                                        <option value="0" selected disabled>Select Parent Dealer</option>
                                        @foreach ($parentDealers as $parentDealer)
                                            <option value="{{ $parentDealer->id }}">
                                                {{ $parentDealer->com_org_inst_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group row">
                                <label for="note" class="col-sm-4 col-form-label">Parts Note</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="note" id="note"
                                        placeholder="Ex: front camera"
                                        value="{{ !empty(session('note')) ? session('note') : old('note') }}">
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group row">
                                <label for="save" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary " id="save">Save</button>
                                    <button type="submit" class="btn btn-success pull-right " id="download" name="download"
                                        value="download">Download</button>
                                </div>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </form>
            <!-- /form -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

@stop
@push('js')
    <script>
        $('#brand_id').on('change', function(event) {
            const brand_id = $('#brand_id').val();
            var csrfToken = $("input[name='_token']").val();

            return get_brand_wise_model("{{ route('admin.parts.get_brand_wise_model_ajax') }}", {
                    brand_id: brand_id
                }, csrfToken)
                .then(data => {
                    $('#brand_wise_model_list').children().remove();
                    $('#save').fadeIn().removeClass('d-none');
                    $('#download').fadeIn().removeClass('d-none');
                    document.body.style.marginBottom = "0px";
                    $('#brand_wise_model_list').append(data);

                });
        });


        async function get_brand_wise_model(url = '', data = {}, csrfToken = null) {
            const response = await fetch(url, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                redirect: 'follow',
                referrerPolicy: 'no-referrer',
                body: JSON.stringify(data)

            });
            return response.text();
        };
    </script>
@endpush
