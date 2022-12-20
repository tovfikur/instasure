@extends('backend.layouts.master')
@section('title', 'Download IMEI Data')
@push('css')
@endpush
@section('content')
    @includeIf('backend.admin.imei_datas.breadcrumb', ['page_heading' => 'Download IMEI Data'])
    <!-- Main content -->
    <section class="content">

        <!-- general form elements -->
        <div class="card card-info card-outline">

            <!-- form start -->
            <form role="form" action="{{ route('admin.imei_data.download_process') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                            @if (isset($parent_dealers) && count($parent_dealers))
                                <div class="form-group row">
                                    <label for="parent_id" class="col-md-3 col-form-label">
                                        Parent Dealer
                                    </label>
                                    <div class="col-md-9">
                                        <select required="required" name="parent_id" id="parent_id" class="form-control">
                                            <option value="0" selected disabled>Select Parent Dealer</option>
                                            @foreach ($parent_dealers as $dealer)
                                                <option value="{{ $dealer->id }}">
                                                    {{ $dealer->com_org_inst_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            <!-- Prent wise child dealers -->
                            <div id="parent_wise_child_dealers" class="form-group row">

                            </div>
                            <!-- End: Prent wise child dealers -->
                            <div class="form-group row">
                                <label for="imei_2" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-secondary d-none" id="save">Download
                                        Sample</button>
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
                    $('#save').fadeIn().removeClass('d-none');
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
