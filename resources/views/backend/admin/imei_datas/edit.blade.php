@php
$page_heading = 'Edit IMEI Data';
@endphp
@extends('backend.layouts.master')
@section('title', $page_heading)
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.imei_datas.breadcrumb', ['page_heading' => $page_heading])
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">

            <!-- form start -->
            <form role="form" action="{{ route('admin.imei-data.update', $imeiData->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="form-group row">
                                <label for="imei_1" class="col-md-3 col-form-label">IMEI 1</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" id="imei_1" name="imei_1"
                                        placeholder="Enter IMEI 1"
                                        value="{{ old('imei_1') ? old('imei_1') : $imeiData->imei_1 }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imei_2" class="col-md-3 col-form-label">IMEI 2</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="imei_2" id="imei_2"
                                        value="{{ old('imei_2') ? old('imei_2') : $imeiData->imei_2 }}"
                                        placeholder="Enter IMEI 2">
                                </div>
                            </div>


                            @if (isset($parent_dealers) && count($parent_dealers))
                                <div class="form-group row">
                                    <label for="parent_id" class="col-md-3 col-form-label">
                                        Parent Dealer
                                    </label>
                                    <div class="col-md-9">

                                        <select required="required" name="parent_id" id="parent_id" class="form-control">
                                            @foreach ($parent_dealers as $parent_dealer)
                                                <option value="{{ $parent_dealer->id }}"
                                                    @if ($parent_dealer->id == $imeiData->dealer->parent->id) selected @endif>
                                                    {{ $parent_dealer->com_org_inst_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <!-- Prent wise child dealers -->
                            <div id="parent_wise_child_dealers" class="form-group row">
                                @if (isset($child_dealers) && count($child_dealers))

                                    <label for="child_dealer_id" class="col-md-3 col-form-label">
                                        Child Dealers
                                    </label>
                                    <div class="col-md-9">
                                        <select required="required" name="child_dealer_id" id="child_dealer_id"
                                            class="form-control">

                                            @foreach ($child_dealers as $child_dealer)
                                                <option value="{{ $child_dealer->id }}"
                                                    @if ($child_dealer->id == $imeiData->parent_id) selected @endif>
                                                    {{ $child_dealer->com_org_inst_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                @endif

                            </div>
                            <!-- End: Prent wise child dealers -->
                            <div class="form-group row">
                                <label for="imei_2" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-secondary " id="save">Save</button>
                                </div>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->

            </form>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@stop
@push('js')
    <script>
        $('#parent_id').on('change', function(event) {
            const parent_id = $('#parent_id').val();
            var csrfToken = $("input[name='_token']").val();

            return get_parent_wise_child_dealer("{{ route('admin.get_parent_wise_child_dealer_ajax') }}", {
                    id: parent_id
                }, csrfToken)
                .then(data => {
                    $('#parent_wise_child_dealers').empty();
                    $('#parent_wise_child_dealers').append(data);
                });
        });


        async function get_parent_wise_child_dealer(url = '', data = {}, csrfToken = null) {
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
