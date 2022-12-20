<div class="modal fade modal_window" id="view_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">Collection Center Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /.modal-header -->
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="box">
                            <h3 class="box_heading">Basic Informations</h3>
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-university mr-1"></i>
                                    <span class="box_title">
                                        Center Name:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    {{ $collection_center->center_name }}
                                </span>
                            </div>
                            <!-- /.box_item -->
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-male mr-1"></i>
                                    <span class="box_title">
                                        Contact Person Name:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    {{ $collection_center->contact_person_name }}
                                </span>
                            </div>
                            <!-- /.box_item -->
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-phone mr-1"></i>
                                    <span class="box_title">
                                        Contact Person Phone:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    {{ $collection_center->contact_person_phone }}
                                </span>
                            </div>
                            <!-- /.box_item -->
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-envelope mr-1"></i>
                                    <span class="box_title">
                                        Contact Person Email:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    {{ $collection_center->contact_person_email }}
                                </span>
                            </div>
                            <!-- /.box_item -->

                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-university mr-1"></i>
                                    <span class="box_title">
                                        Parent Dealer:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    @if ($collection_center->parent_dealer)
                                        {{ $collection_center->parent_dealer->com_org_inst_name }}
                                    @else
                                        <del>None</del>
                                    @endif
                                </span>
                            </div>
                            <!-- /.box_item -->



                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-calendar mr-1"></i>
                                    <span class="box_title">
                                        Joined At:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    {{ date_format_custom($collection_center->created_at, 'd M, Y') }}
                                    ({{ $collection_center->created_at->diffForHumans() }})
                                </span>
                            </div>
                            <!-- /.box_item -->
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-hourglass-start mr-1"></i>
                                    <span class="box_title">
                                        Status
                                    </span>
                                </strong>
                                <span class="box_content">
                                    @if ($collection_center->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </span>
                            </div>
                            <!-- /.box_item -->
                        </div>
                        <!-- /.box -->
                        <div class="box">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="box_heading">Auth Informations</h3>
                                    <div class="box_item">
                                        <strong class="box_title">
                                            <i class="fas fa_icon fa-user mr-1"></i>
                                            <span class="box_title">
                                                User Name:
                                            </span>
                                        </strong>
                                        <span class="box_content">
                                            {{ $collection_center->user->name }}
                                        </span>
                                    </div>
                                    <!-- /.box_item -->
                                    <div class="box_item">
                                        <strong class="box_title">
                                            <i class="fas fa_icon fa-mobile mr-1"></i>
                                            <span class="box_title">
                                                User Phone:
                                            </span>
                                        </strong>
                                        <span class="box_content">
                                            {{ $collection_center->user->phone }}
                                        </span>
                                    </div>
                                    <!-- /.box_item -->
                                </div>
                                <div class="col-md-4">
                                    <h3 class="box_heading">Logo</h3>
                                    <div class="box_item">
                                        @if ($collection_center->logo)
                                            <img class="logo"
                                                src="{{ asset('uploads/collection-center') . '/' . $collection_center->logo }}"
                                                alt="collection_center_logo{{ $collection_center->id }}">
                                        @else
                                            <div class="alert alert-primary" role="alert">
                                                <del>None</del>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- /.box_item -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box -->
                        <div class="box">
                            <h3 class="box_heading">Contact Informations</h3>
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-location-arrow mr-1"></i>
                                    <span class="box_title">
                                        Address:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    {{ $collection_center->address }}
                                </span>
                            </div>
                            <!-- /.box_item -->
                            <div class="box_item">
                                <strong class="box_title">
                                    <i class="fas fa_icon fa-map-marker mr-1"></i>
                                    <span class="box_title">
                                        Location:
                                    </span>
                                </strong>
                                <span class="box_content">
                                    Division: {{ $collection_center->division->name }},
                                    District: {{ $collection_center->district->name }},
                                    Upazila: {{ $collection_center->upazila->name }}
                                </span>
                            </div>
                            <!-- /.box_item -->

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
