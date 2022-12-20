@extends('backend.layouts.master')
@section("title","Insurance Discount List")
@push('css')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Insurance Discount List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Insurance Discount List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Insurance Discount Lists</h3>
                        <div class="float-right">
                            <a href="{{route('admin.insurance-discount.create')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-plus-circle"></i>
                                    Add
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#Id</th>
                                <th>Device Category</th>
                                <th>Device Subcategory</th>
                                <th>Device Brand</th>
                                <th>Device Model</th>
                                <th>Discount Type</th>
                                <th>Discount Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insuranceDiscounts as $key => $insuranceDiscount)
                                <tr>
                                    <td>{{$key + 1 }}</td>
                                    <td>{{$insuranceDiscount->deviceCategory->name}}</td>
                                    <td>{{$insuranceDiscount->deviceSubcategory->name}}</td>
                                    <td>{{$insuranceDiscount->device_brand_id ? $insuranceDiscount->deviceBrand->name :'All Brand'}}</td>
                                    <td>{{$insuranceDiscount->device_model_id ? $insuranceDiscount->deviceModel->name :'All Model'}}</td>
                                    <td>{{$insuranceDiscount->discount_type}}</td>
                                    <td>{{$insuranceDiscount->discount_price}}</td>
                                    <td>
                                        <div class="form-group col-md-2">
                                            <label class="switch">
                                                <input onchange="changeStatus(this)" value="{{ $insuranceDiscount->id }}" {{$insuranceDiscount->status == 1? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-info waves-effect" href="{{route('admin.insurance-discount.show',encrypt($insuranceDiscount->id))}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#Id</th>
                                <th>Device Category</th>
                                <th>Device Subcategory</th>
                                <th>Device Brand</th>
                                <th>Device Model</th>
                                <th>Discount Type</th>
                                <th>Discount Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script>
        function changeStatus(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.insurance-discount.status-update') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Status updated successfully');
                }
                else{
                    toastr.error('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endpush
