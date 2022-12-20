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
                        <a href="{{ route('admin.collection-center.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus"></i>
                            Add New
                        </a>
                    </li>
                    <!-- /.breadcrumb-item -->

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.collection-center.index') }}" class="btn btn-info btn-sm">
                            <i class="fa fa-th-list mr-1"></i>
                            All
                        </a>
                    </li>
                    <!-- /.breadcrumb-item -->

                </ol>
                <!-- /.breadcrumb -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
