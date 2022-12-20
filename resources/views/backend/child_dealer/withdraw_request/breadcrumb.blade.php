<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5 class="mt-1 text-secondary">
                    {{ $page_heading }}
                </h5>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right mt-1">


                    @if ($available_balance)
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0)" data-toggle="modal"
                                data-target="#make_commission_withdraw_request_modal" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i>
                                Make Withdraw Request
                            </a>
                        </li>
                    @endif
                    <li class="breadcrumb-item">
                        <a href="{{ route('childDealer.device-insurance.withdraw-request') }}"
                            class="btn btn-info btn-sm">
                            <i class="fa fa-th-list mr-1"></i>
                            All
                        </a>
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
