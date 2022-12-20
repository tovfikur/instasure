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
                        <a href="{{ route('admin.imei-data.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.imei-data.index') }}" class="btn btn-info btn-sm">
                            <i class="fa fa-th-list mr-1"></i>
                            All
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a id="parts_upload_btn" href="{{ route('admin.imei_data.download') }}"
                            class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i>
                            Download
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a id="parts_upload_btn" href="{{ route('admin.imei_data.upload') }}"
                            class="btn btn-danger btn-sm">
                            <i class="fa fa-upload"></i>
                            Upload
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
