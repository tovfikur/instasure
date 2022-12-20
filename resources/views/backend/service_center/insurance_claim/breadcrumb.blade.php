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

                    <li class="breadcrumb-item">
                        <a href="{{ route('serviceCenter.policy-search') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Make Claim
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('serviceCenter.insurance-claim.list') }}" class="btn btn-info btn-sm">
                            <i class="fa fa-th-list mr-1"></i>
                            Claim List
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
