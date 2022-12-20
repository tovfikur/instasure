<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Facades\DataTables;

class DeviceCollection extends Model
{

    /**
     * Enhanced datatable for device collection list
     * @return datatable
     */

    public static function datatable()
    {

        $query = DeviceCollection::query();

        return DataTables::of($query)
            ->addColumn('actions', function (DeviceCollection $model) {
                $html = '<a id="parts_edit_btn" href="' . route('admin.collection-center.edit', [$model]) . '" class="mr-2" title="Edit"><span class="badge badge-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>';
                $html .= '<a id="view_btn" href="' . route('admin.collection-center.show', [$model]) . '" title="View"><span class="badge badge-dark"><i class="fa fa-eye"></i></span></a>';

                return $html;
            })
            ->editColumn('status', function (DeviceCollection $model) {
                $html = '';
                if ($model->status == 1) {
                    $html .=  '<a onclick="return confirm(\'Are you sure?\')" href="' . route('admin.collection-center.change_status', [$model]) . '"><span class="badge badge-success">Active</span></a>';
                } else {
                    $html .= '<a onclick="return confirm(\'Are you sure?\')" href="' . route('admin.collection-center.change_status', [$model]) . '"><span class="badge badge-secondary">Inactive</span></a>';
                }
                return $html;
            })
            ->editColumn('created_at', function (DeviceCollection $model) {
                return date_format_custom($model->created_at, 'd M, Y');
            })
            ->orderColumn('id', '-id $1')
            ->rawColumns(['actions', 'status'])
            ->toJson();
    }
}
